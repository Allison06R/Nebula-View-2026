<?php

// Catálogo centralizado de opciones de apariencia de perfil.
//
// El usuario puede ELEGIR su foto de perfil y su banner entre una
// galería de opciones predeterminadas, o bien SUBIR su propia imagen
// (se guarda en storage/app/public y la ruta queda en la BD, columnas
// avatar_custom / banner_custom de la tabla usuario). Cuál de las dos
// fuentes se muestra lo indican avatar_tipo / banner_tipo ('preset' o
// 'custom').

return [

    'marcos' => [
        'ninguno'  => 'Sin marco',
        'anillo'   => 'Anillo degradado',
        'doble'    => 'Anillo doble',
        'brillo'   => 'Brillo cosmico',
        'punteado' => 'Puntos orbitales',
    ],

    // Galería de fotos de perfil predeterminadas. La ruta es relativa
    // a /public (se resuelve con asset()).
    'avatares' => [
        'avatar-1' => [
            'nombre'  => 'Nebulita',
            'archivo' => 'images/avatares/avatar-1.png',
        ],
        'avatar-2' => [
            'nombre'  => 'Explorador',
            'archivo' => 'images/avatares/avatar-2.png',
        ],
        'avatar-3' => [
            'nombre'  => 'Exploradora',
            'archivo' => 'images/avatares/avatar-3.png',
        ],
    ],

    // Galería de banners predeterminados. Son degradados CSS (no
    // requieren archivo de imagen) que respetan la paleta de la marca.
    'banners' => [
        'banner-1' => [
            'nombre'    => 'Nébula',
            'gradiente' => 'linear-gradient(135deg,#6B2FA0,#9B59B6,#D946EF)',
        ],
        'banner-2' => [
            'nombre'    => 'Medianoche',
            'gradiente' => 'linear-gradient(135deg,#1e1b4b,#6B2FA0,#C39BD3)',
        ],
        'banner-3' => [
            'nombre'    => 'Aurora',
            'gradiente' => 'linear-gradient(135deg,#9B59B6,#E91E8C,#C39BD3)',
        ],
        'banner-4' => [
            'nombre'    => 'Atardecer cósmico',
            'gradiente' => 'linear-gradient(135deg,#E91E8C,#9B59B6,#6B2FA0)',
        ],
    ],

];
