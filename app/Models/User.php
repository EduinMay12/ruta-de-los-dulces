<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'activo' => 'boolean',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            Rol::class,
            'rol_usuario'
        );
    }

    public function tieneRol(string $rol): bool
    {
        return $this->roles()
            ->where('clave', $rol)
            ->exists();
    }

    public function tienePermiso(string $permiso): bool
    {
        return $this->roles()
            ->whereHas('permisos', function ($query) use ($permiso) {

                $query->where(
                    'clave',
                    $permiso
                );

            })
            ->exists();
    }

    public function esSuperAdmin(): bool
    {
        return $this->tieneRol('superadmin');
    }

}
