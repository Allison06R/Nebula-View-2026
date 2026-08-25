{{--
  Selector de tests, en formato de tarjetas.
  Se usa tanto en test.blade.php como en test-ishihara.blade.php.
  La tarjeta del test en el que ya estás se muestra "activa" (más grande).
  Al pasar el cursor / tocar una tarjeta, esta se agranda un poco antes de navegar.

  Para añadir un test nuevo en el futuro, copia uno de los bloques
  <a class="test-pick-card">...</a> y ajústalo (o usa el bloque
  ".tpc-soon" de ejemplo, comentado más abajo, mientras no tenga ruta).
--}}
<div class="test-picker">
  <a href="{{ route('test') }}" class="test-pick-card {{ request()->routeIs('test') ? 'is-active' : '' }}">
    <div class="tpc-top">
      <span class="tpc-ico">🔬</span>
      <span class="tpc-name">Test Visual General</span>
    </div>
    <p class="tpc-desc">Síntomas, hábitos digitales y estilo de vida</p>
    <div class="tpc-foot"><span>20 preguntas</span><span>~4 min</span></div>
  </a>

  <a href="{{ route('test-ishihara') }}" class="test-pick-card {{ request()->routeIs('test-ishihara') ? 'is-active' : '' }}">
    <div class="tpc-top">
      <span class="tpc-ico">🎨</span>
      <span class="tpc-name">Test de Ishihara</span>
    </div>
    <p class="tpc-desc">Detecta dificultad para percibir colores</p>
    <div class="tpc-foot"><span>10 láminas</span><span>~2 min</span></div>
  </a>

  {{--
  <div class="test-pick-card tpc-soon">
    <div class="tpc-top">
      <span class="tpc-ico">✨</span>
      <span class="tpc-name">Próximo test</span>
    </div>
    <p class="tpc-desc">Muy pronto</p>
    <div class="tpc-foot"><span>Próximamente</span></div>
  </div>
  --}}
</div>
