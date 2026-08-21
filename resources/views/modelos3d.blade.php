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

      <div class="catalog-card"
           data-glb="{{ asset('models/purple_eyeglasses_3d_model.glb') }}"
           data-name="Purple Eyeglasses"
           data-desc="Montura en tono morado con acabado brillante y líneas modernas. Ideal para quienes buscan un toque de color distintivo en el día a día."
           data-price="$99 USD"
           data-material="Acetato premium"
           data-montura="Full rim"
           data-rostro="Ovalado · Redondo"
           data-tags="Moderno,Unisex,UV400,Ligero">
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
            <button class="catalog-card-btn catalog-card-btn--view" title="Ver modelo en 3D" aria-label="Ver modelo en 3D">
              <svg viewBox="0 0 24 24"><path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
          </div>
        </div>
      </div>

     
      <div class="catalog-card"
           data-glb="{{ asset('models/glasses 3d model.glb') }}"
           data-name="Blue Eyeglasses"
           data-desc="Montura en tono azul con acabado satinado. Un diseño moderno y versátil, pensado para uso diario en la oficina o la calle."
           data-price="$89 USD"
           data-material="Acetato mate"
           data-montura="Full rim"
           data-rostro="Cuadrado · Ovalado"
           data-tags="Moderno,Unisex,UV400,Ligero">
        <div class="catalog-card-thumb has-3d">
          <img src="{{ asset('images/Lentesazules.jpg') }}" alt="Blue Eyeglasses" class="catalog-card-photo">
          <span class="catalog-card-badge new">Nuevo</span>
          <span class="view3d-btn"><svg viewBox="0 0 24 24"><path d="M12 3v18M3 12h18" stroke-linecap="round"/></svg> Ver en 3D</span>
        </div>
        <div class="catalog-card-body">
          <div class="catalog-card-name">Blue Eyeglasses</div>
          <div class="catalog-card-type">montura moderna</div>
          <div class="catalog-card-desc">Montura en tono azul con acabado satinado. Modelo 3D interactivo en alta fidelidad, gira y explora cada detalle.</div>
          <div class="catalog-card-foot">
            <div class="catalog-card-price">$89 <span>USD</span></div>
            <button class="catalog-card-btn catalog-card-btn--view" title="Ver modelo en 3D" aria-label="Ver modelo en 3D">
              <svg viewBox="0 0 24 24"><path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
          </div>
        </div>
      </div>

      
      <div class="catalog-card"
           data-glb="{{ asset('models/round glasses 3d model.glb') }}"
           data-name="Red Round Eyeglasses"
           data-desc="Montura circular en tono rojo intenso, inspirada en el estilo retro. Un modelo con mucha personalidad para looks atrevidos."
           data-price="$92 USD"
           data-material="Metal ligero"
           data-montura="Full rim"
           data-rostro="Cuadrado · Alargado"
           data-tags="Retro,Unisex,UV400">
        <div class="catalog-card-thumb has-3d">
          <img src="{{ asset('images/Lentesrojos.jpg') }}" alt="Red Eyeglasses" class="catalog-card-photo">
          <span class="catalog-card-badge new">Nuevo</span>
          <span class="view3d-btn"><svg viewBox="0 0 24 24"><path d="M12 3v18M3 12h18" stroke-linecap="round"/></svg> Ver en 3D</span>
        </div>
        <div class="catalog-card-body">
          <div class="catalog-card-name">Red Round Eyeglasses</div>
          <div class="catalog-card-type">montura redonda</div>
          <div class="catalog-card-desc">Montura circular en tono rojo intenso, con estilo retro. Modelo 3D interactivo en alta fidelidad, gira y explora cada detalle.</div>
          <div class="catalog-card-foot">
            <div class="catalog-card-price">$92 <span>USD</span></div>
            <button class="catalog-card-btn catalog-card-btn--view" title="Ver modelo en 3D" aria-label="Ver modelo en 3D">
              <svg viewBox="0 0 24 24"><path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
          </div>
        </div>
      </div>

      <div class="catalog-card"
           data-glb="{{ asset('models/green eyeglasses 3d model.glb') }}"
           data-name="Green Eyeglasses"
           data-desc="Montura en tono verde con acabado brillante. Un color fresco y distintivo para quienes buscan destacar."
           data-price="$95 USD"
           data-material="Acetato premium"
           data-montura="Full rim"
           data-rostro="Ovalado · Redondo"
           data-tags="Vibrante,Unisex,UV400,Ligero">
        <div class="catalog-card-thumb has-3d">
          <img src="{{ asset('images/Lentesverdes.jpg') }}" alt="Green Eyeglasses" class="catalog-card-photo">
          <span class="catalog-card-badge new">Nuevo</span>
          <span class="view3d-btn"><svg viewBox="0 0 24 24"><path d="M12 3v18M3 12h18" stroke-linecap="round"/></svg> Ver en 3D</span>
        </div>
        <div class="catalog-card-body">
          <div class="catalog-card-name">Green Eyeglasses</div>
          <div class="catalog-card-type">montura moderna</div>
          <div class="catalog-card-desc">Montura en tono verde con acabado brillante. Modelo 3D interactivo en alta fidelidad, gira y explora cada detalle.</div>
          <div class="catalog-card-foot">
            <div class="catalog-card-price">$95 <span>USD</span></div>
            <button class="catalog-card-btn catalog-card-btn--view" title="Ver modelo en 3D" aria-label="Ver modelo en 3D">
              <svg viewBox="0 0 24 24"><path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
          </div>
        </div>
      </div>

      <div class="catalog-card"
           data-glb="{{ asset('models/black eyeglass frame 3d model.glb') }}"
           data-name="Black Eyeglasses"
           data-desc="Montura clásica en negro mate, versátil y atemporal. Combina con cualquier estilo y es una apuesta segura para uso diario."
           data-price="$109 USD"
           data-material="Acetato premium"
           data-montura="Full rim"
           data-rostro="Ovalado · Cuadrado"
           data-tags="Clásico,Unisex,UV400">
        <div class="catalog-card-thumb has-3d">
          <img src="{{ asset('images/Lentesnegros.jpg') }}" alt="Black Eyeglasses" class="catalog-card-photo">
          <span class="catalog-card-badge new">Nuevo</span>
          <span class="view3d-btn"><svg viewBox="0 0 24 24"><path d="M12 3v18M3 12h18" stroke-linecap="round"/></svg> Ver en 3D</span>
        </div>
        <div class="catalog-card-body">
          <div class="catalog-card-name">Black Eyeglasses</div>
          <div class="catalog-card-type">montura clásica</div>
          <div class="catalog-card-desc">Montura clásica en negro mate, versátil y atemporal. Modelo 3D interactivo en alta fidelidad, gira y explora cada detalle.</div>
          <div class="catalog-card-foot">
            <div class="catalog-card-price">$109 <span>USD</span></div>
            <button class="catalog-card-btn catalog-card-btn--view" title="Ver modelo en 3D" aria-label="Ver modelo en 3D">
              <svg viewBox="0 0 24 24"><path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
          </div>
        </div>
      </div>

       <div class="catalog-card"
           data-glb="{{ asset('models/aviator glasses 3d model.glb') }}"
           data-name="Aviator Glasses"
           data-desc="Montura clásica en tono aviator con detalles retro y una silueta atemporal. Perfecta para aquellos que buscan un estilo versátil y duradero."
           data-price="$119 USD"
           data-material="Acetato premium"
           data-montura="Full rim"
           data-rostro="Ovalado · Redondo"
           data-tags="Moderno,Unisex,UV400,Ligero">
        <div class="catalog-card-thumb has-3d">
          <img src="{{ asset('images/Lentesaviator.jpg') }}" alt="Aviator Glasses" class="catalog-card-photo">
          <span class="catalog-card-badge new">Nuevo</span>
          <span class="view3d-btn"><svg viewBox="0 0 24 24"><path d="M12 3v18M3 12h18" stroke-linecap="round"/></svg> Ver en 3D</span>
        </div>
        <div class="catalog-card-body">
          <div class="catalog-card-name">Aviator Glasses</div>
          <div class="catalog-card-type">montura moderna</div>
          <div class="catalog-card-desc">Montura clásica en tono aviator con detalles retro. Modelo 3D interactivo en alta fidelidad, gira y explora cada detalle.</div>
          <a href="https://lens.snap.com/experience/1c01e24c-58bc-46b2-9275-3f801730b32b"
             target="_blank"
             rel="noopener noreferrer"
             class="catalog-card-probador"
             onclick="event.stopPropagation()">
            <svg viewBox="0 0 24 24"><path d="M23 7l-7 5 7 5V7z"/><rect x="1" y="5" width="15" height="14" rx="2"/></svg>
            Probador con cámara
          </a>
          <div class="catalog-card-foot">
            <div class="catalog-card-price">$119 <span>USD</span></div>
            <button class="catalog-card-btn catalog-card-btn--view" title="Ver modelo en 3D" aria-label="Ver modelo en 3D">
              <svg viewBox="0 0 24 24"><path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
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

    <div class="model-modal-grid">

      <!-- Columna izquierda: visor 3D -->
      <div class="model-modal-viewer">
        <div class="model-modal-viewer-glow"></div>
        <div class="model-modal-topbadge">Vista 3D interactiva</div>
        <model-viewer id="modelModalViewer" camera-controls auto-rotate shadow-intensity="1" exposure="1" touch-action="pan-y" loading="eager"></model-viewer>
        <div class="model-modal-hint">
          <svg viewBox="0 0 24 24"><path d="M9 3H5a2 2 0 0 0-2 2v4M15 3h4a2 2 0 0 1 2 2v4M9 21H5a2 2 0 0 1-2-2v-4M15 21h4a2 2 0 0 0 2-2v-4"/></svg>
          Arrastra para girar · Pellizca/scroll para zoom
        </div>
      </div>

      <!-- Columna derecha: información -->
      <div class="model-modal-info">
        <div class="model-modal-info-inner">

          <h3 id="modelModalName"></h3>

          <div class="model-modal-toprow">
            <div class="model-modal-price" id="modelModalPrice"></div>
            <button class="model-modal-fav" id="modelModalFav" type="button" aria-pressed="false" aria-label="Agregar a favoritos">
              <svg viewBox="0 0 24 24"><path d="M12 21s-7-4.6-9.5-9.1C.7 8.4 2.4 5 6 5c2 0 3.3 1 4 2 .7-1 2-2 4-2 3.6 0 5.3 3.4 3.5 6.9C19 16.4 12 21 12 21Z"/></svg>
              <span class="model-modal-fav-label">Favorito</span>
            </button>
          </div>

          <p id="modelModalDesc"></p>

          <div class="model-modal-specs" id="modelModalSpecs"></div>

          <div class="model-modal-actions">
            <a href="#" class="model-modal-cta">Ver en tienda →</a>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>

