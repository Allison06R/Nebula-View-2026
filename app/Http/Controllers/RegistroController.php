<?php
 
namespace App\Http\Controllers;
 
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
 
class RegistroController extends Controller
{
    public function index()
    {
        return view('auth.registro');
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'nombre'                => ['required', 'string', 'max:100'],
           
            'usuario'               => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z0-9._-]+$/', Rule::unique('usuario', 'usuario')],
            'correo'                => ['required', 'email', 'max:150', Rule::unique('usuario', 'correo')],
            'password'              => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->uncompromised()],
            'terms'                 => ['accepted'],
        ], [
            'usuario.regex' => 'El nombre de usuario no puede ser un correo ni contener espacios o símbolos especiales (solo letras, números, puntos, guiones y guion bajo).',
        ]);
 
        $nuevoUsuario = Usuario::create([
            'id_admin'   => null,
            'usuario'    => $request->usuario,
            'correo'     => $request->correo,
            'contrasena' => Hash::make($request->password),
            'nombre'     => $request->nombre,
    
            'rol'        => 'usuario',
            'sesion'     => null,
        ]);
 
        // Inicia sesión automáticamente tras registrarse
        Auth::login($nuevoUsuario);
 
        return redirect()->route('home')->with('success', '¡Cuenta creada con éxito! Bienvenido a Nebula View.');
    }
}