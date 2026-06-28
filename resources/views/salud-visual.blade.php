@extends('layouts.app')

@section('title', 'Salud Visual — Nebula View')

@section('css')
<link rel="stylesheet" href="{{ asset('css/saludvisual1.css') }}">
@endsection

@section('content')

<div class="page-hero">
  <div class="page-hero-bg"></div>
  <div class="hero-accent-rect"></div>
  <div class="page-hero-title">
    <h1>Salud Visual</h1>
    <div class="breadcrumb"><a>Aprende a cuidar y proteger tu visión</a></div>
  </div>
</div>

<div class="page-content">

  <div class="sv-intro reveal">
    <div class="sv-text">
      <div class="section-kicker">Información</div>
      <h2>¿Qué es la<br><em>salud visual?</em></h2>
      <p>La salud visual se refiere al conjunto de condiciones que permiten al ojo funcionar de forma óptima, permitiendo la percepción clara del entorno.</p>
      <p>Mantener una buena salud visual es fundamental para realizar actividades cotidianas como leer, conducir o usar dispositivos digitales.</p>
      <p>Los exámenes oculares regulares pueden detectar no solo problemas de la vista, sino también enfermedades sistémicas como la diabetes o hipertensión.</p>
      <div class="sv-highlight">
        <span class="sv-highlight-icon">👁️</span>
        <p><strong>¿Sabías que?</strong> Existe un pequeño punto en cada ojo llamado "punto ciego" donde el nervio óptico se une con la retina. En esta área no hay células sensibles a la luz, por lo que técnicamente no podemos ver. </p>
      </div>
    </div>
    <div class="img-placeholder" style="min-height:360px;">
      <img src="{{ asset('images/image 117.png') }}" alt="Salud visual" />
    </div>
  </div>

  <div class="importance-section reveal">
    <h2>¿Cuál es su importancia<br><em>en nuestra vida?</em></h2>
    <div class="importance-grid">
      <div class="importance-list-block">
        <p>Los ojos son fundamentales para realizar con eficiencia actividades cotidianas. La visión afecta directamente nuestro rendimiento y bienestar:</p>
        <ul class="importance-list">
          <li><div class="imp-dot"></div>Calidad de vida: La vista permite interactuar con el mundo con claridad y confianza.</li>
          <li><div class="imp-dot"></div>Seguridad y desempeño: Una buena visión es clave para conducir y actividades laborales.</li>
          <li><div class="imp-dot"></div>Detección temprana: Los exámenes regulares pueden revelar condiciones como la diabetes.</li>
          <li><div class="imp-dot"></div>Independencia: Una buena visión es esencial para mantener la autonomía personal.</li>
        </ul>
      </div>
      <div class="img-placeholder" style="min-height:320px;">
        <img src="{{ asset('images/image 126.png') }}" alt="Importancia salud visual" />
      </div>
    </div>
  </div>

  <div class="habits-section reveal">
    <div class="habits-split">
      <div class="img-placeholder" style="min-height:360px;">
        <img src="{{ asset('images/chicaconlentes.jpg') }}" alt="Hábitos visuales">
      </div>
      <div class="habits-card">
        <div class="section-kicker">Cuidado diario</div>
        <h3>Hábitos</h3>
        <p>Los hábitos son la clave para mantener una salud visual óptima. Buenos hábitos diarios pueden ayudarte a prevenir enfermedades como el glaucoma o la degeneración macular.</p>
        <div class="habits-tags">
          <span class="habit-tag">🌙 Regla 20-20-20</span>
          <span class="habit-tag">🥕 Alimentación</span>
          <span class="habit-tag">😎 Protección UV</span>
          <span class="habit-tag">💧 Hidratación</span>
          <span class="habit-tag">🖥️ Descanso digital</span>
          <span class="habit-tag">📅 Revisiones</span>
        </div>
        <a href="{{ route('habitos') }}" class="ver-mas-btn">Ver más →</a>
      </div>
    </div>
  </div>

  <div class="sep" id="ejemplos">
    <div class="sep-inner"><div class="sep-line"></div> Uso y ejemplos de salud visual <div class="sep-line"></div></div>
  </div>

  <div class="examples-section reveal">
    <h2>Uso y ejemplos de<br><em>salud visual</em></h2>
    <div class="card-stack-wrap">
      <div class="stack-area" id="stackArea"></div>
      <div class="stack-info" id="stackInfo">
        <div class="stack-counter" id="stackCounter">01 / 05</div>
        <div class="stack-title" id="stackTitle"></div>
        <div class="stack-type" id="stackType"></div>
        <div class="stack-divider"></div>
        <p class="stack-desc" id="stackDesc"></p>
        <div class="stack-tags" id="stackTags"></div>
        <div class="stack-btns">
          <button class="stack-btn" id="stackPrev"><svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg></button>
          <button class="stack-btn" id="stackNext"><svg viewBox="0 0 24 24"><polyline points="9 6 15 12 9 18"/></svg></button>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection

