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
        'avatar_tipo',
        'avatar_preset',
        'avatar_custom',
        'marco_perfil',
        'banner_perfil',
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
     * URL de la foto de perfil si el usuario subió una foto propia.
     * Si usa un avatar prediseñado (preset), esto es null y la vista
     * dibuja el avatar con CSS/SVG usando avatar_preset.
     */
    public function getAvatarUrlAttribute(): ?string
    {
        if ($this->avatar_tipo === 'custom' && $this->avatar_custom) {
            return asset($this->avatar_custom);
        }
        return null;
    }
}