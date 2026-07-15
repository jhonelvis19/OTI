@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-4xl font-bold text-slate-800">
                Mis Informes
            </h1>
        </div>

        <a href="/usuario/informes/create"
            class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700
            text-white px-5 py-3 rounded-xl font-medium
            transition duration-200 shadow-md hover:shadow-lg">

           <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            <span>Nuevo Informe</span>

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
                        Ofincina 

                    <th class="text-left px-6 py-4">
                        Atendido
                    </th>

                    <th class="text-left px-6 py-4">
                        Marca
                    </th>

                    <th class="text-left px-6 py-4">
                        Modelo
                    </th>

                    <th class="text-left px-6 py-4">
                        Codigo de Patrimonio
                    </th>

                    <th class="text-left px-6 py-4">
                        Acciones
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($informes as $informe)

                <tr class="border-b border-gray-100">

                    <td class="px-6 py-4">
                        {{ $informe->codigo_informe }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $informe->fecha }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $informe->oficina }}

                    <td class="px-6 py-4">
                        {{ $informe->nombre_atendido }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $informe->marca }} 
                    </td>
                    <td class="px-6 py-4">
                        {{ $informe->modelo }}

                    </td>
                    <td class="px-6 py-4">
                        {{ $informe->codigo_patrimonio }}
                    </td>

                    <td class="px-6 py-4">

                        <div class="flex gap-2 flex-wrap">

                            <a href="/usuario/informes/{{ $informe->id }}"
                               class="text-slate-600 hover:text-red-600 transition duration-200"
                               title="Ver Detalle del Informe">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>

                            </a>

                            <a href="/usuario/informes/{{ $informe->id }}/edit"
                               class="text-slate-600 hover:text-yellow-600 transition duration-200"
                               title="Editar Informe">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>

                            </a>

                            <a href="/usuario/informes/{{ $informe->id }}/pdf/download"
                            class="text-slate-600 hover:text-red-600 transition duration-200"
                            title="Descargar PDF">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>

                            </a>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="4"
                        class="text-center py-8 text-gray-500">

                        No tienes informes registrados.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection