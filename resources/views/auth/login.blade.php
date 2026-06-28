@extends('layouts.auth')
@section('title', 'Inicio de Sesión — Nebula View')

@section('css')
<link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
<style>
/* Override layout.css para esta página */
body {
  background: linear-gradient(160deg, #EDE7F6 0%, #F3EAFF 40%, #EAD9FF 100%) !important;
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}
footer.lc-footer {
  background: #1A0A2E !important;
  padding: 60px 60px 30px !important;
}
.toast { ... }
</style>
@endsection

@section('content')

<main class="login-wrapper">
  <div class="nv-wrap">

    <div class="nv-left">
      <div class="lv-orb lv-orb1"></div>
      <div class="lv-orb lv-orb2"></div>

      <div class="nv-title">Bienvenido de nuevo a Nebula View</div>
      <div class="nv-sub">Inicia sesión para poder acceder a la página completa.</div>

      <form method="POST" action="{{ route('login') }}" id="loginForm">
        @csrf

        <div class="field">
          <label>Correo electrónico</label>
          <div class="field-wrap">
            <svg class="field-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#7c3aed" stroke-width="1.8">
              <rect x="2" y="4" width="20" height="16" rx="2"/>
              <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
            </svg>
            <input type="email" name="correo" placeholder="hola@nebula.com" required value="{{ old('correo') }}"/>
          </div>
        </div>

        <div class="field">
          <label>Contraseña</label>
          <div class="field-wrap">
            <svg class="field-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#7c3aed" stroke-width="1.8">
              <rect x="3" y="11" width="18" height="11" rx="2"/>
              <circle cx="12" cy="16" r="1"/>
              <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
            </svg>
            <input type="password" name="password" placeholder="••••••••" required/>
          </div>
        </div>

        <div class="row-opts">
          <label class="remember">
            <input type="checkbox" name="recordar"/>
            Recordarme
          </label>
          <span class="forgot">¿Olvidaste tu contraseña?</span>
        </div>

        <button type="submit" class="btn-login">
          <div class="shine"></div>
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
            <polyline points="10 17 15 12 10 7"/>
            <line x1="15" y1="12" x2="3" y2="12"/>
          </svg>
          Iniciar sesión
        </button>

        <div class="signup-row">
          ¿Nuevo en Nebula? <a href="{{ route('registro') }}">Crea una cuenta</a>
        </div>

      </form>
    </div>

    <div class="nv-right">
      <div class="orb orb1"></div>
      <div class="orb orb2"></div>
      <div class="eye-logo">
        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.8">
          <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
          <circle cx="12" cy="12" r="3"/>
        </svg>
      </div>
      <div class="nv-brand">NEBULA VIEW</div>
      <div class="nv-tagline">Explora el universo visual con una perspectiva completamente nueva.</div>
      <div class="nv-dots">
        <div class="nv-dot on"></div>
        <div class="nv-dot"></div>
        <div class="nv-dot"></div>
      </div>
    </div>

  </div>
</main>

<!-- TOAST -->
<div class="toast" id="toast">
  <div class="t-ico" id="t-ico">✓</div>
  <div class="t-txt">
    <b id="t-title">Listo</b>
    <span id="t-msg">Acción completada.</span>
  </div>
</div>

@endsection

@section('scripts')
<script>
function doToast(type, title, msg) {
  const toast = document.getElementById('toast');
  document.getElementById('t-ico').textContent   = type === 'ok' ? '✓' : '✕';
  document.getElementById('t-title').textContent = title;
  document.getElementById('t-msg').textContent   = msg;
  toast.classList.remove('toast-ok', 'toast-err', 'show');
  toast.classList.add(type === 'ok' ? 'toast-ok' : 'toast-err');
  requestAnimationFrame(() => requestAnimationFrame(() => toast.classList.add('show')));
  setTimeout(() => toast.classList.remove('show'), 4000);
}

@if ($errors->any())
  document.addEventListener('DOMContentLoaded', function () {
    doToast('err', 'Error', '{{ $errors->first() }}');
  });
@endif

@if (session('success'))
  document.addEventListener('DOMContentLoaded', function () {
    doToast('ok', 'Éxito', '{{ session('success') }}');
  });
@endif
</script>
@endsection