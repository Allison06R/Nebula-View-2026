<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Administrador extends Authenticatable
{
    protected $table = 'administrador';
    protected $primaryKey = 'id_admin';

    protected $fillable = ['correo', 'contrasena'];
    protected $hidden = ['contrasena'];

    protected $casts = ['contrasena' => 'hashed'];

    public function getAuthPassword()
    {
        return $this->contrasena;
    }
}