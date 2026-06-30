<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Admin') · Nebula View</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>
<div class="admin-shell">

  <!-- SIDEBAR -->
  <aside class="admin-sidebar">
    <div class="admin-brand">
      <div class="admin-brand-eye">
        <svg viewBox="0 0 40 40" width="28" height="28">
          <ellipse cx="20" cy="20" rx="17" ry="11" fill="none" stroke="#C39BD3" stroke-width="1.5"/>
          <circle cx="20" cy="20" r="7" fill="#9B59B6"/>
          <circle cx="20" cy="20" r="3" fill="#1A0A2E"/>
          <circle cx="22.5" cy="17.5" r="1.3" fill="#fff" opacity="0.8"/>
        </svg>
      </div>
      <div class="admin-brand-text">
        <strong>Nebula View</strong>
        <span>Panel Admin</span>
      </div>
    </div>

    <nav class="admin-nav">
      <div class="admin-nav-label">General</div>
      <a href="{{ route('admin.dashboard') }}" class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <svg viewBox="0 0 24 24" class="admin-nav-icon"><rect x="3" y="3" width="7" height="9" rx="1.5"/><rect x="14" y="3" width="7" height="5" rx="1.5"/><rect x="14" y="12" width="7" height="9" rx="1.5"/><rect x="3" y="16" width="7" height="5" rx="1.5"/></svg>
        Dashboard
      </a>

      <div class="admin-nav-label">Gestión</div>
      <a href="{{ route('admin.usuarios.index') }}" class="admin-nav-link {{ request()->routeIs('admin.usuarios.*') ? 'active' : '' }}">
        <svg viewBox="0 0 24 24" class="admin-nav-icon"><circle cx="9" cy="7" r="4"/><path d="M2 21v-2a6 6 0 0 1 6-6h2a6 6 0 0 1 6 6v2"/><circle cx="19" cy="8" r="2.5"/><path d="M16.5 21v-1.5a3.5 3.5 0 0 1 3-3.46"/></svg>
        Usuarios
      </a>
      <a href="{{ route('admin.modelos.index') }}" class="admin-nav-link {{ request()->routeIs('admin.modelos.*') ? 'active' : '' }}">
        <svg viewBox="0 0 24 24" class="admin-nav-icon"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
        Modelos 3D
      </a>
      <a href="{{ route('admin.tests.index') }}" class="admin-nav-link {{ request()->routeIs('admin.tests.*') ? 'active' : '' }}">
        <svg viewBox="0 0 24 24" class="admin-nav-icon"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
        Tests
      </a>

      <div class="admin-nav-label">Sitio</div>
      <a href="{{ route('home') }}" class="admin-nav-link" target="_blank">
        <svg viewBox="0 0 24 24" class="admin-nav-icon"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
        Ver sitio
      </a>
    </nav>

    <div class="admin-sidebar-footer">
      <div class="admin-user-chip">
        <div class="admin-user-avatar">A</div>
        <div class="admin-user-info">
          <strong>Administrador</strong>
          <span>Nebula View</span>
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

  <!-- MAIN -->
  <div class="admin-main">
    <header class="admin-topbar">
      <div>
        <h1 class="admin-page-title">@yield('page-title', 'Dashboard')</h1>
        @hasSection('page-subtitle')
          <p class="admin-page-subtitle">@yield('page-subtitle')</p>
        @endif
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