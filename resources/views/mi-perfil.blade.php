@extends('layouts.app')

@section('title', 'Mi Perfil - Nebula View')

@section('css')
<link rel="stylesheet" href="{{ asset('css/Miperfil.css') }}">
@endsection

@section('content')
@php
  $marcoActual = $usuario->marco_perfil ?? 'ninguno';
@endphp

<div class="mp-cosmos">
  <div class="mp-stars"></div>
  <div class="mp-nebula mp-nebula-a"></div>
  <div class="mp-nebula mp-nebula-b"></div>

  <div class="mp-shell" style="max-width:1040px;">

    <h2 class="mp-title">Personaliza tu <em>perfil</em></h2>
    <p class="mp-subtitle">Elige tu foto, un marco y un banner para tu cuenta.</p>

    @if(session('success'))
      <div class="mp-alert mp-alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
      <div class="mp-alert mp-alert-error">
        <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
      </div>
    @endif

    <div class="mp-layout">

      {{-- ───────── Tarjeta de perfil ───────── --}}
      @include('partials.perfil-card', ['activo' => 'perfil'])

      {{-- ───────── Contenido con pestañas ───────── --}}
      <div class="mp-content">

        <div class="mp-tabbar">
          <button type="button" class="mp-tab mp-tab--active" data-tab="apariencia" onclick="mpSwitchTab('apariencia')">Apariencia</button>
          <button type="button" class="mp-tab" data-tab="informacion" onclick="mpSwitchTab('informacion')">Información</button>
        </div>

        {{-- ── Panel: Apariencia ── --}}
        <div class="mp-tabpanel mp-tabpanel--active" id="tab-apariencia">
          <form method="POST" action="{{ route('mi-perfil.update') }}" enctype="multipart/form-data" id="mpForm">
            @csrf

            {{-- Foto de perfil --}}
            <div class="mp-card">
              <div class="mp-section-badge"><span class="mp-section-dot"></span>Foto de perfil</div>
              <h3 class="mp-section-title">Tu foto</h3>
              <p class="mp-section-hint">Elige una foto de la galería o sube la tuya.</p>

              <div class="mp-frame-grid">
                @foreach($avatares as $key => $av)
                  <div class="mp-frame-opt">
                    <input type="radio" name="avatar_preset" id="avatar_{{ $key }}" value="{{ $key }}"
                           {{ $usuario->avatar_tipo === 'preset' && $usuario->avatar_preset == $key ? 'checked' : '' }}
                           onchange="mpSelectAvatarPreset('{{ $key }}', '{{ asset($av['archivo']) }}')">
                    <label for="avatar_{{ $key }}">
                      <span class="mp-frame-demo-wrap">
                        <img src="{{ asset($av['archivo']) }}" alt="{{ $av['nombre'] }}" style="width:58px;height:58px;border-radius:50%;object-fit:cover;display:block;">
                      </span>
                      <span class="mp-frame-label">{{ $av['nombre'] }}</span>
                    </label>
                  </div>
                @endforeach
              </div>

              <p class="mp-section-hint" style="margin-top:1.25rem;">O sube tu propia imagen:</p>
              <label class="mp-dropzone" for="fotoInput" id="mpDropzoneFoto">
                <svg class="mp-dropzone-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 16V4M7 9l5-5 5 5"/><path d="M4 16v3a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-3"/></svg>
                <div class="mp-dropzone-text">Haz clic para elegir una imagen (jpg, png o webp, máx. 4MB)</div>
                <div class="mp-dropzone-filename" id="mpFotoFileName"></div>
              </label>
              <input type="file" name="foto" id="fotoInput" accept="image/png,image/jpeg,image/webp" onchange="mpFotoSeleccionada(this)">
            </div>

            {{-- Marco --}}
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

            {{-- Banner --}}
            <div class="mp-card">
              <div class="mp-section-badge"><span class="mp-section-dot"></span>Banner</div>
              <h3 class="mp-section-title">El fondo de tu perfil</h3>
              <p class="mp-section-hint">Elige un banner de la galería o sube el tuyo.</p>

              <div class="mp-frame-grid">
                @foreach($banners as $key => $bn)
                  <div class="mp-frame-opt">
                    <input type="radio" name="banner_preset" id="banner_{{ $key }}" value="{{ $key }}"
                           {{ $usuario->banner_tipo !== 'custom' && $usuario->banner_perfil == $key ? 'checked' : '' }}
                           onchange="mpSelectBannerPreset('{{ $key }}', `{{ $bn['gradiente'] }}`)">
                    <label for="banner_{{ $key }}">
                      <span class="mp-frame-demo-wrap">
                        <span style="display:block;width:78px;height:44px;border-radius:10px;background:{{ $bn['gradiente'] }};"></span>
                      </span>
                      <span class="mp-frame-label">{{ $bn['nombre'] }}</span>
                    </label>
                  </div>
                @endforeach
              </div>

              <p class="mp-section-hint" style="margin-top:1.25rem;">O sube tu propia imagen:</p>
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
        </div>

        {{-- ── Panel: Información ── --}}
        <div class="mp-tabpanel" id="tab-informacion">
          <div class="mp-card">
            <div class="mp-section-badge"><span class="mp-section-dot"></span>Información</div>
            <h3 class="mp-section-title">Datos de tu cuenta</h3>
            <p class="mp-section-hint">Esta es la información con la que te registraste.</p>

            <div class="mp-info-row">
              <span class="mp-info-label">Nombre</span>
              <span class="mp-info-value">{{ $usuario->nombre }}</span>
            </div>
            <div class="mp-info-row">
              <span class="mp-info-label">Usuario</span>
              <span class="mp-info-value">@ {{ $usuario->usuario }}</span>
            </div>
            <div class="mp-info-row">
              <span class="mp-info-label">Correo electrónico</span>
              <span class="mp-info-value">{{ $usuario->correo }}</span>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>
