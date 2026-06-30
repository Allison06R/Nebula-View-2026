<?php
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PerfilVisualController;

// ─── Páginas públicas ────────────────────────────────────────────────────────
Route::get('/',                 fn() => view('home'))->name('home');
Route::get('/problemas-visuales', fn() => view('problemas-visuales'))->name('problemas-visuales');
Route::get('/salud-visual',     fn() => view('salud-visual'))->name('salud-visual');
Route::get('/habitos',          fn() => view('habitos'))->name('habitos');
Route::get('/modelos3d',        fn() => view('modelos3d'))->name('modelos3d');
Route::get('/profesionales',    fn() => view('profesionales'))->name('profesionales');
Route::get('/clinicas',         fn() => view('clinicas'))->name('clinicas');
Route::get('/sobrenosotras',     fn() => view('sobrenosotras'))->name('sobrenosotras');
// ─── Autenticación ───────────────────────────────────────────────────────────
use App\Http\Controllers\RegistroController;
 
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
 
Route::get('/registro', [RegistroController::class, 'index'])->name('registro');
Route::post('/registro', [RegistroController::class, 'store']);
 

// ─── Perfil visual (requiere sesión) ─────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/perfil-visual',  [PerfilVisualController::class, 'show'])->name('perfil-visual');
    Route::post('/perfil-visual', [PerfilVisualController::class, 'store']);
});
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/',  [AdminController::class, 'dashboard'])->name('dashboard');

    // Usuarios
    Route::get('/usuarios',                    [AdminController::class, 'usuariosIndex'])->name('usuarios.index');
    Route::get('/usuarios/crear',              [AdminController::class, 'usuariosCreate'])->name('usuarios.create');
    Route::post('/usuarios',                   [AdminController::class, 'usuariosStore'])->name('usuarios.store');
    Route::get('/usuarios/{usuario}',          [AdminController::class, 'usuariosShow'])->name('usuarios.show');
    Route::get('/usuarios/{usuario}/editar',   [AdminController::class, 'usuariosEdit'])->name('usuarios.edit');
    Route::put('/usuarios/{usuario}',          [AdminController::class, 'usuariosUpdate'])->name('usuarios.update');
    Route::delete('/usuarios/{usuario}',       [AdminController::class, 'usuariosDestroy'])->name('usuarios.destroy');

    // Perfil visual
    Route::get('/usuarios/{usuario}/perfil',       [AdminController::class, 'perfilEdit'])->name('usuarios.perfil.edit');
    Route::put('/usuarios/{usuario}/perfil',       [AdminController::class, 'perfilUpdate'])->name('usuarios.perfil.update');
    Route::delete('/usuarios/{usuario}/perfil',    [AdminController::class, 'perfilDestroy'])->name('usuarios.perfil.destroy');

    // Modelos 3D
    Route::get('/modelos',                  [AdminController::class, 'modelosIndex'])->name('modelos.index');
    Route::delete('/modelos/{modelo}',      [AdminController::class, 'modelosDestroy'])->name('modelos.destroy');

    // Tests
    Route::get('/tests',               [AdminController::class, 'testsIndex'])->name('tests.index');
    Route::delete('/tests/{test}',     [AdminController::class, 'testsDestroy'])->name('tests.destroy');

}
);

    use App\Http\Controllers\TestController;

Route::get('/test', [TestController::class, 'index'])->name('test');
Route::post('/test/diagnostico', [TestController::class, 'diagnostico'])->name('test.diagnostico');
Route::post('/test/chat', [TestController::class, 'chat'])->name('test.chat');
Route::view('/lentes', 'lentes')->name('lentes');
Route::get('/test', [TestController::class, 'index'])->name('test');