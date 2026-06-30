<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modelo3d extends Model
{
    protected $table = 'modelos_3d';
    protected $primaryKey = 'id_modelo3d';

    protected $fillable = [
        'id_usuario', 'nombre', 'categoria', 'favorito'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}