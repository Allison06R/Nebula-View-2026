<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerfilVisual extends Model
{
    protected $table = 'perfil_visual';

    protected $fillable = [
        'usuario_id',
        'edad',
        'sexo',
        'ocupacion',
        'cara',
        'sintomas',
        'frecuencia',
        'desde_tiempo',
        'problema',
        'lentes',
        'revision',
        'pantalla',
        'dispositivos',
        'regla',
        'uv',
        'sueno',
    ];

    // Relación inversa
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
