<?php

namespace App\Http\Controllers;

use App\Mail\DiagnosticoIshiharaPdfMail;
use App\Models\Test;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TestIshiharaController extends Controller
{
    public function index()
    {
        return view('test-ishihara');
    }

    /**
     * Devuelve la lista de láminas (solo id + imagen) para que el frontend
     * las muestre. El número correcto NUNCA se envía al navegador.
     */
    public function laminas()
    {
        $laminas = collect(config('ishihara.laminas'))->map(fn ($l) => [
            'id'     => $l['id'],
            'imagen' => asset('images/ishihara/' . $l['imagen']),
        ])->values();

        return response()->json($laminas);
    }

    /**
     * Recibe las respuestas del usuario, las califica contra la fuente de
     * verdad del servidor (nunca contra algo que mande el cliente), pide a
     * la IA una interpretación orientativa y guarda el test.
     *
     * El resultado se guarda en la misma tabla "tests" que usa el test de
     * diagnóstico general (modelo Test), marcado con "tipo" => "ishihara"
     * dentro del JSON de "resultado", en vez de usar una tabla aparte.
     */
    public function finalizar(Request $request)
    {
        $datos = $request->validate([
            'respuestas'              => ['required', 'array', 'min:1'],
            'respuestas.*.id'         => ['required', 'integer'],
            'respuestas.*.respuesta'  => ['nullable', 'string', 'max:10'],
        ]);

        $laminas = collect(config('ishihara.laminas'))->keyBy('id');
        $aciertos = 0;
        $detalle = [];

        foreach ($datos['respuestas'] as $r) {
            $lamina = $laminas->get($r['id']);
            if (!$lamina) {
                continue;
            }

            $respuestaCruda = trim((string) ($r['respuesta'] ?? ''));
            $noLoVe = $respuestaCruda === '' || strtolower($respuestaCruda) === 'no lo veo';
            $esCorrecta = !$noLoVe && (int) $respuestaCruda === (int) $lamina['correcto'];

            if ($esCorrecta) {
                $aciertos++;
            }

            $detalle[] = [
                'id_lamina' => $lamina['id'],
                'esperado'  => $lamina['correcto'],
                'respuesta' => $noLoVe ? 'no lo veo' : $respuestaCruda,
                'correcta'  => $esCorrecta,
            ];
        }

        $total = count($detalle);

        $prompt = $this->buildPrompt($aciertos, $total, $detalle);

        $resultadoIA = null;
        try {
            $response = Http::withToken(config('services.groq.key'))
                ->withOptions(['force_ip_resolve' => 'v4'])
                ->connectTimeout(15)
                ->timeout(60)
                ->retry(2, 500)
                ->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model' => config('services.groq.model', 'llama-3.3-70b-versatile'),
                    'messages' => [
                        ['role' => 'user', 'content' => $prompt],
                    ],
                    'temperature' => 0.6,
                ]);

            if ($response->successful()) {
                $raw = $response->json('choices.0.message.content', '{}');
                $resultadoIA = json_decode(preg_replace('/```json|```/', '', trim($raw)), true);
            } else {
                Log::error('TestIshihara.finalizar: Groq respondió con error', [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);
            }
        } catch (\Throwable $e) {
            Log::error('TestIshihara.finalizar: fallo de conexión con Groq', ['error' => $e->getMessage()]);
        }

        if (!is_array($resultadoIA)) {
            $resultadoIA = $this->fallbackResultado($aciertos, $total);
        }

        $test = Test::create([
            'id_usuario'        => auth()->id(),
            'resultado'         => [
                'tipo'          => 'ishihara',
                'aciertos'      => $aciertos,
                'total_laminas' => $total,
                'respuestas'    => $detalle,
                'resultado_ia'  => $resultadoIA,
            ],
            'fecha_realizacion' => now(),
        ]);

        return response()->json([
            'id_test_ishihara' => $test->id_test,
            'aciertos'         => $aciertos,
            'total'            => $total,
            'detalle'          => $detalle,
            'resultado'        => $resultadoIA,
            'fecha'            => $test->fecha_realizacion->format('d/m/Y'),
        ]);
    }

    private function buildPrompt(int $aciertos, int $total, array $detalle): string
    {
        $porcentaje = $total > 0 ? round($aciertos / $total * 100) : 0;
        $lineas = collect($detalle)->map(
            fn ($d) => "- Lámina {$d['id_lamina']}: esperado {$d['esperado']}, respondió \"{$d['respuesta']}\" → " . ($d['correcta'] ? 'correcta' : 'incorrecta')
        )->implode("\n");

        return <<<PROMPT
Eres el asistente de salud visual de Nebula View, óptica especializada en cuidado ocular.
Un usuario completó un test de Ishihara de {$total} láminas (test orientativo de percepción del color, no un examen clínico) y acertó {$aciertos} de {$total} ({$porcentaje}%).

Detalle lámina por lámina:
{$lineas}

Genera una interpretación orientativa, profesional y empática en español. Responde ÚNICAMENTE con JSON válido (sin markdown, sin texto extra) con esta estructura exacta:
{
  "titulo": "Título corto del resultado (ej: Percepción cromática dentro de lo esperado / Posibles indicios de discromatopsia rojo-verde)",
  "nivel": "normal|leve|moderado|a_evaluar",
  "resumen": "Párrafo de 3-4 oraciones explicando qué sugiere este patrón de aciertos/errores, en lenguaje claro y sin alarmar.",
  "posiblePatron": "Si los errores sugieren un patrón típico (ej. protan/deutan o rojo-verde) explícalo en 1-2 oraciones; si no hay patrón claro o el resultado es normal, dilo explícitamente.",
  "recomendacion": "2-3 oraciones con el siguiente paso recomendado (ej. revisión con un especialista en optometría/oftalmología si corresponde).",
  "chatContexto": "Resumen de 2-3 líneas del resultado para que el asistente de chat lo use como contexto."
}
PROMPT;
    }

    private function fallbackResultado(int $aciertos, int $total): array
    {
        $porcentaje = $total > 0 ? round($aciertos / $total * 100) : 0;
        return [
            'titulo'         => "Resultado: {$aciertos} de {$total} láminas correctas",
            'nivel'          => $porcentaje >= 80 ? 'normal' : ($porcentaje >= 50 ? 'leve' : 'a_evaluar'),
            'resumen'        => "Respondiste correctamente {$aciertos} de {$total} láminas ({$porcentaje}%). No pudimos generar el análisis detallado de la IA en este momento, pero puedes revisar el detalle de cada lámina más abajo.",
            'posiblePatron'  => 'No disponible por el momento.',
            'recomendacion'  => 'Te recomendamos repetir el test más tarde y, ante cualquier duda sobre tu percepción del color, consultar con un profesional de la salud visual.',
            'chatContexto'   => "El usuario obtuvo {$aciertos} de {$total} en un test de Ishihara.",
        ];
    }

    public function chat(Request $request)
    {
        $request->validate([
            'mensaje'   => 'required|string',
            'historial' => 'nullable|array',
        ]);

        $messages = $request->input('historial', []);
        $messages[] = ['role' => 'user', 'content' => $request->input('mensaje')];

        try {
            $response = Http::withToken(config('services.groq.key'))
                ->withOptions(['force_ip_resolve' => 'v4'])
                ->connectTimeout(15)
                ->timeout(60)
                ->retry(2, 500)
                ->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model' => config('services.groq.model', 'llama-3.3-70b-versatile'),
                    'messages' => $messages,
                    'temperature' => 0.6,
                ]);
        } catch (\Throwable $e) {
            Log::error('TestIshihara.chat: fallo de conexión con Groq', ['error' => $e->getMessage()]);

            return response()->json([
                'error' => 'No se pudo conectar con la IA. Verifica tu conexión a internet e inténtalo de nuevo.',
            ], 503);
        }

        if ($response->failed()) {
            Log::error('TestIshihara.chat: Groq respondió con error', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);

            return response()->json([
                'error' => 'La IA no pudo procesar tu mensaje en este momento.',
            ], 502);
        }

        return response()->json($response->json());
    }

    /**
     * Lista (en JSON) los tests de Ishihara del usuario autenticado,
     * filtrando dentro de la tabla "tests" los que tienen
     * resultado->tipo = "ishihara".
     */
    public function historial(Request $request)
    {
        $tests = Test::where('id_usuario', auth()->id())
            ->where('resultado->tipo', 'ishihara')
            ->orderByDesc('fecha_realizacion')
            ->limit(20)
            ->get()
            ->map(function (Test $t) {
                $r = $t->resultado ?? [];
                $ia = $r['resultado_ia'] ?? [];

                return [
                    'id_test_ishihara' => $t->id_test,
                    'fecha'            => $t->fecha_realizacion?->format('d/m/Y'),
                    'aciertos'         => $r['aciertos'] ?? 0,
                    'total'            => $r['total_laminas'] ?? 0,
                    'titulo'           => $ia['titulo'] ?? 'Test de Ishihara',
                    'nivel'            => $ia['nivel'] ?? null,
                ];
            });

        return response()->json($tests);
    }

    public function enviarPdf(Request $request, Test $test)
    {
        if ($test->id_usuario !== auth()->id() || ($test->resultado['tipo'] ?? null) !== 'ishihara') {
            abort(403, 'No tienes permiso para acceder a este test.');
        }

        $usuario = auth()->user();

        try {
            $pdf = Pdf::loadView('pdf.diagnostico-ishihara', [
                'usuario' => $usuario,
                'test'    => $test,
            ])->setPaper('a4');

            Mail::to($usuario->correo)->send(
                new DiagnosticoIshiharaPdfMail($usuario, $test, $pdf->output())
            );
        } catch (\Throwable $e) {
            Log::error('TestIshihara.enviarPdf: fallo al generar/enviar el PDF', ['error' => $e->getMessage()]);

            return response()->json([
                'error' => 'No pudimos enviar el resultado. Inténtalo de nuevo en unos minutos.',
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Te enviamos el resultado en PDF a ' . $usuario->correo,
        ]);
    }

    public function destroy(Request $request, Test $test)
    {
        if ($test->id_usuario !== auth()->id() || ($test->resultado['tipo'] ?? null) !== 'ishihara') {
            abort(403, 'No tienes permiso para eliminar este test.');
        }

        $test->delete();

        return response()->json(['success' => true]);
    }
}
