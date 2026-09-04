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

<div class="page-content hx">

  <div class="habitos-intro reveal">
    <div class="habitos-intro-text">
      <div class="section-kicker">Información</div>
      <h2>¿Qué son los hábitos en<br><em>la salud visual?</em></h2>
      <p>Los hábitos visuales son todas aquellas prácticas y comportamientos que adoptamos en nuestro día a día y que tienen un impacto directo sobre la salud de nuestros ojos. Desde la forma en que usamos dispositivos digitales hasta la alimentación que seguimos.</p>
      <p>Desarrollar buenos hábitos desde temprana edad es la mejor inversión para conservar una visión nítida y saludable a lo largo de la vida. La mayoría de problemas visuales pueden prevenirse o ralentizarse con rutinas adecuadas.</p>
      <p>La educación visual es clave: conocer qué actividades favorecen o perjudican la vista nos permite tomar decisiones más conscientes en nuestra vida cotidiana.</p>
      @include('partials.dato-curioso', [
        'icono' => '🔍',
        'kicker' => 'Prevención',
        'datos' => [
          'Pequeñas acciones diarias pueden marcar una gran diferencia en la salud de tus ojos a largo plazo.',
          'La regla 20-20-20 (cada 20 minutos, mirar 20 segundos a algo a 20 pies) reduce notablemente la fatiga visual frente a pantallas.',
          'Dormir entre 7 y 9 horas permite que la superficie ocular se repare y se lubrique de forma natural.',
          'Los alimentos ricos en luteína y omega-3, como la espinaca y el salmón, ayudan a proteger la retina con el paso del tiempo.',
        ],
      ])
    </div>
    <div class="img-placeholder" style="min-height:360px;">
      <img src="{{ asset('images/image 128.png') }}" alt="Hábitos visuales" />
    </div>
  </div>

  <div class="habits-table-section reveal">
    <h2>Hábitos Saludables vs<br><em>Hábitos Incorrectos</em></h2>
    <div class="habits-two-col">
      <div class="habits-col good">
        <div class="habits-col-header">
          <div class="habits-col-badge"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div>
          <h3>Hábitos Saludables</h3>
        </div>
        <div class="habit-item"><div class="habit-bullet"></div><p>Usa gafas de sol con protección UV400 cada vez que salgas al exterior, especialmente en días soleados. Las cataratas y la degeneración macular se asocian con exposición solar acumulada.</p></div>
        <div class="habit-item"><div class="habit-bullet"></div><p>Aplica la regla 20-20-20: cada 20 minutos frente a pantallas, mira a 6 metros de distancia durante 20 segundos para reducir la fatiga ocular.</p></div>
        <div class="habit-item"><div class="habit-bullet"></div><p>Realiza revisiones periódicas con un optometrista u oftalmólogo al menos una vez al año, incluso si no percibes molestias visuales.</p></div>
        <div class="habit-item"><div class="habit-bullet"></div><p>Incorpora a tu dieta alimentos ricos en luteína, zeaxantina y vitamina A: espinacas, zanahorias, huevos y pescado azul protegen la retina.</p></div>
        <div class="habit-item"><div class="habit-bullet"></div><p>Mantén una buena hidratación diaria y parpadea conscientemente frente a pantallas para evitar el síndrome del ojo seco.</p></div>
        <div class="habit-item"><div class="habit-bullet"></div><p>Ajusta el brillo y contraste de tus dispositivos al nivel del entorno y usa filtros de luz azul si trabajas de noche.</p></div>
      </div>
      <div class="habits-col bad">
        <div class="habits-col-header">
          <div class="habits-col-badge"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></div>
          <h3>Hábitos Incorrectos</h3>
        </div>
        <div class="habit-item"><div class="habit-bullet"></div><p>No usar protección solar ocular: salir sin gafas de sol de forma habitual acelera el daño UV en la córnea, el cristalino y la retina a largo plazo.</p></div>
        <div class="habit-item"><div class="habit-bullet"></div><p>Usar el teléfono o tableta en la oscuridad y a corta distancia incrementa significativamente el esfuerzo del músculo ciliar, causando fatiga y contribuyendo a la progresión de la miopía.</p></div>
        <div class="habit-item"><div class="habit-bullet"></div><p>Ignorar síntomas como visión borrosa, dolores de cabeza frecuentes o sensibilidad a la luz puede retrasar diagnósticos importantes y empeorar condiciones tratables.</p></div>
        <div class="habit-item"><div class="habit-bullet"></div><p>Frotarse los ojos con las manos sin lavarse puede introducir bacterias y virus, además de dañar la córnea en quienes tienen queratocono.</p></div>
        <div class="habit-item"><div class="habit-bullet"></div><p>Leer con mala iluminación o en posiciones incómodas sobrecarga los músculos extraoculares y provoca fatiga visual crónica.</p></div>
        <div class="habit-item"><div class="habit-bullet"></div><p>Dormir con lentes de contacto puestos reduce el oxígeno corneal y aumenta el riesgo de infecciones bacterianas graves como queratitis microbiana.</p></div>
      </div>
    </div>
  </div>

  {{-- ================= HÁBITOS POR ETAPA DE VIDA ================= --}}
  <div class="hx-section hx-reveal">
    <div class="hx-kicker">Ciclo de vida</div>
    <h2>Hábitos según<br><em>la etapa de vida</em></h2>
    <p class="hx-lede">El cuidado visual no es igual en todas las edades. Las prioridades cambian según los riesgos más comunes de cada etapa.</p>

    <div class="hx-tabs-nav" role="tablist" aria-label="Hábitos por etapa de vida">
      <button class="hx-tab-btn active" data-tab="ninos" role="tab" aria-selected="true" aria-controls="panel-ninos" id="tab-ninos">Niñez y adolescencia</button>
      <button class="hx-tab-btn" data-tab="adultos" role="tab" aria-selected="false" aria-controls="panel-adultos" id="tab-adultos">Adultez</button>
      <button class="hx-tab-btn" data-tab="mayores" role="tab" aria-selected="false" aria-controls="panel-mayores" id="tab-mayores">Adultos mayores</button>
    </div>

    <div class="hx-tab-panel active" data-panel="ninos" role="tabpanel" id="panel-ninos" aria-labelledby="tab-ninos">
      <div class="hx-tip-card"><h4>Tiempo al aire libre</h4><p>Pasar al menos una a dos horas diarias en exteriores se asocia con un menor riesgo de desarrollar miopía durante la infancia, según diversos estudios oftalmológicos.</p></div>
      <div class="hx-tip-card"><h4>Primer examen visual</h4><p>Se recomienda una revisión antes de iniciar la etapa escolar y luego de forma periódica, ya que muchos niños no expresan que ven mal por desconocer que es anormal.</p></div>
      <div class="hx-tip-card"><h4>Límites de pantalla</h4><p>Establecer descansos regulares frente a tablets y celulares ayuda a prevenir la fatiga visual digital, cada vez más frecuente desde edades tempranas.</p></div>
    </div>

    <div class="hx-tab-panel" data-panel="adultos" role="tabpanel" id="panel-adultos" aria-labelledby="tab-adultos" hidden>
      <div class="hx-tip-card"><h4>Pausas activas en el trabajo</h4><p>Quienes trabajan muchas horas frente a computadoras deben aplicar pausas visuales frecuentes para reducir el síndrome visual informático.</p></div>
      <div class="hx-tip-card"><h4>Dejar de fumar</h4><p>El tabaquismo incrementa significativamente el riesgo de cataratas y degeneración macular relacionada con la edad a largo plazo.</p></div>
      <div class="hx-tip-card"><h4>Revisión anual</h4><p>Si usas lentes, pasas muchas horas frente a pantallas o tienes antecedentes familiares, una revisión cada año permite detectar cambios a tiempo.</p></div>
    </div>

    <div class="hx-tab-panel" data-panel="mayores" role="tabpanel" id="panel-mayores" aria-labelledby="tab-mayores" hidden>
      <div class="hx-tip-card"><h4>Control de enfermedades crónicas</h4><p>La diabetes y la hipertensión mal controladas pueden dañar los vasos sanguíneos de la retina, por lo que su manejo médico también protege la vista.</p></div>
      <div class="hx-tip-card"><h4>Detección temprana</h4><p>Cataratas, glaucoma y degeneración macular son más frecuentes después de los 50 años; un examen cada uno o dos años ayuda a detectarlos antes de que afecten la visión.</p></div>
      <div class="hx-tip-card"><h4>Iluminación en casa</h4><p>Una buena iluminación ambiental reduce el riesgo de caídas asociadas a la disminución progresiva de la agudeza visual.</p></div>
    </div>
  </div>

  {{-- ================= NUTRICIÓN VISUAL ================= --}}
  <div class="hx-section alt hx-reveal">
    <div class="hx-kicker">Alimentación</div>
    <h2>Nutrientes que<br><em>cuidan tu visión</em></h2>
    <p class="hx-lede">Una alimentación equilibrada no reemplaza al oftalmólogo, pero aporta lo que la retina necesita para funcionar correctamente.</p>

    <div class="hx-nutri-grid">
      <div class="hx-nutri-card">
        <div class="hx-nutri-badge"><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="3"/></svg></div>
        <h4>Vitamina A</h4>
        <p class="hx-nutri-food">Zanahoria, batata, hígado</p>
        <p>Esencial para la visión nocturna y la salud de la córnea.</p>
      </div>
      <div class="hx-nutri-card">
        <div class="hx-nutri-badge"><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3v18M3 12h18"/></svg></div>
        <h4>Luteína y zeaxantina</h4>
        <p class="hx-nutri-food">Espinaca, col rizada, maíz</p>
        <p>Se acumulan en la mácula y ayudan a filtrar la luz de alta energía.</p>
      </div>
      <div class="hx-nutri-card">
        <div class="hx-nutri-badge"><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7-10-7-10-7z"/></svg></div>
        <h4>Omega-3</h4>
        <p class="hx-nutri-food">Salmón, atún, nueces, linaza</p>
        <p>Contribuye a la función de la retina y alivia síntomas de ojo seco.</p>
      </div>
      <div class="hx-nutri-card">
        <div class="hx-nutri-badge"><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l2.4 7.2H22l-6 4.4 2.3 7.1L12 16.4l-6.3 4.3L8 13.6 2 9.2h7.6z"/></svg></div>
        <h4>Vitaminas C y E</h4>
        <p class="hx-nutri-food">Cítricos, frutos secos, semillas</p>
        <p>Antioxidantes que pueden ayudar a reducir el riesgo de cataratas.</p>
      </div>
      <div class="hx-nutri-card">
        <div class="hx-nutri-badge"><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="4" width="16" height="16" rx="4"/></svg></div>
        <h4>Zinc</h4>
        <p class="hx-nutri-food">Legumbres, carnes, mariscos</p>
        <p>Ayuda a transportar la vitamina A desde el hígado hasta la retina.</p>
      </div>
    </div>
  </div>

  {{-- ================= TEMPORIZADOR 20-20-20 ================= --}}
  <div class="hx-section hx-reveal">
    <div class="hx-timer-section">
      <div class="hx-timer-box">
        <div class="hx-ring-wrap">
          <svg viewBox="0 0 120 120">
            <defs>
              <linearGradient id="hxGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#4a1580"/>
                <stop offset="100%" stop-color="#28a05a"/>
              </linearGradient>
            </defs>
            <circle class="hx-ring-bg" cx="60" cy="60" r="52"/>
            <circle class="hx-ring-fg" id="hxRingFg" cx="60" cy="60" r="52" stroke-dasharray="326.7" stroke-dashoffset="326.7"/>
          </svg>
          <div class="hx-ring-label">
            <span class="num" id="hxTimerNum">20</span>
            <span class="txt">segundos</span>
          </div>
        </div>
        <p class="hx-timer-msg" id="hxTimerMsg" aria-live="polite">Pulsa iniciar cuando lleves 20 minutos frente a una pantalla.</p>
        <button class="hx-btn" id="hxTimerBtn">Iniciar pausa visual</button>
      </div>

      <div>
        <div class="hx-kicker">Hábito digital</div>
        <h2>La regla<br><em>20-20-20</em></h2>
        <ul class="hx-timer-steps">
          <li><div class="hx-step-num">1</div><p><strong>Cada 20 minutos</strong> frente a una pantalla, haz una pausa breve.</p></li>
          <li><div class="hx-step-num">2</div><p><strong>Mira algo a 6 metros</strong> (20 pies) de distancia, idealmente hacia una ventana o un punto lejano.</p></li>
          <li><div class="hx-step-num">3</div><p><strong>Sostén la mirada 20 segundos</strong> y parpadea varias veces para redistribuir la lágrima.</p></li>
        </ul>
      </div>
    </div>
  </div>

  {{-- ================= MITOS Y REALIDADES ================= --}}
  <div class="hx-section alt hx-reveal">
    <div class="hx-kicker">Desmintiendo creencias</div>
    <h2>Mitos y<br><em>realidades</em></h2>
    <p class="hx-lede">Circulan muchas creencias populares sobre la vista. Estas son algunas de las más comunes, aclaradas.</p>

    <div class="hx-accordion" id="hxAccordion">
      <div class="hx-acc-item">
        <button class="hx-acc-head" aria-expanded="false">
          <span>"Leer con poca luz daña la vista para siempre"</span>
          <span class="hx-acc-status parcial">Mito parcial</span>
        </button>
        <div class="hx-acc-body"><div class="hx-acc-body-inner">Leer con poca luz puede causar fatiga y molestia temporal, pero no provoca un daño ocular permanente. Aun así, es recomendable usar buena iluminación para mayor comodidad.</div></div>
      </div>
      <div class="hx-acc-item">
        <button class="hx-acc-head" aria-expanded="false">
          <span>"Usar el celular en la oscuridad y muy de cerca cansa más los ojos"</span>
          <span class="hx-acc-status verdad">Realidad</span>
        </button>
        <div class="hx-acc-body"><div class="hx-acc-body-inner">Es cierto. La falta de contraste ambiental y la corta distancia obligan al músculo ciliar a trabajar más, lo que aumenta la fatiga visual y puede contribuir a la progresión de la miopía a largo plazo.</div></div>
      </div>
      <div class="hx-acc-item">
        <button class="hx-acc-head" aria-expanded="false">
          <span>"Comer muchas zanahorias mejora la vista más allá de lo normal"</span>
          <span class="hx-acc-status mito">Mito</span>
        </button>
        <div class="hx-acc-body"><div class="hx-acc-body-inner">La vitamina A es necesaria para una visión sana, pero un exceso de esta no genera una visión "sobrehumana"; simplemente ayuda a mantener la función visual normal.</div></div>
      </div>
      <div class="hx-acc-item">
        <button class="hx-acc-head" aria-expanded="false">
          <span>"Sentarse cerca del televisor daña los ojos"</span>
          <span class="hx-acc-status mito">Mito</span>
        </button>
        <div class="hx-acc-body"><div class="hx-acc-body-inner">No causa daño ocular, aunque puede generar fatiga temporal. En niños, la tendencia a acercarse mucho a la pantalla puede ser una señal de miopía no corregida que conviene evaluar.</div></div>
      </div>
      <div class="hx-acc-item">
        <button class="hx-acc-head" aria-expanded="false">
          <span>"Usar lentes debilita la vista y genera dependencia"</span>
          <span class="hx-acc-status mito">Mito</span>
        </button>
        <div class="hx-acc-body"><div class="hx-acc-body-inner">Los lentes corrigen el enfoque, no debilitan el ojo. La progresión natural de un error refractivo, como la miopía, ocurre con o sin el uso de lentes.</div></div>
      </div>
      <div class="hx-acc-item">
        <button class="hx-acc-head" aria-expanded="false">
          <span>"Los problemas de visión solo aparecen con la edad"</span>
          <span class="hx-acc-status mito">Mito</span>
        </button>
        <div class="hx-acc-body"><div class="hx-acc-body-inner">Muchas condiciones, como la miopía, el astigmatismo o el ojo vago, pueden aparecer desde la infancia, por lo que las revisiones tempranas son importantes.</div></div>
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

  {{-- ================= AUTOEVALUACIÓN ================= --}}
  <div class="hx-section hx-reveal">
    <div class="hx-kicker">Ponte a prueba</div>
    <h2>Evalúa tus<br><em>hábitos visuales</em></h2>
    <p class="hx-lede">Marca las prácticas que ya cumples. Es una guía orientativa, no un diagnóstico médico.</p>

    <div class="hx-check-section">
      <div class="hx-check-list" id="hxCheckList">
        <label class="hx-check-item"><input type="checkbox"><span>Aplico la regla 20-20-20 cuando uso pantallas por tiempo prolongado.</span></label>
        <label class="hx-check-item"><input type="checkbox"><span>Uso gafas de sol con protección UV al estar al aire libre.</span></label>
        <label class="hx-check-item"><input type="checkbox"><span>Me realizo una revisión visual al menos una vez al año.</span></label>
        <label class="hx-check-item"><input type="checkbox"><span>Incluyo en mi dieta alimentos como verduras de hoja verde o pescado azul.</span></label>
        <label class="hx-check-item"><input type="checkbox"><span>No me froto los ojos con las manos sin lavar.</span></label>
        <label class="hx-check-item"><input type="checkbox"><span>Leo y trabajo con buena iluminación.</span></label>
        <label class="hx-check-item"><input type="checkbox"><span>Nunca duermo con lentes de contacto puestos.</span></label>
        <label class="hx-check-item"><input type="checkbox"><span>Presto atención a síntomas como visión borrosa o dolor de cabeza en lugar de ignorarlos.</span></label>
      </div>

      <div class="hx-score-box">
        <h4>Tu resultado</h4>
        <div class="hx-score-num" aria-live="polite"><span id="hxScoreNum">0</span>/8</div>
        <div class="hx-score-bar-track"><div class="hx-score-bar-fill" id="hxScoreBar"></div></div>
        <p class="hx-score-text" id="hxScoreText" aria-live="polite">Marca las casillas para ver tu resultado.</p>
      </div>
    </div>
  </div>

