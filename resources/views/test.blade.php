@extends('layouts.app')

@section('title', 'Test Visual — Nebula View')

@section('css')
<link rel="stylesheet" href="{{ asset('css/test.css') }}">
<style>
.toast {
  position: fixed;
  bottom: 24px;
  right: 24px;
  background: #ffffff;
  border: 1.5px solid rgba(124,58,237,0.25);
  border-radius: 12px;
  padding: 10px 14px;
  box-shadow: 0 4px 24px rgba(124,58,237,0.12);
  z-index: 9999;
  opacity: 0;
  transform: translateY(12px);
  transition: opacity .3s ease, transform .3s ease;
  pointer-events: none;
  width: fit-content;
  max-width: 280px;
  display: flex;
  align-items: center;
  gap: 10px;
  color: #1e1b4b;
}
.toast.show { opacity: 1; transform: translateY(0); pointer-events: auto; }
.t-ico { width: 28px; height: 28px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 700; flex-shrink: 0; }
.toast.toast-ok  .t-ico { background: rgba(52,211,153,0.12); color: #059669; }
.toast.toast-err .t-ico { background: rgba(239,68,68,0.10);  color: #dc2626; }
.t-txt { display: flex; flex-direction: column; gap: 1px; }
.t-txt b    { font-size: 13px; font-weight: 600; color: #1e1b4b; }
.t-txt span { font-size: 11px; color: #6b7280; }
</style>
@endsection

@section('content')

<!-- HERO / TEST AREA -->
<section class="test-hero">
  <div class="hbc hbc-1"></div>
  <div class="hbc hbc-2"></div>
  <div class="hbc hbc-3"></div>
  <div class="hbc hbc-4"></div>
  <div class="hbc hbc-5"></div>

  <div class="hero-card" id="testCard">
    <!-- INTRO -->
    <div id="intro-screen">
      <div class="hero-badge"><svg class="hand-icon" width="15" height="15"><use href="#icon-scope"></use></svg> Test interactivo · IA</div>
      <div>
        <a href="{{ route('test-ishihara') }}" class="test-switch-link">
          <svg class="hand-icon" width="15" height="15"><use href="#icon-paleta"></use></svg> ¿Buscas el test de daltonismo (Ishihara)? <span class="arrow-ic">→</span>
        </a>
      </div>
      <h1>Descubre tu<br><em>perfil visual</em></h1>
      <p>Responde 20 preguntas sobre tus síntomas, hábitos, estilo de vida y antecedentes. Obtendrás un diagnóstico por condición, un plan semanal de hábitos y un chat personalizado con tu asistente visual.</p>

      <div class="intro-stats">
        <div class="stat-box"><div class="stat-num">20</div><div class="stat-lbl">Preguntas</div></div>
        <div class="stat-box"><div class="stat-num">~4'</div><div class="stat-lbl">Duración</div></div>
        <div class="stat-box"><div class="stat-num">IA</div><div class="stat-lbl">Diagnóstico</div></div>
      </div>

      <div class="hist-preview" id="histPreview">
        <div class="hist-preview-title"><svg class="hand-icon" width="15" height="15"><use href="#icon-nota"></use></svg> Tests anteriores</div>
        <div id="histPreviewItems"></div>
      </div>

      <button class="btn-next" id="startBtn" style="width:100%;justify-content:center;">
        Comenzar test
        <span class="arrow-ic">→</span>
      </button>
      <p style="font-size:11px;color:var(--muted);margin-top:16px;"><svg class="hand-icon" width="13" height="13"><use href="#icon-warning"></use></svg> Este test es orientativo y no reemplaza la consulta con un profesional.</p>
    </div>

    <!-- QUESTIONS -->
    <div id="questions-screen" style="display:none;">
      <div class="test-meta">
        <span id="q-counter">Pregunta 1 de 20</span>
      </div>
      <div class="progress-bar-wrap">
        <div class="progress-bar" id="progressBar" style="width:5%"></div>
      </div>
      <div id="questionsContainer"></div>
    </div>

    <!-- LOADING STATE -->
    <div id="loading-screen" style="display:none;text-align:center;padding:20px 0;">
      <div class="hero-badge" style="margin-bottom:28px;"><svg class="hand-icon" width="15" height="15"><use href="#icon-robot"></use></svg> IA analizando tus respuestas</div>
      <div class="ai-loader">
        <div class="ai-orb"></div>
        <div class="ai-rings">
          <div class="ai-ring r1"></div>
          <div class="ai-ring r2"></div>
          <div class="ai-ring r3"></div>
        </div>
      </div>
      <h3 style="font-family: 'MuseoModerno', serif;font-size:22px;color:var(--dark);margin:28px 0 10px;">Generando tu diagnóstico</h3>
      <p style="font-size:14px;color:var(--muted);line-height:1.7;max-width:340px;margin:0 auto;" id="loadingMsg">Procesando tus síntomas y hábitos visuales...</p>
      <div class="loading-dots" style="margin-top:20px;"><span></span><span></span><span></span></div>
    </div>

    <!-- RESULT -->
    <div id="result-screen">
      <div class="result-header" id="resultHeader">
        <div class="result-badge"> Diagnóstico IA · Nebula View</div>
        <div class="result-title" id="resultTitle">Perfil visual detectado</div>
        <div class="result-subtitle" id="resultSubtitle">Análisis personalizado basado en tus respuestas</div>
      </div>

      <div id="aiAnalysis" style="font-size:14px;color:var(--muted);line-height:1.85;margin-bottom:24px;min-height:60px;text-align:left;"></div>

      <div class="risk-grid" id="riskGrid"></div>

      <div class="sec-title">Diagnóstico por condición</div>
      <div class="conditions-list" id="conditionsList"></div>

      <div class="lens-recs-title">Lentes recomendados por IA</div>
      <div class="lens-recs-grid" id="lensRecsGrid"></div>

      <div class="sec-title">Plan semanal de hábitos</div>
      <div class="week-grid" id="weekGrid"></div>

      <div class="result-tip" id="resultTip" style="display:none;"></div>

      <div class="sec-title">Chat con tu asistente visual</div>
      <div class="chat-wrap">
        <div class="chat-header">
          <div class="chat-avatar"><svg class="hand-icon" width="18" height="18"><use href="#icon-robot"></use></svg></div>
          <div class="chat-header-info">
            <div class="chat-header-name">Asistente Nebulita</div>
            <div class="chat-header-status">● En línea · contexto de tu diagnóstico activo</div>
          </div>
        </div>
        <div class="chat-messages" id="chatMessages"></div>
        <div class="chat-suggestions" id="chatSuggestions"></div>
        <div class="chat-input-wrap">
          <input class="chat-input" id="chatInput" placeholder="Pregunta sobre tu diagnóstico..." />
          <button class="chat-send" id="chatSend">↑</button>
        </div>
      </div>

      <div class="result-ctas cta-row">
        <button class="btn-cta-secondary" id="sendPdfBtn" disabled><svg class="hand-icon" width="15" height="15"><use href="#icon-guardar"></use></svg> Guardando test…</button>
        <a href="{{ route('problemas-visuales') }}" class="btn-cta-primary"><svg class="hand-icon" width="15" height="15"><use href="#icon-libros"></use></svg> Ver más sobre tu condición</a>
        <button class="btn-cta-secondary" id="historyBtn"><svg class="hand-icon" width="15" height="15"><use href="#icon-nota"></use></svg> Ver historial</button>
        <button class="btn-cta-secondary" id="retestBtn"><svg class="hand-icon" width="15" height="15"><use href="#icon-recargar"></use></svg> Repetir test</button>
      </div>
      <p style="font-size:11px;color:var(--muted);margin-top:20px;text-align:center;"><svg class="hand-icon" width="13" height="13"><use href="#icon-warning"></use></svg> Este diagnóstico es orientativo. Consulta siempre a un profesional de la salud visual.</p>
    </div>

    <!-- HISTORY -->
    <div id="history-screen">
      <div class="history-card">
        <div class="hero-badge"><svg class="hand-icon" width="15" height="15"><use href="#icon-nota"></use></svg> Tu historial</div>
        <h2>Evolución visual</h2>
        <p>Compara tus resultados a lo largo del tiempo.</p>
        <div class="hist-items" id="historyItems"></div>
        <div class="cta-row" style="margin-top:24px;">
          <button class="btn-cta-secondary" id="backFromHistBtn">← Volver</button>
          <button class="btn-cta-secondary" id="clearHistBtn" style="color:#c0152e;border-color:rgba(233,30,60,.3);"><svg class="hand-icon" width="15" height="15"><use href="#icon-papelera"></use></svg> Borrar historial</button>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="toast" id="toast">
  <div class="t-ico" id="t-ico">✓</div>
  <div class="t-txt">
    <b id="t-title">Listo</b>
    <span id="t-msg">Acción completada.</span>
  </div>
</div>

@endsection

@section('scripts')
<script>
const TEST_DIAGNOSTICO_URL = "{{ route('test.diagnostico') }}";
const TEST_CHAT_URL = "{{ route('test.chat') }}";
const TEST_GUARDAR_URL = "{{ route('test.guardar') }}";
const TEST_HISTORIAL_URL = "{{ route('test.historial') }}";
const TEST_ENVIAR_PDF_URL = (id) => `{{ url('/test') }}/${id}/enviar-pdf`;
const TEST_DESTROY_URL = (id) => `{{ url('/test') }}/${id}`;
const CSRF_TOKEN = "{{ csrf_token() }}";
const CURRENT_USER_ID = "{{ auth()->id() }}";
const NEBULA_HISTORY_KEY = 'nebulaHistory_' + CURRENT_USER_ID;
// Restos de una versión anterior guardaban el historial bajo una sola
// clave sin distinguir usuario, así que en un navegador compartido
// una cuenta veía la vista previa de la anterior. La eliminamos una
// sola vez para no arrastrar datos de otra persona.
try { localStorage.removeItem('nebulaHistory'); } catch (e) { /* noop */ }

function doToast(type, title, msg) {
  const toast = document.getElementById('toast');
  document.getElementById('t-ico').textContent   = type === 'ok' ? '✓' : '✕';
  document.getElementById('t-title').textContent = title;
  document.getElementById('t-msg').textContent   = msg;
  toast.classList.remove('toast-ok', 'toast-err', 'show');
  toast.classList.add(type === 'ok' ? 'toast-ok' : 'toast-err');
  requestAnimationFrame(() => requestAnimationFrame(() => toast.classList.add('show')));
  setTimeout(() => toast.classList.remove('show'), 4500);
}

// ═══════════════════════════════════════════════════
//  PREGUNTAS (20)
// ═══════════════════════════════════════════════════
const QUESTIONS = [
  // ── Síntomas visuales (1-6)
  { id:1, cat:'Síntomas visuales', type:'col',
    text:'¿Con qué frecuencia ves borroso cuando miras objetos <strong>lejanos</strong>?',
    opts:['Nunca — veo perfectamente de lejos','A veces, especialmente de noche o con cansancio','Frecuentemente — las cosas lejanas se ven difusas','Siempre — necesito entrecerrar los ojos para enfocar'] },
  { id:2, cat:'Síntomas visuales', type:'col',
    text:'¿Te cuesta enfocar objetos <strong>cercanos</strong> como el teléfono o un libro?',
    opts:['No, veo de cerca perfectamente','Solo cuando llevo mucho tiempo leyendo','Sí, con frecuencia necesito alejar el objeto','Siempre — leer es incómodo sin gafas o sin alejar'] },
  { id:3, cat:'Síntomas visuales', type:'col',
    text:'¿Ves las líneas rectas <strong>distorsionadas o curvadas</strong>?',
    opts:['No, las líneas las veo completamente rectas','A veces, en ciertos ángulos o con cansancio','Sí, las líneas se ven levemente onduladas','Siempre — texto y líneas aparecen distorsionados'] },
  { id:4, cat:'Síntomas visuales', type:'scale',
    text:'¿Con qué frecuencia sientes <strong>fatiga, ardor o picazón</strong> en los ojos?',
    scaleLabels:['Nunca','Rara vez','A veces','Seguido','Siempre'] },
  { id:5, cat:'Síntomas visuales', type:'col',
    text:'¿Experimentas <strong>dolor de cabeza</strong> relacionado con el uso de los ojos?',
    opts:['Nunca tengo dolores de cabeza','Ocasionalmente, al final del día','Con frecuencia, especialmente tras leer','Casi a diario — se asocia con el esfuerzo visual'] },
  { id:6, cat:'Síntomas visuales', type:'col',
    text:'¿Tienes dificultad para ver bien de noche o con <strong>poca luz</strong>?',
    opts:['No, veo bien en condiciones de poca luz','Algo de dificultad pero es tolerable','Bastante dificultad — los autos nocturnos me molestan','Mucha dificultad — evito conducir de noche'] },

  // ── Hábitos digitales (7-11)
  { id:7, cat:'Hábitos digitales', type:'grid',
    text:'¿Cuántas horas al día pasas frente a <strong>pantallas</strong>?',
    opts:['Menos de 2 h','Entre 2 y 4 h','Entre 4 y 8 h','Más de 8 h'] },
  { id:8, cat:'Hábitos digitales', type:'col',
    text:'¿Usas el móvil o lees en la <strong>oscuridad</strong> o con poca luz?',
    opts:['Nunca — siempre con buena iluminación','Ocasionalmente antes de dormir','Con bastante frecuencia','Es mi hábito habitual cada noche'] },
  { id:9, cat:'Hábitos digitales', type:'col',
    text:'¿Con qué frecuencia aplicas la regla <strong>20-20-20</strong>? (cada 20 min, mira 20 s a 20 pies)',
    opts:['Siempre — lo hago conscientemente','A veces, de forma espontánea','Rara vez o no lo conocía','Nunca hago pausas ante la pantalla'] },
  { id:10, cat:'Hábitos digitales', type:'col',
    text:'¿Usas filtro de <strong>luz azul</strong> o modo nocturno en tus dispositivos?',
    opts:['Sí, siempre activo','En algunos dispositivos','Rara vez','No uso ningún filtro de luz azul'] },
  { id:11, cat:'Hábitos digitales', type:'scale',
    text:'¿Qué tan cerca tienes la pantalla de tus <strong>ojos</strong> habitualmente?',
    scaleLabels:['Muy lejos','Lejos','Normal','Cerca','Muy cerca'] },

  // ── Estilo de vida (12-15)
  { id:12, cat:'Estilo de vida', type:'grid',
    text:'¿Con qué frecuencia realizas <strong>actividad física</strong> al aire libre?',
    opts:['Todos los días','3-5 veces/semana','1-2 veces/semana','Casi nunca'] },
  { id:13, cat:'Estilo de vida', type:'col',
    text:'¿Usas protección ocular (lentes de sol con UV400) cuando <strong>estás al aire libre</strong>?',
    opts:['Siempre, incluso en días nublados','Solo cuando hay mucho sol','Rara vez — no suelo llevar lentes de sol','Nunca uso lentes de sol'] },
  { id:14, cat:'Estilo de vida', type:'col',
    text:'¿Cómo describes tu consumo de alimentos ricos en <strong>vitamina A y omega-3</strong>? (zanahoria, espinaca, pescado)',
    opts:['Lo incluyo varias veces a la semana','Lo consumo de vez en cuando','Rara vez como esos alimentos','Casi no los consumo'] },
  { id:15, cat:'Estilo de vida', type:'col',
    text:'¿Cuántas horas de <strong>sueño</strong> obtienes habitualmente?',
    opts:['Más de 8 horas','Entre 7 y 8 horas','Entre 5 y 7 horas','Menos de 5 horas'] },

  // ── Antecedentes (16-17)
  { id:16, cat:'Antecedentes', type:'col',
    text:'¿Tienes <strong>antecedentes familiares</strong> de problemas visuales como miopía o glaucoma?',
    opts:['No, ninguno que yo sepa','Algún familiar lejano','Uno de mis padres tiene problemas visuales','Ambos padres o varios familiares directos'] },
  { id:17, cat:'Antecedentes', type:'col',
    text:'¿Cuándo fue tu <strong>última revisión oftalmológica</strong>?',
    opts:['Hace menos de 6 meses','Hace 6 meses a 1 año','Hace 1 a 3 años','Hace más de 3 años o nunca'] },

  // ── Preferencias (18-20)
  { id:18, cat:'Preferencias de lentes', type:'grid',
    text:'¿Cuál es tu principal <strong>motivación</strong> al elegir unos lentes?',
    opts:['Estilo y moda','Comodidad diaria','Uso deportivo','Protección y salud'] },
  { id:19, cat:'Preferencias de lentes', type:'grid',
    text:'¿Qué <strong>estilo de montura</strong> te resulta más atractivo?',
    opts:['Clásico y elegante','Moderno y llamativo','Minimalista','Retro / vintage'] },
  { id:20, cat:'Preferencias de lentes', type:'col',
    text:'¿Estarías dispuesto/a a usar <strong>lentes de contacto</strong> como alternativa a las gafas?',
    opts:['Sí, los preferiría a las gafas','Me da igual, usaría cualquiera','Prefiero gafas pero los consideraría','No, prefiero gafas siempre'] },
];

const totalQ = QUESTIONS.length;
const answers = {};
let currentQ = 1;
let chatHistory = [];
let isChatLoading = false;

// ═══════════════════════════════════════════════════
//  PERSISTENCIA DE SESIÓN — para que al recargar la página
//  a mitad del test (o viendo el resultado) no te saque,
//  sino que te deje justo donde estabas.
// ═══════════════════════════════════════════════════
const SESSION_KEY = 'nebulaTestSession';

function persistState(screen, extra = {}) {
  try {
    const state = {
      screen, // 'questions' | 'result'
      currentQ,
      answers,
      resultMode: extra.resultMode ?? null, // 'ai' | 'local' | null
      result: extra.result ?? null,
      scores: extra.scores ?? null,
      testId: extra.testId !== undefined ? extra.testId : currentTestId,
    };
    sessionStorage.setItem(SESSION_KEY, JSON.stringify(state));
  } catch (e) { /* almacenamiento no disponible, no pasa nada grave */ }
}

function loadPersistedState() {
  try {
    const raw = sessionStorage.getItem(SESSION_KEY);
    return raw ? JSON.parse(raw) : null;
  } catch (e) { return null; }
}

function clearPersistedState() {
  try { sessionStorage.removeItem(SESSION_KEY); } catch (e) { /* noop */ }
}

// Reconstruye la pantalla en la que estaba el usuario antes de recargar.
function restoreSession() {
  const state = loadPersistedState();
  if (!state) return;

  Object.assign(answers, state.answers || {});
  currentQ = state.currentQ || 1;

  if (state.screen === 'result' && (state.resultMode === 'ai' || state.resultMode === 'local')) {
    document.getElementById('intro-screen').style.display = 'none';
    document.getElementById('questions-screen').style.display = 'none';
    document.getElementById('loading-screen').style.display = 'none';
    document.getElementById('testCard').classList.add('wide-card');

    if (state.resultMode === 'local') {
      showLocalResult(state.scores || {});
      setSendPdfState('error');
    } else {
      renderResults(state.result, state.scores || {});
      currentTestId = state.testId || null;
      setSendPdfState(currentTestId ? 'ready' : 'error');
    }
  } else if (state.screen === 'questions') {
    document.getElementById('intro-screen').style.display = 'none';
    document.getElementById('questions-screen').style.display = 'block';
    document.getElementById('testCard').classList.remove('wide-card');
    showQ(currentQ);
  }
}

// ═══════════════════════════════════════════════════
//  BUILD QUESTIONS
// ═══════════════════════════════════════════════════
function buildQuestions() {
  const container = document.getElementById('questionsContainer');
  container.innerHTML = '';

  QUESTIONS.forEach(q => {
    const div = document.createElement('div');
    div.className = 'question-block' + (q.id === 1 ? ' active' : '');
    div.dataset.q = q.id;

    let optsHtml = '';
    if (q.type === 'scale') {
      optsHtml = `<div class="scale-opts">${q.scaleLabels.map((l,i) => `
        <div class="scale-opt" data-val="${i}"><div class="scale-num">${i+1}</div><div class="scale-lbl">${l}</div></div>`).join('')}</div>`;
    } else {
      const wrapClass = q.type === 'grid' ? 'options-grid' : 'options-col';
      optsHtml = `<div class="${wrapClass}">${q.opts.map((o,i) => `
        <div class="opt" data-val="${i}"><div class="opt-radio"></div><span class="opt-text">${o}</span></div>`).join('')}</div>`;
    }

    const isFirst = q.id === 1;
    const isLast  = q.id === totalQ;
    const backHtml = isFirst
      ? '<div></div>'
      : `<button class="btn-back" id="backBtn${q.id}">← Anterior</button>`;
    const nextHtml = isLast
      ? `<button class="btn-next" id="nextBtn${q.id}" disabled>Ver mi diagnóstico <svg class="hand-icon" width="14" height="14"><use href="#icon-diana"></use></svg></button>`
      : `<button class="btn-next" id="nextBtn${q.id}" disabled>Siguiente <span class="arrow-ic">→</span></button>`;

    div.innerHTML = `
      <div class="q-category"><span class="cat-dot"></span>${q.cat}</div>
      <div class="q-text">${q.text}</div>
      ${optsHtml}
      <div class="q-nav">
        ${backHtml}
        ${nextHtml}
      </div>`;

    container.appendChild(div);
  });

  document.querySelectorAll('.question-block').forEach(block => {
    const q = parseInt(block.dataset.q);
    const opts = block.querySelectorAll('.opt, .scale-opt');
    const nextBtn = block.querySelector('.btn-next');
    const backBtn = block.querySelector('.btn-back');

    opts.forEach(opt => {
      opt.addEventListener('click', () => {
        opts.forEach(o => o.classList.remove('selected'));
        opt.classList.add('selected');
        answers[q] = opt.dataset.val;
        if (nextBtn) nextBtn.disabled = false;
        persistState('questions');
      });
    });

    if (backBtn) backBtn.addEventListener('click', () => showQ(q - 1));

    if (nextBtn) nextBtn.addEventListener('click', () => {
      if (q < totalQ) showQ(q + 1);
      else showResult();
    });
  });
}

function showQ(n) {
  document.querySelectorAll('.question-block').forEach(b => b.classList.remove('active'));
  const block = document.querySelector(`.question-block[data-q="${n}"]`);
  if (block) block.classList.add('active');
  currentQ = n;
  document.getElementById('q-counter').textContent = `Pregunta ${n} de ${totalQ}`;
  document.getElementById('progressBar').style.width = `${(n / totalQ) * 100}%`;

  if (answers[n] !== undefined && block) {
    block.querySelectorAll('.opt, .scale-opt').forEach(o => {
      o.classList.toggle('selected', o.dataset.val === String(answers[n]));
    });
    const nb = block.querySelector('.btn-next');
    if (nb) nb.disabled = false;
  }

  persistState('questions');
}

document.getElementById('startBtn').addEventListener('click', () => {
  document.getElementById('intro-screen').style.display = 'none';
  document.getElementById('questions-screen').style.display = 'block';
  document.getElementById('testCard').classList.remove('wide-card');
  showQ(1);
});

// ── SCORES ──
function calcScores() {
  const a = k => parseInt(answers[k] || 0);
  const myopia   = a(1) * 2.5;
  const hypermet = a(2) * 2.5;
  const astig    = a(3) * 2.5 + a(4) * 1;
  const fatigue  = a(4) * 1.5 + a(7) * 1.5 + a(8) * 1.2 + a(9) * 1 + a(11) * 1 + a(5) * 1;
  const uvRisk   = a(12) * 1.5 + a(13) * 2;
  const sleep    = a(15) * 2;
  const toP = v => Math.min(Math.round(v / 10 * 100), 95);
  return {
    mP: toP(myopia),
    hP: toP(hypermet),
    aP: toP(astig),
    fP: Math.min(Math.round(fatigue * 4), 95),
    uP: Math.min(Math.round(uvRisk * 5), 95),
    sP: Math.min(Math.round(sleep * 8), 95),
  };
}

// ── BUILD PROMPT ──
function buildPrompt(sc) {
  const qLabels = {
    1: ['Nunca borroso de lejos','A veces borroso de lejos','Frecuentemente borroso','Siempre borroso de lejos'],
    2: ['Sin dificultad de cerca','Solo con cansancio','Frecuente dificultad de cerca','Siempre dificultad de cerca'],
    3: ['Sin distorsión','A veces distorsión','Distorsión leve','Siempre distorsión'],
    4: ['Nunca fatiga','Rara vez','A veces fatiga','Fatiga frecuente','Siempre fatiga'],
    5: ['Sin dolor de cabeza','Ocasionalmente','Con frecuencia','Casi a diario'],
    6: ['Sin dificultad nocturna','Algo de dificultad','Bastante dificultad','Mucha dificultad nocturna'],
    7: ['<2h pantallas','2-4h','4-8h','>8h pantallas'],
    8: ['Nunca en oscuridad','Ocasionalmente','Con frecuencia','Siempre en oscuridad'],
    9: ['Aplica 20-20-20 siempre','A veces','Rara vez','Nunca hace pausas'],
    10: ['Siempre usa filtro azul','En algunos dispositivos','Rara vez','Sin filtro de luz azul'],
    11: ['Pantalla muy lejos','Lejos','Normal','Cerca','Muy cerca'],
    12: ['Ejercicio al aire libre diario','3-5 veces/sem','1-2 veces/sem','Casi nunca'],
    13: ['Siempre lentes de sol UV400','Solo con mucho sol','Rara vez','Nunca lentes de sol'],
    14: ['Vitamina A/omega-3 varias veces/sem','De vez en cuando','Rara vez','Casi nunca'],
    15: ['>8h sueño','7-8h','5-7h','<5h sueño'],
    16: ['Sin antecedentes familiares','Familiar lejano','Un progenitor','Ambos padres / varios'],
    17: ['Revisión <6 meses','6-12 meses','1-3 años','Más de 3 años / nunca'],
    18: ['Motivación: estilo','Motivación: comodidad','Motivación: deporte','Motivación: protección'],
    19: ['Montura: clásica','Montura: moderna','Montura: minimalista','Montura: retro'],
    20: ['Preferiría lentes de contacto','Le da igual','Prefiere gafas pero consideraría contacto','Prefiere siempre gafas'],
  };
  const fmt = (id) => {
    const map = qLabels[id]; const v = answers[id];
    return map ? (map[parseInt(v)] || v) : v;
  };

  return `Eres el asistente de salud visual de Nebula View, óptica especializada en cuidado ocular.
Analiza las respuestas de este test de 20 preguntas y genera un diagnóstico orientativo completo en español.

RESPUESTAS DEL USUARIO (test de 20 preguntas):
SÍNTOMAS VISUALES:
- Visión lejana: ${fmt(1)}
- Visión cercana: ${fmt(2)}
- Distorsión visual: ${fmt(3)}
- Fatiga/ardor ocular: ${fmt(4)}
- Dolor de cabeza visual: ${fmt(5)}
- Visión nocturna: ${fmt(6)}

HÁBITOS DIGITALES:
- Horas de pantalla: ${fmt(7)}
- Uso en oscuridad: ${fmt(8)}
- Regla 20-20-20: ${fmt(9)}
- Filtro de luz azul: ${fmt(10)}
- Distancia a pantalla: ${fmt(11)}

ESTILO DE VIDA:
- Actividad al aire libre: ${fmt(12)}
- Protección UV: ${fmt(13)}
- Nutrición visual: ${fmt(14)}
- Calidad de sueño: ${fmt(15)}

ANTECEDENTES:
- Antecedentes familiares: ${fmt(16)}
- Última revisión: ${fmt(17)}

PREFERENCIAS:
- Motivación lentes: ${fmt(18)}
- Estilo montura: ${fmt(19)}
- Lentes de contacto: ${fmt(20)}

INDICADORES CALCULADOS (0-95%):
- Miopía: ${sc.mP}% | Hipermetropía: ${sc.hP}% | Astigmatismo: ${sc.aP}%
- Fatiga digital: ${sc.fP}% | Riesgo UV: ${sc.uP}% | Déficit de sueño: ${sc.sP}%

Responde ÚNICAMENTE con JSON válido (sin markdown, sin texto extra) con esta estructura exacta:
{
  "titulo": "Nombre del perfil visual (ej: Perfil Miope con Alta Fatiga Digital)",
  "subtitulo": "Una línea descriptiva del diagnóstico",
  "colorHex": "#hexcolor según condición primaria (miopía=#2D6FA8, hipermetropía=#2DAA78, astigmatismo=#7B3FC4, fatiga=#E91E8C, mixto=#9B59B6)",
  "analisis": "Párrafo de 4-5 oraciones analizando síntomas, hábitos y estilo de vida específicos del usuario. Menciona condiciones probables y sus causas. Sé específico con los datos.",
  "condiciones": [
    {
      "icono": "emoji",
      "nombre": "Nombre de la condición",
      "severidad": "Baja|Media|Alta",
      "descripcion": "2-3 oraciones: qué es, por qué el usuario lo tiene basado en sus respuestas, qué implica"
    }
  ],
  "lentes": [
    {"icono": "emoji", "nombre": "Tipo de lente", "desc": "Por qué le conviene a este usuario específicamente"},
    {"icono": "emoji", "nombre": "Tipo de lente", "desc": "..."},
    {"icono": "emoji", "nombre": "Tipo de lente", "desc": "..."}
  ],
  "planSemanal": [
    {"dia": "Lun", "titulo": "Título del hábito", "texto": "Descripción concreta del hábito"},
    {"dia": "Mar", "titulo": "Título del hábito", "texto": "Descripción concreta del hábito"},
    {"dia": "Mié", "titulo": "Título del hábito", "texto": "Descripción concreta del hábito"},
    {"dia": "Jue", "titulo": "Título del hábito", "texto": "Descripción concreta del hábito"},
    {"dia": "Vie", "titulo": "Título del hábito", "texto": "Descripción concreta del hábito"},
    {"dia": "Sáb", "titulo": "Título del hábito", "texto": "Descripción concreta del hábito"},
    {"dia": "Dom", "titulo": "Título del hábito", "texto": "Descripción concreta del hábito"}
  ],
  "consejo": "Consejo final personalizado de 2-3 oraciones con una acción concreta para hoy.",
  "chatContexto": "Resumen de 3-4 líneas del perfil del usuario para que el asistente de chat lo tenga como contexto. Incluye condiciones principales, hábitos clave y recomendaciones."
}`;
}

// ── SHOW RESULT WITH AI ──
async function showResult() {
  document.getElementById('questions-screen').style.display = 'none';
  document.getElementById('loading-screen').style.display = 'block';

  const sc = calcScores();
  const msgs = [
    'Procesando tus síntomas y hábitos visuales...',
    'Evaluando indicadores de miopía, hipermetropía y astigmatismo...',
    'Cruzando datos con patrones de salud visual...',
    'Generando plan semanal de hábitos...',
    'Preparando tu diagnóstico personalizado...',
    'Casi listo...'
  ];
  let mi = 0;
  const msgEl = document.getElementById('loadingMsg');
  const msgInterval = setInterval(() => { mi = (mi+1) % msgs.length; msgEl.textContent = msgs[mi]; }, 1800);

  const risks = [
    {name:'Miopía', pct:sc.mP, color:'#2D6FA8', desc:'Dificultad para ver de lejos'},
    {name:'Hipermetropía', pct:sc.hP, color:'#2DAA78', desc:'Dificultad para ver de cerca'},
    {name:'Astigmatismo', pct:sc.aP, color:'#7B3FC4', desc:'Distorsión de la visión'},
    {name:'Fatiga digital', pct:sc.fP, color:'#E91E8C', desc:'Estrés por pantallas'},
    {name:'Riesgo UV', pct:sc.uP, color:'#F5A623', desc:'Exposición solar sin protección'},
    {name:'Déficit de sueño', pct:sc.sP, color:'#5B7BDE', desc:'Calidad de descanso'},
  ];
  document.getElementById('riskGrid').innerHTML = risks.map(r => `
    <div class="risk-card">
      <h4>${r.name}</h4>
      <div class="risk-bar-wrap"><div class="risk-bar" style="width:0;background:${r.color}" data-target="${r.pct}"></div></div>
      <div class="risk-pct" style="color:${r.color}">${r.pct}%</div>
      <div class="risk-desc">${r.desc}</div>
    </div>`).join('');

  try {
    const response = await fetch(TEST_DIAGNOSTICO_URL, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': CSRF_TOKEN,
        'Accept': 'application/json',
      },
      body: JSON.stringify({ prompt: buildPrompt(sc) })
    });

    const data = await response.json();

    const raw = data.choices?.[0]?.message?.content || '{}';

    let result;
    try {
      result = JSON.parse(raw.replace(/```json|```/g, '').trim());
    } catch(e) {
      throw new Error('parse');
    }

    clearInterval(msgInterval);
    document.getElementById('loading-screen').style.display = 'none';
    renderResults(result, sc);
    saveToHistory(result, sc);
    persistState('result', { resultMode: 'ai', result, scores: sc, testId: null });

    setSendPdfState('saving');
    const id = await saveToServer(result, sc);
    currentTestId = id;
    setSendPdfState(id ? 'ready' : 'error');
    persistState('result', { resultMode: 'ai', result, scores: sc, testId: id });

  } catch(err) {
    clearInterval(msgInterval);
    document.getElementById('loading-screen').style.display = 'none';
    showLocalResult(sc);
    currentTestId = null;
    setSendPdfState('error');
    persistState('result', { resultMode: 'local', result: null, scores: sc, testId: null });
  }
}

// ── RENDER RESULTS ──
function renderResults(result, sc) {
  const rs = document.getElementById('result-screen');
  rs.classList.add('show');
  document.getElementById('testCard').classList.add('wide-card');

  document.getElementById('resultTitle').textContent = result.titulo || 'Perfil Visual Detectado';
  document.getElementById('resultSubtitle').textContent = result.subtitulo || 'Análisis personalizado';
  const col = result.colorHex || '#7B3FC4';
  document.getElementById('resultHeader').style.background = `linear-gradient(135deg,${col}DD 0%,${col} 50%,${col}99 100%)`;

  const analysisEl = document.getElementById('aiAnalysis');
  const text = result.analisis || '';
  analysisEl.innerHTML = '<span class="ai-cursor"></span>';
  let i = 0;
  const streamInterval = setInterval(() => {
    if (i < text.length) {
      analysisEl.innerHTML = text.slice(0, ++i) + '<span class="ai-cursor"></span>';
    } else {
      analysisEl.innerHTML = text;
      clearInterval(streamInterval);
    }
  }, 16);

  setTimeout(() => {
    document.querySelectorAll('.risk-bar').forEach(b => { b.style.width = b.dataset.target + '%'; });
  }, 200);

  if (result.condiciones?.length) {
    document.getElementById('conditionsList').innerHTML = result.condiciones.map(c => {
      const sevClass = c.severidad === 'Alta' ? 'sev-high' : c.severidad === 'Media' ? 'sev-mid' : 'sev-low';
      return `<div class="cond-card">
        <div class="cond-header">
          <div class="cond-icon">${c.icono}</div>
          <div class="cond-name">${c.nombre}</div>
          <span class="cond-sev ${sevClass}">${c.severidad}</span>
        </div>
        <div class="cond-desc">${c.descripcion}</div>
      </div>`;
    }).join('');
  }

  if (result.lentes?.length) {
    document.getElementById('lensRecsGrid').innerHTML = result.lentes.map(l => `
      <div class="lens-rec-card">
        <div class="lens-rec-icon">${l.icono}</div>
        <div class="lens-rec-name">${l.nombre}</div>
        <div class="lens-rec-desc">${l.desc}</div>
      </div>`).join('');
  }

  if (result.planSemanal?.length) {
    document.getElementById('weekGrid').innerHTML = result.planSemanal.map(d => `
      <div class="day-card">
        <div class="day-label">${d.dia}</div>
        <div class="day-content"><strong>${d.titulo}</strong>${d.texto}</div>
      </div>`).join('');
  }

  if (result.consejo) {
    document.getElementById('resultTip').innerHTML = `
      <div class="tip-icon"><svg class="hand-icon" width="20" height="20"><use href="#icon-bombilla"></use></svg></div>
      <div class="tip-text">
        <strong>Consejo personalizado de Nebula View</strong>
        ${result.consejo}
      </div>`;
    document.getElementById('resultTip').style.display = 'flex';
  }

  initChat(result);
}

// ── LOCAL FALLBACK ──
function showLocalResult(sc) {
  const rs = document.getElementById('result-screen');
  rs.classList.add('show');
  document.getElementById('testCard').classList.add('wide-card');

  const scores = [{name:'Miopía',val:sc.mP,col:'#2D6FA8'},{name:'Hipermetropía',val:sc.hP,col:'#2DAA78'},{name:'Astigmatismo',val:sc.aP,col:'#7B3FC4'}];
  scores.sort((a,b)=>b.val-a.val);
  const p = scores[0];
  document.getElementById('resultTitle').textContent = `Perfil: ${p.name}`;
  document.getElementById('resultSubtitle').textContent = 'Diagnóstico basado en tus respuestas';
  document.getElementById('resultHeader').style.background = `linear-gradient(135deg,${p.col}DD 0%,${p.col} 50%,${p.col}99 100%)`;
  document.getElementById('aiAnalysis').textContent = 'Tus respuestas muestran indicadores asociados con problemas refractivos comunes. Te recomendamos visitar un profesional para una revisión completa.';

  const risks = [
    {name:'Miopía',pct:sc.mP,color:'#2D6FA8',desc:'Visión lejana'},
    {name:'Hipermetropía',pct:sc.hP,color:'#2DAA78',desc:'Visión cercana'},
    {name:'Astigmatismo',pct:sc.aP,color:'#7B3FC4',desc:'Distorsión visual'},
    {name:'Fatiga digital',pct:sc.fP,color:'#E91E8C',desc:'Estrés por pantallas'},
    {name:'Riesgo UV',pct:sc.uP,color:'#F5A623',desc:'Exposición solar'},
    {name:'Déficit de sueño',pct:sc.sP,color:'#5B7BDE',desc:'Calidad de descanso'},
  ];
  document.getElementById('riskGrid').innerHTML = risks.map(r => `
    <div class="risk-card">
      <h4>${r.name}</h4>
      <div class="risk-bar-wrap"><div class="risk-bar" style="width:0;background:${r.color}" data-target="${r.pct}"></div></div>
      <div class="risk-pct" style="color:${r.color}">${r.pct}%</div>
      <div class="risk-desc">${r.desc}</div>
    </div>`).join('');
  setTimeout(() => { document.querySelectorAll('.risk-bar').forEach(b => { b.style.width = b.dataset.target+'%'; }); }, 100);

  document.getElementById('conditionsList').innerHTML = `<div class="cond-card">
    <div class="cond-header"><div class="cond-icon"><svg class="custom-icon" aria-hidden="true"><use href="#icon-ojo"></use></svg></div><div class="cond-name">${p.name}</div><span class="cond-sev sev-mid">Media</span></div>
    <div class="cond-desc">Tu indicador de ${p.name.toLowerCase()} es el más alto de tus resultados. Te recomendamos una revisión profesional para confirmar el diagnóstico.</div>
  </div>`;

  initChat(null);
}

// ═══════════════════════════════════════════════════
//  CHAT
// ═══════════════════════════════════════════════════
function initChat(result) {
  chatHistory = [];
  const ctx = result?.chatContexto || 'El usuario completó un test visual de 20 preguntas. Responde como asistente especializado en salud visual de Nebula View.';
  const systemCtx = `Eres el asistente de salud visual de Nebula View, una óptica especializada. Tienes el contexto del diagnóstico del usuario:

${ctx}

Responde en español, de forma clara, empática y concisa (máximo 3-4 oraciones). No des diagnósticos definitivos, orienta hacia la consulta profesional cuando sea pertinente. Puedes mencionar productos o servicios de Nebula View cuando sea relevante.`;

  chatHistory.push({ role: 'system', content: systemCtx });

  const messagesEl = document.getElementById('chatMessages');
  messagesEl.innerHTML = '';
  appendMsg('ai', result
    ? `Hola <svg class="hand-icon" width="15" height="15"><use href="#icon-mano-saludo"></use></svg> Ya tengo tu diagnóstico. Soy tu asistente de Nebula View. Puedes preguntarme sobre tu perfil <em>${result.titulo}</em>, las condiciones detectadas, lentes recomendados o hábitos. ¿Por dónde empezamos?`
    : 'Hola <svg class="hand-icon" width="15" height="15"><use href="#icon-mano-saludo"></use></svg> Soy tu asistente de Nebula View. Puedes preguntarme sobre tus síntomas, hábitos visuales o lentes. ¿En qué te ayudo?');

  const suggestions = [
    '¿Qué es la miopía?',
    '¿Por qué tengo fatiga ocular?',
    '¿Qué lentes me recomiendas?',
    '¿Cada cuánto debo revisarme?',
  ];
  document.getElementById('chatSuggestions').innerHTML = suggestions.map(s =>
    `<span class="chat-sug">${s}</span>`
  ).join('');

  document.querySelectorAll('.chat-sug').forEach(s => {
    s.addEventListener('click', () => sendChat(s.textContent));
  });
}

function appendMsg(role, html) {
  const messagesEl = document.getElementById('chatMessages');
  const div = document.createElement('div');
  div.className = `msg ${role}`;
  const av = role === 'ai' ? '<svg class="hand-icon" width="18" height="18"><use href="#icon-robot"></use></svg>' : '<svg class="hand-icon" width="18" height="18"><use href="#icon-usuario"></use></svg>';
  div.innerHTML = `<div class="msg-av">${av}</div><div class="msg-bubble">${html}</div>`;
  messagesEl.appendChild(div);
  messagesEl.scrollTop = messagesEl.scrollHeight;
  return div;
}

function appendTyping() {
  const messagesEl = document.getElementById('chatMessages');
  const div = document.createElement('div');
  div.className = 'msg ai';
  div.id = 'typingIndicator';
  div.innerHTML = `<div class="msg-av"><svg class="hand-icon" width="18" height="18"><use href="#icon-robot"></use></svg></div><div class="typing-bubble"><span></span><span></span><span></span></div>`;
  messagesEl.appendChild(div);
  messagesEl.scrollTop = messagesEl.scrollHeight;
}

async function sendChat(text) {
  if (isChatLoading || !text.trim()) return;

  isChatLoading = true;

  document.getElementById('chatInput').value = '';
  document.getElementById('chatSuggestions').innerHTML = '';

  appendMsg('user', text);
  appendTyping();

  try {
    const res = await fetch(TEST_CHAT_URL, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': CSRF_TOKEN,
        'Accept': 'application/json',
      },
      body: JSON.stringify({
        mensaje: text,
        historial: chatHistory,
      })
    });

    if (!res.ok) {
      throw new Error(`HTTP ${res.status}`);
    }

    const data = await res.json();

    const reply = data?.choices?.[0]?.message?.content || "No pude generar una respuesta.";

    document.getElementById('typingIndicator')?.remove();

    appendMsg('ai', reply);

    chatHistory.push({ role: 'user', content: text });
    chatHistory.push({ role: 'assistant', content: reply });

  } catch (err) {
    document.getElementById('typingIndicator')?.remove();
    appendMsg('ai', 'Error: ' + err.message);
  } finally {
    isChatLoading = false;
  }
}

