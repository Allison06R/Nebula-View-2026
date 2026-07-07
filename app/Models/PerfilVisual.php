<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerfilVisual extends Model
{
    protected $table = 'perfil_visual';
    protected $primaryKey = 'id_perfil_visual';
    protected $guarded = [];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}