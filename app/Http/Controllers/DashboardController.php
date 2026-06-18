<?php

namespace App\Http\Controllers;

use App\Models\Informe;
use App\Models\User;
use App\Models\Oficina;
use App\Models\TipoEquipo;
class DashboardController extends Controller
{
    public function index()
    {
        $totalInformes = Informe::count();

        $informesHoy = Informe::whereDate(
            'created_at',
            today()
        )->count();

        $totalUsuarios = User::count();

        $totalOficinas = Oficina::count();

        $ultimosInformes = Informe::with('user')
        ->latest()
        ->take(5)
        ->get();

        $informesPorMes = Informe::selectRaw('MONTH(fecha) as mes, COUNT(*) as total')
        ->groupBy('mes')
        ->orderBy('mes')
        ->get();

        $informesPorEquipo = TipoEquipo::withCount('informes')
        ->get();

        $informesPorOficina = Oficina::withCount('informes')
        ->orderByDesc('informes_count')
        ->get();


        return view('admin.dashboard', compact(
            'totalInformes',
            'informesHoy',
            'totalUsuarios',
            'totalOficinas',
            'ultimosInformes',
            'informesPorMes',
            'informesPorEquipo',
            'informesPorOficina'
        ));

        
    }
}