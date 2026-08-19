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

    .section-title { font-size: 14px; color: #4c2a86; margin-top: 22px; margin-bottom: 8px; border-left: 4px solid #7c3aed; padding-left: 8px; }

    .analisis { background: #f7f3fe; border: 1px solid #ece3fb; border-radius: 8px; padding: 12px 14px; font-size: 11.5px; color: #3d3055; }

    .cond-table, .lentes-table, .plan-table { width: 100%; border-collapse: collapse; margin-top: 6px; }
    .cond-table td, .lentes-table td, .plan-table td {
        border: 1px solid #ece3fb; padding: 8px 10px; font-size: 11px; vertical-align: top;
    }
    .cond-table td.nombre, .lentes-table td.nombre { font-weight: bold; color: #4c2a86; width: 150px; }
    .cond-table td.sev { width: 60px; text-align: center; font-weight: bold; }
    .sev-alta  { color: #c0152e; }
    .sev-media { color: #b9740c; }
    .sev-baja  { color: #1a8a4a; }

    .plan-table td.dia { font-weight: bold; color: #7c3aed; width: 55px; }

    .scores-table { width: 100%; border-collapse: collapse; margin-top: 6px; }
    .scores-table td { padding: 5px 8px; font-size: 11px; border-bottom: 1px solid #ece3fb; }
    .scores-table td.val { text-align: right; font-weight: bold; color: #4c2a86; width: 60px; }

    .consejo { background: #2c1250; color: #f3ecff; border-radius: 8px; padding: 12px 14px; margin-top: 18px; font-size: 11.5px; }
    .consejo strong { color: #d9c6ff; }

    .footer { margin-top: 26px; font-size: 9.5px; color: #9583b8; border-top: 1px solid #ece3fb; padding-top: 10px; }
</style>
</head>
<body>

    <div class="header">
        <div class="badge">Nebula View · Diagnóstico visual con IA</div>
        <h1>{{ $resultado['titulo'] ?? 'Diagnóstico visual' }}</h1>
        <div class="sub">{{ $resultado['subtitulo'] ?? '' }}</div>
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
            <td class="label">N.º de diagnóstico</td>
            <td>NV-{{ str_pad($test->id_test, 6, '0', STR_PAD_LEFT) }}</td>
        </tr>
    </table>

    @if(!empty($resultado['analisis']))
    <div class="section-title">Análisis general</div>
    <div class="analisis">{{ $resultado['analisis'] }}</div>
    @endif

    @if(!empty($scores))
    <div class="section-title">Indicadores por condición</div>
    <table class="scores-table">
        @php
            $etiquetas = [
                'mP' => 'Miopía', 'hP' => 'Hipermetropía', 'aP' => 'Astigmatismo',
                'fP' => 'Fatiga digital', 'uP' => 'Riesgo UV', 'sP' => 'Déficit de sueño',
            ];
        @endphp
        @foreach($etiquetas as $clave => $nombre)
            @if(isset($scores[$clave]))
            <tr>
                <td>{{ $nombre }}</td>
                <td class="val">{{ $scores[$clave] }}%</td>
            </tr>
            @endif
        @endforeach
    </table>
    @endif

    @if(!empty($resultado['condiciones']))
    <div class="section-title">Condiciones detectadas</div>
    <table class="cond-table">
        @foreach($resultado['condiciones'] as $c)
        <tr>
            <td class="nombre">{{ $c['icono'] ?? '' }} {{ $c['nombre'] ?? '' }}</td>
            <td class="sev {{ 'sev-' . strtolower($c['severidad'] ?? 'media') }}">{{ $c['severidad'] ?? '' }}</td>
            <td>{{ $c['descripcion'] ?? '' }}</td>
        </tr>
        @endforeach
    </table>
    @endif

    @if(!empty($resultado['lentes']))
    <div class="section-title">Lentes recomendados</div>
    <table class="lentes-table">
        @foreach($resultado['lentes'] as $l)
        <tr>
            <td class="nombre">{{ $l['icono'] ?? '' }} {{ $l['nombre'] ?? '' }}</td>
            <td>{{ $l['desc'] ?? '' }}</td>
        </tr>
        @endforeach
    </table>
    @endif

    @if(!empty($resultado['planSemanal']))
    <div class="section-title">Plan semanal de hábitos</div>
    <table class="plan-table">
        @foreach($resultado['planSemanal'] as $d)
        <tr>
            <td class="dia">{{ $d['dia'] ?? '' }}</td>
            <td><strong>{{ $d['titulo'] ?? '' }}</strong><br>{{ $d['texto'] ?? '' }}</td>
        </tr>
        @endforeach
    </table>
    @endif

    @if(!empty($resultado['consejo']))
    <div class="consejo"><strong>Consejo final:</strong> {{ $resultado['consejo'] }}</div>
    @endif

    <div class="footer">
        Este diagnóstico fue generado con inteligencia artificial a partir de tus respuestas y tiene fines orientativos.
        No reemplaza la evaluación de un profesional de la salud visual. Generado automáticamente por Nebula View el {{ now()->format('d/m/Y H:i') }}.
    </div>

</body>
</html>
