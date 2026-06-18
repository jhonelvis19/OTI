<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoIncidencia extends Model
{
    protected $table = 'tipos_incidencias'; // 👈 IMPORTANTE

    protected $fillable = [
        'nombre'
    ];

    public function informes()
    {
        return $this->belongsToMany(
            Informe::class,
            'informe_tipo_incidencia'
        );
    }
}