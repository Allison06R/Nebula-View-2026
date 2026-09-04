@extends('layouts.app')

@section('title', 'Test de Ishihara — Nebula View')

@section('css')
<link rel="stylesheet" href="{{ asset('css/test.css') }}">
<link rel="stylesheet" href="{{ asset('css/test-ishihara.css') }}">
@endsection

@section('content')

<section class="test-hero">
  <div class="hbc hbc-1"></div>
  <div class="hbc hbc-2"></div>
  <div class="hbc hbc-3"></div>
  <div class="hbc hbc-4"></div>
  <div class="hbc hbc-5"></div>

  <div class="hero-card" id="ishCard">

    <!-- INTRO -->
    <div id="ish-intro-screen">
      <div class="hero-badge"><svg class="hand-icon" width="15" height="15"><use href="#icon-paleta"></use></svg> Test de Ishihara · IA</div>
      @include('partials.test-switcher')
      <h1>Test de<br><em>daltonismo</em></h1>
      <p>El test de Ishihara es una prueba visual clásica, creada por el oftalmólogo japonés Shinobu Ishihara, que se usa para detectar dificultades en la percepción de los colores (daltonismo), principalmente del tipo rojo-verde. Consiste en láminas formadas por puntos de colores donde se "esconde" un número: si tu percepción del color es típica podrás leerlo con facilidad, y si tienes alguna deficiencia cromática te costará más o verás un número distinto.</p>

      <div class="ish-info-box">
        <div class="ish-info-item"><span class="ish-info-ico"><svg class="hand-icon" width="16" height="16"><use href="#icon-numeros"></use></svg></span> Verás {{ count(config('ishihara.laminas')) }} láminas, una por una</div>
        <div class="ish-info-item"><span class="ish-info-ico">⌨️</span> Escribe el número que veas en cada una (o marca "No lo veo")</div>
        <div class="ish-info-item"><span class="ish-info-ico"><svg class="hand-icon" width="16" height="16"><use href="#icon-robot"></use></svg></span> Al final, la IA te da una interpretación orientativa y puedes chatear sobre tu resultado</div>
      </div>

      <div class="hist-preview" id="ishHistPreview" style="display:none;">
        <div class="hist-preview-title"><svg class="hand-icon" width="15" height="15"><use href="#icon-nota"></use></svg> Tests anteriores</div>
        <div id="ishHistPreviewItems"></div>
      </div>

      <button class="btn-next" id="ishStartBtn" style="width:100%;justify-content:center;">
        Comenzar test
        <span class="arrow-ic">→</span>
      </button>
      <p style="font-size:11px;color:var(--muted);margin-top:16px;"><svg class="hand-icon" width="13" height="13"><use href="#icon-warning"></use></svg> Este test es orientativo y <strong>no reemplaza un examen profesional completo de visión del color</strong> (por ejemplo, con un optometrista u oftalmólogo). Úsalo solo como una primera referencia.</p>
    </div>

    <!-- LÁMINAS -->
    <div id="ish-plate-screen" style="display:none;">
      <button type="button" class="btn-exit-test" id="ishExitBtn">← Volver a tests</button>
      <div class="test-meta">
        <span id="ish-counter">Lámina 1 de 10</span>
      </div>
      <div class="progress-bar-wrap">
        <div class="progress-bar" id="ishProgressBar" style="width:0%"></div>
      </div>

      <div class="ish-plate-wrap">
        <img id="ishPlateImg" class="ish-plate-img" src="" alt="Lámina de Ishihara">
      </div>

      <div class="ish-question">¿Qué número ves en el círculo?</div>

      <div class="ish-keypad" id="ishKeypad">
        <button class="ish-key" data-k="1">1</button>
        <button class="ish-key" data-k="2">2</button>
        <button class="ish-key" data-k="3">3</button>
        <button class="ish-key" data-k="4">4</button>
        <button class="ish-key" data-k="5">5</button>
        <button class="ish-key" data-k="6">6</button>
        <button class="ish-key" data-k="7">7</button>
        <button class="ish-key" data-k="8">8</button>
        <button class="ish-key" data-k="9">9</button>
        <button class="ish-key ish-key-clear" data-k="clear">⌫</button>
        <button class="ish-key" data-k="0">0</button>
        <button class="ish-key ish-key-novelo" data-k="novelo">No lo veo</button>
      </div>

      <div class="ish-answer-display" id="ishAnswerDisplay">&nbsp;</div>

      <div class="q-nav">
        <button class="btn-back" id="ishBackBtn" style="visibility:hidden;">← Anterior</button>
        <button class="btn-next" id="ishNextBtn" disabled>Siguiente <span class="arrow-ic">→</span></button>
      </div>
    </div>

    <!-- LOADING -->
    <div id="ish-loading-screen" style="display:none;text-align:center;padding:20px 0;">
      <div class="hero-badge" style="margin-bottom:28px;"><svg class="hand-icon" width="15" height="15"><use href="#icon-robot"></use></svg> IA analizando tus respuestas</div>
      <div class="ai-loader">
        <div class="ai-orb"></div>
        <div class="ai-rings">
          <div class="ai-ring r1"></div>
          <div class="ai-ring r2"></div>
          <div class="ai-ring r3"></div>
        </div>
      </div>
      <h3 style="font-family: 'MuseoModerno', serif;font-size:22px;color:var(--dark);margin:28px 0 10px;">Generando tu resultado</h3>
      <p style="font-size:14px;color:var(--muted);line-height:1.7;max-width:340px;margin:0 auto;">Comparando tus respuestas y preparando una interpretación orientativa...</p>
      <div class="loading-dots" style="margin-top:20px;"><span></span><span></span><span></span></div>
    </div>

    <!-- RESULTADO -->
    <div id="ish-result-screen">
      <div class="result-header" id="ishResultHeader">
        <div class="result-badge"><svg class="hand-icon" width="15" height="15"><use href="#icon-paleta"></use></svg> Test de Ishihara · Nebula View</div>
        <div class="result-title" id="ishResultTitle">Resultado del test</div>
        <div class="result-subtitle" id="ishResultSubtitle">Interpretación orientativa basada en tus respuestas</div>
      </div>

      <div class="ish-score-card">
        <div class="ish-score-num"><span id="ishScoreAciertos">0</span>/<span id="ishScoreTotal">10</span></div>
        <div class="ish-score-lbl">láminas correctas</div>
      </div>

      <div class="ish-result-columns">
        <div class="ish-result-left">
          <div id="ishAiResumen" style="font-size:14px;color:var(--muted);line-height:1.85;margin-bottom:18px;text-align:left;"></div>

          <div class="ish-panel" id="ishPatronPanel" style="display:none;">
            <div class="ish-panel-title"><svg class="hand-icon" width="15" height="15"><use href="#icon-scope"></use></svg> Patrón observado</div>
            <div id="ishPatronTexto"></div>
          </div>

          <div class="ish-panel ish-panel-dark" id="ishRecoPanel" style="display:none;">
            <div class="ish-panel-title"><svg class="hand-icon" width="15" height="15"><use href="#icon-bombilla"></use></svg> Recomendación</div>
            <div id="ishRecoTexto"></div>
          </div>

          <div class="sec-title">Detalle lámina por lámina</div>
          <div class="ish-detail-grid" id="ishDetailGrid"></div>
        </div>

        <div class="ish-result-right">
          <div class="sec-title">Chat con tu asistente visual</div>
          <div class="chat-wrap">
            <div class="chat-header">
              <div class="chat-avatar"><svg class="hand-icon" width="18" height="18"><use href="#icon-robot"></use></svg></div>
              <div class="chat-header-info">
                <div class="chat-header-name">Asistente Nebulita</div>
                <div class="chat-header-status">● En línea · contexto de tu resultado activo</div>
              </div>
            </div>
            <div class="chat-messages" id="ishChatMessages"></div>
            <div class="chat-suggestions" id="ishChatSuggestions"></div>
            <div class="chat-input-wrap">
              <input class="chat-input" id="ishChatInput" placeholder="Pregunta sobre tu resultado..." />
              <button class="chat-send" id="ishChatSend">↑</button>
            </div>
          </div>
        </div>
      </div>

      <div class="result-ctas cta-row">
        <button class="btn-cta-secondary" id="ishSendPdfBtn" disabled><svg class="hand-icon" width="15" height="15"><use href="#icon-guardar"></use></svg> Guardando test…</button>
        <button class="btn-cta-secondary" id="ishHistoryBtn"><svg class="hand-icon" width="15" height="15"><use href="#icon-nota"></use></svg> Ver historial</button>
        <button class="btn-cta-secondary" id="ishRetestBtn"><svg class="hand-icon" width="15" height="15"><use href="#icon-recargar"></use></svg> Repetir test</button>
        <button class="btn-cta-secondary btn-back-tests" id="ishBackToTestsBtn">← Volver a tests</button>
      </div>
      <p style="font-size:11px;color:var(--muted);margin-top:20px;text-align:center;"><svg class="hand-icon" width="13" height="13"><use href="#icon-warning"></use></svg> Este resultado es orientativo y no reemplaza un examen profesional completo de visión del color. Ante cualquier duda, consulta a un especialista.</p>
    </div>

    <!-- HISTORIAL -->
    <div id="ish-history-screen">
      <div class="history-card">
        <div class="hero-badge"><svg class="hand-icon" width="15" height="15"><use href="#icon-nota"></use></svg> Tu historial</div>
        <h2>Tests de Ishihara anteriores</h2>
        <p>Compara tus resultados a lo largo del tiempo.</p>
        <div class="hist-items" id="ishHistoryItems"></div>
        <div class="cta-row" style="margin-top:24px;">
          <button class="btn-cta-secondary" id="ishBackFromHistBtn">← Volver</button>
        </div>
      </div>
    </div>

  </div>
