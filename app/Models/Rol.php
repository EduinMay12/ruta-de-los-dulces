<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Rol extends Model
{
    protected $table =
        'roles';

    protected $fillable = [
        'nombre',
        'clave',
        'descripcion',
    ];


    public function usuarios(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'rol_usuario'
        );
    }


    public function permisos(): BelongsToMany
    {
        return $this->belongsToMany(
            Permiso::class,
            'permiso_rol'
        );
    }
}