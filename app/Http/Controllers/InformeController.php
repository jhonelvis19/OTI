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

        'problema_solucionado' => 'required|in:si,no',
        'resolucion_tecnica' => 'required_if:problema_solucionado,no|nullable|string',

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

        'problema_solucionado.required' => 'Debe indicar si el problema se pudo solucionar.',
        'resolucion_tecnica.required_if' => 'Debe ingresar la resolución técnica si el problema no se solucionó.',

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

            'resolucion_tecnica' => $request->problema_solucionado == 'no' ? $request->resolucion_tecnica : null,

            'observaciones' => $request->observaciones,

            'solucionado' => $request->problema_solucionado == 'si',
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
        // Usuario normal solo puede ver sus propios informes
        if (
            auth()->user()->rol === 'usuario' &&
            $informe->user_id != auth()->id()
        ) {
            abort(403, 'No tienes permisos');
        }

        // Redirige a la vista correcta según el rol
        $view = auth()->user()->rol === 'admin'
            ? 'admin.informes.show'
            : 'usuario.informes.show';

        return view($view, compact('informe'));
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

            $oficinaOtrosId = Oficina::where('nombre', 'Otros')->value('id');
            $tipoEquipoOtrosId = TipoEquipo::where('nombre', 'Otros')->value('id');

            return view(
                'admin.informes.create',
                compact(
                    'informe',
                    'oficinas',
                    'sedes',
                    'tiposEquipos',
                    'tiposIncidencias',
                    'oficinaOtrosId',
                    'tipoEquipoOtrosId'
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
            'problema_solucionado' => 'required|in:si,no',
            'resolucion_tecnica' => 'required_if:problema_solucionado,no|nullable|string',
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
            'problema_solucionado.required' => 'Debe indicar si el problema se pudo solucionar.',
            'resolucion_tecnica.required_if' => 'Debe ingresar la resolución técnica si el problema no se solucionó.',
            'observaciones.required' => 'Debe ingresar las observaciones.',
        ]);

        $informe->update([
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
            'resolucion_tecnica' => $request->problema_solucionado == 'no' ? $request->resolucion_tecnica : null,
            'solucionado' => $request->problema_solucionado == 'si',
            'observaciones' => $request->observaciones,
        ]);

        $informe->tiposIncidencias()
            ->sync($request->tipo_incidencia_id);

        $redirectTo = $request->input('redirect_to');
        
        // Evitar bucles o redirección a la misma url de edición
        if (!$redirectTo || str_contains($redirectTo, '/edit') || !str_contains($redirectTo, auth()->user()->rol)) {
            $redirectTo = auth()->user()->rol == 'admin' ? '/admin/informes' : '/usuario/informes';
        }

        return redirect($redirectTo)
            ->with('success', 'Informe actualizado correctamente');
    }

}