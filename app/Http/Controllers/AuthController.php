<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
 
    public function login(Request $request)
    {
        $request->validate([
            'correo'   => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);
 
        // Auth::attempt busca por defecto el campo "password" en el array,
        // pero el modelo ya sabe (via getAuthPassword) que debe comparar
        // contra la columna "contrasena".
        $credentials = [
            'correo'   => $request->correo,
            'password' => $request->password,
        ];
 
        if (Auth::attempt($credentials, $request->boolean('recordar'))) {
            $request->session()->regenerate();
 
            return redirect()->intended(route('home'))
                ->with('success', '¡Bienvenido de nuevo!');
        }
 
        return back()
            ->withErrors(['correo' => 'Correo o contraseña incorrectos.'])
            ->withInput($request->only('correo', 'recordar'));
    }
 
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
 
        return redirect()->route('home');
    }
}
 