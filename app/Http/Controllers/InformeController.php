<?php

namespace App\Http\Controllers;
use App\Models\Informe;
use Illuminate\Http\Request;

class InformeController extends Controller
{
    public function index()
    {
        $informes = Informe::latest()->get();

        return view('admin.informes.index', compact('informes'));
    }
    
    public function show(Informe $informe)
    {
    return view('admin.informes.show', compact('informe'));
    }

    public function create()
    {
        return view('admin.informes.create');
    }

    public function store(Request $request)
{
    Informe::create([

        // AUTOMÁTICOS
        'codigo_informe' => 'INF-' . rand(1000, 9999),

        'fecha' => now()->toDateString(),

        'hora_inicio' => now()->format('H:i:s'),

        'user_id' => auth()->id(),

        // DATOS DEL ATENDIDO
        'nombre_atendido' => $request->nombre_atendido,

        'dni_atendido' => $request->dni_atendido,

        // UBICACIÓN
        'sede_id' => $request->sede_id,

        'persona_atendida' => $request->persona_atendida,

        // EQUIPO
        'codigo_patrimonial' => $request->codigo_patrimonial,

        'tipo_equipo_id' => $request->tipo_equipo_id,

        'marca' => $request->marca,

        'modelo' => $request->modelo,

        'serie' => $request->serie,

        'numero_equipos' => $request->numero_equipos,

        // DESCRIPCIÓN
        'descripcion_problema' => $request->descripcion_problema,

        'resolucion_tecnica' => $request->resolucion_tecnica,

        'observaciones' => $request->observaciones,

        // DEFAULTS
        'solucionado' => true,

        'brindaron_facilidad' => false,

    ]);

    return redirect('/admin/informes')
        ->with('success', 'Informe registrado correctamente');
}
}