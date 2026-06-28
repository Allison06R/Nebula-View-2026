@extends('layouts.app')

@section('title', 'Perfil Visual — Nebula View')

@section('css')
<link rel="stylesheet" href="{{ asset('css/registroSV.css') }}">
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

  <form method="POST" action="{{ route('perfil-visual') }}">
    @csrf

    <div class="sv-section">
      <h3 class="sv-section-title">Datos personales</h3>
      <div class="sv-grid">
        <div class="sv-field">
          <label>Edad</label>
          <input type="number" name="edad" value="{{ old('edad') }}" min="1" max="120" required>
          @error('edad') <span class="sv-error">{{ $message }}</span> @enderror
        </div>
        <div class="sv-field">
          <label>Sexo</label>
          <select name="sexo">
            <option value="">Seleccionar...</option>
            <option value="masculino" {{ old('sexo') == 'masculino' ? 'selected' : '' }}>Masculino</option>
            <option value="femenino" {{ old('sexo') == 'femenino' ? 'selected' : '' }}>Femenino</option>
            <option value="otro" {{ old('sexo') == 'otro' ? 'selected' : '' }}>Otro</option>
          </select>
        </div>
        <div class="sv-field">
          <label>Ocupación</label>
          <input type="text" name="ocupacion" value="{{ old('ocupacion') }}" placeholder="Ej: Estudiante, Programador...">
        </div>
        <div class="sv-field">
          <label>Forma de cara</label>
          <select name="cara">
            <option value="">Seleccionar...</option>
            <option value="oval">Oval</option>
            <option value="redondo">Redondo</option>
            <option value="cuadrado">Cuadrado</option>
            <option value="corazon">Corazón</option>
            <option value="diamante">Diamante</option>
            <option value="oblongo">Oblongo</option>
          </select>
        </div>
      </div>
    </div>

    <div class="sv-section">
      <h3 class="sv-section-title">Síntomas visuales</h3>
      <div class="sv-grid">
        <div class="sv-field sv-full">
          <label>¿Tienes algún síntoma visual?</label>
          <input type="text" name="sintomas" value="{{ old('sintomas') }}" placeholder="Ej: Visión borrosa, dolor de cabeza...">
        </div>
        <div class="sv-field">
          <label>Frecuencia de síntomas</label>
          <select name="frecuencia">
            <option value="">Seleccionar...</option>
            <option value="nunca">Nunca</option>
            <option value="ocasionalmente">Ocasionalmente</option>
            <option value="frecuentemente">Frecuentemente</option>
            <option value="siempre">Siempre</option>
          </select>
        </div>
        <div class="sv-field">
          <label>¿Desde cuándo?</label>
          <select name="desde">
            <option value="">Seleccionar...</option>
            <option value="menos1">Menos de 1 mes</option>
            <option value="1a6">1 a 6 meses</option>
            <option value="6a12">6 a 12 meses</option>
            <option value="mas1">Más de 1 año</option>
          </select>
        </div>
      </div>
    </div>

    <div class="sv-section">
      <h3 class="sv-section-title">Historia visual</h3>
      <div class="sv-grid">
        <div class="sv-field sv-full">
          <label>¿Tienes algún problema visual diagnosticado?</label>
          <input type="text" name="problema" value="{{ old('problema') }}" placeholder="Ej: Miopía, Astigmatismo...">
        </div>
        <div class="sv-field">
          <label>¿Usas lentes?</label>
          <select name="lentes">
            <option value="">Seleccionar...</option>
            <option value="si">Sí</option>
            <option value="no">No</option>
          </select>
        </div>
        <div class="sv-field">
          <label>Última revisión visual</label>
          <select name="revision">
            <option value="">Seleccionar...</option>
            <option value="menos6m">Menos de 6 meses</option>
            <option value="1año">Hace 1 año</option>
            <option value="mas1">Hace más de 1 año</option>
            <option value="nunca">Nunca</option>
          </select>
        </div>
      </div>
    </div>

    <div class="sv-section">
      <h3 class="sv-section-title">Hábitos digitales</h3>
      <div class="sv-grid">
        <div class="sv-field">
          <label>Horas frente a pantalla al día</label>
          <select name="pantalla">
            <option value="">Seleccionar...</option>
            <option value="menos2">Menos de 2 horas</option>
            <option value="2a4">2 a 4 horas</option>
            <option value="4a8">4 a 8 horas</option>
            <option value="mas8">Más de 8 horas</option>
          </select>
        </div>
        <div class="sv-field">
          <label>Dispositivos más usados</label>
          <input type="text" name="dispositivos" value="{{ old('dispositivos') }}" placeholder="Ej: Computadora, celular...">
        </div>
        <div class="sv-field">
          <label>¿Aplicas la regla 20-20-20?</label>
          <select name="regla">
            <option value="">Seleccionar...</option>
            <option value="si">Sí</option>
            <option value="no">No</option>
            <option value="aveces">A veces</option>
          </select>
        </div>
        <div class="sv-field">
          <label>¿Usas protección UV?</label>
          <select name="uv">
            <option value="">Seleccionar...</option>
            <option value="si">Sí</option>
            <option value="no">No</option>
            <option value="aveces">A veces</option>
          </select>
        </div>
        <div class="sv-field">
          <label>Horas de sueño por noche</label>
          <select name="sueno">
            <option value="">Seleccionar...</option>
            <option value="menos6">Menos de 6 horas</option>
            <option value="6a7">6 a 7 horas</option>
            <option value="7a9">7 a 9 horas</option>
            <option value="mas9">Más de 9 horas</option>
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
