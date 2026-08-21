<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\MiPerfilController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\RostrosController;
use App\Http\Controllers\ChatWidgetController;
use App\Http\Controllers\ContactanosController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\TranslateController;
// ─── Asistente flotante (disponible en todo el sitio) ─────────────────────────
Route::post('/chat-widget', [ChatWidgetController::class, 'send'])->name('chat.widget.send');

// ─── Páginas públicas ────────────────────────────────────────────────────────
Route::get('/',                   fn() => view('home'))->name('home');
Route::get('/problemas-visuales', fn() => view('problemas-visuales'))->name('problemas-visuales');
Route::get('/salud-visual',       fn() => view('salud-visual'))->name('salud-visual');
Route::get('/habitos',            fn() => view('habitos'))->name('habitos');
Route::get('/modelos3d',          fn() => view('modelos3d'))->name('modelos3d')->middleware('noauth');
Route::get('/profesionales',      fn() => view('profesionales'))->name('profesionales');
Route::view('/clinicas', 'clinicas')->name('clinicas');
Route::get('/sobrenosotras',      fn() => view('sobrenosotras'))->name('sobrenosotras');
Route::view('/lentes', 'lentes')->name('lentes');
Route::get('/rostros', [RostrosController::class, 'index'])->name('rostros');
Route::get('/contactanos',  [ContactanosController::class, 'index'])->name('contactanos');
Route::post('/contactanos', [ContactanosController::class, 'enviar'])->name('contactanos.enviar');


// ─── Autenticación ───────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:6,1');

    Route::get('/registro', [RegistroController::class, 'index'])->name('registro');
    Route::post('/registro', [RegistroController::class, 'store'])->middleware('throttle:6,1');

    // ── Olvidé mi contraseña ───────────────────────────────────────────────
    Route::get('/olvide-password', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/olvide-password', [PasswordResetController::class, 'sendResetLinkEmail'])
        ->middleware('throttle:4,1')
        ->name('password.email');
    Route::get('/restablecer-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('/restablecer-password', [PasswordResetController::class, 'reset'])
        ->middleware('throttle:6,1')
        ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// ─── Mi Perfil: foto, marco, banner y preferencias visuales (requiere sesión) ─
Route::middleware('auth')->group(function () {
    Route::get('/mi-perfil',  [MiPerfilController::class, 'show'])->name('mi-perfil.show');
    Route::post('/mi-perfil', [MiPerfilController::class, 'update'])->name('mi-perfil.update');

    Route::get('/mi-perfil/preferencias',  [MiPerfilController::class, 'preferenciasShow'])->name('preferencias.show');
    Route::post('/mi-perfil/preferencias', [MiPerfilController::class, 'preferencias'])->name('mi-perfil.preferencias');

    // Redirecciones de compatibilidad por si algo aún apunta a la página vieja.
    Route::redirect('/perfil-visual', '/mi-perfil');
});

// ─── Test / diagnóstico IA (requiere sesión) ──────────────────────────────────
Route::middleware('noauth')->group(function () {
    Route::get('/test', [TestController::class, 'index'])->name('test');
    Route::post('/test/diagnostico', [TestController::class, 'diagnostico'])->name('test.diagnostico');
    Route::post('/test/chat', [TestController::class, 'chat'])->name('test.chat');

    // ── Historial persistente de tests ─────────────────────────────────────
    Route::post('/test/guardar', [TestController::class, 'guardar'])->name('test.guardar');
    Route::get('/test/historial', [TestController::class, 'historial'])->name('test.historial');
    Route::delete('/test/{test}', [TestController::class, 'destroy'])->name('test.destroy');
    Route::post('/test/{test}/enviar-pdf', [TestController::class, 'enviarPdf'])
        ->middleware('throttle:5,10')
        ->name('test.enviarPdf');
});

// ─── Panel de administración ──────────────────────────────────────────────────
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Usuarios
    Route::get('/usuarios',                  [AdminController::class, 'usuariosIndex'])->name('usuarios.index');
    Route::get('/usuarios/crear',            [AdminController::class, 'usuariosCreate'])->name('usuarios.create');
    Route::post('/usuarios',                 [AdminController::class, 'usuariosStore'])->name('usuarios.store');
    Route::get('/usuarios/{usuario}',        [AdminController::class, 'usuariosShow'])->name('usuarios.show');
    Route::get('/usuarios/{usuario}/editar', [AdminController::class, 'usuariosEdit'])->name('usuarios.edit');
    Route::put('/usuarios/{usuario}',        [AdminController::class, 'usuariosUpdate'])->name('usuarios.update');
    Route::delete('/usuarios/{usuario}',     [AdminController::class, 'usuariosDestroy'])->name('usuarios.destroy');

    // Perfil visual (admin)
    Route::get('/usuarios/{usuario}/perfil',    [AdminController::class, 'perfilEdit'])->name('usuarios.perfil.edit');
    Route::put('/usuarios/{usuario}/perfil',    [AdminController::class, 'perfilUpdate'])->name('usuarios.perfil.update');
    Route::delete('/usuarios/{usuario}/perfil', [AdminController::class, 'perfilDestroy'])->name('usuarios.perfil.destroy');

    // Modelos 3D
    Route::get('/modelos',             [AdminController::class, 'modelosIndex'])->name('modelos.index');
    Route::delete('/modelos/{modelo}', [AdminController::class, 'modelosDestroy'])->name('modelos.destroy');

    // Tests
    Route::get('/tests',           [AdminController::class, 'testsIndex'])->name('tests.index');
    Route::delete('/tests/{test}', [AdminController::class, 'testsDestroy'])->name('tests.destroy');
});

Route::post('/translate', [TranslateController::class, 'translate']);
