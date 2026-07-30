<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informe;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportacionExcelController extends Controller
{
    public function exportar(Request $request)
    {
        $request->validate([
            'informes' => ['required', 'array', 'max:12'],
            'informes.*' => ['exists:informes,id'],
        ]);

        $informesIds = $request->informes;

        // Validar que no exceda 12 informes
        if (count($informesIds) > 12) {
            return back()->with('error', 'Solo puede exportar un máximo de 12 informes por acta.');
        }

        // Si el usuario no es admin, solo puede exportar sus informes
        $query = Informe::with(['user', 'sede', 'oficina', 'tipoEquipo', 'tiposIncidencias'])
            ->whereIn('id', $informesIds);

        if (auth()->user()->rol !== 'admin') {
            $query->where('user_id', auth()->id());
        }

        $informes = $query->get();

        if ($informes->count() !== count($informesIds)) {
            abort(403, 'No tiene autorización para exportar uno o más informes.');
        }

        // Check if template exists
        $templatePath = 'plantillas/plantilla_exportacion.xlsx';
        if (!Storage::disk('private')->exists($templatePath)) {
            return back()->with('error', 'No existe una plantilla de exportación configurada. Comuníquese con el administrador.');
        }

        // Load template
        try {
            $spreadsheet = IOFactory::load(Storage::disk('private')->path($templatePath));
            $sheet = $spreadsheet->getSheetByName('INVENTARIO DE HARDWARE');
            if ($sheet === null) {
                return back()->with('error', 'La plantilla no contiene la hoja requerida.');
            }

            // Fill data
            // We assume standard Excel grid starting at some row. 
            // Currently using generic row mapping starting at row 5 (assuming rows 1-4 are headers).
            // A=Código, B=Fecha, C=Equipo, D=Marca, E=Modelo, F=Serie, G=Patrimonial
            $startRow = 5;
            foreach ($informes as $index => $informe) {
                $row = $startRow + $index;
                $sheet->setCellValue('A' . $row, $informe->codigo_informe);
                $sheet->setCellValue('B' . $row, $informe->fecha);
                $sheet->setCellValue('C' . $row, $informe->otro_equipo ?? $informe->tipoEquipo?->nombre);
                $sheet->setCellValue('D' . $row, $informe->marca);
                $sheet->setCellValue('E' . $row, $informe->modelo);
                $sheet->setCellValue('F' . $row, $informe->serie);
                $sheet->setCellValue('G' . $row, $informe->codigo_patrimonial);
                $sheet->setCellValue('H' . $row, $informe->solucionado ? 'SÍ' : 'NO');
            }

            // Create temporary file
            $writer = new Xlsx($spreadsheet);
            $tempFile = tempnam(sys_get_temp_dir(), 'export') . '.xlsx';
            $writer->save($tempFile);

            return response()->download($tempFile, 'Exportacion_Informes_' . now()->format('Ymd_His') . '.xlsx')->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            return back()->with('error', 'No fue posible generar el archivo Excel: ' . $e->getMessage());
        }
    }
}
