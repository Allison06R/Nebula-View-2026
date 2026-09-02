<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title') · Nebula View Admin</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<link rel="icon" href="/images/favicon%20y%20logo.png" type="image/png">
<script>
  (function() {
    var tema = localStorage.getItem('nebula-admin-theme') || 'dark';
    document.documentElement.setAttribute('data-theme', tema);
  })();
</script>
</head>
<body>

<div class="admin-shell">

  <aside class="admin-sidebar">
    <div class="admin-brand">
      <div class="admin-brand-eye">
        <img src="{{ asset('images/logo.png') }}" alt="Nebula View" style="width:100%;height:100%;object-fit:contain;">
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
      <a href="{{ route('admin.comentarios.index') }}" class="admin-nav-link {{ request()->routeIs('admin.comentarios.*') ? 'active' : '' }}">
        <svg class="admin-nav-icon" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        Comentarios
      </a>
    </nav>

    <div class="admin-sidebar-footer">
      <div class="admin-user-chip">
        <div class="admin-user-avatar">{{ strtoupper(substr(auth()->user()->nombre, 0, 1)) }}</div>
        <div class="admin-user-info">
          <strong>{{ auth()->user()->nombre }}</strong>
          <span>{{ '@'.auth()->user()->usuario }}</span>
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
        <a href="{{ route('home') }}" class="btn btn-ghost btn-sm">
          <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="M16 17l5-5-5-5"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
          Volver al sitio
        </a>
        <button type="button" id="themeToggle" class="btn btn-ghost btn-sm" title="Cambiar tema" onclick="toggleTema()">
          <svg id="themeIconMoon" viewBox="0 0 24 24"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
          <svg id="themeIconSun" viewBox="0 0 24 24" style="display:none"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
        </button>
        <button type="button" id="langToggle" class="btn btn-ghost btn-sm" title="Cambiar idioma">
          {{ app()->getLocale() === 'es' ? 'EN' : 'ES' }}
        </button>
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

<script src="{{ asset('js/translator.js') }}"></script>

<script>
  function toggleTema() {
    var actual = document.documentElement.getAttribute('data-theme') || 'dark';
    var nuevo = actual === 'dark' ? 'light' : 'dark';
    document.documentElement.setAttribute('data-theme', nuevo);
    localStorage.setItem('nebula-admin-theme', nuevo);
    actualizarIconoTema(nuevo);
  }
  function actualizarIconoTema(tema) {
    document.getElementById('themeIconMoon').style.display = tema === 'dark' ? 'block' : 'none';
    document.getElementById('themeIconSun').style.display  = tema === 'light' ? 'block' : 'none';
  }
  actualizarIconoTema(document.documentElement.getAttribute('data-theme') || 'dark');
</script>

</body>
</html>