<!-- FOOTER -->



@endsection

@section('scripts')
<script>
// ══════════════════════════════════════════
// MODELO 3D — POPUP
// (navbar, hamburguesa, menú móvil y la animación .reveal
//  YA se manejan globalmente en layouts/app.blade.php —
//  NO se repiten aquí para evitar "Identifier already declared")
// ══════════════════════════════════════════
const modelModalOverlay = document.getElementById('modelModalOverlay');
const modelModalViewer  = document.getElementById('modelModalViewer');
const modelModalName    = document.getElementById('modelModalName');
const modelModalDesc    = document.getElementById('modelModalDesc');
const modelModalPrice   = document.getElementById('modelModalPrice');
const modelModalClose   = document.getElementById('modelModalClose');
const modelModalSpecs   = document.getElementById('modelModalSpecs');
const modelModalFav     = document.getElementById('modelModalFav');

// DIAGNÓSTICO: ¿existen los elementos del modal en el DOM?
if (!modelModalOverlay || !modelModalViewer) {
  console.error('[MODAL 3D] ❌ No se encontró #modelModalOverlay o #modelModalViewer en el HTML.');
} else {
  console.log('[MODAL 3D] ✅ Elementos del modal encontrados correctamente.');
}

// DIAGNÓSTICO: ¿está definido el custom element <model-viewer>?
window.addEventListener('load', () => {
  if (customElements.get('model-viewer')) {
    console.log('[MODAL 3D] ✅ model-viewer.js cargó correctamente.');
  } else {
    console.error('[MODAL 3D] ❌ model-viewer NO está definido. El script de unpkg.com no cargó.');
  }
});

