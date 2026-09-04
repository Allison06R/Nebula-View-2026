@extends('admin.layout')
@section('title', 'Usuarios')
@section('page-title', 'Usuarios')
@section('page-subtitle', 'Gestión de cuentas')

@section('topbar-actions')
  <a href="{{ route('admin.usuarios.create') }}" class="btn btn-primary">
    <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    Nuevo usuario
  </a>
@endsection

@section('content')

<form method="GET" action="{{ route('admin.usuarios.index') }}">
  <div class="admin-filters">
    <div class="admin-search-wrap">
      <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar por nombre, usuario o correo..." class="admin-search-input">
    </div>
    <select name="rol" class="admin-form-select" style="width:160px">
      <option value="">Todos los roles</option>
      <option value="admin"   {{ request('rol')=='admin'   ? 'selected':'' }}>Administradores</option>
      <option value="usuario" {{ request('rol')=='usuario' ? 'selected':'' }}>Usuarios</option>
    </select>
    <button type="submit" class="btn btn-ghost">Filtrar</button>
    @if(request('buscar') || request('rol'))
      <a href="{{ route('admin.usuarios.index') }}" class="btn btn-ghost">Limpiar</a>
    @endif
  </div>
</form>

<div class="admin-card">
  <div class="admin-card-header">
    <h3 class="admin-card-title">{{ $usuarios->total() }} usuario(s)</h3>
  </div>
  <table class="admin-table">
    <thead>
      <tr>
        <th>Usuario</th>
        <th>Correo</th>
        <th>Rol</th>
        <th>Perfil visual</th>
        <th>ID</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @forelse($usuarios as $u)
      <tr>
        <td>
          <div class="admin-user-row">
            <div class="admin-user-row-avatar">{{ strtoupper(substr($u->nombre, 0, 1)) }}</div>
            <div>
              <div class="admin-user-row-name">{{ $u->nombre }}</div>
             <div class="admin-user-row-sub">{{ '@'.$u->usuario }}</div>
            </div>
          </div>
        </td>
        <td style="color:var(--a-muted);font-size:12.5px">{{ $u->correo }}</td>
        <td><span class="badge badge-{{ $u->rol }}">{{ ucfirst($u->rol) }}</span></td>
        <td>
          @if($u->perfilVisual)
            <span style="color:#2ECC71;font-size:12px">✓ Completo</span>
          @else
            <span style="color:var(--a-muted);font-size:12px">— Sin perfil</span>
          @endif
        </td>
        <td style="color:var(--a-muted);font-size:12px">#{{ $u->id_usuario }}</td>
        <td>
          <div style="display:flex;gap:6px">
            <a href="{{ route('admin.usuarios.show', $u->id_usuario) }}" class="btn btn-ghost btn-sm" title="Ver">
              <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            </a>
            <a href="{{ route('admin.usuarios.edit', $u->id_usuario) }}" class="btn btn-ghost btn-sm" title="Editar">
              <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            </a>
            <button onclick="confirmarEliminar('{{ route('admin.usuarios.destroy', $u->id_usuario) }}','{{ $u->nombre }}')" class="btn btn-danger btn-sm" title="Eliminar">
              <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
            </button>
          </div>
        </td>
      </tr>
      @empty
      <tr><td colspan="6" style="text-align:center;color:var(--a-muted);padding:40px">No se encontraron usuarios.</td></tr>
      @endforelse
    </tbody>
  </table>

  @if($usuarios->hasPages())
    <div class="admin-pagination">
      @if($usuarios->onFirstPage()) <span>‹</span> @else <a href="{{ $usuarios->previousPageUrl() }}">‹</a> @endif
      @foreach($usuarios->getUrlRange(1, $usuarios->lastPage()) as $page => $url)
        @if($page == $usuarios->currentPage())
          <span class="active-page">{{ $page }}</span>
        @else
          <a href="{{ $url }}">{{ $page }}</a>
        @endif
      @endforeach
      @if($usuarios->hasMorePages()) <a href="{{ $usuarios->nextPageUrl() }}">›</a> @else <span>›</span> @endif
    </div>
  @endif
</div>

<!-- Modal eliminar -->
<div class="confirm-overlay" id="confirmOverlay">
  <div class="confirm-box">
    <div class="confirm-icon"><svg class="hand-icon" width="40" height="40" style="stroke-width:1.3"><use href="#icon-papelera"></use></svg></div>
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
</script>
@endsection