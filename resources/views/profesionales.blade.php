@extends('layouts.app')

@section('title', 'Profesionales — Nebula View')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profesionales.css') }}">
@endsection

@section('content')

<!-- HERO -->
<div class="page-hero">
  <div class="page-hero-bg"></div>
  <div class="hero-accent-rect"></div>
  <div class="page-hero-title">
    <h1>Profesionales</h1>
  </div>
</div>

<div class="page-content">

  <!-- Profesionales intro-->
  <div class="habitos-intro reveal">
    <div class="habitos-intro-text">
      <div class="section-kicker">Información</div>
      <h2>Profesionales en<br><em> salud visual</em></h2>
      <p>No sólo se deben utilizar gafas de sol en verano, en invierno el sol 
        se sitúa más bajo, incrementando considerablemente la exposición de nuestros 
        ojos a las radiaciones. El deslumbramiento que producen el hielo y la nieve hace que las gafas de sol sean un componente indispensable para usar a diario.</p>
      

      @include('partials.dato-curioso', [
        'icono' => '🔍',
        'datos' => [
          'Un examen visual completo no solo detecta problemas de la vista, sino que también puede revelar enfermedades generales como la diabetes antes de que presenten síntomas visibles.',
          'Un optometrista evalúa la refracción y salud general del ojo, mientras que un oftalmólogo es un médico especializado que también puede operar.',
          'Se recomienda una revisión visual anual, incluso sin síntomas, ya que muchas condiciones oculares avanzan sin dar señales de alerta.',
        ],
      ])
    </div>
    <div class="img-placeholder" style="min-height:360px;">
      <img src="{{ asset('images/profesionales.png') }}" alt="Profesionales" />
    </div>
  </div>

<!--Tarjetas movibles-->
<div class="cards-container">

    <!-- CARD 1: Oftalmólogos -->
    <div class="flip-card">
      <div class="flip-card-inner">
        <div class="flip-card-front">
          <div class="card-top-label">Oftalmólogos</div>
          <div class="card-image-area">
            <img src="{{ asset('images/oftamologos.png') }}" alt="Oftalmólogos"/>
          </div>
        </div>
        <div class="flip-card-back">
          <div class="back-title">Oftalmólogos</div>
          <div class="back-text">Los oftalmólogos son médicos especializados en el cuidado de los ojos y la salud visual. Se encargan de diagnosticar, tratar y prevenir enfermedades oculares, como cataratas, glaucoma, infecciones o problemas de la retina. A diferencia de otros profesionales de la visión, tienen formación médica completa, lo que les permite también realizar cirugías cuando es necesario.</div>
        </div>
      </div>
    </div>

    <!-- CARD 2: Optometristas -->
    <div class="flip-card">
      <div class="flip-card-inner">
        <div class="flip-card-front">
          <div class="card-top-label">Optometristas</div>
          <div class="card-image-area">
            <img src="{{ asset('images/optometristas.png') }}" alt="Optometristas"/>
          </div>
        </div>
        <div class="flip-card-back">
          <div class="back-title">Optometristas</div>
          <div class="back-text">Los optometristas son profesionales de la salud visual encargados de evaluar la calidad de la visión y detectar problemas como la miopía, hipermetropía o astigmatismo. Realizan exámenes visuales, prescriben lentes correctivos y brindan orientación sobre el cuidado de los ojos, 
            ayudando a prevenir molestias visuales y mejorar el rendimiento en las actividades diarias.</div>
        </div>
      </div>
    </div>

    <!-- CARD 3: Ópticos -->
    <div class="flip-card">
      <div class="flip-card-inner">
        <div class="flip-card-front">
          <div class="card-top-label">Ópticos</div>
          <div class="card-image-area">
            <img src="{{ asset('images/image') }} 120.png" alt="Ópticos"/>
          </div>
        </div>
        <div class="flip-card-back">
          <div class="back-title">Ópticos</div>
          <div class="back-text">Los ópticos se encargan de la elaboración, adaptación y ajuste de lentes oftálmicos y de contacto según la prescripción indicada. Su labor es fundamental para asegurar que las 
            personas reciban una corrección visual adecuada y cómoda, contribuyendo así a una mejor calidad de vida.</div>
        </div>
      </div>
    </div>

  </div>

  <!--Carrusel profesionales-->
  
<div class="ps-wrap">

 <h2 class="ps-title">Profesionales <em>en El Salvador</em></h2>
  <p class="ps-intro">
    En El Salvador contamos con profesionales de la salud visual altamente capacitados, dedicados a brindar atención de calidad en diagnóstico, tratamiento y corrección de problemas oculares. Cada especialista aporta su experiencia para mejorar la calidad de vida de los pacientes a través de un enfoque personalizado y el uso de tecnología moderna.
  </p>

  <!-- ══ SLIDE 1 ══ -->
  <div class="carousel-card active" id="slide-1">
    <div class="doc-left">
      <img src="{{ asset('images/Lourdes') }} amato.png" alt="Dra. Lourdes Amato"/>
      <div class="doc-info-box">
        <div class="doc-name">Dra. Lourdes Amato</div>
        <div class="doc-desc">Cirujana oftalmóloga especializada en miopía y defectos refractivos.</div>
      </div>
      <button class="btn-contacto">Contacto</button>
    </div>
    <div class="doc-right">
      <h3>Cirujano Oftalmólogo Miopía</h3>
      <p>Un cirujano oftalmólogo especializado en miopía puede evaluar el estado de la visión y determinar las mejores opciones de tratamiento para cada paciente. A través de un diagnóstico adecuado es posible mejorar la calidad visual y facilitar la realización de actividades diarias que requieren buena visión a distancia.</p>
      <p>Recibir atención con un cirujano oftalmólogo especializado en miopía permite obtener un diagnóstico preciso y elegir el tratamiento más adecuado para mejorar la visión. Un seguimiento médico adecuado contribuye a mantener una buena salud visual y prevenir complicaciones asociadas con problemas de refracción.</p>
    </div>
  </div>

  <!-- ══ SLIDE 2 ══ -->
  <div class="carousel-card" id="slide-2">
    <div class="doc-left">
    
      <img src="{{ asset('images/licKaren.jpg') }}" alt="KAREN AVALOS"/>
      <div class="doc-info-box">
        <div class="doc-name">Licda. Karen Ávalos</div>
        <div class="doc-desc">Especializada en el area de la optometría.</div>
      </div>
      <button class="btn-contacto">Contacto</button>
    </div>
    <div class="doc-right">
      <h3>Optometrista </h3>
      <p>Dentro de este centro, su labor se enfoca en la evaluación optométrica de los pacientes, lo que incluye la detección de problemas visuales, la medición de la visión y el apoyo en la corrección de defectos refractivos como la miopía o el astigmatismo. Este tipo de atención es 
        clave para prevenir complicaciones visuales y mejorar la calidad de vida de las personas.</p>
      <p>Aunque no hay mucha información pública detallada sobre su trayectoria personal, se sabe que trabaja junto a un equipo de especialistas en oftalmología y otros profesionales de la salud visual, contribuyendo a brindar un servicio integral que abarca diagnóstico, prevención y tratamiento de enfermedades oculares.</p>
    </div>
  </div>

  <!-- ══ SLIDE 3 ══ -->
  <div class="carousel-card" id="slide-3">
    <div class="doc-left">
   
      <img src="{{ asset('images/salvador') }} mena.jpg" alt="salvador mena"/>
      <div class="doc-info-box">
        <div class="doc-name">Dr. Salvador Mena</div>
        <div class="doc-desc">reconocido oftalmólogo en El Salvador.</div>
      </div>
      <button class="btn-contacto">Contacto</button>
    </div>
    <div class="doc-right">
      <h3>Oftalmólogo</h3>
      <p>Es un oftalmólogo salvadoreño reconocido por su especialización en enfermedades de la retina, el vítreo y la mácula, que son partes internas del ojo muy importantes para la visión. Trabaja en el Centro de Diabetes Ocular, donde atiende a pacientes con problemas visuales complejos, especialmente relacionados con la diabetes y otras enfermedades oculares avanzadas.</p>
      <p>En su trabajo clínico, se enfoca en diagnosticar y tratar problemas graves de la retina, incluyendo el uso de láser, cirugías y tratamientos como inyecciones intraoculares. Este tipo de atención es clave, ya que muchas de estas enfermedades pueden causar pérdida de visión o ceguera si no se tratan a tiempo.</p>
    </div>
  </div>

  <!-- ══ SLIDE 4 ══ -->
  <div class="carousel-card" id="slide-4">
    <div class="doc-left">
     
      <img src="{{ asset('images/opticosFudem.jpg') }}" alt="ópticos"/>
      <div class="doc-info-box">
        <div class="doc-name">Ópticos</div>
        <div class="doc-desc">Especializados en la elaboración, adaptación y ajuste de lentes oftálmicos y de contacto</div>
      </div>
    </div>
    <div class="doc-right">
      <h3>Óptico Especializado</h3>
      <p>Un ejemplo representativo es el personal óptico que trabaja en instituciones como Fundación para el Desarrollo Integral de los Trabajadores de la Vista (FUDEM), donde se encargan de fabricar lentes con precisión, tomar medidas como la distancia pupilar y orientar a los pacientes sobre el uso correcto de sus gafas. Además, ayudan a elegir los materiales y tipos de lentes más adecuados según las necesidades de cada persona.</p>
      <p>La labor de los ópticos va más allá de solo entregar lentes, ya que también brindan asesoría para el cuidado de los mismos y realizan ajustes cuando es necesario. Gracias a su trabajo, muchas personas pueden mejorar su visión y realizar sus actividades diarias con mayor seguridad y comodidad, lo que los convierte en una parte fundamental del equipo de salud visual.</p>
    </div>
  </div>

  <!-- ══ CONTROLES ══ -->
  <div class="carousel-controls">
    <button class="arrow-btn" onclick="changeSlide(-1)">&#8592;</button>
    <div class="dots">
      <button class="dot active" onclick="goTo(0)"></button>
      <button class="dot" onclick="goTo(1)"></button>
      <button class="dot" onclick="goTo(2)"></button>
      <button class="dot" onclick="goTo(3)"></button>
    </div>
    <button class="arrow-btn" onclick="changeSlide(1)">&#8594;</button>
  </div>

</div>

<script>
  var cur = 0, total = 4;

  function goTo(i) {
    document.getElementById('slide-' + (cur + 1)).classList.remove('active');
    document.querySelectorAll('.dot')[cur].classList.remove('active');
    cur = i;
    document.getElementById('slide-' + (cur + 1)).classList.add('active');
    document.querySelectorAll('.dot')[cur].classList.add('active');
  }

  function changeSlide(d) {
    goTo((cur + d + total) % total);
  }
</script>

<!--Recomendaciones para examenes de la vista-->
<div class="contenedor">
  <h2 class="ps-title">Recomendaciones para exámenes visuales</h2>
  <p class="ps-intro" style="text-align:center;margin-bottom:32px;">
    Toca cada paso para conocer cómo prepararte de la mejor manera para tu próxima cita.
  </p>

  <div class="reco-accordion">

    <details class="reco-item" open>
      <summary>
        <span class="reco-num">01</span>
        <span class="reco-head">
          <span class="reco-icon"><svg class="custom-icon" aria-hidden="true"><use href="#icon-portapapeles"></use></svg></span>
          Preparación previa
        </span>
        <span class="reco-toggle">+</span>
      </summary>
      <div class="reco-body">
        Lleve una lista de sus medicamentos actuales, antecedentes familiares de enfermedades oculares y, si usa lentes de contacto, acuda con sus gafas para la evaluación.
      </div>
    </details>

    <details class="reco-item">
      <summary>
        <span class="reco-num">02</span>
        <span class="reco-head">
          <span class="reco-icon"><svg class="custom-icon" aria-hidden="true"><use href="#icon-ojo"></use></svg></span>
          Antes de la cita
        </span>
        <span class="reco-toggle">+</span>
      </summary>
      <div class="reco-body">
        Suspenda el uso de lentes de contacto (blandos 4 días, rígidos 8 días) antes de la cita para no alterar la forma de la córnea.
      </div>
    </details>

    <details class="reco-item">
      <summary>
        <span class="reco-num">03</span>
        <span class="reco-head">
          <span class="reco-icon"><svg class="custom-icon" aria-hidden="true"><use href="#icon-sol"></use></svg></span>
          Protección ese mismo día
        </span>
        <span class="reco-toggle">+</span>
      </summary>
      <div class="reco-body">
        Algunos exámenes dilatan la pupila, lo que aumenta la sensibilidad a la luz. Lleve gafas de sol y, si es posible, evite manejar inmediatamente después de la cita.
      </div>
    </details>

    <details class="reco-item">
      <summary>
        <span class="reco-num">04</span>
        <span class="reco-head">
          <span class="reco-icon"><svg class="custom-icon" aria-hidden="true"><use href="#icon-nota"></use></svg></span>
          Anote sus síntomas
        </span>
        <span class="reco-toggle">+</span>
      </summary>
      <div class="reco-body">
        Apunte molestias recientes (visión borrosa, dolor de cabeza, fatiga ocular) y desde cuándo las presenta. Esto ayuda al especialista a enfocar el diagnóstico.
      </div>
    </details>

    <details class="reco-item">
      <summary>
        <span class="reco-num">05</span>
        <span class="reco-head">
          <span class="reco-icon">⏰</span>
          Frecuencia recomendada
        </span>
        <span class="reco-toggle">+</span>
      </summary>
      <div class="reco-body">
        Adultos sin problemas visuales: cada 1-2 años. Niños, adultos mayores o personas con diabetes/hipertensión: al menos una vez al año o según indicación médica.
      </div>
    </details>

  </div>
</div>

</div>
<!-- FOOTER -->





@include('partials.comentarios', ['pagina' => 'profesionales'])
@endsection

@section('scripts')
<script>
  // NAV scroll
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => navbar.classList.toggle('scrolled', scrollY > 30));

// REVEAL
const revealEls = document.querySelectorAll('.reveal');
const obs = new IntersectionObserver(entries => {
  entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: 0.1 });
revealEls.forEach(el => obs.observe(el));

// HAMBURGER
const hamBtn = document.getElementById('hamBtn');
const mobileMenu = document.getElementById('mobileMenu');
const menuBackdrop = document.getElementById('menuBackdrop');
const drawerCloseBtn = document.getElementById('drawerClose');
function openMenu()  { mobileMenu.classList.add('open');    hamBtn.classList.add('open');    document.body.style.overflow = 'hidden'; }
function closeMenu() { mobileMenu.classList.remove('open'); hamBtn.classList.remove('open'); document.body.style.overflow = ''; }
hamBtn.addEventListener('click', () => mobileMenu.classList.contains('open') ? closeMenu() : openMenu());
drawerCloseBtn.addEventListener('click', closeMenu);
menuBackdrop.addEventListener('click', closeMenu);
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeMenu(); });
</script>
@endsection