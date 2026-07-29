<?php

namespace App\Models;
use App\Models\User;
use App\Models\Sede;
use App\Models\Oficina;
use App\Models\TipoEquipo;
use App\Models\TipoIncidencia;

use Illuminate\Database\Eloquent\Model;

class Informe extends Model
{
    protected $fillable = [

        'codigo_informe',
        'fecha',
        'hora_inicio',
        'hora_salida',

        'user_id',

        'nombre_atendido',
        'dni_atendido',

        'sede_id',
        'oficina_id',
        'otra_oficina',

        'persona_atendida',

        'brindaron_facilidad',

        'codigo_patrimonial',

        'tipo_equipo_id',
        'otro_equipo',

        'marca',
        'modelo',
        'serie',

        'numero_equipos',

        'descripcion_problema',

        'resolucion_tecnica',

        'solucionado',

        'motivo_no_solucion',

        'observaciones',

        // CAMPOS DE FIRMAS
        'firma_persona',
        'firma_tecnico',
        'firma_persona_fecha',
        'firma_tecnico_fecha',
        'firma_persona_metodo',
        'firma_tecnico_metodo',
        'firmas_bloqueadas',
    ];

    protected $casts = [
        'firmas_bloqueadas' => 'boolean',
        'firma_persona_fecha' => 'datetime',
        'firma_tecnico_fecha' => 'datetime',
        'solucionado' => 'boolean',
        'brindaron_facilidad' => 'boolean',
    ];

    // USUARIO
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // SEDE
    public function sede()
    {
        return $this->belongsTo(Sede::class);
    }

    // OFICINA
    public function oficina()
    {
        return $this->belongsTo(Oficina::class);
    }

    // TIPO EQUIPO
    public function tipoEquipo()
    {
        return $this->belongsTo(TipoEquipo::class);
    }

    // INCIDENCIAS
    public function tiposIncidencias()
    {
        return $this->belongsToMany(
            TipoIncidencia::class,
            'informe_tipo_incidencia'
        );
    }
}