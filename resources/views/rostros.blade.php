@extends('layouts.app')

@section('title', 'Rostros - Nebula View')

@section('css')
<link href="{{ asset('css/rostros.css') }}" rel="stylesheet">
@endsection

@section('content')

<!-- HERO -->
<section class="hero">
  <div class="hbc hbc-1"></div>
  <div class="hbc hbc-2"></div>
  <div class="hbc hbc-3"></div>
  <div class="hero-badge"><svg class="hand-icon" width="13" height="13"><use href="#icon-sparkle"></use></svg> Guía de estilo visual</div>
  <h1>El lente perfecto para<br><em>cada rostro</em></h1>
  <p class="hero-desc">Conoce los 6 tipos de rostro y descubre qué monturas te favorecen más. La geometría de tu cara es la clave para elegir el lente ideal.</p>
  <div class="hero-quiz">
    <button class="btn-quiz" onclick="document.getElementById('faces-grid-section').scrollIntoView({behavior:'smooth'})">
      Ver todos los rostros ↓
    </button>
    <a href="{{ route('test') }}" class="btn-outline"><svg class="hand-icon" width="15" height="15"><use href="#icon-scope"></use></svg> Hacer test visual</a>
  </div>
</section>

<!-- QUIZ BANNER -->
<div style="padding:0 0 60px;margin-top:-20px;">
  <div class="quiz-banner reveal">
    <div class="quiz-banner-text" style="position:relative;z-index:2;">
      <h2>¿No sabes la forma de tu cara?</h2>
      <p>Realiza nuestro test interactivo y en menos de 2 minutos descubrirás tu tipo de rostro y recibirás recomendaciones de lentes personalizadas por IA.</p>
    </div>
    <a href="{{ route('test') }}" class="btn-quiz-white">
      <svg class="hand-icon" width="15" height="15"><use href="#icon-scope"></use></svg> Hacer el test gratuito →
    </a>
  </div>
</div>