// ═══════════════════════════════════════════════════
//  HISTORIAL — vista rápida local (preview) + guardado real en servidor
// ═══════════════════════════════════════════════════

// Vista previa instantánea en la pantalla de inicio (no requiere esperar
// al servidor). El historial "de verdad" que se puede enviar por correo
// vive en la base de datos y se carga con loadHistoryFromServer().
function saveToHistory(result, sc) {
  const history = JSON.parse(localStorage.getItem(NEBULA_HISTORY_KEY) || '[]');
  history.unshift({
    date: new Date().toLocaleDateString('es-ES', { day:'numeric', month:'short', year:'numeric' }),
    titulo: result.titulo,
    colorHex: result.colorHex || '#7B3FC4',
    sc
  });
  if (history.length > 10) history.pop();
  localStorage.setItem(NEBULA_HISTORY_KEY, JSON.stringify(history));
}

function loadHistoryData() {
  return JSON.parse(localStorage.getItem(NEBULA_HISTORY_KEY) || '[]');
}

function renderHistoryPreview() {
  const history = loadHistoryData();
  if (!history.length) return;
  document.getElementById('histPreview').style.display = 'block';
  document.getElementById('histPreviewItems').innerHTML = history.slice(0,3).map(h => `
    <div class="hist-mini-item">
      <span>${h.titulo}</span>
      <span style="color:var(--muted);font-size:11px;">${h.date}</span>
    </div>`).join('');
}

