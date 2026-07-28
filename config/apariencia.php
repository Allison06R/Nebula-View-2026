<?php

// Catálogo centralizado de opciones de apariencia de perfil.
//
// La foto de perfil y el banner ya NO usan una galería de opciones:
// cada usuario ve un placeholder predeterminado (dibujado por CSS en
// miperfil.css: .mp-avatar-default y .mp-banner-default) hasta que
// sube su propia imagen para reemplazarlo.
//
// El único catálogo que sigue siendo una lista de opciones es el de
// marcos (el borde decorativo alrededor de la foto de perfil).

return [

    'marcos' => [
        'ninguno'  => 'Sin marco',
        'anillo'   => 'Anillo degradado',
        'doble'    => 'Anillo doble',
        'brillo'   => 'Brillo cosmico',
        'punteado' => 'Puntos orbitales',
    ],

];
