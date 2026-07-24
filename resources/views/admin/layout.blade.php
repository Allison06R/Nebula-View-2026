<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title') · Nebula View Admin</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<link rel="icon" href="/images/favicon%20y%20logo.png" type="image/png">
</head>
<body>

<div class="admin-shell">

  <aside class="admin-sidebar">
    <div class="admin-brand">
      <div class="admin-brand-eye">
        <svg viewBox="0 0 24 24" width="22" height="22" stroke="#C39BD3" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
        </svg>
      </div>
      <div class="admin-brand-text">
        <strong>Nebula View</strong>
        <span>Panel Admin</span>
      </div>
    </div>

    <nav class="admin-nav">
      <span class="admin-nav-label">General</span>
      <a href="{{ route('admin.dashboard') }}" class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <svg class="admin-nav-icon" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/></svg>
        Observatorio
      </a>

      <span class="admin-nav-label">Gestión</span>
      <a href="{{ route('admin.usuarios.index') }}" class="admin-nav-link {{ request()->routeIs('admin.usuarios.*') ? 'active' : '' }}">
        <svg class="admin-nav-icon" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        Usuarios
      </a>
      <a href="{{ route('admin.modelos.index') }}" class="admin-nav-link {{ request()->routeIs('admin.modelos.*') ? 'active' : '' }}">
        <svg class="admin-nav-icon" viewBox="0 0 24 24"><path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"/><circle cx="12" cy="13" r="4"/></svg>
        Modelos 3D
      </a>
      <a href="{{ route('admin.tests.index') }}" class="admin-nav-link {{ request()->routeIs('admin.tests.*') ? 'active' : '' }}">
        <svg class="admin-nav-icon" viewBox="0 0 24 24"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
        Tests
      </a>
    </nav>

    <div class="admin-sidebar-footer">
      <div class="admin-user-chip">
        <div class="admin-user-avatar">{{ strtoupper(substr(auth()->user()->nombre, 0, 1)) }}</div>
        <div class="admin-user-info">
          <strong>{{ auth()->user()->nombre }}</strong>
          <span>@{{ auth()->user()->usuario }}</span>
        </div>
      </div>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="admin-logout-btn" title="Cerrar sesión">
          <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
        </button>
      </form>
    </div>
  </aside>

  <div class="admin-main">
    <header class="admin-topbar">
      <div>
        <div class="admin-page-title">@yield('page-title')</div>
        <div class="admin-page-subtitle">@yield('page-subtitle')</div>
      </div>
      <div class="admin-topbar-actions">
        @yield('topbar-actions')
      </div>
    </header>

    <main class="admin-content">

      @if(session('success'))
        <div class="admin-alert admin-alert-success">
          <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
          {{ session('success') }}
        </div>
      @endif

      @if(session('error'))
        <div class="admin-alert admin-alert-error">
          <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          {{ session('error') }}
        </div>
      @endif

      @yield('content')

    </main>
  </div>

</div>

@yield('scripts')

</body>
</html>