<!-- FACES SECTION -->
<section class="faces-section" id="faces-grid-section">

  <div class="faces-intro">
    <div>
      <div class="section-kicker">Guía de estilo</div>
      <h2 class="section-title">6 formas de rostro,<br><em>infinitas posibilidades</em></h2>
      <p class="section-sub">La forma de tu cara determina qué montura equilibra mejor tus rasgos. El objetivo es crear contraste con la forma natural del rostro — las caras angulares se benefician de monturas redondeadas, y viceversa.</p>
      <div style="margin-top:28px;display:flex;flex-direction:column;gap:12px;">
        <div style="display:flex;align-items:center;gap:12px;font-size:13.5px;color:var(--text);">
          <div style="width:8px;height:8px;border-radius:50%;background:var(--plum);flex-shrink:0;"></div>
          <span>Caras <strong>ovaladas</strong> — la forma más versátil, casi todo les queda bien</span>
        </div>
        <div style="display:flex;align-items:center;gap:12px;font-size:13.5px;color:var(--text);">
          <div style="width:8px;height:8px;border-radius:50%;background:var(--violet);flex-shrink:0;"></div>
          <span>Caras <strong>angulares</strong> — buscan monturas redondeadas para suavizar</span>
        </div>
        <div style="display:flex;align-items:center;gap:12px;font-size:13.5px;color:var(--text);">
          <div style="width:8px;height:8px;border-radius:50%;background:var(--pink);flex-shrink:0;"></div>
          <span>Caras <strong>redondas</strong> — necesitan ángulos para alargar visualmente el rostro</span>
        </div>
      </div>
    </div>
    <div class="faces-intro-visual reveal">
      <div class="intro-orb">
        <div class="intro-orb-faces">
          <div class="mini-face"><svg class="hand-icon" width="26" height="26" style="color:var(--plum);"><use href="#icon-shape-oval"></use></svg></div>
          <div class="mini-face"><svg class="hand-icon" width="26" height="26" style="color:var(--plum);"><use href="#icon-shape-square"></use></svg></div>
          <div class="mini-face"><svg class="hand-icon" width="26" height="26" style="color:var(--plum);"><use href="#icon-shape-diamond"></use></svg></div>
          <div class="mini-face"><svg class="hand-icon" width="26" height="26" style="color:var(--plum);"><use href="#icon-shape-heart"></use></svg></div>
          <div class="mini-face"><svg class="hand-icon" width="26" height="26" style="color:var(--plum);"><use href="#icon-shape-circle"></use></svg></div>
          <div class="mini-face"><svg class="hand-icon" width="26" height="26" style="color:var(--plum);"><use href="#icon-shape-oblong"></use></svg></div>
        </div>
      </div>
    </div>
  </div>

  <!-- CARDS GRID -->
  <div class="faces-grid" id="faces-grid">

    <!-- ── OVAL ── -->
    <div class="face-card reveal rd1" data-face="oval">
      <div class="card-visual" style="--c1:#6B2FA0;--c2:#3D1A6E;">
        <div class="face-label-top">Forma de cara</div>
        <div class="face-svg-wrap">
          <svg viewBox="0 0 90 110" width="90" xmlns="http://www.w3.org/2000/svg">
            <ellipse cx="45" cy="58" rx="30" ry="42" fill="none" stroke="rgba(255,255,255,0.9)" stroke-width="2.5" class="face-outline"/>
            <ellipse cx="45" cy="58" rx="24" ry="36" fill="rgba(255,255,255,0.06)"/>
            <ellipse cx="33" cy="52" rx="5" ry="3.5" fill="none" stroke="rgba(255,255,255,0.6)" stroke-width="1.5"/>
            <ellipse cx="57" cy="52" rx="5" ry="3.5" fill="none" stroke="rgba(255,255,255,0.6)" stroke-width="1.5"/>
            <path d="M45 58 Q42 64 45 66 Q48 64 45 58" fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="1.2"/>
            <path d="M38 75 Q45 80 52 75" fill="none" stroke="rgba(255,255,255,0.6)" stroke-width="1.5" stroke-linecap="round"/>
            <rect x="26" y="48" width="14" height="9" rx="4" fill="none" stroke="#E91E8C" stroke-width="1.5" class="try-on"/>
            <rect x="50" y="48" width="14" height="9" rx="4" fill="none" stroke="#E91E8C" stroke-width="1.5" class="try-on"/>
            <line x1="40" y1="52.5" x2="50" y2="52.5" stroke="#E91E8C" stroke-width="1.5" class="try-on"/>
          </svg>
        </div>
        <div class="face-name-big">Oval</div>
      </div>
      <div class="card-body">
        <div class="card-match">La más versátil</div>
        <p class="card-desc">El rostro oval tiene proporciones equilibradas — frente ligeramente más ancha que el mentón, con mejillas como la parte más ancha. Es considerado el tipo ideal porque casi cualquier montura le favorece.</p>
        <div class="lens-list">
          <div class="lens-item">
            <div class="lens-item-icon"><svg class="hand-icon" width="18" height="18" style="color:#fff;"><use href="#icon-glasses"></use></svg></div>
            <div class="lens-item-text">
              <div class="lens-item-name">Rectangular / Wayfarer</div>
              <div class="lens-item-why">Añaden estructura sin romper el equilibrio natural</div>
            </div>
          </div>
          <div class="lens-item">
            <div class="lens-item-icon"><svg class="hand-icon" width="18" height="18" style="color:#fff;"><use href="#icon-round-glasses"></use></svg></div>
            <div class="lens-item-text">
              <div class="lens-item-name">Redondas / Aviador</div>
              <div class="lens-item-why">Potencian la suavidad propia del rostro oval</div>
            </div>
          </div>
          <div class="lens-item">
            <div class="lens-item-icon"><svg class="hand-icon" width="18" height="18" style="color:#fff;"><use href="#icon-cateye"></use></svg></div>
            <div class="lens-item-text">
              <div class="lens-item-name">Cat-eye / Geométricas</div>
              <div class="lens-item-why">Añaden personalidad sin perder el balance</div>
            </div>
          </div>
        </div>
        <div class="avoid-section">
          <span class="avoid-icon"><svg class="hand-icon" width="17" height="17" style="color:var(--pink);"><use href="#icon-warning"></use></svg></span>
          <div class="avoid-text">
            <strong>Evitar</strong>
            Monturas que tapen las mejillas o sean desproporcionadamente grandes
          </div>
        </div>
        <button class="card-toggle" onclick="toggleCard(this)">
          Ver consejos y famosos <span class="toggle-arrow">▾</span>
        </button>
      </div>
      <div class="card-expanded">
        <div class="tips-title">Consejos de estilo</div>
        <div class="tips-list">
          <div class="tip-item"><div class="tip-dot"></div>Prueba monturas con decoración en las patillas — serán un detalle sin competir con tus rasgos</div>
          <div class="tip-item"><div class="tip-dot"></div>Las monturas anchas que van de sien a sien te favorecen mucho</div>
          <div class="tip-item"><div class="tip-dot"></div>Experimenta con colores llamativos — tu cara equilibrada los soporta bien</div>
        </div>
        <div class="famous-wrap">
          <div class="famous-title">Famosos con cara oval</div>
          <div class="famous-chips">
            <span class="famous-chip">Beyoncé</span>
            <span class="famous-chip">George Clooney</span>
            <span class="famous-chip">Jessica Alba</span>
            <span class="famous-chip">Adam Levine</span>
          </div>
        </div>
      </div>
    </div>

    <!-- ── REDONDO ── -->
    <div class="face-card reveal rd2" data-face="redondo">
      <div class="card-visual" style="--c1:#2D6FA8;--c2:#1D4A88;">
        <div class="face-label-top">Forma de cara</div>
        <div class="face-svg-wrap">
          <svg viewBox="0 0 90 110" width="90" xmlns="http://www.w3.org/2000/svg">
            <circle cx="45" cy="58" r="34" fill="none" stroke="rgba(255,255,255,0.9)" stroke-width="2.5" class="face-outline"/>
            <circle cx="45" cy="58" r="28" fill="rgba(255,255,255,0.06)"/>
            <ellipse cx="34" cy="52" rx="5" ry="3.5" fill="none" stroke="rgba(255,255,255,0.6)" stroke-width="1.5"/>
            <ellipse cx="56" cy="52" rx="5" ry="3.5" fill="none" stroke="rgba(255,255,255,0.6)" stroke-width="1.5"/>
            <path d="M45 60 Q42 65 45 67 Q48 65 45 60" fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="1.2"/>
            <path d="M38 75 Q45 79 52 75" fill="none" stroke="rgba(255,255,255,0.6)" stroke-width="1.5" stroke-linecap="round"/>
            <rect x="25" y="47" width="16" height="9" rx="2" fill="none" stroke="#E91E8C" stroke-width="1.5" class="try-on"/>
            <rect x="49" y="47" width="16" height="9" rx="2" fill="none" stroke="#E91E8C" stroke-width="1.5" class="try-on"/>
            <line x1="41" y1="51.5" x2="49" y2="51.5" stroke="#E91E8C" stroke-width="1.5" class="try-on"/>
          </svg>
        </div>
        <div class="face-name-big">Redondo</div>
      </div>
      <div class="card-body">
        <div class="card-match">Necesita angularidad</div>
        <p class="card-desc">El rostro redondo tiene anchura y altura similares, con mejillas llenas y mentón suave. Las monturas angulares y rectangulares crean contraste visual que estiliza y alarga el rostro.</p>
        <div class="lens-list">
          <div class="lens-item">
            <div class="lens-item-icon"><svg class="hand-icon" width="18" height="18" style="color:#fff;"><use href="#icon-rect-glasses"></use></svg></div>
            <div class="lens-item-text">
              <div class="lens-item-name">Rectangulares / Cuadradas</div>
              <div class="lens-item-why">Alargan visualmente el rostro con sus ángulos definidos</div>
            </div>
          </div>
          <div class="lens-item">
            <div class="lens-item-icon"><svg class="hand-icon" width="18" height="18" style="color:#fff;"><use href="#icon-aviator"></use></svg></div>
            <div class="lens-item-text">
              <div class="lens-item-name">Wayfarer / D-frame</div>
              <div class="lens-item-why">El borde superior recto crea la ilusión de cara más larga</div>
            </div>
          </div>
          <div class="lens-item">
            <div class="lens-item-icon"><svg class="hand-icon" width="18" height="18" style="color:#fff;"><use href="#icon-hex-glasses"></use></svg></div>
            <div class="lens-item-text">
              <div class="lens-item-name">Geométricas / Hexagonales</div>
              <div class="lens-item-why">Los ángulos pronunciados rompen la redondez del rostro</div>
            </div>
          </div>
        </div>
        <div class="avoid-section">
          <span class="avoid-icon"><svg class="hand-icon" width="17" height="17" style="color:var(--pink);"><use href="#icon-warning"></use></svg></span>
          <div class="avoid-text">
            <strong>Evitar</strong>
            Monturas redondas o ovaladas que acentúen la redondez del rostro
          </div>
        </div>
        <button class="card-toggle" onclick="toggleCard(this)">
          Ver consejos y famosos <span class="toggle-arrow">▾</span>
        </button>
      </div>
      <div class="card-expanded">
        <div class="tips-title">Consejos de estilo</div>
        <div class="tips-list">
          <div class="tip-item"><div class="tip-dot"></div>Elige monturas más anchas que altas — la horizontalidad alarga visualmente</div>
          <div class="tip-item"><div class="tip-dot"></div>Las patillas finas y altas generan la ilusión de cara más angosta</div>
          <div class="tip-item"><div class="tip-dot"></div>Evita monturas con borde inferior muy curvado</div>
        </div>
        <div class="famous-wrap">
          <div class="famous-title">Famosos con cara redonda</div>
          <div class="famous-chips">
            <span class="famous-chip">Selena Gomez</span>
            <span class="famous-chip">Channing Tatum</span>
            <span class="famous-chip">Mila Kunis</span>
            <span class="famous-chip">Jack Black</span>
          </div>
        </div>
      </div>
    </div>

    <!-- ── CUADRADO ── -->
    <div class="face-card reveal rd3" data-face="cuadrado">
      <div class="card-visual" style="--c1:#2DAA78;--c2:#1D8060;">
        <div class="face-label-top">Forma de cara</div>
        <div class="face-svg-wrap">
          <svg viewBox="0 0 90 110" width="90" xmlns="http://www.w3.org/2000/svg">
            <rect x="16" y="20" width="58" height="76" rx="10" fill="none" stroke="rgba(255,255,255,0.9)" stroke-width="2.5" class="face-outline"/>
            <rect x="22" y="26" width="46" height="64" rx="7" fill="rgba(255,255,255,0.06)"/>
            <ellipse cx="33" cy="52" rx="5" ry="3.5" fill="none" stroke="rgba(255,255,255,0.6)" stroke-width="1.5"/>
            <ellipse cx="57" cy="52" rx="5" ry="3.5" fill="none" stroke="rgba(255,255,255,0.6)" stroke-width="1.5"/>
            <path d="M45 60 Q42 65 45 67 Q48 65 45 60" fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="1.2"/>
            <path d="M37 77 Q45 82 53 77" fill="none" stroke="rgba(255,255,255,0.6)" stroke-width="1.5" stroke-linecap="round"/>
            <circle cx="34" cy="51" r="7" fill="none" stroke="#E91E8C" stroke-width="1.5" class="try-on"/>
            <circle cx="56" cy="51" r="7" fill="none" stroke="#E91E8C" stroke-width="1.5" class="try-on"/>
            <line x1="41" y1="51" x2="49" y2="51" stroke="#E91E8C" stroke-width="1.5" class="try-on"/>
          </svg>
        </div>
        <div class="face-name-big">Cuadrado</div>
      </div>
      <div class="card-body">
        <div class="card-match">Suaviza los ángulos</div>
        <p class="card-desc">El rostro cuadrado tiene una mandíbula fuerte y definida, con frente ancha y proporciones similares en altura y anchura. Las monturas redondeadas suavizan sus rasgos angulares y crean armonía.</p>
        <div class="lens-list">
          <div class="lens-item">
            <div class="lens-item-icon"><svg class="hand-icon" width="18" height="18" style="color:#fff;"><use href="#icon-round-glasses"></use></svg></div>
            <div class="lens-item-text">
              <div class="lens-item-name">Redondas / Circulares</div>
              <div class="lens-item-why">Contrastan con la mandíbula fuerte y ablandan el conjunto</div>
            </div>
          </div>
          <div class="lens-item">
            <div class="lens-item-icon"><svg class="hand-icon" width="18" height="18" style="color:#fff;"><use href="#icon-oval-glasses"></use></svg></div>
            <div class="lens-item-text">
              <div class="lens-item-name">Ovaladas / Soft rectangulares</div>
              <div class="lens-item-why">Equilibran sin quitar protagonismo a los rasgos fuertes</div>
            </div>
          </div>
          <div class="lens-item">
            <div class="lens-item-icon"><svg class="hand-icon" width="18" height="18" style="color:#fff;"><use href="#icon-aviator"></use></svg></div>
            <div class="lens-item-text">
              <div class="lens-item-name">Aviador / Club master</div>
              <div class="lens-item-why">La parte superior recta y el fondo curvo crean el contraste ideal</div>
            </div>
          </div>
        </div>
        <div class="avoid-section">
          <span class="avoid-icon"><svg class="hand-icon" width="17" height="17" style="color:var(--pink);"><use href="#icon-warning"></use></svg></span>
          <div class="avoid-text">
            <strong>Evitar</strong>
            Monturas cuadradas o angulares que dupliquen la rigidez del rostro
          </div>
        </div>
        <button class="card-toggle" onclick="toggleCard(this)">
          Ver consejos y famosos <span class="toggle-arrow">▾</span>
        </button>
      </div>
      <div class="card-expanded">
        <div class="tips-title">Consejos de estilo</div>
        <div class="tips-list">
          <div class="tip-item"><div class="tip-dot"></div>Las monturas con mucho detalle decorativo ayudan a desviar la atención de la mandíbula</div>
          <div class="tip-item"><div class="tip-dot"></div>Monturas sin borde (rimless) o semimontadas son muy favorables</div>
          <div class="tip-item"><div class="tip-dot"></div>Elige lentes más altos que anchos para alargar el rostro</div>
        </div>
        <div class="famous-wrap">
          <div class="famous-title">Famosos con cara cuadrada</div>
          <div class="famous-chips">
            <span class="famous-chip">Angelina Jolie</span>
            <span class="famous-chip">Brad Pitt</span>
            <span class="famous-chip">Olivia Wilde</span>
            <span class="famous-chip">Henry Cavill</span>
          </div>
        </div>
      </div>
    </div>

    <!-- ── CORAZÓN ── -->
    <div class="face-card reveal rd4" data-face="corazon">
      <div class="card-visual" style="--c1:#E91E8C;--c2:#9B2070;">
        <div class="face-label-top">Forma de cara</div>
        <div class="face-svg-wrap">
          <svg viewBox="0 0 90 110" width="90" xmlns="http://www.w3.org/2000/svg">
            <path d="M45 100 Q18 78 16 52 Q14 28 32 22 Q42 18 45 28 Q48 18 58 22 Q76 28 74 52 Q72 78 45 100 Z" fill="none" stroke="rgba(255,255,255,0.9)" stroke-width="2.5" class="face-outline"/>
            <path d="M45 95 Q22 75 21 52 Q20 32 35 26 Q43 22 45 31 Q47 22 55 26 Q70 32 69 52 Q68 75 45 95 Z" fill="rgba(255,255,255,0.06)"/>
            <ellipse cx="34" cy="50" rx="5" ry="3.5" fill="none" stroke="rgba(255,255,255,0.6)" stroke-width="1.5"/>
            <ellipse cx="56" cy="50" rx="5" ry="3.5" fill="none" stroke="rgba(255,255,255,0.6)" stroke-width="1.5"/>
            <path d="M45 58 Q42 63 45 65 Q48 63 45 58" fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="1.2"/>
            <path d="M38 73 Q45 78 52 73" fill="none" stroke="rgba(255,255,255,0.6)" stroke-width="1.5" stroke-linecap="round"/>
            <path d="M24 47 Q26 42 34 43 Q40 43 40 48 Q40 53 32 53 Q24 53 24 47Z" fill="none" stroke="rgba(255,255,255,0.8)" stroke-width="1.4" class="try-on"/>
            <path d="M50 48 Q50 43 58 43 Q66 42 66 47 Q66 53 58 53 Q50 53 50 48Z" fill="none" stroke="rgba(255,255,255,0.8)" stroke-width="1.4" class="try-on"/>
            <line x1="40" y1="48" x2="50" y2="48" stroke="rgba(255,255,255,0.8)" stroke-width="1.4" class="try-on"/>
          </svg>
        </div>
        <div class="face-name-big">Corazón</div>
      </div>
      <div class="card-body">
        <div class="card-match">Equilibra la frente</div>
        <p class="card-desc">El rostro en forma de corazón tiene frente ancha, pómulos prominentes y mentón estrecho y afilado. El objetivo es equilibrar añadiendo visualmente volumen en la parte inferior del rostro.</p>
        <div class="lens-list">
          <div class="lens-item">
            <div class="lens-item-icon"><svg class="hand-icon" width="18" height="18" style="color:#fff;"><use href="#icon-cateye"></use></svg></div>
            <div class="lens-item-text">
              <div class="lens-item-name">Cat-eye / Aviador</div>
              <div class="lens-item-why">Equilibran la frente ancha con su borde superior elevado</div>
            </div>
          </div>
          <div class="lens-item">
            <div class="lens-item-icon"><svg class="hand-icon" width="18" height="18" style="color:#fff;"><use href="#icon-butterfly-glasses"></use></svg></div>
            <div class="lens-item-text">
              <div class="lens-item-name">Mariposa / Oversized</div>
              <div class="lens-item-why">Añaden presencia en la parte baja del rostro visualmente</div>
            </div>
          </div>
          <div class="lens-item">
            <div class="lens-item-icon"><svg class="hand-icon" width="18" height="18" style="color:#fff;"><use href="#icon-round-glasses"></use></svg></div>
            <div class="lens-item-text">
              <div class="lens-item-name">Redondas bajas / Rimless</div>
              <div class="lens-item-why">Restan peso a la frente sin llamar demasiado la atención</div>
            </div>
          </div>
        </div>
        <div class="avoid-section">
          <span class="avoid-icon"><svg class="hand-icon" width="17" height="17" style="color:var(--pink);"><use href="#icon-warning"></use></svg></span>
          <div class="avoid-text">
            <strong>Evitar</strong>
            Monturas con mucho detalle en la parte superior que acrecenten la frente
          </div>
        </div>
        <button class="card-toggle" onclick="toggleCard(this)">
          Ver consejos y famosos <span class="toggle-arrow">▾</span>
        </button>
      </div>
      <div class="card-expanded">
        <div class="tips-title">Consejos de estilo</div>
        <div class="tips-list">
          <div class="tip-item"><div class="tip-dot"></div>Busca monturas con más ancho abajo que arriba — los modelos cat-eye invertido son perfectos</div>
          <div class="tip-item"><div class="tip-dot"></div>Los lentes sin aro o con aro fino son muy favorecedores</div>
          <div class="tip-item"><div class="tip-dot"></div>Evita decoraciones o colores llamativos en la parte superior del armazón</div>
        </div>
        <div class="famous-wrap">
          <div class="famous-title">Famosos con cara de corazón</div>
          <div class="famous-chips">
            <span class="famous-chip">Reese Witherspoon</span>
            <span class="famous-chip">Ryan Gosling</span>
            <span class="famous-chip">Scarlett Johansson</span>
          </div>
        </div>
      </div>
    </div>

    <!-- ── DIAMANTE ── -->
    <div class="face-card reveal rd5" data-face="diamante">
      <div class="card-visual" style="--c1:#A84F2F;--c2:#7A3018;">
        <div class="face-label-top">Forma de cara</div>
        <div class="face-svg-wrap">
          <svg viewBox="0 0 90 110" width="90" xmlns="http://www.w3.org/2000/svg">
            <polygon points="45,12 74,50 45,98 16,50" fill="none" stroke="rgba(255,255,255,0.9)" stroke-width="2.5" class="face-outline"/>
            <polygon points="45,18 70,50 45,90 20,50" fill="rgba(255,255,255,0.06)"/>
            <ellipse cx="34" cy="48" rx="5" ry="3.5" fill="none" stroke="rgba(255,255,255,0.6)" stroke-width="1.5"/>
            <ellipse cx="56" cy="48" rx="5" ry="3.5" fill="none" stroke="rgba(255,255,255,0.6)" stroke-width="1.5"/>
            <path d="M45 56 Q42 61 45 63 Q48 61 45 56" fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="1.2"/>
            <path d="M38 72 Q45 77 52 72" fill="none" stroke="rgba(255,255,255,0.6)" stroke-width="1.5" stroke-linecap="round"/>
            <ellipse cx="34" cy="47" rx="8" ry="5.5" fill="none" stroke="rgba(255,255,255,0.8)" stroke-width="1.5" class="try-on"/>
            <ellipse cx="56" cy="47" rx="8" ry="5.5" fill="none" stroke="rgba(255,255,255,0.8)" stroke-width="1.5" class="try-on"/>
            <line x1="42" y1="47" x2="48" y2="47" stroke="rgba(255,255,255,0.8)" stroke-width="1.5" class="try-on"/>
          </svg>
        </div>
        <div class="face-name-big">Diamante</div>
      </div>
      <div class="card-body">
        <div class="card-match">Destaca los ojos</div>
        <p class="card-desc">El rostro diamante tiene pómulos amplios y prominentes con frente y mentón más estrechos. Es una forma poco común y muy particular. El objetivo es resaltar los ojos y equilibrar la anchura de los pómulos.</p>
        <div class="lens-list">
          <div class="lens-item">
            <div class="lens-item-icon"><svg class="hand-icon" width="18" height="18" style="color:#fff;"><use href="#icon-oval-glasses"></use></svg></div>
            <div class="lens-item-text">
              <div class="lens-item-name">Ovaladas / Sin montura</div>
              <div class="lens-item-why">Equilibran los pómulos sin añadir más anchura</div>
            </div>
          </div>
          <div class="lens-item">
            <div class="lens-item-icon"><svg class="hand-icon" width="18" height="18" style="color:#fff;"><use href="#icon-cateye"></use></svg></div>
            <div class="lens-item-text">
              <div class="lens-item-name">Cat-eye con detalle superior</div>
              <div class="lens-item-why">Añaden anchura a la frente para equilibrar los pómulos</div>
            </div>
          </div>
          <div class="lens-item">
            <div class="lens-item-icon"><svg class="hand-icon" width="18" height="18" style="color:#fff;"><use href="#icon-glasses"></use></svg></div>
            <div class="lens-item-text">
              <div class="lens-item-name">Rectangular estrecha</div>
              <div class="lens-item-why">Minimizan el ancho de los pómulos con su silueta vertical</div>
            </div>
          </div>
        </div>
        <div class="avoid-section">
          <span class="avoid-icon"><svg class="hand-icon" width="17" height="17" style="color:var(--pink);"><use href="#icon-warning"></use></svg></span>
          <div class="avoid-text">
            <strong>Evitar</strong>
            Monturas muy anchas que exageren el ancho de los pómulos
          </div>
        </div>
        <button class="card-toggle" onclick="toggleCard(this)">
          Ver consejos y famosos <span class="toggle-arrow">▾</span>
        </button>
      </div>
      <div class="card-expanded">
        <div class="tips-title">Consejos de estilo</div>
        <div class="tips-list">
          <div class="tip-item"><div class="tip-dot"></div>Monturas con decoración en las esquinas superiores amplían la apariencia de la frente</div>
          <div class="tip-item"><div class="tip-dot"></div>Los lentes semimontados o rimless son una opción muy elegante</div>
          <div class="tip-item"><div class="tip-dot"></div>Cualquier montura que no sea más ancha que tus pómulos funcionará bien</div>
        </div>
        <div class="famous-wrap">
          <div class="famous-title">Famosos con cara diamante</div>
          <div class="famous-chips">
            <span class="famous-chip">Rihanna</span>
            <span class="famous-chip">Johnny Depp</span>
            <span class="famous-chip">Ashley Judd</span>
          </div>
        </div>
      </div>
    </div>

    <!-- ── OBLONGO ── -->
    <div class="face-card reveal rd6" data-face="oblongo">
      <div class="card-visual" style="--c1:#5B7BDE;--c2:#3A5AB8;">
        <div class="face-label-top">Forma de cara</div>
        <div class="face-svg-wrap">
          <svg viewBox="0 0 90 110" width="90" xmlns="http://www.w3.org/2000/svg">
            <ellipse cx="45" cy="58" rx="24" ry="44" fill="none" stroke="rgba(255,255,255,0.9)" stroke-width="2.5" class="face-outline"/>
            <ellipse cx="45" cy="58" rx="18" ry="38" fill="rgba(255,255,255,0.06)"/>
            <ellipse cx="34" cy="50" rx="5" ry="3.5" fill="none" stroke="rgba(255,255,255,0.6)" stroke-width="1.5"/>
            <ellipse cx="56" cy="50" rx="5" ry="3.5" fill="none" stroke="rgba(255,255,255,0.6)" stroke-width="1.5"/>
            <path d="M45 58 Q42 63 45 65 Q48 63 45 58" fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="1.2"/>
            <path d="M38 76 Q45 81 52 76" fill="none" stroke="rgba(255,255,255,0.6)" stroke-width="1.5" stroke-linecap="round"/>
            <rect x="22" y="46" width="18" height="9" rx="4" fill="none" stroke="rgba(255,255,255,0.8)" stroke-width="1.5" class="try-on"/>
            <rect x="50" y="46" width="18" height="9" rx="4" fill="none" stroke="rgba(255,255,255,0.8)" stroke-width="1.5" class="try-on"/>
            <line x1="40" y1="50.5" x2="50" y2="50.5" stroke="rgba(255,255,255,0.8)" stroke-width="1.5" class="try-on"/>
          </svg>
        </div>
        <div class="face-name-big">Oblongo</div>
      </div>
      <div class="card-body">
        <div class="card-match">Añade amplitud</div>
        <p class="card-desc">El rostro oblongo (o alargado) es más largo que ancho, con frente, mejillas y mandíbula de anchura similar. Las monturas anchas y decorativas dan amplitud y rompen la verticalidad del rostro.</p>
        <div class="lens-list">
          <div class="lens-item">
            <div class="lens-item-icon"><svg class="hand-icon" width="18" height="18" style="color:#fff;"><use href="#icon-oversized-glasses"></use></svg></div>
            <div class="lens-item-text">
              <div class="lens-item-name">Oversized / Grandes y anchas</div>
              <div class="lens-item-why">Dan proporciones horizontales que equilibran la longitud</div>
            </div>
          </div>
          <div class="lens-item">
            <div class="lens-item-icon"><svg class="hand-icon" width="18" height="18" style="color:#fff;"><use href="#icon-ornament"></use></svg></div>
            <div class="lens-item-text">
              <div class="lens-item-name">Decorativas / Club master</div>
              <div class="lens-item-why">El detalle en la parte superior interrumpe la longitud del rostro</div>
            </div>
          </div>
          <div class="lens-item">
            <div class="lens-item-icon"><svg class="hand-icon" width="18" height="18" style="color:#fff;"><use href="#icon-rect-glasses"></use></svg></div>
            <div class="lens-item-text">
              <div class="lens-item-name">Rectangulares con borde grueso</div>
              <div class="lens-item-why">La presencia del armazón añade anchura y carácter</div>
            </div>
          </div>
        </div>
        <div class="avoid-section">
          <span class="avoid-icon"><svg class="hand-icon" width="17" height="17" style="color:var(--pink);"><use href="#icon-warning"></use></svg></span>
          <div class="avoid-text">
            <strong>Evitar</strong>
            Monturas pequeñas, estrechas o sin aro que alarguen aún más el rostro
          </div>
        </div>
        <button class="card-toggle" onclick="toggleCard(this)">
          Ver consejos y famosos <span class="toggle-arrow">▾</span>
        </button>
      </div>
      <div class="card-expanded">
        <div class="tips-title">Consejos de estilo</div>
        <div class="tips-list">
          <div class="tip-item"><div class="tip-dot"></div>Busca monturas con puente bajo — reduce visualmente la longitud del rostro</div>
          <div class="tip-item"><div class="tip-dot"></div>Las patillas decorativas horizontales también suman anchura</div>
          <div class="tip-item"><div class="tip-dot"></div>Tonos oscuros y monturas con armazón completo te favorecen más</div>
        </div>
        <div class="famous-wrap">
          <div class="famous-title">Famosos con cara oblonga</div>
          <div class="famous-chips">
            <span class="famous-chip">Sarah Jessica Parker</span>
            <span class="famous-chip">Ben Affleck</span>
            <span class="famous-chip">Liv Tyler</span>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- COMPARISON TABLE -->
