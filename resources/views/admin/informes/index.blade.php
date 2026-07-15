@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="flex items-center justify-between mb-8">

        <h1 class="text-4xl font-bold text-slate-800">
            Historial de Informes
        </h1>

        <a href="/admin/informes/create"
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

        <!-- SOLO LA TABLA HACE SCROLL -->
        <div class="overflow-x-auto">

            <table class="w-full" style="min-width: 950px;">

                <thead class="bg-slate-100">
                    <tr>
                        <th class="text-left px-6 py-4 text-slate-600 font-medium whitespace-nowrap">Código</th>
                        <th class="text-left px-6 py-4 text-slate-600 font-medium whitespace-nowrap">Fecha</th>
                        <th class="text-left px-6 py-4 text-slate-600 font-medium whitespace-nowrap">Técnico</th>
                        <th class="text-left px-6 py-4 text-slate-600 font-medium whitespace-nowrap">Atendido</th>
                        <th class="text-left px-6 py-4 text-slate-600 font-medium whitespace-nowrap">Oficina</th>
                        <th class="text-left px-6 py-4 text-slate-600 font-medium whitespace-nowrap">Cód. Patrimonio</th>
                        <th class="text-left px-6 py-4 text-slate-600 font-medium whitespace-nowrap">Marca</th>
                        <th class="text-left px-6 py-4 text-slate-600 font-medium whitespace-nowrap">Modelo</th>
                        <th class="text-left px-6 py-4 text-slate-600 font-medium whitespace-nowrap">Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($informes as $informe)

                    <tr class="border-b border-gray-100 hover:bg-indigo-50 transition duration-150
                               {{ $loop->odd ? 'bg-white' : 'bg-slate-50' }}">

                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $informe->codigo_informe }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $informe->fecha }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $informe->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $informe->nombre_atendido }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">@if($informe->otra_oficina){{ $informe->otra_oficina }}@else{{ $informe->oficina?->nombre }}@endif</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $informe->codigo_patrimonial }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $informe->marca }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $informe->modelo }}</td>

                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3 flex-nowrap">

                                <a href="/admin/informes/{{ $informe->id }}"
                                   class="text-slate-600 hover:text-indigo-600 transition duration-200"
                                   title="Ver Detalle">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </a>

                                <a href="/admin/informes/{{ $informe->id }}/pdf/download"
                                   class="text-slate-600 hover:text-red-600 transition duration-200"
                                   title="Descargar PDF">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                </a>

                            </div>
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="9" class="text-center py-10 text-gray-400 text-sm">
                            No hay informes registrados.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection