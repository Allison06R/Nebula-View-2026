{{-- ─────────────────────────────────────────────────────────────
     Tarjeta de perfil compartida: banner, avatar, nombre, stats
     y navegación entre "Perfil" y "Preferencias".
     Variables esperadas: $usuario, $stats, $activo ('perfil' | 'preferencias')
     ───────────────────────────────────────────────────────────── --}}
@php
  $marcoActual = $usuario->marco_perfil ?? 'ninguno';
@endphp

<div class="mp-card2">
  <div class="mp-card2-banner" id="mpCardBanner"
       @if($usuario->banner_url)
         style="background-image:url('{{ $usuario->banner_url }}');"
       @else
         style="background:{{ $usuario->banner_gradient ?? 'linear-gradient(135deg,#6B2FA0,#9B59B6,#D946EF)' }};"
       @endif>
  </div>

  <div class="mp-card2-body">
    <div class="mp-avatar-ring mp-frame--{{ $marcoActual }} mp-card2-avatar" id="mpCardFrameWrap">
      <div class="mp-avatar-inner" id="mpCardAvatarInner">
        @if($usuario->avatar_url)
          <img src="{{ $usuario->avatar_url }}" alt="Foto de perfil">
        @else
          <div class="mp-avatar-default" style="width:100%;height:100%;">
            @include('partials.mp-icon', ['icon' => 'sparkle'])
          </div>
        @endif
      </div>
    </div>

    <p class="mp-card2-name">{{ $usuario->nombre }}</p>
    <p class="mp-card2-user">@ {{ $usuario->usuario }}</p>

    <div class="mp-card2-stats">
      <div class="mp-card2-stat">
        <span class="mp-card2-stat-num">{{ $stats['tests'] ?? 0 }}</span>
        <span class="mp-card2-stat-label">Tests realizados</span>
      </div>
      <div class="mp-card2-stat">
        <span class="mp-card2-stat-num">{{ $stats['modelos3d'] ?? 0 }}</span>
        <span class="mp-card2-stat-label">Modelos 3D guardados</span>
      </div>
    </div>

    <div class="mp-pillnav">
      <a href="{{ route('mi-perfil.show') }}" class="mp-pill {{ $activo === 'perfil' ? 'mp-pill--active' : '' }}">Perfil</a>
      <a href="{{ route('preferencias.show') }}" class="mp-pill {{ $activo === 'preferencias' ? 'mp-pill--active' : '' }}">Preferencias</a>
    </div>
  </div>
</div>