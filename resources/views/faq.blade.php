@extends('layouts.app')

@section('title', 'Preguntas Frecuentes — Nebula View')

@section('css')
<link rel="stylesheet" href="{{ asset('css/faq.css') }}">
@endsection

@section('content')

<section class="faq-intro">
  <div class="faq-intro__inner">
    <p class="faq-intro__eyebrow">Centro de ayuda</p>
    <h2 class="faq-intro__title">Resolvemos tus <em>dudas</em></h2>
    <p class="faq-intro__body">Todo lo que necesitas saber sobre Nebula View: qué es, qué ofrecemos, cómo funciona y cómo puede ayudarte a cuidar tu salud visual.</p>

    <div class="faq-intro__chips">
      <button class="chip chip--active" data-filter="all">Todas</button>
      <button class="chip" data-filter="pagina">La página</button>
      <button class="chip" data-filter="contenido">Contenido</button>
      <button class="chip" data-filter="uso">Uso</button>
    </div>
  </div>
</section>

<section class="faq-main">
  <div class="faq-main__inner">

    <div class="faq-col">

      <div class="faq-card" data-cat="pagina">
        <div class="faq-card__num">01</div>
        <button class="faq-card__question" aria-expanded="false">
          <span>¿Cuál es el objetivo de Nebula View?</span>
          <div class="faq-card__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
              <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
          </div>
        </button>
        <div class="faq-card__answer">
          <p>Nebula View es una plataforma educativa e informativa sobre salud visual. Nuestro objetivo es acercar a las personas información clara y confiable sobre problemas oculares, tipos de lentes y hábitos visuales saludables.</p>
          <span class="faq-card__tag">La página</span>
        </div>
      </div>

      <div class="faq-card" data-cat="contenido">
        <div class="faq-card__num">03</div>
        <button class="faq-card__question" aria-expanded="false">
          <span>¿Qué tipo de contenido puedo encontrar aquí?</span>
          <div class="faq-card__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
              <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
          </div>
        </button>
        <div class="faq-card__answer">
          <p>Encontrarás guías sobre problemas visuales como miopía, astigmatismo e hipermetropía; información sobre tipos de lentes ópticos y sus materiales; qué tipo de armazón se adecua mejor según el tipo de rostro y consejos de hábitos para cuidar tu vista a largo plazo.</p>
          <span class="faq-card__tag">Contenido</span>
        </div>
      </div>

      <div class="faq-card" data-cat="uso">
        <div class="faq-card__num">05</div>
        <button class="faq-card__question" aria-expanded="false">
          <span>¿Necesito crear una cuenta para usar la página?</span>
          <div class="faq-card__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
              <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
          </div>
        </button>
        <div class="faq-card__answer">
          <p>La mayor parte del contenido es de acceso libre. Sin embargo, al registrarte podrás acceder a herramientas como el test visual interactivo, recibir recomendaciones personalizadas según tu perfil ocular y acceder a la tienda.</p>
          <span class="faq-card__tag">Uso</span>
        </div>
      </div>

      <div class="faq-card" data-cat="uso">
        <div class="faq-card__num">07</div>
        <button class="faq-card__question" aria-expanded="false">
          <span>¿Qué es el test de diagnóstico visual con inteligencia artificial?</span>
          <div class="faq-card__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
              <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
          </div>
        </button>
        <div class="faq-card__answer">
          <p>Es una herramienta que, a partir de tus respuestas, genera un reporte orientativo sobre posibles problemas visuales y recomendaciones de cuidado. Incluye además el test de Ishihara para daltonismo. Ambos resultados quedan guardados en tu historial y puedes descargarlos en PDF.</p>
          <span class="faq-card__tag">Uso</span>
        </div>
      </div>

      <div class="faq-card" data-cat="uso">
        <div class="faq-card__num">09</div>
        <button class="faq-card__question" aria-expanded="false">
          <span>¿Mis resultados del test y mis datos personales están seguros?</span>
          <div class="faq-card__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
              <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
          </div>
        </button>
        <div class="faq-card__answer">
          <p>Sí. Tus resultados solo son visibles para ti y para el equipo administrativo cuando corresponda. Aplicamos buenas prácticas de seguridad como contraseñas robustas, cabeceras de seguridad y límites de intentos en las rutas sensibles.</p>
          <span class="faq-card__tag">Uso</span>
        </div>
      </div>

    </div>

    <div class="faq-col">

      <div class="faq-card" data-cat="pagina">
        <div class="faq-card__num">02</div>
        <button class="faq-card__question" aria-expanded="false">
          <span>¿La información de Nebula View es confiable?</span>
          <div class="faq-card__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
              <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
          </div>
        </button>
        <div class="faq-card__answer">
          <p>Sí. Todo el contenido de Nebula View es revisado y respaldado por profesionales de la salud visual. Nos apoyamos en fuentes médicas actualizadas y colaboramos con optometristas y oftalmólogos para garantizar información precisa y segura.</p>
          <span class="faq-card__tag">La página</span>
        </div>
      </div>

      <div class="faq-card" data-cat="contenido">
        <div class="faq-card__num">04</div>
        <button class="faq-card__question" aria-expanded="false">
          <span>¿Puedo usar Nebula View para diagnosticarme?</span>
          <div class="faq-card__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
              <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
          </div>
        </button>
        <div class="faq-card__answer">
          <p>Nebula View no reemplaza a un profesional de la salud. El contenido es de carácter informativo y educativo. Si presentas síntomas visuales, te recomendamos acudir a una clínica especializada.</p>
          <span class="faq-card__tag">Contenido</span>
        </div>
      </div>

      <div class="faq-card" data-cat="uso">
        <div class="faq-card__num">06</div>
        <button class="faq-card__question" aria-expanded="false">
          <span>¿Nebula View es gratuito?</span>
          <div class="faq-card__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
              <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
          </div>
        </button>
        <div class="faq-card__answer">
          <p>Sí, Nebula View es completamente gratuito. Todo el contenido informativo, guías, secciones de lentes, clínicas y herramientas como el test visual están disponibles sin costo. El registro es opcional y solo te permite acceder a funciones personalizadas adicionales.</p>
          <span class="faq-card__tag">Uso</span>
        </div>
      </div>

      <div class="faq-card" data-cat="contenido">
        <div class="faq-card__num">08</div>
        <button class="faq-card__question" aria-expanded="false">
          <span>¿Puedo probarme los lentes de forma virtual antes de comprarlos?</span>
          <div class="faq-card__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
              <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
          </div>
        </button>
        <div class="faq-card__answer">
          <p>Sí. En la sección de probador virtual puedes tomarte una foto y ver cómo te quedan distintos modelos de lentes en tiempo real, además de comparar armazones según la forma de tu rostro y compartir el resultado o descargarlo con un código QR.</p>
          <span class="faq-card__tag">Contenido</span>
        </div>
      </div>

      <div class="faq-card" data-cat="pagina">
        <div class="faq-card__num">10</div>
        <button class="faq-card__question" aria-expanded="false">
          <span>¿Cómo cambio el idioma o activo el modo oscuro?</span>
          <div class="faq-card__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
              <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
          </div>
        </button>
        <div class="faq-card__answer">
          <p>En la barra de navegación encontrarás el botón "ES/EN" para cambiar el idioma del sitio, y el interruptor de día/noche para alternar entre modo claro y oscuro. Tu preferencia se guarda automáticamente para tus próximas visitas.</p>
          <span class="faq-card__tag">La página</span>
        </div>
      </div>

    </div>
  </div>
</section>

<section class="contact-band">
  <div class="contact-band__orb contact-band__orb--1"></div>
  <div class="contact-band__orb contact-band__orb--2"></div>
  <div class="contact-band__inner">
    <div class="contact-band__text">
      <p class="contact-band__eyebrow">¿No encontraste tu respuesta?</p>
      <h2 class="contact-band__title">Hablemos <em>directamente</em></h2>
      <p class="contact-band__body">Nuestro equipo de especialistas está disponible para resolver cualquier duda sobre tu salud visual o los productos que ofrecemos.</p>
    </div>
    <div class="contact-band__actions">
      <a href="{{ route('contactanos') }}" class="contact-btn contact-btn--primary">Contáctanos ›</a>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script>
// Acordeón FAQ
document.querySelectorAll('.faq-card__question').forEach(btn => {
  btn.addEventListener('click', () => {
    const card = btn.closest('.faq-card');
    const isOpen = card.classList.contains('open');
    document.querySelectorAll('.faq-card').forEach(c => {
      c.classList.remove('open');
      c.querySelector('.faq-card__question').setAttribute('aria-expanded', 'false');
    });
    if (!isOpen) {
      card.classList.add('open');
      btn.setAttribute('aria-expanded', 'true');
    }
  });
});

// Chips de filtro
document.querySelectorAll('.chip').forEach(chip => {
  chip.addEventListener('click', () => {
    document.querySelectorAll('.chip').forEach(c => c.classList.remove('chip--active'));
    chip.classList.add('chip--active');
    const filter = chip.dataset.filter;
    document.querySelectorAll('.faq-card').forEach(card => {
      const cat = card.dataset.cat;
      card.classList.toggle('faq-card--hidden', filter !== 'all' && cat !== filter);
    });
  });
});
</script>
@endsection
