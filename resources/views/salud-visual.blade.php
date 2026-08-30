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
          <span class="habit-tag"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
           <path d="M20 5c-6 1-10 6-9 12s7 10 13 8c-2 3-6 5-10 4C7 27 3 20 5 13S15 2 20 5z" fill="none" stroke="#f0d824" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
           <circle cx="24" cy="8" r="1" fill="#f0d824"/>
           <circle cx="27" cy="13" r="0.7" fill="#f0d824"/>
          </svg> Regla 20-20-20</span>
          <span class="habit-tag">🥕 Alimentación</span>
          <span class="habit-tag">😎 Protección UV</span>
          <span class="habit-tag">  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
        <path d="M16 4c4 6 9 12 9 17a9 9 0 0 1-18 0c0-5 5-11 9-17z"
        fill="none" stroke="#6FA8DC" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M12 21c0 2 1.5 3.5 3 4" stroke="#6FA8DC" stroke-width="1.4" stroke-linecap="round" fill="none"/>
       </svg> Hidratación</span>
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

{{-- S5: DATOS GLOBALES --}}
<div class="svx-section reveal">
  <div class="svx-kicker">Datos globales</div>
  <h2>La salud visual<br><em>en cifras</em></h2>
  <p class="svx-lead">Estos datos, publicados por la Organización Mundial de la Salud (OMS), muestran por qué el cuidado ocular preventivo es una prioridad de salud pública en todo el mundo.</p>

  <div class="svx-stats-grid">
    <div class="svx-stat-card">
      <span class="svx-stat-number">2,200M</span>
      <span class="svx-stat-label">personas en el mundo viven con algún grado de deterioro visual, de cerca o de lejos.</span>
    </div>
    <div class="svx-stat-card">
      <span class="svx-stat-number">1,000M</span>
      <span class="svx-stat-label">de esos casos podrían haberse evitado o todavía no han recibido tratamiento adecuado.</span>
    </div>
    <div class="svx-stat-card">
      <span class="svx-stat-number">80%</span>
      <span class="svx-stat-label">de los casos de ceguera a nivel mundial se consideran prevenibles o tratables.</span>
    </div>
    <div class="svx-stat-card">
      <span class="svx-stat-number">+50</span>
      <span class="svx-stat-label">años es la edad a partir de la cual se concentra la mayoría de los casos de discapacidad visual.</span>
    </div>
  </div>
  <p class="svx-stats-source">Fuente: Organización Mundial de la Salud (OMS), informe sobre ceguera y discapacidad visual.</p>
</div>



{{-- S7: SALUD VISUAL INFANTIL --}}
<div class="svx-section reveal">
  <div class="svx-kicker">Primeros años</div>
  <div class="svx-kids-wrap">
    <div class="svx-kids-card">
      <h2>Salud visual<br><em>infantil</em></h2>
      <p>La mayor parte del desarrollo visual ocurre durante los primeros años de vida. Detectar a tiempo problemas como el ojo vago (ambliopía) o el estrabismo mejora enormemente las probabilidades de corrección total.</p>
      <ul class="svx-kids-list">
        <li><svg viewBox="0 0 24 24"><path d="M4.3 5.2h15.4c.6 0 1 .5 1 1.1v13c0 .6-.4 1.1-1 1.1H4.3c-.6 0-1-.5-1-1.1v-13c0-.6.4-1.1 1-1.1Z"/><path d="M3.4 9.8h17.2"/><path d="M7.5 3.2v4"/><path d="M16.5 3.2v4"/></svg>Primer examen visual recomendado entre los 6 y 12 meses de edad.</li>
        <li><svg viewBox="0 0 24 24"><path d="M12 2.7c2.6 3.4 5.4 7.4 5.4 10.7a5.4 5.4 0 1 1-10.8 0C6.6 10.1 9.4 6.1 12 2.7Z"/></svg>Nuevas revisiones antes de iniciar la etapa escolar y de forma periódica después.</li>
        <li><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="8.5"/><path d="M12 3.5v3M12 17.5v3M3.5 12h3M17.5 12h3"/></svg>Señales de alerta: acercarse mucho a pantallas o libros, entrecerrar los ojos o inclinar la cabeza al mirar.</li>
        <li><svg viewBox="0 0 24 24"><path d="M4 12c2.2-4 5-6.3 8-6.3s5.8 2.3 8 6.3c-2.2 4-5 6.3-8 6.3S6.2 16 4 12Z"/><circle cx="12" cy="12" r="2"/></svg>Limitar el tiempo continuo frente a pantallas y fomentar juegos al aire libre favorece un desarrollo visual saludable.</li>
      </ul>
    </div>
    <div class="svx-kids-img">
      <img src="{{ asset('images/kids.png') }}" alt="Cuidado visual infantil">
    </div>
  </div>
