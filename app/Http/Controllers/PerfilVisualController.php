<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerfilVisual;

class PerfilVisualController extends Controller
{
    // ── Mostrar formulario del perfil visual ─────────────────────────────────
    public function show()
    {
      
        $perfil = PerfilVisual::where('id_usuario', auth()->id())->first();

        return view('perfil-visual', compact('perfil'));
    }

    // ── Guardar / actualizar perfil visual del usuario ───────────────────────
    public function store(Request $request)
    {
        $datos = $request->validate([
            'edad'            => 'required|integer|min:1|max:120',
            'sexo'            => 'required|string|max:20',
            'tipo_cara'       => 'required|string|max:50',
            'problema_visual' => 'required|string|max:100',
            'sintomas'        => 'required|string|max:255',
            'color'           => 'required|string|max:50',
            'estetica'        => 'required|string|max:100',
        ], [
            'problema_visual.required' => 'Selecciona un problema visual diagnosticado.',
            'sintomas.required'        => 'Selecciona un síntoma visual frecuente.',
            'color.required'           => 'Selecciona un color de preferencia.',
            'estetica.required'        => 'Selecciona un estilo estético.',
        ]);

        PerfilVisual::updateOrCreate(
            ['id_usuario' => auth()->id()],
            $datos
        );

        return redirect()
            ->route('perfil-visual.show')
            ->with('success', 'Perfil visual guardado correctamente.');
    }
}