@section('scripts')
<script>
const stackData = [
  { title:'Protección Solar', type:'prevención UV', desc:'El uso de gafas con filtro UV400 es la primera línea de defensa contra los daños solares. La exposición continua sin protección puede causar cataratas prematuras y degeneración macular.', tags:['UV400','Gafas de sol','Cataratas','Prevención'], img:'{{ asset("images/image 124.png") }}', rotation:-3 },
  { title:'Nutrición Ocular', type:'alimentación saludable', desc:'Una dieta rica en luteína, zeaxantina, vitamina A y omega-3 protege la retina. Los vegetales de hoja verde y el pescado azul son aliados fundamentales.', tags:['Luteína','Vitamina A','Omega-3','Retina'], img:'{{ asset("images/image 125.png") }}', rotation:4 },
  { title:'Descanso Digital', type:'higiene visual', desc:'La regla 20-20-20 indica que cada 20 minutos debes mirar a 6 metros de distancia durante 20 segundos. Esto reduce la fatiga ocular por el uso prolongado de pantallas.', tags:['Regla 20-20-20','Pantallas','Fatiga ocular','Hábitos'], img:'{{ asset("images/image 123.png") }}', rotation:-5 },
  { title:'Revisiones Regulares', type:'medicina preventiva', desc:'Las revisiones anuales con un optometrista u oftalmólogo permiten detectar problemas de forma temprana, incluso antes de que aparezcan síntomas visibles.', tags:['Optometrista','Diagnóstico','Prevención','Anual'], img:'{{ asset("images/image 122.png") }}', rotation:6 },
  { title:'Hidratación Ocular', type:'cuidado diario', desc:'El ojo seco es frecuente en ambientes con clima artificial. Parpadear conscientemente y mantenerse hidratado ayuda a mantener la película lagrimal saludable.', tags:['Ojo seco','Lágrimas','Hidratación','Bienestar'], img:'{{ asset("images/hidratacionOcular.jpg") }}', rotation:-4 },
];
const N = stackData.length;
let current = 0, locked = false;
const stackArea = document.getElementById('stackArea');
const titleEl = document.getElementById('stackTitle'), typeEl = document.getElementById('stackType');
const descEl = document.getElementById('stackDesc'), tagsEl = document.getElementById('stackTags');
const counterEl = document.getElementById('stackCounter'), infoEl = document.getElementById('stackInfo');
function buildCards() {
  stackArea.innerHTML = '';
  stackData.forEach((d,i) => {
    const card = document.createElement('div'); card.className='stack-card'; card.dataset.idx=i;
    card.innerHTML=`<img src="${d.img}" alt="${d.title}" loading="lazy"><div class="stack-card-label">${d.title}</div>`;
    stackArea.appendChild(card);
  });
}
function applyPositions(skip=false) {
  [...stackArea.querySelectorAll('.stack-card')].forEach(card => {
    const pos=((+card.dataset.idx-current)+N)%N;
    if(skip)card.style.transition='none'; else card.style.transition='';
    card.classList.remove('exiting','entering'); card.dataset.pos=pos;
  });
}
function updateInfo() {
  infoEl.classList.add('info-fading');
  setTimeout(()=>{ const d=stackData[current]; titleEl.textContent=d.title; typeEl.textContent=d.type; descEl.textContent=d.desc; tagsEl.innerHTML=d.tags.map(t=>`<span class="stack-tag">${t}</span>`).join(''); counterEl.textContent=String(current+1).padStart(2,'0')+' / '+String(N).padStart(2,'0'); infoEl.classList.remove('info-fading'); }, 200);
}
function advance(dir) {
  if(locked)return; locked=true;
  if(dir===1){ const top=stackArea.querySelector('.stack-card[data-pos="0"]'); top.classList.add('exiting'); setTimeout(()=>{ current=(current+1)%N; applyPositions(); updateInfo(); setTimeout(()=>{locked=false;},580); },400); }
  else { const prev=(current-1+N)%N; const prevCard=stackArea.querySelector(`.stack-card[data-idx="${prev}"]`); prevCard.classList.add('entering'); prevCard.style.transition='none'; prevCard.style.transform='translateX(-200%) rotate(-22deg) scale(0.8)'; prevCard.style.opacity='0'; prevCard.style.zIndex=10; requestAnimationFrame(()=>requestAnimationFrame(()=>{ current=prev; applyPositions(); prevCard.style.transition='transform 0.55s cubic-bezier(.2,.9,.3,1.05),opacity 0.45s ease'; prevCard.style.transform=''; prevCard.style.opacity=''; prevCard.style.zIndex=''; updateInfo(); setTimeout(()=>{locked=false;},600); })); }
}
document.getElementById('stackNext').addEventListener('click',()=>advance(1));
document.getElementById('stackPrev').addEventListener('click',()=>advance(-1));
buildCards(); applyPositions(true);
requestAnimationFrame(()=>requestAnimationFrame(()=>{ stackArea.querySelectorAll('.stack-card').forEach(c=>{c.style.transition='';}); }));
updateInfo();
</script>
@endsection
