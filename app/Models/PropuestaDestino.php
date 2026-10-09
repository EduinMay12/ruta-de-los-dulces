<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropuestaDestino extends Model
{
    protected $table =
        'propuestas_destinos';

    protected $fillable = [
        'ruta_id',
        'participante_id',
        'destino_id',

        'nombre',
        'descripcion',
        'direccion',

        'latitud',
        'longitud',

        'logo',
        'estado',
    ];


    public function ruta(): BelongsTo
    {
        return $this->belongsTo(
            Ruta::class
        );
    }


    public function participante(): BelongsTo
    {
        return $this->belongsTo(
            Participante::class
        );
    }


    public function destino(): BelongsTo
    {
        return $this->belongsTo(
            Destino::class
        );
    }
}