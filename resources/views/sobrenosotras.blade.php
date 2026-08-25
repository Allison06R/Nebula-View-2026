@extends('layouts.app')

@section('title', 'Sobre Nosotras — Nebula View')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sobrenosotras.css') }}">
@endsection

@section('content')


<!-- HERO -->
<div class="page-hero sn-hero">
  <div class="page-hero-bg"></div>
  <div class="hero-accent-rect"></div>
  <span class="sn-hero-orbit sn-hero-orbit--a"></span>
  <span class="sn-hero-orbit sn-hero-orbit--b"></span>
  <div class="page-hero-title">
    <span class="sn-hero-badge">Nuestro origen</span>
    <h1>Sobre Nosotras</h1>
    <div class="breadcrumb">
      <a>Conoce más sobre el equipo desarrollador</a>
    </div>
  </div>
</div>

<div class="page-content">

  <!-- ¿Por qué Nebula View? -->
  <div class="habitos-intro reveal sn-story">
    <span class="sn-story-glow"></span>
    <div class="habitos-intro-text">
      <div class="section-kicker">Información</div>
      <h2>¿Por qué <br><em>Nebula View?</em></h2>
      <p>“Nebula View” combina la salud visual con una idea inspirada en el universo. La palabra “Nebula” representa las nebulosas, formaciones espaciales que parecen difusas, pero que son el origen de nuevas estrellas. Esto se relaciona con la visión de muchas personas, que a veces puede ser borrosa o poco comprendida, pero que tiene el potencial de mejorar y transformarse.</p>
      <p>Por su parte, “View” se conecta directamente con la visión y la capacidad de percibir el entorno con claridad. Juntas, ambas palabras transmiten el paso de una percepción incierta hacia una visión más clara y consciente, reflejando el propósito de la plataforma: ayudar a las personas a comprender y cuidar mejor su salud visual mediante la tecnología.</p>

      <div class="habitos-highlight">
        <span class="habitos-highlight-icon"><svg class="custom-icon" aria-hidden="true"><use href="#icon-checklist"></use></svg></span>
        <p>La Helix Nebula es conocida popularmente como el “ojo de Dios” por su gran parecido con un ojo humano, lo que la convierte en una referencia simbólica perfecta para relacionar el universo con la visión.</p>
      </div>
    </div>
    <div class="img-placeholder logo-showcase sn-logo-showcase" style="min-height:360px;">
      <img src="{{ asset('images/favicon y logo.png') }}" alt="Nebula View" />
    </div>
  </div>

  <!-- MISIÓN Y VISIÓN -->
  <section class="mv-section reveal">
    <div class="section-header">
      <div class="section-kicker" style="justify-content:center;">Nuestro rumbo</div>
      <h2 class="mv-heading">Misión <em>&amp;</em> Visión</h2>
    </div>

    <div class="mv-grid">
      <div class="mv-card">
        <span class="mv-card-glow"></span>
        <div class="mv-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="9"></circle>
            <circle cx="12" cy="12" r="5"></circle>
            <circle cx="12" cy="12" r="1"></circle>
          </svg>
        </div>
        <h3>Misión</h3>
        <p>Acompañar a cada persona en el cuidado de su salud visual, ofreciendo diagnósticos inteligentes, lentes de calidad y una experiencia digital cercana, clara y confiable, que transforme la incertidumbre de una visión borrosa en una decisión segura y consciente.</p>
      </div>

      <div class="mv-card">
        <span class="mv-card-glow"></span>
        <div class="mv-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 3v3M12 18v3M3 12h3M18 12h3"></path>
            <path d="M12 8a4 4 0 1 0 0 8 4 4 0 0 0 0-8Z"></path>
          </svg>
        </div>
        <h3>Visión</h3>
        <p>Convertirnos en la plataforma de referencia en salud visual del país, integrando tecnología, diseño y ciencia para que ver bien deje de ser un privilegio y se convierta en una experiencia cotidiana, accesible y hasta cósmica para cualquier persona.</p>
      </div>
    </div>
  </section>

  <!-- La historia de Nebulita -->
  <section class="page-content" style="padding: 0;">
    <div class="importancia-intro reveal">
      <div class="importancia-text">
        <div class="section-kicker">Nuestra mascota</div>
        <h2>La historia de <em>Nebulita</em></h2>
        <div class="importancia-card">
          <p>Nebulita es la pequeña exploradora de Nebula View. Viajó por el universo descubriendo cómo cada persona ve el mundo y aprendió que una buena visión puede cambiar la forma en que vivimos.</p>
          <p>Ahora su misión es ayudarte a cuidar tu salud visual y encontrar los lentes ideales para ti. Desde elegir la montura perfecta hasta entender qué tipo de lente se adapta mejor a tu estilo de vida, Nebulita siempre estará a tu lado para explicarlo de forma sencilla y amigable.</p>
          <p style="margin-bottom:0;">Porque en Nebula View creemos que ver bien no es un lujo, es una forma de disfrutar cada detalle de la vida.</p>
        </div>
      </div>

      <div class="importancia-img-frame">
        <span class="importancia-sparkle importancia-sparkle--tl"></span>
        <span class="importancia-sparkle importancia-sparkle--br"></span>
        <div class="importancia-img-wrap">
          <div class="importancia-img-wrap-inner">
            <img src="{{ asset('images/nebulita-removebg-preview.png') }}" alt="Mascota Nebula View">
          </div>
        </div>
      </div>
    </div>
  </section>

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
@endsection