// ══════════════════════════════════════════
// FAVORITOS (persistidos en la base de datos)
// ══════════════════════════════════════════
let favoritosCache = [];
let favoritosCargados = false;

async function cargarFavoritos() {
  try {
    const res = await fetch('{{ route('modelos3d.favoritos') }}', {
      headers: { 'Accept': 'application/json' }
    });
    if (!res.ok) throw new Error('No se pudieron cargar los favoritos.');
    favoritosCache = await res.json();
  } catch (e) {
    console.error('[FAVORITOS] Error al cargar:', e);
    favoritosCache = [];
  } finally {
    favoritosCargados = true;
  }
}

function esFavorito(nombre) {
  return favoritosCache.includes(nombre);
}

async function toggleFavorito(nombre, categoria) {
  try {
    const res = await fetch('{{ route('modelos3d.toggle') }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        'Accept': 'application/json'
      },
      body: JSON.stringify({ nombre, categoria })
    });

    if (!res.ok) throw new Error('No se pudo guardar el favorito.');

    const data = await res.json();

    if (data.favorito) {
      if (!favoritosCache.includes(nombre)) favoritosCache.push(nombre);
    } else {
      favoritosCache = favoritosCache.filter(f => f !== nombre);
    }

    return data.favorito;
  } catch (e) {
    console.error('[FAVORITOS] Error al guardar:', e);
    alert('No se pudo guardar el favorito. Intenta de nuevo.');
    return esFavorito(nombre);
  }
}
function pintarEstadoFavorito(nombre) {
  const activo = esFavorito(nombre);
  modelModalFav.classList.toggle('active', activo);
  modelModalFav.setAttribute('aria-pressed', activo ? 'true' : 'false');
}

