<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ComentarioController extends Controller
{
    /**
     * Devuelve los comentarios aprobados de una página informativa (JSON).
     */
    public function index(string $pagina)
    {
        if (!in_array($pagina, Comentario::PAGINAS_PERMITIDAS, true)) {
            abort(404);
        }

        $comentarios = Comentario::with('usuario')
            ->where('pagina', $pagina)
            ->where('estado', 'aprobado')
            ->orderByDesc('created_at')
            ->limit(50)
            ->get()
            ->map(fn ($c) => [
                'id'        => $c->id_comentario,
                'usuario'   => $c->usuario->nombre ?? 'Usuario',
                'contenido' => $c->contenido,
                'fecha'     => $c->created_at->diffForHumans(),
            ]);

        return response()->json(['comentarios' => $comentarios]);
    }

    /**
     * Guarda un comentario nuevo. Pasa primero por moderación con IA (Groq)
     * antes de quedar visible. Requiere sesión iniciada (ver rutas).
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'pagina'    => 'required|string|in:' . implode(',', Comentario::PAGINAS_PERMITIDAS),
            'contenido' => 'required|string|min:2|max:500',
        ]);

        [$estado, $motivo] = $this->moderar($data['contenido']);

        $comentario = Comentario::create([
            'id_usuario'     => Auth::id(),
            'pagina'         => $data['pagina'],
            'contenido'      => $data['contenido'],
            'estado'         => $estado,
            'motivo_rechazo' => $motivo,
        ]);

        if ($estado === 'rechazado') {
            return response()->json([
                'ok'      => false,
                'mensaje' => 'Tu comentario no cumple con las normas de la comunidad y no fue publicado.',
            ]);
        }

        if ($estado === 'pendiente_revision') {
            return response()->json([
                'ok'      => true,
                'pendiente' => true,
                'mensaje' => 'Tu comentario fue recibido y está en revisión antes de publicarse.',
            ]);
        }

        return response()->json([
            'ok' => true,
            'comentario' => [
                'id'        => $comentario->id_comentario,
                'usuario'   => Auth::user()->nombre,
                'contenido' => $comentario->contenido,
                'fecha'     => 'Justo ahora',
            ],
        ]);
    }

    /**
     * Elimina un comentario propio desde "Mi Perfil". Solo el autor puede
     * borrarlo (los administradores tienen su propia ruta en el panel).
     */
    public function destroyMio(Comentario $comentario)
    {
        if ($comentario->id_usuario !== Auth::id()) {
            abort(403, 'No tienes permiso para eliminar este comentario.');
        }

        $comentario->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Le pide a Groq que clasifique el comentario como ofensivo o no.
     * Devuelve [estado, motivo]. Si la IA falla o responde algo no parseable,
     * el comentario queda "pendiente_revision" (no se publica ni se rechaza
     * automáticamente) para que un admin decida a mano.
     */
    protected function moderar(string $texto): array
    {
        $systemPrompt = [
            'role' => 'system',
            'content' => 'Eres un moderador de comentarios para un sitio de salud visual llamado Nebula View. '
                . 'Analiza el comentario del usuario y responde ÚNICAMENTE con un JSON válido, sin texto '
                . 'adicional ni marcado de código, con este formato exacto: '
                . '{"ofensivo": true o false, "motivo": "breve razón o null"}. '
                . 'Marca "ofensivo": true si el comentario contiene insultos, discurso de odio, acoso, '
                . 'contenido sexual, spam o publicidad, o lenguaje agresivo. Comentarios críticos pero '
                . 'respetuosos (por ejemplo quejas sobre el sitio) NO son ofensivos.',
        ];

        try {
            $response = Http::withToken(config('services.groq.key'))
                ->withOptions(['force_ip_resolve' => 'v4'])
                ->connectTimeout(15)
                ->timeout(30)
                ->retry(2, 500)
                ->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model' => config('services.groq.model', 'openai/gpt-oss-120b'),
                    'messages' => [
                        $systemPrompt,
                        ['role' => 'user', 'content' => $texto],
                    ],
                    'temperature' => 0,
                ]);
        } catch (\Throwable $e) {
            Log::error('Comentarios: fallo de conexión con Groq al moderar', ['error' => $e->getMessage()]);
            return ['pendiente_revision', null];
        }

        if ($response->failed()) {
            Log::error('Comentarios: Groq respondió con error al moderar', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
            return ['pendiente_revision', null];
        }

        $contenidoRespuesta = $response->json('choices.0.message.content');
        $json = json_decode((string) $contenidoRespuesta, true);

        if (!is_array($json) || !array_key_exists('ofensivo', $json)) {
            Log::warning('Comentarios: respuesta de Groq no es JSON válido', ['respuesta' => $contenidoRespuesta]);
            return ['pendiente_revision', null];
        }

        if ($json['ofensivo'] === true) {
            return ['rechazado', $json['motivo'] ?? 'Contenido inapropiado detectado por el moderador automático.'];
        }

        return ['aprobado', null];
    }
}