</section>

<div class="toast" id="ishToast">
  <div class="t-ico" id="ish-t-ico">✓</div>
  <div class="t-txt">
    <b id="ish-t-title">Listo</b>
    <span id="ish-t-msg">Acción completada.</span>
  </div>
</div>

@endsection

@section('scripts')
<script>
const ISH_LAMINAS_URL     = "{{ route('test-ishihara.laminas') }}";
const ISH_FINALIZAR_URL   = "{{ route('test-ishihara.finalizar') }}";
const ISH_CHAT_URL        = "{{ route('test-ishihara.chat') }}";
const ISH_HISTORIAL_URL   = "{{ route('test-ishihara.historial') }}";
const ISH_ENVIAR_PDF_URL  = (id) => `{{ url('/test-ishihara') }}/${id}/enviar-pdf`;
const ISH_CSRF_TOKEN      = "{{ csrf_token() }}";

function ishToast(type, title, msg) {
  const toast = document.getElementById('ishToast');
  document.getElementById('ish-t-ico').textContent   = type === 'ok' ? '✓' : '✕';
  document.getElementById('ish-t-title').textContent = title;
  document.getElementById('ish-t-msg').textContent   = msg;
  toast.classList.remove('toast-ok', 'toast-err', 'show');
  toast.classList.add(type === 'ok' ? 'toast-ok' : 'toast-err');
  requestAnimationFrame(() => requestAnimationFrame(() => toast.classList.add('show')));
  setTimeout(() => toast.classList.remove('show'), 4500);
}

