<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Nebula View')</title>
<link href="{{ asset('css/fonts.css') }}" rel="stylesheet">
<link href="{{ asset('css/icons.css') }}" rel="stylesheet">
<link href="{{ asset('css/theme.css') }}" rel="stylesheet">
<link href="{{ asset('css/layout.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/preloader.css') }}">
<script src="{{ asset('js/translator.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>

@yield('css')
<link rel="icon" href="/images/favicon%20y%20logo.png" type="image/png"></head>
<body>
@include('partials.icons')
@include('layouts.preloader')

{{-- MOBILE MENU DRAWER --}}
<div class="mobile-menu" id="mobileMenu">
  <div class="mobile-menu-backdrop" id="menuBackdrop"></div>
  <div class="mobile-menu-drawer">

    <div class="drawer-header">
      <a href="{{ route('home') }}" class="drawer-logo">
        <img src="{{ asset('images/1000105256.png') }}" width="47px" alt="Logo">
        Nebula View
      </a>
      <button class="drawer-close" id="drawerClose" aria-label="Cerrar menú">
        <svg viewBox="0 0 24 24">
          <line x1="18" y1="6" x2="6" y2="18"/>
          <line x1="6" y1="6" x2="18" y2="18"/>
        </svg>
      </button>
    </div>

    <div class="d-sep"><div class="d-sep-line"></div><span class="d-sep-text">Información</span><div class="d-sep-line"></div></div>
    <nav class="drawer-nav">
      <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
        <span class="d-link">
          <svg class="d-icon" viewBox="0 0 24 24"><path d="M3 11.5 12 4l9 7.5"/><path d="M5 10v9h14v-9"/></svg>
          Home
        </span>
        <span class="d-arr">›</span>
      </a>
      <a href="{{ route('problemas-visuales') }}" class="{{ request()->routeIs('problemas-visuales') ? 'active' : '' }}">
        <span class="d-link">
          <svg class="d-icon" viewBox="0 0 24 24"><path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
          Problemas visuales
        </span>
        <span class="d-arr">›</span>
      </a>

      <a href="{{ route('salud-visual') }}" class="{{ request()->routeIs('salud-visual') ? 'active' : '' }}">
        <span class="d-link">
          <svg class="d-icon" viewBox="0 0 24 24"><path d="M12 21s-7-4.6-9.5-9.1C.7 8.4 2.4 5 6 5c2 0 3.3 1 4 2 .7-1 2-2 4-2 3.6 0 5.3 3.4 3.5 6.9C19 16.4 12 21 12 21Z"/></svg>
          Salud Visual
        </span>
        <span class="d-arr">›</span>
      </a>

      <a href="{{ route('habitos') }}" class="{{ request()->routeIs('habitos') ? 'active' : '' }}">
        <span class="d-link">
          <svg class="d-icon" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 21v-1a8 8 0 0 1 16 0v1"/></svg>
          Hábitos
        </span>
        <span class="d-arr">›</span>
      </a>

      <a href="{{ route('lentes') }}" class="{{ request()->routeIs('lentes') ? 'active' : '' }}">
        <span class="d-link">
          <svg class="d-icon" viewBox="0 0 24 24"><circle cx="6" cy="14" r="3.2"/><circle cx="18" cy="14" r="3.2"/><path d="M9.2 14h5.6"/><path d="M2.8 14 4 9c.3-1 1-1.6 2-1.6h.5"/><path d="M21.2 14 20 9c-.3-1-1-1.6-2-1.6h-.5"/></svg>
          Lentes
        </span>
        <span class="d-arr">›</span>
      </a>

      <a href="{{ route('rostros') }}" class="{{ request()->routeIs('rostros') ? 'active' : '' }}">
        <span class="d-link">
          <svg class="d-icon" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 21v-1a8 8 0 0 1 16 0v1"/></svg>
          Rostros
        </span>
        <span class="d-arr">›</span>
      </a>

      <a href="{{ route('profesionales') }}" class="{{ request()->routeIs('profesionales') ? 'active' : '' }}">
        <span class="d-link">
          <svg class="d-icon" viewBox="0 0 24 24"><rect x="3" y="7" width="18" height="13" rx="2"/><path d="M9 7V5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2"/></svg>
          Profesionales
        </span>
        <span class="d-arr">›</span>
      </a>

      <a href="{{ route('clinicas') }}" class="{{ request()->routeIs('clinicas') ? 'active' : '' }}">
        <span class="d-link">
          <svg class="d-icon" viewBox="0 0 24 24"><path d="M9 2h6"/><path d="M12 2v6"/><path d="M6 22h12l-4-9 2-4H8l2 4-4 9Z"/></svg>
          Clínicas
        </span>
        <span class="d-arr">›</span>
      </a>

      <div class="d-sep"><div class="d-sep-line"></div><span class="d-sep-text">Usuario</span><div class="d-sep-line"></div></div>

      <a href="{{ route('test') }}" class="{{ request()->routeIs('test') ? 'active' : '' }} {{ auth()->guest() ? 'd-locked' : '' }}">
        <span class="d-link">
          <svg class="d-icon" viewBox="0 0 24 24"><path d="M9 2h6"/><path d="M12 2v6"/><path d="M6 22h12l-4-9 2-4H8l2 4-4 9Z"/></svg>
          Test
          @guest
            <span class="d-lock" title="Requiere iniciar sesión">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="4" y="10" width="16" height="10" rx="2"/>
                <path d="M8 10V7a4 4 0 0 1 8 0v3"/>
              </svg>
            </span>
          @endguest
        </span>
        <span class="d-arr">›</span>
      </a>

      <a href="{{ route('modelos3d') }}" class="{{ request()->routeIs('modelos3d') ? 'active' : '' }} {{ auth()->guest() ? 'd-locked' : '' }}">
        <span class="d-link">
          <svg class="d-icon" viewBox="0 0 24 24"><path d="M3 7h18l-1.5 12.5a2 2 0 0 1-2 1.5H6.5a2 2 0 0 1-2-1.5L3 7Z"/><path d="M8 7V5a4 4 0 0 1 8 0v2"/></svg>
          Tienda / Modelos 3D
          @guest
            <span class="d-lock" title="Requiere iniciar sesión">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="4" y="10" width="16" height="10" rx="2"/>
                <path d="M8 10V7a4 4 0 0 1 8 0v3"/>
              </svg>
            </span>
          @endguest
        </span>
        <span class="d-arr">›</span>
      </a>

      <div class="d-sep"><div class="d-sep-line"></div><span class="d-sep-text">Sobre Nebula View</span><div class="d-sep-line"></div></div>
      <a href="{{ route('sobrenosotras') }}" class="{{ request()->routeIs('sobrenosotras') ? 'active' : '' }}">
        <span class="d-link">
          <svg class="d-icon" viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><path d="M2 21v-1a6 6 0 0 1 12 0v1"/><circle cx="17" cy="9" r="2.5"/><path d="M15.5 21v-1a5 5 0 0 1 6-4.9"/></svg>
          Sobre Nosotras
        </span>
        <span class="d-arr">›</span>
      </a>

      <a href="{{ route('faq') }}" class="{{ request()->routeIs('faq') ? 'active' : '' }}">
        <span class="d-link">
          <svg class="d-icon" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M9.5 9.2a2.5 2.5 0 0 1 4.9.8c0 1.7-2.4 1.9-2.4 3.5"/><line x1="12" y1="17" x2="12" y2="17.1"/></svg>
          Preguntas Frecuentes
        </span>
        <span class="d-arr">›</span>
      </a>
      
        
      <a href="{{ route('contactanos') }}" class="{{ request()->routeIs('contactanos') ? 'active' : '' }}">
        <span class="d-link">
          <svg class="d-icon" viewBox="0 0 24 24"><path d="M4 4h16v16H4z"/><path d="m4 6 8 7 8-7"/></svg>
          Contáctanos
        </span>
        <span class="d-arr">›</span>
      </a>

      @auth
      @endauth
    </nav>

    <div class="d-sep"><div class="d-sep-line"></div><span class="d-sep-text">Acciones</span><div class="d-sep-line"></div></div>
    <div class="drawer-divider" style="margin: 8px 16px;"></div>

    {{-- Botones de sesión dentro del drawer --}}
    <nav class="drawer-nav" style="padding-top: 0;">
      @auth

      @if(auth()->user()->rol === 'admin')
      <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.*') ? 'active' : '' }}">
        <span class="d-link">
          <svg class="d-icon" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/></svg>
          Panel Admin
        </span>
        <span class="d-arr">›</span>
      </a>
      @endif

      <a href="{{ route('mi-perfil.show') }}" class="{{ request()->routeIs('mi-perfil.show') ? 'active' : '' }}">
        <span class="d-link">
          <svg class="d-icon" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 21v-1a8 8 0 0 1 16 0v1"/></svg>
          Mi Perfil
        </span>
        <span class="d-arr">›</span>
      </a>
      <a href="{{ route('logout') }}"
         onclick="event.preventDefault(); document.getElementById('logout-drawer-form').submit();">
        <span class="d-link">
          <svg class="d-icon" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="M16 17l5-5-5-5"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
          Cerrar sesión
        </span>
        <span class="d-arr">›</span>
      </a>
      <form id="logout-drawer-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>

      @else
      <a href="{{ route('login') }}">
        <span class="d-link">
          <svg class="d-icon" viewBox="0 0 24 24"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><path d="M10 17l5-5-5-5"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
          Inicio de Sesión
        </span>
        <span class="d-arr">›</span>
      </a>
      <a href="{{ route('registro') }}">
        <span class="d-link">
          <svg class="d-icon" viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>
          Registro
        </span>
        <span class="d-arr">›</span>
      </a>
      @endauth
    </nav>

    {{-- Traducción, modo oscuro y regresar dentro del drawer --}}
    <div style="display:flex; gap:10px; justify-content:center; padding:0 28px 16px;">
      <button class="icon-toggle-btn" id="backBtnMobile" type="button" aria-label="Regresar">
        <svg viewBox="0 0 24 24"><path d="M19 12H5"/><path d="M12 19l-7-7 7-7"/></svg>
      </button>
      <button class="lang-toggle-btn" id="langToggleMobile" type="button">
        {{ app()->getLocale() === 'es' ? 'EN' : 'ES' }}
      </button>
      <x-daynight-toggle id="daynightToggleMobile" />
    </div>

    <div class="drawer-footer">
      <p>¿Ya leíste nuestra Políticas?<br><a href="{{ route('legal') }}"><strong>Política de Privacidad y Créditos</strong></a></p>
    </div>

  </div>