// Guarda el diagnóstico completo en el servidor, asociado al usuario
// que inició sesión. Es "fire and forget": si falla, el usuario igual
// ve su resultado en pantalla, solo que no quedará en el historial
// persistente ni podrá pedir el PDF de ese test en particular.
// Guarda el test en el servidor y devuelve su id_test (o null si falla).
// Ya no es "fire and forget": necesitamos el id para poder ofrecer el
// botón de "Enviar PDF" en la propia pantalla de resultado.
async function saveToServer(result, sc) {
  try {
    const res = await fetch(TEST_GUARDAR_URL, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': CSRF_TOKEN,
        'Accept': 'application/json',
      },
      body: JSON.stringify({ resultado: result, scores: sc })
    });
    if (!res.ok) throw new Error('guardar-failed');
    const data = await res.json();
    return data.id_test ?? null;
  } catch (e) {
    console.warn('No se pudo guardar el test en el servidor:', e);
    return null;
  }
}

// ═══════════════════════════════════════════════════
//  ENVIAR PDF — desde la propia pantalla de resultado
// ═══════════════════════════════════════════════════
let currentTestId = null;

function setSendPdfState(state) {
  const btn = document.getElementById('sendPdfBtn');
  if (!btn) return;
  if (state === 'saving') {
    btn.disabled = true;
    btn.innerHTML = '<svg class="hand-icon" width="14" height="14"><use href="#icon-guardar"></use></svg> Guardando test…';
  } else if (state === 'ready') {
    btn.disabled = false;
    btn.innerHTML = '<svg class="hand-icon" width="14" height="14"><use href="#icon-sobre"></use></svg> Enviar PDF a mi correo';
  } else if (state === 'sending') {
    btn.disabled = true;
    btn.textContent = 'Enviando…';
  } else if (state === 'error') {
    btn.disabled = true;
    btn.innerHTML = '<svg class="hand-icon" width="14" height="14"><use href="#icon-warning"></use></svg> PDF no disponible';
  }
}

