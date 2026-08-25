@extends('layouts.app')

@section('title', 'Nebula View')

@section('css')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection

@section('content')

<div id="reading-progress"><div id="progress-fill"></div></div>

<!-- HERO -->
<section class="nebula-hero">
<img src="{{ asset('images/fondo_galaxia_animado.gif') }}" alt="" class="nebula-bg-gif">

  <div class="nebula-hero-text">
    <h1 class="nebula-title">Nebula View</h1>
    <div class="nebula-underline"></div>
    <p class="nebula-subtitle">Tu visión tiene un universo por descubrir.</p>
    <p class="nebula-subtitle-2">Atrévete a verlo desde otra perspectiva.</p>
    <a href="#productos" class="nebula-cta">Explorar <span class="arrow">→</span></a>
  </div>

  <div class="nebula-mascot-wrap">
    <img src="{{ asset('images/Nebulitaindex.png') }}" alt="Mascota Nebula View" class="nebula-mascot">
  </div>
</section>

<!-- MODAL -->
<div class="modal-overlay" id="modalOverlay">
  <div class="modal-box" id="modalBox">
    <div class="modal-header" id="modalHeader">
      <button class="modal-close" id="modalClose" aria-label="Cerrar">
        <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
      <div id="modalHeaderContent"></div>
    </div>
    <div class="modal-body" id="modalBody"></div>
  </div>
</div>

<!-- VISUAL HEALTH -->
<section class="visual-health" id="salud">
  <div class="text reveal">
    <div class="section-label">Salud Visual</div>
    <h2 class="section-title">Conoce los problemas visuales más comunes</h2>
    <p class="section-sub">Información novedosa sobre el cuidado de la vista. Aprende a identificar los problemas más frecuentes.</p>
    <div class="conditions-list">
      <a href="#" class="condition-item active">
        <div class="condition-top"><div class="condition-dot"></div><span class="condition-name">Astigmatismo</span><span class="condition-arrow">→</span></div>
        <div class="condition-info">
          <p>El astigmatismo ocurre cuando la córnea tiene una curvatura irregular, impidiendo que la luz se enfoque correctamente en la retina. Genera visión borrosa a cualquier distancia.</p>
          <div class="condition-tags"><span class="condition-tag">Defecto refractivo</span><span class="condition-tag">Córnea irregular</span><span class="condition-tag">Muy común</span></div>
          <div class="condition-stat">Afecta al 30% de la población mundial</div>
        </div>
      </a>
      <a href="#" class="condition-item">
        <div class="condition-top"><div class="condition-dot"></div><span class="condition-name">Miopía</span><span class="condition-arrow">→</span></div>
        <div class="condition-info">
          <p>La miopía es un error refractivo en el que el globo ocular es demasiado largo. Los objetos lejanos se ven borrosos, mientras que los cercanos se perciben con claridad.</p>
          <div class="condition-tags"><span class="condition-tag">Visión lejana borrosa</span><span class="condition-tag">Globo ocular elongado</span><span class="condition-tag">Progresiva</span></div>
          <div class="condition-stat">2,600 millones de personas afectadas globalmente</div>
        </div>
      </a>
      <a href="#" class="condition-item">
        <div class="condition-top"><div class="condition-dot"></div><span class="condition-name">Hipermetropía</span><span class="condition-arrow">→</span></div>
        <div class="condition-info">
          <p>La hipermetropía ocurre cuando el ojo es más corto de lo normal y la luz se enfoca detrás de la retina. Produce dificultad para ver de cerca y fatiga ocular frecuente.</p>
          <div class="condition-tags"><span class="condition-tag">Visión cercana borrosa</span><span class="condition-tag">Ojo corto</span><span class="condition-tag">Fatiga ocular</span></div>
          <div class="condition-stat">Más común en niños — suele corregirse con el crecimiento</div>
        </div>
      </a>
      <a href="#" class="condition-item">
        <div class="condition-top"><div class="condition-dot"></div><span class="condition-name">Presbicia</span><span class="condition-arrow">→</span></div>
        <div class="condition-info">
          <p>La presbicia es un cambio natural del ojo relacionado con la edad. El cristalino pierde elasticidad y ya no puede enfocar objetos cercanos. Aparece generalmente a partir de los 40 años.</p>
          <div class="condition-tags"><span class="condition-tag">Relacionada con la edad</span><span class="condition-tag">Cristalino rígido</span><span class="condition-tag">Irreversible</span></div>
          <div class="condition-stat">El 100% de adultos mayores de 50 la desarrollan</div>
        </div>
      </a>
    </div>
  </div>
  <div class="showcase-img-wrap">
    <img src="{{ asset('images/lentes.png') }}" alt="Problemas visuales" class="showcase-img">
  </div>
