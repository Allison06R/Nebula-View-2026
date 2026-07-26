@extends('admin.layout')
@section('title', 'Tests')
@section('page-title', 'Tests')
@section('page-subtitle', 'Diagnósticos realizados por los usuarios')

@section('content')

<form method="GET" action="{{ route('admin.tests.index') }}">
  <div class="admin-filters">
    <div class="admin-search-wrap">
      <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar por nombre de usuario..." class="admin-search-input">
    </div>
    <button type="submit" class="btn btn-ghost">Filtrar</button>
    @if(request('buscar'))
      <a href="{{ route('admin.tests.index') }}" class="btn btn-ghost">Limpiar</a>
    @endif
  </div>
</form>

<div class="admin-card">
  <div class="admin-card-header">
    <h3 class="admin-card-title">{{ $tests->total() }} test(s)</h3>
  </div>
  <table class="admin-table">
    <thead>
      <tr>
        <th>Usuario</th>
        <th>Resultado</th>
        <th>Fecha de realización</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @forelse($tests as $t)
      <tr>
        <td>
          @if($t->usuario)
            <div class="admin-user-row">
              <div class="admin-user-row-avatar">{{ strtoupper(substr($t->usuario->nombre, 0, 1)) }}</div>
              <div>
                <div class="admin-user-row-name">{{ $t->usuario->nombre }}</div>
                <div class="admin-user-row-sub">{{ '@'.$t->usuario->usuario }}</div>
              </div>
            </div>
          @else
            <span style="color:var(--a-muted);font-size:12px">— Sin usuario</span>
          @endif
        </td>
        <td style="color:var(--a-muted);font-size:12.5px;max-width:320px">{{ Str::limit($t->resultado, 100) }}</td>
        <td style="color:var(--a-muted);font-size:12px">{{ $t->fecha_realizacion?->format('d/m/Y H:i') ?? '—' }}</td>
        <td>
          <button onclick="confirmarEliminar('{{ route('admin.tests.destroy', $t) }}')" class="btn btn-danger btn-sm" title="Eliminar">
            <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
          </button>
        </td>
      </tr>
      @empty
      <tr><td colspan="4" style="text-align:center;color:var(--a-muted);padding:40px">No se encontraron tests.</td></tr>
      @endforelse
    </tbody>
  </table>

  @if($tests->hasPages())
    <div class="admin-pagination">
      @if($tests->onFirstPage()) <span>‹</span> @else <a href="{{ $tests->previousPageUrl() }}">‹</a> @endif
      @foreach($tests->getUrlRange(1, $tests->lastPage()) as $page => $url)
        @if($page == $tests->currentPage())
          <span class="active-page">{{ $page }}</span>
        @else
          <a href="{{ $url }}">{{ $page }}</a>
        @endif
      @endforeach
      @if($tests->hasMorePages()) <a href="{{ $tests->nextPageUrl() }}">›</a> @else <span>›</span> @endif
    </div>
  @endif
</div>

<div class="confirm-overlay" id="confirmOverlay">
  <div class="confirm-box">
    <div class="confirm-icon">🗑️</div>
    <div class="confirm-title">¿Eliminar test?</div>
    <div class="confirm-desc">Esta acción no se puede deshacer.</div>
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
function confirmarEliminar(url) {
  document.getElementById('confirmForm').action = url;
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
