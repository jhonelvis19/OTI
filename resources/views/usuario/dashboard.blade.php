@extends('layouts.app')

@section('content')

<div class="p-6">

    <div class="mb-8">
        <h1 class="text-4xl font-bold text-slate-800">Panel Usuario</h1>
        <p class="text-gray-500 mt-2">Bienvenido al sistema de gestión de actas OTI.</p>
    </div>

    <!-- TARJETAS -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

        <div class="bg-white shadow rounded-xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-slate-700">Mis Informes</h2>
                    <p class="text-sm text-gray-500 mt-1">Total de informes registrados</p>
                </div>
                <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center">
                    <span class="text-2xl">📄</span>
                </div>
            </div>
            <div class="mt-8">
                <h3 class="text-5xl font-bold text-blue-700">{{ $totalInformes }}</h3>
            </div>
        </div>

        <div class="bg-white shadow rounded-xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-slate-700">Informes Este Mes</h2>
                    <p class="text-sm text-gray-500 mt-1">Actividad mensual</p>
                </div>
                <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center">
                    <span class="text-2xl">📊</span>
                </div>
            </div>
            <div class="mt-8">
                <h3 class="text-5xl font-bold text-green-700">{{ $informesMes }}</h3>
            </div>
        </div>

    </div>

    <!-- GRÁFICOS -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white shadow rounded-xl p-6">
            <h2 class="text-xl font-semibold mb-4">Informes por Mes</h2>
            <div style="height:350px;">
                <canvas id="graficoMes"></canvas>
            </div>
        </div>

        <div class="bg-white shadow rounded-xl p-6">
            <h2 class="text-xl font-semibold mb-4">Informes por Tipo de Equipo</h2>
            <div style="height:350px;">
                <canvas id="graficoEquipos"></canvas>
            </div>
        </div>
    </div>

    <div class="bg-white shadow rounded-xl p-6 mb-8">
        <h3 class="text-xl font-semibold mb-4">Informes por Oficina</h3>
        <div style="height:350px;">
            <canvas id="oficinasChart"></canvas>
        </div>
    </div>

    <!-- ÚLTIMOS INFORMES -->
    <div class="bg-white shadow rounded-xl p-6">
        <h2 class="text-xl font-semibold mb-4">Últimos Informes Registrados</h2>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b">
                        <th class="text-left p-3">Código</th>
                        <th class="text-left p-3">Fecha</th>
                        <th class="text-left p-3">Técnico</th>
                        <th class="text-left p-3">Atendido</th>
                        <th class="text-left p-3">Oficina</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ultimosInformes as $informe)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $informe->codigo_informe }}</td>
                        <td class="p-3">{{ $informe->fecha }}</td>
                        <td class="p-3">{{ $informe->user->name ?? 'Sin usuario' }}</td>
                        <td class="p-3">{{ $informe->nombre_atendido }}</td>
                        <td class="p-3">
                            @if($informe->otra_oficina)
                                {{ $informe->otra_oficina }}
                            @else
                                {{ $informe->oficina?->nombre }}
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr class="border-b hover:bg-gray-50">
                        <td colspan="5" class="p-3 text-center text-gray-500 italic">
                            Aún no tienes informes registrados.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Gráfico de Meses
const meses = [
    'Ene','Feb','Mar','Abr','May','Jun',
    'Jul','Ago','Sep','Oct','Nov','Dic'
];
const datosMes = @json($informesPorMes);
const labelsMeses = datosMes.map(item => meses[item.mes - 1]);
const cantidadesMeses = datosMes.map(item => item.total);

new Chart(document.getElementById('graficoMes'), {
    type: 'bar',
    data: {
        labels: labelsMeses,
        datasets: [{
            label: 'Informes',
            data: cantidadesMeses,
            backgroundColor: '#3b82f6',
            borderRadius: 4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false }
        }
    }
});

// Gráfico de Equipos
const equipos = @json($informesPorEquipo);
new Chart(document.getElementById('graficoEquipos'), {
    type: 'pie',
    data: {
        labels: equipos.map(equipo => equipo.nombre),
        datasets: [{
            data: equipos.map(equipo => equipo.informes_count),
            backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#ec4899', '#14b8a6']
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});

// Gráfico de Oficinas
const oficinasCtx = document.getElementById('oficinasChart');
const oficinas = @json($informesPorOficina);
new Chart(oficinasCtx, {
    type: 'bar',
    data: {
        labels: oficinas.map(oficina => oficina.nombre),
        datasets: [{
            label: 'Informes',
            data: oficinas.map(oficina => oficina.informes_count),
            backgroundColor: '#8b5cf6',
            borderRadius: 4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>

@endsection