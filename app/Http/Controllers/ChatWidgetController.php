<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatWidgetController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'mensaje'   => 'required|string',
            'historial' => 'nullable|array',
        ]);

        $systemPrompt = [
            'role' => 'system',
            'content' => 'Eres el asistente virtual de Nebula View llamada Nebulita, una plataforma de optometría y '
                . 'recomendación de lentes. Responde siempre en español, de forma breve, cálida y '
                . 'profesional. Ayuda a los usuarios con dudas sobre el test de diagnóstico visual, '
                . 'recomendaciones de lentes, problemas visuales, salud visual, hábitos, modelos 3D, '
                . 'profesionales, clínicas y el uso general del sitio.',
        ];

        $messages   = $request->input('historial', []);
        $messages[] = ['role' => 'user', 'content' => $request->input('mensaje')];

        $response = Http::withToken(config('services.groq.key'))
            ->timeout(60)
            ->post('https://api.groq.com/openai/v1/chat/completions', [
                'model'       => 'llama-3.3-70b-versatile',
                'messages'    => [$systemPrompt, ...$messages],
                'temperature' => 0.6,
            ]);

        if ($response->failed()) {
            return response()->json([
                'reply' => 'No pude conectarme con el asistente en este momento. Intenta de nuevo en unos segundos.',
                'error' => $response->body(),
            ], 200);
        }

        $reply = $response->json('choices.0.message.content');

        return response()->json([
            'reply' => $reply ?: 'No pude generar una respuesta. ¿Puedes reformular tu pregunta?',
        ]);
    }
}