</div>
@endsection

@section('scripts')
<script>
function mpFotoSeleccionada(input) {
  if (!input.files || !input.files[0]) return;
  document.getElementById('mpFotoFileName').textContent = input.files[0].name;

  // Subir un archivo tiene prioridad sobre la galería: deseleccionamos
  // cualquier avatar de galería que estuviera marcado.
  document.querySelectorAll('input[name="avatar_preset"]').forEach(r => r.checked = false);

  const reader = new FileReader();
  reader.onload = function (e) {
    const wrap = document.getElementById('mpCardAvatarInner');
    wrap.innerHTML = '<img src="' + e.target.result + '" style="width:100%;height:100%;object-fit:cover;">';
  };
  reader.readAsDataURL(input.files[0]);
}

function mpBannerSeleccionada(input) {
  if (!input.files || !input.files[0]) return;
  document.getElementById('mpBannerFileName').textContent = input.files[0].name;

  document.querySelectorAll('input[name="banner_preset"]').forEach(r => r.checked = false);

  const reader = new FileReader();
  reader.onload = function (e) {
    const banner = document.getElementById('mpCardBanner');
    banner.style.background = 'none';
    banner.style.backgroundImage = 'url(' + e.target.result + ')';
    banner.style.backgroundSize = 'cover';
    banner.style.backgroundPosition = 'center';
  };
  reader.readAsDataURL(input.files[0]);
}

function mpSelectAvatarPreset(key, url) {
  // Elegir una foto de la galería cancela cualquier archivo que
  // estuviera a punto de subirse, para que gane la elección visible.
  document.getElementById('fotoInput').value = '';
  document.getElementById('mpFotoFileName').textContent = '';

  const wrap = document.getElementById('mpCardAvatarInner');
  wrap.innerHTML = '<img src="' + url + '" style="width:100%;height:100%;object-fit:cover;">';
}

function mpSelectBannerPreset(key, gradiente) {
  document.getElementById('bannerInput').value = '';
  document.getElementById('mpBannerFileName').textContent = '';

  const banner = document.getElementById('mpCardBanner');
  banner.style.backgroundImage = 'none';
  banner.style.background = gradiente;
}

function mpSelectFrame(key) {
  const frameWrap = document.getElementById('mpCardFrameWrap');
  frameWrap.className = 'mp-avatar-ring mp-frame--' + key + ' mp-card2-avatar';
}

function mpSwitchTab(tab) {
  document.querySelectorAll('.mp-tab').forEach(btn => {
    btn.classList.toggle('mp-tab--active', btn.dataset.tab === tab);
  });
  document.querySelectorAll('.mp-tabpanel').forEach(panel => {
    panel.classList.toggle('mp-tabpanel--active', panel.id === 'tab-' + tab);
  });
}
</script>
@endsection