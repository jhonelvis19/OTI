<?php

namespace App\Models;

use App\Models\Informe;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'apellido',
        'email',
        'rol',
        'password',
        'firma',
        'firma_actualizada_en',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'firma_actualizada_en' => 'datetime',
        ];
    }

    // RELACIÓN CON INFORMES
    public function informes()
    {
        return $this->hasMany(Informe::class);
    }
}