// ═══════════════════════════════════════════════════
//  PERSISTENCIA DE SESIÓN — para que al recargar la página
//  a mitad del test (o viendo el resultado) no te saque,
//  sino que te deje justo donde estabas. (mismo patrón que test.blade.php)
// ═══════════════════════════════════════════════════
const ISH_SESSION_KEY = 'nebulaIshiharaSession';

function ishPersistState(screen, extra = {}) {
  try {
    const state = {
      screen, // 'plate' | 'result'
      currentIdx,
      ishAnswers,
      resultData: extra.resultData ?? null,
      testId: extra.testId !== undefined ? extra.testId : ishCurrentTestId,
    };
    sessionStorage.setItem(ISH_SESSION_KEY, JSON.stringify(state));
  } catch (e) { /* almacenamiento no disponible, no pasa nada grave */ }
}

function ishLoadPersistedState() {
  try {
    const raw = sessionStorage.getItem(ISH_SESSION_KEY);
    return raw ? JSON.parse(raw) : null;
  } catch (e) { return null; }
}

function ishClearPersistedState() {
  try { sessionStorage.removeItem(ISH_SESSION_KEY); } catch (e) { /* noop */ }
}

// Reconstruye la pantalla en la que estaba el usuario antes de recargar.
async function ishRestoreSession() {
  const state = ishLoadPersistedState();
  if (!state) return;

  if (state.screen === 'result' && state.resultData) {
    ishCurrentTestId = state.testId || null;
    ishRenderResult(state.resultData);
    ishSetSendPdfState(ishCurrentTestId ? 'ready' : 'error');
  } else if (state.screen === 'plate') {
    if (!laminas.length) await ishLoadLaminas();
    Object.assign(ishAnswers, state.ishAnswers || {});
    currentIdx = Math.min(state.currentIdx || 0, laminas.length - 1);
    ishShowScreen('plate');
    ishRenderPlate();
  }
}

