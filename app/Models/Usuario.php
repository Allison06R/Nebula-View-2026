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
        'avatar_custom',
        'marco_perfil',
        'banner_custom',
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

    /**
     * URL de la foto de perfil subida por el usuario.
     * Si no ha subido ninguna, esto es null y la vista dibuja
     * el avatar predeterminado (placeholder CSS).
     */
    public function getAvatarUrlAttribute(): ?string
    {
        return $this->avatar_custom ? asset('storage/' . $this->avatar_custom) : null;
    }

    /**
     * URL del banner de perfil subido por el usuario.
     * Si no ha subido ninguno, esto es null y la vista dibuja
     * el banner predeterminado (placeholder CSS).
     */
    public function getBannerUrlAttribute(): ?string
    {
        return $this->banner_custom ? asset('storage/' . $this->banner_custom) : null;
    }
}