</div>

<!-- MODAL -->
<div class="modal-overlay" id="modalOverlay">
  <div class="modal-box" id="modalBox">
    <div class="modal-header" id="modalHeader">
      <button class="modal-close" id="modalClose" aria-label="Cerrar">
        <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
      <div id="modalHeaderContent"></div>
    </div>
    <div class="modal-body" id="modalBody"></div>
  </div>
</div>

<nav id="navbar">
  <a href="{{ route('home') }}" class="logo">
    <img src="{{ asset('images/1000105256.png') }}" width="36px" alt="Logo">
    Nebula View
  </a>

  <div class="nav-actions">
    <button class="icon-toggle-btn" id="backBtn" type="button" aria-label="Regresar" title="Regresar">
      <svg viewBox="0 0 24 24"><path d="M19 12H5"/><path d="M12 19l-7-7 7-7"/></svg>
    </button>

    <button class="lang-toggle-btn" id="langToggle" type="button">
      {{ app()->getLocale() === 'es' ? 'EN' : 'ES' }}
    </button>

    <x-daynight-toggle id="daynightToggle" />

    @auth
      <div class="nav-user" id="navUser">
        <button class="nav-user-btn" id="navUserBtn" type="button" aria-haspopup="true" aria-expanded="false" aria-label="Cuenta">
          <span class="nav-user-avatar">
            @if(auth()->user()->avatar_url)
              <img src="{{ auth()->user()->avatar_url }}" alt="">
            @else
              <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 21v-1a8 8 0 0 1 16 0v1"/></svg>
            @endif
          </span>
        </button>

        <div class="nav-user-menu" id="navUserMenu">
          <div class="nav-user-menu-header">
            <p class="nav-user-menu-name">{{ auth()->user()->nombre }}</p>
            <p class="nav-user-menu-sub">@ {{ auth()->user()->usuario }}</p>
          </div>
          <div class="nav-user-menu-divider"></div>
          @if(auth()->user()->rol === 'admin')
            <a href="{{ route('admin.dashboard') }}" class="nav-user-menu-item">Panel Admin</a>
          @endif
          <a href="{{ route('mi-perfil.show') }}" class="nav-user-menu-item">Mi Perfil</a>
          <a href="{{ route('preferencias.show') }}" class="nav-user-menu-item">Preferencias</a>
          <div class="nav-user-menu-divider"></div>
          <a href="{{ route('logout') }}"
             onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
             class="nav-user-menu-item nav-user-menu-item--danger">
            Cerrar sesión
          </a>
        </div>
      </div>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
        @csrf
      </form>
    @else
      <a href="{{ route('login') }}" class="nav-session-link">Inicio de Sesión</a>
      <a href="{{ route('registro') }}" class="nav-session-link nav-session-link--btn">Registro</a>
    @endauth
    <button class="ham-btn" id="hamBtn" aria-label="Abrir menú">
      <div class="ham-line"></div>
      <div class="ham-line"></div>
      <div class="ham-line"></div>
    </button>
  </div>

  <div id="scrollProgress"></div>