let laminas = [];
let currentIdx = 0;
const ishAnswers = {}; // { id: '15' | 'no lo veo' }
let ishCurrentInput = '';
let ishChatHistory = [];
let ishChatLoading = false;
let ishCurrentTestId = null;

async function ishLoadLaminas() {
  const res = await fetch(ISH_LAMINAS_URL, { headers: { 'Accept': 'application/json' } });
  laminas = await res.json();
}

function ishShowScreen(name) {
  ['intro', 'plate', 'loading'].forEach(s => {
    const el = document.getElementById(`ish-${s}-screen`);
    if (el) el.style.display = (s === name) ? 'block' : 'none';
  });
  document.getElementById('ish-result-screen').classList.toggle('show', name === 'result');
  document.getElementById('ish-history-screen').classList.toggle('show', name === 'history');
  document.getElementById('ishCard').classList.toggle('wide-card', name === 'result' || name === 'history');
}

function ishRenderPlate() {
  const l = laminas[currentIdx];
  document.getElementById('ishPlateImg').src = l.imagen;
  document.getElementById('ish-counter').textContent = `Lámina ${currentIdx + 1} de ${laminas.length}`;
  document.getElementById('ishProgressBar').style.width = Math.round((currentIdx / laminas.length) * 100) + '%';
  document.getElementById('ishBackBtn').style.visibility = currentIdx === 0 ? 'hidden' : 'visible';

  const saved = ishAnswers[l.id];
  ishCurrentInput = (saved && saved !== 'no lo veo') ? saved : '';
  ishUpdateAnswerDisplay();
  document.querySelectorAll('.ish-key-novelo').forEach(b => b.classList.toggle('selected', saved === 'no lo veo'));

  const isLast = currentIdx === laminas.length - 1;
  document.getElementById('ishNextBtn').innerHTML = isLast
    ? 'Ver mi resultado <svg class="hand-icon" width="14" height="14"><use href="#icon-diana"></use></svg>'
    : 'Siguiente <span class="arrow-ic">→</span>';
  document.getElementById('ishNextBtn').disabled = !(saved !== undefined && saved !== '');

  ishPersistState('plate');
}

function ishUpdateAnswerDisplay() {
  const el = document.getElementById('ishAnswerDisplay');
  el.textContent = ishCurrentInput || '\u00A0';
}

