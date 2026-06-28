@extends('layouts.app')

@section('title', 'Hábitos — Nebula View')

@section('css')
<link rel="stylesheet" href="{{ asset('css/habitos.css') }}">
@endsection

@section('content')

<div class="page-hero">
  <div class="page-hero-bg"></div>
  <div class="hero-accent-rect"></div>
  <div class="page-hero-title">
    <h1>Hábitos</h1>
    <div class="breadcrumb"><a>Aprende hábitos para cuidar tu visión</a></div>
  </div>
</div>

<div class="page-content">

  <div class="habitos-intro reveal">
    <div class="habitos-intro-text">
      <div class="section-kicker">Información</div>
      <h2>¿Qué son los hábitos en<br><em>la salud visual?</em></h2>
      <p>Los hábitos visuales son todas aquellas prácticas y comportamientos que adoptamos en nuestro día a día y que tienen un impacto directo sobre la salud de nuestros ojos.</p>
      <p>Desarrollar buenos hábitos desde temprana edad es la mejor inversión para conservar una visión nítida y saludable a lo largo de la vida.</p>
      <p>La educación visual es clave: conocer qué actividades favorecen o perjudican la vista nos permite tomar decisiones más conscientes.</p>
      <div class="habitos-highlight">
        <span class="habitos-highlight-icon">👁️</span>
        <p><strong>¿Sabías que?</strong> La fatiga visual ocurre porque al mirar pantallas parpadeamos hasta la mitad de veces de lo normal.</p>
      </div>
    </div>
    <div class="img-placeholder" style="min-height:360px;">
      <img src="{{ asset('images/image 128.png') }}" alt="Hábitos visuales" />
    </div>
  </div>

  <div class="habits-table-section reveal">
    <h2>Hábitos Saludables vs<br><em>Hábitos Incorrectos</em></h2>
    <div class="habits-two-col">
      <div class="habits-col good">
        <div class="habits-col-header"><div class="habits-col-badge">✅</div><h3>Hábitos Saludables</h3></div>
        <div class="habit-item"><div class="habit-bullet"></div><p>Usa gafas de sol con protección UV400 cada vez que salgas al exterior.</p></div>
        <div class="habit-item"><div class="habit-bullet"></div><p>Aplica la regla 20-20-20: cada 20 minutos frente a pantallas, mira a 6 metros durante 20 segundos.</p></div>
        <div class="habit-item"><div class="habit-bullet"></div><p>Realiza revisiones periódicas con un optometrista u oftalmólogo al menos una vez al año.</p></div>
        <div class="habit-item"><div class="habit-bullet"></div><p>Incorpora a tu dieta alimentos ricos en luteína, zeaxantina y vitamina A.</p></div>
        <div class="habit-item"><div class="habit-bullet"></div><p>Mantén una buena hidratación diaria y parpadea conscientemente frente a pantallas.</p></div>
        <div class="habit-item"><div class="habit-bullet"></div><p>Ajusta el brillo y contraste de tus dispositivos al nivel del entorno y usa filtros de luz azul.</p></div>
      </div>
      <div class="habits-col bad">
        <div class="habits-col-header"><div class="habits-col-badge">❌</div><h3>Hábitos Incorrectos</h3></div>
        <div class="habit-item"><div class="habit-bullet"></div><p>No usar protección solar ocular: salir sin gafas de sol acelera el daño UV a largo plazo.</p></div>
        <div class="habit-item"><div class="habit-bullet"></div><p>Usar el teléfono en la oscuridad y a corta distancia incrementa el esfuerzo del músculo ciliar.</p></div>
        <div class="habit-item"><div class="habit-bullet"></div><p>Ignorar síntomas como visión borrosa o dolores de cabeza frecuentes puede retrasar diagnósticos importantes.</p></div>
        <div class="habit-item"><div class="habit-bullet"></div><p>Frotarse los ojos con las manos sin lavarse puede introducir bacterias y dañar la córnea.</p></div>
        <div class="habit-item"><div class="habit-bullet"></div><p>Leer con mala iluminación sobrecarga los músculos extraoculares y provoca fatiga visual crónica.</p></div>
        <div class="habit-item"><div class="habit-bullet"></div><p>Dormir con lentes de contacto puestos aumenta el riesgo de infecciones bacterianas graves.</p></div>
      </div>
    </div>
  </div>

  <div class="sep">
    <div class="sep-inner"><div class="sep-line"></div> ¿Cuándo ver a un profesional? <div class="sep-line"></div></div>
  </div>

  <div id="scene">
    <h2 class="carousel-heading">¿Cuándo ver a un<br><em>profesional?</em></h2>
    <div class="carousel-track-wrap"><div class="carousel-track" id="track"></div></div>
    <div class="nav-row">
      <button class="nav-btn" id="btnPrev"><svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg></button>
      <div class="dots" id="dots"></div>
      <button class="nav-btn" id="btnNext"><svg viewBox="0 0 24 24"><polyline points="9 6 15 12 9 18"/></svg></button>
    </div>
  </div>

