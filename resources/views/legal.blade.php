@extends('layouts.app')

@section('title', 'Política de Privacidad y Créditos — Nebula View')

@section('css')
<link rel="stylesheet" href="{{ asset('css/legal.css') }}">
@endsection

@section('content')

<section class="legal-hero">
  <p class="legal-hero__eyebrow">Información legal</p>
  <h1 class="legal-hero__title">Política de privacidad<br><em>y créditos</em></h1>
  <p class="legal-hero__body">Nebula View es un proyecto académico desarrollado con fines educativos. Aquí explicamos, de forma simple, cómo tratamos tu información y a quién pertenece el contenido visual que utilizamos.</p>
</section>

<nav class="legal-nav">
  <a href="#privacidad">Privacidad</a>
  <a href="#datos">Manejo de datos</a>
  <a href="#creditos">Créditos</a>
  <a href="#terminos">Términos de uso</a>
</nav>

<section class="legal-main">

  <div class="legal-block" id="privacidad">
    <div class="legal-block__icon">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
        <path d="M12 3 4.5 6v6c0 5 3.2 8.4 7.5 9.9 4.3-1.5 7.5-4.9 7.5-9.9V6L12 3Z"/>
        <path d="m9.5 12 1.8 1.8 3.2-3.6"/>
      </svg>
    </div>
    <h2>Proyecto académico</h2>
    <p>Nebula View fue creado como un proyecto académico con fines educativos y de aprendizaje. No es un producto comercial ni tiene fines de lucro; su objetivo es mostrar, a modo de práctica, cómo se construye una plataforma web de salud visual.</p>
    <p>Por tratarse de un entorno académico, te recomendamos no ingresar información personal sensible más allá de la necesaria para crear una cuenta de prueba.</p>
  </div>

  <div class="legal-block" id="datos">
    <div class="legal-block__icon">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
        <rect x="4" y="10" width="16" height="10" rx="2"/>
        <path d="M8 10V7a4 4 0 0 1 8 0v3"/>
      </svg>
    </div>
    <h2>Manejo de tus datos</h2>
    <p>La información que ingresas (como tu correo, tus resultados de test o tus preferencias visuales) se guarda de forma segura en nuestra base de datos y solo se utiliza para el funcionamiento de la plataforma.</p>
    <ul>
      <li><strong>Contraseñas:</strong> se almacenan cifradas, nunca en texto plano.</li>
      <li><strong>Resultados de tests:</strong> quedan asociados únicamente a tu cuenta y solo tú puedes verlos.</li>
      <li><strong>Sin fines comerciales:</strong> no vendemos ni compartimos tu información con terceros ni con fines publicitarios.</li>
      <li><strong>Eliminación:</strong> puedes eliminar tu historial de tests o tu cuenta cuando lo desees.</li>
    </ul>
    <div class="legal-note">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><circle cx="12" cy="12" r="9"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
      <p>Al ser un proyecto académico, este sitio no reemplaza los estándares de seguridad de una plataforma médica real. Úsalo únicamente con fines educativos y de práctica.</p>
    </div>
  </div>

  <div class="legal-block" id="creditos">
    <div class="legal-block__icon">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
        <rect x="3" y="3" width="18" height="18" rx="2"/>
        <circle cx="9" cy="9" r="2"/>
        <path d="m21 15-5-5L5 21"/>
      </svg>
    </div>
    <h2>Créditos de imágenes y recursos</h2>
    <p>Las imágenes, ilustraciones e íconos utilizados en Nebula View pertenecen a sus respectivos autores y bancos de imágenes originales. Se utilizan exclusivamente con fines educativos, sin ánimo de lucro, dentro del marco de este proyecto académico.</p>
    <p>Si eres autor de alguno de los recursos visuales utilizados y deseas que se retire o se agregue un crédito específico, puedes contactarnos y lo resolveremos de inmediato.</p>
  </div>

  <div class="legal-block" id="terminos">
    <div class="legal-block__icon">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
        <path d="M8 3h8l4 4v13a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Z"/>
        <path d="M8 12h8M8 16h5"/>
      </svg>
    </div>
    <h2>Términos de uso</h2>
    <ul>
      <li>El contenido informativo de Nebula View es orientativo y no reemplaza una consulta médica profesional.</li>
      <li>El registro de cuenta es opcional y solo habilita funciones adicionales dentro del proyecto.</li>
      <li>Al ser una plataforma académica, su disponibilidad y contenido pueden cambiar sin previo aviso.</li>
      <li>El uso del sitio implica que aceptas estas condiciones básicas de uso.</li>
    </ul>
  </div>

</section>

@endsection
