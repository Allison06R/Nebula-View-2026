@extends('layouts.app')

@section('title', 'Contáctanos — Nebula View')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contactanos.css') }}">
@endsection

@section('content')

<div class="contacto-bg">
  <main class="contacto-page">
    <div class="banner-wrap">
      <div class="banner">
        <span class="spark"><svg class="hand-icon" width="14" height="14"><use href="#icon-sparkle"></use></svg></span>
        <h1>Contáctanos</h1>
        <span class="spark"><svg class="hand-icon" width="14" height="14"><use href="#icon-sparkle"></use></svg></span>
      </div>
    </div>
    <p class="subtitle">¿Tienes una pregunta, una idea o solo quieres saludar? Nebulita está flotando por aquí, lista para leer tu mensaje.</p>

    <div class="content-grid">

      <section class="form-card">
        <h2>Escríbenos</h2>
        <p class="lead">Llena el formulario y te responderemos muy pronto.</p>

        @if (session('contacto_ok'))
          <p class="form-msg form-msg--ok"><svg class="hand-icon" width="14" height="14"><use href="#icon-shape-heart"></use></svg> {{ session('contacto_ok') }}</p>
        @endif

        <form id="contactForm" method="POST" action="{{ route('contactanos.enviar') }}" novalidate>
          @csrf
          <div class="field">
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" placeholder="¿Cómo te llamas?" value="{{ old('name') }}" required>
            @error('name') <span class="field-error">{{ $message }}</span> @enderror
          </div>
          <div class="field">
            <label for="email">Correo electrónico</label>
            <input type="email" id="email" name="email" placeholder="tucorreo@ejemplo.com" value="{{ old('email') }}" required>
            @error('email') <span class="field-error">{{ $message }}</span> @enderror
          </div>
          <div class="field">
            <label for="message">Mensaje</label>
            <textarea id="message" name="message" placeholder="Cuéntanos en qué te ayudamos..." required>{{ old('message') }}</textarea>
            @error('message') <span class="field-error">{{ $message }}</span> @enderror
          </div>
          <button type="submit" class="submit-btn">Enviar mensaje <svg class="hand-icon" width="15" height="15"><use href="#icon-sobre"></use></svg></button>
        </form>
      </section>

      <div class="mascot-col">
        <div class="speech-bubble">¡Hola! Soy Nebulita <svg class="hand-icon" width="14" height="14"><use href="#icon-sparkle"></use></svg><br>Cuéntame en qué te ayudo</div>
        <div class="mascot-img-wrap">
          <img src="{{ asset('images/nebulita.png') }}" alt="Nebulita, la mascota morada con lentes rosas, sosteniendo un corazón rojo y dando la bienvenida">
        </div>
      </div>

    </div>

    <div class="contact-alt">
      <a href="mailto:nebulitavieww@gmail.com">nebulitavieww@gmail.com</a>
      <a href="#">Instagram</a>
      <a href="#">TikTok</a>
    </div>
  </main>
</div>

@endsection