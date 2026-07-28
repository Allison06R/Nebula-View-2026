<?php

// Catálogo centralizado de opciones de apariencia de perfil.
//
// Los avatares y banners predeterminados son ARCHIVOS DE IMAGEN reales
// que viven en public/images/perfil/avatares y public/images/perfil/banners.
// Ahora mismo son placeholders (degradados generados) -- para poner las
// fotos/banners definitivos, solo reemplaza esos archivos por otros con
// EL MISMO NOMBRE (avatar-1.jpg, banner-1.jpg, etc.), no hace falta tocar
// codigo ni este archivo.

return [

    'avatares' => [
        'avatar-1' => 'Nebulosa',
        'avatar-2' => 'Eclipse',
        'avatar-3' => 'Aurora',
        'avatar-4' => 'Cometa',
        'avatar-5' => 'Iris',
        'avatar-6' => 'Prisma',
        'avatar-7' => 'Lavanda',
        'avatar-8' => 'Coral',
    ],

    'banners' => [
        'banner-1' => 'Nebula violeta',
        'banner-2' => 'Medianoche',
        'banner-3' => 'Atardecer rosa',
        'banner-4' => 'Oceano',
        'banner-5' => 'Aurora boreal',
        'banner-6' => 'Polvo estelar',
    ],

    'marcos' => [
        'ninguno'  => 'Sin marco',
        'anillo'   => 'Anillo degradado',
        'doble'    => 'Anillo doble',
        'brillo'   => 'Brillo cosmico',
        'punteado' => 'Puntos orbitales',
    ],

    'avatares_ruta' => 'images/perfil/avatares',
    'banners_ruta'  => 'images/perfil/banners',

];