
@extends('layouts.app')

@section('title', 'Clínicas — Nebula View')

@section('css')
<link rel="stylesheet" href="{{ asset('css/clinicas.css') }}">
@endsection

@section('content')

<!-- HERO -->
<div class="page-hero">
  <div class="page-hero-bg"></div>
  <div class="hero-accent-rect"></div>
  <div class="page-hero-title">
    <h1>Clínicas</h1>
    <div class="breadcrumb"><a>Encuentra la clínica de salud visual ideal para ti</a></div>
  </div>
</div>

<!-- INFORMACIÓN -->
<section class="info reveal" id="inicio">
  <div class="info__inner">
    <div class="info__text">
      <div class="section-kicker">Información</div>
      <h2 class="info__title">¿Qué es una<br/><em>clínica de salud visual?</em></h2>
      <p class="info__body">Una clínica de salud visual es un centro médico especializado en el diagnóstico, tratamiento y seguimiento de enfermedades y defectos del sistema ocular. Cuenta con oftalmólogos, optometristas y tecnología de vanguardia para brindar atención integral a pacientes de todas las edades.</p>
    </div>
    <div class="info__image img-placeholder" style="min-height:360px;">
      <img src="{{ asset('images/clinicaa.avif') }}" alt="Clínica de salud visual" />
    </div>
  </div>
</section>

<!-- CARACTERÍSTICAS / PILARES -->
<section class="causas">
  <h2 class="section-title" style="color:#fff;">¿Qué ofrece una buena clínica?</h2>
  <div class="causas__grid">
    <div class="causa-card">
      <div class="causa-card__icon" style="color:#fff"><svg class="hand-icon" style="width:1em;height:1em"><use href="#icon-hospital"></use></svg></div>
      <h3>Infraestructura moderna</h3>
      <p>Instalaciones equipadas con tecnología de punta para diagnóstico y cirugía ocular.</p>
    </div>
    <div class="causa-card">
      <div class="causa-card__icon" style="color:#fff"><svg class="hand-icon" style="width:1em;height:1em"><use href="#icon-cruz-medica"></use></svg></div>
      <h3>Especialistas certificados</h3>
      <p>Oftalmólogos y optometristas con formación continua y acreditaciones internacionales.</p>
    </div>
    <div class="causa-card">
      <div class="causa-card__icon" style="color:#fff"><svg class="custom-icon" aria-hidden="true"><use href="#icon-telescopio"></use></svg></div>
      <h3>Equipos de diagnóstico</h3>
      <p>Tomografías OCT, topografías corneales, campimetrías y más para un diagnóstico preciso.</p>
    </div>
    <div class="causa-card">
      <div class="causa-card__icon" style="color:#fff"><svg class="custom-icon" aria-hidden="true"><use href="#icon-portapapeles"></use></svg></div>
      <h3>Seguimiento personalizado</h3>
      <p>Historial clínico digital y planes de tratamiento adaptados a cada paciente.</p>
    </div>
  </div>
</section>

<!-- TIPOS DE CLÍNICAS -->
<section class="enfermedades" id="clinicas">
  <p class="section-eyebrow">Tipos de centros especializados</p>
  <h2 class="section-title">Clínicas más comunes</h2>
  <div class="enfermedad-list">

    <div class="enfermedad-card enfermedad-card--terra">
      <div class="enfermedad-card__left">
        <span class="enfermedad-card__tag">Atención general</span>
        <h3 class="enfermedad-card__name">Clínica Optométrica</h3>
        <p class="enfermedad-card__desc">Enfocada en la corrección de defectos refractivos como miopía, hipermetropía y astigmatismo mediante lentes o lentes de contacto. Ideal para revisiones anuales preventivas.</p>
      </div>
      <div class="enfermedad-card__right">
        <div class="enfermedad-card__eye enfermedad-card__eye--far"></div>
      </div>
    </div>

    <div class="enfermedad-card enfermedad-card--navy">
      <div class="enfermedad-card__left">
        <span class="enfermedad-card__tag">Cirugía avanzada</span>
        <h3 class="enfermedad-card__name">Clínica Oftalmológica</h3>
        <p class="enfermedad-card__desc">Centro médico con quirófanos especializados para procedimientos como LASIK, extracción de cataratas e implante de lente intraocular. Requiere médicos especialistas.</p>
      </div>
      <div class="enfermedad-card__right">
        <div class="enfermedad-card__eye enfermedad-card__eye--near"></div>
      </div>
    </div>

    <div class="enfermedad-card enfermedad-card--sage">
      <div class="enfermedad-card__left">
        <span class="enfermedad-card__tag">Enfoque preventivo</span>
        <h3 class="enfermedad-card__name">Clínica Pediátrica Visual</h3>
        <p class="enfermedad-card__desc">Especializada en la detección temprana de problemas visuales en niños: ambliopía, estrabismo y defectos refractivos en etapas escolares. La prevención es fundamental.</p>
      </div>
      <div class="enfermedad-card__right">
        <div class="enfermedad-card__eye enfermedad-card__eye--hyper"></div>
      </div>
    </div>

    <div class="enfermedad-card enfermedad-card--plum">
      <div class="enfermedad-card__left">
        <span class="enfermedad-card__tag">Alta tecnología</span>
        <h3 class="enfermedad-card__name">Clínica de Retina y Glaucoma</h3>
        <p class="enfermedad-card__desc">Centro de subespecialidad que atiende enfermedades crónicas como el glaucoma, la retinopatía diabética y la degeneración macular. Tratamiento con láser e inyecciones intravítreas.</p>
      </div>
      <div class="enfermedad-card__right">
        <div class="enfermedad-card__eye enfermedad-card__eye--astig"></div>
      </div>
    </div>

  </div>
</section>

<!-- SERVICIOS -->
<section class="info-cards" id="servicios">
  <div class="info-card">
    <div class="info-card__icon" style="color:#fff"><svg class="custom-icon" aria-hidden="true"><use href="#icon-microscopio"></use></svg></div>
    <h3>Examen visual completo</h3>
    <p>Evaluación de la agudeza visual, presión intraocular, fondo de ojo y salud corneal. Duración aproximada de 45 minutos con tecnología de diagnóstico avanzado.</p>
  </div>
  <div class="info-card">
    <div class="info-card__icon" style="color:#fff"><svg class="hand-icon" style="width:1em;height:1em"><use href="#icon-rayo"></use></svg> </div>
    <h3>Cirugía refractiva LASIK</h3>
    <p>Procedimiento con láser excimer para eliminar la dependencia de gafas o lentes de contacto en pacientes con miopía, hipermetropía o astigmatismo.</p>
  </div>
  <div class="info-card">
    <div class="info-card__icon" style="color:#fff"><svg class="hand-icon" style="width:1em;height:1em"><use href="#icon-calendario"></use></svg></div>
    <h3>Consultas de seguimiento</h3>
    <p>Citas periódicas para monitorear enfermedades crónicas, ajustar tratamientos y garantizar que la salud visual se mantenga en óptimas condiciones.</p>
  </div>
</section>

<!-- FAQ -->
<section class="faq">
  <h2 class="section-title">Preguntas frecuentes</h2>
  <div style="width:48px;height:3px;background:var(--plum);border-radius:2px;margin:0.5rem auto 2.5rem;"></div>
  <div class="faq-list" style="margin: 0 auto;">
    <div class="faq-item">
      <button class="faq-question">
        ¿Con qué frecuencia debo visitar una clínica visual?
        <span class="faq-icon">+</span>
      </button>
      <div class="faq-answer">Se recomienda una revisión anual para adultos sin condiciones previas. Personas con miopía progresiva, diabetes o antecedentes familiares de glaucoma deben acudir cada 6 meses o según indicación médica.</div>
    </div>
    <div class="faq-item">
      <button class="faq-question">
        ¿Cuál es la diferencia entre un optometrista y un oftalmólogo?
        <span class="faq-icon">+</span>
      </button>
      <div class="faq-answer">El optometrista es un profesional de la salud visual que gradúa lentes y detecta problemas refractivos. El oftalmólogo es un médico especialista que puede diagnosticar enfermedades oculares, prescribir medicamentos y realizar cirugías.</div>
    </div>
    <div class="faq-item">
      <button class="faq-question">
        ¿A partir de qué edad se recomienda la cirugía LASIK?
        <span class="faq-icon">+</span>
      </button>
      <div class="faq-answer">Generalmente se recomienda a partir de los 21 años, cuando la prescripción óptica se haya estabilizado durante al menos dos años. El candidato ideal no debe tener condiciones como queratocono o córnea muy delgada.</div>
    </div>
    <div class="faq-item">
      <button class="faq-question">
        ¿Las clínicas pediátricas atienden a adultos también?
        <span class="faq-icon">+</span>
      </button>
      <div class="faq-answer">Las clínicas pediátricas visuales están especializadas en menores de 18 años. Sin embargo, algunos centros ofrecen atención mixta. Para adultos, lo ideal es acudir a una clínica optométrica u oftalmológica general.</div>
    </div>
  </div>
</section>

<!-- EYE VISUAL SECTION -->
<section class="eye-section" id="eye-visual">
  <div class="eye-caption">
    <h3>El ojo humano, en detalle</h3>
    <p>Mueve el cursor sobre el ojo y observa cómo reacciona — igual que el tuyo ante la luz.</p>
  </div>

  <div class="eye-wrap" id="eyeWrap">
    <div class="eye-ring eye-ring--1"></div>
    <div class="eye-ring eye-ring--2"></div>
    <div class="eye-ring eye-ring--3"></div>
    <div class="eye-lid-wrap">
      <div class="eye-white" id="eyeWhite">
        <div class="eye-iris" id="eyeIris">
          <div class="eye-shine"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="eye-labels">
    <div class="eye-label">
      <div class="eye-label__dot"></div>
      <span>Iris</span>
    </div>
    <div class="eye-label">
      <div class="eye-label__dot eye-label__dot--pink"></div>
      <span>Pupila</span>
    </div>
    <div class="eye-label">
      <div class="eye-label__dot eye-label__dot--lav"></div>
      <span>Esclerótica</span>
    </div>
  </div>
</section>



@include('partials.comentarios', ['pagina' => 'clinicas'])
@endsection

@section('scripts')
<script>
// Eye tracking
const eyeWrap = document.getElementById('eyeWrap');
const eyeIris = document.getElementById('eyeIris');
document.addEventListener('mousemove', (e) => {
  if (!eyeWrap || !eyeIris) return;
  const rect = eyeWrap.getBoundingClientRect();
  const cx = rect.left + rect.width / 2;
  const cy = rect.top + rect.height / 2;
  const dx = e.clientX - cx;
  const dy = e.clientY - cy;
  const dist = Math.sqrt(dx*dx + dy*dy);
  const maxMove = 14;
  const ratio = Math.min(dist, 120) / 120;
  const mx = (dx / dist || 0) * ratio * maxMove;
  const my = (dy / dist || 0) * ratio * maxMove;
  eyeIris.style.transform = `translate(calc(-50% + ${mx}px), calc(-50% + ${my}px))`;
});

// FAQ accordion
document.querySelectorAll('.faq-question').forEach(btn => {
  btn.addEventListener('click', () => {
    const item = btn.closest('.faq-item');
    const isOpen = item.classList.contains('open');
    document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('open'));
    if (!isOpen) item.classList.add('open');
  });
});
</script>
@endsection