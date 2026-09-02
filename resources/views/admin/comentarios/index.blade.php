@extends('admin.layout')
@section('title', 'Comentarios')
@section('page-title', 'Comentarios')
@section('page-subtitle', 'Comentarios en páginas informativas, moderados por IA')

@section('content')

<form method="GET" action="{{ route('admin.comentarios.index') }}">
  <div class="admin-filters">
    <div class="admin-search-wrap">
      <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar en el contenido..." class="admin-search-input">
    </div>

    <select name="pagina" class="admin-form-select" style="width:180px" onchange="this.form.submit()">
      <option value="">Todas las páginas</option>
      @foreach($paginas as $p)
        <option value="{{ $p }}" {{ request('pagina') === $p ? 'selected' : '' }}>{{ $p }}</option>
      @endforeach
    </select>

    <select name="estado" class="admin-form-select" style="width:190px" onchange="this.form.submit()">
      <option value="">Todos los estados</option>
      <option value="aprobado" {{ request('estado') === 'aprobado' ? 'selected' : '' }}>Aprobado</option>
      <option value="rechazado" {{ request('estado') === 'rechazado' ? 'selected' : '' }}>Rechazado</option>
      <option value="pendiente_revision" {{ request('estado') === 'pendiente_revision' ? 'selected' : '' }}>Pendiente de revisión</option>
    </select>

    <button type="submit" class="btn btn-ghost">Filtrar</button>
    @if(request()->anyFilled(['buscar', 'pagina', 'estado']))
      <a href="{{ route('admin.comentarios.index') }}" class="btn btn-ghost">Limpiar</a>
    @endif
  </div>
</form>

<div class="admin-card">
  <div class="admin-card-header">
    <h3 class="admin-card-title">{{ $comentarios->total() }} comentario(s)</h3>
  </div>
  <table class="admin-table">
    <thead>
      <tr>
        <th>Usuario</th>
        <th>Página</th>
        <th>Comentario</th>
        <th>Estado</th>
        <th>Fecha</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @forelse($comentarios as $c)
      <tr>
        <td>{{ $c->usuario->nombre ?? 'Usuario eliminado' }}</td>
        <td style="color:var(--a-muted);font-size:12.5px">{{ $c->pagina }}</td>
        <td style="max-width:340px">
          {{ \Illuminate\Support\Str::limit($c->contenido, 140) }}
          @if($c->motivo_rechazo)
            <div style="color:#E74C3C;font-size:12px;margin-top:4px">Motivo: {{ $c->motivo_rechazo }}</div>
          @endif
        </td>
        <td>
          @if($c->estado === 'aprobado')
            <span class="badge badge-si">Aprobado</span>
          @elseif($c->estado === 'rechazado')
            <span class="badge badge-no">Rechazado</span>
          @else
            <span class="badge badge-pendiente">Pendiente</span>
          @endif
        </td>
        <td style="color:var(--a-muted);font-size:12.5px">{{ $c->created_at->format('d/m/Y H:i') }}</td>
        <td>
          <div style="display:flex;gap:6px;flex-wrap:wrap">
            @if($c->estado !== 'aprobado')
              <form method="POST" action="{{ route('admin.comentarios.aprobar', $c->id_comentario) }}">
                @csrf @method('PUT')
                <button type="submit" class="btn btn-ghost btn-sm">Aprobar</button>
              </form>
            @endif
            @if($c->estado !== 'rechazado')
              <form method="POST" action="{{ route('admin.comentarios.rechazar', $c->id_comentario) }}">
                @csrf @method('PUT')
                <button type="submit" class="btn btn-ghost btn-sm">Rechazar</button>
              </form>
            @endif
            <form method="POST" action="{{ route('admin.comentarios.destroy', $c->id_comentario) }}" onsubmit="return confirm('¿Eliminar este comentario definitivamente?')">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
            </form>
          </div>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="6" style="text-align:center;color:var(--a-muted)">No hay comentarios que coincidan con el filtro.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
  <div style="margin-top:14px">{{ $comentarios->links() }}</div>
</div>

@endsection
