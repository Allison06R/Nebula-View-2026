<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestIshihara extends Model
{
    protected $table = 'tests_ishihara';
    protected $primaryKey = 'id_test_ishihara';

    protected $fillable = [
        'id_usuario', 'aciertos', 'total_laminas', 'respuestas', 'resultado_ia', 'fecha_realizacion',
    ];

    protected $casts = [
        'fecha_realizacion' => 'datetime',
        'respuestas'        => 'array',
        'resultado_ia'      => 'array',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}
