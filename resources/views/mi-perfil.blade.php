@extends('layouts.app')

@section('title', 'Mi Perfil - Nebula View')

@section('css')
<link rel="stylesheet" href="{{ asset('css/Miperfil.css') }}">
@endsection

@section('content')
@php
  $marcoActual  = $usuario->marco_perfil ?? 'ninguno';
  $marcoLabel   = $marcos[$marcoActual] ?? 'Sin marco';
@endphp

<div class="mp-cosmos">
  <div class="mp-stars"></div>
  <div class="mp-nebula mp-nebula-a"></div>
  <div class="mp-nebula mp-nebula-b"></div>

  <div class="mp-shell" style="max-width:1100px;">

    <h2 class="mp-title">Tu <em>panel</em> de usuario</h2>
    <p class="mp-subtitle">Toda tu actividad en Nebula View, en un solo lugar.</p>

    @if(session('success'))
      <div class="mp-alert mp-alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
      <div class="mp-alert mp-alert-error">
        <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
      </div>
    @endif

    {{-- ───────── Panel unificado: pestañas horizontales + contenido ───────── --}}
    <div class="mp-panel">

      <div class="mp-tabbar mp-tabbar--top" id="mpTopTabbar">
        <button type="button" class="mp-tab mp-tab--top mp-tab--active" data-tab="perfil" onclick="mpSwitchTab('perfil')">
          <span class="mp-tab-icon">👤</span><span>Perfil</span>
        </button>
        <button type="button" class="mp-tab mp-tab--top" data-tab="apariencia" onclick="mpSwitchTab('apariencia')">
          <span class="mp-tab-icon">🎨</span><span>Editar perfil</span>
        </button>
        <button type="button" class="mp-tab mp-tab--top" data-tab="modelos3d" onclick="mpSwitchTab('modelos3d')">
          <span class="mp-tab-icon">👓</span><span>Modelos 3D</span>
        </button>
        <button type="button" class="mp-tab mp-tab--top" data-tab="tests" onclick="mpSwitchTab('tests')">
          <span class="mp-tab-icon">🧪</span><span>Tests realizados</span>
        </button>
        <button type="button" class="mp-tab mp-tab--top" data-tab="chats" onclick="mpSwitchTab('chats')">
          <span class="mp-tab-icon">💬</span><span>Chats con Nebulita</span>
        </button>
        <button type="button" class="mp-tab mp-tab--top" data-tab="comentarios" onclick="mpSwitchTab('comentarios')">
          <span class="mp-tab-icon">💭</span><span>Comentarios</span>
        </button>
        <a href="{{ route('preferencias.show') }}" class="mp-tab mp-tab--top mp-tab--link">
          <span class="mp-tab-icon">⚙️</span><span>Preferencias</span>
        </a>
      </div>

      <div class="mp-panel-body">

        {{-- ── Pestaña: Perfil (resumen) ── --}}
        <div class="mp-tabpanel mp-tabpanel--active" id="tab-perfil">
          <div class="mp-profile-grid">

            <div class="mp-profile-side">
              <div class="mp-avatar-ring mp-avatar-ring--xl mp-frame--{{ $marcoActual }}">
                <div class="mp-avatar-inner mp-avatar-inner--xl">
                  @if($usuario->avatar_url)
                    <img src="{{ $usuario->avatar_url }}" alt="Foto de perfil">
                  @else
                    <div class="mp-avatar-default" style="width:100%;height:100%;">
                      @include('partials.mp-icon', ['icon' => 'sparkle'])
                    </div>
                  @endif
                </div>
              </div>
              <p class="mp-profile-name">{{ $usuario->nombre }}</p>
              <p class="mp-profile-user">@ {{ $usuario->usuario }}</p>
              <button type="button" class="mp-btn-secondary" onclick="mpSwitchTab('apariencia')">Editar foto y marco</button>
            </div>

            <div class="mp-profile-fields">
              <div class="mp-field-row">
                <span class="mp-field-label">Nombre</span>
                <span class="mp-field-value">{{ $usuario->nombre }}</span>
              </div>
              <div class="mp-field-row">
                <span class="mp-field-label">Usuario</span>
                <span class="mp-field-value">@ {{ $usuario->usuario }}</span>
              </div>
              <div class="mp-field-row">
                <span class="mp-field-label">Correo electrónico</span>
                <span class="mp-field-value">{{ $usuario->correo }}</span>
              </div>
              <div class="mp-field-row">
                <span class="mp-field-label">Marco de foto actual</span>
                <span class="mp-field-value mp-field-value--muted">{{ $marcoLabel }}</span>
              </div>
              <div class="mp-field-row">
                <span class="mp-field-label">Tests realizados</span>
                <span class="mp-field-value">{{ $stats['tests'] ?? 0 }}</span>
              </div>
              <div class="mp-field-row">
                <span class="mp-field-label">Modelos 3D favoritos</span>
                <span class="mp-field-value">{{ $stats['modelos3d'] ?? 0 }}</span>
              </div>
              <div class="mp-field-row">
                <span class="mp-field-label">Chats con Nebulita</span>
                <span class="mp-field-value">{{ $stats['chats'] ?? 0 }}</span>
              </div>
              <div class="mp-field-row">
                <span class="mp-field-label">Comentarios</span>
                <span class="mp-field-value">{{ $stats['comentarios'] ?? 0 }}</span>
              </div>
            </div>

          </div>
        </div>

        {{-- ── Pestaña: Editar perfil (Apariencia) ── --}}
        <div class="mp-tabpanel" id="tab-apariencia">

          {{-- Vista previa en vivo: se actualiza mientras eliges foto/marco/banner --}}
          <div class="mp-preview">
            <div class="mp-banner-preview" id="mpCardBanner"
                 @if($usuario->banner_url)
                   style="background-image:url('{{ $usuario->banner_url }}');background-size:cover;background-position:center;"
                 @else
                   style="background:{{ $usuario->banner_gradient ?? 'linear-gradient(135deg,#6B2FA0,#9B59B6,#D946EF)' }};"
                 @endif>
            </div>
            <div class="mp-preview-body">
              <div class="mp-avatar-ring mp-frame--{{ $marcoActual }}" id="mpCardFrameWrap">
                <div class="mp-avatar-inner" id="mpCardAvatarInner">
                  @if($usuario->avatar_url)
                    <img src="{{ $usuario->avatar_url }}" alt="Foto de perfil">
                  @else
                    <div class="mp-avatar-default" style="width:100%;height:100%;">
                      @include('partials.mp-icon', ['icon' => 'sparkle'])
                    </div>
                  @endif
                </div>
              </div>
              <div class="mp-preview-info">
                <p class="mp-preview-name">{{ $usuario->nombre }}</p>
                <p class="mp-preview-sub">Así se verá tu perfil</p>
              </div>
            </div>
          </div>

          <form method="POST" action="{{ route('mi-perfil.update') }}" enctype="multipart/form-data" id="mpForm">
            @csrf

            {{-- Foto de perfil --}}
            <div class="mp-card">
              <div class="mp-section-badge"><span class="mp-section-dot"></span>Foto de perfil</div>
              <h3 class="mp-section-title">Tu foto</h3>
              <p class="mp-section-hint">Elige una foto de la galería o sube la tuya.</p>

              <div class="mp-frame-grid">
                @foreach($avatares as $key => $av)
                  <div class="mp-frame-opt">
                    <input type="radio" name="avatar_preset" id="avatar_{{ $key }}" value="{{ $key }}"
                           {{ $usuario->avatar_tipo === 'preset' && $usuario->avatar_preset == $key ? 'checked' : '' }}
                           onchange="mpSelectAvatarPreset('{{ $key }}', '{{ asset($av['archivo']) }}')">
                    <label for="avatar_{{ $key }}">
                      <span class="mp-frame-demo-wrap">
                        <img src="{{ asset($av['archivo']) }}" alt="{{ $av['nombre'] }}" style="width:58px;height:58px;border-radius:50%;object-fit:cover;display:block;">
                      </span>
                      <span class="mp-frame-label">{{ $av['nombre'] }}</span>
                    </label>
                  </div>
                @endforeach
              </div>

              <p class="mp-section-hint" style="margin-top:1.25rem;">O sube tu propia imagen:</p>
              <label class="mp-dropzone" for="fotoInput" id="mpDropzoneFoto">
                <svg class="mp-dropzone-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 16V4M7 9l5-5 5 5"/><path d="M4 16v3a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-3"/></svg>
                <div class="mp-dropzone-text">Haz clic para elegir una imagen (jpg, png o webp, máx. 4MB)</div>
                <div class="mp-dropzone-filename" id="mpFotoFileName"></div>
              </label>
              <input type="file" name="foto" id="fotoInput" accept="image/png,image/jpeg,image/webp" onchange="mpFotoSeleccionada(this)">
            </div>

            {{-- Marco --}}
            <div class="mp-card">
              <div class="mp-section-badge"><span class="mp-section-dot"></span>Marco</div>
              <h3 class="mp-section-title">Decora el borde de tu foto</h3>
              <p class="mp-section-hint">Elige el estilo de marco para tu avatar. Se aplica a tu foto en todo el sitio.</p>

              <div class="mp-frame-grid">
                @foreach($marcos as $key => $label)
                  <div class="mp-frame-opt">
                    <input type="radio" name="marco_perfil" id="marco_{{ $key }}" value="{{ $key }}"
                           {{ $marcoActual == $key ? 'checked' : '' }}
                           onchange="mpSelectFrame('{{ $key }}')">
                    <label for="marco_{{ $key }}">
                      <span class="mp-frame-demo-wrap mp-frame--{{ $key }}">
                        <span class="mp-frame-demo"></span>
                      </span>
                      <span class="mp-frame-label">{{ $label }}</span>
                    </label>
                  </div>
                @endforeach
              </div>
            </div>

            {{-- Banner --}}
            <div class="mp-card">
              <div class="mp-section-badge"><span class="mp-section-dot"></span>Banner</div>
              <h3 class="mp-section-title">El fondo de tu perfil</h3>
              <p class="mp-section-hint">Elige un banner de la galería o sube el tuyo.</p>

              <div class="mp-frame-grid">
                @foreach($banners as $key => $bn)
                  <div class="mp-frame-opt">
                    <input type="radio" name="banner_preset" id="banner_{{ $key }}" value="{{ $key }}"
                           {{ $usuario->banner_tipo !== 'custom' && $usuario->banner_perfil == $key ? 'checked' : '' }}
                           onchange="mpSelectBannerPreset('{{ $key }}', `{{ $bn['gradiente'] }}`)">
                    <label for="banner_{{ $key }}">
                      <span class="mp-frame-demo-wrap">
                        <span style="display:block;width:78px;height:44px;border-radius:10px;background:{{ $bn['gradiente'] }};"></span>
                      </span>
                      <span class="mp-frame-label">{{ $bn['nombre'] }}</span>
                    </label>
                  </div>
                @endforeach
              </div>

              <p class="mp-section-hint" style="margin-top:1.25rem;">O sube tu propia imagen:</p>
              <label class="mp-dropzone" for="bannerInput" id="mpDropzoneBanner">
                <svg class="mp-dropzone-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 16V4M7 9l5-5 5 5"/><path d="M4 16v3a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-3"/></svg>
                <div class="mp-dropzone-text">Haz clic para elegir una imagen (jpg, png o webp, máx. 4MB)</div>
                <div class="mp-dropzone-filename" id="mpBannerFileName"></div>
              </label>
              <input type="file" name="banner" id="bannerInput" accept="image/png,image/jpeg,image/webp" onchange="mpBannerSeleccionada(this)">
            </div>

            <div class="mp-actions">
              <button type="submit" class="mp-btn-save">Guardar cambios</button>
            </div>
          </form>
        </div>

        {{-- ── Pestaña: Mis Modelos 3D ── --}}
        <div class="mp-tabpanel" id="tab-modelos3d">
          <div class="mp-card">
            <div class="mp-section-badge"><span class="mp-section-dot"></span>Modelos 3D</div>
            <h3 class="mp-section-title">Tus modelos favoritos</h3>
            <p class="mp-section-hint">Modelos de lentes que guardaste como favoritos desde el catálogo.</p>

            <div id="mp3dEmpty" @if(!$misModelos3d->isEmpty()) style="display:none;" @endif>
              <p class="mp-section-hint" style="margin-top:1rem;">
                Aún no has guardado ningún modelo como favorito.
                <a href="{{ route('modelos3d') }}">Explora el catálogo →</a>
              </p>
            </div>

            <div class="mp-frame-grid" id="mp3dGrid" style="margin-top:1.25rem; @if($misModelos3d->isEmpty()) display:none; @endif">
              @foreach($misModelos3d as $modelo)
                <div class="mp-3d-item" data-nombre="{{ $modelo->nombre }}" data-categoria="{{ $modelo->categoria }}">
                  <span style="font-size:28px;">👓</span>
                  <span class="mp-frame-label" style="text-align:center;">{{ $modelo->nombre }}</span>
                  @if($modelo->categoria)
                    <span class="mp-3d-cat">{{ $modelo->categoria }}</span>
                  @endif
                  <button type="button" class="mp-3d-remove" title="Quitar de favoritos">✕</button>
                </div>
              @endforeach
            </div>
          </div>
        </div>

        {{-- ── Pestaña: Tests realizados ── --}}
        <div class="mp-tabpanel" id="tab-tests">
          <div class="mp-card">
            <div class="mp-section-badge"><span class="mp-section-dot"></span>Historial</div>
            <h3 class="mp-section-title">Tus tests realizados</h3>
            <p class="mp-section-hint">Diagnósticos visuales y tests de Ishihara que has completado.</p>

            @if(empty($misTests))
              <p class="mp-section-hint" style="margin-top:1rem;">
                Aún no has realizado ningún test.
                <a href="{{ route('test') }}">Haz el diagnóstico visual →</a>
              </p>
            @else
              <div class="mp-list" id="mpTestsList">
                @foreach($misTests as $t)
                  <div class="mp-list-item" data-delete-url="{{ $t['rutaDelete'] }}">
                    <div class="mp-list-main">
                      <span class="mp-badge mp-badge--{{ $t['tipo'] }}">{{ $t['etiqueta'] }}</span>
                      <div class="mp-list-title">{{ $t['titulo'] }}</div>
                      @if($t['detalle'])
                        <div class="mp-list-sub">{{ $t['detalle'] }}</div>
                      @endif
                      <div class="mp-list-date">{{ $t['fecha'] }}</div>
                    </div>
                    <div class="mp-list-actions">
                      <button type="button" class="mp-icon-btn mp-send-pdf" data-url="{{ $t['rutaPdf'] }}" title="Enviar PDF por correo">📧</button>
                      <button type="button" class="mp-icon-btn mp-icon-btn--danger mp-delete-item" title="Eliminar">🗑</button>
                    </div>
                  </div>
                @endforeach
              </div>
            @endif
          </div>
        </div>

        {{-- ── Pestaña: Chats con Nebulita ── --}}
        <div class="mp-tabpanel" id="tab-chats">
          <div class="mp-card">
            <div class="mp-section-badge"><span class="mp-section-dot"></span>Asistente</div>
            <h3 class="mp-section-title">Tus conversaciones con Nebulita</h3>
            <p class="mp-section-hint">Preguntas que le hiciste al asistente virtual y sus respuestas.</p>

            @if($misChats->isEmpty())
              <p class="mp-section-hint" style="margin-top:1rem;">
                Aún no has hablado con Nebulita. Ábrela desde la burbuja en la esquina de la pantalla.
              </p>
            @else
              <div class="mp-actions" style="margin-bottom:1rem;">
                <button type="button" class="mp-btn-secondary" id="mpClearChats">Vaciar historial de chats</button>
              </div>
              <div class="mp-list" id="mpChatsList">
                @foreach($misChats as $chat)
                  <div class="mp-chat-item" data-delete-url="{{ route('chat.widget.destroy', $chat->id_chat_mensaje) }}">
                    <div class="mp-chat-q"><span class="mp-chat-tag">Tú</span>{{ $chat->mensaje_usuario }}</div>
                    <div class="mp-chat-a"><span class="mp-chat-tag mp-chat-tag--bot">Nebulita</span>{{ $chat->respuesta_bot }}</div>
                    <div class="mp-list-actions">
                      <span class="mp-list-date">{{ $chat->created_at?->format('d/m/Y H:i') }}</span>
                      <button type="button" class="mp-icon-btn mp-icon-btn--danger mp-delete-item" title="Eliminar conversación">🗑</button>
                    </div>
                  </div>
                @endforeach
              </div>
            @endif
          </div>
        </div>

        {{-- ── Pestaña: Comentarios ── --}}
        <div class="mp-tabpanel" id="tab-comentarios">
          <div class="mp-card">
            <div class="mp-section-badge"><span class="mp-section-dot"></span>Comunidad</div>
            <h3 class="mp-section-title">Tus comentarios</h3>
            <p class="mp-section-hint">Comentarios que has dejado en las páginas informativas del sitio.</p>

            @if($misComentarios->isEmpty())
              <p class="mp-section-hint" style="margin-top:1rem;">
                Aún no has dejado ningún comentario.
              </p>
            @else
              @php
                $mpPaginas = [
                  'problemas-visuales' => 'Problemas visuales',
                  'salud-visual'       => 'Salud visual',
                  'habitos'            => 'Hábitos',
                  'lentes'             => 'Lentes',
                  'clinicas'           => 'Clínicas',
                  'profesionales'      => 'Profesionales',
                  'rostros'            => 'Rostros',
                ];
                $mpEstados = [
                  'aprobado'            => ['Publicado', 'ok'],
                  'pendiente_revision'  => ['En revisión', 'pending'],
                  'rechazado'           => ['Rechazado', 'rejected'],
                ];
              @endphp
              <div class="mp-list" id="mpComentariosList">
                @foreach($misComentarios as $c)
                  @php $estado = $mpEstados[$c->estado] ?? ['Desconocido', 'pending']; @endphp
                  <div class="mp-list-item" data-delete-url="{{ route('comentarios.destroyMio', $c->id_comentario) }}">
                    <div class="mp-list-main">
                      <span class="mp-badge mp-badge--estado-{{ $estado[1] }}">{{ $estado[0] }}</span>
                      <div class="mp-list-title">{{ $mpPaginas[$c->pagina] ?? $c->pagina }}</div>
                      <div class="mp-list-sub">{{ $c->contenido }}</div>
                      @if($c->estado === 'rechazado' && $c->motivo_rechazo)
                        <div class="mp-list-sub mp-list-sub--danger">Motivo: {{ $c->motivo_rechazo }}</div>
                      @endif
                      <div class="mp-list-date">{{ $c->created_at?->format('d/m/Y H:i') }}</div>
                    </div>
                    <div class="mp-list-actions">
                      <button type="button" class="mp-icon-btn mp-icon-btn--danger mp-delete-item" title="Eliminar">🗑</button>
                    </div>
                  </div>
                @endforeach
              </div>
            @endif
          </div>
        </div>

      </div>
    </div>

  </div>
