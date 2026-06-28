<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'nombre',
        'apellido',
        'usuario',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    // Relación: un usuario puede tener un perfil visual
    public function perfilVisual()
    {
        return $this->hasOne(PerfilVisual::class, 'usuario_id');
    }
}
