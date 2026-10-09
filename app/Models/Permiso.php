<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permiso extends Model
{
    protected $fillable = [
        'nombre',
        'clave',
        'descripcion',
    ];


    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            Rol::class,
            'permiso_rol'
        );
    }
}