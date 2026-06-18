@extends('layouts.app')

@section('content')

<div class="p-6">

    <!-- TARJETAS -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        <div class="bg-white shadow rounded-xl p-6">
            <h3 class="text-gray-500">Total Informes</h3>
            <p class="text-3xl font-bold">
                {{ $totalInformes }}
            </p>
        </div>

        <div class="bg-white shadow rounded-xl p-6">
            <h3 class="text-gray-500">Informes Hoy</h3>
            <p class="text-3xl font-bold">
                {{ $informesHoy }}
            </p>
        </div>

        <div class="bg-white shadow rounded-xl p-6">
            <h3 class="text-gray-500">Usuarios</h3>
            <p class="text-3xl font-bold">
                {{ $totalUsuarios }}
            </p>
        </div>

        <div class="bg-white shadow rounded-xl p-6">
            <h3 class="text-gray-500">Oficinas</h3>
            <p class="text-3xl font-bold">
                {{ $totalOficinas }}
            </p>
        </div>

    </div>
        <div class="bg-white shadow rounded-xl p-6 mb-8">
            <div style="height:350px;">
            <canvas id="graficoMes"></canvas>
            </div>

        <h2 class="text-xl font-semibold mb-4">
            Informes por Mes
        </h2>

        <canvas id="graficoMes"></canvas>

    </div>


    <div class="bg-white shadow rounded-xl p-6 mb-8">

        <h2 class="text-xl font-semibold mb-4">
            Informes por Tipo de Equipo
        </h2>

        <div style="height:350px;">
            <canvas id="graficoEquipos"></canvas>
        </div>

    </div>

    <div class="bg-white rounded-xl shadow p-6 mt-6">
        <h3 class="text-lg font-semibold mb-4">
            Informes por Oficina
        </h3>

        <canvas id="oficinasChart"></canvas>
    </div>

    <!-- ÚLTIMOS INFORMES -->
    <div class="bg-white shadow rounded-xl p-6">

        <h2 class="text-xl font-semibold mb-4">
            Últimos Informes Registrados
        </h2>

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

                    @foreach($ultimosInformes as $informe)

                    <tr class="border-b hover:bg-gray-50">

                        <td class="p-3">
                            {{ $informe->codigo_informe }}
                        </td>

                        <td class="p-3">
                            {{ $informe->fecha }}
                        </td>

                        <td class="p-3">
                            {{ $informe->user->name ?? 'Sin usuario' }}
                        </td>

                        <td class="p-3">
                            {{ $informe->nombre_atendido }}
                        </td>
                        <td class="p-3">
                        @if($informe->otra_oficina)
                            {{ $informe->otra_oficina }}
                        @else
                            {{ $informe->oficina?->nombre }}
                        @endif
                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const meses = [
    'Ene','Feb','Mar','Abr','May','Jun',
    'Jul','Ago','Sep','Oct','Nov','Dic'
];

const datosMes = @json($informesPorMes);

const labels = datosMes.map(item => meses[item.mes - 1]);
const cantidades = datosMes.map(item => item.total);

new Chart(
    document.getElementById('graficoMes'),
    {
        type: 'bar',

        data: {
            labels: labels,

            datasets: [{
                label: 'Informes',
                data: cantidades
            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    }
);

</script>

<script>

const equipos = @json($informesPorEquipo);

new Chart(
    document.getElementById('graficoEquipos'),
    {
        type: 'pie',

        data: {
            labels: equipos.map(
                equipo => equipo.nombre
            ),

            datasets: [{
                data: equipos.map(
                    equipo => equipo.informes_count
                )
            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    }
);

</script>

<script>
const oficinasCtx = document.getElementById('oficinasChart');

new Chart(oficinasCtx, {
    type: 'bar',
    data: {
        labels: @json($informesPorOficina->pluck('nombre')),
        datasets: [{
            label: 'Informes',
            data: @json($informesPorOficina->pluck('informes_count')),
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

@endsection