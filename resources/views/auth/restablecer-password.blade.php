@extends('layouts.app')
@section('title', 'Restablecer contraseña — Nebula View')

@section('css')
<link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
@endsection

@section('content')
<main class="login-wrapper">
  <div class="nv-wrap">
    <div class="nv-left">
      <div class="lv-orb lv-orb1"></div>
      <div class="lv-orb lv-orb2"></div>

      <div class="nv-title">Elige tu nueva contraseña</div>
      <div class="nv-sub">Debe tener al menos 8 caracteres, mayúsculas, minúsculas y números.</div>

      @if ($errors->any())
        <p style="color:#dc2626; font-size:14px; margin-bottom:12px;">{{ $errors->first() }}</p>
      @endif

      <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="field">
          <label>Correo electrónico</label>
          <div class="field-wrap">
            <input type="email" name="correo" placeholder="hola@nebula.com" required value="{{ old('correo', $correo) }}"/>
          </div>
        </div>

        <div class="field">
          <label>Nueva contraseña</label>
          <div class="field-wrap">
            <input type="password" name="password" id="password" placeholder="••••••••" required minlength="8"/>
          </div>
          <div class="pw-strength-bar"><div class="pw-strength-fill" id="pwStrengthFill"></div></div>
          <div class="pw-strength-label" id="pwStrengthLabel">&nbsp;</div>
          <ul class="pw-requisitos" id="pwRequisitos">
            <li id="req-len">Al menos 8 caracteres</li>
            <li id="req-mixed">Una mayúscula y una minúscula</li>
            <li id="req-number">Al menos un número</li>
          </ul>
        </div>

        <div class="field">
          <label>Confirmar contraseña</label>
          <div class="field-wrap">
            <input type="password" name="password_confirmation" placeholder="••••••••" required/>
          </div>
        </div>

        <button type="submit" class="btn-login">Restablecer contraseña</button>
      </form>
    </div>

    <img src="{{ asset('images/nebulita-removebg-preview.png') }}" alt="Nebulita" class="nv-character">
  </div>
</main>
@endsection

@section('scripts')
<script>
const pwInput   = document.getElementById('password');
const pwFill    = document.getElementById('pwStrengthFill');
const pwLabel   = document.getElementById('pwStrengthLabel');
const reqLen    = document.getElementById('req-len');
const reqMixed  = document.getElementById('req-mixed');
const reqNumber = document.getElementById('req-number');

function evaluarPassword(pw) {
  const tieneLen     = pw.length >= 8;
  const tieneMixed   = /[a-z]/.test(pw) && /[A-Z]/.test(pw);
  const tieneNumero  = /[0-9]/.test(pw);
  const tieneSimbolo = /[^a-zA-Z0-9]/.test(pw);

  reqLen.classList.toggle('ok', tieneLen);
  reqMixed.classList.toggle('ok', tieneMixed);
  reqNumber.classList.toggle('ok', tieneNumero);

  let puntos = 0;
  if (pw.length > 0) puntos++;
  if (tieneLen) puntos++;
  if (tieneMixed) puntos++;
  if (tieneNumero) puntos++;
  if (tieneSimbolo) puntos++;
  if (pw.length >= 12) puntos++;

  pwFill.className = 'pw-strength-fill';
  if (pw.length === 0) {
    pwFill.style.width = '0%';
    pwLabel.textContent = '\u00a0';
    return;
  }
  if (puntos <= 2) {
    pwFill.classList.add('weak');
    pwLabel.textContent = 'Poco segura';
    pwLabel.style.color = '#dc2626';
  } else if (puntos <= 4) {
    pwFill.classList.add('medium');
    pwLabel.textContent = 'Segura';
    pwLabel.style.color = '#d97706';
  } else {
    pwFill.classList.add('strong');
    pwLabel.textContent = 'Muy segura';
    pwLabel.style.color = '#059669';
  }
}

if (pwInput) {
  pwInput.addEventListener('input', () => evaluarPassword(pwInput.value));
}
</script>
@endsection