</div>


@include('partials.comentarios', ['pagina' => 'habitos'])
@endsection

@section('scripts')
<script>
const DATA = [
  { tag:'Vision doble, borrosa o mal enfoque', title:'Visión borrosa', color1:'#4a1580', color2:'#7b2fbe', img:'{{ asset("images/Rectangle 25.png") }}', desc:'La visión borrosa es una alteración de la vista en la que los objetos dejan de percibirse con claridad y aparecen desenfocados o poco definidos. Puede presentarse de forma ocasional, por ejemplo después de pasar mucho tiempo frente a pantallas, o ser constante, lo que indica la necesidad de una revisión visual.', tags:['Descanso','Revisión','Prevención'] },
  { tag:'Cansancio Ocular', title:'Fatiga Visual', color1:'#1a6b3a', color2:'#28a05a', img:'{{ asset("images/Rectangle 26.png") }}', desc:'La fatiga visual es el cansancio de los ojos causado por el uso prolongado de pantallas o actividades que requieren concentración visual. Provoca síntomas como sequedad, ardor, visión borrosa y dolores de cabeza. Si persiste, es importante acudir a un especialista.', tags:['Ojo Seco','Pantallas','Ardor'] },
  { tag:'Familiares con enfermedades oculares', title:'Antecedentes de enfermedades', color1:'#0d3d7a', color2:'#1a6dbf', img:'{{ asset("images/Rectangle 27.png") }}', desc:'Es importante prestar atención si en tu familia hay antecedentes de problemas como cataratas, glaucoma, degeneración macular o incluso enfermedades generales como la diabetes y la hipertensión, ya que estas pueden afectar directamente la visión.', tags:['Familia','Historial Médico','Control de Salud'] },
  { tag:'Daños Oculares', title:'Lesiones o golpes en los ojos', color1:'#5a1a8a', color2:'#9b59b6', img:'{{ asset("images/lesion.jpg") }}', desc:'Los golpes o lesiones oculares pueden dañar estructuras delicadas del ojo y afectar la visión de forma temporal o permanente. Pueden ocurrir por accidentes, caídas o exposición a objetos extraños. Es importante prestar atención a síntomas como dolor, enrojecimiento, visión borrosa, sensibilidad a la luz o sangrado.', tags:['Accidentes','Emergencia','Dolor'] },
  { tag:'Cuidado visual', title:'Revisiones periódicas', color1:'#0a5a6b', color2:'#1a9ab5', img:'{{ asset("images/revisiones.jpg") }}', desc:'Las revisiones periódicas de la vista son importantes para mantener una buena salud visual, incluso si no se presentan síntomas. Permiten detectar a tiempo problemas como errores de graduación o enfermedades oculares que pueden desarrollarse sin señales evidentes. Se recomienda realizar un examen visual al menos cada dos años.', tags:['Examen Visual','Síntomas','Bienestar'] },
];