</div>

{{-- S8: MITOS Y REALIDADES --}}
<div class="svx-section reveal">
  <div class="svx-kicker">Aclarando dudas</div>
  <h2>Mitos y realidades<br><em>sobre la vista</em></h2>
  <p class="svx-lead">Existen muchas creencias populares sobre el cuidado ocular. Aquí separamos lo que dice la evidencia de lo que es simplemente un mito.</p>

  <div class="svx-myths-list">
    <details class="svx-myth">
      <summary>Leer con poca luz daña permanentemente la vista
        <span style="display:flex;align-items:center;gap:10px;">
          <span class="svx-tag svx-mito">Mito</span>
          <svg class="svx-chevron" viewBox="0 0 24 24"><polyline points="9 6 15 12 9 18"/></svg>
        </span>
      </summary>
      <p>Leer con poca luz puede causar fatiga ocular temporal y molestia, pero no provoca un daño permanente en los ojos. Aun así, se recomienda una buena iluminación para mayor comodidad visual.</p>
    </details>

    <details class="svx-myth">
      <summary>Mirar pantallas de cerca perjudica la vista con el tiempo
        <span style="display:flex;align-items:center;gap:10px;">
          <span class="svx-tag svx-real">Realidad</span>
          <svg class="svx-chevron" viewBox="0 0 24 24"><polyline points="9 6 15 12 9 18"/></svg>
        </span>
      </summary>
      <p>El uso prolongado y cercano de pantallas se asocia con fatiga visual digital y, en niños, con mayor riesgo de desarrollar miopía. Aplicar la regla 20-20-20 y tomar descansos ayuda a reducir este efecto.</p>
    </details>

    <details class="svx-myth">
      <summary>Comer zanahorias da una visión perfecta
        <span style="display:flex;align-items:center;gap:10px;">
          <span class="svx-tag svx-mito">Mito</span>
          <svg class="svx-chevron" viewBox="0 0 24 24"><polyline points="9 6 15 12 9 18"/></svg>
        </span>
      </summary>
      <p>Las zanahorias aportan vitamina A, importante para la salud ocular, pero no corrigen problemas de refracción ni otorgan una "visión perfecta". Una dieta variada rica en vitaminas y antioxidantes es lo que realmente beneficia a los ojos.</p>
    </details>

    <details class="svx-myth">
      <summary>Usar lentes constantemente "acostumbra" al ojo y empeora la vista
        <span style="display:flex;align-items:center;gap:10px;">
          <span class="svx-tag svx-mito">Mito</span>
          <svg class="svx-chevron" viewBox="0 0 24 24"><polyline points="9 6 15 12 9 18"/></svg>
        </span>
      </summary>
      <p>Usar la graduación correcta no debilita el ojo ni crea dependencia. Lo que ocurre es que, al quitarte los lentes, vuelves a notar el problema visual que ya tenías; los lentes simplemente lo corrigen mientras los usas.</p>
    </details>

    <details class="svx-myth">
      <summary>El glaucoma y otras enfermedades oculares pueden no dar síntomas al inicio
        <span style="display:flex;align-items:center;gap:10px;">
          <span class="svx-tag svx-real">Realidad</span>
          <svg class="svx-chevron" viewBox="0 0 24 24"><polyline points="9 6 15 12 9 18"/></svg>
        </span>
      </summary>
      <p>Enfermedades como el glaucoma pueden avanzar sin síntomas notorios hasta etapas avanzadas. Por eso los exámenes oculares regulares son esenciales, incluso cuando sientes que ves bien.</p>
    </details>
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