</div>
@endsection

@section('scripts')
<script>
function mpFotoSeleccionada(input) {
  if (!input.files || !input.files[0]) return;
  document.getElementById('mpFotoFileName').textContent = input.files[0].name;

  // Subir un archivo tiene prioridad sobre la galería: deseleccionamos
  // cualquier avatar de galería que estuviera marcado.
  document.querySelectorAll('input[name="avatar_preset"]').forEach(r => r.checked = false);

  const reader = new FileReader();
  reader.onload = function (e) {
    const wrap = document.getElementById('mpCardAvatarInner');
    wrap.innerHTML = '<img src="' + e.target.result + '" style="width:100%;height:100%;object-fit:cover;">';
  };
  reader.readAsDataURL(input.files[0]);
}

function mpBannerSeleccionada(input) {
  if (!input.files || !input.files[0]) return;
  document.getElementById('mpBannerFileName').textContent = input.files[0].name;

  document.querySelectorAll('input[name="banner_preset"]').forEach(r => r.checked = false);

  const reader = new FileReader();
  reader.onload = function (e) {
    const banner = document.getElementById('mpCardBanner');
    banner.style.background = 'none';
    banner.style.backgroundImage = 'url(' + e.target.result + ')';
    banner.style.backgroundSize = 'cover';
    banner.style.backgroundPosition = 'center';
  };
  reader.readAsDataURL(input.files[0]);
}

