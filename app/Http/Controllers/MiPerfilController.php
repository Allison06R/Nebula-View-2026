<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\PerfilVisual;
use App\Models\Test;

class MiPerfilController extends Controller
{
    // Opciones para el formulario de preferencias (antes "perfil visual")
    private array $opcionesSexo     = ['Masculino', 'Femenino', 'Otro'];
    private array $opcionesCara     = ['Redonda', 'Ovalada', 'Cuadrada', 'Alargada', 'Corazón', 'Diamante'];
    private array $opcionesProblema = ['Miopía', 'Hipermetropía', 'Astigmatismo', 'Presbicia', 'Ninguno', 'No lo sé'];
    private array $opcionesSintomas = ['Ninguno', 'Dolor de cabeza', 'Vista borrosa', 'Ojos secos', 'Ardor', 'Fatiga visual'];
    private array $opcionesColor    = ['Negro', 'Café', 'Azul', 'Transparente', 'Dorado', 'Plateado'];
    private array $opcionesEstetica = ['Clásico', 'Moderno', 'Deportivo', 'Elegante', 'Minimalista'];

    // ── Mostrar la página de perfil (foto, marco, banner e información) ──────
    public function show()
    {
        $usuario = auth()->user();

        return view('mi-perfil', [
            'usuario'  => $usuario,
            'marcos'   => config('apariencia.marcos'),
            'avatares' => config('apariencia.avatares'),
            'banners'  => config('apariencia.banners'),
            'stats'    => $this->statsDe($usuario),
            'misModelos3d' => $usuario->modelos3d()
                ->where('favorito', 1)
                ->orderByDesc('updated_at')
                ->get(),
            'misTests' => $this->testsDe($usuario),
            'misChats' => $usuario->chats()
                ->orderByDesc('created_at')
                ->limit(60)
                ->get(),
            'misComentarios' => $usuario->comentarios()
                ->orderByDesc('created_at')
                ->get(),
        ]);
    }

    /**
     * Junta los tests de diagnóstico general y de Ishihara (ambos viven en
     * la tabla "tests", distinguidos por resultado->tipo) en un solo
     * arreglo listo para pintar en la pestaña "Tests realizados".
     */
    private function testsDe($usuario): array
    {
        return $usuario->tests()
            ->orderByDesc('fecha_realizacion')
            ->get()
            ->map(function (Test $test) {
                $resultado = $test->resultado ?? [];
                $tipo      = $resultado['tipo'] ?? 'diagnostico';

                if ($tipo === 'ishihara') {
                    $ia = $resultado['resultado_ia'] ?? [];

                    return [
                        'id'      => $test->id_test,
                        'tipo'    => 'ishihara',
                        'etiqueta' => 'Test de Ishihara',
                        'titulo'  => $ia['titulo'] ?? 'Test de Ishihara',
                        'fecha'   => $test->fecha_realizacion?->format('d/m/Y') ?? '—',
                        'detalle' => ($resultado['aciertos'] ?? 0) . ' de ' . ($resultado['total_laminas'] ?? 0) . ' láminas correctas',
                        'nivel'   => $ia['nivel'] ?? null,
                        'rutaPdf'    => route('test-ishihara.enviarPdf', $test->id_test),
                        'rutaDelete' => route('test-ishihara.destroy', $test->id_test),
                    ];
                }

                $ia = $resultado['resultadoIA'] ?? [];

                return [
                    'id'      => $test->id_test,
                    'tipo'    => 'diagnostico',
                    'etiqueta' => 'Diagnóstico visual',
                    'titulo'  => $ia['titulo'] ?? 'Diagnóstico visual',
                    'fecha'   => $test->fecha_realizacion?->format('d/m/Y') ?? '—',
                    'detalle' => $ia['subtitulo'] ?? null,
                    'nivel'   => null,
                    'rutaPdf'    => route('test.enviarPdf', $test->id_test),
                    'rutaDelete' => route('test.destroy', $test->id_test),
                ];
            })
            ->all();
    }

