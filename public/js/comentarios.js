(function () {
  const seccion = document.querySelector('.comentarios-seccion');
  if (!seccion) return;

  const pagina    = seccion.dataset.pagina;
  const lista     = document.getElementById('comentariosLista');
  const form      = document.getElementById('comentariosForm');
  const input     = document.getElementById('comentariosInput');
  const contador  = document.getElementById('comentariosContador');
  const aviso     = document.getElementById('comentariosAviso');
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

  function escapeHtml(str) {
    const div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
  }

  function renderComentario(c) {
    return `
      <div class="comentario-item">
        <div class="comentario-item-header">
          <span class="comentario-item-usuario">${escapeHtml(c.usuario)}</span>
          <span class="comentario-item-fecha">${escapeHtml(c.fecha)}</span>
        </div>
        <div class="comentario-item-texto">${escapeHtml(c.contenido)}</div>
      </div>
    `;
  }

  function cargarComentarios() {
    fetch(`/comentarios/${pagina}`)
      .then((r) => r.json())
      .then((data) => {
        const comentarios = data.comentarios || [];
        if (comentarios.length === 0) {
          lista.innerHTML = '<p class="comentarios-vacio">Aún no hay comentarios. ¡Sé el primero en opinar!</p>';
          return;
        }
        lista.innerHTML = comentarios.map(renderComentario).join('');
      })
      .catch(() => {
        lista.innerHTML = '<p class="comentarios-vacio">No se pudieron cargar los comentarios.</p>';
      });
  }

  if (input && contador) {
    input.addEventListener('input', () => {
      contador.textContent = `${input.value.length} / 500`;
    });
  }

  if (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();

      const texto = input.value.trim();
      if (!texto) return;

      const btn = form.querySelector('.comentarios-btn-enviar');
      btn.disabled = true;
      aviso.textContent = 'Enviando...';
      aviso.className = 'comentarios-aviso es-info';

      fetch('/comentarios', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json',
        },
        body: JSON.stringify({ pagina: pagina, contenido: texto }),
      })
        .then((r) => r.json())
        .then((data) => {
          btn.disabled = false;

          if (!data.ok) {
            aviso.textContent = data.mensaje || 'No se pudo publicar el comentario.';
            aviso.className = 'comentarios-aviso es-error';
            return;
          }

          if (data.pendiente) {
            aviso.textContent = data.mensaje;
            aviso.className = 'comentarios-aviso es-info';
            input.value = '';
            contador.textContent = '0 / 500';
            return;
          }

          aviso.textContent = '¡Comentario publicado!';
          aviso.className = 'comentarios-aviso es-exito';
          input.value = '';
          contador.textContent = '0 / 500';

          const vacio = lista.querySelector('.comentarios-vacio');
          if (vacio) vacio.remove();
          lista.insertAdjacentHTML('afterbegin', renderComentario(data.comentario));

          setTimeout(() => { aviso.textContent = ''; }, 4000);
        })
        .catch(() => {
          btn.disabled = false;
          aviso.textContent = 'Ocurrió un error de conexión. Intenta de nuevo.';
          aviso.className = 'comentarios-aviso es-error';
        });
    });
  }

  cargarComentarios();
})();
