@extends('layouts.app')

@section('title', 'Tienda / Modelos 3D — Nebula View')

@section('css')
<link rel="stylesheet" href="{{ asset('css/modelo.css') }}">
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
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

  <!-- CATALOG -->
  <div class="catalog-section reveal">
    <h2>Más modelos en<br><em>nuestro catálogo</em></h2>
    <div class="catalog-grid">

      <div class="catalog-card" data-glb="{{ asset('models/purple_eyeglasses_3d_model.glb') }}" data-name="Purple Eyeglasses" data-desc="Montura en tono morado con acabado brillante. Gira, acerca y examina el modelo en 3D real desde cualquier ángulo." data-price="$99 USD">
        <div class="catalog-card-thumb has-3d">
          <img src="{{ asset('images/lentesmorados.jpg') }}" alt="Purple Eyeglasses" class="catalog-card-photo">
          <span class="catalog-card-badge new">Nuevo</span>
          <span class="view3d-btn"><svg viewBox="0 0 24 24"><path d="M12 3v18M3 12h18" stroke-linecap="round"/></svg> Ver en 3D</span>
        </div>
        <div class="catalog-card-body">
          <div class="catalog-card-name">Purple Eyeglasses</div>
          <div class="catalog-card-type">montura moderna</div>
          <div class="catalog-card-desc">Montura en tono morado con acabado brillante. Modelo 3D interactivo en alta fidelidad, gira y explora cada detalle.</div>
          <div class="catalog-card-foot">
            <div class="catalog-card-price">$99 <span>USD</span></div>
            <button class="catalog-card-btn">+</button>
          </div>
        </div>
      </div>

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

      <div class="catalog-card">
        <div class="catalog-card-thumb" style="background: linear-gradient(135deg,#fff0e8,#fde5f0);">
          😎
          <span class="catalog-card-badge">Clásico</span>
        </div>
        <div class="catalog-card-body">
          <div class="catalog-card-name">Cat Eye Elegance</div>
          <div class="catalog-card-type">montura cat-eye</div>
          <div class="catalog-card-desc">Líneas felinas ascendentes con acabado brillante. Un toque retro-glam para rostros ovalados y corazón.</div>
          <div class="catalog-card-foot">
            <div class="catalog-card-price">$110 <span>USD</span></div>
            <button class="catalog-card-btn">+</button>
          </div>
        </div>
      </div>

      <div class="catalog-card">
        <div class="catalog-card-thumb" style="background: linear-gradient(135deg,#e8eefd,#e8f7f5);">
          🤓
          <span class="catalog-card-badge popular">Popular</span>
        </div>
        <div class="catalog-card-body">
          <div class="catalog-card-name">Square Bold</div>
          <div class="catalog-card-type">montura cuadrada</div>
          <div class="catalog-card-desc">Silueta cuadrada de líneas marcadas en acetato mate. Ideal para rostros redondos que buscan definición.</div>
          <div class="catalog-card-foot">
            <div class="catalog-card-price">$105 <span>USD</span></div>
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

<!-- PRODUCT 3D MODAL -->
<div class="model-modal-overlay" id="modelModalOverlay">
  <div class="model-modal-box">
    <button class="model-modal-close" id="modelModalClose" aria-label="Cerrar">
      <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>

    <div class="model-modal-header">
      <div class="model-modal-badge">Vista 3D interactiva</div>
      <h3 id="modelModalName"></h3>
    </div>

    <div class="model-modal-viewer">
      <model-viewer id="modelModalViewer" camera-controls auto-rotate shadow-intensity="1" exposure="1" touch-action="pan-y" loading="eager"></model-viewer>
    </div>

    <div class="model-modal-info">
      <p id="modelModalDesc"></p>
      <div class="model-modal-price" id="modelModalPrice"></div>
    </div>
  </div>
</div>

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

// MODELO 3D — POPUP
const modelModalOverlay = document.getElementById('modelModalOverlay');
const modelModalViewer  = document.getElementById('modelModalViewer');
const modelModalName    = document.getElementById('modelModalName');
const modelModalDesc    = document.getElementById('modelModalDesc');
const modelModalPrice   = document.getElementById('modelModalPrice');
const modelModalClose   = document.getElementById('modelModalClose');

function openModelModal(card) {
  const glb = card.getAttribute('data-glb');
  if (!glb) return;
  modelModalViewer.setAttribute('src', glb);
  modelModalName.textContent  = card.getAttribute('data-name')  || '';
  modelModalDesc.textContent  = card.getAttribute('data-desc')  || '';
  modelModalPrice.textContent = card.getAttribute('data-price') || '';
  modelModalOverlay.classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closeModelModal() {
  modelModalOverlay.classList.remove('open');
  document.body.style.overflow = '';
  modelModalViewer.removeAttribute('src'); // detiene el render al cerrar c;
}

document.addEventListener('click', e => {
  if (e.target.closest('.catalog-card-btn')) return; // no abrir al presionar "+"
  const card = e.target.closest('.catalog-card[data-glb]');
  if (card) openModelModal(card);
  if (e.target === modelModalOverlay) closeModelModal();
  if (e.target.closest('#modelModalClose')) closeModelModal();
});
document.addEventListener('keydown', e => { if (e.key === 'Escape' && modelModalOverlay.classList.contains('open')) closeModelModal(); });
</script>
@endsection