function mpSelectAvatarPreset(key, url) {
  // Elegir una foto de la galería cancela cualquier archivo que
  // estuviera a punto de subirse, para que gane la elección visible.
  document.getElementById('fotoInput').value = '';
  document.getElementById('mpFotoFileName').textContent = '';

  const wrap = document.getElementById('mpCardAvatarInner');
  wrap.innerHTML = '<img src="' + url + '" style="width:100%;height:100%;object-fit:cover;">';
}

function mpSelectBannerPreset(key, gradiente) {
  document.getElementById('bannerInput').value = '';
  document.getElementById('mpBannerFileName').textContent = '';

  const banner = document.getElementById('mpCardBanner');
  banner.style.backgroundImage = 'none';
  banner.style.background = gradiente;
}

function mpSelectFrame(key) {
  // Actualiza el marco en la vista previa en vivo de "Editar perfil".
  // Las clases mp-frame--* llevan el efecto visual real (ver Miperfil.css);
  // no se pierde ningún otro modificador porque este elemento solo usa estos dos.
  const frameWrap = document.getElementById('mpCardFrameWrap');
  frameWrap.className = 'mp-avatar-ring mp-frame--' + key;
}

function mpSwitchTab(tab) {
  document.querySelectorAll('#mpTopTabbar .mp-tab[data-tab]').forEach(btn => {
    btn.classList.toggle('mp-tab--active', btn.dataset.tab === tab);
  });
  document.querySelectorAll('.mp-tabpanel').forEach(panel => {
    panel.classList.toggle('mp-tabpanel--active', panel.id === 'tab-' + tab);
  });
}

