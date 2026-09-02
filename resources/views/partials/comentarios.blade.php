@php
    // $pagina debe venir del @include, ej: @include('partials.comentarios', ['pagina' => 'habitos'])
    // Debe coincidir exactamente con un valor de Comentario::PAGINAS_PERMITIDAS.
@endphp
<link rel="stylesheet" href="{{ asset('css/comentarios.css') }}">

<section class="comentarios-seccion" data-pagina="{{ $pagina }}">
  <h2 class="comentarios-titulo">Comentarios</h2>

  @auth
    <form class="comentarios-form" id="comentariosForm">
      <textarea
        id="comentariosInput"
        maxlength="500"
        rows="3"
        placeholder="Comparte tu opinión o experiencia sobre este tema..."
        required
      ></textarea>
      <div class="comentarios-form-footer">
        <span class="comentarios-contador" id="comentariosContador">0 / 500</span>
        <button type="submit" class="comentarios-btn-enviar">Publicar comentario</button>
      </div>
      <p class="comentarios-aviso" id="comentariosAviso"></p>
    </form>
  @else
    <p class="comentarios-login-aviso">
      <a href="{{ route('login') }}">Inicia sesión</a> para dejar un comentario.
    </p>
  @endauth

  <div class="comentarios-lista" id="comentariosLista">
    <p class="comentarios-cargando">Cargando comentarios...</p>
  </div>
</section>

<script src="{{ asset('js/comentarios.js') }}" defer></script>