</nav>

@yield('content')
<!-- FOOTER -->
<footer class="nv-footer">
  <div class="nv-footer-inner">
    <div class="nv-footer-top">
      <div class="nv-footer-brand">
        <span class="nv-footer-logo">Nebula View 👁</span>
        <p>Tu destino de confianza para lentes de calidad y cuidado visual.</p>
      </div>
      <nav class="nv-footer-links">
        <a href="{{ route('home') }}">Inicio</a>
        <a href="{{ route('salud-visual') }}">Salud Visual</a>
        <a href="{{ route('modelos3d') }}">Catálogo</a>
        <a href="{{ route('profesionales') }}">Profesionales</a>
        <a href="{{ route('contactanos') }}">Contáctanos</a>
      </nav>
      <a href="mailto:info@nebulaview.com" class="nv-footer-email">info@nebulaview.com</a>
    </div>
    <div class="nv-footer-bottom">
      <span>© 2026 Nebula View. Todos los derechos reservados.</span>
      <span>Hecho con 💜 para tu visión</span>
    </div>
  </div>
</footer>

<style>
.nv-footer {
  position: relative;
  width: 100%;
  aspect-ratio: 1580 / 593; /* misma proporción que la imagen (ya recortada, sin margen transparente arriba), calculada sobre el propio ancho del footer para evitar líneas por el scrollbar */
  max-height: 640px;
  min-height: 360px;
  padding: 0; /* neutraliza los "footer { padding: ... }" viejos de cada página (test.css, habitos.css, etc.) */
  margin: 0;
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  background: url('{{ asset('images/footer-space-bg.png') }}') no-repeat top center;
  background-size: cover;
  overflow: hidden;
}
.nv-footer::before {
  content: "";
  position: absolute;
  inset: 0;
  background: linear-gradient(to bottom, rgba(26,10,46,0) 0%, rgba(26,10,46,0.45) 55%, rgba(26,10,46,0.93) 100%);
  pointer-events: none;
}
.nv-footer-inner {
  position: relative;
  z-index: 1;
  padding: 0 60px 48px;
  color: rgba(255,255,255,0.9);
  font-family: 'MuseoModerno', sans-serif;
}
.nv-footer-top {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  align-items: flex-start;
  gap: 32px;
  padding-bottom: 32px;
  border-bottom: 1px solid rgba(255,255,255,0.18);
}
.nv-footer-brand { max-width: 380px; }
.nv-footer-logo {
  font-family: 'MuseoModerno', serif;
  font-size: 34px;
  color: #fff;
  font-weight: 700;
  display: block;
  margin-bottom: 14px;
}
.nv-footer-brand p {
  font-size: 17px;
  line-height: 1.7;
  color: rgba(255,255,255,0.85);
  margin: 0;
}
.nv-footer-links {
  display: flex;
  flex-wrap: wrap;
  gap: 14px 30px;
  padding-top: 8px;
}
.nv-footer-links a,
.nv-footer-email {
  color: rgba(255,255,255,0.85);
  font-size: 17px;
  text-decoration: none;
  white-space: nowrap;
  transition: color .15s ease;
}
.nv-footer-links a:hover,
.nv-footer-email:hover { color: #fff; }
.nv-footer-bottom {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 15px;
  color: rgba(255,255,255,0.6);
  padding-top: 26px;
  flex-wrap: wrap;
  gap: 10px;
}
@media (max-width: 720px) {
  .nv-footer {
    aspect-ratio: unset;
    padding: 0;
    min-height: 560px;
    background-position: center top;
  }
  .nv-footer-inner { padding: 0 24px 32px; }
  .nv-footer-top { flex-direction: column; gap: 22px; padding-bottom: 24px; }
  .nv-footer-logo { font-size: 28px; }
  .nv-footer-brand p,
  .nv-footer-links a,
  .nv-footer-email { font-size: 15px; }
}
</style>

<script>
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => navbar.classList.toggle('scrolled', window.scrollY > 30));

