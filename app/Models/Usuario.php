<?php
 
namespace App\Models;
 
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
 
class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
     public $timestamps = false;
 
    protected $fillable = [
        'id_admin',
        'usuario',
        'correo',
        'contrasena',
        'nombre',
     
        'rol',
        'sesion',
    ];
 
    protected $hidden = [
        'contrasena',
    ];
 
    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    public function perfilVisual()
    {
        return $this->hasOne(PerfilVisual::class, 'id_usuario', 'id_usuario');
    }

    public function modelos3d()
    {
        return $this->hasMany(Modelo3d::class, 'id_usuario', 'id_usuario');
    }

    public function tests()
    {
        return $this->hasMany(Test::class, 'id_usuario', 'id_usuario');
    }
}