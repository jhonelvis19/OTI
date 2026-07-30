<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;

class PlantillaExcelController extends Controller
{
    public function index()
    {
        $path = 'plantillas/plantilla_exportacion.xlsx';
        $existe = Storage::disk('private')->exists($path);
        
        $fechaActualizacion = null;
        if ($existe) {
            $fechaActualizacion = \Carbon\Carbon::createFromTimestamp(Storage::disk('private')->lastModified($path));
        }

        return view('configuraciones.plantilla', compact('existe', 'fechaActualizacion'));
    }

    public function download()
    {
        $path = 'plantillas/plantilla_exportacion.xlsx';
        if (!Storage::disk('private')->exists($path)) {
            return back()->with('error', 'No existe una plantilla de exportación configurada.');
        }

        return Storage::disk('private')->download($path, 'ACTA_INVENTARIO_HARDWARE.xlsx');
    }

    public function update(Request $request)
    {
        $request->validate([
            'plantilla' => [
                'required',
                'file',
                'mimes:xlsx',
                'max:10240',
            ],
            'password_actual' => [
                'required',
            ],
        ]);

        if (!Hash::check($request->password_actual, auth()->user()->password)) {
            return back()->withErrors([
                'password_actual' => 'La contraseña actual es incorrecta.',
            ]);
        }

        // Validate template using PhpSpreadsheet (must contain INVENTARIO DE HARDWARE sheet)
        try {
            $spreadsheet = IOFactory::load($request->file('plantilla')->getRealPath());
            if ($spreadsheet->getSheetByName('INVENTARIO DE HARDWARE') === null) {
                return back()->with('error', 'La plantilla no contiene la hoja requerida (INVENTARIO DE HARDWARE).');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Error al leer el archivo Excel: ' . $e->getMessage());
        }

        $path = 'plantillas/plantilla_exportacion.xlsx';
        
        // Backup
        if (Storage::disk('private')->exists($path)) {
            $backupPath = 'plantillas/historial/plantilla_' . now()->format('Y_m_d_His') . '.xlsx';
            Storage::disk('private')->copy($path, $backupPath);
        }

        // Save new
        $request->file('plantilla')->storeAs('plantillas', 'plantilla_exportacion.xlsx', 'private');

        return back()->with('success', 'La plantilla Excel se actualizó correctamente.');
    }
}
