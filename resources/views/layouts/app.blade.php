<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Nebula View')</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="{{ asset('css/layout.css') }}" rel="stylesheet">
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
      <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home<span class="d-arr">›</span></a>
      <a href="{{ route('problemas-visuales') }}" class="{{ request()->routeIs('problemas-visuales') ? 'active' : '' }}">Problemas visuales<span class="d-arr">›</span></a>
      <a href="{{ route('salud-visual') }}" class="{{ request()->routeIs('salud-visual') ? 'active' : '' }}">Salud Visual<span class="d-arr">›</span></a>
      <a href="{{ route('habitos') }}" class="{{ request()->routeIs('habitos') ? 'active' : '' }}">Hábitos<span class="d-arr">›</span></a>
      <a href="{{ route('modelos3d') }}" class="{{ request()->routeIs('modelos3d') ? 'active' : '' }}">Tienda/Modelos 3D<span class="d-arr">›</span></a>
      <a href="#">Test<span class="d-arr">›</span></a>
      <a href="{{ route('profesionales') }}" class="{{ request()->routeIs('profesionales') ? 'active' : '' }}">Profesionales<span class="d-arr">›</span></a>
      <a href="{{ route('clinicas') }}" class="{{ request()->routeIs('clinicas') ? 'active' : '' }}">Clínicas<span class="d-arr">›</span></a>
      <a href="{{ route('sobrenosotras') }}" class="{{ request()->routeIs('sobrenosotras') ? 'active' : '' }}">Sobre Nosotras<span class="d-arr">›</span></a>
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
        <a href="{{ route('login') }}">Inicio de Sesión<span class="d-arr">›</span></a>
        <a href="{{ route('registro') }}">Registro<span class="d-arr">›</span></a>
      @endauth
    </nav>
    <div class="drawer-divider"></div>
    <div class="drawer-footer">
      <p>¿Necesitas ayuda?<br><strong>Contáctanos en cualquier momento</strong></p>
    </div>
  </div>
</div>

<!-- MODAL (compartido por todas las páginas) -->
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

<!-- FOOTER -->
<footer style="background:#1A0A2E;color:rgba(255,255,255,0.7);padding:50px 60px 28px;font-family:'DM Sans',sans-serif;">
  <div style="display:grid;grid-template-columns:1.4fr 1fr 1fr 1.2fr;gap:40px;margin-bottom:30px;">
    <div>
      <span style="font-family:'Playfair Display',serif;font-size:20px;color:white;font-weight:700;display:block;margin-bottom:14px;">Nebula View 👁</span>
      <p style="font-size:13px;line-height:1.7;color:rgba(255,255,255,0.6);max-width:280px;margin:0 0 14px;">Tu destino de confianza para lentes de calidad y cuidado visual. Estilo, salud y visión en un solo lugar.</p>
      <p style="font-size:13px;color:rgba(255,255,255,0.5);">info@nebulaview.com</p>
    </div>
    <div>
      <h4 style="font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:white;margin:0 0 14px;">Links</h4>
      <ul style="list-style:none;margin:0;padding:0;display:flex;flex-direction:column;gap:8px;">
        <li><a href="{{ route('home') }}" style="color:rgba(255,255,255,0.6);font-size:13px;text-decoration:none;">Inicio</a></li>
        <li><a href="{{ route('salud-visual') }}" style="color:rgba(255,255,255,0.6);font-size:13px;text-decoration:none;">Salud Visual</a></li>
        <li><a href="{{ route('modelos3d') }}" style="color:rgba(255,255,255,0.6);font-size:13px;text-decoration:none;">Catálogo</a></li>
        <li><a href="{{ route('profesionales') }}" style="color:rgba(255,255,255,0.6);font-size:13px;text-decoration:none;">Profesionales</a></li>
      </ul>
    </div>
    <div>
      <h4 style="font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:white;margin:0 0 14px;">Help</h4>
      <ul style="list-style:none;margin:0;padding:0;display:flex;flex-direction:column;gap:8px;">
        <li><a href="#" style="color:rgba(255,255,255,0.6);font-size:13px;text-decoration:none;">Ayuda en línea</a></li>
        <li><a href="#" style="color:rgba(255,255,255,0.6);font-size:13px;text-decoration:none;">Política de privacidad</a></li>
        <li><a href="#" style="color:rgba(255,255,255,0.6);font-size:13px;text-decoration:none;">Términos</a></li>
      </ul>
    </div>
    <div>
      <h4 style="font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:white;margin:0 0 14px;">Newsletter</h4>
      <p style="font-size:13px;margin:0 0 10px;color:rgba(255,255,255,0.6);">Recibe lo último sobre cuidado visual y nuevas colecciones.</p>
      <div style="display:flex;gap:8px;">
        <input type="email" placeholder="Tu correo electrónico" style="flex:1;padding:10px 14px;border-radius:10px;border:1px solid rgba(255,255,255,0.15);background:rgba(255,255,255,0.06);color:white;font-size:13px;outline:none;">
        <button style="padding:10px 18px;border-radius:10px;border:none;background:linear-gradient(135deg,#9B59B6,#6B2FA0);color:white;font-size:13px;font-weight:600;cursor:pointer;">Suscribir</button>
      </div>
    </div>
  </div>
  <div style="display:flex;justify-content:space-between;align-items:center;font-size:12px;color:rgba(255,255,255,0.35);border-top:1px solid rgba(255,255,255,0.08);padding-top:20px;margin-top:20px;flex-wrap:wrap;gap:10px;">
    <span>© 2026 Nebula View. Todos los derechos reservados.</span>
    <span>Hecho con 💜 para tu visión</span>
  </div>
</footer>

<script>
// NAV scroll
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => navbar.classList.toggle('scrolled', window.scrollY > 30));

// HAMBURGER
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

// REVEAL (scroll animation)
const revealEls = document.querySelectorAll('.reveal');
const obs = new IntersectionObserver(entries => {
  entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: 0.1 });
revealEls.forEach(el => obs.observe(el));

// MODAL (cierre global, compartido por todas las páginas)
const modalOverlayEl = document.getElementById('modalOverlay');
const modalCloseBtn = document.getElementById('modalClose');
if (modalOverlayEl && modalCloseBtn) {
  modalCloseBtn.addEventListener('click', () => {
    modalOverlayEl.classList.remove('open');
    document.body.style.overflow = '';
  });
  modalOverlayEl.addEventListener('click', e => {
    if (e.target === modalOverlayEl) {
      modalOverlayEl.classList.remove('open');
      document.body.style.overflow = '';
    }
  });
}
</script>

@yield('scripts')
</body>
</html>