let currentCardName = '';
let currentCardCategoria = '';

modelModalFav?.addEventListener('click', async () => {
  if (!currentCardName) return;
  modelModalFav.disabled = true;
  const activo = await toggleFavorito(currentCardName, currentCardCategoria);
  modelModalFav.classList.toggle('active', activo);
  modelModalFav.setAttribute('aria-pressed', activo ? 'true' : 'false');
  modelModalFav.disabled = false;
  // Pequeña animación de "pop"
  modelModalFav.classList.remove('pop');
  void modelModalFav.offsetWidth; // reinicia la animación
  modelModalFav.classList.add('pop');
});

// Cargar favoritos guardados al iniciar la página
cargarFavoritos();

// ══════════════════════════════════════════
// Construir specs (Material / Montura / Rostro recomendado)
// y tags a partir de los data-* de la tarjeta
// ══════════════════════════════════════════
function buildSpecs(card) {
  const specsMap = [
    { key: 'material', label: 'Material' },
    { key: 'montura',  label: 'Tipo de montura' },
    { key: 'rostro',   label: 'Recomendado para rostro' },
  ];
  modelModalSpecs.innerHTML = '';
  specsMap.forEach(({ key, label }) => {
    const val = card.getAttribute('data-' + key);
    if (!val) return;
    const row = document.createElement('div');
    row.className = 'mm-spec-row';
    row.innerHTML = `<span class="mm-spec-label">${label}</span><span class="mm-spec-val">${val}</span>`;
    modelModalSpecs.appendChild(row);
  });
}

async function openModelModal(card) {
  const glb = card.getAttribute('data-glb');
  console.log('[MODAL 3D] Intentando abrir modelo:', glb);
  if (!glb) return;

  currentCardName = card.getAttribute('data-name') || '';
  currentCardCategoria = card.getAttribute('data-montura') || card.getAttribute('data-categoria') || '';

  modelModalViewer.setAttribute('src', glb);
  modelModalName.textContent  = currentCardName;
  modelModalDesc.textContent  = card.getAttribute('data-desc')  || '';
  modelModalPrice.textContent = card.getAttribute('data-price') || '';

  buildSpecs(card);

  if (!favoritosCargados) {
    await cargarFavoritos();
  }
  pintarEstadoFavorito(currentCardName);

  modelModalOverlay.classList.add('open');
  document.body.style.overflow = 'hidden';

  // DIAGNÓSTICO: ¿el archivo .glb realmente carga?
  modelModalViewer.addEventListener('error', (e) => {
    console.error('[MODAL 3D] ❌ ERROR al cargar el .glb. URL:', glb, 'Detalle:', e.detail);
  }, { once: true });
  modelModalViewer.addEventListener('load', () => {
    console.log('[MODAL 3D] ✅ Modelo 3D cargado y renderizado correctamente.');
  }, { once: true });
}

function closeModelModal() {
  modelModalOverlay.classList.remove('open');
  document.body.style.overflow = '';
  modelModalViewer.removeAttribute('src'); // detiene el render al cerrar
}

document.addEventListener('click', e => {
  const card = e.target.closest('.catalog-card[data-glb]');
  if (card) { openModelModal(card); return; }
  if (e.target === modelModalOverlay) closeModelModal();
  if (e.target.closest('#modelModalClose')) closeModelModal();
});
document.addEventListener('keydown', e => { if (e.key === 'Escape' && modelModalOverlay.classList.contains('open')) closeModelModal(); });
</script>
@endsection