const CARD_W = 320, GAP = 24, VISIBLE = 3, N = DATA.length;
const MAX_OFFSET = Math.max(0, N - VISIBLE);
let current = 0;

const track = document.getElementById('track');
const dotsEl = document.getElementById('dots');
const btnPrev = document.getElementById('btnPrev');
const btnNext = document.getElementById('btnNext');

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
  for (let i = 0; i <= MAX_OFFSET; i++) {
    const dot = document.createElement('div');
    dot.className = 'dot' + (i === 0 ? ' active' : '');
    dot.addEventListener('click', () => goTo(i));
    dotsEl.appendChild(dot);
  }
}

function goTo(idx) {
  current = Math.max(0, Math.min(idx, MAX_OFFSET));
  const stride = CARD_W + GAP;
  track.style.transform = `translateX(-${current * stride}px)`;
  document.querySelectorAll('.dot').forEach((d, i) => d.classList.toggle('active', i === current));
  document.querySelectorAll('.carousel-card').forEach(c => c.classList.remove('flipped'));
  btnPrev.disabled = current === 0;
  btnNext.disabled = current === MAX_OFFSET;
}

btnNext.addEventListener('click', () => goTo(current + 1));
btnPrev.addEventListener('click', () => goTo(current - 1));

let tx = 0;
track.addEventListener('touchstart', e => { tx = e.touches[0].clientX; });
track.addEventListener('touchend', e => {
  const diff = tx - e.changedTouches[0].clientX;
  if (Math.abs(diff) > 40) goTo(current + (diff > 0 ? 1 : -1));
});

