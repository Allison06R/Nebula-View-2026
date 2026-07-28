@extends('layouts.app')

@section('title', 'Mi Perfil - Nebula View')

@section('css')
<link rel="stylesheet" href="{{ asset('css/miperfil.css') }}">
@endsection

@section('content')
@php
  $avatarActual = $usuario->avatar_preset ?? 'nebulosa';
  $marcoActual  = $usuario->marco_perfil ?? 'ninguno';
  $bannerActual = $usuario->banner_perfil ?? 'nebula';
  $esCustom     = $usuario->avatar_tipo === 'custom';
@endphp

<div class="mp-cosmos">
  <div class="mp-stars"></div>
  <div class="mp-nebula mp-nebula-a"></div>
  <div class="mp-nebula mp-nebula-b"></div>

  <div class="mp-shell">

    <h2 class="mp-title">Personaliza tu <em>perfil</em></h2>
    <p class="mp-subtitle">Elige tu foto, un marco y un banner para tu perfil de Nebula View.</p>

    @if(session('success'))
      <div class="mp-alert mp-alert-success">{{ session('success') }}</div>
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
        <div class="mp-banner-preview mp-banner--{{ $bannerActual }}" id="mpBannerPreview"></div>
        <div class="mp-preview-body">
          <div class="mp-avatar-ring mp-frame--{{ $marcoActual }}" id="mpFrameWrap">
            <div class="mp-avatar-inner" id="mpAvatarInnerWrap">
              @if($esCustom && $usuario->avatar_url)
                <img src="{{ $usuario->avatar_url }}" id="mpAvatarImgPreview" alt="Foto de perfil">
              @else
                <div class="mp-avatar-swatch mp-avatar--{{ $avatarActual }}" id="mpAvatarSwatchPreview" style="width:100%;height:100%;">
                  @include('partials.mp-icon', ['icon' => $avatares[$avatarActual]['icono'] ?? 'sparkle'])
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

      <input type="hidden" name="avatar_tipo" id="avatarTipoInput" value="{{ $esCustom ? 'custom' : 'preset' }}">

      {{-- ───────── Foto / avatar ───────── --}}
      <div class="mp-card">
        <div class="mp-section-badge"><span class="mp-section-dot"></span>Foto de perfil</div>
        <h3 class="mp-section-title">¿Qué imagen quieres usar?</h3>
        <p class="mp-section-hint">Sube tu propia foto o elige uno de nuestros avatares.</p>

        <div class="mp-tabs">
          <div class="mp-tab {{ $esCustom ? '' : 'active' }}" id="tabGaleria" onclick="mpSetTab('preset')">Galería de avatares</div>
          <div class="mp-tab {{ $esCustom ? 'active' : '' }}" id="tabSubir" onclick="mpSetTab('custom')">Subir mi foto</div>
        </div>

        <div id="panelGaleria" style="{{ $esCustom ? 'display:none' : '' }}">
          <div class="mp-avatar-grid">
            @foreach($avatares as $key => $data)
              <div class="mp-avatar-opt">
                <input type="radio" name="avatar_preset" id="avatar_{{ $key }}" value="{{ $key }}"
                       {{ $avatarActual == $key ? 'checked' : '' }}
                       onchange="mpSelectPreset('{{ $key }}')">
                <label for="avatar_{{ $key }}">
                  <span class="mp-avatar-swatch mp-avatar--{{ $key }}">
                    @include('partials.mp-icon', ['icon' => $data['icono']])
                  </span>
                  <span class="mp-avatar-label">{{ $data['label'] }}</span>
                </label>
              </div>
            @endforeach
          </div>
        </div>

        <div id="panelSubir" style="{{ $esCustom ? '' : 'display:none' }}">
          <label class="mp-dropzone" for="fotoInput" id="mpDropzone">
            <svg class="mp-dropzone-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 16V4M7 9l5-5 5 5"/><path d="M4 16v3a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-3"/></svg>
            <div class="mp-dropzone-text">Haz clic para elegir una imagen (jpg, png o webp, máx. 4MB)</div>
            <div class="mp-dropzone-filename" id="mpFileName"></div>
          </label>
          <input type="file" name="foto" id="fotoInput" accept="image/png,image/jpeg,image/webp" onchange="mpFotoSeleccionada(this)">
        </div>
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
        <h3 class="mp-section-title">Elige el fondo de tu perfil</h3>
        <p class="mp-section-hint">Se mostrará en la parte superior de tu perfil.</p>

        <div class="mp-banner-grid">
          @foreach($banners as $key => $label)
            <div class="mp-banner-opt">
              <input type="radio" name="banner_perfil" id="banner_{{ $key }}" value="{{ $key }}"
                     {{ $bannerActual == $key ? 'checked' : '' }}
                     onchange="mpSelectBanner('{{ $key }}')">
              <label for="banner_{{ $key }}">
                <span class="mp-banner-swatch mp-banner--{{ $key }}"></span>
                <span class="mp-banner-label">{{ $label }}</span>
              </label>
            </div>
          @endforeach
        </div>
      </div>

      <div class="mp-actions">
        <button type="submit" class="mp-btn-save">Guardar cambios</button>
      </div>

    </form>
  </div>
</div>
@endsection

@section('scripts')
<script>
function mpSetTab(tipo) {
  document.getElementById('avatarTipoInput').value = tipo;
  document.getElementById('tabGaleria').classList.toggle('active', tipo === 'preset');
  document.getElementById('tabSubir').classList.toggle('active', tipo === 'custom');
  document.getElementById('panelGaleria').style.display = tipo === 'preset' ? 'block' : 'none';
  document.getElementById('panelSubir').style.display = tipo === 'custom' ? 'block' : 'none';

  if (tipo === 'custom') {
    // Si aún no hay foto elegida, el avatar de preview se mantiene hasta que suban una.
  } else {
    mpRestorePresetPreview();
  }
}

function mpRestorePresetPreview() {
  const checked = document.querySelector('input[name="avatar_preset"]:checked');
  if (checked) mpSelectPreset(checked.value);
}

function mpSelectPreset(key) {
  document.getElementById('avatarTipoInput').value = 'preset';
  const wrap = document.getElementById('mpAvatarInnerWrap');
  const swatchHtml = document.querySelector('#avatar_' + key).closest('.mp-avatar-opt').querySelector('.mp-avatar-swatch').innerHTML;
  const classes = document.querySelector('#avatar_' + key).closest('.mp-avatar-opt').querySelector('.mp-avatar-swatch').className;
  wrap.innerHTML = '<div class="' + classes + '" style="width:100%;height:100%;">' + swatchHtml + '</div>';
}

function mpFotoSeleccionada(input) {
  if (!input.files || !input.files[0]) return;
  document.getElementById('avatarTipoInput').value = 'custom';
  document.getElementById('mpFileName').textContent = input.files[0].name;

  const reader = new FileReader();
  reader.onload = function (e) {
    const wrap = document.getElementById('mpAvatarInnerWrap');
    wrap.innerHTML = '<img src="' + e.target.result + '" style="width:100%;height:100%;object-fit:cover;">';
  };
  reader.readAsDataURL(input.files[0]);
}

function mpSelectFrame(key) {
  const frameWrap = document.getElementById('mpFrameWrap');
  frameWrap.className = 'mp-avatar-ring mp-frame--' + key;
}

function mpSelectBanner(key) {
  document.getElementById('mpBannerPreview').className = 'mp-banner-preview mp-banner--' + key;
}
</script>
@endsection