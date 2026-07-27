<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Acceso denegado — Nebula View</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="icon" href="{{ asset('images/favicon y logo.png') }}" type="image/png">
<style>
  * { margin:0; padding:0; box-sizing:border-box; }

  body {
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:flex-start;
    font-family:'DM Sans', sans-serif;
    background: url('{{ asset('images/error-bg.jpg') }}') center center / cover no-repeat;
    position:relative;
    overflow:hidden;
  }

  body::before {
    content:"";
    position:absolute;
    inset:0;
    background: linear-gradient(90deg, rgba(13,6,32,0.72) 0%, rgba(26,10,46,0.45) 45%, rgba(26,10,46,0.15) 100%);
    z-index:1;
  }

  .no-acceso-box {
    position:relative;
    z-index:2;
    max-width:520px;
    margin-left:8%;
    padding:44px 40px;
    background: rgba(13, 6, 32, 0.55);
    border:1px solid rgba(155,89,182,0.35);
    border-radius:24px;
    backdrop-filter: blur(6px);
    box-shadow: 0 20px 60px rgba(0,0,0,0.35);
    color:#fff;
  }

  .no-acceso-eyebrow {
    display:inline-block;
    font-size:12px;
    font-weight:600;
    letter-spacing:2.5px;
    text-transform:uppercase;
    color:#D946EF;
    margin-bottom:14px;
  }

  .no-acceso-titulo {
    font-family:'Playfair Display', serif;
    font-weight:900;
    font-size:clamp(28px, 4vw, 40px);
    line-height:1.15;
    margin-bottom:16px;
    color:#fff;
  }

  .no-acceso-titulo span {
    color:#E91E8C;
  }

  .no-acceso-texto {
    font-size:15px;
    line-height:1.7;
    color:rgba(255,255,255,0.75);
    margin-bottom:32px;
  }

  .no-acceso-btn {
    display:inline-flex;
    align-items:center;
    gap:10px;
    padding:14px 28px;
    border-radius:14px;
    border:none;
    background: linear-gradient(135deg,#9B59B6,#6B2FA0);
    color:#fff;
    font-family:'DM Sans', sans-serif;
    font-size:14px;
    font-weight:600;
    letter-spacing:0.3px;
    cursor:pointer;
    text-decoration:none;
    transition: transform .2s ease, box-shadow .2s ease;
    box-shadow: 0 8px 24px rgba(107,47,160,0.35);
  }

  .no-acceso-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(107,47,160,0.5);
  }

  .no-acceso-btn svg {
    width:18px;
    height:18px;
    stroke:#fff;
    fill:none;
    stroke-width:2;
    stroke-linecap:round;
    stroke-linejoin:round;
  }

  @media (max-width: 720px) {
    .no-acceso-box {
      margin: 0 20px;
      max-width: none;
    }
    body { justify-content:center; }
  }
</style>
</head>
<body>

  <div class="no-acceso-box">
    <span class="no-acceso-eyebrow">Nebula View</span>
    <h1 class="no-acceso-titulo"><span>ERROR:</span> no tienes acceso a esta página</h1>
    <p class="no-acceso-texto">
      Esta sección está protegida. Es posible que necesites iniciar sesión o que tu cuenta no tenga los permisos necesarios para verla.
    </p>
    <a href="javascript:void(0);" onclick="if (document.referrer && document.referrer.indexOf(window.location.host) !== -1) { history.back(); } else { window.location.href = '{{ route('home') }}'; }" class="no-acceso-btn">
      <svg viewBox="0 0 24 24"><path d="M19 12H5"/><path d="M12 19l-7-7 7-7"/></svg>
      Regresar
    </a>
  </div>

</body>
</html>