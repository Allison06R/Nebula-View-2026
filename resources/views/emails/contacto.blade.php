<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Nuevo mensaje de contacto</title>
</head>
<body style="margin:0;padding:0;background:#F8F0FF;font-family:'DM Sans',Arial,sans-serif;color:#2D1B4E;">
  <div style="max-width:520px;margin:0 auto;padding:32px 20px;">
    <div style="background:#ffffff;border-radius:20px;padding:32px;box-shadow:0 4px 24px rgba(107,47,160,0.08);">
      <h1 style="font-size:20px;color:#6B2FA0;margin:0 0 4px;">✦ Nuevo mensaje desde Nebula View ✦</h1>
      <p style="font-size:13px;color:#7B6F8A;margin:0 0 24px;">Alguien escribió a través del formulario de "Contáctanos".</p>

      <table style="width:100%;border-collapse:collapse;margin-bottom:20px;">
        <tr>
          <td style="padding:8px 0;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#9B59B6;width:110px;vertical-align:top;">Nombre</td>
          <td style="padding:8px 0;font-size:14px;">{{ $datos['name'] }}</td>
        </tr>
        <tr>
          <td style="padding:8px 0;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#9B59B6;vertical-align:top;">Correo</td>
          <td style="padding:8px 0;font-size:14px;"><a href="mailto:{{ $datos['email'] }}" style="color:#6B2FA0;">{{ $datos['email'] }}</a></td>
        </tr>
      </table>

      <div style="background:#F8F0FF;border-radius:14px;padding:18px 20px;">
        <p style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#9B59B6;margin:0 0 8px;">Mensaje</p>
        <p style="font-size:14px;line-height:1.7;margin:0;white-space:pre-line;">{{ $datos['message'] }}</p>
      </div>

      <p style="font-size:11px;color:#7B6F8A;margin:24px 0 0;">Puedes responder directamente a este correo: se enviará a {{ $datos['email'] }}.</p>
    </div>
  </div>
</body>
</html>
