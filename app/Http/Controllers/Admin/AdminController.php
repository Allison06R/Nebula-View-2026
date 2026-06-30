<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\PerfilVisual;
use App\Models\Modelo3d;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // ── DASHBOARD ────────────────────────────────────────────────────────
    public function dashboard()
    {
        $totalUsuarios = Usuario::count();
        $totalPerfiles = PerfilVisual::count();
        $totalModelos  = Modelo3d::count();
        $totalTests    = Test::count();
        $recientes     = Usuario::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsuarios', 'totalPerfiles', 'totalModelos', 'totalTests', 'recientes'
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

        $usuarios = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

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
            'password' => 'required|min:6|confirmed',
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
            'password' => 'nullable|min:6|confirmed',
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
        PerfilVisual::updateOrCreate(
            ['id_usuario' => $usuario->id_usuario],
            [
                'tipo_cara'       => $request->tipo_cara,
                'edad'            => $request->edad,
                'sexo'            => $request->sexo,
                'problema_visual' => $request->problema_visual,
                'sintomas'        => $request->sintomas,
                'color'           => $request->color,
                'estetica'        => $request->estetica,
            ]
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