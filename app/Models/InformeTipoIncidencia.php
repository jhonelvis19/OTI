<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformeTipoIncidencia extends Model
{
    protected $table = 'informe_tipo_incidencia';

    protected $fillable = [
        'informe_id',
        'tipo_incidencia_id'
    ];
}