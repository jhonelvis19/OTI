@extends('layouts.app')

@section('content')

<div class="space-y-8">

    <!-- ENCABEZADO DASHBOARD USUARIO -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Panel de Usuario</h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">Bienvenido a su resumen personal de mantenimiento y actas de soporte técnico.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="/usuario/informes/create" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-gradient-to-r from-violet-600 to-indigo-600 hover:from-violet-700 hover:to-indigo-700 text-white text-xs font-bold shadow-lg shadow-violet-500/25 transition-all hover:scale-[1.02] active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Registrar Nuevo Informe
            </a>
        </div>
    </div>

    <!-- TARJETAS PRINCIPALES DE MÉTRICAS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100/80 hover:shadow-md transition-all duration-300 flex items-center justify-between">
            <div class="space-y-2">
                <div class="flex items-center gap-2">
                    <div class="p-2.5 rounded-2xl bg-violet-50 text-violet-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-800">Mis Informes Totales</h3>
                        <p class="text-xs text-slate-400">Total de actas generadas</p>
                    </div>
                </div>
                <p class="text-4xl font-black text-violet-700 tracking-tight pt-2">{{ $totalInformes }}</p>
            </div>
            <!-- Circular Badge -->
            <div class="relative h-20 w-20 flex-shrink-0 flex items-center justify-center">
                <svg class="h-full w-full transform -rotate-90" viewBox="0 0 36 36">
                    <path class="text-slate-100" stroke-width="3.5" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                    <path class="text-violet-600" stroke-dasharray="75, 100" stroke-width="3.5" stroke-linecap="round" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                </svg>
                <span class="absolute text-xs font-black text-violet-700">75%</span>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100/80 hover:shadow-md transition-all duration-300 flex items-center justify-between">
            <div class="space-y-2">
                <div class="flex items-center gap-2">
                    <div class="p-2.5 rounded-2xl bg-emerald-50 text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-800">Informes Este Mes</h3>
                        <p class="text-xs text-slate-400">Actividad del mes en curso</p>
                    </div>
                </div>
                <p class="text-4xl font-black text-emerald-600 tracking-tight pt-2">{{ $informesMes }}</p>
            </div>
            <!-- Circular Badge -->
            <div class="relative h-20 w-20 flex-shrink-0 flex items-center justify-center">
                <svg class="h-full w-full transform -rotate-90" viewBox="0 0 36 36">
                    <path class="text-slate-100" stroke-width="3.5" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                    <path class="text-emerald-500" stroke-dasharray="50, 100" stroke-width="3.5" stroke-linecap="round" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                </svg>
                <span class="absolute text-xs font-black text-emerald-600">50%</span>
            </div>
        </div>

    </div>

    <!-- GRÁFICOS -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100/80 space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <div>
                    <h3 class="text-base font-bold text-slate-800">Informes por Mes</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Evolución de sus registros mensuales</p>
                </div>
            </div>
            <div class="relative h-72 w-full">
                <canvas id="graficoMes"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100/80 space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <div>
                    <h3 class="text-base font-bold text-slate-800">Informes por Tipo de Equipo</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Distribución de hardware atendido</p>
                </div>
            </div>
            <div class="relative h-72 w-full flex items-center justify-center">
                <canvas id="graficoEquipos"></canvas>
            </div>
        </div>

    </div>

    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100/80 space-y-4">
        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
            <div>
                <h3 class="text-base font-bold text-slate-800">Informes por Oficina</h3>
                <p class="text-xs text-slate-400 mt-0.5">Atenciones por dependencia</p>
            </div>
        </div>
        <div class="relative h-72 w-full">
            <canvas id="oficinasChart"></canvas>
        </div>
    </div>

    <!-- ÚLTIMOS INFORMES DEL USUARIO -->
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100/80 space-y-4">
        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
            <div>
                <h3 class="text-base font-bold text-slate-800">Últimos Informes Registrados</h3>
                <p class="text-xs text-slate-400 mt-0.5">Lista reciente de actas generadas por usted</p>
            </div>
            <a href="/usuario/informes" class="text-xs font-bold text-violet-600 hover:text-violet-800 transition">Ver todo el historial →</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-slate-50/80 text-slate-400 font-bold uppercase tracking-wider border-b border-slate-100">
                        <th class="py-3.5 px-4 rounded-l-2xl">Código</th>
                        <th class="py-3.5 px-4">Fecha</th>
                        <th class="py-3.5 px-4">Técnico</th>
                        <th class="py-3.5 px-4">Persona Atendida</th>
                        <th class="py-3.5 px-4 rounded-r-2xl">Oficina</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100/80 font-medium text-slate-700">
                    @forelse($ultimosInformes as $informe)
                    <tr class="hover:bg-violet-50/40 transition-colors duration-150">
                        <td class="py-3.5 px-4 font-bold text-violet-700">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-xl bg-violet-50 text-violet-700 border border-violet-100">
                                {{ $informe->codigo_informe }}
                            </span>
                        </td>
                        <td class="py-3.5 px-4 text-slate-500">
                            {{ $informe->fecha }}
                        </td>
                        <td class="py-3.5 px-4">
                            <div class="flex items-center gap-2">
                                <div class="h-6 w-6 rounded-full bg-violet-100 text-violet-700 font-bold flex items-center justify-center text-[10px]">
                                    {{ strtoupper(substr($informe->user->name ?? 'U', 0, 1)) }}
                                </div>
                                <span class="font-semibold text-slate-800">{{ $informe->user->name ?? 'Sin usuario' }}</span>
                            </div>
                        </td>
                        <td class="py-3.5 px-4 text-slate-700">
                            {{ $informe->nombre_atendido }}
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="px-2.5 py-1 rounded-full bg-slate-100 text-slate-600 font-semibold">
                                {{ $informe->otra_oficina ? $informe->otra_oficina : ($informe->oficina?->nombre ?? 'N/A') }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-8 text-slate-400 font-medium italic">Aún no tienes informes registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- CHART.JS INTEGRACIÓN MODERNA -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
    Chart.defaults.color = "#94a3b8";

    // 1. Gráfico por Mes
    const meses = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
    const datosMes = @json($informesPorMes);
    const labelsMeses = datosMes.map(item => meses[item.mes - 1]);
    const cantidadesMeses = datosMes.map(item => item.total);

    const ctxMes = document.getElementById('graficoMes').getContext('2d');
    const gradientMes = ctxMes.createLinearGradient(0, 0, 0, 300);
    gradientMes.addColorStop(0, 'rgba(99, 102, 241, 0.9)');
    gradientMes.addColorStop(1, 'rgba(139, 92, 246, 0.2)');

    new Chart(ctxMes, {
        type: 'bar',
        data: {
            labels: labelsMeses,
            datasets: [{
                label: 'Informes',
                data: cantidadesMeses,
                backgroundColor: gradientMes,
                borderRadius: 10,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { display: false } },
                y: { grid: { color: 'rgba(241, 245, 249, 1)' }, beginAtZero: true }
            }
        }
    });

    // 2. Gráfico por Equipos
    const equipos = @json($informesPorEquipo);
    new Chart(document.getElementById('graficoEquipos'), {
        type: 'doughnut',
        data: {
            labels: equipos.map(e => e.nombre),
            datasets: [{
                data: equipos.map(e => e.informes_count),
                backgroundColor: ['#6366f1', '#06b6d4', '#10b981', '#f59e0b', '#8b5cf6', '#ec4899', '#14b8a6'],
                borderWidth: 3,
                borderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11, weight: '600' } } } },
            cutout: '70%'
        }
    });

    // 3. Gráfico por Oficina
    const oficinasCtx = document.getElementById('oficinasChart').getContext('2d');
    const gradientOficinas = oficinasCtx.createLinearGradient(0, 0, 0, 300);
    gradientOficinas.addColorStop(0, 'rgba(139, 92, 246, 0.9)');
    gradientOficinas.addColorStop(1, 'rgba(99, 102, 241, 0.2)');

    new Chart(oficinasCtx, {
        type: 'bar',
        data: {
            labels: @json($informesPorOficina->pluck('nombre')),
            datasets: [{
                label: 'Informes',
                data: @json($informesPorOficina->pluck('informes_count')),
                backgroundColor: gradientOficinas,
                borderRadius: 10,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { display: false } },
                y: { grid: { color: 'rgba(241, 245, 249, 1)' }, beginAtZero: true }
            }
        }
    });
});
</script>

@endsection