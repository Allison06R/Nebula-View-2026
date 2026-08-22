<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Illuminate\View\View;

class PasswordResetController extends Controller
{
    // ── Muestra el formulario para pedir el enlace de restablecimiento ──────
    public function showLinkRequestForm(): View
    {
        return view('auth.olvide-password');
    }

    // ── Envía el correo con el enlace de restablecimiento ───────────────────
    public function sendResetLinkEmail(Request $request): RedirectResponse
    {
        $request->validate([
            'correo' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink(
            $request->only('correo')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', 'Si el correo existe en Nebula View, te enviamos un enlace para restablecer tu contraseña.')
            // Mensaje genérico también cuando el correo no existe, para no
            // revelar qué correos están registrados (evita user enumeration).
            : back()->with('success', 'Si el correo existe en Nebula View, te enviamos un enlace para restablecer tu contraseña.');
    }

    // ── Muestra el formulario para elegir la nueva contraseña ───────────────
    public function showResetForm(string $token, Request $request): View
    {
        return view('auth.restablecer-password', [
            'token'  => $token,
            'correo' => $request->query('correo', ''),
        ]);
    }

    // ── Guarda la nueva contraseña ───────────────────────────────────────────
    public function reset(Request $request): RedirectResponse
    {
        $request->validate([
            'token'    => ['required'],
            'correo'   => ['required', 'email'],
            'password' => [
                'required',
                'confirmed',
                PasswordRule::min(8)->mixedCase()->numbers()->uncompromised(),
            ],
        ]);

        $status = Password::reset(
            $request->only('correo', 'password', 'password_confirmation', 'token'),
            function ($usuario, $password) {
                $usuario->forceFill([
                    'contrasena' => Hash::make($password),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'Tu contraseña se actualizó correctamente. Ya puedes iniciar sesión.')
            : back()->withErrors(['correo' => __($status)]);
    }
}
