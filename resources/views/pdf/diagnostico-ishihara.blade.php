<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<style>
    @page { margin: 28px 34px; }
    body { font-family: DejaVu Sans, sans-serif; color: #2b2140; font-size: 12px; line-height: 1.55; }
    h1, h2, h3 { font-family: DejaVu Sans, sans-serif; margin: 0; }

    .header { background: #2c1250; color: #ffffff; padding: 22px 26px; border-radius: 10px; }
    .header .badge { font-size: 10px; letter-spacing: .04em; color: #d9c6ff; text-transform: uppercase; }
    .header h1 { font-size: 22px; margin-top: 6px; color: #ffffff; }
    .header .sub { font-size: 12px; color: #e6d9ff; margin-top: 4px; }

    .meta-table { width: 100%; margin-top: 16px; border-collapse: collapse; }
    .meta-table td { padding: 6px 0; font-size: 11px; color: #5a4c78; border-bottom: 1px solid #ece3fb; }
    .meta-table td.label { color: #9583b8; width: 140px; }

    .score-box { text-align: center; margin-top: 18px; padding: 14px; background: #f7f3fe; border: 1px solid #ece3fb; border-radius: 10px; }
    .score-box .num { font-size: 30px; font-weight: bold; color: #4c2a86; }
    .score-box .lbl { font-size: 11px; color: #9583b8; }

    .section-title { font-size: 14px; color: #4c2a86; margin-top: 22px; margin-bottom: 8px; border-left: 4px solid #7c3aed; padding-left: 8px; }

    .resumen { background: #f7f3fe; border: 1px solid #ece3fb; border-radius: 8px; padding: 12px 14px; font-size: 11.5px; color: #3d3055; }

    .detalle-table { width: 100%; border-collapse: collapse; margin-top: 6px; }
    .detalle-table td { border: 1px solid #ece3fb; padding: 6px 10px; font-size: 10.5px; }
    .detalle-table td.ok { color: #1a8a4a; font-weight: bold; }
    .detalle-table td.fail { color: #c0152e; font-weight: bold; }

    .consejo { background: #2c1250; color: #f3ecff; border-radius: 8px; padding: 12px 14px; margin-top: 18px; font-size: 11.5px; }
    .consejo strong { color: #d9c6ff; }

    .footer { margin-top: 26px; font-size: 9.5px; color: #9583b8; border-top: 1px solid #ece3fb; padding-top: 10px; }
</style>
</head>
<body>

    @php($datos = $test->resultado ?? [])
    @php($r = $datos['resultado_ia'] ?? [])

    <div class="header">
        <div class="badge">Nebula View · Test de Ishihara</div>
        <h1>{{ $r['titulo'] ?? 'Resultado del test de Ishihara' }}</h1>
        <div class="sub">Interpretación orientativa generada por IA — no es un diagnóstico clínico</div>
    </div>

    <table class="meta-table">
        <tr>
            <td class="label">Paciente</td>
            <td>{{ $usuario->nombre }} ({{ $usuario->correo }})</td>
        </tr>
        <tr>
            <td class="label">Fecha del test</td>
            <td>{{ $test->fecha_realizacion?->format('d/m/Y H:i') ?? '—' }}</td>
        </tr>
        <tr>
            <td class="label">N.º de test</td>
            <td>NV-ISH-{{ str_pad($test->id_test, 6, '0', STR_PAD_LEFT) }}</td>
        </tr>
    </table>

    <div class="score-box">
        <div class="num">{{ $datos['aciertos'] ?? 0 }}/{{ $datos['total_laminas'] ?? 0 }}</div>
        <div class="lbl">láminas correctas</div>
    </div>

    @if(!empty($r['resumen']))
    <div class="section-title">Interpretación general</div>
    <div class="resumen">{{ $r['resumen'] }}</div>
    @endif

    @if(!empty($r['posiblePatron']))
    <div class="section-title">Patrón observado</div>
    <div class="resumen">{{ $r['posiblePatron'] }}</div>
    @endif

    <div class="section-title">Detalle por lámina</div>
    <table class="detalle-table">
        <tr>
            <td><strong>Lámina</strong></td>
            <td><strong>Tu respuesta</strong></td>
            <td><strong>Resultado</strong></td>
        </tr>
        @foreach(($datos['respuestas'] ?? []) as $d)
        <tr>
            <td>{{ $d['id_lamina'] }}</td>
            <td>{{ $d['respuesta'] }}</td>
            <td class="{{ $d['correcta'] ? 'ok' : 'fail' }}">{{ $d['correcta'] ? 'Correcta' : 'Incorrecta' }}</td>
        </tr>
        @endforeach
    </table>

    @if(!empty($r['recomendacion']))
    <div class="consejo">
        <strong>Recomendación:</strong><br>
        {{ $r['recomendacion'] }}
    </div>
    @endif

    <div class="footer">
        Este resultado fue generado con un test de Ishihara orientativo y con apoyo de inteligencia artificial. No reemplaza un examen profesional completo de visión del color realizado por un optometrista u oftalmólogo. Ante cualquier duda sobre tu percepción del color, consulta a un especialista. — Nebula View
    </div>

</body>
</html>
