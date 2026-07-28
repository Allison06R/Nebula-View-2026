<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MiPerfilController extends Controller
{
    // ── Mostrar la página de apariencia de perfil ────────────────────────────
    public function show()
    {
        $usuario   = auth()->user();
        $avatares  = config('apariencia.avatares');
        $marcos    = config('apariencia.marcos');
        $banners   = config('apariencia.banners');

        return view('mi-perfil', compact('usuario', 'avatares', 'marcos', 'banners'));
    }

    // ── Guardar la foto/avatar, marco y banner elegidos ──────────────────────
    public function update(Request $request)
    {
        $avatarKeys = array_keys(config('apariencia.avatares'));
        $marcoKeys  = array_keys(config('apariencia.marcos'));
        $bannerKeys = array_keys(config('apariencia.banners'));

        $datos = $request->validate([
            'avatar_tipo'   => 'required|in:preset,custom',
            'avatar_preset' => 'required_if:avatar_tipo,preset|nullable|in:' . implode(',', $avatarKeys),
            'foto'          => 'required_if:avatar_tipo,custom|nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'marco_perfil'  => 'required|in:' . implode(',', $marcoKeys),
            'banner_perfil' => 'required|in:' . implode(',', $bannerKeys),
        ], [
            'avatar_preset.required_if' => 'Elige uno de los avatares disponibles.',
            'foto.required_if'          => 'Sube una foto o elige un avatar de la galería.',
            'foto.image'                => 'El archivo debe ser una imagen (jpg, png o webp).',
            'foto.max'                  => 'La imagen no debe superar 4 MB.',
        ]);

        $usuario = auth()->user();

        if ($datos['avatar_tipo'] === 'custom' && $request->hasFile('foto')) {
            // Elimina la foto anterior si existía, para no acumular archivos huérfanos.
            if ($usuario->avatar_custom) {
                Storage::disk('public')->delete($usuario->avatar_custom);
            }
            $ruta = $request->file('foto')->store('avatars', 'public');
            $usuario->avatar_custom = $ruta;
            $usuario->avatar_preset = null;
        } else {
            $usuario->avatar_preset = $datos['avatar_preset'];
        }

        $usuario->avatar_tipo   = $datos['avatar_tipo'];
        $usuario->marco_perfil  = $datos['marco_perfil'];
        $usuario->banner_perfil = $datos['banner_perfil'];
        $usuario->save();

        return redirect()
            ->route('mi-perfil.show')
            ->with('success', 'Tu perfil se actualizó correctamente.');
    }
}