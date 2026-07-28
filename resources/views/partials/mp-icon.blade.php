{{-- Icono SVG simple para los avatares prediseñados. Recibe $icon --}}
@switch($icon ?? '')
  @case('sparkle')
    <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.6"><path d="M12 3l1.8 5.2L19 10l-5.2 1.8L12 17l-1.8-5.2L5 10l5.2-1.8L12 3z"/></svg>
    @break
  @case('moon')
    <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.6"><path d="M20 14.5A8.5 8.5 0 1 1 9.5 4a7 7 0 0 0 10.5 10.5z"/></svg>
    @break
  @case('star')
    <svg viewBox="0 0 24 24" fill="#fff" stroke="none"><path d="M12 2l2.9 6.6L22 9.3l-5 4.9 1.2 7.1L12 17.9 5.8 21.3 7 14.2 2 9.3l7.1-.7L12 2z"/></svg>
    @break
  @case('comet')
    <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.6"><circle cx="17" cy="7" r="3"/><path d="M14.5 9.5L4 20"/><path d="M11 20h4M13 22h-2" stroke-width="1.2"/></svg>
    @break
  @case('eye')
    <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.6"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"/><circle cx="12" cy="12" r="3"/></svg>
    @break
  @case('gem')
    <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.6"><path d="M6 3h12l4 6-10 12L2 9l4-6z"/><path d="M2 9h20M9 3l3 6-3 12M15 3l-3 6 3 12"/></svg>
    @break
  @case('leaf')
    <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.6"><path d="M11 21c6-1 9-6 9-14-8 0-13 3-14 9-1 5 1 5 5 5z"/><path d="M6 16c3-3 8-6 14-8"/></svg>
    @break
  @case('wave')
    <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.6"><path d="M2 15c2-3 4-3 6 0s4 3 6 0 4-3 6 0"/><path d="M2 9c2-3 4-3 6 0s4 3 6 0 4-3 6 0"/></svg>
    @break
  @default
    <svg viewBox="0 0 24 24" fill="#fff"><circle cx="12" cy="12" r="4"/></svg>
@endswitch
