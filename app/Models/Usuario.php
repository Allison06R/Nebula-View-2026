<?php
 
namespace App\Models;
 
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
 
class Usuario extends Authenticatable
{
    use Notifiable;
 
    // Nombre real de la tabla
    protected $table = 'usuario';
 
    // Tu PK es "id_usuario"
    protected $primaryKey = 'id_usuario';
 
    // Si la tabla no tiene created_at / updated_at, desactiva timestamps
    public $timestamps = false;
 
    protected $fillable = [
        'id_admin',
        'usuario',
        'correo',
        'contrasena',
        'nombre',
        'apellido',
        'rol',
        'sesion',
    ];
 
    protected $hidden = [
        'contrasena',
    ];
 
    // Laravel busca "password" por defecto para auth; le decimos
    // que el campo real es "contrasena"
    public function getAuthPassword()
    {
        return $this->contrasena;
    }
}