async function enviarPdfTestActual() {
  if (!currentTestId) return;
  setSendPdfState('sending');
  try {
    const res = await fetch(TEST_ENVIAR_PDF_URL(currentTestId), {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': CSRF_TOKEN, 'Accept': 'application/json' },
    });
    const data = await res.json();
    if (res.ok && data.success) {
      doToast('ok', 'Enviado', data.message || 'Revisa tu correo.');
    } else {
      doToast('err', 'No se pudo enviar', data.error || 'Inténtalo de nuevo.');
    }
  } catch (err) {
    doToast('err', 'Error de conexión', 'No pudimos enviar el diagnóstico.');
  } finally {
    setSendPdfState('ready');
  }
}

document.getElementById('sendPdfBtn').addEventListener('click', enviarPdfTestActual);

async function loadHistoryFromServer() {
  const res = await fetch(TEST_HISTORIAL_URL, { headers: { 'Accept': 'application/json' } });
  if (!res.ok) throw new Error('historial-fetch-failed');
  return res.json();
}

function scoreRow(h) {
  const sc = h.scores || {};
  return `
    <span class="hist-score" style="color:#2D6FA8">M ${sc.mP||0}%</span>
    <span class="hist-score" style="color:#7B3FC4">A ${sc.aP||0}%</span>
    <span class="hist-score" style="color:#E91E8C">F ${sc.fP||0}%</span>`;
}

