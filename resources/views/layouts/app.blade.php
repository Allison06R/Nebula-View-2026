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
<link rel="icon" href="/images/favicon%20y%20logo.png" type="image/png"></head>
<body>

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
<a href="{{ route('test') }}" class="{{ request()->routeIs('test') ? 'active' : '' }}">
  <span class="d-link">
    <svg class="d-icon" viewBox="0 0 24 24">
      <path d="M9 2h6"/>
      <path d="M12 2v6"/>
      <path d="M6 22h12l-4-9 2-4H8l2 4-4 9Z"/>
    </svg>
    Test
  </span>
  <span class="d-arr">›</span>
</a>
      <a href="{{ route('modelos3d') }}" class="{{ request()->routeIs('modelos3d') ? 'active' : '' }}">
        <span class="d-link">
          <svg class="d-icon" viewBox="0 0 24 24"><path d="M3 7h18l-1.5 12.5a2 2 0 0 1-2 1.5H6.5a2 2 0 0 1-2-1.5L3 7Z"/><path d="M8 7V5a4 4 0 0 1 8 0v2"/></svg>
          Tienda / Modelos 3D
        </span>
        <span class="d-arr">›</span>
      </a>
      <a href="{{ route('lentes') }}" class="{{ request()->routeIs('lentes') ? 'active' : '' }}">
  <span class="d-link">
    <svg class="d-icon" viewBox="0 0 24 24">
      <circle cx="6" cy="14" r="3.2"/>
      <circle cx="18" cy="14" r="3.2"/>
      <path d="M9.2 14h5.6"/>
      <path d="M2.8 14 4 9c.3-1 1-1.6 2-1.6h.5"/>
      <path d="M21.2 14 20 9c-.3-1-1-1.6-2-1.6h-.5"/>
    </svg>
    Lentes
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

   <a href="{{ route('sobrenosotras') }}" class="{{ request()->routeIs('sobrenosotras') ? 'active' : '' }}">
    <span class="d-link">
      <svg class="d-icon" viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><path d="M2 21v-1a6 6 0 0 1 12 0v1"/><circle cx="17" cy="9" r="2.5"/><path d="M15.5 21v-1a5 5 0 0 1 6-4.9"/></svg>
      Sobre Nosotras
    </span>
    <span class="d-arr">›</span>
  </a>
    </nav>

  <div class="drawer-divider" style="margin: 8px 16px;"></div>

    {{-- Botones de sesión dentro del drawer --}}
    <nav class="drawer-nav" style="padding-top: 0;">
      @auth
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

   
    <div class="drawer-footer">
      <p>¿Necesitas ayuda?<br><strong>Contáctanos en cualquier momento</strong></p>
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
    @auth
      <a href="{{ route('logout') }}"
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
         class="nav-session-link">
        Cerrar sesión
      </a>
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
</nav>

@yield('content')

<!-- FOOTER -->
<footer style="background:#1A0A2E;color:rgba(255,255,255,0.7);padding:50px 60px 28px;font-family:'DM Sans',sans-serif;">
  <div style="display:grid;grid-template-columns:1.4fr 1fr 1fr 1.2fr;gap:40px;margin-bottom:30px;">
    <div>
      <span style="font-family:'Playfair Display',serif;font-size:20px;color:white;font-weight:700;display:block;margin-bottom:14px;">Nebula View 👁</span>
      <p style="font-size:13px;line-height:1.7;color:rgba(255,255,255,0.6);max-width:280px;margin:0 0 14px;">Tu destino de confianza para lentes de calidad y cuidado visual.</p>
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
</script>

@yield('scripts')
</body>
</html>