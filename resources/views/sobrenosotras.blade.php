
@extends('layouts.app')

@section('title', 'Sobre Nosotras — Nebula View')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sobrenosotras.css') }}">
@endsection

@section('content')


<!-- HERO -->
<div class="page-hero">
  <div class="page-hero-bg"></div>
  <div class="hero-accent-rect"></div>
  <div class="page-hero-title">
    <h1>Sobre Nosotras</h1>
    <div class="breadcrumb">
      <a>Conoce mas sobre el equipo desarrollador</a>
    </div>
  </div>
</div>

<div class="page-content">
  <div class="habitos-intro reveal">
    <div class="habitos-intro-text">
      <div class="section-kicker">Información</div>
      <h2>¿Por qué <br><em> Nebula View?</em></h2>
      <p>“Nebula View” combina la salud visual con una idea inspirada en el universo. La palabra “Nebula” representa las nebulosas,  formaciones espaciales que parecen difusas, pero que son el origen de nuevas estrellas. Esto se relaciona con la visión de muchas personas, que a veces puede ser borrosa o poco comprendida, pero que tiene el potencial de mejorar y transformarse.
      </p>
      <p>Por su parte, “View” se conecta directamente con la visión y la capacidad de percibir el entorno con claridad. Juntas, ambas palabras transmiten el paso de una percepción incierta hacia una visión más clara y consciente, reflejando el propósito de la plataforma: ayudar a las personas a comprender y cuidar mejor su salud visual mediante la tecnología.</p>

      <div class="habitos-highlight">
        <span class="habitos-highlight-icon"><svg class="custom-icon" aria-hidden="true"><use href="#icon-checklist"></use></svg></span>
        <p>La Helix Nebula es conocida popularmente como el “ojo de Dios” por su gran parecido con un ojo humano, lo que la convierte en una referencia simbólica perfecta para relacionar el universo con la visión.</p>
      </div>
    </div>
    <div class="img-placeholder logo-showcase" style="min-height:360px;">
  <img src="{{ asset('images/favicon y logo.png') }}" alt="Nebula View" />
</div>
  </div>

  <!--Sobre nosotras c:-->
  <section class="team-section">
 
    <div class="section-header">
      <h2 class="section-title">Las mentes <em>detrás</em> del proyecto</h2>
      <div class="divider"></div>
    </div>
 
    <div class="team-grid">
 
      <div class="card">
        <div class="card-top-bar"></div>
        <div class="card-inner">
          <div class="photo-circle">
            <img src="{{ asset('images/Allison Román.jpeg') }}" alt="Allison Román">
        
          </div>
          <div class="info-col">
            <p class="name">Allison Román</p>
            <p class="role">Scrum Master</p>
            <div class="tag-row">
              <span class="tag">Backend</span>
              
            </div>
          </div>
        </div>
      </div>
 
      <div class="card">
        <div class="card-top-bar"></div>
        <div class="card-inner">
          <div class="photo-circle">
            <img src="{{ asset('images/Naomy Segura.jpeg') }}" alt="Naomy Segura">
   
          </div>
          <div class="info-col">
            <p class="name">Naomy Segura</p>
            <p class="role">Team</p>
            <div class="tag-row">
              <span class="tag">Backend</span>
              
            </div>
          </div>
        </div>
      </div>
 
      <div class="card">
        <div class="card-top-bar"></div>
        <div class="card-inner">
          <div class="photo-circle">
            <img src="{{ asset('images/Fatima Torres.jpg') }}" alt="Fatima Torres">
          
          </div>
          <div class="info-col">
            <p class="name">Fatima Torres</p>
            <p class="role">Team</p>
            <div class="tag-row">
              <span class="tag">Frontend</span>
              
            </div>
          </div>
        </div>
      </div>
 
      <div class="card">
        <div class="card-top-bar"></div>
        <div class="card-inner">
          <div class="photo-circle">
             <img src="{{ asset('images/Alessandra Vásquez.jpeg') }}" alt="Alessandra Vásquez">
          </div>
          <div class="info-col">
            <p class="name">Alessandra Vásquez</p>
            <p class="role">Product Owner</p>
            <div class="tag-row">
              <span class="tag">Frontend</span>
             
            </div>
          </div>
        </div>
      </div>
 
    </div>
  </section>

</div>