</section>

<!-- HABITS CAROUSEL -->
<section class="habits" id="habitos">
  <div class="habits-header reveal">
    <div>
      <div class="section-label">Bienestar Visual</div>
      <h2 class="section-title">Hábitos para cuidar<br>tu vista</h2>
      <p class="section-sub" style="margin-top:10px">Pequeños cambios diarios que hacen una gran diferencia en la salud de tus ojos.</p>
    </div>
    <div class="habits-nav-btns">
      <button class="carousel-btn" id="prevBtn" aria-label="Anterior"><svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg></button>
      <button class="carousel-btn" id="nextBtn" aria-label="Siguiente"><svg viewBox="0 0 24 24"><polyline points="9 6 15 12 9 18"/></svg></button>
    </div>
  </div>
  <div class="carousel-wrapper">
    <div class="carousel-track" id="carouselTrack">
      <div class="habit-card">
        <div class="habit-icon-wrap" style="background:rgba(107,47,160,0.3)"><svg class="custom-icon" aria-hidden="true"><use href="#icon-ojo"></use></svg><span class="habit-number">1</span></div>
        <div class="habit-title">Regla 20-20-20</div>
        <div class="habit-desc">Cada 20 minutos de pantalla, mira a un objeto a 20 pies de distancia durante 20 segundos.</div>
        <div class="habit-tip"><span class="habit-tip-icon">💡</span> Coloca un recordatorio en tu teléfono cada 20 minutos mientras trabajas.</div>
      </div>
      <div class="habit-card">
        <div class="habit-icon-wrap" style="background:rgba(233,30,140,0.2)">💧<span class="habit-number">2</span></div>
        <div class="habit-title">Hidratación ocular</div>
        <div class="habit-desc">Parpadea conscientemente para mantener los ojos lubricados. La sequedad ocular es uno de los problemas más comunes causados por pantallas.</div>
        <div class="habit-tip"><span class="habit-tip-icon">💡</span> Beber al menos 8 vasos de agua al día también contribuye a la salud de tus ojos.</div>
      </div>
      <div class="habit-card">
        <div class="habit-icon-wrap" style="background:rgba(40,180,100,0.2)"><svg class="custom-icon" aria-hidden="true"><use href="#icon-brocoli"></use></svg><span class="habit-number">3</span></div>
        <div class="habit-title">Nutrición para los ojos</div>
        <div class="habit-desc">Incorpora alimentos ricos en luteína, zeaxantina, vitamina A y omega-3: zanahoria, espinaca, salmón y huevo.</div>
        <div class="habit-tip"><span class="habit-tip-icon">💡</span> Los arándanos y el kale son superalimentos para los ojos por su alto contenido en antioxidantes.</div>
      </div>
      <div class="habit-card">
        <div class="habit-icon-wrap" style="background:rgba(255,180,0,0.2)"><svg class="custom-icon" aria-hidden="true"><use href="#icon-sol"></use></svg><span class="habit-number">4</span></div>
        <div class="habit-title">Protección UV</div>
        <div class="habit-desc">La radiación ultravioleta puede causar daños irreversibles como cataratas. Usa lentes de sol con filtro UV400.</div>
        <div class="habit-tip"><span class="habit-tip-icon">💡</span> Incluso en días nublados, la radiación UV puede alcanzar tus ojos.</div>
      </div>
      <div class="habit-card">
        <div class="habit-icon-wrap" style="background:rgba(100,150,255,0.2)">🌙<span class="habit-number">5</span></div>
        <div class="habit-title">Descanso nocturno</div>
        <div class="habit-desc">Dormir entre 7 y 9 horas permite que tus ojos se recuperen. Evita pantallas al menos una hora antes de dormir.</div>
        <div class="habit-tip"><span class="habit-tip-icon">💡</span> Activa el filtro de luz azul en tus dispositivos a partir de las 8 PM.</div>
      </div>
      <div class="habit-card">
        <div class="habit-icon-wrap" style="background:rgba(180,60,200,0.2)"><svg class="custom-icon" aria-hidden="true"><use href="#icon-corriendo"></use></svg><span class="habit-number">6</span></div>
        <div class="habit-title">Ejercicio físico regular</div>
        <div class="habit-desc">El ejercicio mejora la circulación sanguínea, lo que incluye el flujo de sangre hacia los ojos. Reduce el riesgo de glaucoma.</div>
        <div class="habit-tip"><span class="habit-tip-icon">💡</span> 30 minutos de caminata al día pueden reducir la presión intraocular hasta en un 25%.</div>
      </div>
      <div class="habit-card">
        <div class="habit-icon-wrap" style="background:rgba(255,100,50,0.2)"><svg class="custom-icon" aria-hidden="true"><use href="#icon-estetoscopio"></use></svg><span class="habit-number">7</span></div>
        <div class="habit-title">Revisiones periódicas</div>
        <div class="habit-desc">Acudir al oftalmólogo al menos una vez al año permite detectar enfermedades oculares en etapas tempranas.</div>
        <div class="habit-tip"><span class="habit-tip-icon">💡</span> Si usas lentes o tienes antecedentes familiares, la revisión semestral es lo recomendado.</div>
      </div>
    </div>
  </div>
  <div class="carousel-dots" id="carouselDots"></div>
