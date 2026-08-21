<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

/**
 * ============================================================
 * NEBULA VIEW
 * Google Cloud Translation API
 * ============================================================
 *
 * Endpoint:
 *
 * POST /api/translate
 *
 * Recibe:
 *
 * {
 *     "texts": [
 *         "Hola",
 *         "Bienvenido a Nebula View"
 *     ],
 *     "target": "en"
 * }
 *
 * Devuelve:
 *
 * {
 *     "success": true,
 *     "translations": [
 *         "Hello",
 *         "Welcome to Nebula View"
 *     ]
 * }
 *
 * ============================================================
 */
class TranslateController extends Controller
{
    public function translate(Request $request): JsonResponse
    {
        $config = config('google');

        // ============================================================
        // API KEY
        // ============================================================

        $apiKey = $config['api_key'] ?? '';

        if (empty($apiKey)) {
            return response()->json([
                'success' => false,
                'error' => 'No se encontró GOOGLE_TRANSLATE_API_KEY.',
            ], 500);
        }

        // ============================================================
        // VALIDAR ENTRADA
        // ============================================================

        $validated = $request->validate([
            'texts' => ['required', 'array'],
            'texts.*' => ['nullable', 'string'],
            'target' => ['nullable', 'string'],
        ]);

        // ============================================================
        // LIMPIAR TEXTOS
        // ============================================================

        $cleanTexts = [];

        foreach ($validated['texts'] as $text) {
            if (!is_string($text)) {
                continue;
            }

            $text = trim($text);

            if ($text === '') {
                continue;
            }

            $cleanTexts[] = $text;
        }

        if (empty($cleanTexts)) {
            return response()->json([
                'success' => true,
                'translations' => [],
            ]);
        }

        // ============================================================
        // LÍMITE DE TEXTOS
        // ============================================================

        $maxTexts = $config['max_texts_per_request'] ?? 50;

        if (count($cleanTexts) > $maxTexts) {
            $cleanTexts = array_slice($cleanTexts, 0, $maxTexts);
        }

        // ============================================================
        // IDIOMAS
        // ============================================================

        $sourceLanguage = $config['source_language'] ?? 'es';

        $targetLanguage = $validated['target']
            ?? $config['default_target_language']
            ?? 'en';

        $allowedLanguages = ['es', 'en'];

        if (!in_array($targetLanguage, $allowedLanguages, true)) {
            return response()->json([
                'success' => false,
                'error' => 'Idioma de destino no permitido.',
            ], 400);
        }

        // ============================================================
        // SI ES EL MISMO IDIOMA
        // ============================================================

        if ($sourceLanguage === $targetLanguage) {
            return response()->json([
                'success' => true,
                'translations' => $cleanTexts,
            ]);
        }

        // ============================================================
        // LLAMADA A GOOGLE
        // ============================================================

        $response = Http::timeout(30)
            ->connectTimeout(10)
            ->asJson()
            ->post($config['url'] . '?key=' . urlencode($apiKey), [
                'q' => $cleanTexts,
                'source' => $sourceLanguage,
                'target' => $targetLanguage,
                'format' => 'text',
            ]);

        if ($response->failed()) {
            $googleError = $response->json('error.message')
                ?? 'Google Translation devolvió un error.';

            return response()->json([
                'success' => false,
                'error' => $googleError,
            ], $response->status() >= 400 ? $response->status() : 500);
        }

        // ============================================================
        // OBTENER TRADUCCIONES
        // ============================================================

        $googleTranslations = $response->json('data.translations');

        if (!is_array($googleTranslations)) {
            return response()->json([
                'success' => false,
                'error' => 'Google no devolvió traducciones válidas.',
            ], 500);
        }

        $translations = [];

        foreach ($googleTranslations as $translation) {
            $translatedText = $translation['translatedText'] ?? '';

            $translations[] = html_entity_decode(
                $translatedText,
                ENT_QUOTES | ENT_HTML5,
                'UTF-8'
            );
        }

        if (count($translations) !== count($cleanTexts)) {
            return response()->json([
                'success' => false,
                'error' => 'La cantidad de traducciones recibidas no coincide con los textos enviados.',
            ], 500);
        }

        return response()->json([
            'success' => true,
            'source' => $sourceLanguage,
            'target' => $targetLanguage,
            'translations' => $translations,
        ]);
    }
}
