@extends('layouts.app')

@section('content')

<div class="space-y-8">

    <!-- ENCABEZADO DASHBOARD -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Panel de Control</h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">Resumen general y métricas del sistema de mantenimiento técnico OTI.</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-white border border-slate-200/80 text-xs font-semibold text-slate-600 shadow-sm">
                <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Sistema Activo
            </span>
            <a href="/admin/informes/create" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-gradient-to-r from-violet-600 to-indigo-600 hover:from-violet-700 hover:to-indigo-700 text-white text-xs font-bold shadow-lg shadow-violet-500/25 transition-all hover:scale-[1.02] active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Nuevo Informe
            </a>
        </div>
    </div>

    <!-- TARJETAS SUPERIORES DE MÉTRICAS (ESTILO DOJOBS CON CIRCULAR BADGE) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Total Informes -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100/80 hover:shadow-md transition-all duration-300 flex items-center justify-between">
            <div class="space-y-2">
                <div class="flex items-center gap-2">
                    <div class="p-2 rounded-xl bg-violet-50 text-violet-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Informes</span>
                </div>
                <p class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ $totalInformes }}+</p>
                <p class="text-[11px] font-medium text-emerald-600 flex items-center gap-1">
                    <span>↑ 100%</span>
                    <span class="text-slate-400">registrados</span>
                </p>
            </div>
            <!-- Circular Badge indicator -->
            <div class="relative h-16 w-16 flex-shrink-0 flex items-center justify-center">
                <svg class="h-full w-full transform -rotate-90" viewBox="0 0 36 36">
                    <path class="text-slate-100" stroke-width="3.5" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                    <path class="text-violet-600" stroke-dasharray="82, 100" stroke-width="3.5" stroke-linecap="round" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                </svg>
                <span class="absolute text-xs font-extrabold text-violet-700">82%</span>
            </div>
        </div>

        <!-- Informes Hoy -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100/80 hover:shadow-md transition-all duration-300 flex items-center justify-between">
            <div class="space-y-2">
                <div class="flex items-center gap-2">
                    <div class="p-2 rounded-xl bg-emerald-50 text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Informes Hoy</span>
                </div>
                <p class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ $informesHoy }}+</p>
                <p class="text-[11px] font-medium text-emerald-600 flex items-center gap-1">
                    <span>Actividad diaria</span>
                </p>
            </div>
            <!-- Circular Badge indicator -->
            <div class="relative h-16 w-16 flex-shrink-0 flex items-center justify-center">
                <svg class="h-full w-full transform -rotate-90" viewBox="0 0 36 36">
                    <path class="text-slate-100" stroke-width="3.5" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                    <path class="text-emerald-500" stroke-dasharray="45, 100" stroke-width="3.5" stroke-linecap="round" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                </svg>
                <span class="absolute text-xs font-extrabold text-emerald-600">45%</span>
            </div>
        </div>

        <!-- Usuarios -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100/80 hover:shadow-md transition-all duration-300 flex items-center justify-between">
            <div class="space-y-2">
                <div class="flex items-center gap-2">
                    <div class="p-2 rounded-xl bg-sky-50 text-sky-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Usuarios</span>
                </div>
                <p class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ $totalUsuarios }}+</p>
                <p class="text-[11px] font-medium text-sky-600">Personal de soporte</p>
            </div>
            <!-- Circular Badge indicator -->
            <div class="relative h-16 w-16 flex-shrink-0 flex items-center justify-center">
                <svg class="h-full w-full transform -rotate-90" viewBox="0 0 36 36">
                    <path class="text-slate-100" stroke-width="3.5" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                    <path class="text-sky-500" stroke-dasharray="60, 100" stroke-width="3.5" stroke-linecap="round" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                </svg>
                <span class="absolute text-xs font-extrabold text-sky-600">60%</span>
            </div>
        </div>

        <!-- Oficinas -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100/80 hover:shadow-md transition-all duration-300 flex items-center justify-between">
            <div class="space-y-2">
                <div class="flex items-center gap-2">
                    <div class="p-2 rounded-xl bg-amber-50 text-amber-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Oficinas</span>
                </div>
                <p class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ $totalOficinas }}+</p>
                <p class="text-[11px] font-medium text-amber-600">Áreas atendidas</p>
            </div>
            <!-- Circular Badge indicator -->
            <div class="relative h-16 w-16 flex-shrink-0 flex items-center justify-center">
                <svg class="h-full w-full transform -rotate-90" viewBox="0 0 36 36">
                    <path class="text-slate-100" stroke-width="3.5" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                    <path class="text-amber-500" stroke-dasharray="90, 100" stroke-width="3.5" stroke-linecap="round" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                </svg>
                <span class="absolute text-xs font-extrabold text-amber-600">90%</span>
            </div>
        </div>

    </div>

    <!-- TARJETAS CON DEGRADADOS COLORIDOS Y ONDAS (ESTILO IMAGEN DOJOBS) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-cyan-400 to-blue-600 p-6 text-white shadow-lg shadow-cyan-500/20">
            <div class="relative z-10 space-y-1">
                <p class="text-3xl font-black tracking-tight">{{ $totalInformes }}</p>
                <p class="text-xs font-medium text-cyan-100 uppercase tracking-wider">Mantenimientos Totales</p>
            </div>
            <svg class="absolute -bottom-2 -right-2 h-24 w-full opacity-30 pointer-events-none" viewBox="0 0 100 50" preserveAspectRatio="none">
                <path d="M0,30 Q25,10 50,30 T100,20 L100,50 L0,50 Z" fill="white" />
            </svg>
        </div>

        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-violet-500 to-purple-700 p-6 text-white shadow-lg shadow-purple-500/20">
            <div class="relative z-10 space-y-1">
                <p class="text-3xl font-black tracking-tight">{{ $informesHoy }}</p>
                <p class="text-xs font-medium text-purple-100 uppercase tracking-wider">Informes Registrados Hoy</p>
            </div>
            <svg class="absolute -bottom-2 -right-2 h-24 w-full opacity-30 pointer-events-none" viewBox="0 0 100 50" preserveAspectRatio="none">
                <path d="M0,20 Q30,40 60,15 T100,30 L100,50 L0,50 Z" fill="white" />
            </svg>
        </div>

        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-rose-400 to-red-600 p-6 text-white shadow-lg shadow-rose-500/20">
            <div class="relative z-10 space-y-1">
                <p class="text-3xl font-black tracking-tight">{{ $totalUsuarios }}</p>
                <p class="text-xs font-medium text-rose-100 uppercase tracking-wider">Técnicos & Administradores</p>
            </div>
            <svg class="absolute -bottom-2 -right-2 h-24 w-full opacity-30 pointer-events-none" viewBox="0 0 100 50" preserveAspectRatio="none">
                <path d="M0,35 Q20,10 50,25 T100,10 L100,50 L0,50 Z" fill="white" />
            </svg>
        </div>

        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-amber-400 to-orange-600 p-6 text-white shadow-lg shadow-amber-500/20">
            <div class="relative z-10 space-y-1">
                <p class="text-3xl font-black tracking-tight">{{ $totalOficinas }}</p>
                <p class="text-xs font-medium text-amber-100 uppercase tracking-wider">Oficinas SUNEDU</p>
            </div>
            <svg class="absolute -bottom-2 -right-2 h-24 w-full opacity-30 pointer-events-none" viewBox="0 0 100 50" preserveAspectRatio="none">
                <path d="M0,15 Q40,40 70,10 T100,25 L100,50 L0,50 Z" fill="white" />
            </svg>
        </div>

    </div>

    <!-- SECCIÓN DE GRÁFICOS DE RENDIMIENTO (MODERNOS) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Gráfico 1: Informes por Mes -->
        <div class="lg:col-span-2 bg-white rounded-3xl p-6 shadow-sm border border-slate-100/80 space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <div>
                    <h3 class="text-base font-bold text-slate-800">Informes por Mes</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Evolución mensual de mantenimientos registrados</p>
                </div>
                <span class="px-3 py-1 bg-violet-50 text-violet-700 text-xs font-semibold rounded-full">Mensual</span>
            </div>
            <div class="relative h-72 w-full">
                <canvas id="graficoMes"></canvas>
            </div>
        </div>

        <!-- Gráfico 2: Informes por Tipo de Equipo -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100/80 space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <div>
                    <h3 class="text-base font-bold text-slate-800">Equipos Atendidos</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Distribución por tipo de hardware</p>
                </div>
            </div>
            <div class="relative h-72 w-full flex items-center justify-center">
                <canvas id="graficoEquipos"></canvas>
            </div>
        </div>

    </div>

    <!-- Gráfico 3: Informes por Oficina -->
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100/80 space-y-4">
        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
            <div>
                <h3 class="text-base font-bold text-slate-800">Mantenimiento por Oficina</h3>
                <p class="text-xs text-slate-400 mt-0.5">Cantidad de atenciones realizadas en cada área de SUNEDU</p>
            </div>
        </div>
        <div class="relative h-80 w-full">
            <canvas id="oficinasChart"></canvas>
        </div>
    </div>

    <!-- TABLA DE ÚLTIMOS INFORMES REGISTRADOS -->
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100/80 space-y-4">
        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
            <div>
                <h3 class="text-base font-bold text-slate-800">Últimos Informes Registrados</h3>
                <p class="text-xs text-slate-400 mt-0.5">Listado de actas creadas recientemente</p>
            </div>
            <a href="/admin/informes" class="text-xs font-bold text-violet-600 hover:text-violet-800 transition">Ver todo el historial →</a>
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
                        <td colspan="5" class="text-center py-8 text-slate-400 font-medium">No se han registrado informes técnicos aún.</td>
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
    // Configuración global de Chart.js
    Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
    Chart.defaults.color = "#94a3b8";

    // 1. Gráfico por Mes
    const meses = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
    const datosMes = @json($informesPorMes);
    const labelsMes = datosMes.map(item => meses[item.mes - 1]);
    const cantidadesMes = datosMes.map(item => item.total);

    const ctxMes = document.getElementById('graficoMes').getContext('2d');
    const gradientMes = ctxMes.createLinearGradient(0, 0, 0, 300);
    gradientMes.addColorStop(0, 'rgba(99, 102, 241, 0.9)');
    gradientMes.addColorStop(1, 'rgba(139, 92, 246, 0.2)');

    new Chart(ctxMes, {
        type: 'bar',
        data: {
            labels: labelsMes,
            datasets: [{
                label: 'Informes',
                data: cantidadesMes,
                backgroundColor: gradientMes,
                borderRadius: 12,
                borderSkipped: false,
                barThickness: 24
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: { grid: { display: false } },
                y: { grid: { color: 'rgba(241, 245, 249, 1)' }, beginAtZero: true }
            }
        }
    });

    // 2. Gráfico por Equipos (Pie / Donut)
    const equipos = @json($informesPorEquipo);
    const colorsEquipos = ['#6366f1', '#06b6d4', '#10b981', '#f59e0b', '#ec4899', '#8b5cf6'];

    new Chart(document.getElementById('graficoEquipos'), {
        type: 'doughnut',
        data: {
            labels: equipos.map(e => e.nombre),
            datasets: [{
                data: equipos.map(e => e.informes_count),
                backgroundColor: colorsEquipos,
                borderWidth: 3,
                borderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11, weight: '600' } } }
            },
            cutout: '70%'
        }
    });

    // 3. Gráfico por Oficina
    const oficinasCtx = document.getElementById('oficinasChart').getContext('2d');
    const gradientOficinas = oficinasCtx.createLinearGradient(0, 0, 0, 300);
    gradientOficinas.addColorStop(0, 'rgba(6, 182, 212, 0.9)');
    gradientOficinas.addColorStop(1, 'rgba(59, 130, 246, 0.2)');

    new Chart(oficinasCtx, {
        type: 'bar',
        data: {
            labels: @json($informesPorOficina->pluck('nombre')),
            datasets: [{
                label: 'Cantidad de Informes',
                data: @json($informesPorOficina->pluck('informes_count')),
                backgroundColor: gradientOficinas,
                borderRadius: 10,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: { grid: { display: false } },
                y: { grid: { color: 'rgba(241, 245, 249, 1)' }, beginAtZero: true }
            }
        }
    });
});
</script>

@endsection