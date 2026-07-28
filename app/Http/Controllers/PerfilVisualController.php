<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerfilVisual;

class PerfilVisualController extends Controller
{
    // ── Guardar / actualizar las preferencias del perfil visual ──────────────
    // Este formulario ahora vive dentro de "Mi Perfil" (sección "Mis
    // preferencias"), ya no es una página aparte.
    public function store(Request $request)
    {
        $datos = $request->validateWithBag('preferencias', [
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
            ->route('mi-perfil.show')
            ->with('success_preferencias', 'Tus preferencias se guardaron correctamente.');
    }
}