@extends('layouts.app')
 
@section('title', 'Problemas Visuales — Nebula View')
 
@section('css')
<link rel="stylesheet" href="{{ asset('css/stylepv.css') }}">
@endsection
 
@section('content')
<!-- HERO BANNER -->
<div class="page-hero">
  <div class="page-hero-bg"></div>
  <div class="hero-accent-rect"></div>
  <div class="page-hero-title">
    <h1>Problemas Visuales</h1>
    <div class="breadcrumb">
      <a >Conoce más sobre las enfermedades visuales </a>
    </div>
  </div>
</div>
 
<!-- MAIN CONTENT -->
<div class="page-content">
 
  <!-- ¿QUÉ SON LOS PROBLEMAS VISUALES? -->
  <div class="what-section reveal">
 
    <div class="what-intro">
      <div class="what-text">
        <div class="section-kicker">Información</div>
        <h2>¿Qué son los<br><em>problemas visuales?</em></h2>
        <p>Los problemas visuales son alteraciones en el sistema óptico del ojo o en las vías nerviosas que transmiten la información visual al cerebro. Pueden afectar la nitidez, el campo visual, la percepción del color o la capacidad de enfocar a diferentes distancias.</p>
        <p>Algunos surgen desde el nacimiento, otros se desarrollan con la edad o por factores externos como el uso prolongado de pantallas, la exposición solar sin protección o enfermedades sistémicas como la diabetes.</p>
        <div class="what-highlight">
          <span class="what-highlight-icon">👁️</span>
          <p><strong>¿Sabías que?</strong> Más del 80% de los problemas visuales son evitables o tratables si se detectan a tiempo mediante revisiones periódicas con un profesional de la salud visual.</p>
        </div>
      </div>
 
      <div class="what-visual">
        <div class="anatomy-wrap">
          <!-- Floating stat chips -->
          <div class="stat-chip chip-1">
            <div class="stat-chip-icon">👥</div>
            <div class="stat-chip-text">
              <strong>2.2 mil millones</strong>
              <span>personas con discapacidad visual</span>
            </div>
          </div>
          <div class="stat-chip chip-2">
            <div class="stat-chip-icon">🌍</div>
            <div class="stat-chip-text">
              <strong>80% prevenibles</strong>
              <span>con detección temprana</span>
            </div>
          </div>
          <div class="stat-chip chip-3">
            <div class="stat-chip-icon">📅</div>
            <div class="stat-chip-text">
              <strong>1 vez al año</strong>
              <span>revisión recomendada</span>
            </div>
          </div>
 
          <div class="anatomy-circle">
            <svg viewBox="0 0 280 280" width="240" xmlns="http://www.w3.org/2000/svg">
              <ellipse cx="140" cy="140" rx="115" ry="95" fill="white" opacity="0.95"/>
              <path d="M 50 130 Q 80 125 100 140" fill="none" stroke="rgba(220,100,100,0.3)" stroke-width="1.5"/>
              <path d="M 55 155 Q 85 148 105 145" fill="none" stroke="rgba(220,100,100,0.25)" stroke-width="1.2"/>
              <path d="M 220 130 Q 190 125 170 140" fill="none" stroke="rgba(220,100,100,0.3)" stroke-width="1.5"/>
              <path d="M 215 155 Q 185 148 165 145" fill="none" stroke="rgba(220,100,100,0.25)" stroke-width="1.2"/>
              <circle cx="140" cy="140" r="62" fill="#7B5CB8"/>
              <circle cx="140" cy="140" r="54" fill="none" stroke="#6B4CA8" stroke-width="2" opacity="0.6"/>
              <circle cx="140" cy="140" r="44" fill="none" stroke="#5B3C98" stroke-width="1.5" opacity="0.5"/>
              <line x1="140" y1="80" x2="140" y2="95" stroke="#8B6CC8" stroke-width="1.2" opacity="0.4"/>
              <line x1="183" y1="97" x2="172" y2="108" stroke="#8B6CC8" stroke-width="1.2" opacity="0.4"/>
              <line x1="200" y1="140" x2="185" y2="140" stroke="#8B6CC8" stroke-width="1.2" opacity="0.4"/>
              <line x1="183" y1="183" x2="172" y2="172" stroke="#8B6CC8" stroke-width="1.2" opacity="0.4"/>
              <line x1="140" y1="200" x2="140" y2="185" stroke="#8B6CC8" stroke-width="1.2" opacity="0.4"/>
              <line x1="97" y1="183" x2="108" y2="172" stroke="#8B6CC8" stroke-width="1.2" opacity="0.4"/>
              <line x1="80" y1="140" x2="95" y2="140" stroke="#8B6CC8" stroke-width="1.2" opacity="0.4"/>
              <line x1="97" y1="97" x2="108" y2="108" stroke="#8B6CC8" stroke-width="1.2" opacity="0.4"/>
              <circle cx="140" cy="140" r="28" fill="#1A0A2E"/>
              <circle cx="140" cy="140" r="20" fill="#0A0510"/>
              <ellipse cx="150" cy="128" rx="10" ry="6" fill="rgba(255,255,255,0.65)" transform="rotate(-25,150,128)"/>
              <ellipse cx="130" cy="152" rx="5" ry="3" fill="rgba(255,255,255,0.3)" transform="rotate(-25,130,152)"/>
              <path d="M 28 140 Q 70 60 140 55 Q 210 60 252 140" fill="rgba(232,168,124,0.7)" stroke="#C4856A" stroke-width="3" stroke-linecap="round"/>
              <path d="M 28 140 Q 70 210 140 215 Q 210 210 252 140" fill="rgba(232,168,124,0.4)" stroke="#C4856A" stroke-width="3" stroke-linecap="round"/>
              <line x1="65" y1="100" x2="55" y2="82" stroke="#2D1B4E" stroke-width="2.5" stroke-linecap="round"/>
              <line x1="90" y1="75" x2="85" y2="56" stroke="#2D1B4E" stroke-width="2.5" stroke-linecap="round"/>
              <line x1="118" y1="60" x2="116" y2="40" stroke="#2D1B4E" stroke-width="2.5" stroke-linecap="round"/>
              <line x1="140" y1="56" x2="140" y2="36" stroke="#2D1B4E" stroke-width="2.5" stroke-linecap="round"/>
              <line x1="162" y1="60" x2="164" y2="40" stroke="#2D1B4E" stroke-width="2.5" stroke-linecap="round"/>
              <line x1="190" y1="75" x2="195" y2="56" stroke="#2D1B4E" stroke-width="2.5" stroke-linecap="round"/>
              <line x1="215" y1="100" x2="225" y2="82" stroke="#2D1B4E" stroke-width="2.5" stroke-linecap="round"/>
              <line x1="80" y1="190" x2="72" y2="206" stroke="#2D1B4E" stroke-width="2" stroke-linecap="round" opacity="0.7"/>
              <line x1="110" y1="205" x2="106" y2="222" stroke="#2D1B4E" stroke-width="2" stroke-linecap="round" opacity="0.7"/>
              <line x1="140" y1="212" x2="140" y2="228" stroke="#2D1B4E" stroke-width="2" stroke-linecap="round" opacity="0.7"/>
              <line x1="170" y1="205" x2="174" y2="222" stroke="#2D1B4E" stroke-width="2" stroke-linecap="round" opacity="0.7"/>
              <line x1="200" y1="190" x2="208" y2="206" stroke="#2D1B4E" stroke-width="2" stroke-linecap="round" opacity="0.7"/>
            </svg>
          </div>
        </div>
      </div>
    </div>
 
    <!-- Types of visual problems -->
    <div class="types-title reveal">
      <h3>Clasificación de los problemas visuales</h3>
      <p>Existen diferentes categorías según su origen y mecanismo</p>
    </div>
 
    <div class="types-grid reveal">
      <div class="type-card refractivo">
        <div class="type-card-header">
          <div class="type-icon">🔭</div>
          <div>
            <h4>Defectos refractivos</h4>
            <div class="type-badge">Más comunes · 60% de casos</div>
          </div>
        </div>
        <p>Ocurren cuando el ojo no puede enfocar correctamente la luz sobre la retina debido a la forma del globo ocular o la curvatura de la córnea. Son los más frecuentes y generalmente tienen solución óptica sencilla.</p>
        <div class="type-examples">
          <span class="type-tag">Miopía</span>
          <span class="type-tag">Hipermetropía</span>
          <span class="type-tag">Astigmatismo</span>
          <span class="type-tag">Presbicia</span>
        </div>
      </div>
 
      <div class="type-card degenerativo">
        <div class="type-card-header">
          <div class="type-icon">⏳</div>
          <div>
            <h4>Enfermedades degenerativas</h4>
            <div class="type-badge">Relacionadas con la edad</div>
          </div>
        </div>
        <p>Se desarrollan de forma progresiva, generalmente asociadas al envejecimiento o a factores genéticos. Requieren seguimiento médico continuo y en muchos casos tratamiento especializado.</p>
        <div class="type-examples">
          <span class="type-tag">Glaucoma</span>
          <span class="type-tag">DMAE</span>
          <span class="type-tag">Retinopatía</span>
          <span class="type-tag">Cataratas</span>
        </div>
      </div>
 
      <div class="type-card infeccioso">
        <div class="type-card-header">
          <div class="type-icon">🦠</div>
          <div>
            <h4>Infecciones e inflamaciones</h4>
            <div class="type-badge">Causas externas</div>
          </div>
        </div>
        <p>Producidas por bacterias, virus, hongos o reacciones alérgicas que afectan estructuras del ojo como la conjuntiva, la córnea o el iris. Suelen ser tratables con medicación adecuada.</p>
        <div class="type-examples">
          <span class="type-tag">Conjuntivitis</span>
          <span class="type-tag">Uveítis</span>
          <span class="type-tag">Queratitis</span>
          <span class="type-tag">Blefaritis</span>
        </div>
      </div>
 
      <div class="type-card neurologico">
        <div class="type-card-header">
          <div class="type-icon">🧠</div>
          <div>
            <h4>Alteraciones neurológicas</h4>
            <div class="type-badge">Vías visuales y cerebro</div>
          </div>
        </div>
        <p>Afectan el nervio óptico o las áreas cerebrales responsables del procesamiento visual. Pueden manifestarse como pérdida de campo visual, visión doble o dificultad para interpretar imágenes.</p>
        <div class="type-examples">
          <span class="type-tag">Neuritis óptica</span>
          <span class="type-tag">Estrabismo</span>
          <span class="type-tag">Ambliopía</span>
          <span class="type-tag">Diplopía</span>
        </div>
      </div>
    </div>
 
    <!-- Causes strip -->
    <div class="causes-strip reveal">
      <div class="cause-item">
        <div class="cause-icon-wrap">🧬</div>
        <h5>Genética</h5>
        <p>Predisposición hereditaria a ciertos defectos visuales</p>
      </div>
      <div class="cause-item">
        <div class="cause-icon-wrap">📱</div>
        <h5>Pantallas digitales</h5>
        <p>Fatiga ocular por uso prolongado sin descanso</p>
      </div>
      <div class="cause-item">
        <div class="cause-icon-wrap">☀️</div>
        <h5>Radiación UV</h5>
        <p>Daño acumulado por exposición solar sin protección</p>
      </div>
      <div class="cause-item">
        <div class="cause-icon-wrap">🎂</div>
        <h5>Envejecimiento</h5>
        <p>Cambios naturales en el cristalino y la retina con la edad</p>
      </div>
    </div>
 
  </div>
 
  <!-- CAROUSEL SEPARATOR -->
  <div style="text-align:center;margin-bottom:40px;">
    <div style="display:inline-flex;align-items:center;gap:14px;color:var(--muted);font-size:13px;">
      <div style="width:60px;height:1px;background:var(--lilac);"></div>
      Problemas visuales más comunes
      <div style="width:60px;height:1px;background:var(--lilac);"></div>
    </div>
  </div>
 
  <!-- Visual Conditions Carousel -->
  <div class="vc-section reveal">
 
    <!-- Dot decorations -->
    <div class="dots-deco left">
      <span></span><span></span><span></span><span></span><span></span><span></span>
      <span></span><span></span><span></span><span></span><span></span><span></span>
      <span></span><span></span><span></span><span></span><span></span><span></span>
      <span></span><span></span><span></span><span></span><span></span><span></span>
      <span></span><span></span><span></span><span></span><span></span><span></span>
      <span></span><span></span><span></span><span></span><span></span><span></span>
    </div>
    <div class="dots-deco right">
      <span></span><span></span><span></span><span></span><span></span><span></span>
      <span></span><span></span><span></span><span></span><span></span><span></span>
      <span></span><span></span><span></span><span></span><span></span><span></span>
      <span></span><span></span><span></span><span></span><span></span><span></span>
      <span></span><span></span><span></span><span></span><span></span><span></span>
      <span></span><span></span><span></span><span></span><span></span><span></span>
    </div>
 
    <div class="vc-heading">
      <h2>Problemas visuales más comunes</h2>
      <div class="vc-heading-line"></div>
    </div>
 
    <!-- THE CARD (JS swaps content) -->
    <div class="vc-card active" id="vcCard">
      <div class="vc-visual">
        <div class="eye-circle" id="eyeCircle">
          <!-- SVG injected by JS -->
        </div>
      </div>
      <div class="vc-info" id="vcInfo">
        <!-- Content injected by JS -->
      </div>
    </div>
 
    <!-- Controls -->
    <div class="vc-controls">
      <button class="vc-nav-btn" id="vcPrev" aria-label="Anterior">
        <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
      </button>
      <div class="vc-dots" id="vcDots"></div>
      <button class="vc-nav-btn" id="vcNext" aria-label="Siguiente">
        <svg viewBox="0 0 24 24"><polyline points="9 6 15 12 9 18"/></svg>
      </button>
    </div>
  </div>
 
  <!-- Info cards below -->
  <div class="info-grid">
    <div class="info-card reveal reveal-delay-1">
      <div class="info-card-icon">🔬</div>
      <h3>¿Cómo se diagnostican?</h3>
      <p>Los problemas visuales se detectan mediante exámenes optométricos completos. Un profesional evalúa la agudeza visual, la refracción y la salud ocular general.</p>
    </div>
    <div class="info-card reveal reveal-delay-2">
      <div class="info-card-icon">💊</div>
      <h3>Tratamientos disponibles</h3>
      <p>La mayoría de los defectos refractivos se corrigen con lentes graduados, lentes de contacto o cirugía refractiva como el LASIK, dependiendo del caso clínico.</p>
    </div>
    <div class="info-card reveal reveal-delay-3">
      <div class="info-card-icon">📅</div>
      <h3>Revisiones recomendadas</h3>
      <p>Se recomienda visitar al oftalmólogo al menos una vez al año, o con mayor frecuencia si ya tiene algún problema visual diagnosticado o antecedentes familiares.</p>
    </div>
  </div>
 