document.getElementById('ishKeypad').addEventListener('click', (e) => {
  const btn = e.target.closest('.ish-key');
  if (!btn) return;
  const k = btn.dataset.k;
  const l = laminas[currentIdx];

  document.querySelectorAll('.ish-key-novelo').forEach(b => b.classList.remove('selected'));

  if (k === 'clear') {
    ishCurrentInput = '';
    delete ishAnswers[l.id];
  } else if (k === 'novelo') {
    ishCurrentInput = '';
    ishAnswers[l.id] = 'no lo veo';
    btn.classList.add('selected');
  } else {
    if (ishCurrentInput.length < 3) ishCurrentInput += k;
    ishAnswers[l.id] = ishCurrentInput;
  }

  ishUpdateAnswerDisplay();
  document.getElementById('ishNextBtn').disabled = !(ishAnswers[l.id] !== undefined && ishAnswers[l.id] !== '');
  ishPersistState('plate');
});

document.getElementById('ishBackBtn').addEventListener('click', () => {
  if (currentIdx > 0) { currentIdx--; ishRenderPlate(); }
});

document.getElementById('ishNextBtn').addEventListener('click', () => {
  if (currentIdx < laminas.length - 1) {
    currentIdx++;
    ishRenderPlate();
  } else {
    ishFinalizarTest();
  }
});

document.getElementById('ishStartBtn').addEventListener('click', async () => {
  if (!laminas.length) await ishLoadLaminas();
  currentIdx = 0;
  Object.keys(ishAnswers).forEach(k => delete ishAnswers[k]);
  ishShowScreen('plate');
  ishRenderPlate();
});

async function ishFinalizarTest() {
  ishShowScreen('loading');
  document.getElementById('ishProgressBar').style.width = '100%';

  const respuestas = laminas.map(l => ({ id: l.id, respuesta: ishAnswers[l.id] ?? '' }));

  try {
    const res = await fetch(ISH_FINALIZAR_URL, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': ISH_CSRF_TOKEN,
        'Accept': 'application/json',
      },
      body: JSON.stringify({ respuestas })
    });
    const data = await res.json();

    ishCurrentTestId = data.id_test_ishihara ?? null;
    ishRenderResult(data);
    ishSetSendPdfState(ishCurrentTestId ? 'ready' : 'error');
    ishPersistState('result', { resultData: data, testId: ishCurrentTestId });
  } catch (err) {
    ishShowScreen('intro');
    ishToast('err', 'Error', 'No pudimos calcular tu resultado. Inténtalo de nuevo.');
  }
}

function ishNivelColor(nivel) {
  return { normal: '#2DAA78', leve: '#F5A623', moderado: '#E9701E', a_evaluar: '#c0152e' }[nivel] || '#7B3FC4';
}

function ishRenderResult(data) {
  const r = data.resultado || {};
  const col = ishNivelColor(r.nivel);

  ishShowScreen('result');

  document.getElementById('ishResultTitle').textContent = r.titulo || 'Resultado de tu test';
  document.getElementById('ishResultSubtitle').textContent = 'Interpretación orientativa generada por IA — no es un diagnóstico clínico';
  document.getElementById('ishResultHeader').style.background = `linear-gradient(135deg,${col}DD 0%,${col} 50%,${col}99 100%)`;

  document.getElementById('ishScoreAciertos').textContent = data.aciertos ?? 0;
  document.getElementById('ishScoreTotal').textContent = data.total ?? laminas.length;

  document.getElementById('ishAiResumen').textContent = r.resumen || '';

  if (r.posiblePatron) {
    document.getElementById('ishPatronPanel').style.display = 'block';
    document.getElementById('ishPatronTexto').textContent = r.posiblePatron;
  }
  if (r.recomendacion) {
    document.getElementById('ishRecoPanel').style.display = 'block';
    document.getElementById('ishRecoTexto').textContent = r.recomendacion;
  }

  document.getElementById('ishDetailGrid').innerHTML = (data.detalle || []).map(d => `
    <div class="ish-detail-item ${d.correcta ? 'ok' : 'fail'}">
      <span class="ish-detail-num">Lámina ${d.id_lamina}</span>
      <span class="ish-detail-resp">Tu respuesta: <strong>${d.respuesta}</strong></span>
      <span class="ish-detail-ico">${d.correcta ? '✓' : '✕'}</span>
    </div>`).join('');

  ishInitChat(r);
}

