<?php

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
route::get('/sobrenosotras',     fn() => view('sobrenosotras'))->name('sobrenosotras');
// ─── Autenticación ───────────────────────────────────────────────────────────
Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',   [AuthController::class, 'login']);
Route::get('/registro', [AuthController::class, 'showRegistro'])->name('registro');
Route::post('/registro',[AuthController::class, 'registro']);
Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');

// ─── Perfil visual (requiere sesión) ─────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/perfil-visual',  [PerfilVisualController::class, 'show'])->name('perfil-visual');
    Route::post('/perfil-visual', [PerfilVisualController::class, 'store']);
});
