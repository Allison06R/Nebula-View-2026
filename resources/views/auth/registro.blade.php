@extends('layouts.auth')
@section('title', 'Registro — Nebula View')

@section('css')
<link rel="stylesheet" href="{{ asset('css/registro.css') }}">
<style>
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

      <div class="nv-title">Crea tu cuenta</div>
      <div class="nv-sub">Regístrate para acceder a todo el contenido y servicios de Nebula View.</div>

      <form class="form" method="POST" action="{{ route('registro') }}" id="regForm">
        @csrf

        <div class="row">
          <div class="field half">
            <label>Nombre</label>
            <div class="field-wrap">
              <svg class="field-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#7c3aed" stroke-width="1.6">
                <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8z"/>
                <path d="M2 20a8 8 0 0 1 16 0"/>
              </svg>
              <input type="text" name="nombre" placeholder="Tu nombre" required value="{{ old('nombre') }}"/>
            </div>
            @error('nombre') <div style="font-size:11px;color:#dc2626;margin-top:4px;">{{ $message }}</div> @enderror
          </div>

          <div class="field half">
            <label>Apellido</label>
            <div class="field-wrap">
              <svg class="field-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#7c3aed" stroke-width="1.6">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
              </svg>
              <input type="text" name="apellido" placeholder="Tu apellido" required value="{{ old('apellido') }}"/>
            </div>
            @error('apellido') <div style="font-size:11px;color:#dc2626;margin-top:4px;">{{ $message }}</div> @enderror
          </div>
        </div>

        <div class="field">
          <label>Nombre de usuario</label>
          <div class="field-wrap">
            <svg class="field-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#7c3aed" stroke-width="1.6">
              <circle cx="12" cy="8" r="4"/>
              <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
            </svg>
            <span style="font-size:13px;color:#c4aee8;margin-right:4px;">@</span>
            <input type="text" name="usuario" placeholder="tu_usuario" required value="{{ old('usuario') }}"/>
          </div>
          @error('usuario') <div style="font-size:11px;color:#dc2626;margin-top:4px;">{{ $message }}</div> @enderror
        </div>

        <div class="field">
          <label>Correo electrónico</label>
          <div class="field-wrap">
            <svg class="field-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#7c3aed" stroke-width="1.6">
              <rect x="2" y="4" width="20" height="16" rx="2"/>
              <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
            </svg>
            <input type="email" name="correo" placeholder="hola@nebula.com" required value="{{ old('correo') }}"/>
          </div>
          @error('correo') <div style="font-size:11px;color:#dc2626;margin-top:4px;">{{ $message }}</div> @enderror
        </div>

        <div class="row">
          <div class="field half">
            <label>Contraseña</label>
            <div class="field-wrap">
              <svg class="field-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#7c3aed" stroke-width="1.6">
                <rect x="3" y="11" width="18" height="11" rx="2"/>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
              </svg>
              <input type="password" name="password" placeholder="••••••••" required minlength="6"/>
            </div>
            @error('password') <div style="font-size:11px;color:#dc2626;margin-top:4px;">{{ $message }}</div> @enderror
          </div>

          <div class="field half">
            <label>Confirmar contraseña</label>
            <div class="field-wrap">
              <svg class="field-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#7c3aed" stroke-width="1.6">
                <path d="M20 6L9 17l-5-5"/>
              </svg>
              <input type="password" name="password_confirmation" placeholder="••••••••" required/>
            </div>
          </div>
        </div>

        <div class="row-opts">
          <label class="remember">
            <input type="checkbox" name="terms" required/>
            Acepto los términos y condiciones
          </label>
        </div>

        <button type="submit" class="btn-login">
          <div class="shine"></div>
          Registrarme
        </button>

        <div class="signup-row">
          ¿Ya tienes cuenta? <a href="{{ route('login') }}" class="link">Inicia sesión</a>
        </div>

      </form>
    </div>

    <aside class="nv-right">
      <div class="orb orb1"></div>
      <div class="orb orb2"></div>
      <div class="eye-logo">
        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.6">
          <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
          <circle cx="12" cy="12" r="3"/>
        </svg>
      </div>
      <div class="nv-brand">NEBULA VIEW</div>
      <div class="nv-tagline">Únete y comienza a explorar modelos y recursos visuales exclusivos.</div>
      <div class="nv-dots">
        <div class="nv-dot on"></div>
        <div class="nv-dot"></div>
        <div class="nv-dot"></div>
      </div>
    </aside>

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

// Validación del lado del cliente
document.getElementById('regForm').addEventListener('submit', function(e) {
  const p = this.password.value;
  const c = this.password_confirmation.value;
  if (p !== c) {
    e.preventDefault();
    doToast('err', 'Error', 'Las contraseñas no coinciden.');
    return;
  }
  if (!this.terms.checked) {
    e.preventDefault();
    doToast('err', 'Error', 'Acepta los términos para continuar.');
  }
});
</script>
@endsection