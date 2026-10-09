<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ruta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'tipo',
        'fecha_inicio',
        'fecha_fin',
        'activa',
        'mensaje',
        'usuario_id',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'activa' => 'boolean',
    ];

    public function destinos()
    {
        return $this->hasMany(Destino::class)
            ->orderBy('orden');
    }

    public function propuestas(): HasMany
    {
        return $this->hasMany(
            PropuestaDestino::class
        );
    }
}