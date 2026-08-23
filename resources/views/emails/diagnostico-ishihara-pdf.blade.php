@component('mail::message')
# Tu resultado del test de Ishihara está listo 🎨

Hola{{ $usuario->nombre ? ', ' . $usuario->nombre : '' }},

Adjunto encontrarás el PDF con tu resultado del test de Ishihara realizado el **{{ $test->fecha_realizacion->format('d/m/Y') }}**: acertaste **{{ $aciertos }} de {{ $total }}** láminas.

El documento incluye la interpretación orientativa de la IA y el detalle lámina por lámina.

@component('mail::button', ['url' => route('test-ishihara')])
Repetir el test
@endcomponent

@component('mail::panel')
⚠️ Recuerda: este test es orientativo y no reemplaza un examen profesional completo de visión del color realizado por un optometrista u oftalmólogo.
@endcomponent

— El equipo de Nebula View
@endcomponent
