<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMensaje extends Model
{
    protected $table = 'chat_mensajes';
    protected $primaryKey = 'id_chat_mensaje';

    protected $fillable = [
        'id_usuario',
        'mensaje_usuario',
        'respuesta_bot',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}
