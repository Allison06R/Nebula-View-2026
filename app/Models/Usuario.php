<?php
 
namespace App\Models;
 
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
 
class Usuario extends Authenticatable implements CanResetPassword
{
    use Notifiable, CanResetPasswordTrait;

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
        'banner_tipo',
        'banner_custom',
    ];
 
    protected $hidden = [
        'contrasena',
    ];
 
    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    /**
     * El broker de reseteo de contraseña de Laravel busca por defecto
     * la columna "email"; esta tabla usa "correo", así que se sobrescribe.
     */
    public function getEmailForPasswordReset()
    {
        return $this->correo;
    }

    /**
     * El sistema de notificaciones de Laravel busca por defecto el atributo
     * "email" para saber a quién enviar el correo. Como esta tabla usa
     * "correo", sin esto el envío fallaba en silencio (sin excepción).
     */
    public function routeNotificationForMail($notification = null)
    {
        return $this->correo;
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

    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'id_usuario', 'id_usuario');
    }

    /**
     * URL de la foto de perfil a mostrar.
     * - Si avatar_tipo es 'custom' y hay un archivo subido -> esa imagen.
     * - Si avatar_tipo es 'preset' -> la imagen de la galería
     *   (config/apariencia.php) que el usuario eligió.
     * - Si no hay nada configurado -> null y la vista dibuja el
     *   placeholder predeterminado.
     */
    public function getAvatarUrlAttribute(): ?string
    {
        if ($this->avatar_tipo === 'custom' && $this->avatar_custom) {
            return asset('storage/' . $this->avatar_custom);
        }

        $archivo = config("apariencia.avatares.{$this->avatar_preset}.archivo");
        return $archivo ? asset($archivo) : null;
    }

    public function getBannerUrlAttribute(): ?string
    {
        if ($this->banner_tipo === 'custom' && $this->banner_custom) {
            return asset('storage/' . $this->banner_custom);
        }

        return null;
    }

   
    public function getBannerGradientAttribute(): ?string
    {
        if ($this->banner_tipo === 'custom') {
            return null;
        }

        return config("apariencia.banners.{$this->banner_perfil}.gradiente");
    }
}