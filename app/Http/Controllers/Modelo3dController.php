<?php

namespace App\Http\Controllers;

use App\Models\Modelo3d;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class Modelo3dController extends Controller
{
    /**
     * Devuelve la lista de nombres de modelos favoritos del usuario
     * autenticado, para pintar el estado inicial de los corazones
     * al cargar la página del catálogo.
     */
    public function misFavoritos(): JsonResponse
    {
        $nombres = Modelo3d::where('id_usuario', auth()->id())
            ->where('favorito', 1)
            ->pluck('nombre');

        return response()->json($nombres);
    }

    /**
     * Marca/desmarca un modelo como favorito para el usuario
     * autenticado. Si no existe el registro, lo crea; si existe,
     * alterna el campo 'favorito'.
     */
    public function toggle(Request $request): JsonResponse
    {
        $datos = $request->validate([
            'nombre'    => ['required', 'string', 'max:100'],
            'categoria' => ['nullable', 'string', 'max:50'],
        ]);

        $modelo = Modelo3d::firstOrNew([
            'id_usuario' => auth()->id(),
            'nombre'     => $datos['nombre'],
        ]);

        if (!$modelo->exists) {
            $modelo->categoria = $datos['categoria'] ?? null;
            $modelo->favorito  = 1;
        } else {
            $modelo->favorito = $modelo->favorito ? 0 : 1;
        }

        $modelo->save();

        return response()->json([
            'success'   => true,
            'favorito'  => (bool) $modelo->favorito,
            'nombre'    => $modelo->nombre,
        ]);
    }
}