buildCards();
goTo(0);

// REVEAL (secciones originales + nuevas "hx")
const hxRevealEls = document.querySelectorAll('.hx-reveal');
const hxObs = new IntersectionObserver(entries => {
  entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: 0.1 });
hxRevealEls.forEach(el => hxObs.observe(el));

// ============== TABS ETAPA DE VIDA ==============
document.querySelectorAll('.hx-tab-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    document.querySelectorAll('.hx-tab-btn').forEach(b => {
      b.classList.remove('active');
      b.setAttribute('aria-selected', 'false');
    });
    document.querySelectorAll('.hx-tab-panel').forEach(p => {
      p.classList.remove('active');
      p.hidden = true;
    });
    btn.classList.add('active');
    btn.setAttribute('aria-selected', 'true');
    const panel = document.querySelector(`.hx-tab-panel[data-panel="${btn.dataset.tab}"]`);
    panel.classList.add('active');
    panel.hidden = false;
  });
});

// ============== TEMPORIZADOR 20-20-20 ==============
(function () {
  const btn = document.getElementById('hxTimerBtn');
  const num = document.getElementById('hxTimerNum');
  const msg = document.getElementById('hxTimerMsg');
  const ring = document.getElementById('hxRingFg');
  const CIRC = 326.7;
  const TOTAL = 20;
  let remaining = TOTAL;
  let interval = null;

  function render() {
    num.textContent = remaining;
    const offset = CIRC - (remaining / TOTAL) * CIRC;
    ring.style.strokeDashoffset = offset;
  }

  btn.addEventListener('click', () => {
    if (interval) return;
    remaining = TOTAL;
    render();
    ring.style.strokeDashoffset = CIRC;
    msg.textContent = 'Mira algo a 6 metros de distancia y parpadea.';
    btn.disabled = true;
    interval = setInterval(() => {
      remaining -= 1;
      render();
      if (remaining <= 0) {
        clearInterval(interval);
        interval = null;
        msg.textContent = 'Bien hecho. Tus ojos te lo agradecen.';
        btn.disabled = false;
        setTimeout(() => { ring.style.strokeDashoffset = '0'; }, 300);
      }
    }, 1000);
  });
})();

