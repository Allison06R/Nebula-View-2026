@extends('layouts.app')
@section('title', 'Inicio de Sesión — Nebula View')

@section('css')
<link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
<style>
/* Override layout.css para esta página */
body {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}
footer.lc-footer {
  background: #1A0A2E !important;
  padding: 60px 60px 30px !important;
}
.toast {
  position: fixed;
  bottom: 24px;
  right: 24px;
  background: #ffffff;
  border: 1.5px solid rgba(124,58,237,0.25);
  border-radius: 12px;
  padding: 10px 14px;
  box-shadow: 0 4px 24px rgba(124,58,237,0.12);
  z-index: 9999;
  opacity: 0;
  transform: translateY(12px);
  transition: opacity .3s ease, transform .3s ease;
  pointer-events: none;
  width: fit-content;
  max-width: 260px;
  display: flex;
  align-items: center;
  gap: 10px;
  color: #1e1b4b;
}
.toast.show { opacity: 1; transform: translateY(0); pointer-events: auto; }
.t-ico { width: 28px; height: 28px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 700; flex-shrink: 0; }
.toast.toast-ok  .t-ico { background: rgba(52,211,153,0.12); color: #059669; }
.toast.toast-err .t-ico { background: rgba(239,68,68,0.10);  color: #dc2626; }
.t-txt { display: flex; flex-direction: column; gap: 1px; }
.t-txt b    { font-size: 13px; font-weight: 600; color: #1e1b4b; }
.t-txt span { font-size: 11px; color: #6b7280; }
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

    <img src="{{ asset('images/nebulita-removebg-preview.png') }}" alt="Nebulita" class="nv-character">

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