</div>
@endsection
 
@section('scripts')
<script>
// ── ENRICHED DATA ──
const conditions = [
  {
    name: 'Astigmatismo',
    type: 'defecto refractivo',
    description: 'El astigmatismo es un problema refractivo que se produce cuando la córnea no presenta la misma curvatura en todas sus zonas, impidiendo que la luz se enfoque correctamente en la retina.',
    color: 'linear-gradient(135deg, #7B3FC4 0%, #9B45D4 40%, #6B25A8 100%)',
    headerColor: 'linear-gradient(135deg, #7B3FC4 0%, #9B45D4 50%, #6B25A8 100%)',
    eyeSVG: `<svg viewBox="0 0 150 150" xmlns="http://www.w3.org/2000/svg" class="eye-svg">
      <ellipse cx="75" cy="75" rx="68" ry="58" fill="#FFF5E8"/>
      <circle cx="75" cy="75" r="38" fill="#C87941"/>
      <circle cx="75" cy="75" r="32" fill="none" stroke="#B06830" stroke-width="1.5" opacity="0.6"/>
      <circle cx="75" cy="75" r="25" fill="none" stroke="#A05820" stroke-width="1" opacity="0.5"/>
      <ellipse cx="75" cy="75" rx="14" ry="18" fill="#1A0A0A"/>
      <ellipse cx="82" cy="66" rx="6" ry="4" fill="rgba(255,255,255,0.75)" transform="rotate(-20,82,66)"/>
      <path d="M 40 55 Q 75 48 110 55" fill="none" stroke="#E8A060" stroke-width="1.2" opacity="0.5"/>
      <path d="M 38 95 Q 75 102 112 95" fill="none" stroke="#E8A060" stroke-width="1.2" opacity="0.5"/>
      <path d="M 10 75 Q 40 30 75 28 Q 110 30 140 75" fill="none" stroke="#D4956A" stroke-width="4" stroke-linecap="round"/>
      <path d="M 10 75 Q 40 118 75 120 Q 110 118 140 75" fill="none" stroke="#D4956A" stroke-width="4" stroke-linecap="round"/>
      <line x1="30" y1="50" x2="24" y2="38" stroke="#8B4513" stroke-width="2" stroke-linecap="round"/>
      <line x1="50" y1="36" x2="47" y2="23" stroke="#8B4513" stroke-width="2" stroke-linecap="round"/>
      <line x1="75" y1="30" x2="75" y2="17" stroke="#8B4513" stroke-width="2" stroke-linecap="round"/>
      <line x1="100" y1="36" x2="103" y2="23" stroke="#8B4513" stroke-width="2" stroke-linecap="round"/>
      <line x1="120" y1="50" x2="126" y2="38" stroke="#8B4513" stroke-width="2" stroke-linecap="round"/>
    </svg>`,
    detail: {
      stats: [
        { value: '30%', label: 'de la población mundial lo padece' },
        { value: '2', label: 'tipos principales: corneal y lenticular' },
        { value: '100%', label: 'tratable con corrección óptica' },
      ],
      cause: 'El astigmatismo ocurre cuando la córnea o el cristalino tienen una forma irregular, similar a un balón de rugby en lugar de una esfera perfecta. Esto hace que la luz se enfoque en múltiples puntos de la retina en lugar de uno solo, generando imágenes borrosas o distorsionadas a cualquier distancia.',
      symptoms: ['Visión borrosa o distorsionada', 'Dolores de cabeza frecuentes', 'Fatiga ocular', 'Necesidad de entrecerrar los ojos', 'Dificultad con la visión nocturna', 'Sensibilidad a la luz'],
      treatments: [
        'Lentes graduados con prescripción cilíndrica',
        'Lentes de contacto tóricas',
        'Cirugía LASIK o PRK',
        'Ortoqueratología (lentes nocturnos)',
      ],
      lenses: [
        { icon: '👓', name: 'Lentes cilíndricas', desc: 'Corrección exacta por zonas' },
        { icon: '🥽', name: 'Lentes tóricas', desc: 'Contacto especializado' },
        { icon: '✨', name: 'LASIK', desc: 'Corrección permanente' },
      ],
      tip: '¡Buenas noticias! El astigmatismo es muy fácil de corregir. Una revisión optométrica anual permite mantener la graduación actualizada y evitar el cansancio visual acumulado.',
    }
  },
  {
    name: 'Miopía',
    type: 'defecto refractivo',
    description: 'La miopía es un error refractivo muy común en el que los objetos cercanos se ven con claridad, pero los lejanos aparecen borrosos. Ocurre cuando el globo ocular es demasiado largo o la córnea tiene demasiada curvatura.',
    color: 'linear-gradient(135deg, #2D6FA8 0%, #4A8AC4 40%, #1D5888 100%)',
    headerColor: 'linear-gradient(135deg, #1D5888 0%, #2D7FC8 50%, #1A4A78 100%)',
    eyeSVG: `<svg viewBox="0 0 150 150" xmlns="http://www.w3.org/2000/svg" class="eye-svg">
      <ellipse cx="75" cy="75" rx="68" ry="58" fill="#FFF5E8"/>
      <circle cx="75" cy="75" r="40" fill="#4A6FA8"/>
      <circle cx="75" cy="75" r="33" fill="none" stroke="#3A5F98" stroke-width="1.5" opacity="0.6"/>
      <ellipse cx="75" cy="75" rx="68" ry="58" fill="none" stroke="#D4A080" stroke-width="2" stroke-dasharray="4,3" opacity="0.3"/>
      <circle cx="75" cy="75" r="20" fill="#0A0A1A"/>
      <circle cx="75" cy="75" r="48" fill="none" stroke="rgba(100,140,200,0.15)" stroke-width="6"/>
      <circle cx="75" cy="75" r="55" fill="none" stroke="rgba(100,140,200,0.08)" stroke-width="8"/>
      <ellipse cx="83" cy="65" rx="7" ry="5" fill="rgba(255,255,255,0.7)" transform="rotate(-15,83,65)"/>
      <path d="M 10 75 Q 40 30 75 28 Q 110 30 140 75" fill="none" stroke="#D4956A" stroke-width="4" stroke-linecap="round"/>
      <path d="M 10 75 Q 40 118 75 120 Q 110 118 140 75" fill="none" stroke="#D4956A" stroke-width="4" stroke-linecap="round"/>
    </svg>`,
    detail: {
      stats: [
        { value: '2.6B', label: 'personas afectadas en el mundo' },
        { value: '50%', label: 'de la población global para 2050' },
        { value: '-0.25', label: 'dioptría mínima para diagnóstico' },
      ],
      cause: 'La miopía se desarrolla cuando el globo ocular crece demasiado en longitud axial, o cuando la córnea tiene una curvatura excesiva. Esto causa que los rayos de luz paralelos se enfoquen frente a la retina en lugar de sobre ella. Factores genéticos y el uso prolongado de pantallas aceleran su progresión.',
      symptoms: ['Dificultad para ver lejos', 'Ver bien de cerca', 'Entrecerrar los ojos constantemente', 'Dolores de cabeza al conducir', 'Fatiga al ver pantallas lejanas', 'Dificultad para ver la pizarra'],
      treatments: [
        'Lentes divergentes (cóncavos) de graduación negativa',
        'Lentes de contacto blandas o rígidas',
        'Cirugía LASIK, LASEK o SMILE',
        'Gotas de atropina para frenar progresión en niños',
      ],
      lenses: [
        { icon: '👓', name: 'Lentes cóncavos', desc: 'Corrección con prescripción negativa' },
        { icon: '🌙', name: 'Ortoqueratología', desc: 'Lentes nocturnos remodeladores' },
        { icon: '⚡', name: 'SMILE / LASIK', desc: 'Cirugía láser de precisión' },
      ],
      tip: 'Reduce el tiempo frente a pantallas y toma descansos frecuentes mirando al horizonte. La exposición a la luz natural al aire libre puede ayudar a frenar la progresión de la miopía en niños y jóvenes.',
    }
  },
  {
    name: 'Hipermetropía',
    type: 'defecto refractivo',
    description: 'La hipermetropía ocurre cuando el globo ocular es más corto de lo normal o la córnea tiene poca curvatura. La luz se enfoca detrás de la retina, generando visión borrosa de cerca y, en casos severos, también de lejos.',
    color: 'linear-gradient(135deg, #2DAA78 0%, #48C490 40%, #1D9A68 100%)',
    headerColor: 'linear-gradient(135deg, #1D8A60 0%, #2DAA78 50%, #157050 100%)',
    eyeSVG: `<svg viewBox="0 0 150 150" xmlns="http://www.w3.org/2000/svg" class="eye-svg">
      <ellipse cx="75" cy="75" rx="68" ry="58" fill="#FFF5E8"/>
      <circle cx="75" cy="75" r="36" fill="#5A9E72"/>
      <circle cx="75" cy="75" r="30" fill="none" stroke="#4A8E62" stroke-width="1.5" opacity="0.7"/>
      <circle cx="75" cy="75" r="22" fill="none" stroke="#3A7E52" stroke-width="1" opacity="0.5"/>
      <circle cx="75" cy="75" r="11" fill="#0A0A0A"/>
      <line x1="60" y1="75" x2="115" y2="75" stroke="rgba(255,220,100,0.5)" stroke-width="1.5" stroke-dasharray="3,2"/>
      <circle cx="115" cy="75" r="4" fill="rgba(255,220,100,0.4)"/>
      <ellipse cx="81" cy="66" rx="6" ry="4" fill="rgba(255,255,255,0.75)" transform="rotate(-20,81,66)"/>
      <path d="M 10 75 Q 40 30 75 28 Q 110 30 140 75" fill="none" stroke="#D4956A" stroke-width="4" stroke-linecap="round"/>
      <path d="M 10 75 Q 40 118 75 120 Q 110 118 140 75" fill="none" stroke="#D4956A" stroke-width="4" stroke-linecap="round"/>
    </svg>`,
    detail: {
      stats: [
        { value: '10%', label: 'de la población la padece' },
        { value: '+1.00', label: 'dioptría o más para corrección' },
        { value: '3x', label: 'más común en niños pequeños' },
      ],
      cause: 'En la hipermetropía el globo ocular es demasiado corto en su diámetro anteroposterior, o la córnea y el cristalino tienen poca potencia de refracción. La luz que entra al ojo converge en un punto detrás de la retina. En casos leves, el músculo ciliar puede compensarlo esforzándose, lo que genera fatiga ocular.',
      symptoms: ['Dificultad para enfocar de cerca', 'Cansancio al leer o usar pantallas', 'Dolores de cabeza frontales', 'Ojos rojos después de leer', 'Visión borrosa en casos severos también de lejos', 'Estrabismo en niños'],
      treatments: [
        'Lentes convergentes (convexas) con graduación positiva',
        'Lentes de contacto esféricas positivas',
        'Cirugía refractiva LASIK o LASEK',
        'Terapia visual en casos de estrabismo acomodativo',
      ],
      lenses: [
        { icon: '👓', name: 'Lentes convexas', desc: 'Prescripción positiva (+)' },
        { icon: '💧', name: 'Lentes blandas', desc: 'Contacto para corrección cercana' },
        { icon: '🎯', name: 'LASEK', desc: 'Alternativa al LASIK' },
      ],
      tip: 'Es normal que los bebés nazcan hipermétropes de forma leve: el ojo sigue creciendo hasta los 7-8 años y suele corregirse solo. Sin embargo, si persiste, es importante corregirlo pronto para evitar el "ojo vago" (ambliopía).',
    }
  },
  {
    name: 'Presbicia',
    type: 'defecto de acomodación',
    description: 'La presbicia es una condición ocular natural relacionada con el envejecimiento que reduce la capacidad del ojo de enfocar objetos cercanos. Generalmente aparece a partir de los 40 años por el endurecimiento progresivo del cristalino.',
    color: 'linear-gradient(135deg, #A84F2F 0%, #C46040 40%, #883F1F 100%)',
    headerColor: 'linear-gradient(135deg, #883F1F 0%, #B85030 50%, #702F10 100%)',
    eyeSVG: `<svg viewBox="0 0 150 150" xmlns="http://www.w3.org/2000/svg" class="eye-svg">
      <ellipse cx="75" cy="75" rx="68" ry="58" fill="#FFF8E8"/>
      <circle cx="75" cy="75" r="36" fill="#8A7050"/>
      <circle cx="75" cy="75" r="30" fill="none" stroke="#7A6040" stroke-width="2" opacity="0.6"/>
      <circle cx="75" cy="75" r="23" fill="none" stroke="#6A5030" stroke-width="1.5" opacity="0.4"/>
      <circle cx="75" cy="75" r="17" fill="rgba(255,240,200,0.25)" stroke="rgba(200,180,120,0.4)" stroke-width="1.5"/>
      <circle cx="75" cy="75" r="12" fill="#1A0A0A"/>
      <ellipse cx="80" cy="68" rx="5" ry="3.5" fill="rgba(255,255,255,0.65)" transform="rotate(-15,80,68)"/>
      <path d="M 8 65 Q 5 75 8 85" fill="none" stroke="rgba(180,140,100,0.4)" stroke-width="1.5"/>
      <path d="M 142 65 Q 145 75 142 85" fill="none" stroke="rgba(180,140,100,0.4)" stroke-width="1.5"/>
      <path d="M 12 58 Q 8 50 15 45" fill="none" stroke="rgba(180,140,100,0.3)" stroke-width="1.2"/>
      <path d="M 138 58 Q 142 50 135 45" fill="none" stroke="rgba(180,140,100,0.3)" stroke-width="1.2"/>
      <path d="M 10 78 Q 40 32 75 30 Q 110 32 140 78" fill="none" stroke="#C4856A" stroke-width="4" stroke-linecap="round"/>
      <path d="M 10 78 Q 40 116 75 118 Q 110 116 140 78" fill="none" stroke="#C4856A" stroke-width="4" stroke-linecap="round"/>
    </svg>`,
    detail: {
      stats: [
        { value: '+40', label: 'años, edad típica de aparición' },
        { value: '1,800M', label: 'personas afectadas en el mundo' },
        { value: '100%', label: 'de adultos mayores la desarrollan' },
      ],
      cause: 'Con el paso de los años, el cristalino del ojo pierde elasticidad y se vuelve más rígido. Esto impide que el músculo ciliar pueda cambiar su forma para enfocar objetos cercanos — proceso llamado "acomodación". Es un proceso natural e irreversible que le ocurre a todas las personas.',
      symptoms: ['Dificultad para leer de cerca', 'Necesidad de alejar el libro o pantalla', 'Fatiga al leer bajo poca luz', 'Dolores de cabeza después de leer', 'Necesidad de más iluminación', 'Letras borrosas al despertar'],
      treatments: [
        'Lentes de lectura (monocales) con graduación positiva',
        'Lentes progresivos (multifocales)',
        'Lentes de contacto multifocales',
        'Cirugía de intercambio de cristalino (CLE)',
      ],
      lenses: [
        { icon: '📖', name: 'Lentes de lectura', desc: 'Para uso en distancia corta' },
        { icon: '🌈', name: 'Progresivos', desc: 'Corrección para todas las distancias' },
        { icon: '🔄', name: 'Multifocales', desc: 'Lentes de contacto avanzadas' },
      ],
      tip: 'Los lentes progresivos modernos son prácticamente invisibles (sin la línea visible de los bifocales). Permiten ver bien de cerca, a distancia intermedia y de lejos con una sola montura — ideales para el uso diario.',
    }
  }
];
 