// ── CHAT ──
function ishInitChat(resultado) {
  ishChatHistory = [];
  const ctx = resultado?.chatContexto || 'El usuario completó un test de Ishihara. Responde como asistente especializado en salud visual de Nebula View.';
  const systemCtx = `Eres el asistente de salud visual de Nebula View, una óptica especializada. Tienes el contexto del resultado del test de Ishihara del usuario:

${ctx}

Responde en español, de forma clara, empática y concisa (máximo 3-4 oraciones). No des diagnósticos definitivos: este es un test orientativo, no un examen clínico. Orienta hacia la consulta con un profesional de la visión cuando sea pertinente.`;

  ishChatHistory.push({ role: 'system', content: systemCtx });

  const messagesEl = document.getElementById('ishChatMessages');
  messagesEl.innerHTML = '';
  ishAppendMsg('ai', `Hola <svg class="hand-icon" width="15" height="15"><use href="#icon-mano-saludo"></use></svg> Ya tengo tu resultado del test de Ishihara. Puedes preguntarme sobre qué significa, si un patrón de errores sugiere algo en particular, o cuándo conviene consultar a un especialista.`);

  const suggestions = [
    '¿Qué significa mi resultado?',
    '¿Esto es un diagnóstico definitivo?',
    '¿Cuándo debería ver a un especialista?',
    '¿Qué tipos de daltonismo existen?',
  ];
  document.getElementById('ishChatSuggestions').innerHTML = suggestions.map(s => `<span class="chat-sug">${s}</span>`).join('');
  document.querySelectorAll('#ishChatSuggestions .chat-sug').forEach(s => {
    s.addEventListener('click', () => ishSendChat(s.textContent));
  });
}

function ishAppendMsg(role, html) {
  const messagesEl = document.getElementById('ishChatMessages');
  const div = document.createElement('div');
  div.className = `msg ${role}`;
  const av = role === 'ai' ? '<svg class="hand-icon" width="18" height="18"><use href="#icon-robot"></use></svg>' : '<svg class="hand-icon" width="18" height="18"><use href="#icon-usuario"></use></svg>';
  div.innerHTML = `<div class="msg-av">${av}</div><div class="msg-bubble">${html}</div>`;
  messagesEl.appendChild(div);
  messagesEl.scrollTop = messagesEl.scrollHeight;
}

function ishAppendTyping() {
  const messagesEl = document.getElementById('ishChatMessages');
  const div = document.createElement('div');
  div.className = 'msg ai';
  div.id = 'ishTypingIndicator';
  div.innerHTML = `<div class="msg-av"><svg class="hand-icon" width="18" height="18"><use href="#icon-robot"></use></svg></div><div class="typing-bubble"><span></span><span></span><span></span></div>`;
  messagesEl.appendChild(div);
  messagesEl.scrollTop = messagesEl.scrollHeight;
}

async function ishSendChat(text) {
  if (ishChatLoading || !text.trim()) return;
  ishChatLoading = true;

  document.getElementById('ishChatInput').value = '';
  document.getElementById('ishChatSuggestions').innerHTML = '';

  ishAppendMsg('user', text);
  ishAppendTyping();

  try {
    const res = await fetch(ISH_CHAT_URL, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': ISH_CSRF_TOKEN,
        'Accept': 'application/json',
      },
      body: JSON.stringify({ mensaje: text, historial: ishChatHistory })
    });
    if (!res.ok) throw new Error(`HTTP ${res.status}`);
    const data = await res.json();
    const reply = data?.choices?.[0]?.message?.content || 'No pude generar una respuesta.';

    document.getElementById('ishTypingIndicator')?.remove();
    ishAppendMsg('ai', reply);

    ishChatHistory.push({ role: 'user', content: text });
    ishChatHistory.push({ role: 'assistant', content: reply });
  } catch (err) {
    document.getElementById('ishTypingIndicator')?.remove();
    ishAppendMsg('ai', 'Error: ' + err.message);
  } finally {
    ishChatLoading = false;
  }
}

