<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\PerfilVisual;
use App\Models\Modelo3d;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    // ── DASHBOARD ────────────────────────────────────────────────────────
    public function dashboard()
    {
        $totalUsuarios = Usuario::count();
        $totalPerfiles = PerfilVisual::count();
        $totalModelos  = Modelo3d::count();
        $totalTests    = Test::count();
        $recientes     = Usuario::orderByDesc('id_usuario')->take(5)->get();

        // Métricas reales para los chips de tendencia (últimos 7 días)
        $adminsCount    = Usuario::where('rol', 'admin')->count();
        $usuariosCount  = $totalUsuarios - $adminsCount;
        $perfilesSemana = PerfilVisual::where('created_at', '>=', now()->subDays(7))->count();
        $modelosSemana  = Modelo3d::where('created_at', '>=', now()->subDays(7))->count();
        $testsSemana    = Test::where('created_at', '>=', now()->subDays(7))->count();

        return view('admin.dashboard', compact(
            'totalUsuarios', 'totalPerfiles', 'totalModelos', 'totalTests', 'recientes',
            'adminsCount', 'usuariosCount', 'perfilesSemana', 'modelosSemana', 'testsSemana'
        ));
    }

    // ── USUARIOS ─────────────────────────────────────────────────────────
    public function usuariosIndex(Request $request)
    {
        $query = Usuario::with('perfilVisual');

        if ($request->filled('buscar')) {
            $b = $request->buscar;
            $query->where(function ($q) use ($b) {
                $q->where('nombre', 'like', "%{$b}%")
                  ->orWhere('usuario', 'like', "%{$b}%")
                  ->orWhere('correo', 'like', "%{$b}%");
            });
        }

        if ($request->filled('rol')) {
            $query->where('rol', $request->rol);
        }

        $usuarios = $query->orderByDesc('id_usuario')->paginate(10)->withQueryString();

        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function usuariosShow(Usuario $usuario)
    {
        $usuario->load('perfilVisual', 'modelos3d', 'tests');
        return view('admin.usuarios.show', compact('usuario'));
    }

    public function usuariosCreate()
    {
        return view('admin.usuarios.create');
    }

    public function usuariosStore(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:100',
            'usuario'  => 'required|string|max:50|unique:usuario,usuario',
            'correo'   => 'required|email|max:100|unique:usuario,correo',
            'rol'      => 'required|in:admin,usuario',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->uncompromised()],
        ]);

        Usuario::create([
            'nombre'     => $request->nombre,
            'usuario'    => $request->usuario,
            'correo'     => $request->correo,
            'rol'        => $request->rol,
            'contrasena' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    public function usuariosEdit(Usuario $usuario)
    {
        return view('admin.usuarios.edit', compact('usuario'));
    }

    public function usuariosUpdate(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombre'  => 'required|string|max:100',
            'usuario' => 'required|string|max:50|unique:usuario,usuario,' . $usuario->id_usuario . ',id_usuario',
            'correo'  => 'required|email|max:100|unique:usuario,correo,' . $usuario->id_usuario . ',id_usuario',
            'rol'     => 'required|in:admin,usuario',
            'password' => ['nullable', 'confirmed', Password::min(8)->mixedCase()->numbers()->uncompromised()],
        ]);

        $usuario->nombre  = $request->nombre;
        $usuario->usuario = $request->usuario;
        $usuario->correo  = $request->correo;
        $usuario->rol     = $request->rol;

        if ($request->filled('password')) {
            $usuario->contrasena = Hash::make($request->password);
        }

        $usuario->save();

        return redirect()->route('admin.usuarios.show', $usuario)
            ->with('success', 'Usuario actualizado correctamente.');
    }

    public function usuariosDestroy(Usuario $usuario)
    {
        $usuario->delete();
        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }

    // ── PERFIL VISUAL 
    public function perfilEdit(Usuario $usuario)
    {
        $perfil = $usuario->perfilVisual;
        return view('admin.usuarios.perfil-edit', compact('usuario', 'perfil'));
    }

    public function perfilUpdate(Request $request, Usuario $usuario)
    {
        $datos = $request->validate([
            'tipo_cara'       => 'required|string|max:50',
            'edad'            => 'required|integer|min:1|max:120',
            'sexo'            => 'required|string|max:20',
            'problema_visual' => 'required|string|max:100',
            'sintomas'        => 'required|string|max:255',
            'color'           => 'required|string|max:50',
            'estetica'        => 'required|string|max:100',
        ]);

        PerfilVisual::updateOrCreate(
            ['id_usuario' => $usuario->id_usuario],
            $datos
        );

        return redirect()->route('admin.usuarios.show', $usuario)
            ->with('success', 'Perfil visual actualizado.');
    }

    public function perfilDestroy(Usuario $usuario)
    {
        $usuario->perfilVisual()->delete();
        return redirect()->route('admin.usuarios.show', $usuario)
            ->with('success', 'Perfil visual eliminado.');
    }

    // ── MODELOS 3D 
    public function modelosIndex(Request $request)
    {
        $query = Modelo3d::with('usuario');

        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        $modelos = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('admin.modelos.index', compact('modelos'));
    }

    public function modelosDestroy(Modelo3d $modelo)
    {
        $modelo->delete();
        return back()->with('success', 'Modelo eliminado.');
    }

    // ── TESTS 
    public function testsIndex(Request $request)
    {
        $query = Test::with('usuario');

        if ($request->filled('buscar')) {
            $query->whereHas('usuario', function ($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->buscar . '%');
            });
        }

        $tests = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('admin.tests.index', compact('tests'));
    }

    public function testsDestroy(Test $test)
    {
        $test->delete();
        return back()->with('success', 'Test eliminado.');
    }
}