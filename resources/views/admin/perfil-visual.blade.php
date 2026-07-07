@extends('layouts.app')

@section('title', 'Perfil Visual — Nebula View')

@section('css')
<link rel="stylesheet" href="{{ asset('css/perfilvisual.css') }}">
@endsection

@section('content')

<div class="page-hero">
  <div class="page-hero-bg"></div>
  <div class="hero-accent-rect"></div>
  <div class="page-hero-title">
    <h1>Tu Perfil Visual</h1>
    <div class="breadcrumb"><a>Completa tu información para una experiencia personalizada</a></div>
  </div>
</div>

<div class="page-content" style="max-width:720px;margin:0 auto;padding:2rem 1rem 4rem;">

  @if (session('success'))
    <div style="background:rgba(52,211,153,0.15);border:1px solid rgba(52,211,153,0.4);color:#34d399;padding:1rem 1.2rem;border-radius:12px;margin-bottom:1.5rem;">
      {{ session('success') }}
    </div>
  @endif

  <form method="POST" action="{{ route('perfil-visual.store') }}">
    @csrf

    <div class="sv-section">
      <h3 class="sv-section-title">Datos personales</h3>
      <div class="sv-grid">
        <div class="sv-field">
          <label>Edad</label>
          <input type="number" name="edad" value="{{ old('edad', $perfil->edad ?? '') }}" min="1" max="120" required>
          @error('edad') <span class="sv-error">{{ $message }}</span> @enderror
        </div>
        <div class="sv-field">
          <label>Sexo</label>
          <select name="sexo" required>
            <option value="">Seleccionar...</option>
            @foreach(['Masculino', 'Femenino', 'Otro'] as $opcion)
              <option value="{{ $opcion }}" {{ old('sexo', $perfil->sexo ?? '') == $opcion ? 'selected' : '' }}>{{ $opcion }}</option>
            @endforeach
          </select>
          @error('sexo') <span class="sv-error">{{ $message }}</span> @enderror
        </div>
        <div class="sv-field">
          <label>Forma de tu rostro</label>
          <select name="tipo_cara" required>
            <option value="">Seleccionar...</option>
            @foreach(['Redonda', 'Ovalada', 'Cuadrada', 'Alargada', 'Corazón', 'Diamante'] as $opcion)
              <option value="{{ $opcion }}" {{ old('tipo_cara', $perfil->tipo_cara ?? '') == $opcion ? 'selected' : '' }}>{{ $opcion }}</option>
            @endforeach
          </select>
          @error('tipo_cara') <span class="sv-error">{{ $message }}</span> @enderror
        </div>
      </div>
    </div>

    <div class="sv-section">
      <h3 class="sv-section-title">Salud visual</h3>
      <div class="sv-grid">
        <div class="sv-field">
          <label>Problema visual diagnosticado</label>
          <select name="problema_visual">
            <option value="">Seleccionar...</option>
            @foreach(['Miopía', 'Hipermetropía', 'Astigmatismo', 'Presbicia', 'Ninguno', 'No lo sé'] as $opcion)
              <option value="{{ $opcion }}" {{ old('problema_visual', $perfil->problema_visual ?? '') == $opcion ? 'selected' : '' }}>{{ $opcion }}</option>
            @endforeach
          </select>
        </div>
        <div class="sv-field">
          <label>Síntomas visuales</label>
          <select name="sintomas">
            <option value="">Seleccionar...</option>
            @foreach(['Ninguno', 'Dolor de cabeza', 'Vista borrosa', 'Ojos secos', 'Ardor', 'Fatiga visual'] as $opcion)
              <option value="{{ $opcion }}" {{ old('sintomas', $perfil->sintomas ?? '') == $opcion ? 'selected' : '' }}>{{ $opcion }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>

    <div class="sv-section">
      <h3 class="sv-section-title">Preferencias de estilo</h3>
      <div class="sv-grid">
        <div class="sv-field">
          <label>Color de preferencia para tus lentes</label>
          <select name="color">
            <option value="">Seleccionar...</option>
            @foreach(['Negro', 'Café', 'Azul', 'Transparente', 'Dorado', 'Plateado'] as $opcion)
              <option value="{{ $opcion }}" {{ old('color', $perfil->color ?? '') == $opcion ? 'selected' : '' }}>{{ $opcion }}</option>
            @endforeach
          </select>
        </div>
        <div class="sv-field">
          <label>Estilo estético que prefieres</label>
          <select name="estetica">
            <option value="">Seleccionar...</option>
            @foreach(['Clásico', 'Moderno', 'Deportivo', 'Elegante', 'Minimalista'] as $opcion)
              <option value="{{ $opcion }}" {{ old('estetica', $perfil->estetica ?? '') == $opcion ? 'selected' : '' }}>{{ $opcion }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>

    <button type="submit" style="width:100%;padding:1rem;background:linear-gradient(135deg,#7b4fcf,#c084fc);border:none;border-radius:14px;color:#fff;font-size:1.05rem;font-weight:600;cursor:pointer;margin-top:1rem;transition:opacity .2s;">
      Guardar perfil visual
    </button>
  </form>
</div>

@endsection

@section('css')
@parent
<style>
.sv-section { margin-bottom: 2rem; }
.sv-section-title { font-family: 'Playfair Display', serif; font-size: 1.2rem; margin-bottom: 1rem; color: #c084fc; }
.sv-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
.sv-full { grid-column: 1 / -1; }
.sv-field label { display: block; font-size: 0.85rem; color: rgba(255,255,255,0.7); margin-bottom: 0.4rem; }
.sv-field input, .sv-field select { width: 100%; padding: 0.65rem 0.9rem; border-radius: 10px; border: 1px solid rgba(255,255,255,0.15); background: rgba(255,255,255,0.06); color: #fff; font-size: 0.9rem; outline: none; transition: border .2s; box-sizing: border-box; }
.sv-field input:focus, .sv-field select:focus { border-color: #7b4fcf; }
.sv-field select option { background: #1e1b4b; }
.sv-error { color: #f87171; font-size: 0.8rem; }
@media(max-width:600px){ .sv-grid { grid-template-columns: 1fr; } }
</style>
@endsection