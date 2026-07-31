@extends('layouts.app')

@section('title', 'Preferencias - Nebula View')

@section('css')
<link rel="stylesheet" href="{{ asset('css/Miperfil.css') }}">
@endsection

@section('content')
@php
  $p = $perfil;
@endphp

<div class="mp-cosmos">
  <div class="mp-stars"></div>
  <div class="mp-nebula mp-nebula-a"></div>
  <div class="mp-nebula mp-nebula-b"></div>

  <div class="mp-shell" style="max-width:1040px;">

    <h2 class="mp-title">Tus <em>preferencias</em></h2>
    <p class="mp-subtitle">Esta información nos ayuda a personalizar tus recomendaciones de lentes.</p>

    @if(session('success_preferencias'))
      <div class="mp-alert mp-alert-success">{{ session('success_preferencias') }}</div>
    @endif
    @if($errors->any())
      <div class="mp-alert mp-alert-error">
        <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
      </div>
    @endif

    <div class="mp-layout">

      {{-- ───────── Tarjeta de perfil ───────── --}}
      @include('partials.perfil-card', ['activo' => 'preferencias'])

      {{-- ───────── Formulario de preferencias ───────── --}}
      <div class="mp-content">
        <div class="mp-card">
          <div class="mp-section-badge"><span class="mp-section-dot"></span>Mis preferencias</div>
          <h3 class="mp-section-title">Tu perfil visual</h3>
          <p class="mp-section-hint">Cuéntanos un poco sobre ti para recomendarte mejor.</p>

          <form method="POST" action="{{ route('mi-perfil.preferencias') }}" id="mpPrefForm">
            @csrf

            <div class="mp-grid-2">
              <div class="mp-input-wrap">
                <label>Edad</label>
                <input type="number" name="edad" min="1" max="120" placeholder="Ej: 24" value="{{ old('edad', $p->edad ?? '') }}">
              </div>
              <div class="mp-input-wrap">
                <label>Sexo</label>
                <select name="sexo">
                  <option value="">Selecciona...</option>
                  @foreach($opcionesSexo as $op)
                    <option value="{{ $op }}" {{ old('sexo', $p->sexo ?? '') == $op ? 'selected':'' }}>{{ $op }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="mp-input-wrap mp-pref-block">
              <label>Forma de tu rostro</label>
              <div class="mp-chip-grid">
                @foreach($opcionesCara as $i => $op)
                  <div class="mp-chip">
                    <input type="radio" name="tipo_cara" id="cara_{{ $i }}" value="{{ $op }}" {{ old('tipo_cara', $p->tipo_cara ?? '') == $op ? 'checked':'' }}>
                    <label for="cara_{{ $i }}">{{ $op }}</label>
                  </div>
                @endforeach
              </div>
            </div>

            <div class="mp-input-wrap mp-pref-block">
              <label>Problema visual diagnosticado</label>
              <div class="mp-chip-grid">
                @foreach($opcionesProblema as $i => $op)
                  <div class="mp-chip">
                    <input type="radio" name="problema_visual" id="prob_{{ $i }}" value="{{ $op }}" {{ old('problema_visual', $p->problema_visual ?? '') == $op ? 'checked':'' }}>
                    <label for="prob_{{ $i }}">{{ $op }}</label>
                  </div>
                @endforeach
              </div>
            </div>

            <div class="mp-input-wrap mp-pref-block">
              <label>Síntomas visuales frecuentes</label>
              <div class="mp-chip-grid">
                @foreach($opcionesSintomas as $i => $op)
                  <div class="mp-chip">
                    <input type="radio" name="sintomas" id="sint_{{ $i }}" value="{{ $op }}" {{ old('sintomas', $p->sintomas ?? '') == $op ? 'checked':'' }}>
                    <label for="sint_{{ $i }}">{{ $op }}</label>
                  </div>
                @endforeach
              </div>
            </div>

            <div class="mp-input-wrap mp-pref-block">
              <label>Color de preferencia para tus lentes</label>
              <div class="mp-chip-grid">
                @foreach($opcionesColor as $i => $op)
                  <div class="mp-chip">
                    <input type="radio" name="color" id="color_{{ $i }}" value="{{ $op }}" {{ old('color', $p->color ?? '') == $op ? 'checked':'' }}>
                    <label for="color_{{ $i }}">{{ $op }}</label>
                  </div>
                @endforeach
              </div>
            </div>

            <div class="mp-input-wrap">
              <label>Estilo estético que prefieres</label>
              <div class="mp-chip-grid">
                @foreach($opcionesEstetica as $i => $op)
                  <div class="mp-chip">
                    <input type="radio" name="estetica" id="est_{{ $i }}" value="{{ $op }}" {{ old('estetica', $p->estetica ?? '') == $op ? 'checked':'' }}>
                    <label for="est_{{ $i }}">{{ $op }}</label>
                  </div>
                @endforeach
              </div>
            </div>

            <div class="mp-actions">
              <button type="submit" class="mp-btn-save">Guardar preferencias</button>
            </div>
          </form>
        </div>
      </div>

    </div>

  </div>
</div>
@endsection