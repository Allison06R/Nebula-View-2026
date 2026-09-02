<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatWidgetController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'mensaje'   => 'required|string',
            'historial' => 'nullable|array',
        ]);

        $mensajeUsuario = $request->input('mensaje');

        // ── 1) RESPUESTAS FIJAS ────────────────────────────────────────────

        if ($respuestaFija = $this->respuestaFija($mensajeUsuario)) {
            return response()->json(['reply' => $respuestaFija]);
        }

        // ── 2) CONOCIMIENTO GUIADO ───────────────────────────────────────────si
        $systemPrompt = [
            'role' => 'system',
            'content' => 'Eres el asistente virtual de Nebula View llamada Nebulita, una plataforma de optometría y '
                . 'recomendación de lentes. Responde siempre en español, de forma breve, cálida y '
                . 'profesional. Ayuda a los usuarios con dudas sobre el test de diagnóstico visual, '
                . 'recomendaciones de lentes, problemas visuales, salud visual, hábitos, modelos 3D, '
                . 'profesionales, clínicas y el uso general del sitio.'
                . "\n\nTen en cuenta esta información al responder (úsala como base, no la cites literal):\n"
                . $this->conocimientoBase(),
        ];

        $messages   = $request->input('historial', []);
        $messages[] = ['role' => 'user', 'content' => $mensajeUsuario];

        try {
            $response = Http::withToken(config('services.groq.key'))
                ->withOptions(['force_ip_resolve' => 'v4'])
                ->connectTimeout(15)
                ->timeout(60)
                ->retry(2, 500)
                ->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model'       => config('services.groq.model', 'openai/gpt-oss-120b'),
                    'messages'    => [$systemPrompt, ...$messages],
                    'temperature' => 0.6,
                ]);
        } catch (\Throwable $e) {
            Log::error('ChatWidget: fallo de conexión con Groq', ['error' => $e->getMessage()]);

            return response()->json([
                'reply' => 'No pude conectarme con el asistente en este momento. Intenta de nuevo en unos segundos.',
            ], 200);
        }

        if ($response->failed()) {
            Log::error('ChatWidget: Groq respondió con error', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);

            return response()->json([
                'reply' => 'No pude conectarme con el asistente en este momento. Intenta de nuevo en unos segundos.',
            ], 200);
        }

        $reply = $response->json('choices.0.message.content');

        return response()->json([
            'reply' => $reply ?: 'No pude generar una respuesta. ¿Puedes reformular tu pregunta?',
        ]);
    }

    protected function respuestaFija(string $mensaje): ?string
    {
        $texto = $this->normalizar($mensaje);

       $reglas = [
    [
        'palabras'  => ['horario', 'atienden', 'abren', 'horas de atencion'],
        'respuesta' => 'Puedes usar la plataforma las 24 horas, los 7 días de la semana. Si buscas el horario de alguna clínica en particular, dime cuál y te ayudo.',
    ],
    [
        'palabras'  => ['precio del test', 'cuesta el test', 'test gratis', 'test gratuito'],
        'respuesta' => 'El test de diagnóstico visual dentro de Nebula View es completamente gratuito, solo debes iniciar sesión para realizarlo.',
    ],
    [
        'palabras'  => ['quienes son', 'quien esta detras', 'sobre nosotras', 'quienes hicieron'],
        'respuesta' => 'Nebula View es un proyecto académico enfocado en salud visual y recomendación de lentes. Puedes conocer más en la sección "Sobre nosotras" del menú.',
    ],
    [
        'palabras'  => ['problemas de vision', 'problemas visuales', 'problemas de vista', 'problemas de ojos'],
        'respuesta' => 'Si tienes problemas de visión, te recomiendo realizar el test de diagnóstico visual en nuestra plataforma. También puedes consultar con un profesional de la salud visual para una evaluación más completa.',
    ],
    [
        'palabras'  => ['modelos 3d', 'lentes 3d', 'probar lentes 3d'],
        'respuesta' => 'Nuestra plataforma permite probar modelos 3D de lentes para que puedas ver cómo se verían en tu rostro antes de tomar una decisión. Puedes acceder a esta función iniciando sesión.',
    ],
    [
        'palabras'  => ['contacto', 'contactanos', 'correo electronico', 'email'],
        'respuesta' => 'Puedes contactarnos a través del correo electrónico: nebulitavieww@gmail.com. Estaremos encantados de ayudarte con cualquier consulta o inquietud que tengas.',
    ],
    [
        'palabras'  => ['agendar cita', 'agendar con un profesional', 'como agendo', 'reservar cita', 'sacar cita'],
        'respuesta' => 'Por ahora Nebula View no tiene un sistema de citas dentro de la plataforma. Lo que puedes hacer es ir a la sección "Profesionales" del menú, donde encontrarás los datos de contacto de cada especialista para comunicarte directamente.',
    ],
    [
        'palabras'  => ['profesionales', 'clinicas', 'opticas', 'consultas', 'atencion profesional'],
        'respuesta' => 'En la sección "Profesionales" del menú encontrarás una lista de clínicas y ópticas asociadas, con sus datos de contacto para que te comuniques directamente con ellas.',
    ],
];
        foreach ($reglas as $regla) {
            foreach ($regla['palabras'] as $palabra) {
                if (str_contains($texto, $this->normalizar($palabra))) {
                    return $regla['respuesta'];
                }
            }
        }

        return null;
    }

    protected function conocimientoBase(): string
    {
        return "- El test de diagnóstico visual es gratuito.\n"
             . "- La plataforma permite probar modelos 3D de lentes.\n"
             . "- Nebula View es un proyecto académico enfocado en salud visual y orientación para la selección de lentes.\n";
    }

    /**
     * Minúsculas y sin tildes, para que "atención" y "atencion" coincidan igual.
     */
    protected function normalizar(string $texto): string
    {
        $texto = mb_strtolower(trim($texto));

        return strtr($texto, [
            'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ñ' => 'n',
        ]);
    }
}