// ── CAROUSEL STATE ──
let current = 0;
const card = document.getElementById('vcCard');
const eyeCircle = document.getElementById('eyeCircle');
const vcInfo = document.getElementById('vcInfo');
const dotsContainer = document.getElementById('vcDots');
 
function buildDots() {
  dotsContainer.innerHTML = '';
  conditions.forEach((_, i) => {
    const d = document.createElement('button');
    d.className = 'vc-dot' + (i === current ? ' active' : '');
    d.addEventListener('click', () => goTo(i));
    dotsContainer.appendChild(d);
  });
}
 
function updateDots() {
  dotsContainer.querySelectorAll('.vc-dot').forEach((d, i) => d.classList.toggle('active', i === current));
}
 
function renderCard(idx, direction = 'none') {
  const c = conditions[idx];
  if (direction !== 'none') {
    card.classList.remove('active');
    card.classList.add(direction === 'next' ? 'exit' : 'enter');
    setTimeout(() => {
      injectContent(c);
      card.classList.remove('exit', 'enter');
      card.classList.add('enter');
      card.style.background = c.color;
      void card.offsetWidth;
      card.classList.remove('enter');
      card.classList.add('active');
    }, 320);
  } else {
    injectContent(c);
    card.style.background = c.color;
    card.classList.add('active');
  }
  updateDots();
}
 
function injectContent(c) {
  eyeCircle.innerHTML = c.eyeSVG;
  vcInfo.innerHTML = `
    <div class="vc-condition-name">${c.name}</div>
    <div class="vc-condition-type">${c.type}</div>
    <div class="vc-divider"></div>
    <p class="vc-description">${c.description}</p>
    <button class="vc-btn" onclick="openModal(${conditions.indexOf(c)})">Ver más →</button>
  `;
}
 
function goTo(idx, direction) {
  if (idx === current) return;
  const dir = direction || (idx > current ? 'next' : 'prev');
  current = (idx + conditions.length) % conditions.length;
  renderCard(current, dir);
}
 
document.getElementById('vcPrev').addEventListener('click', () => goTo(current - 1, 'prev'));
document.getElementById('vcNext').addEventListener('click', () => goTo(current + 1, 'next'));
 
let auto = setInterval(() => goTo(current + 1, 'next'), 5000);
card.addEventListener('mouseenter', () => clearInterval(auto));
card.addEventListener('mouseleave', () => { auto = setInterval(() => goTo(current + 1, 'next'), 5000); });
 
let touchStart = 0;
card.addEventListener('touchstart', e => { touchStart = e.touches[0].clientX; clearInterval(auto); });
card.addEventListener('touchend', e => {
  const diff = touchStart - e.changedTouches[0].clientX;
  if (Math.abs(diff) > 50) goTo(current + (diff > 0 ? 1 : -1));
});
 
