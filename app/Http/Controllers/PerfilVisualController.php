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
            'problema_visual' => 'nullable|string|max:100',
            'sintomas'        => 'nullable|string|max:255',
            'color'           => 'nullable|string|max:50',
            'estetica'        => 'nullable|string|max:100',
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