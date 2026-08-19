<x-mail::layout>
{{-- Header --}}
<x-slot:header>
<x-mail::header :url="config('app.url')">
<img src="{{ asset('images/logo.png') }}" class="logo" alt="Nebula View" style="max-height:44px;">
</x-mail::header>
</x-slot:header>

{{-- Body --}}
{!! $slot !!}

{{-- Subcopy --}}
@isset($subcopy)
<x-slot:subcopy>
<x-mail::subcopy>
{!! $subcopy !!}
</x-mail::subcopy>
</x-slot:subcopy>
@endisset

{{-- Footer --}}
<x-slot:footer>
<x-mail::footer>
🔮 Nebula View · © {{ date('Y') }}. {{ __('Todos los derechos reservados.') }}
</x-mail::footer>
</x-slot:footer>
</x-mail::layout>