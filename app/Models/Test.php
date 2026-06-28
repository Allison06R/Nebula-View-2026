<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table = 'tests';
    protected $primaryKey = 'id_test';

    protected $fillable = [
        'id_usuario', 'id_admin', 'resultado', 'fecha_realizacion'
    ];

    protected $casts = [
        'fecha_realizacion' => 'datetime',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}