</section>

<!-- PRODUCTS -->
<section class="products" id="productos">
  <div class="reveal">
    <div class="section-label">Catálogo</div>
    <h2 class="section-title">Encuentra tus lentes perfectos</h2>
    <p class="section-sub">Explora nuestra colección de lentes al estilo 3D.</p>
  </div>
  <a href="{{ route('modelos3d') }}" class="btn-ver-mas">Ver más <span class="arrow">→</span></a>
  <div class="glasses-marquee">
  <div class="glasses-track" id="glassesTrack">
    <div class="glasses-scene">
      <img src="{{ asset('images/Lentes3.png') }}" class="g-img g1" />
      <img src="{{ asset('images/Rectangle 43.png') }}" class="g-img g2" />
      <img src="{{ asset('images/Rectangle 38.png') }}" class="g-img g3" />
      <img src="{{ asset('images/Rectangle 36.png') }}" class="g-img g4" />
      <img src="{{ asset('images/Rectangle 37.png') }}" class="g-img g5" />
      <img src="{{ asset('images/Rectangle 39.png') }}" class="g-img g6" />
      <img src="{{ asset('images/Rectangle 35.png') }}" class="g-img g7" />
      <img src="{{ asset('images/Rectangle 45.png') }}" class="g-img g8" />
      <img src="{{ asset('images/Rectangle 41.png') }}" class="g-img g9" />
    </div>
    <div class="glasses-scene">
      <img src="{{ asset('images/Lentes3.png') }}" class="g-img g1" />
      <img src="{{ asset('images/Rectangle 43.png') }}" class="g-img g2" />
      <img src="{{ asset('images/Rectangle 38.png') }}" class="g-img g3" />
      <img src="{{ asset('images/Rectangle 36.png') }}" class="g-img g4" />
      <img src="{{ asset('images/Rectangle 37.png') }}" class="g-img g5" />
      <img src="{{ asset('images/Rectangle 39.png') }}" class="g-img g6" />
      <img src="{{ asset('images/Rectangle 35.png') }}" class="g-img g7" />
      <img src="{{ asset('images/Rectangle 45.png') }}" class="g-img g8" />
      <img src="{{ asset('images/Rectangle 41.png') }}" class="g-img g9" />
    </div>
  </div>
</div>

  <!-- TRUST BAR -->
  <div class="trust-bar">
    <div class="trust-item"><div class="trust-icon"><svg class="custom-icon" aria-hidden="true"><use href="#icon-trofeo"></use></svg></div><div class="trust-text"><strong>Información de calidad</strong><span>Profesional</span></div></div>
    <div class="trust-item"><div class="trust-icon"><svg class="custom-icon" aria-hidden="true"><use href="#icon-checklist"></use></svg></div><div class="trust-text"><strong>Aprobado por profesionales en la salud</strong><span>Originalidad</span></div></div>
    <div class="trust-item"><div class="trust-icon"><svg class="custom-icon" aria-hidden="true"><use href="#icon-libros"></use></svg></div><div class="trust-text"><strong>Apoyo educativo</strong><span>Verificado</span></div></div>
  </div>
</section>

<!-- ROSTROS Y LENTES -->
<!-- ROSTROS Y LENTES -->
<section id="rostros">
  <p class="section-label">Tipos de Rostro</p>
  <h2 class="section-title">El Lente Perfecto para Cada Rostro</h2>
  <p class="section-sub">La forma de tu rostro determina qué armazón de lentes te favorecerá más.</p>
  <div class="faces-grid">
    <div class="face-card reveal">
      <svg class="face-svg" viewBox="0 0 80 100"><defs><linearGradient id="fg1" x1="0" y1="0" x2="1" y2="1"><stop offset="0%" stop-color="#7b4fcf"/><stop offset="100%" stop-color="#c084fc"/></linearGradient></defs><ellipse cx="40" cy="48" rx="28" ry="38" fill="none" stroke="url(#fg1)" stroke-width="2"/><ellipse cx="27" cy="40" rx="7" ry="4" fill="none" stroke="#c084fc" stroke-width="1.5"/><ellipse cx="53" cy="40" rx="7" ry="4" fill="none" stroke="#c084fc" stroke-width="1.5"/><line x1="34" y1="40" x2="46" y2="40" stroke="#c084fc" stroke-width="1.5"/><path d="M33,65 Q40,70 47,65" stroke="#7b4fcf" stroke-width="1.5" fill="none"/></svg>
      <div class="face-name">Oval</div><div class="face-lens-rec">Compatible con casi todo</div><div class="face-lens-name">Cualquier estilo</div>
    </div>
    <div class="face-card reveal reveal-d1">
      <svg class="face-svg" viewBox="0 0 80 100"><circle cx="40" cy="50" r="34" fill="none" stroke="url(#fg1)" stroke-width="2"/><rect x="20" y="43" width="16" height="10" rx="5" fill="none" stroke="#e879f9" stroke-width="1.5"/><rect x="44" y="43" width="16" height="10" rx="5" fill="none" stroke="#e879f9" stroke-width="1.5"/><line x1="36" y1="48" x2="44" y2="48" stroke="#e879f9" stroke-width="1.5"/><path d="M33,68 Q40,73 47,68" stroke="#7b4fcf" stroke-width="1.5" fill="none"/></svg>
      <div class="face-name">Redondo</div><div class="face-lens-rec">Necesitan angularidad</div><div class="face-lens-name">Rectangulares / Wayfarer</div>
    </div>
    <div class="face-card reveal reveal-d2">
      <svg class="face-svg" viewBox="0 0 80 100"><rect x="12" y="14" width="56" height="68" rx="12" fill="none" stroke="url(#fg1)" stroke-width="2"/><ellipse cx="28" cy="46" rx="8" ry="5" fill="none" stroke="#a78bfa" stroke-width="1.5"/><ellipse cx="52" cy="46" rx="8" ry="5" fill="none" stroke="#a78bfa" stroke-width="1.5"/><line x1="36" y1="46" x2="44" y2="46" stroke="#a78bfa" stroke-width="1.5"/><path d="M32,67 Q40,72 48,67" stroke="#7b4fcf" stroke-width="1.5" fill="none"/></svg>
      <div class="face-name">Cuadrado</div><div class="face-lens-rec">Suavizan facciones</div><div class="face-lens-name">Redondos / Ovalados</div>
    </div>
    <div class="face-card reveal reveal-d3">
      <svg class="face-svg" viewBox="0 0 80 100"><path d="M40,88 Q12,65 12,35 Q12,14 40,18 Q68,14 68,35 Q68,65 40,88Z" fill="none" stroke="url(#fg1)" stroke-width="2"/><path d="M18,42 Q22,36 32,37 Q38,37 38,42 Q38,47 28,47 Q18,47 18,42Z" fill="none" stroke="#e879f9" stroke-width="1.5"/><path d="M42,42 Q42,37 52,37 Q62,36 62,42 Q62,47 52,47 Q42,47 42,42Z" fill="none" stroke="#e879f9" stroke-width="1.5"/><line x1="38" y1="42" x2="42" y2="42" stroke="#e879f9" stroke-width="1.5"/><path d="M32,66 Q40,71 48,66" stroke="#7b4fcf" stroke-width="1.5" fill="none"/></svg>
      <div class="face-name">Corazón</div><div class="face-lens-rec">Equilibran frente ancha</div><div class="face-lens-name">Cat-eye / Aviador</div>
    </div>
    <div class="face-card reveal">
      <svg class="face-svg" viewBox="0 0 80 100"><polygon points="40,10 68,45 40,90 12,45" fill="none" stroke="url(#fg1)" stroke-width="2"/><ellipse cx="27" cy="43" rx="8" ry="5" fill="none" stroke="#67e8f9" stroke-width="1.5"/><ellipse cx="53" cy="43" rx="8" ry="5" fill="none" stroke="#67e8f9" stroke-width="1.5"/><line x1="35" y1="43" x2="45" y2="43" stroke="#67e8f9" stroke-width="1.5"/><path d="M19,43 Q16,38 12,40" stroke="#67e8f9" stroke-width="1.5" fill="none"/><path d="M61,43 Q64,38 68,40" stroke="#67e8f9" stroke-width="1.5" fill="none"/><path d="M32,65 Q40,70 48,65" stroke="#7b4fcf" stroke-width="1.5" fill="none"/></svg>
      <div class="face-name">Diamante</div><div class="face-lens-rec">Destacan los ojos</div><div class="face-lens-name">Ovalados / Sin montura</div>
    </div>
    <div class="face-card reveal reveal-d1">
      <svg class="face-svg" viewBox="0 0 80 100"><ellipse cx="40" cy="50" rx="22" ry="40" fill="none" stroke="url(#fg1)" stroke-width="2"/><rect x="17" y="41" width="18" height="12" rx="6" fill="none" stroke="#c084fc" stroke-width="1.5"/><rect x="45" y="41" width="18" height="12" rx="6" fill="none" stroke="#c084fc" stroke-width="1.5"/><line x1="35" y1="47" x2="45" y2="47" stroke="#c084fc" stroke-width="1.5"/><line x1="17" y1="47" x2="12" y2="45" stroke="#c084fc" stroke-width="1.5"/><line x1="63" y1="47" x2="68" y2="45" stroke="#c084fc" stroke-width="1.5"/><path d="M31,70 Q40,75 49,70" stroke="#7b4fcf" stroke-width="1.5" fill="none"/></svg>
      <div class="face-name">Oblongo</div><div class="face-lens-rec">Dan amplitud visual</div><div class="face-lens-name">Grandes / Decorativos</div>
    </div>
  </div>
