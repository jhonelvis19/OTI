@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="mb-8">

        <h1 class="text-4xl font-bold text-slate-800">

            Historial de {{ $usuario->name }}

        </h1>

        <p class="text-gray-500 mt-2">

            Informes realizados por este usuario.

        </p>

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
                        Estado
                    </th>

                    <th class="text-left px-6 py-4">
                        PDF
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
                        {{ $informe->nombre_atendido }}
                    </td>

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

                    <td class="px-6 py-4">

                        <a href="/admin/informes/{{ $informe->id }}/pdf"
                           target="_blank"
                           class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm">

                            PDF

                        </a>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5" class="text-center py-8 text-gray-500">

                        No existen informes registrados.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection