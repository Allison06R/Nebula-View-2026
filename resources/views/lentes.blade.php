@extends('layouts.app')

@section('title', 'Lentes Ópticos — Nebula View')

@section('css')
<link rel="stylesheet" href="{{ asset('css/lentes.css') }}">
@endsection

@section('content')

  <!-- HERO -->
  <div class="page-hero">
    <div class="page-hero-bg"></div>
    <div class="hero-accent-rect"></div>
    <div class="page-hero-title">
      <h1>Lentes</h1>
      <div class="breadcrumb"><a>Conoce los tipos de lentes y encuentra el ideal para tu visión</a></div>
    </div>
  </div>

  <!-- INTRO -->
  <section class="intro reveal" id="inicio">
    <div class="intro__text">
      <div class="intro__kicker">INFORMACIÓN</div>
      <h2 class="intro__title">¿Qué son los<br/><em>lentes ópticos?</em></h2>
      <p class="intro__body">Los lentes ópticos son dispositivos diseñados para corregir defectos refractivos del ojo —miopía, hipermetropía, astigmatismo y presbicia— redirigiendo los rayos de luz para que se enfoquen con precisión en la retina. Fabricados en materiales de alta tecnología como policarbonato, trivex o cristal mineral, devuelven nitidez y calidad a la visión cotidiana.</p>
    </div>
    <div class="intro__visual">
      <div class="intro__img-wrap">
        <img src="{{ asset('images/lentess.jpg') }}" alt="Lentes ópticos" />
      </div>
      <div class="intro__badge">
        <strong>4+</strong>tipos de lente<br>para cada necesidad
      </div>
    </div>
  </section>

  <!-- PILARES -->
  <section class="pilares" id="pilares">
    <div class="pilares__head">
      <h2 class="section-title">¿Qué hace a un buen lente?</h2>
    </div>
    <div class="pilares__row">
      <div class="pilar">
        <div class="pilar__num">🔬</div>
        <h3>Material</h3>
        <p>Policarbonato, trivex o cristal: resistencia, ligereza y claridad óptica distintas según el uso.</p>
      </div>
      <div class="pilar">
        <div class="pilar__num">✨</div>
        <h3>Tratamientos</h3>
        <p>Antirreflejo, anti-UV y anti-luz azul: capas que protegen tanto la lente como tus ojos.</p>
      </div>
      <div class="pilar">
        <div class="pilar__num">📐</div>
        <h3>Graduación</h3>
        <p>Una prescripción precisa y actualizada es la base de cualquier lente de calidad.</p>
      </div>
      <div class="pilar">
        <div class="pilar__num">🕶️</div>
        <h3>Montura</h3>
        <p>El centrado pupilar y el tamaño del armazón influyen directamente en la comodidad diaria.</p>
      </div>
    </div>
  </section>

  <!-- TIPOS DE LENTES -->
  <section class="tipos" id="tipos">
    <div class="tipos__head">
      <p class="section-eyebrow">Variedades más utilizadas</p>
      <h2 class="section-title">Tipos de lentes ópticos</h2>
    </div>
    <div class="tipos__grid">

      <div class="tipo-card tipo-card--a">
        <div class="tipo-card__accent"></div>
        <span class="tipo-card__tag">Corrección básica</span>
        <h3 class="tipo-card__name">Lentes Monofocales</h3>
        <p class="tipo-card__desc">Una sola graduación en toda la superficie, ideal para corregir miopía, hipermetropía o astigmatismo. Son los más comunes y los más fáciles de adaptar para cualquier edad.</p>
        <div class="tipo-card__icon"></div>
      </div>

      <div class="tipo-card tipo-card--b">
        <div class="tipo-card__accent"></div>
        <span class="tipo-card__tag">Doble zona óptica</span>
        <h3 class="tipo-card__name">Lentes Bifocales</h3>
        <p class="tipo-card__desc">Dividen la lente en dos zonas: la superior para visión lejana y la inferior para lectura cercana. Son la solución clásica para la presbicia, con una línea visible que separa ambas zonas.</p>
        <div class="tipo-card__icon"></div>
      </div>

      <div class="tipo-card tipo-card--c">
        <div class="tipo-card__accent"></div>
        <span class="tipo-card__tag">Transición continua</span>
        <h3 class="tipo-card__name">Lentes Progresivos</h3>
        <p class="tipo-card__desc">Transición gradual entre visión lejana, intermedia y cercana, sin línea divisoria visible. Experiencia más natural y estética, aunque requieren un período de adaptación.</p>
        <div class="tipo-card__icon"></div>
      </div>

      <div class="tipo-card tipo-card--d">
        <div class="tipo-card__accent"></div>
        <span class="tipo-card__tag">Sin montura</span>
        <h3 class="tipo-card__name">Lentes de Contacto</h3>
        <p class="tipo-card__desc">Se colocan directamente sobre la córnea, corrigiendo la visión sin armazón. Disponibles en versiones diarias, quincenales o mensuales, en materiales blandos o rígidos.</p>
        <div class="tipo-card__icon"></div>
      </div>

    </div>
  </section>

  <!-- TRATAMIENTOS -->
  <section class="tratamientos" id="tratamientos">
    <div class="tratamientos__head">
      <p class="section-eyebrow">Protección adicional</p>
      <h2 class="section-title" style="color:white;">Tratamientos para tus lentes</h2>
    </div>
    <div class="tratamientos__list">
      <div class="trat-item">
        <div class="trat-item__num">01</div>
        <div class="trat-item__body">
          <div class="trat-item__name"><span>🛡️</span> Antirreflejo</div>
          <p class="trat-item__desc">Elimina los reflejos de luz artificial y solar sobre la lente, mejorando la comodidad visual en pantallas, conducción nocturna y ambientes de iluminación intensa. Resulta especialmente útil para quienes pasan muchas horas frente a monitores.</p>
        </div>
      </div>
      <div class="trat-item">
        <div class="trat-item__num">02</div>
        <div class="trat-item__body">
          <div class="trat-item__name"><span>☀️</span> Filtro UV y luz azul</div>
          <p class="trat-item__desc">Bloquea la radiación ultravioleta y filtra la luz azul emitida por dispositivos digitales, protegiendo la retina del daño acumulado a largo plazo. Recomendado especialmente para menores de edad y usuarios de pantallas más de 4 horas al día.</p>
        </div>
      </div>
      <div class="trat-item">
        <div class="trat-item__num">03</div>
        <div class="trat-item__body">
          <div class="trat-item__name"><span>🌗</span> Fotocromáticas</div>
          <p class="trat-item__desc">Se oscurecen automáticamente al recibir luz solar y recuperan su transparencia en interiores. Una sola lente cumple la función de lente graduada y gafa solar, adaptándose en segundos a distintos entornos de iluminación.</p>
        </div>
      </div>
      <div class="trat-item">
        <div class="trat-item__num">04</div>
        <div class="trat-item__body">
          <div class="trat-item__name"><span>💎</span> Endurecido y antirayado</div>
          <p class="trat-item__desc">Capa de recubrimiento que aumenta la dureza superficial de la lente, reduciendo la formación de rayaduras por uso cotidiano. Prolonga la vida útil del lente y mantiene la calidad óptica a lo largo del tiempo.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section class="faq" id="faq">
    <div class="faq__inner">
      <div class="faq__sidebar">
        <h2 class="faq__sidebar-title">Preguntas <em>frecuentes</em></h2>
        <div class="faq__sidebar-bar"></div>
        <p>Todo lo que debes saber antes de elegir tus próximos lentes ópticos, respondido de forma clara.</p>
      </div>
      <div class="faq-list">
        <div class="faq-item">
          <button class="faq-question" type="button">
            ¿Cada cuánto tiempo debo cambiar mis lentes?
            <span class="faq-icon">+</span>
          </button>
          <div class="faq-answer">Se recomienda revisar la graduación anualmente. Si la prescripción no cambia, los lentes pueden durar hasta 2 años; sin embargo, el deterioro del material o las rayaduras en la lente pueden justificar un cambio antes de ese plazo.</div>
        </div>
        <div class="faq-item">
          <button class="faq-question" type="button">
            ¿Los lentes progresivos son difíciles de usar?
            <span class="faq-icon">+</span>
          </button>
          <div class="faq-answer">Requieren un período de adaptación de entre 1 y 4 semanas. Durante ese tiempo el cerebro aprende a dirigir la mirada a la zona correcta de la lente. Pasada la adaptación, la mayoría de usuarios los prefieren a los bifocales.</div>
        </div>
        <div class="faq-item">
          <button class="faq-question" type="button">
            ¿Cuál es la diferencia entre policarbonato y trivex?
            <span class="faq-icon">+</span>
          </button>
          <div class="faq-answer">Ambos son materiales ligeros y resistentes a impactos. El trivex ofrece mejor nitidez óptica con menos aberraciones, mientras que el policarbonato es más delgado y económico. Para graduaciones altas o actividades deportivas, el trivex suele ser la mejor elección.</div>
        </div>
        <div class="faq-item">
          <button class="faq-question" type="button">
            ¿Los lentes de contacto son seguros para uso diario?
            <span class="faq-icon">+</span>
          </button>
          <div class="faq-answer">Sí, siempre que se sigan las indicaciones del especialista: tiempo de uso recomendado, limpieza adecuada y reposición en el plazo indicado. Usar lentes más tiempo del recomendado o no limpiarlos correctamente aumenta el riesgo de infecciones oculares.</div>
        </div>
      </div>
    </div>
  </section>

  <!-- MATERIALES -->
  <section class="materiales" id="materiales">
    <div class="materiales__bg-text" aria-hidden="true">NÉBULA VIEW</div>
    <div class="materiales__head">
      <p class="section-eyebrow">¿De qué están hechos?</p>
      <h2 class="section-title">Materiales de lente</h2>
    </div>
    <div class="materiales__track">

      <div class="mat-card">
        <div class="mat-card__glow mat-card__glow--a"></div>
        <div class="mat-card__top">
          <span class="mat-card__label">Estándar</span>
          <div class="mat-card__icon">🪟</div>
        </div>
        <h3 class="mat-card__name">Cristal mineral</h3>
        <p class="mat-card__desc">Máxima claridad óptica y resistencia al rayado. Más pesado que los plásticos, pero insuperable en nitidez. Ideal para graduaciones bajas.</p>
        <div class="mat-card__stats">
          <div class="mat-stat">
            <span class="mat-stat__label">Nitidez</span>
            <div class="mat-stat__bar"><div class="mat-stat__fill" style="--w:95%"></div></div>
          </div>
          <div class="mat-stat">
            <span class="mat-stat__label">Ligereza</span>
            <div class="mat-stat__bar"><div class="mat-stat__fill" style="--w:40%"></div></div>
          </div>
          <div class="mat-stat">
            <span class="mat-stat__label">Impacto</span>
            <div class="mat-stat__bar"><div class="mat-stat__fill" style="--w:30%"></div></div>
          </div>
        </div>
      </div>

      <div class="mat-card mat-card--featured">
        <div class="mat-card__glow mat-card__glow--b"></div>
        <div class="mat-card__badge">Más popular</div>
        <div class="mat-card__top">
          <span class="mat-card__label">Recomendado</span>
          <div class="mat-card__icon">🛡️</div>
        </div>
        <h3 class="mat-card__name">Policarbonato</h3>
        <p class="mat-card__desc">Ligero, delgado y altamente resistente a impactos. Con protección UV integrada. El material preferido para niños, deportistas y graduaciones altas.</p>
        <div class="mat-card__stats">
          <div class="mat-stat">
            <span class="mat-stat__label">Nitidez</span>
            <div class="mat-stat__bar"><div class="mat-stat__fill" style="--w:80%"></div></div>
          </div>
          <div class="mat-stat">
            <span class="mat-stat__label">Ligereza</span>
            <div class="mat-stat__bar"><div class="mat-stat__fill" style="--w:88%"></div></div>
          </div>
          <div class="mat-stat">
            <span class="mat-stat__label">Impacto</span>
            <div class="mat-stat__bar"><div class="mat-stat__fill" style="--w:95%"></div></div>
          </div>
        </div>
      </div>

      <div class="mat-card">
        <div class="mat-card__glow mat-card__glow--c"></div>
        <div class="mat-card__top">
          <span class="mat-card__label">Premium</span>
          <div class="mat-card__icon">💎</div>
        </div>
        <h3 class="mat-card__name">Trivex</h3>
        <p class="mat-card__desc">Combina lo mejor: ligereza comparable al policarbonato y nitidez casi al nivel del cristal. Menos aberraciones ópticas. Opción premium para exigentes.</p>
        <div class="mat-card__stats">
          <div class="mat-stat">
            <span class="mat-stat__label">Nitidez</span>
            <div class="mat-stat__bar"><div class="mat-stat__fill" style="--w:92%"></div></div>
          </div>
          <div class="mat-stat">
            <span class="mat-stat__label">Ligereza</span>
            <div class="mat-stat__bar"><div class="mat-stat__fill" style="--w:85%"></div></div>
          </div>
          <div class="mat-stat">
            <span class="mat-stat__label">Impacto</span>
            <div class="mat-stat__bar"><div class="mat-stat__fill" style="--w:85%"></div></div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- PROCESO -->
  <section class="proceso" id="proceso">
    <div class="proceso__deco proceso__deco--tl" aria-hidden="true"></div>
    <div class="proceso__deco proceso__deco--br" aria-hidden="true"></div>

    <div class="proceso__head">
      <p class="section-eyebrow">¿Cómo funciona?</p>
      <h2 class="section-title">De la consulta<br/><em style="font-style:italic;color:var(--plum);">a tu nuevo lente</em></h2>
    </div>

    <div class="proceso__steps">

      <div class="proceso__step">
        <div class="proceso__bubble">
          <div class="proceso__bubble-inner">01</div>
        </div>
        <div class="proceso__connector" aria-hidden="true"></div>
        <div class="proceso__card">
          <span class="proceso__card-icon">🔬</span>
          <h3>Examen visual</h3>
          <p>Un optometrista u oftalmólogo evalúa tu agudeza visual, presión intraocular y salud corneal. Duración aproximada: 45 minutos.</p>
        </div>
      </div>

      <div class="proceso__step proceso__step--alt">
        <div class="proceso__bubble">
          <div class="proceso__bubble-inner">02</div>
        </div>
        <div class="proceso__connector" aria-hidden="true"></div>
        <div class="proceso__card">
          <span class="proceso__card-icon">📋</span>
          <h3>Prescripción</h3>
          <p>Recibes tu receta óptica con los valores de esfera, cilindro, eje y distancia pupilar para cada ojo.</p>
        </div>
      </div>

      <div class="proceso__step">
        <div class="proceso__bubble">
          <div class="proceso__bubble-inner">03</div>
        </div>
        <div class="proceso__connector" aria-hidden="true"></div>
        <div class="proceso__card">
          <span class="proceso__card-icon">🕶️</span>
          <h3>Elección de montura</h3>
          <p>Seleccionas la armazón según tu estilo, morfología facial y el tipo de lente recomendado por tu especialista.</p>
        </div>
      </div>

      <div class="proceso__step proceso__step--alt">
        <div class="proceso__bubble">
          <div class="proceso__bubble-inner">04</div>
        </div>
        <div class="proceso__card">
          <span class="proceso__card-icon">✨</span>
          <h3>Listo para ver</h3>
          <p>Tus lentes son tallados, tratados y montados con precisión. En pocos días, una visión completamente nueva te espera.</p>
        </div>
      </div>

    </div>
  </section>



@include('partials.comentarios', ['pagina' => 'lentes'])
@endsection

@section('scripts')
<script>
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