const hamBtn = document.getElementById('hamBtn');
const mobileMenu = document.getElementById('mobileMenu');
const menuBackdrop = document.getElementById('menuBackdrop');
const drawerCloseBtn = document.getElementById('drawerClose');
function openMenu()  { mobileMenu.classList.add('open');    hamBtn.classList.add('open');    document.body.style.overflow = 'hidden'; }
function closeMenu() { mobileMenu.classList.remove('open'); hamBtn.classList.remove('open'); document.body.style.overflow = ''; }
hamBtn.addEventListener('click', () => mobileMenu.classList.contains('open') ? closeMenu() : openMenu());
drawerCloseBtn.addEventListener('click', closeMenu);
menuBackdrop.addEventListener('click', closeMenu);
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeMenu(); });

const revealEls = document.querySelectorAll('.reveal');
const obs = new IntersectionObserver(entries => {
  entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: 0.1 });
revealEls.forEach(el => obs.observe(el));

const modalOverlayEl = document.getElementById('modalOverlay');
const modalCloseBtn = document.getElementById('modalClose');
if (modalOverlayEl && modalCloseBtn) {
  modalCloseBtn.addEventListener('click', () => { modalOverlayEl.classList.remove('open'); document.body.style.overflow = ''; });
  modalOverlayEl.addEventListener('click', e => { if (e.target === modalOverlayEl) { modalOverlayEl.classList.remove('open'); document.body.style.overflow = ''; } });
}

