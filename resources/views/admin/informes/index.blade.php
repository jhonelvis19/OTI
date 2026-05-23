@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="flex items-center justify-between mb-8">

        <div>

            <h1 class="text-4xl font-bold text-slate-800">
                Historial de Informes
            </h1>

            <p class="text-gray-500 mt-2">
                Lista de mantenimientos registrados.
            </p>

        </div>

        <a href="/admin/informes/create"
           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl">

            Nuevo Informe

        </a>

    </div>



    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

        <table class="w-full">

            <thead class="bg-slate-100">

                <tr>

                    <th class="text-left px-6 py-4">
                        Código
                    </th>

                    <th class="text-left px-6 py-4">
                        Fecha
                    </th>

                    <th class="text-left px-6 py-4">
                        Atendido
                    </th>

                    <th class="text-left px-6 py-4">
                        Técnico
                    </th>

                    <th class="text-left px-6 py-4">
                        Estado
                    </th>

                    <th class="text-left px-6 py-4">
                        Acción
                    </th>
                
                </tr>

            </thead>


            <tbody>

    @foreach($informes as $informe)

    <tr class="border-b border-gray-100">

        <!-- CÓDIGO -->
        <td class="px-6 py-4">
            {{ $informe->codigo_informe }}
        </td>

        <!-- FECHA -->
        <td class="px-6 py-4">
            {{ $informe->fecha }}
        </td>

        <!-- ATENDIDO -->
        <td class="px-6 py-4">
            {{ $informe->nombre_atendido }}
        </td>

        <!-- TÉCNICO -->
        <td class="px-6 py-4">
            {{ $informe->user->name }}
        </td>

        <!-- ESTADO -->
        <td class="px-6 py-4">

            @if($informe->solucionado)

                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                    Solucionado

                </span>

            @else

                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">

                    Pendiente

                </span>

            @endif

        </td>

        <!-- ACCIONES -->
        <td class="px-6 py-4">

            <a href="/admin/informes/{{ $informe->id }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">

                Ver

            </a>

        </td>

    </tr>

    @endforeach

</tbody>

        </table>

    </div>

</div>

@endsection