// ============== ACORDEÓN MITOS ==============
document.querySelectorAll('.hx-acc-item').forEach(item => {
  const head = item.querySelector('.hx-acc-head');
  const body = item.querySelector('.hx-acc-body');
  head.addEventListener('click', () => {
    const isOpen = item.classList.contains('open');
    document.querySelectorAll('.hx-acc-item').forEach(i => {
      i.classList.remove('open');
      i.querySelector('.hx-acc-head').setAttribute('aria-expanded', 'false');
      i.querySelector('.hx-acc-body').style.maxHeight = null;
    });
    if (!isOpen) {
      item.classList.add('open');
      head.setAttribute('aria-expanded', 'true');
      body.style.maxHeight = body.scrollHeight + 'px';
    }
  });
});

// ============== AUTOEVALUACIÓN ==============
(function () {
  const checks = document.querySelectorAll('#hxCheckList input[type="checkbox"]');
  const scoreNum = document.getElementById('hxScoreNum');
  const scoreBar = document.getElementById('hxScoreBar');
  const scoreText = document.getElementById('hxScoreText');
  const TOTAL = checks.length;

  function update() {
    const count = Array.from(checks).filter(c => c.checked).length;
    scoreNum.textContent = count;
    scoreBar.style.width = (count / TOTAL * 100) + '%';
    let msg;
    if (count <= 3) msg = 'Hay bastante margen de mejora. Intenta incorporar uno o dos hábitos nuevos esta semana.';
    else if (count <= 6) msg = 'Vas por buen camino. Sigue reforzando los hábitos que aún te faltan.';
    else msg = 'Excelente cuidado visual. Mantén estas rutinas y no olvides tu revisión anual.';
    scoreText.textContent = msg;
  }
  checks.forEach(c => c.addEventListener('change', update));
  update();
})();
</script>
@endsection