/* ══════════════════════════════
   MODO OSCURO — interruptor animado día/noche
══════════════════════════════ */
const rootEl = document.documentElement;
const savedTheme = localStorage.getItem('theme') || 'light';
if (savedTheme === 'dark') rootEl.setAttribute('data-theme', 'dark');

function pintarWidgetDayNight(widget, isDark, animado) {
  const sun   = widget.querySelector('.dn-sun');
  const moon  = widget.querySelector('.dn-moon');
  const cloud = widget.querySelector('.dn-cloud');
  const stars = widget.querySelectorAll('.dn-star');
  const pod   = widget.querySelector('.dn-pod');
  const tw    = animado ? gsap.to : gsap.set;
  const d     = animado ? 1 : 0;

  if (isDark) {
    tw(sun,   {duration: d,       x: -157, opacity: 0, ease: 'power1.inOut'});
    tw(cloud, {duration: d * 0.5, opacity: 0, ease: 'power1.inOut'});
    tw(moon,  {duration: d,       x: -157, rotate: -360, transformOrigin: 'center', opacity: 1, ease: 'power1.inOut'});
    tw(stars, {duration: d * 0.5, opacity: 1, ease: 'power1.inOut'});
    tw(pod,   {duration: d,       background: '#224f6d', borderColor: '#cad4d8', ease: 'power1.inOut'});
  } else {
    tw(sun,   {duration: d,       x: 15, opacity: 1, ease: 'power1.inOut'});
    tw(cloud, {duration: d,       opacity: 1, ease: 'power1.inOut'});
    tw(moon,  {duration: d,       x: 35, rotate: 360, transformOrigin: 'center', opacity: 0, ease: 'power1.inOut'});
    tw(stars, {duration: d,       opacity: 0, ease: 'power1.inOut'});
    tw(pod,   {duration: d,       background: '#9cd6ef', borderColor: '#65c0e7', ease: 'power1.inOut'});
  }
}

