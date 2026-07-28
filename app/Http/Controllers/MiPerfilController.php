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

    // ── Mostrar la página de perfil (apariencia + preferencias) ──────────────
    public function show()
    {
        $usuario = auth()->user();
        $marcos  = config('apariencia.marcos');
        $perfil  = PerfilVisual::where('id_usuario', $usuario->id_usuario)->first();

        return view('mi-perfil', [
            'usuario'          => $usuario,
            'marcos'           => $marcos,
            'perfil'           => $perfil,
            'opcionesSexo'     => $this->opcionesSexo,
            'opcionesCara'     => $this->opcionesCara,
            'opcionesProblema' => $this->opcionesProblema,
            'opcionesSintomas' => $this->opcionesSintomas,
            'opcionesColor'    => $this->opcionesColor,
            'opcionesEstetica' => $this->opcionesEstetica,
        ]);
    }

    // ── Guardar la foto, el banner y el marco elegido ─────────────────────────
    public function update(Request $request)
    {
        $marcoKeys = array_keys(config('apariencia.marcos'));

        $datos = $request->validate([
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'banner'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'marco_perfil' => 'required|in:' . implode(',', $marcoKeys),
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
        }

        if ($request->hasFile('banner')) {
            if ($usuario->banner_custom) {
                Storage::disk('public')->delete($usuario->banner_custom);
            }
            $usuario->banner_custom = $request->file('banner')->store('banners', 'public');
        }

        $usuario->marco_perfil = $datos['marco_perfil'];
        $usuario->save();

        return redirect()
            ->route('mi-perfil.show')
            ->with('success', 'Tu perfil se actualizó correctamente.');
    }

    // ── Guardar las preferencias del perfil visual (antes página aparte) ─────
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
            ->route('mi-perfil.show')
            ->with('success_preferencias', 'Tus preferencias se guardaron correctamente.');
    }
}
