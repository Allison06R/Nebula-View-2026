<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerfilVisual;

class PerfilVisualController extends Controller
{
    // ── Mostrar formulario del perfil visual ─────────────────────────────────
    public function show()
    {
        return view('perfil-visual');
    }

    // ── Guardar perfil visual del usuario ────────────────────────────────────
    public function store(Request $request)
    {
        $request->validate([
            'edad'        => 'required|integer|min:1|max:120',
            'sexo'        => 'required|string',
            'ocupacion'   => 'required|string|max:100',
            'cara'        => 'required|string',
            'sintomas'    => 'nullable|string',
            'frecuencia'  => 'nullable|string',
            'desde'       => 'nullable|string',
            'problema'    => 'nullable|string',
            'lentes'      => 'nullable|string',
            'revision'    => 'nullable|string',
            'pantalla'    => 'nullable|string',
            'dispositivos'=> 'nullable|string',
            'regla'       => 'nullable|string',
            'uv'          => 'nullable|string',
            'sueno'       => 'nullable|string',
        ]);

        PerfilVisual::updateOrCreate(
            ['usuario_id' => auth()->id()],
            [
                'edad'         => $request->edad,
                'sexo'         => $request->sexo,
                'ocupacion'    => $request->ocupacion,
                'cara'         => $request->cara,
                'sintomas'     => $request->sintomas,
                'frecuencia'   => $request->frecuencia,
                'desde_tiempo' => $request->desde,
                'problema'     => $request->problema,
                'lentes'       => $request->lentes,
                'revision'     => $request->revision,
                'pantalla'     => $request->pantalla,
                'dispositivos' => $request->dispositivos,
                'regla'        => $request->regla,
                'uv'           => $request->uv,
                'sueno'        => $request->sueno,
            ]
        );

        return redirect()->back()->with('success', 'Perfil visual guardado correctamente.');
    }
}