document.getElementById('ishChatSend').addEventListener('click', () => ishSendChat(document.getElementById('ishChatInput').value));
document.getElementById('ishChatInput').addEventListener('keydown', (e) => {
  if (e.key === 'Enter') ishSendChat(e.target.value);
});

// ── PDF ──
function ishSetSendPdfState(state) {
  const btn = document.getElementById('ishSendPdfBtn');
  if (!btn) return;
  if (state === 'ready') { btn.disabled = false; btn.innerHTML = '<svg class="hand-icon" width="14" height="14"><use href="#icon-sobre"></use></svg> Enviar PDF a mi correo'; }
  else if (state === 'sending') { btn.disabled = true; btn.textContent = 'Enviando…'; }
  else if (state === 'error') { btn.disabled = true; btn.innerHTML = '<svg class="hand-icon" width="14" height="14"><use href="#icon-warning"></use></svg> PDF no disponible'; }
}

document.getElementById('ishSendPdfBtn').addEventListener('click', async () => {
  if (!ishCurrentTestId) return;
  ishSetSendPdfState('sending');
  try {
    const res = await fetch(ISH_ENVIAR_PDF_URL(ishCurrentTestId), {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': ISH_CSRF_TOKEN, 'Accept': 'application/json' },
    });
    const data = await res.json();
    if (res.ok && data.success) {
      ishToast('ok', 'Enviado', data.message || 'Revisa tu correo.');
    } else {
      ishToast('err', 'No se pudo enviar', data.error || 'Inténtalo de nuevo.');
    }
  } catch (err) {
    ishToast('err', 'Error de conexión', 'No pudimos enviar el resultado.');
  } finally {
    ishSetSendPdfState('ready');
  }
});

// ── VOLVER A TESTS (desde las láminas o desde el resultado) ──
document.getElementById('ishExitBtn').addEventListener('click', () => ishShowScreen('intro'));
document.getElementById('ishBackToTestsBtn').addEventListener('click', () => ishShowScreen('intro'));

// ── REPETIR ──
document.getElementById('ishRetestBtn').addEventListener('click', async () => {
  if (!laminas.length) await ishLoadLaminas();
  currentIdx = 0;
  Object.keys(ishAnswers).forEach(k => delete ishAnswers[k]);
  ishCurrentTestId = null;
  ishClearPersistedState();
  ishShowScreen('plate');
  ishRenderPlate();
});

// ── HISTORIAL ──
async function ishLoadHistorial() {
  const res = await fetch(ISH_HISTORIAL_URL, { headers: { 'Accept': 'application/json' } });
  return res.json();
}

document.getElementById('ishHistoryBtn').addEventListener('click', async () => {
  const items = await ishLoadHistorial();
  document.getElementById('ishHistoryItems').innerHTML = items.length
    ? items.map(h => `
      <div class="hist-item">
        <div class="hist-item-main">
          <strong>${h.titulo}</strong>
          <span>${h.aciertos}/${h.total} correctas · ${h.fecha}</span>
        </div>
      </div>`).join('')
    : '<p style="color:var(--muted);font-size:13px;">Aún no tienes tests de Ishihara guardados.</p>';
  ishShowScreen('history');
});

document.getElementById('ishBackFromHistBtn').addEventListener('click', () => {
  ishShowScreen(ishCurrentTestId ? 'result' : 'intro');
});

// ── PREVIEW EN INTRO ──
(async function ishInit() {
  try {
    const items = await ishLoadHistorial();
    if (items.length) {
      document.getElementById('ishHistPreview').style.display = 'block';
      document.getElementById('ishHistPreviewItems').innerHTML = items.slice(0, 3).map(h => `
        <div class="hist-mini-item">
          <span>${h.titulo}</span>
          <span style="color:var(--muted);font-size:11px;">${h.aciertos}/${h.total} · ${h.fecha}</span>
        </div>`).join('');
    }
  } catch (e) { /* usuario sin historial o sin conexión, no pasa nada */ }

  await ishRestoreSession();
})();
</script>
@endsection
