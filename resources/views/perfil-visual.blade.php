@extends('layouts.app')

@section('title', 'Perfil Visual - Nebula View')

@section('css')
<link rel="stylesheet" href="{{ asset('css/perfilvisual.css') }}">
@endsection

@section('content')
<div class="pv-cosmos">
  <div class="pv-stars"></div>
  <div class="pv-nebula pv-nebula-a"></div>
  <div class="pv-nebula pv-nebula-b"></div>
  <div class="pv-nebula pv-nebula-c"></div>

  <div class="pv-shell">

    <div class="pv-progress-wrap">
      <div class="pv-progress-top">
        <span class="pv-progress-label" id="stepLabel">Paso 1 de 3 · Datos personales</span>
        <span class="pv-progress-pct" id="stepPct">33%</span>
      </div>
      <div class="pv-progress-track">
        <div class="pv-progress-fill" id="progressFill" style="width:33%"></div>
      </div>
    </div>

    <div class="pv-steps">
      <div class="pv-step active" id="step-ind-0"><span>1</span></div>
      <div class="pv-step-line"></div>
      <div class="pv-step" id="step-ind-1"><span>2</span></div>
      <div class="pv-step-line"></div>
      <div class="pv-step" id="step-ind-2"><span>3</span></div>
    </div>

    <div class="pv-card">

      @if(session('success'))
        <div class="pv-alert pv-alert-success">Perfil guardado correctamente.</div>
      @endif
      @if($errors->any())
        <div class="pv-alert pv-alert-error">
          <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
      @endif

      <form method="POST" action="{{ route('perfil-visual.store') }}" id="pvForm">
        @csrf

        <div class="pv-step-panel" id="panel-0">
          <div class="pv-section-badge">
            <span class="pv-section-dot"></span>
            Datos personales
          </div>
          <h2 class="pv-question">Cuéntanos sobre <em>ti</em></h2>
          <p class="pv-question-sub">Esta información nos ayuda a personalizar tus recomendaciones de lentes.</p>

          <div class="pv-grid-2">
            <div class="pv-input-wrap">
              <label>Edad</label>
              <input type="number" name="edad" min="1" max="120" placeholder="Ej: 24" value="{{ old('edad', $perfil->edad ?? '') }}" required>
            </div>
            <div class="pv-input-wrap">
              <label>Sexo</label>
              <select name="sexo" required>
                <option value="">Selecciona...</option>
                @foreach(['Masculino','Femenino','Otro'] as $op)
                  <option value="{{ $op }}" {{ old('sexo', $perfil->sexo ?? '') == $op ? 'selected':'' }}>{{ $op }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="pv-input-wrap">
            <label>Forma de tu rostro</label>
            <div class="pv-chip-grid">
              @foreach(['Redonda','Ovalada','Cuadrada','Alargada','Corazón','Diamante'] as $op)
                <div class="pv-chip">
                  <input type="radio" name="tipo_cara" id="cara_{{ $loop->index }}" value="{{ $op }}" {{ old('tipo_cara', $perfil->tipo_cara ?? '') == $op ? 'checked':'' }}>
                  <label for="cara_{{ $loop->index }}">{{ $op }}</label>
                </div>
              @endforeach
            </div>
          </div>
        </div>

        <div class="pv-step-panel" id="panel-1" style="display:none">
          <div class="pv-section-badge">
            <span class="pv-section-dot"></span>
            Salud Visual
          </div>
          <h2 class="pv-question">¿Cómo está tu <em>visión</em>?</h2>
          <p class="pv-question-sub">Sé honesto, esta información es solo para mejorar tus recomendaciones.</p>

          <div class="pv-input-wrap">
            <label>Problema visual diagnosticado</label>
            <div class="pv-chip-grid">
              @foreach(['Miopía','Hipermetropía','Astigmatismo','Presbicia','Ninguno','No lo sé'] as $op)
                <div class="pv-chip">
                  <input type="radio" name="problema_visual" id="pv_{{ $loop->index }}" value="{{ $op }}" {{ old('problema_visual', $perfil->problema_visual ?? '') == $op ? 'checked':'' }} required>
                  <label for="pv_{{ $loop->index }}">{{ $op }}</label>
                </div>
              @endforeach
            </div>
          </div>

          <div class="pv-input-wrap" style="margin-top:24px">
            <label>Síntomas visuales frecuentes</label>
            <div class="pv-chip-grid">
              @foreach(['Ninguno','Dolor de cabeza','Vista borrosa','Ojos secos','Ardor','Fatiga visual'] as $op)
                <div class="pv-chip">
                  <input type="radio" name="sintomas" id="sint_{{ $loop->index }}" value="{{ $op }}" {{ old('sintomas', $perfil->sintomas ?? '') == $op ? 'checked':'' }} required>
                  <label for="sint_{{ $loop->index }}">{{ $op }}</label>
                </div>
              @endforeach
            </div>
          </div>
        </div>

        <div class="pv-step-panel" id="panel-2" style="display:none">
          <div class="pv-section-badge">
            <span class="pv-section-dot"></span>
            Tu estilo
          </div>
          <h2 class="pv-question">¿Cuál es tu <em>estética</em>?</h2>
          <p class="pv-question-sub">Estos datos nos ayudan a recomendarte los lentes perfectos para ti.</p>

          <div class="pv-input-wrap">
            <label>Color de preferencia para tus lentes</label>
            <div class="pv-chip-grid">
              @foreach(['Negro','Café','Azul','Transparente','Dorado','Plateado'] as $op)
                <div class="pv-chip">
                  <input type="radio" name="color" id="color_{{ $loop->index }}" value="{{ $op }}" {{ old('color', $perfil->color ?? '') == $op ? 'checked':'' }} required>
                  <label for="color_{{ $loop->index }}">{{ $op }}</label>
                </div>
              @endforeach
            </div>
          </div>

          <div class="pv-input-wrap" style="margin-top:24px">
            <label>Estilo estético que prefieres</label>
            <div class="pv-chip-grid">
              @foreach(['Clásico','Moderno','Deportivo','Elegante','Minimalista'] as $op)
                <div class="pv-chip">
                  <input type="radio" name="estetica" id="est_{{ $loop->index }}" value="{{ $op }}" {{ old('estetica', $perfil->estetica ?? '') == $op ? 'checked':'' }} required>
                  <label for="est_{{ $loop->index }}">{{ $op }}</label>
                </div>
              @endforeach
            </div>
          </div>
        </div>

        <div class="pv-nav">
          <button type="button" class="pv-btn-prev" id="btnPrev" style="visibility:hidden" onclick="cambiarPaso(-1)">
            Anterior
          </button>
          <button type="button" class="pv-btn-next" id="btnNext" onclick="cambiarPaso(1)">
            Siguiente <span class="pv-btn-arrow">→</span>
          </button>
          <button type="submit" class="pv-btn-next" id="btnSubmit" style="display:none">
            Guardar perfil <span class="pv-btn-arrow">→</span>
          </button>
        </div>

      </form>
    </div>
  </div>
</div>
@endsection

@section('css')
@parent
<style>
:root{
  --nebula-deep:#0b0921;
  --nebula-plum:#1e1b4b;
  --violet:#7b4fcf;
  --lavender:#c084fc;
  --star:#f4f0ff;
}

/* ---------- Background ---------- */
.pv-cosmos{
  position:relative;
  min-height:100vh;
  padding:64px 1rem 80px;
  overflow:hidden;
  background:
    radial-gradient(ellipse 80% 60% at 50% -10%, rgba(123,79,207,0.25), transparent 60%),
    linear-gradient(180deg, var(--nebula-deep) 0%, var(--nebula-plum) 55%, var(--nebula-deep) 100%);
}
.pv-stars{
  position:absolute; inset:0;
  background-image:
    radial-gradient(1.5px 1.5px at 10% 20%, var(--star), transparent),
    radial-gradient(1px 1px at 80% 10%, var(--star), transparent),
    radial-gradient(1.5px 1.5px at 60% 70%, var(--star), transparent),
    radial-gradient(1px 1px at 30% 85%, var(--star), transparent),
    radial-gradient(1px 1px at 90% 60%, var(--star), transparent),
    radial-gradient(1.5px 1.5px at 45% 40%, var(--star), transparent),
    radial-gradient(1px 1px at 20% 55%, var(--star), transparent),
    radial-gradient(1.5px 1.5px at 70% 90%, var(--star), transparent);
  background-repeat:repeat;
  background-size:400px 400px;
  opacity:0.55;
  animation:pv-twinkle 6s ease-in-out infinite alternate;
}
@keyframes pv-twinkle{ from{opacity:0.35;} to{opacity:0.65;} }

.pv-nebula{
  position:absolute;
  border-radius:50%;
  filter:blur(70px);
  opacity:0.5;
  pointer-events:none;
}
.pv-nebula-a{ width:520px; height:520px; top:-160px; left:-140px; background:radial-gradient(circle, var(--violet), transparent 70%); animation:pv-drift-a 22s ease-in-out infinite; }
.pv-nebula-b{ width:420px; height:420px; bottom:-140px; right:-100px; background:radial-gradient(circle, var(--lavender), transparent 70%); animation:pv-drift-b 26s ease-in-out infinite; }
.pv-nebula-c{ width:300px; height:300px; top:35%; right:8%; background:radial-gradient(circle, #4c2b8f, transparent 70%); animation:pv-drift-c 30s ease-in-out infinite; opacity:0.35; }

@keyframes pv-drift-a{ 0%,100%{ transform:translate(0,0); } 50%{ transform:translate(40px,30px); } }
@keyframes pv-drift-b{ 0%,100%{ transform:translate(0,0); } 50%{ transform:translate(-30px,-40px); } }
@keyframes pv-drift-c{ 0%,100%{ transform:translate(0,0) scale(1); } 50%{ transform:translate(-20px,25px) scale(1.08); } }

@media (prefers-reduced-motion: reduce){
  .pv-stars, .pv-nebula-a, .pv-nebula-b, .pv-nebula-c{ animation:none; }
}

/* ---------- Shell / progress ---------- */
.pv-shell{ position:relative; z-index:1; max-width:640px; margin:0 auto; }

.pv-progress-wrap{ margin-bottom:20px; }
.pv-progress-top{ display:flex; justify-content:space-between; align-items:baseline; margin-bottom:8px; }
.pv-progress-label{ font-size:0.8rem; letter-spacing:.02em; color:rgba(255,255,255,0.75); }
.pv-progress-pct{ font-size:0.8rem; font-weight:600; color:var(--lavender); }
.pv-progress-track{ height:6px; border-radius:999px; background:rgba(255,255,255,0.08); overflow:hidden; }
.pv-progress-fill{ height:100%; border-radius:999px; background:linear-gradient(90deg, var(--violet), var(--lavender)); transition:width .4s ease; box-shadow:0 0 12px rgba(192,132,252,0.6); }

.pv-steps{ display:flex; align-items:center; justify-content:center; gap:8px; margin-bottom:28px; }
.pv-step{
  width:28px; height:28px; border-radius:50%;
  display:flex; align-items:center; justify-content:center;
  font-size:0.75rem; font-weight:600; color:rgba(255,255,255,0.5);
  background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.15);
  transition:all .3s ease;
}
.pv-step.active{ background:linear-gradient(135deg,var(--violet),var(--lavender)); color:#fff; border-color:transparent; box-shadow:0 0 14px rgba(192,132,252,0.55); }
.pv-step.done{ background:rgba(123,79,207,0.35); color:#fff; border-color:transparent; }
.pv-step-line{ width:36px; height:1px; background:rgba(255,255,255,0.15); }

/* ---------- Card ---------- */
.pv-card{
  background:rgba(255,255,255,0.05);
  border:1px solid rgba(255,255,255,0.12);
  border-radius:24px;
  padding:2.5rem 2.25rem;
  backdrop-filter:blur(18px);
  -webkit-backdrop-filter:blur(18px);
  box-shadow:0 20px 60px rgba(0,0,0,0.35), inset 0 1px 0 rgba(255,255,255,0.06);
}

.pv-alert{ padding:0.85rem 1.1rem; border-radius:12px; margin-bottom:1.5rem; font-size:0.9rem; }
.pv-alert-success{ background:rgba(52,211,153,0.15); border:1px solid rgba(52,211,153,0.4); color:#34d399; }
.pv-alert-error{ background:rgba(248,113,113,0.15); border:1px solid rgba(248,113,113,0.4); color:#f87171; }
.pv-alert-error ul{ margin:0; padding-left:1.1rem; }

.pv-section-badge{ display:inline-flex; align-items:center; gap:8px; font-size:0.75rem; letter-spacing:.08em; text-transform:uppercase; color:var(--lavender); margin-bottom:0.6rem; }
.pv-section-dot{ width:6px; height:6px; border-radius:50%; background:var(--lavender); box-shadow:0 0 8px var(--lavender); }

.pv-question{ font-family:'Playfair Display', serif; font-size:1.7rem; color:#fff; margin:0 0 0.35rem; }
.pv-question em{ font-style:italic; color:var(--lavender); }
.pv-question-sub{ font-size:0.9rem; color:rgba(255,255,255,0.6); margin:0 0 1.75rem; }

/* ---------- Inputs ---------- */
.pv-grid-2{ display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1.5rem; }
.pv-input-wrap label{ display:block; font-size:0.82rem; color:rgba(255,255,255,0.7); margin-bottom:0.45rem; }
.pv-input-wrap input[type="number"], .pv-input-wrap select{
  width:100%; padding:0.75rem 1rem; border-radius:12px;
  border:1px solid rgba(255,255,255,0.15); background:rgba(255,255,255,0.06);
  color:#fff; font-size:0.92rem; outline:none; transition:border .2s, background .2s;
  box-sizing:border-box; appearance:none;
}
.pv-input-wrap input[type="number"]:focus, .pv-input-wrap select:focus{ border-color:var(--violet); background:rgba(255,255,255,0.09); }
.pv-input-wrap select option{ background:var(--nebula-plum); color:#fff; }

/* Chip-style radio options */
.pv-chip-grid{ display:grid; grid-template-columns:repeat(auto-fit, minmax(130px,1fr)); gap:0.6rem; }
.pv-chip input{ position:absolute; opacity:0; width:0; height:0; }
.pv-chip label{
  display:flex; align-items:center; justify-content:center; text-align:center;
  padding:0.7rem 0.6rem; border-radius:12px; font-size:0.85rem;
  border:1px solid rgba(255,255,255,0.15); background:rgba(255,255,255,0.05);
  color:rgba(255,255,255,0.85); cursor:pointer; transition:all .2s ease;
}
.pv-chip label:hover{ border-color:rgba(192,132,252,0.5); background:rgba(255,255,255,0.08); }
.pv-chip input:checked + label{
  background:linear-gradient(135deg, var(--violet), var(--lavender));
  border-color:transparent; color:#fff; font-weight:600;
  box-shadow:0 6px 18px rgba(123,79,207,0.45);
}
.pv-chip input:focus-visible + label{ outline:2px solid var(--lavender); outline-offset:2px; }

/* ---------- Nav ---------- */
.pv-nav{ display:flex; justify-content:space-between; align-items:center; margin-top:2.25rem; }
.pv-btn-prev{
  background:transparent; border:1px solid rgba(255,255,255,0.2); color:rgba(255,255,255,0.8);
  padding:0.75rem 1.4rem; border-radius:12px; font-size:0.9rem; cursor:pointer; transition:all .2s;
}
.pv-btn-prev:hover{ border-color:rgba(255,255,255,0.4); background:rgba(255,255,255,0.05); }
.pv-btn-next{
  display:flex; align-items:center; gap:6px;
  background:linear-gradient(135deg,var(--violet),var(--lavender));
  border:none; color:#fff; padding:0.75rem 1.6rem; border-radius:12px;
  font-size:0.9rem; font-weight:600; cursor:pointer;
  box-shadow:0 8px 22px rgba(123,79,207,0.4); transition:transform .2s, box-shadow .2s;
  margin-left:auto;
}
.pv-btn-next:hover{ transform:translateY(-1px); box-shadow:0 10px 26px rgba(123,79,207,0.55); }
.pv-btn-arrow{ transition:transform .2s; }
.pv-btn-next:hover .pv-btn-arrow{ transform:translateX(3px); }

@media(max-width:600px){
  .pv-card{ padding:1.75rem 1.35rem; border-radius:18px; }
  .pv-grid-2{ grid-template-columns:1fr; }
  .pv-question{ font-size:1.4rem; }
}
</style>
@endsection

@section('scripts')
<script>
let paso = 0;
const totalPasos = 3;
const porcentajes = [33, 66, 100];
const labels = ['Paso 1 de 3 · Datos personales', 'Paso 2 de 3 · Salud Visual', 'Paso 3 de 3 · Tu estilo'];

// Como los pasos ocultos (display:none) quedan excluidos de la validación
// nativa del navegador, validamos manualmente antes de avanzar para que
// ningún campo pueda quedar sin responder.
function pvValidarPaso(idx) {
  const panel = document.getElementById('panel-' + idx);
  const campos = panel.querySelectorAll('[name]');
  const nombresVistos = new Set();

  for (const campo of campos) {
    const nombre = campo.name;
    if (nombresVistos.has(nombre)) continue;
    nombresVistos.add(nombre);

    if (campo.type === 'radio') {
      const marcado = panel.querySelector('input[name="' + nombre + '"]:checked');
      if (!marcado) {
        alert('Por favor selecciona una opción antes de continuar.');
        return false;
      }
    } else if (!campo.value || !campo.value.trim()) {
      alert('Por favor completa todos los campos antes de continuar.');
      campo.focus();
      return false;
    }
  }
  return true;
}

function cambiarPaso(dir) {
  if (dir > 0 && !pvValidarPaso(paso)) return;

  document.getElementById('panel-' + paso).style.display = 'none';
  document.getElementById('step-ind-' + paso).classList.remove('active');
  document.getElementById('step-ind-' + paso).classList.add('done');

  paso += dir;
  if (paso < 0) paso = 0;
  if (paso >= totalPasos) paso = totalPasos - 1;

  document.getElementById('panel-' + paso).style.display = 'block';
  document.getElementById('step-ind-' + paso).classList.remove('done');
  document.getElementById('step-ind-' + paso).classList.add('active');

  document.getElementById('progressFill').style.width = porcentajes[paso] + '%';
  document.getElementById('stepLabel').textContent = labels[paso];
  document.getElementById('stepPct').textContent = porcentajes[paso] + '%';

  document.getElementById('btnPrev').style.visibility = paso === 0 ? 'hidden' : 'visible';
  document.getElementById('btnNext').style.display    = paso === totalPasos - 1 ? 'none' : 'flex';
  document.getElementById('btnSubmit').style.display  = paso === totalPasos - 1 ? 'flex' : 'none';

  document.querySelector('.pv-shell').scrollIntoView({ behavior: 'smooth', block: 'start' });
}
</script>
@endsection