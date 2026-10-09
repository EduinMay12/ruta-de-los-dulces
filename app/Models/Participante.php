<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Participante extends Model
{
    protected $fillable = [
        'codigo',
        'nombre',
        'telefono',
        'email',
        'acepta_privacidad',
    ];

    protected $casts = [
        'acepta_privacidad' => 'boolean',
    ];


    protected static function booted(): void
    {
        static::creating(function ($participante) {

            do {

                $codigo =
                    'DST-' .
                    strtoupper(Str::random(8));

            } while (
                self::where('codigo', $codigo)->exists()
            );

            $participante->codigo = $codigo;
        });
    }


    public function propuestas(): HasMany
    {
        return $this->hasMany(
            PropuestaDestino::class
        );
    }
}