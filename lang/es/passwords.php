<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Mensajes del sistema de restablecimiento de contraseña
    |--------------------------------------------------------------------------
    |
    | Traducción de los estados que devuelve el Password broker de Laravel
    | (Illuminate\Support\Facades\Password::sendResetLink / ::reset), usados
    | en PasswordResetController.
    |
    */

    'reset'     => 'Tu contraseña se ha restablecido correctamente.',
    'sent'      => 'Te enviamos un enlace para restablecer tu contraseña por correo electrónico.',
    'throttled' => 'Por favor espera antes de volver a intentarlo.',
    'token'     => 'El enlace para restablecer la contraseña no es válido o ya expiró.',
    'user'      => 'No encontramos ningún usuario con ese correo electrónico.',

];