// ── MODAL (el overlay/close ya los maneja el layout; aquí solo abrimos) ──
const modalHeader = document.getElementById('modalHeader');
const modalHeaderContent = document.getElementById('modalHeaderContent');
const modalBody = document.getElementById('modalBody');
const overlay = document.getElementById('modalOverlay');
 
function openModal(idx) {
  const c = conditions[idx];
  const d = c.detail;
 
  modalHeader.style.background = c.headerColor;
 
  modalHeaderContent.innerHTML = `
    <div class="modal-badge">${c.type}</div>
    <h2 class="modal-title">${c.name}</h2>
    <p class="modal-subtitle">Guía completa sobre esta condición visual</p>
  `;
 
  modalBody.innerHTML = `
    <div class="modal-stats">
      ${d.stats.map(s => `
        <div class="modal-stat">
          <div class="modal-stat-value">${s.value}</div>
          <div class="modal-stat-label">${s.label}</div>
        </div>`).join('')}
    </div>
 
    <div class="modal-section">
      <div class="modal-section-title">¿Qué la causa?</div>
      <p class="modal-text">${d.cause}</p>
    </div>
 
    <div class="modal-section">
      <div class="modal-section-title">Síntomas frecuentes</div>
      <div class="modal-tags">
        ${d.symptoms.map(s => `<span class="modal-tag">• ${s}</span>`).join('')}
      </div>
    </div>
 
    <div class="modal-section">
      <div class="modal-section-title">Opciones de tratamiento</div>
      <ul class="modal-list">
        ${d.treatments.map(t => `<li><div class="modal-list-dot"></div>${t}</li>`).join('')}
      </ul>
    </div>
 
    <div class="modal-section">
      <div class="modal-section-title">Lentes recomendados</div>
      <div class="modal-lens-rec">
        ${d.lenses.map(l => `
          <div class="lens-rec-card">
            <div class="lens-rec-icon">${l.icon}</div>
            <div class="lens-rec-name">${l.name}</div>
            <div class="lens-rec-desc">${l.desc}</div>
          </div>`).join('')}
      </div>
    </div>
 
    <div class="modal-tip-box">
      <div class="modal-tip-icon">💡</div>
      <div class="modal-tip-text">
        <strong>Consejo de Nebula View</strong>
        ${d.tip}
      </div>
    </div>
  `;
 
  overlay.classList.add('open');
  document.body.style.overflow = 'hidden';
}
 
// Init
buildDots();
renderCard(0);
</script>
@endsection