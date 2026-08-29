@extends('admin.layout')
@section('title', $usuario->nombre)
@section('page-title', $usuario->nombre)
@section('page-subtitle', 'Detalle de la cuenta')

@section('topbar-actions')
  <a href="{{ route('admin.usuarios.edit', $usuario) }}" class="btn btn-ghost">
    <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
    Editar
  </a>
  <button onclick="confirmarEliminar('{{ route('admin.usuarios.destroy', $usuario) }}','{{ $usuario->nombre }}')" class="btn btn-danger">
    <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
    Eliminar
  </button>
@endsection

@section('content')

<div class="admin-card" style="margin-bottom:20px">
  <div class="admin-card-header">
    <h3 class="admin-card-title">Información de la cuenta</h3>
  </div>
  <div class="admin-card-body">
    <div class="perfil-grid">
      <div class="perfil-item">
        <div class="perfil-item-label">Nombre</div>
        <div class="perfil-item-value">{{ $usuario->nombre }}</div>
      </div>
      <div class="perfil-item">
        <div class="perfil-item-label">Usuario</div>
        <div class="perfil-item-value">{{ '@'.$usuario->usuario }}</div>
      </div>
      <div class="perfil-item">
        <div class="perfil-item-label">Correo</div>
        <div class="perfil-item-value">{{ $usuario->correo }}</div>
      </div>
      <div class="perfil-item">
        <div class="perfil-item-label">Rol</div>
        <div class="perfil-item-value"><span class="badge badge-{{ $usuario->rol }}">{{ ucfirst($usuario->rol) }}</span></div>
      </div>
      <div class="perfil-item">
        <div class="perfil-item-label">ID de cuenta</div>
        <div class="perfil-item-value">#{{ $usuario->id_usuario }}</div>
      </div>
    </div>
  </div>
</div>

<div class="admin-card" style="margin-bottom:20px">
  <div class="admin-card-header">
    <h3 class="admin-card-title">Perfil visual</h3>
    <div style="display:flex;gap:6px">
      <a href="{{ route('admin.usuarios.perfil.edit', $usuario) }}" class="btn btn-ghost btn-sm">
        {{ $usuario->perfilVisual ? 'Editar' : 'Crear' }}
      </a>
      @if($usuario->perfilVisual)
        <button onclick="confirmarEliminarPerfil('{{ route('admin.usuarios.perfil.destroy', $usuario) }}')" class="btn btn-danger btn-sm">Eliminar</button>
      @endif
    </div>
  </div>
  <div class="admin-card-body">
    @if($usuario->perfilVisual)
      <div class="perfil-grid">
        <div class="perfil-item">
          <div class="perfil-item-label">Tipo de cara</div>
          <div class="perfil-item-value">{{ $usuario->perfilVisual->tipo_cara ?? '—' }}</div>
        </div>
        <div class="perfil-item">
          <div class="perfil-item-label">Edad</div>
          <div class="perfil-item-value">{{ $usuario->perfilVisual->edad ?? '—' }}</div>
        </div>
        <div class="perfil-item">
          <div class="perfil-item-label">Sexo</div>
          <div class="perfil-item-value">{{ $usuario->perfilVisual->sexo ?? '—' }}</div>
        </div>
        <div class="perfil-item">
          <div class="perfil-item-label">Problema visual</div>
          <div class="perfil-item-value">{{ $usuario->perfilVisual->problema_visual ?? '—' }}</div>
        </div>
        <div class="perfil-item">
          <div class="perfil-item-label">Síntomas</div>
          <div class="perfil-item-value">{{ $usuario->perfilVisual->sintomas ?? '—' }}</div>
        </div>
        <div class="perfil-item">
          <div class="perfil-item-label">Color preferido</div>
          <div class="perfil-item-value">{{ $usuario->perfilVisual->color ?? '—' }}</div>
        </div>
        <div class="perfil-item">
          <div class="perfil-item-label">Estética</div>
          <div class="perfil-item-value">{{ $usuario->perfilVisual->estetica ?? '—' }}</div>
        </div>
      </div>
    @else
      <p style="color:var(--a-muted);font-size:13px">Este usuario aún no ha completado su perfil visual.</p>
    @endif
  </div>
</div>