async function renderHistoryScreen() {
  const container = document.getElementById('historyItems');
  container.innerHTML = '<div class="hist-empty">Cargando historial…</div>';

  let history = [];
  try {
    history = await loadHistoryFromServer();
  } catch (e) {
    container.innerHTML = '<div class="hist-empty">No pudimos cargar tu historial. Intenta de nuevo.</div>';
    return;
  }

  if (!history.length) {
    container.innerHTML = '<div class="hist-empty">No hay tests anteriores guardados.</div>';
    return;
  }

  container.innerHTML = history.map(h => `
    <div class="hist-item" data-id="${h.id_test}">
      <div class="hist-dot" style="background:${h.colorHex}"></div>
      <div class="hist-info">
        <div class="hist-title">${h.titulo}</div>
        <div class="hist-date">${h.fecha}</div>
      </div>
      <div class="hist-scores">${scoreRow(h)}</div>
      <div class="hist-actions" style="display:flex;gap:8px;margin-left:10px;">
        <button type="button" class="btn-cta-secondary hist-send-btn" data-id="${h.id_test}" style="padding:6px 10px;font-size:12px;"><svg class="hand-icon" width="13" height="13"><use href="#icon-sobre"></use></svg> Enviar PDF</button>
        <button type="button" class="btn-cta-secondary hist-del-btn" data-id="${h.id_test}" style="padding:6px 10px;font-size:12px;color:#c0152e;border-color:rgba(233,30,60,.3);"><svg class="hand-icon" width="14" height="14"><use href="#icon-papelera"></use></svg></button>
      </div>
    </div>`).join('');
}

