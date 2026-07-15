<?php

namespace App\Http\Controllers;

use App\Models\Informe;
use App\Models\Oficina;
use App\Models\Sede;
use App\Models\TipoEquipo;
use App\Models\TipoIncidencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class InformeController extends Controller

{
    public function index()
    {
        $informes = Informe::latest()->get();

        return view('admin.informes.index', compact('informes'));
    }
      
    public function pdf(Informe $informe)
{
    // SI ES USUARIO NORMAL
    if(auth()->user()->rol === 'usuario') {

        // SOLO PUEDE VER SUS INFORMES
        if($informe->user_id !== auth()->id()) {

            abort(403, 'No tienes permisos');
        }
    }

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
        'admin.informes.pdf',
        compact('informe')
    );

    return $pdf->stream(
        $informe->codigo_informe . '.pdf'
    );
} 
    public function downloadPdf(Informe $informe)
    {
    $pdf = Pdf::loadView('admin.informes.pdf', compact('informe'));

    return $pdf->download($informe->codigo_informe . '.pdf');
    }

public function create()
{
    $oficinas = Oficina::all();
    $sedes = Sede::all();
    $tiposEquipos = TipoEquipo::all();
    $tiposIncidencias = TipoIncidencia::all();

    $oficinaOtrosId = Oficina::where('nombre', 'Otros')->value('id');
    $tipoEquipoOtrosId = TipoEquipo::where('nombre', 'Otros')->value('id');

    return view('admin.informes.create', compact(
        'oficinas',
        'sedes',
        'tiposEquipos',
        'tiposIncidencias',
        'oficinaOtrosId',
        'tipoEquipoOtrosId'
    ));
}  


    //  STORE