<div class="admin-card" style="margin-bottom:20px">
  <div class="admin-card-header">
    <h3 class="admin-card-title">Modelos 3D guardados ({{ $usuario->modelos3d->count() }})</h3>
  </div>
  <div class="admin-card-body" style="padding:0">
    <table class="admin-table">
      <thead>
        <tr><th>Nombre</th><th>Categoría</th><th>Favorito</th></tr>
      </thead>
      <tbody>
        @forelse($usuario->modelos3d as $m)
        <tr>
          <td>{{ $m->nombre }}</td>
          <td>{{ $m->categoria }}</td>
          <td><span class="badge badge-{{ $m->favorito ? 'si' : 'no' }}">{{ $m->favorito ? 'Sí' : 'No' }}</span></td>
        </tr>
        @empty
        <tr><td colspan="3" style="text-align:center;color:var(--a-muted);padding:30px">Sin modelos guardados.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div class="admin-card">
  <div class="admin-card-header">
    <h3 class="admin-card-title">Tests realizados ({{ $usuario->tests->count() }})</h3>
  </div>
  <div class="admin-card-body" style="padding:0">
    <table class="admin-table">
      <thead>
        <tr><th>Tipo</th><th>Resultado</th><th>Fecha</th></tr>
      </thead>
      <tbody>
        @forelse($usuario->tests as $t)
        @php
          $tipo = $t->resultado['tipo'] ?? 'diagnostico';
          if ($tipo === 'ishihara') {
              $tipoLabel = 'Ishihara';
              $tituloResultado = $t->resultado['resultado_ia']['titulo']
                  ?? (isset($t->resultado['aciertos'], $t->resultado['total_laminas'])
                      ? $t->resultado['aciertos'] . ' de ' . $t->resultado['total_laminas'] . ' láminas'
                      : 'Test de Ishihara');
          } else {
              $tipoLabel = 'Diagnóstico visual';
              $tituloResultado = $t->resultado['resultadoIA']['titulo'] ?? 'Diagnóstico visual';
          }
        @endphp
        <tr>
          <td>{{ $tipoLabel }}</td>
          <td>{{ $tituloResultado }}</td>
          <td style="color:var(--a-muted)">{{ $t->fecha_realizacion?->format('d/m/Y H:i') ?? '—' }}</td>
        </tr>
        @empty
        <tr><td colspan="3" style="text-align:center;color:var(--a-muted);padding:30px">Sin tests realizados.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<!-- Modal eliminar usuario -->
<div class="confirm-overlay" id="confirmOverlay">
  <div class="confirm-box">
    <div class="confirm-icon">🗑️</div>
    <div class="confirm-title">¿Eliminar usuario?</div>
    <div class="confirm-desc" id="confirmDesc">Esta acción no se puede deshacer.</div>
    <div class="confirm-actions">
      <button onclick="cerrarConfirm()" class="btn btn-ghost">Cancelar</button>
      <form id="confirmForm" method="POST">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-danger">Eliminar</button>
      </form>
    </div>
  </div>
</div>

<!-- Modal eliminar perfil -->
<div class="confirm-overlay" id="confirmOverlayPerfil">
  <div class="confirm-box">
    <div class="confirm-icon">🗑️</div>
    <div class="confirm-title">¿Eliminar perfil visual?</div>
    <div class="confirm-desc">Esta acción no se puede deshacer.</div>
    <div class="confirm-actions">
      <button onclick="cerrarConfirmPerfil()" class="btn btn-ghost">Cancelar</button>
      <form id="confirmFormPerfil" method="POST">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-danger">Eliminar</button>
      </form>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
function confirmarEliminar(url, nombre) {
  document.getElementById('confirmForm').action = url;
  document.getElementById('confirmDesc').textContent = `¿Seguro que deseas eliminar a "${nombre}"?`;
  document.getElementById('confirmOverlay').classList.add('open');
}
function cerrarConfirm() {
  document.getElementById('confirmOverlay').classList.remove('open');
}
document.getElementById('confirmOverlay').addEventListener('click', function(e) {
  if (e.target === this) cerrarConfirm();
});

function confirmarEliminarPerfil(url) {
  document.getElementById('confirmFormPerfil').action = url;
  document.getElementById('confirmOverlayPerfil').classList.add('open');
}
function cerrarConfirmPerfil() {
  document.getElementById('confirmOverlayPerfil').classList.remove('open');
}
document.getElementById('confirmOverlayPerfil').addEventListener('click', function(e) {
  if (e.target === this) cerrarConfirmPerfil();
});
</script>
@endsection
