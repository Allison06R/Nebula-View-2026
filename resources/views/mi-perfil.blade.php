@extends('layouts.app')

@section('title', 'Mi Perfil - Nebula View')

@section('css')
<link rel="stylesheet" href="{{ asset('css/miperfil.css') }}">
@endsection

@section('content')
@php
  $marcoActual = $usuario->marco_perfil ?? 'ninguno';
  $p = $perfil;
@endphp

<div class="mp-cosmos">
  <div class="mp-stars"></div>
  <div class="mp-nebula mp-nebula-a"></div>
  <div class="mp-nebula mp-nebula-b"></div>

  <div class="mp-shell">

    <h2 class="mp-title">Personaliza tu <em>perfil</em></h2>
    <p class="mp-subtitle">Elige tu foto, un marco, un banner y cuéntanos tus preferencias visuales.</p>

    @if(session('success'))
      <div class="mp-alert mp-alert-success">{{ session('success') }}</div>
    @endif
    @if(session('success_preferencias'))
      <div class="mp-alert mp-alert-success">{{ session('success_preferencias') }}</div>
    @endif
    @if($errors->any())
      <div class="mp-alert mp-alert-error">
        <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
      </div>
    @endif

    <form method="POST" action="{{ route('mi-perfil.update') }}" enctype="multipart/form-data" id="mpForm">
      @csrf

      {{-- ───────── Vista previa en vivo ───────── --}}
      <div class="mp-preview">
        <div class="mp-banner-preview" id="mpBannerPreview">
          @if($usuario->banner_url)
            <img src="{{ $usuario->banner_url }}" id="mpBannerImgPreview" alt="Banner de perfil">
          @else
            <div class="mp-banner-default" id="mpBannerImgPreview"></div>
          @endif
        </div>
        <div class="mp-preview-body">
          <div class="mp-avatar-ring mp-frame--{{ $marcoActual }}" id="mpFrameWrap">
            <div class="mp-avatar-inner" id="mpAvatarInnerWrap">
              @if($usuario->avatar_url)
                <img src="{{ $usuario->avatar_url }}" id="mpAvatarImgPreview" alt="Foto de perfil">
              @else
                <div class="mp-avatar-default" style="width:100%;height:100%;">
                  @include('partials.mp-icon', ['icon' => 'sparkle'])
                </div>
              @endif
            </div>
          </div>
          <div class="mp-preview-info">
            <p class="mp-preview-name">{{ $usuario->nombre }}</p>
            <p class="mp-preview-sub">@ {{ $usuario->usuario }}</p>
          </div>
        </div>
      </div>

      {{-- ───────── Foto de perfil ───────── --}}
      <div class="mp-card">
        <div class="mp-section-badge"><span class="mp-section-dot"></span>Foto de perfil</div>
        <h3 class="mp-section-title">Tu foto</h3>
        <p class="mp-section-hint">Sube una imagen para reemplazar la foto predeterminada.</p>

        <label class="mp-dropzone" for="fotoInput" id="mpDropzoneFoto">
          <svg class="mp-dropzone-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 16V4M7 9l5-5 5 5"/><path d="M4 16v3a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-3"/></svg>
          <div class="mp-dropzone-text">Haz clic para elegir una imagen (jpg, png o webp, máx. 4MB)</div>
          <div class="mp-dropzone-filename" id="mpFotoFileName"></div>
        </label>
        <input type="file" name="foto" id="fotoInput" accept="image/png,image/jpeg,image/webp" onchange="mpFotoSeleccionada(this)">
      </div>

      {{-- ───────── Marco ───────── --}}
      <div class="mp-card">
        <div class="mp-section-badge"><span class="mp-section-dot"></span>Marco</div>
        <h3 class="mp-section-title">Decora el borde de tu foto</h3>
        <p class="mp-section-hint">Elige el estilo de marco para tu avatar.</p>

        <div class="mp-frame-grid">
          @foreach($marcos as $key => $label)
            <div class="mp-frame-opt">
              <input type="radio" name="marco_perfil" id="marco_{{ $key }}" value="{{ $key }}"
                     {{ $marcoActual == $key ? 'checked' : '' }}
                     onchange="mpSelectFrame('{{ $key }}')">
              <label for="marco_{{ $key }}">
                <span class="mp-frame-demo-wrap mp-frame--{{ $key }}">
                  <span class="mp-frame-demo"></span>
                </span>
                <span class="mp-frame-label">{{ $label }}</span>
              </label>
            </div>
          @endforeach
        </div>
      </div>

      {{-- ───────── Banner ───────── --}}
      <div class="mp-card">
        <div class="mp-section-badge"><span class="mp-section-dot"></span>Banner</div>
        <h3 class="mp-section-title">El fondo de tu perfil</h3>
        <p class="mp-section-hint">Sube una imagen para reemplazar el banner predeterminado.</p>

        <label class="mp-dropzone" for="bannerInput" id="mpDropzoneBanner">
          <svg class="mp-dropzone-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 16V4M7 9l5-5 5 5"/><path d="M4 16v3a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-3"/></svg>
          <div class="mp-dropzone-text">Haz clic para elegir una imagen (jpg, png o webp, máx. 4MB)</div>
          <div class="mp-dropzone-filename" id="mpBannerFileName"></div>
        </label>
        <input type="file" name="banner" id="bannerInput" accept="image/png,image/jpeg,image/webp" onchange="mpBannerSeleccionada(this)">
      </div>

      <div class="mp-actions">
        <button type="submit" class="mp-btn-save">Guardar cambios</button>
      </div>

    </form>

    {{-- ───────── Mis preferencias (antes "Perfil Visual", página aparte) ───────── --}}
    <div class="mp-card">
      <div class="mp-section-badge"><span class="mp-section-dot"></span>Mis preferencias</div>
      <h3 class="mp-section-title">Tu perfil visual</h3>
      <p class="mp-section-hint">Esta información nos ayuda a personalizar tus recomendaciones de lentes.</p>

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
@endsection

@section('scripts')
<script>
function mpFotoSeleccionada(input) {
  if (!input.files || !input.files[0]) return;
  document.getElementById('mpFotoFileName').textContent = input.files[0].name;

  const reader = new FileReader();
  reader.onload = function (e) {
    const wrap = document.getElementById('mpAvatarInnerWrap');
    wrap.innerHTML = '<img src="' + e.target.result + '" id="mpAvatarImgPreview" style="width:100%;height:100%;object-fit:cover;">';
  };
  reader.readAsDataURL(input.files[0]);
}

function mpBannerSeleccionada(input) {
  if (!input.files || !input.files[0]) return;
  document.getElementById('mpBannerFileName').textContent = input.files[0].name;

  const reader = new FileReader();
  reader.onload = function (e) {
    const wrap = document.getElementById('mpBannerPreview');
    wrap.innerHTML = '<img src="' + e.target.result + '" id="mpBannerImgPreview" style="width:100%;height:100%;object-fit:cover;">';
  };
  reader.readAsDataURL(input.files[0]);
}

function mpSelectFrame(key) {
  const frameWrap = document.getElementById('mpFrameWrap');
  frameWrap.className = 'mp-avatar-ring mp-frame--' + key;
}
</script>
@endsection