public function store(Request $request)
{
    $oficinaOtrosId = Oficina::where('nombre', 'Otros')->value('id');
    $tipoEquipoOtrosId = TipoEquipo::where('nombre', 'Otros')->value('id');

    $request->validate([

        'nombre_atendido' => 'required|string|max:255',
        'dni_atendido' => 'required|digits:8',

        'sede_id' => 'required',

        'oficina_id' => 'required',

        'otra_oficina' => $request->oficina_id == $oficinaOtrosId
            ? 'required|string|max:255'
            : 'nullable|string|max:255',

        'persona_atendida' => 'required|string|max:255',

        'tipo_equipo_id' => 'required',

        'otro_equipo' => $request->tipo_equipo_id == $tipoEquipoOtrosId
            ? 'required|string|max:255'
            : 'nullable|string|max:255',

        'codigo_patrimonial' => 'required|string|max:255',

        'marca' => 'required|string|max:255',

        'modelo' => 'required|string|max:255',

        'descripcion_problema' => 'required|string',

        'observaciones' => 'required|string',

    ], [

        'nombre_atendido.required' => 'Debe ingresar el nombre del atendido.',
        'dni_atendido.required' => 'Debe ingresar el DNI.',
        'dni_atendido.digits' => 'El DNI debe tener 8 dígitos.',

        'sede_id.required' => 'Debe seleccionar una sede.',

        'oficina_id.required' => 'Debe seleccionar una oficina.',
        'otra_oficina.required' => 'Debe escribir el nombre de la nueva oficina.',

        'persona_atendida.required' => 'Debe indicar la persona atendida.',

        'tipo_equipo_id.required' => 'Debe seleccionar un tipo de equipo.',
        'otro_equipo.required' => 'Debe especificar el tipo de equipo.',

        'codigo_patrimonial.required' => 'Debe ingresar el código patrimonial del equipo.',

        'marca.required' => 'Debe ingresar la marca del equipo.',
        'modelo.required' => 'Debe ingresar el modelo del equipo.',

        'descripcion_problema.required' => 'Debe ingresar la descripción del problema.',

        'observaciones.required' => 'Debe ingresar las observaciones.',
    ]);

    return DB::transaction(function () use ($request) {

        $ultimo = Informe::whereNotNull('codigo_informe')
            ->lockForUpdate()
            ->orderByDesc('id')
            ->first();

        $numero = 1000;

        if ($ultimo && $ultimo->codigo_informe) {
            $numero = (int) str_replace('INF-', '', $ultimo->codigo_informe);
        }

        $numero++;

        $codigo = 'INF-' . str_pad($numero, 4, '0', STR_PAD_LEFT);

        $informe = Informe::create([

            'codigo_informe' => $codigo,
            'fecha' => now()->toDateString(),
            'hora_inicio' => now()->format('H:i:s'),

            'user_id' => auth()->id(),

            'nombre_atendido' => $request->nombre_atendido,
            'dni_atendido' => $request->dni_atendido,

            'sede_id' => $request->sede_id,

            'oficina_id' => $request->oficina_id,
            'otra_oficina' => $request->otra_oficina,

            'persona_atendida' => $request->persona_atendida,

            'codigo_patrimonial' => $request->codigo_patrimonial,

            'tipo_equipo_id' => $request->tipo_equipo_id,
            'otro_equipo' => $request->otro_equipo,

            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'serie' => $request->serie,

            'numero_equipos' => $request->numero_equipos,

            'descripcion_problema' => $request->descripcion_problema,

            'resolucion_tecnica' => $request->resolucion_tecnica,

            'observaciones' => $request->observaciones,

            'solucionado' => true,
            'brindaron_facilidad' => true,
        ]);

        $informe->tiposIncidencias()->attach($request->tipo_incidencia_id);

        return redirect(
            auth()->user()->rol == 'admin'
                ? '/admin/informes'
                : '/usuario/informes'
        )->with('success', 'Informe registrado correctamente');
    });
}
    
    // MIS INFORMES USUARIO
    public function misInformes()
    {
        $informes = Informe::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view(
            'usuario.informes.index',
            compact('informes')
        );
    }

    // SHOW

    public function show(Informe $informe)
        {
        if (
            auth()->user()->rol === 'usuario' &&
            $informe->user_id != auth()->id()
        ) {
            abort(403, 'No tienes permisos');
        }

        return view('usuario.informes.show', compact('informe'));
        }


        public function edit(Informe $informe)
        {
            if ($informe->user_id != auth()->id()) {
                abort(403, 'No tienes permisos');
            }

            $oficinas = Oficina::all();
            $sedes = Sede::all();
            $tiposEquipos = TipoEquipo::all();
            $tiposIncidencias = TipoIncidencia::all();

            return view(
                'admin.informes.create',
                compact(
                    'informe',
                    'oficinas',
                    'sedes',
                    'tiposEquipos',
                    'tiposIncidencias'
                )
            );
        }

        //MIS INFORMES ADMIN
        public function misInformesAdmin()
        {
            $informes = Informe::where('user_id', auth()->id())
                ->latest()
                ->get();

            return view(
                'admin.informes.mis_informes',
                compact('informes')
            );
        }
    
    
    // UPDATE
    public function update(Request $request, Informe $informe)
    {
        if ($informe->user_id != auth()->id()) {
            abort(403, 'No tienes permisos');
        }

        $informe->update([

            'nombre_atendido' => $request->nombre_atendido,
            'dni_atendido' => $request->dni_atendido,

            'sede_id' => $request->sede_id,

            'oficina_id' => $request->oficina_id,
            'otra_oficina' => $request->otra_oficina,

            'persona_atendida' => $request->persona_atendida,

            'codigo_patrimonial' => $request->codigo_patrimonial,

            'tipo_equipo_id' => $request->tipo_equipo_id,

            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'serie' => $request->serie,

            'numero_equipos' => $request->numero_equipos,

            'descripcion_problema' => $request->descripcion_problema,
            'resolucion_tecnica' => $request->resolucion_tecnica,

            'observaciones' => $request->observaciones,
        ]);

        $informe->tiposIncidencias()
            ->sync($request->tipo_incidencia_id);

        return redirect()->back()
            ->with('success', 'Informe actualizado correctamente');
    }

}