</section>
@endsection

@section('scripts')
<script>
// Carousel de hábitos
const track = document.getElementById('carouselTrack');
const dotsContainer = document.getElementById('carouselDots');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
const cards = track.querySelectorAll('.habit-card');
const CARDS_VISIBLE = () => window.innerWidth < 700 ? 1 : window.innerWidth < 1024 ? 2 : 3;
let current = 0;
function totalSlides() { return cards.length - CARDS_VISIBLE() + 1; }
function buildDots() {
  dotsContainer.innerHTML = '';
  for (let i = 0; i < totalSlides(); i++) {
    const d = document.createElement('button');
    d.className = 'carousel-dot' + (i === current ? ' active' : '');
    d.addEventListener('click', () => goTo(i));
    dotsContainer.appendChild(d);
  }
}
function updateDots() { dotsContainer.querySelectorAll('.carousel-dot').forEach((d,i) => d.classList.toggle('active', i === current)); }
function goTo(index) {
  current = Math.max(0, Math.min(index, totalSlides() - 1));
  const cardW = cards[0].offsetWidth + 24;
  track.style.transform = `translateX(-${current * cardW}px)`;
  updateDots();
}
prevBtn.addEventListener('click', () => goTo(current - 1));
nextBtn.addEventListener('click', () => goTo(current + 1));
let autoplay = setInterval(() => goTo((current + 1) % totalSlides()), 4000);
track.addEventListener('pointerdown', () => clearInterval(autoplay));
window.addEventListener('resize', () => { buildDots(); goTo(0); });
buildDots();

// Conditions accordion
document.querySelectorAll('.condition-item').forEach(item => {
  item.addEventListener('click', e => {
    e.preventDefault();
    const isActive = item.classList.contains('active');
    document.querySelectorAll('.condition-item').forEach(i => i.classList.remove('active'));
    if (!isActive) item.classList.add('active');
  });
});

// Glasses marquee
const glassesTrack = document.getElementById('glassesTrack');
glassesTrack.innerHTML += glassesTrack.innerHTML;
let pos = 0, paused = false;
glassesTrack.parentElement.addEventListener('mouseenter', () => paused = true);
glassesTrack.parentElement.addEventListener('mouseleave', () => paused = false);
function animateMarquee() {
  if (!paused) { pos -= 1; if (Math.abs(pos) >= glassesTrack.scrollWidth / 2) pos = 0; glassesTrack.style.transform = `translateX(${pos}px)`; }
  requestAnimationFrame(animateMarquee);
}
animateMarquee();
</script>
@endsection
