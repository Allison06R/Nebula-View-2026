<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\PerfilVisual;

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
        ]);
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
            'tests'     => $usuario->tests()->count(),
            'modelos3d' => $usuario->modelos3d()->count(),
        ];
    }
}