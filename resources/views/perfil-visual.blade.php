@extends('layouts.app')

@section('title', 'Perfil Visual - Nebula View')

@section('css')
<link rel="stylesheet" href="{{ asset('css/perfilvisual.css') }}">
@endsection

@section('content')
<div class="pv-shell">

  <div class="pv-progress-wrap">
    <div class="pv-progress-top">
      <span class="pv-progress-label" id="stepLabel">Paso 1 de 3</span>
      <span class="pv-progress-pct" id="stepPct">33%</span>
    </div>
    <div class="pv-progress-track">
      <div class="pv-progress-fill" id="progressFill" style="width:33%"></div>
    </div>
  </div>

  <div class="pv-steps" style="margin-bottom:24px;">
    <div class="pv-step active" id="step-ind-0"></div>
    <div class="pv-step" id="step-ind-1"></div>
    <div class="pv-step" id="step-ind-2"></div>
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
          <div class="pv-options">
            @foreach(['Redonda','Ovalada','Cuadrada','Alargada','Corazón','Diamante'] as $op)
              <div class="pv-option">
                <input type="radio" name="tipo_cara" id="cara_{{ $loop->index }}" value="{{ $op }}" {{ old('tipo_cara', $perfil->tipo_cara ?? '') == $op ? 'checked':'' }}>
                <label class="pv-option-label" for="cara_{{ $loop->index }}">
                  <span class="pv-radio-circle"></span>
                  {{ $op }}
                </label>
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
          <div class="pv-options">
            @foreach(['Miopía','Hipermetropía','Astigmatismo','Presbicia','Ninguno','No lo sé'] as $op)
              <div class="pv-option">
                <input type="radio" name="problema_visual" id="pv_{{ $loop->index }}" value="{{ $op }}" {{ old('problema_visual', $perfil->problema_visual ?? '') == $op ? 'checked':'' }}>
                <label class="pv-option-label" for="pv_{{ $loop->index }}">
                  <span class="pv-radio-circle"></span>
                  {{ $op }}
                </label>
              </div>
            @endforeach
          </div>
        </div>

        <div class="pv-input-wrap" style="margin-top:20px">
          <label>Sintomas visuales frecuentes</label>
          <div class="pv-options">
            @foreach(['Ninguno','Dolor de cabeza','Vista borrosa','Ojos secos','Ardor','Fatiga visual'] as $op)
              <div class="pv-option">
                <input type="radio" name="sintomas" id="sint_{{ $loop->index }}" value="{{ $op }}" {{ old('sintomas', $perfil->sintomas ?? '') == $op ? 'checked':'' }}>
                <label class="pv-option-label" for="sint_{{ $loop->index }}">
                  <span class="pv-radio-circle"></span>
                  {{ $op }}
                </label>
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
          <div class="pv-options">
            @foreach(['Negro','Café','Azul','Transparente','Dorado','Plateado'] as $op)
              <div class="pv-option">
                <input type="radio" name="color" id="color_{{ $loop->index }}" value="{{ $op }}" {{ old('color', $perfil->color ?? '') == $op ? 'checked':'' }}>
                <label class="pv-option-label" for="color_{{ $loop->index }}">
                  <span class="pv-radio-circle"></span>
                  {{ $op }}
                </label>
              </div>
            @endforeach
          </div>
        </div>

        <div class="pv-input-wrap" style="margin-top:20px">
          <label>Estilo estético que prefieres</label>
          <div class="pv-options">
            @foreach(['Clásico','Moderno','Deportivo','Elegante','Minimalista'] as $op)
              <div class="pv-option">
                <input type="radio" name="estetica" id="est_{{ $loop->index }}" value="{{ $op }}" {{ old('estetica', $perfil->estetica ?? '') == $op ? 'checked':'' }}>
                <label class="pv-option-label" for="est_{{ $loop->index }}">
                  <span class="pv-radio-circle"></span>
                  {{ $op }}
                </label>
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
          Siguiente <span class="pv-btn-arrow">-&gt;</span>
        </button>
        <button type="submit" class="pv-btn-next" id="btnSubmit" style="display:none">
          Guardar perfil <span class="pv-btn-arrow">-&gt;</span>
        </button>
      </div>

    </form>
  </div>
</div>
@endsection

@section('scripts')
<script>
let paso = 0;
const totalPasos = 3;
const porcentajes = [33, 66, 100];
const labels = ['Paso 1 de 3 - Datos personales', 'Paso 2 de 3 - Salud Visual', 'Paso 3 de 3 - Tu estilo'];

function cambiarPaso(dir) {
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

  window.scrollTo({ top: 0, behavior: 'smooth' });
}
</script>
@endsection