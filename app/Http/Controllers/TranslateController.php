<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TranslateController extends Controller
{
    public function translate(Request $request)
    {
        $request->validate([
            'texts'   => 'required|array',
            'texts.*' => 'nullable|string',
        ]);

        // ─── Limpiar textos ────────────────────────────────────────────
        $texts = collect($request->input('texts'))
            ->map(fn ($text) => trim((string) $text))
            ->filter(fn ($text) => $text !== '')
            ->values();

        if ($texts->isEmpty()) {
            return response()->json([
                'success'      => true,
                'translations' => [],
            ]);
        }

        // ─── Limitar cantidad por petición ─────────────────────────────
        $texts = $texts->take(50);

        // ─── Prompt ─────────────────────────────────────────────────────
        $prompt = "You are the official translator for a website called \"Nebula View\".\n\n"
            . "Translate the following texts from Spanish to natural, professional English.\n\n"
            . "RULES:\n\n"
            . "1. Preserve the exact meaning.\n"
            . "2. Do not add explanations.\n"
            . "3. Do not remove information.\n"
            . "4. Keep \"Nebula View\" exactly as it is.\n"
            . "5. Keep names, numbers and technical terms accurate.\n"
            . "6. Keep the same order as the input.\n"
            . "7. Return ONLY valid JSON.\n"
            . "8. The JSON must contain a property called \"translations\".\n"
            . "9. The translations array must contain exactly the same number of elements as the input.\n"
            . "10. Do not use Markdown.\n\n"
            . "Texts to translate:\n";

        foreach ($texts->values() as $index => $text) {
            $prompt .= "\n{$index}: {$text}";
        }

        // ─── Petición a Groq ────────────────────────────────────────────
        $response = Http::withToken(config('services.groq.key'))
            ->timeout(60)
            ->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => config('services.groq.model', 'llama-3.3-70b-versatile'),
                'messages' => [
                    [
                        'role'    => 'system',
                        'content' => 'You are a professional Spanish-English website translator. Return only valid JSON.',
                    ],
                    [
                        'role'    => 'user',
                        'content' => $prompt,
                    ],
                ],
                'temperature'     => 0.1,
                'response_format' => ['type' => 'json_object'],
            ]);

        if ($response->failed()) {
            return response()->json([
                'success' => false,
                'error'   => $response->json('error.message') ?? 'Groq devolvió un error.',
            ], $response->status());
        }

        $content = $response->json('choices.0.message.content');

        if (!$content) {
            return response()->json([
                'success' => false,
                'error'   => 'Groq no devolvió una traducción.',
            ], 500);
        }

        $translationData = json_decode($content, true);

        if (!$translationData || !isset($translationData['translations'])) {
            return response()->json([
                'success' => false,
                'error'   => 'Formato de respuesta inválido.',
            ], 500);
        }

        return response()->json([
            'success'      => true,
            'translations' => $translationData['translations'],
        ]);
    }
}