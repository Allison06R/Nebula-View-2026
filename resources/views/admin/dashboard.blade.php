@extends('admin.layout')
@section('title', 'Dashboard')
@section('page-title', 'Observatorio')
@section('page-subtitle', 'Vista general del sistema Nebula View')

@section('topbar-actions')
  <a href="{{ route('admin.usuarios.create') }}" class="btn btn-primary">
    <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    Nuevo usuario
  </a>
@endsection

@section('content')

<div class="admin-stats-grid">
  <div class="admin-stat-card" style="--a-stat-color:rgba(107,47,160,0.22)">
    <div class="admin-stat-top">
      <div class="admin-stat-label">Total Usuarios</div>
      <div class="admin-stat-icon-chip"><svg class="custom-icon" aria-hidden="true"><use href="#icon-personas"></use></svg></div>
    </div>
    <div class="admin-stat-value">{{ $totalUsuarios }}</div>
    <div class="admin-stat-sub">
      <span class="stat-trend stat-trend-flat">{{ $adminsCount }} admin{{ $adminsCount == 1 ? '' : 's' }}</span>
      {{ $usuariosCount }} usuario(s) estándar
    </div>
  </div>
  <div class="admin-stat-card" style="--a-stat-color:rgba(46,204,113,0.18)">
    <div class="admin-stat-top">
      <div class="admin-stat-label">Perfiles Visuales</div>
      <div class="admin-stat-icon-chip"><svg class="custom-icon" aria-hidden="true"><use href="#icon-ojo"></use></svg></div>
    </div>
    <div class="admin-stat-value">{{ $totalPerfiles }}</div>
    <div class="admin-stat-sub">
      <span class="stat-trend {{ $perfilesSemana > 0 ? 'stat-trend-up' : 'stat-trend-flat' }}">
        @if($perfilesSemana > 0)<svg viewBox="0 0 24 24"><polyline points="18 15 12 9 6 15"/></svg>@endif
        +{{ $perfilesSemana }}
      </span>
      esta semana
    </div>
  </div>
  <div class="admin-stat-card" style="--a-stat-color:rgba(52,152,219,0.18)">
    <div class="admin-stat-top">
      <div class="admin-stat-label">Modelos 3D</div>
      <div class="admin-stat-icon-chip"><svg class="hand-icon" width="20" height="20"><use href="#icon-aviator"></use></svg></div>
    </div>
    <div class="admin-stat-value">{{ $totalModelos }}</div>
    <div class="admin-stat-sub">
      <span class="stat-trend {{ $modelosSemana > 0 ? 'stat-trend-up' : 'stat-trend-flat' }}">
        @if($modelosSemana > 0)<svg viewBox="0 0 24 24"><polyline points="18 15 12 9 6 15"/></svg>@endif
        +{{ $modelosSemana }}
      </span>
      esta semana
    </div>
  </div>
  <div class="admin-stat-card" style="--a-stat-color:rgba(243,156,18,0.18)">
    <div class="admin-stat-top">
      <div class="admin-stat-label">Tests realizados</div>
      <div class="admin-stat-icon-chip"><svg class="hand-icon" width="20" height="20"><use href="#icon-nota"></use></svg></div>
    </div>
    <div class="admin-stat-value">{{ $totalTests }}</div>
    <div class="admin-stat-sub">
      <span class="stat-trend {{ $testsSemana > 0 ? 'stat-trend-up' : 'stat-trend-flat' }}">
        @if($testsSemana > 0)<svg viewBox="0 0 24 24"><polyline points="18 15 12 9 6 15"/></svg>@endif
        +{{ $testsSemana }}
      </span>
      esta semana
    </div>
  </div>
</div>

<div class="admin-card">
  <div class="admin-card-header">
    <h3 class="admin-card-title">Usuarios recientes</h3>
    <a href="{{ route('admin.usuarios.index') }}" class="btn btn-ghost btn-sm">Ver todos</a>
  </div>
  <div class="admin-card-body" style="padding:0">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Usuario</th>
          <th>Correo</th>
          <th>Rol</th>
          <th>ID</th>
        </tr>
      </thead>
      <tbody>
        @forelse($recientes as $u)
        <tr>
          <td>
            <div class="admin-user-row">
              <div class="admin-user-row-avatar">{{ strtoupper(substr($u->nombre, 0, 1)) }}</div>
              <div>
                <div class="admin-user-row-name">{{ $u->nombre }}</div>
                <div class="admin-user-row-sub">{{ '@'.$u->usuario }}</div>              </div>
            </div>
          </td>
          <td style="color:var(--a-muted);font-size:12.5px">{{ $u->correo }}</td>
          <td><span class="badge badge-{{ $u->rol }}">{{ ucfirst($u->rol) }}</span></td>
          <td style="color:var(--a-muted);font-size:12px">#{{ $u->id_usuario }}</td>
        </tr>
        @empty
        <tr><td colspan="4" style="text-align:center;color:var(--a-muted);padding:30px">No hay usuarios aún.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@endsection