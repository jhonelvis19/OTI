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

        return view('admin.informes.create', compact(
            'oficinas',
            'sedes',
            'tiposEquipos',
            'tiposIncidencias'
        ));
    }   


    //  STORE
    public function store(Request $request)
    {
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

                'marca' => $request->marca,
                'modelo' => $request->modelo,
                'serie' => $request->serie,

                'numero_equipos' => $request->numero_equipos,

                'descripcion_problema' => $request->descripcion_problema,

                'resolucion_tecnica' => $request->resolucion_tecnica,

                'observaciones' => $request->observaciones,

                'solucionado' => true,
                'brindaron_facilidad' => false,
            ]);

            $informe->tiposIncidencias()
                ->attach($request->tipo_incidencia_id);

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