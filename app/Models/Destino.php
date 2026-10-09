<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destino extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'direccion',
        'logo',
        'latitud',
        'longitud',
        'abierto',
        'orden',
        'ruta_id',
    ];

    protected $casts = [
        'latitud' => 'decimal:7',
        'longitud' => 'decimal:7',
        'abierto' => 'boolean',
    ];

    public function ruta()
    {
        return $this->belongsTo(Ruta::class);
    }
}