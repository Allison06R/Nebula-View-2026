<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = 'comentarios';
    protected $primaryKey = 'id_comentario';

    /**
     * Páginas informativas donde se permite comentar. Cualquier "pagina"
     * fuera de esta lista es rechazada por el controlador (404 o 422).
     * Agrega el slug aquí si abres los comentarios en una página nueva.
     */
    public const PAGINAS_PERMITIDAS = [
        'problemas-visuales',
        'salud-visual',
        'habitos',
        'lentes',
        'clinicas',
        'profesionales',
        'rostros',
    ];

    protected $fillable = [
        'id_usuario',
        'pagina',
        'contenido',
        'estado',
        'motivo_rechazo',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}