// Permite abrir el perfil directamente en una pestaña concreta con
// /mi-perfil?tab=modelos3d (usado, por ejemplo, desde la página de
// Preferencias para volver a la pestaña donde estaba el usuario).
(function () {
  const tabParam = new URLSearchParams(window.location.search).get('tab');
  const tabsValidas = ['perfil', 'apariencia', 'modelos3d', 'tests', 'chats', 'comentarios'];
  if (tabParam && tabsValidas.includes(tabParam)) {
    mpSwitchTab(tabParam);
  }
})();

/* ══════════════ Modelos 3D favoritos / Tests / Chats / Comentarios ══════════════ */
(function () {
  const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]')?.content ?? '';
  const TOGGLE_FAVORITO_URL = "{{ route('modelos3d.toggle') }}";
  const CLEAR_CHATS_URL     = "{{ route('chat.widget.clear') }}";

  function mpToast(msg, isError) {
    // Aviso simple y no intrusivo; evita depender de una librería externa.
    const el = document.createElement('div');
    el.textContent = msg;
    el.style.cssText = 'position:fixed;bottom:24px;right:24px;z-index:99999;'
      + 'background:' + (isError ? '#f87171' : '#34d399') + ';color:#1e1b4b;'
      + 'padding:.75rem 1.2rem;border-radius:12px;font-family:"DM Sans",sans-serif;'
      + 'font-size:.85rem;font-weight:600;box-shadow:0 10px 30px rgba(0,0,0,.35);';
    document.body.appendChild(el);
    setTimeout(() => el.remove(), 3200);
  }

  // ── Quitar un modelo 3D de favoritos ──────────────────────────────────
  document.getElementById('mp3dGrid')?.addEventListener('click', async (e) => {
    const btn = e.target.closest('.mp-3d-remove');
    if (!btn) return;

    const item = btn.closest('.mp-3d-item');
    const nombre = item.dataset.nombre;
    const categoria = item.dataset.categoria || '';

    btn.disabled = true;
    try {
      const res = await fetch(TOGGLE_FAVORITO_URL, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': CSRF_TOKEN,
        },
        body: JSON.stringify({ nombre, categoria }),
      });
      const data = await res.json();

      if (res.ok && data.success) {
        item.remove();
        const grid = document.getElementById('mp3dGrid');
        if (!grid.querySelector('.mp-3d-item')) {
          grid.style.display = 'none';
          document.getElementById('mp3dEmpty').style.display = '';
        }
      } else {
        mpToast('No se pudo quitar el favorito.', true);
        btn.disabled = false;
      }
    } catch (err) {
      mpToast('Error de conexión.', true);
      btn.disabled = false;
    }
  });

  // ── Eliminar un item (test, chat o comentario) ────────────────────────
  document.querySelectorAll('#mpTestsList, #mpChatsList, #mpComentariosList').forEach(list => {
    list.addEventListener('click', async (e) => {
      const delBtn = e.target.closest('.mp-delete-item');
      if (delBtn) {
        const row = delBtn.closest('[data-delete-url]');
        if (!confirm('¿Eliminar este elemento? Esta acción no se puede deshacer.')) return;

        delBtn.disabled = true;
        try {
          const res = await fetch(row.dataset.deleteUrl, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': CSRF_TOKEN, 'Accept': 'application/json' },
          });
          if (res.ok) {
            row.remove();
          } else {
            mpToast('No se pudo eliminar.', true);
            delBtn.disabled = false;
          }
        } catch (err) {
          mpToast('Error de conexión.', true);
          delBtn.disabled = false;
        }
        return;
      }

      const pdfBtn = e.target.closest('.mp-send-pdf');
      if (pdfBtn) {
        pdfBtn.disabled = true;
        const original = pdfBtn.textContent;
        pdfBtn.textContent = '…';
        try {
          const res = await fetch(pdfBtn.dataset.url, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': CSRF_TOKEN, 'Accept': 'application/json' },
          });
          const data = await res.json();
          if (res.ok && data.success) {
            mpToast(data.message || 'Diagnóstico enviado por correo.');
          } else {
            mpToast(data.error || 'No se pudo enviar el PDF.', true);
          }
        } catch (err) {
          mpToast('Error de conexión.', true);
        } finally {
          pdfBtn.disabled = false;
          pdfBtn.textContent = original;
        }
      }
    });
  });

  // ── Vaciar todo el historial de chats ─────────────────────────────────
  document.getElementById('mpClearChats')?.addEventListener('click', async () => {
    if (!confirm('¿Vaciar todo tu historial de chats con Nebulita? Esta acción no se puede deshacer.')) return;
    try {
      const res = await fetch(CLEAR_CHATS_URL, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': CSRF_TOKEN, 'Accept': 'application/json' },
      });
      if (res.ok) {
        document.getElementById('mpChatsList')?.querySelectorAll('.mp-chat-item').forEach(el => el.remove());
        mpToast('Historial de chats vaciado.');
      } else {
        mpToast('No se pudo vaciar el historial.', true);
      }
    } catch (err) {
      mpToast('Error de conexión.', true);
    }
  });
})();
</script>
@endsection