<section class="compare-section reveal">
  <div class="section-kicker" style="margin-bottom:12px;">Referencia rápida</div>
  <h2 class="section-title" style="margin-bottom:8px;">Tabla comparativa <em>completa</em></h2>
  <p class="section-sub" style="margin-bottom:32px;">Todas las formas de rostro y sus monturas ideales de un solo vistazo.</p>

  <div class="compare-table-wrap">
    <table>
      <thead>
        <tr>
          <th>Rostro</th>
          <th>Rectangulares</th>
          <th>Redondas</th>
          <th>Cat-eye</th>
          <th>Aviador</th>
          <th>Oversized</th>
          <th>Sin montura</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><svg class="hand-icon" width="14" height="14" style="color:#6B2FA0;vertical-align:-2px;"><use href="#icon-shape-oval"></use></svg> Oval</td>
          <td><span class="yes">✓ Ideal</span></td>
          <td><span class="yes">✓ Bien</span></td>
          <td><span class="yes">✓ Bien</span></td>
          <td><span class="yes">✓ Bien</span></td>
          <td><span class="yes">✓ Bien</span></td>
          <td><span class="yes">✓ Bien</span></td>
        </tr>
        <tr>
          <td><svg class="hand-icon" width="14" height="14" style="color:#2D6FA8;vertical-align:-2px;"><use href="#icon-shape-circle"></use></svg> Redondo</td>
          <td><span class="yes">✓ Ideal</span></td>
          <td><span class="no">✗ Evitar</span></td>
          <td><span class="yes">✓ Bien</span></td>
          <td><span class="yes">✓ Bien</span></td>
          <td><span class="yes">✓ Bien</span></td>
          <td><span class="no">✗ Evitar</span></td>
        </tr>
        <tr>
          <td><svg class="hand-icon" width="14" height="14" style="color:#2DAA78;vertical-align:-2px;"><use href="#icon-shape-square"></use></svg> Cuadrado</td>
          <td><span class="no">✗ Evitar</span></td>
          <td><span class="yes">✓ Ideal</span></td>
          <td><span class="yes">✓ Bien</span></td>
          <td><span class="yes">✓ Ideal</span></td>
          <td><span class="yes">✓ Bien</span></td>
          <td><span class="yes">✓ Bien</span></td>
        </tr>
        <tr>
          <td><svg class="hand-icon" width="14" height="14" style="color:#E91E8C;vertical-align:-2px;"><use href="#icon-shape-heart"></use></svg> Corazón</td>
          <td><span class="no">✗ Evitar</span></td>
          <td><span class="yes">✓ Bien</span></td>
          <td><span class="yes">✓ Ideal</span></td>
          <td><span class="yes">✓ Ideal</span></td>
          <td><span class="yes">✓ Bien</span></td>
          <td><span class="yes">✓ Bien</span></td>
        </tr>
        <tr>
          <td><svg class="hand-icon" width="14" height="14" style="color:#A84F2F;vertical-align:-2px;"><use href="#icon-shape-diamond"></use></svg> Diamante</td>
          <td><span class="yes">✓ Bien</span></td>
          <td><span class="yes">✓ Bien</span></td>
          <td><span class="yes">✓ Ideal</span></td>
          <td><span class="no">✗ Evitar</span></td>
          <td><span class="no">✗ Evitar</span></td>
          <td><span class="yes">✓ Ideal</span></td>
        </tr>
        <tr>
          <td><svg class="hand-icon" width="14" height="14" style="color:#5B7BDE;vertical-align:-2px;"><use href="#icon-shape-oblong"></use></svg> Oblongo</td>
          <td><span class="yes">✓ Bien</span></td>
          <td><span class="yes">✓ Bien</span></td>
          <td><span class="no">✗ Evitar</span></td>
          <td><span class="yes">✓ Bien</span></td>
          <td><span class="yes">✓ Ideal</span></td>
          <td><span class="no">✗ Evitar</span></td>
        </tr>
      </tbody>
    </table>
  </div>
