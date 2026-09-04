{{--
  Widget reutilizable "Dato curioso": la tarjeta destacada que aparece en
  todas las páginas de información (Problemas Visuales, Salud Visual,
  Hábitos, Profesionales). Antes cada página tenía su propia versión
  estática (una sola frase, un ícono SVG distinto: bombilla, globo...).
  Ahora es un único componente consistente en todo el sitio:
    - ícono emoji (lupa 🔍 por defecto, o el que se le pase)
    - rota automáticamente entre varios datos curiosos relacionados
      con el tema de la página, con una transición suave (fade)

  Uso:
    @include('partials.dato-curioso', [
      'datos'  => ['Primer dato...', 'Segundo dato...', 'Tercer dato...'],
      'icono'  => '🔍', // opcional, por defecto 🔍
      'kicker' => 'Dato curioso', // opcional, ej. "Prevención"
    ])
--}}
@php
  $datos = $datos ?? [];
  $icono = $icono ?? '🔍';
  $kicker = $kicker ?? 'Dato curioso';
  $datoCuriosoUid = 'dc-' . uniqid();
@endphp

@if (count($datos))
<div class="dato-curioso" id="{{ $datoCuriosoUid }}">
  <span class="dato-curioso-icon" aria-hidden="true">{{ $icono }}</span>
  <div class="dato-curioso-body">
    <div class="dato-curioso-kicker">{{ $kicker }}</div>
    <p class="dato-curioso-text">{!! $datos[0] !!}</p>
  </div>
  @if (count($datos) > 1)
  <div class="dato-curioso-dots" aria-hidden="true">
    @foreach ($datos as $i => $d)
      <span class="dc-dot{{ $i === 0 ? ' active' : '' }}"></span>
    @endforeach
  </div>
  @endif
</div>

@if (count($datos) > 1)
<script>
(function () {
  var datos = @json($datos);
  var el = document.getElementById('{{ $datoCuriosoUid }}');
  if (!el || !datos || datos.length < 2) return;

  var textEl = el.querySelector('.dato-curioso-text');
  var dots = el.querySelectorAll('.dc-dot');
  var i = 0;

  function show(next) {
    textEl.style.opacity = 0;
    setTimeout(function () {
      textEl.innerHTML = datos[next];
      dots.forEach(function (d, idx) { d.classList.toggle('active', idx === next); });
      textEl.style.opacity = 1;
    }, 260);
  }

  var timer = setInterval(function () {
    i = (i + 1) % datos.length;
    show(i);
  }, 6000);

  // Pausa al pasar el mouse, para que se pueda leer con calma
  el.addEventListener('mouseenter', function () { clearInterval(timer); });
  el.addEventListener('mouseleave', function () {
    timer = setInterval(function () { i = (i + 1) % datos.length; show(i); }, 6000);
  });
})();
</script>
@endif
@endif
