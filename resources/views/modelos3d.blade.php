@extends('layouts.app')

@section('title', 'Tienda / Modelos 3D — Nebula View')

@section('css')
<link rel="stylesheet" href="{{ asset('css/modelo.css') }}">
<script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js"></script>
<style>
  .custom-model-viewer {
    width: 100%;
    height: 100%;
    min-height: 420px;
    background: transparent;
    --poster-color: transparent;
  }
</style>
@endsection

@section('content')
<!-- HERO -->
<div class="page-hero">
  <div class="page-hero-bg"></div>
  <div class="hero-accent-rect"></div>
  <div class="page-hero-title">
    <h1>Tienda / Modelos 3D</h1>
    <div class="breadcrumb">
      <a>Explora y visualiza nuestros modelos interactivos</a>
    </div>
  </div>
</div>

<!-- CONTENT -->
<div class="page-content">

  <!-- INTRO -->
  <div class="models-intro reveal">
    <div class="models-intro-text">
      <div class="section-kicker">Visualización 3D</div>
      <h2>Prueba tus lentes<br><em>antes de comprar</em></h2>
      <p>Nuestra tecnología de modelos 3D interactivos te permite explorar cada par de lentes en detalle desde cualquier ángulo. Observa los materiales, colores y proporciones antes de tomar tu decisión.</p>
      <p>Gira, acerca y examina cada montura con total libertad. Cada modelo ha sido diseñado con precisión para reflejar fielmente el producto real que recibirás.</p>
      <span class="intro-badge">🔄 Interactivo · 360°</span>
    </div>
    <!-- 3D VIEWER -->
    <div class="viewer-wrap">
      <div class="viewer-label">Vista previa 3D</div>
      <iframe title="Glasses 3D model" frameborder="0" allowfullscreen mozallowfullscreen="true" webkitallowfullscreen="true" allow="autoplay; fullscreen; xr-spatial-tracking" xr-spatial-tracking execution-while-out-of-viewport execution-while-not-rendered web-share src="https://sketchfab.com/models/74c1d202ac0249e39823e379e2b065e9/embed"></iframe>
    </div>
  </div>

  <!-- SEPARATOR -->
  <div class="sep">
    <div class="sep-inner">
      <div class="sep-line"></div>
      Modelo destacado
      <div class="sep-line"></div>
    </div>
  </div>

  <!-- FEATURED MODEL -->
  <div class="featured-section reveal">
    <h2>Modelo<br><em>destacado</em></h2>
    <div class="featured-card">
      <div class="featured-viewer">
        <iframe title="Glasses 3D model" frameborder="0" allowfullscreen mozallowfullscreen="true" webkitallowfullscreen="true" allow="autoplay; fullscreen; xr-spatial-tracking" xr-spatial-tracking execution-while-out-of-viewport execution-while-not-rendered web-share src="https://sketchfab.com/models/74c1d202ac0249e39823e379e2b065e9/embed?autostart=1&ui_theme=dark&ui_infos=0&ui_controls=1"></iframe>
        <div class="featured-viewer-overlay"></div>
      </div>
      <div class="featured-info">
        <div class="featured-badge">Destacado</div>
        <div class="featured-title">Classic Eyewear</div>
        <div class="featured-subtitle">Colección Primavera 2026</div>
        <div class="featured-divider"></div>
        <p class="featured-desc">Montura clásica de acetato con acabado premium. Diseñada para adaptarse a múltiples tipos de rostro con un estilo atemporal que combina elegancia y comodidad.</p>
        <div class="featured-specs">
          <div class="spec-row">
            <span class="spec-label">Material</span>
            <span class="spec-val">Acetato premium</span>
          </div>
          <div class="spec-row">
            <span class="spec-label">Montura</span>
            <span class="spec-val">Full rim</span>
          </div>
          <div class="spec-row">
            <span class="spec-label">Rostro</span>
            <span class="spec-val">Ovalado · Redondo</span>
          </div>
          <div class="spec-row">
            <span class="spec-label">Autor 3D</span>
            <span class="spec-val">nattsol / Sketchfab</span>
          </div>
        </div>
        <div class="featured-tags">
          <span class="ftag">Clásico</span>
          <span class="ftag">Unisex</span>
          <span class="ftag">UV400</span>
          <span class="ftag">Ligero</span>
        </div>
        <div class="featured-actions">
          <a href="#" class="btn-primary">Ver en tienda →</a>
          <button class="btn-ghost" title="Guardar">♡</button>
        </div>
      </div>
    </div>
  </div>

  <!-- SEPARATOR -->
  <div class="sep">
    <div class="sep-inner">
      <div class="sep-line"></div>
      Nuevo modelo
      <div class="sep-line"></div>
    </div>
  </div>

  <!-- CUSTOM UPLOADED MODEL -->
  <div class="featured-section reveal">
    <h2>Lentes azules<br><em>en 3D</em></h2>
    <div class="featured-card">
      <div class="featured-viewer">
        <model-viewer
          class="custom-model-viewer"
          src="{{ asset('models/blue-eyeglasses.glb') }}"
          alt="Lentes azules en 3D"
          camera-controls
          auto-rotate
          rotation-per-second="20deg"
          shadow-intensity="1"
          exposure="1"
          camera-orbit="0deg 75deg 105%"
          min-camera-orbit="auto auto 50%"
          max-camera-orbit="auto auto 200%">
        </model-viewer>
      </div>
      <div class="featured-info">
        <div class="featured-badge">Nuevo</div>
        <div class="featured-title">Blue Eyeglasses</div>
        <div class="featured-subtitle">Modelo 3D subido por el equipo</div>
        <div class="featured-divider"></div>
        <p class="featured-desc">Montura azul con líneas modernas. Gira, acerca y examina el modelo con total libertad usando el visor interactivo.</p>
        <div class="featured-tags">
          <span class="ftag">Azul</span>
          <span class="ftag">Moderno</span>
          <span class="ftag">Unisex</span>
        </div>
        <div class="featured-actions">
          <a href="#" class="btn-primary">Ver en tienda →</a>
          <button class="btn-ghost" title="Guardar">♡</button>
        </div>
      </div>
    </div>
  </div>

  <!-- CATALOG -->
  <div class="catalog-section reveal">
    <h2>Más modelos en<br><em>nuestro catálogo</em></h2>
    <div class="catalog-grid">

      <div class="catalog-card">
        <div class="catalog-card-thumb" style="background: linear-gradient(135deg,#f0e8ff,#dce8f5);">
          👓
          <span class="catalog-card-badge new">Nuevo</span>
        </div>
        <div class="catalog-card-body">
          <div class="catalog-card-name">Aviator Pro</div>
          <div class="catalog-card-type">montura metálica</div>
          <div class="catalog-card-desc">Estilo aviador clásico con puente doble y patillas metálicas. Perfectas para rostros ovalados y cuadrados.</div>
          <div class="catalog-card-foot">
            <div class="catalog-card-price">$89 <span>USD</span></div>
            <button class="catalog-card-btn">+</button>
          </div>
        </div>
      </div>

      <div class="catalog-card">
        <div class="catalog-card-thumb" style="background: linear-gradient(135deg,#fdf0e8,#fce8d5);">
          🕶️
          <span class="catalog-card-badge popular">Popular</span>
        </div>
        <div class="catalog-card-body">
          <div class="catalog-card-name">Wayfarer Luxe</div>
          <div class="catalog-card-type">acetato grueso</div>
          <div class="catalog-card-desc">Diseño wayfarer moderno con acetato de alta densidad. Disponible en 6 colores distintos para toda ocasión.</div>
          <div class="catalog-card-foot">
            <div class="catalog-card-price">$120 <span>USD</span></div>
            <button class="catalog-card-btn">+</button>
          </div>
        </div>
      </div>

      <div class="catalog-card">
        <div class="catalog-card-thumb" style="background: linear-gradient(135deg,#e8f5f0,#d5f0e8);">
          🥽
          <span class="catalog-card-badge">Clásico</span>
        </div>
        <div class="catalog-card-body">
          <div class="catalog-card-name">Round Vision</div>
          <div class="catalog-card-type">montura redonda</div>
          <div class="catalog-card-desc">Inspirada en el estilo retro de los años 70. Montura circular fina de titanio con gran elegancia y ligereza.</div>
          <div class="catalog-card-foot">
            <div class="catalog-card-price">$95 <span>USD</span></div>
            <button class="catalog-card-btn">+</button>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- HOW IT WORKS -->
  <div class="how-section reveal">
    <h2>¿Cómo funciona<br><em>la visualización 3D?</em></h2>
    <div class="how-grid">
      <div class="how-step">
        <div class="how-num">1</div>
        <h4>Explora el catálogo</h4>
        <p>Navega por nuestros modelos 3D interactivos y elige el que más te guste.</p>
      </div>
      <div class="how-step">
        <div class="how-num">2</div>
        <h4>Visualiza en 360°</h4>
        <p>Gira, amplía y examina cada detalle del modelo desde cualquier ángulo.</p>
      </div>
      <div class="how-step">
        <div class="how-num">3</div>
        <h4>Compara opciones</h4>
        <p>Guarda tus favoritos y compara varios modelos antes de decidirte.</p>
      </div>
      <div class="how-step">
        <div class="how-num">4</div>
        <h4>Realiza tu pedido</h4>
        <p>Una vez elegido, añade al carrito y recíbelo en la comodidad de tu hogar.</p>
      </div>
    </div>
  </div>

</div><!-- /page-content -->

<!-- FOOTER -->



@endsection

@section('scripts')
<script>
// NAV scroll
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => navbar.classList.toggle('scrolled', scrollY > 30));

// REVEAL
const revealEls = document.querySelectorAll('.reveal');
const obs = new IntersectionObserver(entries => {
  entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: 0.1 });
revealEls.forEach(el => obs.observe(el));

// HAMBURGER
const hamBtn = document.getElementById('hamBtn');
const mobileMenu = document.getElementById('mobileMenu');
const menuBackdrop = document.getElementById('menuBackdrop');
const drawerCloseBtn = document.getElementById('drawerClose');
function openMenu() { mobileMenu.classList.add('open'); hamBtn.classList.add('open'); document.body.style.overflow = 'hidden'; }
function closeMenu() { mobileMenu.classList.remove('open'); hamBtn.classList.remove('open'); document.body.style.overflow = ''; }
hamBtn.addEventListener('click', () => mobileMenu.classList.contains('open') ? closeMenu() : openMenu());
drawerCloseBtn.addEventListener('click', closeMenu);
menuBackdrop.addEventListener('click', closeMenu);
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeMenu(); });
</script>
@endsection
