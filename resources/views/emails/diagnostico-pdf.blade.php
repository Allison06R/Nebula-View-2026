@component('mail::message')
# Tu diagnóstico está listo 🔮

Hola{{ $usuario->nombre ? ', ' . $usuario->nombre : '' }},

Adjunto encontrarás el PDF con el diagnóstico de tu test visual realizado el **{{ $test->fecha_realizacion->format('d/m/Y') }}**: *{{ $titulo }}*.

El documento incluye tus resultados por condición, los lentes recomendados y el plan semanal de hábitos que te sugirió nuestra IA.

@component('mail::button', ['url' => route('test')])
Hacer un nuevo test
@endcomponent

@component('mail::panel')
⚠️ Recuerda: este diagnóstico es orientativo y no reemplaza la consulta con un profesional de la salud visual.
@endcomponent

— El equipo de Nebula View
@endcomponent