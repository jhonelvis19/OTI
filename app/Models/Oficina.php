<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oficina extends Model
{
    protected $fillable = [
        'nombre'
    ];

    public function informes()
    {
        return $this->hasMany(Informe::class);
    }
}