// Delegación de eventos: los botones de cada item se crean dinámicamente.
document.getElementById('historyItems').addEventListener('click', async (e) => {
  const sendBtn = e.target.closest('.hist-send-btn');
  const delBtn = e.target.closest('.hist-del-btn');

  if (sendBtn) {
    const id = sendBtn.dataset.id;
    sendBtn.disabled = true;
    const original = sendBtn.textContent;
    sendBtn.textContent = 'Enviando…';
    try {
      const res = await fetch(TEST_ENVIAR_PDF_URL(id), {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': CSRF_TOKEN, 'Accept': 'application/json' },
      });
      const data = await res.json();
      if (res.ok && data.success) {
        doToast('ok', 'Enviado', data.message || 'Revisa tu correo.');
      } else {
        doToast('err', 'No se pudo enviar', data.error || 'Inténtalo de nuevo.');
      }
    } catch (err) {
      doToast('err', 'Error de conexión', 'No pudimos enviar el diagnóstico.');
    } finally {
      sendBtn.disabled = false;
      sendBtn.textContent = original;
    }
  }

  if (delBtn) {
    const id = delBtn.dataset.id;
    if (!confirm('¿Eliminar este test de tu historial? Esta acción no se puede deshacer.')) return;
    try {
      await fetch(TEST_DESTROY_URL(id), {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': CSRF_TOKEN, 'Accept': 'application/json' },
      });
      renderHistoryScreen();
    } catch (err) {
      doToast('err', 'Error', 'No se pudo eliminar el test.');
    }
  }
});