</section>

<!-- TIPS STRIP -->
<div class="tips-strip reveal">
  <div class="strip-item">
    <div class="strip-icon"><svg class="hand-icon" width="22" height="22" style="color:#fff;"><use href="#icon-ruler"></use></svg></div>
    <h4>Mide tu rostro</h4>
    <p>Compara el ancho de tu frente, pómulos y mandíbula para identificar tu forma</p>
  </div>
  <div class="strip-item">
    <div class="strip-icon"><svg class="hand-icon" width="22" height="22" style="color:#fff;"><use href="#icon-mirror"></use></svg></div>
    <h4>Contraste es clave</h4>
    <p>Elige monturas que contrasten con la forma de tu cara, no que la repitan</p>
  </div>
  <div class="strip-item">
    <div class="strip-icon"><svg class="hand-icon" width="22" height="22" style="color:#fff;"><use href="#icon-sparkle"></use></svg></div>
    <h4>Las reglas no son absolutas</h4>
    <p>El estilo personal puede romper cualquier regla — úsalas como guía, no como límite</p>
  </div>
  <div class="strip-item">
    <div class="strip-icon"><svg class="hand-icon" width="22" height="22" style="color:#fff;"><use href="#icon-scope"></use></svg></div>
    <h4>Haz el test IA</h4>
    <p>Nuestro asistente analiza tus rasgos y te recomienda lentes con precisión</p>
  </div>
</div>



@include('partials.comentarios', ['pagina' => 'rostros'])
@endsection

@section('scripts')
<script>
// Toggle card expand
function toggleCard(btn) {
  btn.classList.toggle('open');
  const expanded = btn.closest('.card-body').nextElementSibling;
  expanded.classList.toggle('show');
}

// Inclinación sutil de las tarjetas de rostro al seguir el cursor,
// como si se sostuviera una ficha física en la mano.
(function () {
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const coarsePointer = window.matchMedia('(pointer: coarse)').matches;
  if (reduceMotion || coarsePointer) return;

  document.querySelectorAll('.face-card').forEach(function (card) {
    card.addEventListener('mousemove', function (e) {
      const r = card.getBoundingClientRect();
      const px = (e.clientX - r.left) / r.width;
      const py = (e.clientY - r.top) / r.height;
      card.style.setProperty('--rx', ((py - 0.5) * -7).toFixed(2) + 'deg');
      card.style.setProperty('--ry', ((px - 0.5) * 9).toFixed(2) + 'deg');
    });
    card.addEventListener('mouseleave', function () {
      card.style.setProperty('--rx', '0deg');
      card.style.setProperty('--ry', '0deg');
    });
  });
})();
</script>
@endsection