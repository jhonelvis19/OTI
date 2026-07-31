@extends('layouts.app')

@section('content')

<div class="space-y-6">

    <!-- ENCABEZADO Y ACCIONES DE HISTORIAL -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Historial de Informes</h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">Gestión y consulta de todas las actas de servicio técnico registradas.</p>
        </div>

        <a href="/admin/informes/create"
            class="inline-flex items-center gap-2 bg-gradient-to-r from-violet-600 to-indigo-600 hover:from-violet-700 hover:to-indigo-700 text-white text-xs font-bold px-5 py-3 rounded-2xl shadow-lg shadow-violet-500/25 transition-all hover:scale-[1.02] active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            <span>Nuevo Informe</span>
        </a>
    </div>

    <!-- TARJETA CONTENEDORA DE TABLA -->
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100/80 space-y-4">

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs" style="min-width: 950px;">
                <thead>
                    <tr class="bg-slate-50/80 text-slate-400 font-bold uppercase tracking-wider border-b border-slate-100">
                        <th class="py-3.5 px-4 rounded-l-2xl">Código</th>
                        <th class="py-3.5 px-4">Fecha</th>
                        <th class="py-3.5 px-4">Técnico</th>
                        <th class="py-3.5 px-4">Atendido</th>
                        <th class="py-3.5 px-4">Oficina</th>
                        <th class="py-3.5 px-4">Cód. Patrimonio</th>
                        <th class="py-3.5 px-4">Marca</th>
                        <th class="py-3.5 px-4">Modelo</th>
                        <th class="py-3.5 px-4 text-right rounded-r-2xl">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100/80 font-medium text-slate-700">
                    @forelse($informes as $informe)
                    <tr class="hover:bg-violet-50/40 transition-colors duration-150">
                        <td class="py-3.5 px-4 font-bold text-violet-700">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-xl bg-violet-50 text-violet-700 border border-violet-100">
                                {{ $informe->codigo_informe }}
                            </span>
                        </td>
                        <td class="py-3.5 px-4 text-slate-500 whitespace-nowrap">
                            {{ $informe->fecha }}
                        </td>
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <div class="h-6 w-6 rounded-full bg-violet-100 text-violet-700 font-bold flex items-center justify-center text-[10px]">
                                    {{ strtoupper(substr($informe->user->name ?? 'U', 0, 1)) }}
                                </div>
                                <span class="font-semibold text-slate-800">{{ $informe->user->name ?? 'Sin usuario' }}</span>
                            </div>
                        </td>
                        <td class="py-3.5 px-4">
                            {{ $informe->nombre_atendido }}
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="px-2.5 py-1 rounded-full bg-slate-100 text-slate-600 font-semibold">
                                @if($informe->otra_oficina){{ $informe->otra_oficina }}@else{{ $informe->oficina?->nombre }}@endif
                            </span>
                        </td>
                        <td class="py-3.5 px-4 font-mono text-slate-500">
                            {{ $informe->codigo_patrimonial }}
                        </td>
                        <td class="py-3.5 px-4">
                            {{ $informe->marca }}
                        </td>
                        <td class="py-3.5 px-4">
                            {{ $informe->modelo }}
                        </td>
                        <td class="py-3.5 px-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="/admin/informes/{{ $informe->id }}"
                                   class="p-2 bg-slate-100 hover:bg-violet-100 text-slate-600 hover:text-violet-700 rounded-xl transition duration-150"
                                   title="Ver Detalle">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>

                                <a href="/admin/informes/{{ $informe->id }}/pdf/download"
                                   class="p-2 bg-slate-100 hover:bg-rose-100 text-slate-600 hover:text-rose-600 rounded-xl transition duration-150"
                                   title="Descargar PDF">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-10 text-slate-400 font-medium">
                            No hay informes registrados en la base de datos.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>

@endsection