function toggleTheme() {
  const isDarkAhora = rootEl.getAttribute('data-theme') === 'dark';
  const irADark = !isDarkAhora;

  if (irADark) {
    rootEl.setAttribute('data-theme', 'dark');
    localStorage.setItem('theme', 'dark');
  } else {
    rootEl.removeAttribute('data-theme');
    localStorage.setItem('theme', 'light');
  }

  document.querySelectorAll('.daynight-toggle').forEach(widget => {
    widget.style.pointerEvents = 'none';
    pintarWidgetDayNight(widget, irADark, true);
    setTimeout(() => { widget.style.pointerEvents = 'all'; }, 1000);
  });
}

document.querySelectorAll('.daynight-toggle').forEach(widget => {
  pintarWidgetDayNight(widget, savedTheme === 'dark', false);
  widget.addEventListener('click', toggleTheme);
});

/* ══════════════════════════════
   BOTÓN "REGRESAR"
   Usa history.back(); como cada página se sirve con Cache-Control:
   no-store (ver PreventBackHistory middleware), el navegador SIEMPRE
   vuelve a pedir la página al servidor en vez de mostrar una copia en
   caché. Si ya cerraste sesión, el middleware "auth" te manda a
   /login en automático — nunca te deja ver una página protegida vieja.
══════════════════════════════ */
function irAtras() {
  if (window.history.length > 1) {
    window.history.back();
  } else {
    window.location.href = "{{ route('home') }}";
  }
}
document.getElementById('backBtn')?.addEventListener('click', irAtras);
document.getElementById('backBtnMobile')?.addEventListener('click', () => { closeMenu(); irAtras(); });

/* ══════════════════════════════
   MENÚ DE USUARIO (navbar)
══════════════════════════════ */
const navUser = document.getElementById('navUser');
const navUserBtn = document.getElementById('navUserBtn');
const navUserMenu = document.getElementById('navUserMenu');

function closeUserMenu() {
  if (!navUser) return;
  navUser.classList.remove('open');
  navUserBtn.setAttribute('aria-expanded', 'false');
}

if (navUserBtn) {
  navUserBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    const isOpen = navUser.classList.toggle('open');
    navUserBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
  });

  document.addEventListener('click', (e) => {
    if (navUser.classList.contains('open') && !navUser.contains(e.target)) {
      closeUserMenu();
    }
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeUserMenu();
  });
}
/* ══════════════════════════════
   BARRA DE PROGRESO DE SCROLL
══════════════════════════════ */
const scrollProgressEl = document.getElementById('scrollProgress');
function updateScrollProgress() {
  const scrollTop = window.scrollY;
  const docHeight = document.documentElement.scrollHeight - window.innerHeight;
  const pct = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
  scrollProgressEl.style.width = pct + '%';
}


window.addEventListener('scroll', updateScrollProgress);
window.addEventListener('resize', updateScrollProgress);
updateScrollProgress();


</script>

<script src="{{ asset('js/preloader.js') }}"></script>


@yield('scripts')

@unless(request()->routeIs('test'))
    @include('components.chatbotwidget')
@endunless

</body>
</html>