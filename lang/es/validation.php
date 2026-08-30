<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Mensajes de validación en español
    |--------------------------------------------------------------------------
    |
    | Cubre las reglas usadas por el registro (Password::min()->mixedCase()
    | ->numbers()->uncompromised()) y las reglas estándar de Laravel más
    | comunes, para que ningún formulario del sitio muestre errores en inglés.
    |
    */

    'accepted'             => 'Debes aceptar :attribute.',
    'accepted_if'          => 'Debes aceptar :attribute cuando :other es :value.',
    'active_url'           => ':attribute no es una URL válida.',
    'after'                => ':attribute debe ser una fecha posterior a :date.',
    'after_or_equal'       => ':attribute debe ser una fecha posterior o igual a :date.',
    'alpha'                => ':attribute solo debe contener letras.',
    'alpha_dash'           => ':attribute solo debe contener letras, números, guiones y guiones bajos.',
    'alpha_num'            => ':attribute solo debe contener letras y números.',
    'array'                => ':attribute debe ser un arreglo.',
    'before'               => ':attribute debe ser una fecha anterior a :date.',
    'before_or_equal'      => ':attribute debe ser una fecha anterior o igual a :date.',
    'between'              => [
        'numeric' => ':attribute debe estar entre :min y :max.',
        'file'    => ':attribute debe pesar entre :min y :max kilobytes.',
        'string'  => ':attribute debe tener entre :min y :max caracteres.',
        'array'   => ':attribute debe tener entre :min y :max elementos.',
    ],
    'boolean'              => ':attribute debe ser verdadero o falso.',
    'confirmed'            => 'La confirmación de :attribute no coincide.',
    'current_password'     => 'La contraseña es incorrecta.',
    'date'                 => ':attribute no es una fecha válida.',
    'date_equals'          => ':attribute debe ser una fecha igual a :date.',
    'date_format'          => ':attribute no coincide con el formato :format.',
    'different'            => ':attribute y :other deben ser diferentes.',
    'digits'               => ':attribute debe tener :digits dígitos.',
    'digits_between'       => ':attribute debe tener entre :min y :max dígitos.',
    'email'                => ':attribute debe ser un correo electrónico válido.',
    'ends_with'            => ':attribute debe terminar con uno de los siguientes valores: :values',
    'exists'               => ':attribute seleccionado no es válido.',
    'file'                 => ':attribute debe ser un archivo.',
    'filled'               => ':attribute no puede estar vacío.',
    'gt'                   => [
        'numeric' => ':attribute debe ser mayor que :value.',
        'file'    => ':attribute debe pesar más de :value kilobytes.',
        'string'  => ':attribute debe tener más de :value caracteres.',
        'array'   => ':attribute debe tener más de :value elementos.',
    ],
    'gte'                  => [
        'numeric' => ':attribute debe ser mayor o igual que :value.',
        'file'    => ':attribute debe pesar :value kilobytes o más.',
        'string'  => ':attribute debe tener :value caracteres o más.',
        'array'   => ':attribute debe tener :value elementos o más.',
    ],
    'image'                => ':attribute debe ser una imagen.',
    'in'                   => ':attribute seleccionado no es válido.',
    'in_array'             => ':attribute no existe en :other.',
    'integer'              => ':attribute debe ser un número entero.',
    'ip'                   => ':attribute debe ser una dirección IP válida.',
    'ipv4'                 => ':attribute debe ser una dirección IPv4 válida.',
    'ipv6'                 => ':attribute debe ser una dirección IPv6 válida.',
    'json'                 => ':attribute debe ser una cadena JSON válida.',
    'lt'                   => [
        'numeric' => ':attribute debe ser menor que :value.',
        'file'    => ':attribute debe pesar menos de :value kilobytes.',
        'string'  => ':attribute debe tener menos de :value caracteres.',
        'array'   => ':attribute debe tener menos de :value elementos.',
    ],
    'lte'                  => [
        'numeric' => ':attribute debe ser menor o igual que :value.',
        'file'    => ':attribute debe pesar :value kilobytes o menos.',
        'string'  => ':attribute debe tener :value caracteres o menos.',
        'array'   => ':attribute no debe tener más de :value elementos.',
    ],
    'max'                  => [
        'numeric' => ':attribute no debe ser mayor que :max.',
        'file'    => ':attribute no debe pesar más de :max kilobytes.',
        'string'  => ':attribute no debe tener más de :max caracteres.',
        'array'   => ':attribute no debe tener más de :max elementos.',
    ],
    'mimes'                => ':attribute debe ser un archivo de tipo: :values.',
    'min'                  => [
        'numeric' => ':attribute debe ser al menos :min.',
        'file'    => ':attribute debe pesar al menos :min kilobytes.',
        'string'  => ':attribute debe tener al menos :min caracteres.',
        'array'   => ':attribute debe tener al menos :min elementos.',
    ],
    'not_in'               => ':attribute seleccionado no es válido.',
    'not_regex'            => 'El formato de :attribute no es válido.',
    'numeric'              => ':attribute debe ser un número.',
    'password'             => [
        'letters'       => ':attribute debe contener al menos una letra.',
        'mixed'         => ':attribute debe contener al menos una mayúscula y una minúscula.',
        'numbers'       => ':attribute debe contener al menos un número.',
        'symbols'       => ':attribute debe contener al menos un símbolo.',
        'uncompromised' => 'La :attribute proporcionada aparece en una filtración de datos conocida. Por favor elige otra.',
    ],
    'present'              => ':attribute debe estar presente.',
    'regex'                => 'El formato de :attribute no es válido.',
    'required'             => 'El campo :attribute es obligatorio.',
    'required_if'          => 'El campo :attribute es obligatorio cuando :other es :value.',
    'required_unless'      => 'El campo :attribute es obligatorio a menos que :other esté en :values.',
    'required_with'        => 'El campo :attribute es obligatorio cuando :values está presente.',
    'required_without'     => 'El campo :attribute es obligatorio cuando :values no está presente.',
    'same'                 => ':attribute y :other deben coincidir.',
    'size'                 => [
        'numeric' => ':attribute debe ser :size.',
        'file'    => ':attribute debe pesar :size kilobytes.',
        'string'  => ':attribute debe tener :size caracteres.',
        'array'   => ':attribute debe contener :size elementos.',
    ],
    'starts_with'          => ':attribute debe comenzar con uno de los siguientes valores: :values',
    'string'               => ':attribute debe ser una cadena de texto.',
    'unique'               => ':attribute ya está en uso.',
    'uploaded'             => ':attribute no se pudo subir.',
    'url'                  => 'El formato de :attribute no es válido.',
    'uuid'                 => ':attribute debe ser un UUID válido.',

    /*
    |--------------------------------------------------------------------------
    | Mensajes personalizados
    |--------------------------------------------------------------------------
    */

    'custom' => [
        // 'campo' => ['regla' => 'mensaje personalizado'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Nombres de atributos en español
    |--------------------------------------------------------------------------
    |
    | Reemplazan el :attribute de arriba con el nombre real del campo tal
    | como lo ve el usuario, en vez del nombre de columna en inglés/crudo.
    |
    */

    'attributes' => [
        'nombre'                  => 'nombre',
        'usuario'                 => 'nombre de usuario',
        'correo'                  => 'correo electrónico',
        'password'                => 'contraseña',
        'password_confirmation'   => 'confirmación de la contraseña',
        'terms'                   => 'términos y condiciones',
        'email'                   => 'correo electrónico',
    ],

];
