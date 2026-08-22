@extends('layouts.app')
@section('title', 'Olvidé mi contraseña — Nebula View')

@section('css')
<link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
@endsection

@section('content')
<main class="login-wrapper">
  <div class="nv-wrap">
    <div class="nv-left">
      <div class="lv-orb lv-orb1"></div>
      <div class="lv-orb lv-orb2"></div>

      <div class="nv-title">Recupera tu contraseña</div>
      <div class="nv-sub">Escribe el correo con el que te registraste y te enviaremos un enlace para restablecerla.</div>

      @if (session('success'))
        <p style="color:#059669; font-size:14px; margin-bottom:12px;">{{ session('success') }}</p>
      @endif
      @if ($errors->any())
        <p style="color:#dc2626; font-size:14px; margin-bottom:12px;">{{ $errors->first() }}</p>
      @endif

      <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="field">
          <label>Correo electrónico</label>
          <div class="field-wrap">
            <input type="email" name="correo" placeholder="hola@nebula.com" required value="{{ old('correo') }}"/>
          </div>
        </div>

        <button type="submit" class="btn-login">Enviar enlace de restablecimiento</button>

        <div class="signup-row">
          <a href="{{ route('login') }}">Volver a iniciar sesión</a>
        </div>
      </form>
    </div>

    <img src="{{ asset('images/nebulita-removebg-preview.png') }}" alt="Nebulita" class="nv-character">
  </div>
</main>
@endsection