document.getElementById('historyBtn').addEventListener('click', () => {
  renderHistoryScreen();
  document.getElementById('result-screen').classList.remove('show');
  document.getElementById('history-screen').classList.add('show');
});

document.getElementById('backFromHistBtn').addEventListener('click', () => {
  document.getElementById('history-screen').classList.remove('show');
  document.getElementById('result-screen').classList.add('show');
});

document.getElementById('clearHistBtn').addEventListener('click', async () => {
  if (!confirm('¿Vaciar todo tu historial guardado? Esta acción no se puede deshacer.')) return;
  try {
    const history = await loadHistoryFromServer();
    await Promise.all(history.map(h => fetch(TEST_DESTROY_URL(h.id_test), {
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': CSRF_TOKEN, 'Accept': 'application/json' },
    })));
  } catch (e) {
    console.warn('No se pudo vaciar el historial del servidor:', e);
  }
  localStorage.removeItem(NEBULA_HISTORY_KEY);
  renderHistoryScreen();
  renderHistoryPreview();
});

document.getElementById('retestBtn').addEventListener('click', () => {
  Object.keys(answers).forEach(k => delete answers[k]);
  currentQ = 1;
  currentTestId = null;
  document.querySelectorAll('.opt,.scale-opt').forEach(o => o.classList.remove('selected'));
  document.querySelectorAll('.btn-next').forEach(b => b.disabled = true);
  document.getElementById('result-screen').classList.remove('show');
  document.getElementById('history-screen').classList.remove('show');
  document.getElementById('loading-screen').style.display = 'none';
  document.getElementById('questions-screen').style.display = 'none';
  document.getElementById('intro-screen').style.display = 'block';
  document.getElementById('testCard').classList.remove('wide-card');
  document.getElementById('aiAnalysis').innerHTML = '';
  document.getElementById('resultTip').style.display = 'none';
  setSendPdfState('saving');
  document.getElementById('sendPdfBtn').innerHTML = '<svg class="hand-icon" width="14" height="14"><use href="#icon-sobre"></use></svg> Enviar PDF a mi correo';
  document.getElementById('sendPdfBtn').disabled = true;
  clearPersistedState();
  renderHistoryPreview();
});


// ── INIT ──
buildQuestions();
renderHistoryPreview();
restoreSession();

document.getElementById('chatSend').addEventListener('click', () => {
  sendChat(document.getElementById('chatInput').value);
});

document.getElementById('chatInput').addEventListener('keydown', (e) => {
  if (e.key === 'Enter') {
    sendChat(document.getElementById('chatInput').value);
  }
});
</script>
@endsection