    // ── Guardar la foto, el banner y el marco elegido ─────────────────────────
    // La foto y el banner pueden venir de dos fuentes: una imagen que el
    // usuario sube (foto/banner) o una elección de la galería
    // (avatar_preset/banner_preset). Si llega un archivo subido, este
    // tiene prioridad y se guarda en el disco 'public'; si no, se guarda
    // la elección de la galería.
    public function update(Request $request)
    {
        $marcoKeys   = array_keys(config('apariencia.marcos'));
        $avatarKeys  = array_keys(config('apariencia.avatares'));
        $bannerKeys  = array_keys(config('apariencia.banners'));

        $datos = $request->validate([
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'avatar_preset' => 'nullable|string|in:' . implode(',', $avatarKeys),
            'banner'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'banner_preset' => 'nullable|string|in:' . implode(',', $bannerKeys),
            'marco_perfil'  => 'required|in:' . implode(',', $marcoKeys),
        ], [
            'foto.image'   => 'La foto debe ser una imagen (jpg, png o webp).',
            'foto.max'     => 'La imagen no debe superar 4 MB.',
            'banner.image' => 'El banner debe ser una imagen (jpg, png o webp).',
            'banner.max'   => 'El banner no debe superar 4 MB.',
        ]);

        $usuario = auth()->user();

        if ($request->hasFile('foto')) {
            // Elimina la foto anterior si existía, para no acumular archivos huérfanos.
            if ($usuario->avatar_custom) {
                Storage::disk('public')->delete($usuario->avatar_custom);
            }
            $usuario->avatar_custom = $request->file('foto')->store('avatars', 'public');
            $usuario->avatar_tipo   = 'custom';
        } elseif (!empty($datos['avatar_preset'])) {
            // Si el usuario tenía una foto propia y ahora elige una de la
            // galería, borramos el archivo subido para no dejarlo huérfano.
            if ($usuario->avatar_tipo === 'custom' && $usuario->avatar_custom) {
                Storage::disk('public')->delete($usuario->avatar_custom);
                $usuario->avatar_custom = null;
            }
            $usuario->avatar_preset = $datos['avatar_preset'];
            $usuario->avatar_tipo   = 'preset';
        }

        if ($request->hasFile('banner')) {
            if ($usuario->banner_custom) {
                Storage::disk('public')->delete($usuario->banner_custom);
            }
            $usuario->banner_custom = $request->file('banner')->store('banners', 'public');
            $usuario->banner_tipo   = 'custom';
        } elseif (!empty($datos['banner_preset'])) {
            if ($usuario->banner_tipo === 'custom' && $usuario->banner_custom) {
                Storage::disk('public')->delete($usuario->banner_custom);
                $usuario->banner_custom = null;
            }
            $usuario->banner_perfil = $datos['banner_preset'];
            $usuario->banner_tipo   = 'preset';
        }

        $usuario->marco_perfil = $datos['marco_perfil'];
        $usuario->save();

        return redirect()
            ->route('mi-perfil.show')
            ->with('success', 'Tu perfil se actualizó correctamente.');
    }

    // ── Mostrar la página de preferencias visuales (aparte de Mi Perfil) ─────
    public function preferenciasShow()
    {
        $usuario = auth()->user();
        $perfil  = PerfilVisual::where('id_usuario', $usuario->id_usuario)->first();

        return view('preferencias', [
            'usuario'          => $usuario,
            'perfil'           => $perfil,
            'stats'            => $this->statsDe($usuario),
            'opcionesSexo'     => $this->opcionesSexo,
            'opcionesCara'     => $this->opcionesCara,
            'opcionesProblema' => $this->opcionesProblema,
            'opcionesSintomas' => $this->opcionesSintomas,
            'opcionesColor'    => $this->opcionesColor,
            'opcionesEstetica' => $this->opcionesEstetica,
        ]);
    }

    // ── Guardar las preferencias del perfil visual ────────────────────────────
    public function preferencias(Request $request)
    {
        $datos = $request->validate([
            'edad'            => 'nullable|integer|min:1|max:120',
            'sexo'            => 'nullable|string|in:' . implode(',', $this->opcionesSexo),
            'tipo_cara'       => 'nullable|string|in:' . implode(',', $this->opcionesCara),
            'problema_visual' => 'nullable|string|in:' . implode(',', $this->opcionesProblema),
            'sintomas'        => 'nullable|string|in:' . implode(',', $this->opcionesSintomas),
            'color'           => 'nullable|string|in:' . implode(',', $this->opcionesColor),
            'estetica'        => 'nullable|string|in:' . implode(',', $this->opcionesEstetica),
        ]);

        PerfilVisual::updateOrCreate(
            ['id_usuario' => auth()->id()],
            $datos
        );

        return redirect()
            ->route('preferencias.show')
            ->with('success_preferencias', 'Tus preferencias se guardaron correctamente.');
    }

    // ── Estadísticas reales para la tarjeta de perfil ─────────────────────────
    private function statsDe($usuario): array
    {
        return [
            'tests'       => $usuario->tests()->count(),
            'modelos3d'   => $usuario->modelos3d()->where('favorito', 1)->count(),
            'chats'       => $usuario->chats()->count(),
            'comentarios' => $usuario->comentarios()->count(),
        ];
    }
}