<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerfilVisual extends Model
{
    protected $table = 'perfil_visual';
    protected $primaryKey = 'id_perfil_visual';

    protected $fillable = [
        'id_usuario', 'tipo_cara', 'edad', 'sexo',
        'problema_visual', 'sintomas', 'color', 'estetica'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}