</div>
@endsection

@section('scripts')
<script>
const DATA = [
  { tag:'Vision doble, borrosa o mal enfoque', title:'Visión borrosa', color1:'#4a1580', color2:'#7b2fbe', img:'{{ asset("images/Rectangle 25.png") }}', desc:'La visión borrosa puede presentarse de forma ocasional o ser constante. Si persiste, indica la necesidad de una revisión visual con un especialista.', tags:['Descanso','Revisión','Prevención'] },
  { tag:'Cansancio Ocular', title:'Fatiga Visual', color1:'#1a6b3a', color2:'#28a05a', img:'{{ asset("images/Rectangle 26.png") }}', desc:'La fatiga visual es el cansancio de los ojos causado por el uso prolongado de pantallas. Provoca sequedad, ardor, visión borrosa y dolores de cabeza.', tags:['Ojo Seco','Pantallas','Ardor'] },
  { tag:'Familiares con enfermedades oculares', title:'Antecedentes', color1:'#0d3d7a', color2:'#1a6dbf', img:'{{ asset("images/Rectangle 27.png") }}', desc:'Si en tu familia hay cataratas, glaucoma, degeneración macular o diabetes, es importante realizar controles periódicos.', tags:['Familia','Historial','Control'] },
  { tag:'Daños Oculares', title:'Lesiones en los ojos', color1:'#5a1a8a', color2:'#9b59b6', img:'{{ asset("images/lesion.jpg") }}', desc:'Los golpes o lesiones oculares pueden dañar estructuras delicadas del ojo. Ante síntomas como dolor, enrojecimiento o visión borrosa, consulta de inmediato.', tags:['Accidentes','Emergencia','Dolor'] },
  { tag:'Cuidado visual', title:'Revisiones periódicas', color1:'#0a5a6b', color2:'#1a9ab5', img:'{{ asset("images/hidratacionOcular.jpg") }}', desc:'Las revisiones permiten detectar problemas de graduación o enfermedades sin señales evidentes. Se recomienda al menos cada dos años.', tags:['Examen Visual','Síntomas','Bienestar'] },
];
const CARD_W = 320, GAP = 24, VISIBLE = 3, N = DATA.length;
let current = 0;
const track = document.getElementById('track');
const dotsEl = document.getElementById('dots');

function buildCards() {
  track.innerHTML = '';
  DATA.forEach((d, i) => {
    const card = document.createElement('div');
    card.className = 'carousel-card'; card.dataset.idx = i;
    card.innerHTML = `<div class="flip-inner"><div class="flip-face flip-front"><div class="front-img-area"><img src="${d.img}" alt="${d.title}" loading="lazy"></div><div class="front-footer"><div class="front-tag">${d.tag}</div><div class="front-title">${d.title}</div><div class="front-hint">voltear</div></div></div><div class="flip-face flip-back" style="background:linear-gradient(145deg,${d.color1},${d.color2});"><div class="back-tag">${d.tag}</div><div class="back-title">${d.title}</div><div class="back-divider"></div><div class="back-desc">${d.desc}</div><div class="back-tags-wrap">${d.tags.map(t=>`<span class="back-chip">${t}</span>`).join('')}</div></div></div>`;
    card.addEventListener('click', () => card.classList.toggle('flipped'));
    track.appendChild(card);
  });
  dotsEl.innerHTML = '';
  DATA.forEach((_,i)=>{ const dot=document.createElement('div'); dot.className='dot'+(i===0?' active':''); dot.addEventListener('click',()=>goTo(i)); dotsEl.appendChild(dot); });
}

function goTo(idx) {
  current = Math.max(0, Math.min(idx, N-1));
  const stride = CARD_W + GAP;
  const maxOffset = Math.max(0, N - VISIBLE);
  track.style.transform = `translateX(-${Math.min(current, maxOffset) * stride}px)`;
  document.querySelectorAll('.dot').forEach((d,i)=>d.classList.toggle('active',i===current));
  document.querySelectorAll('.carousel-card').forEach(c=>c.classList.remove('flipped'));
}
document.getElementById('btnNext').addEventListener('click',()=>goTo(current+1));
document.getElementById('btnPrev').addEventListener('click',()=>goTo(current-1));
buildCards(); goTo(0);
</script>
@endsection
