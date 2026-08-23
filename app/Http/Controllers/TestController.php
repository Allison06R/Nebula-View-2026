<?php

namespace App\Http\Controllers;

use App\Mail\DiagnosticoPdfMail;
use App\Models\Test;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    public function index()
    {
        return view('test');
    }

    public function diagnostico(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string',
        ]);

        try {
            $response = Http::withToken(config('services.groq.key'))
                ->withOptions(['force_ip_resolve' => 'v4'])
                ->connectTimeout(15)
                ->timeout(60)
                ->retry(2, 500)
                ->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model' => config('services.groq.model', 'llama-3.3-70b-versatile'),
                    'messages' => [
                        ['role' => 'user', 'content' => $request->input('prompt')],
                    ],
                    'temperature' => 0.7,
                ]);
        } catch (\Throwable $e) {
            Log::error('Test.diagnostico: fallo de conexión con Groq', ['error' => $e->getMessage()]);

            return response()->json([
                'error' => 'No se pudo conectar con la IA. Verifica tu conexión a internet e inténtalo de nuevo.',
            ], 503);
        }

        if ($response->failed()) {
            Log::error('Test.diagnostico: Groq respondió con error', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);

            return response()->json([
                'error' => 'La IA no pudo procesar el diagnóstico en este momento.',
            ], 502);
        }

        return response()->json($response->json());
    }

    public function chat(Request $request)
    {
        $request->validate([
            'mensaje' => 'required|string',
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
            Log::error('Test.chat: fallo de conexión con Groq', ['error' => $e->getMessage()]);

            return response()->json([
                'error' => 'No se pudo conectar con la IA. Verifica tu conexión a internet e inténtalo de nuevo.',
            ], 503);
        }

        if ($response->failed()) {
            Log::error('Test.chat: Groq respondió con error', [
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
     * Guarda en la base de datos el resultado de un test recién
     * completado, asociado siempre al usuario autenticado (nunca a un
     * id_usuario que venga del cliente, para evitar que alguien guarde
     * un test a nombre de otra persona).
     */
    public function guardar(Request $request)
    {
        $datos = $request->validate([
            'resultado'                    => ['required', 'array'],
            'resultado.titulo'             => ['nullable', 'string', 'max:200'],
            'resultado.subtitulo'          => ['nullable', 'string', 'max:300'],
            'resultado.colorHex'           => ['nullable', 'string', 'max:20'],
            'resultado.analisis'           => ['nullable', 'string', 'max:3000'],
            'resultado.consejo'            => ['nullable', 'string', 'max:1000'],
            'resultado.condiciones'        => ['nullable', 'array', 'max:10'],
            'resultado.condiciones.*.icono' => ['nullable', 'string', 'max:10'],
            'resultado.condiciones.*.nombre' => ['nullable', 'string', 'max:150'],
            'resultado.condiciones.*.severidad' => ['nullable', 'string', 'max:20'],
            'resultado.condiciones.*.descripcion' => ['nullable', 'string', 'max:600'],
            'resultado.lentes'             => ['nullable', 'array', 'max:10'],
            'resultado.lentes.*.icono'     => ['nullable', 'string', 'max:10'],
            'resultado.lentes.*.nombre'    => ['nullable', 'string', 'max:150'],
            'resultado.lentes.*.desc'      => ['nullable', 'string', 'max:600'],
            'resultado.planSemanal'        => ['nullable', 'array', 'max:14'],
            'resultado.planSemanal.*.dia'    => ['nullable', 'string', 'max:10'],
            'resultado.planSemanal.*.titulo' => ['nullable', 'string', 'max:150'],
            'resultado.planSemanal.*.texto'  => ['nullable', 'string', 'max:600'],
            'scores'   => ['nullable', 'array'],
            'scores.*' => ['nullable', 'numeric', 'min:0', 'max:100'],
        ]);

        $test = Test::create([
            'id_usuario'        => auth()->id(),
            'resultado'         => [
                'tipo'        => 'diagnostico',
                'resultadoIA' => $datos['resultado'],
                'scores'      => $datos['scores'] ?? [],
            ],
            'fecha_realizacion' => now(),
        ]);

        return response()->json([
            'id_test' => $test->id_test,
            'fecha'   => $test->fecha_realizacion->format('d/m/Y'),
        ]);
    }

    /**
     * Lista (en JSON) los tests guardados del usuario autenticado,
     * más recientes primero. Solo trae los del propio usuario.
     */
    public function historial(Request $request)
    {
        $tests = Test::where('id_usuario', auth()->id())
            ->where(function ($q) {
                $q->whereNull('resultado->tipo')
                  ->orWhere('resultado->tipo', 'diagnostico');
            })
            ->orderByDesc('fecha_realizacion')
            ->limit(20)
            ->get()
            ->map(function (Test $test) {
                $ia = $test->resultado['resultadoIA'] ?? [];
                return [
                    'id_test'  => $test->id_test,
                    'fecha'    => $test->fecha_realizacion?->format('d/m/Y'),
                    'titulo'   => $ia['titulo'] ?? 'Diagnóstico visual',
                    'colorHex' => $ia['colorHex'] ?? '#7B3FC4',
                    'scores'   => $test->resultado['scores'] ?? [],
                ];
            });

        return response()->json($tests);
    }

    /**
     * Genera el PDF del diagnóstico y lo envía por correo. El correo
     * de destino SIEMPRE es el que ya tiene registrado el usuario
     * autenticado (nunca uno recibido del formulario), y el test debe
     * pertenecerle: así evitamos que alguien use este endpoint para
     * mandar correos a terceros o para leer el diagnóstico de otra
     * persona (IDOR).
     */
    public function enviarPdf(Request $request, Test $test)
    {
        $tipo = $test->resultado['tipo'] ?? 'diagnostico';
        if ($test->id_usuario !== auth()->id() || $tipo !== 'diagnostico') {
            abort(403, 'No tienes permiso para acceder a este test.');
        }

        $usuario = auth()->user();
        $resultado = $test->resultado['resultadoIA'] ?? [];
        $scores    = $test->resultado['scores'] ?? [];

        try {
            $pdf = Pdf::loadView('pdf.diagnostico', [
                'usuario'   => $usuario,
                'test'      => $test,
                'resultado' => $resultado,
                'scores'    => $scores,
            ])->setPaper('a4');

            Mail::to($usuario->correo)->send(
                new DiagnosticoPdfMail($usuario, $test, $pdf->output())
            );
        } catch (\Throwable $e) {
            Log::error('Test.enviarPdf: fallo al generar/enviar el PDF', ['error' => $e->getMessage()]);

            return response()->json([
                'error' => 'No pudimos enviar el diagnóstico. Inténtalo de nuevo en unos minutos.',
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Te enviamos el diagnóstico en PDF a ' . $usuario->correo,
        ]);
    }

    /**
     * Elimina un test guardado, solo si pertenece al usuario autenticado.
     */
    public function destroy(Request $request, Test $test)
    {
        if ($test->id_usuario !== auth()->id()) {
            abort(403, 'No tienes permiso para eliminar este test.');
        }

        $test->delete();

        return response()->json(['success' => true]);
    }
}