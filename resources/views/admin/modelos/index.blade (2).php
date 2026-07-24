@extends('admin.layout')
@section('title', 'Modelos 3D')
@section('page-title', 'Modelos 3D')
@section('page-subtitle', 'Modelos guardados por los usuarios')

@section('content')

<form method="GET" action="{{ route('admin.modelos.index') }}">
  <div class="admin-filters">
    <div class="admin-search-wrap">
      <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar por nombre del modelo..." class="admin-search-input">
    </div>
    <button type="submit" class="btn btn-ghost">Filtrar</button>
    @if(request('buscar'))
      <a href="{{ route('admin.modelos.index') }}" class="btn btn-ghost">Limpiar</a>
    @endif
  </div>
</form>

<div class="admin-card">
  <div class="admin-card-header">
    <h3 class="admin-card-title">{{ $modelos->total() }} modelo(s)</h3>
  </div>
  <table class="admin-table">
    <thead>
      <tr>
        <th>Modelo</th>
        <th>Categoría</th>
        <th>Favorito</th>
        <th>Usuario</th>
        <th>Guardado</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @forelse($modelos as $m)
      <tr>
        <td>{{ $m->nombre }}</td>
        <td style="color:var(--a-muted);font-size:12.5px">{{ $m->categoria }}</td>
        <td><span class="badge badge-{{ $m->favorito ? 'si' : 'no' }}">{{ $m->favorito ? 'Sí' : 'No' }}</span></td>
        <td>
          @if($m->usuario)
            <div class="admin-user-row">
              <div class="admin-user-row-avatar">{{ strtoupper(substr($m->usuario->nombre, 0, 1)) }}</div>
              <div class="admin-user-row-name">{{ $m->usuario->nombre }}</div>
            </div>
          @else
            <span style="color:var(--a-muted);font-size:12px">— Sin usuario</span>
          @endif
        </td>
        <td style="color:var(--a-muted);font-size:12px">{{ $m->created_at?->format('d/m/Y') ?? '—' }}</td>
        <td>
          <button onclick="confirmarEliminar('{{ route('admin.modelos.destroy', $m) }}','{{ $m->nombre }}')" class="btn btn-danger btn-sm" title="Eliminar">
            <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
          </button>
        </td>
      </tr>
      @empty
      <tr><td colspan="6" style="text-align:center;color:var(--a-muted);padding:40px">No se encontraron modelos.</td></tr>
      @endforelse
    </tbody>
  </table>

  @if($modelos->hasPages())
    <div class="admin-pagination">
      @if($modelos->onFirstPage()) <span>‹</span> @else <a href="{{ $modelos->previousPageUrl() }}">‹</a> @endif
      @foreach($modelos->getUrlRange(1, $modelos->lastPage()) as $page => $url)
        @if($page == $modelos->currentPage())
          <span class="active-page">{{ $page }}</span>
        @else
          <a href="{{ $url }}">{{ $page }}</a>
        @endif
      @endforeach
      @if($modelos->hasMorePages()) <a href="{{ $modelos->nextPageUrl() }}">›</a> @else <span>›</span> @endif
    </div>
  @endif
</div>

<div class="confirm-overlay" id="confirmOverlay">
  <div class="confirm-box">
    <div class="confirm-icon">🗑️</div>
    <div class="confirm-title">¿Eliminar modelo?</div>
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
  document.getElementById('confirmDesc').textContent = `¿Seguro que deseas eliminar "${nombre}"?`;
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
