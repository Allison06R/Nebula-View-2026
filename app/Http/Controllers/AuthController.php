<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // ── Mostrar formulario de login ──────────────────────────────────────────
    public function showLogin()
    {
        return view('auth.login');
    }

    // ── Procesar login ───────────────────────────────────────────────────────
    public function login(Request $request)
    {
        $request->validate([
            'correo'   => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email'    => $request->correo,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'correo' => 'Correo o contraseña incorrectos.',
        ])->onlyInput('correo');
    }

    // ── Mostrar formulario de registro ───────────────────────────────────────
    public function showRegistro()
    {
        return view('auth.registro');
    }

    // ── Procesar registro ────────────────────────────────────────────────────
    public function registro(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'usuario'  => 'required|string|max:60|unique:users,usuario',
            'correo'   => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'nombre'   => $request->nombre,
            'apellido' => $request->apellido,
            'usuario'  => $request->usuario,
            'email'    => $request->correo,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', '¡Registro exitoso! Bienvenido a Nebula View.');
    }

    // ── Logout ───────────────────────────────────────────────────────────────
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
