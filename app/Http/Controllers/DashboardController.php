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

    public function usuarioIndex()
    {
        $userId = auth()->id();

        $totalInformes = Informe::where('user_id', $userId)->count();

        $informesMes = Informe::where('user_id', $userId)
            ->whereMonth('created_at', today()->month)
            ->whereYear('created_at', today()->year)
            ->count();

        $ultimosInformes = Informe::with('user', 'oficina')
            ->where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        $informesPorMes = Informe::selectRaw('MONTH(fecha) as mes, COUNT(*) as total')
            ->where('user_id', $userId)
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        $informesPorEquipo = TipoEquipo::withCount(['informes' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }])->get();

        $informesPorOficina = Oficina::withCount(['informes' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }])->orderByDesc('informes_count')->get();

        return view('usuario.dashboard', compact(
            'totalInformes',
            'informesMes',
            'ultimosInformes',
            'informesPorMes',
            'informesPorEquipo',
            'informesPorOficina'
        ));
    }
}