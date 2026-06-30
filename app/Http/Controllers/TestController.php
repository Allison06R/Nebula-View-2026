<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

        $response = Http::withToken(config('services.groq.key'))
            ->timeout(60)
            ->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => 'llama-3.3-70b-versatile',
                'messages' => [
                    ['role' => 'user', 'content' => $request->input('prompt')],
                ],
                'temperature' => 0.7,
            ]);

        if ($response->failed()) {
            return response()->json([
                'error' => 'Error al contactar la IA',
                'details' => $response->body(),
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

        $response = Http::withToken(config('services.groq.key'))
            ->timeout(60)
            ->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => 'llama-3.3-70b-versatile',
                'messages' => $messages,
                'temperature' => 0.6,
            ]);

        if ($response->failed()) {
            return response()->json([
                'error' => 'Error al contactar la IA',
                'details' => $response->body(),
            ], 502);
        }

        return response()->json($response->json());
    }
}