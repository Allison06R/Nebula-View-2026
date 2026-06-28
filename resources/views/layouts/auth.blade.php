<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Nebula View')</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&family=Syne:wght@700;800&display=swap" rel="stylesheet">
@yield('css')
<link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
</head>
<body>

<!-- MOBILE MENU -->
<div class="mobile-menu" id="mobileMenu">
  <div class="mobile-menu-backdrop" id="menuBackdrop"></div>
  <div class="mobile-menu-drawer">
    <div class="drawer-header">
      <a href="{{ route('home') }}" class="drawer-logo">
        <div><img src="{{ asset('images/logo.png') }}" width="47px"></div> Nebula View
      </a>
      <button class="drawer-close" id="drawerClose" aria-label="Cerrar menú">
        <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
    </div>
    <nav class="drawer-nav">
      <a href="{{ route('home') }}">Home<span class="d-arr">›</span></a>
      <a href="{{ route('problemas-visuales') }}">Problemas visuales<span class="d-arr">›</span></a>
      <a href="{{ route('salud-visual') }}">Salud Visual<span class="d-arr">›</span></a>
      <a href="{{ route('habitos') }}">Hábitos<span class="d-arr">›</span></a>
      <a href="{{ route('modelos3d') }}">Tienda/Modelos 3D<span class="d-arr">›</span></a>
      <a href="{{ route('profesionales') }}">Profesionales<span class="d-arr">›</span></a>
      <a href="{{ route('clinicas') }}">Clínicas<span class="d-arr">›</span></a>
    </nav>
    <nav class="drawer-nav">
      @auth
        <form method="POST" action="{{ route('logout') }}" style="margin:0">
          @csrf
          <button type="submit" style="background:none;border:none;cursor:pointer;width:100%;text-align:left;padding:0;color:inherit;font:inherit;">
            Cerrar sesión<span class="d-arr">›</span>
          </button>
        </form>
      @else
        <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">Inicio de Sesión<span class="d-arr">›</span></a>
        <a href="{{ route('registro') }}" class="{{ request()->routeIs('registro') ? 'active' : '' }}">Registro<span class="d-arr">›</span></a>
      @endauth
    </nav>
    <div class="drawer-divider"></div>
    <div class="drawer-footer">
      <p>¿Necesitas ayuda?<br><strong>Contáctanos en cualquier momento</strong></p>
    </div>
  </div>
</div>

<!-- NAV -->
<nav id="navbar">
  <a href="{{ route('home') }}" class="logo">
    <div><img src="{{ asset('images/logo.png') }}" width="36px"></div> Nebula View
  </a>
  <button class="ham-btn" id="hamBtn" aria-label="Abrir menú">
    <div class="ham-line"></div>
    <div class="ham-line"></div>
    <div class="ham-line"></div>
  </button>
</nav>

@yield('content')

<footer>
  <div class="footer-grid">
    <div>
      <span class="footer-logo">Nebula View 👁</span>
      <p class="footer-desc">Tu destino de confianza para lentes de calidad y cuidado visual.</p>
      <p class="footer-address">info@nebulaview.com</p>
    </div>
    <div class="footer-col">
      <h4>Links</h4>
      <ul>
        <li><a href="{{ route('home') }}">Inicio</a></li>
        <li><a href="{{ route('salud-visual') }}">Salud Visual</a></li>
        <li><a href="{{ route('modelos3d') }}">Catálogo</a></li>
        <li><a href="{{ route('profesionales') }}">Profesionales</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Help</h4>
      <ul>
        <li><a href="#">Ayuda en línea</a></li>
        <li><a href="#">Política de privacidad</a></li>
        <li><a href="#">Términos</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Newsletter</h4>
      <p style="font-size:13px;margin-bottom:10px;color:rgba(255,255,255,0.6)">Recibe lo último sobre cuidado visual.</p>
      <div class="newsletter-form">
        <input type="email" placeholder="Tu correo electrónico">
        <button>Suscribir</button>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <span>© 2026 Nebula View. Todos los derechos reservados.</span>
    <span>Hecho con 💜 para tu visión</span>
  </div>
</footer>

<script>
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => navbar.classList.toggle('scrolled', window.scrollY > 30));
const hamBtn = document.getElementById('hamBtn');
const mobileMenu = document.getElementById('mobileMenu');
const menuBackdrop = document.getElementById('menuBackdrop');
const drawerCloseBtn = document.getElementById('drawerClose');
function openMenu()  { mobileMenu.classList.add('open');    hamBtn.classList.add('open');    document.body.style.overflow='hidden'; }
function closeMenu() { mobileMenu.classList.remove('open'); hamBtn.classList.remove('open'); document.body.style.overflow=''; }
hamBtn.addEventListener('click', () => mobileMenu.classList.contains('open') ? closeMenu() : openMenu());
drawerCloseBtn.addEventListener('click', closeMenu);
menuBackdrop.addEventListener('click', closeMenu);
document.addEventListener('keydown', e => { if(e.key==='Escape') closeMenu(); });
</script>

@yield('scripts')
</body>
</html>