<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
    public function index()
    {
        // Por defecto redirigiremos a la primera pestaña "perfil"
        return redirect()->route('configuraciones.perfil.edit');
    }
}
