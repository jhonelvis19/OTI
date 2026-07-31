@extends('layouts.app')

@section('content')

<div class="space-y-6">

    <!-- HEADER HISTORIAL DE USUARIO -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <a href="/admin/usuarios" class="p-2 bg-white rounded-xl border border-slate-200/80 text-slate-500 hover:text-slate-800 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Historial de {{ $usuario->name }} {{ $usuario->apellido }}</h1>
            </div>
            <p class="text-xs sm:text-sm text-slate-400">Informes técnicos y actas generadas por este usuario.</p>
        </div>
    </div>

    <!-- TABLA CONTENEDORA -->
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100/80 space-y-4">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-slate-50/80 text-slate-400 font-bold uppercase tracking-wider border-b border-slate-100">
                        <th class="py-3.5 px-4 rounded-l-2xl">Código</th>
                        <th class="py-3.5 px-4">Fecha</th>
                        <th class="py-3.5 px-4">Persona Atendida</th>
                        <th class="py-3.5 px-4">Estado</th>
                        <th class="py-3.5 px-4 text-right rounded-r-2xl">Documento</th>
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
                        <td class="py-3.5 px-4 text-slate-500">
                            {{ $informe->fecha }}
                        </td>
                        <td class="py-3.5 px-4 font-semibold text-slate-800">
                            {{ $informe->nombre_atendido }}
                        </td>
                        <td class="py-3.5 px-4">
                            @if($informe->solucionado)
                                <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700 border border-emerald-200/60">
                                    Solucionado
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-rose-100 text-rose-700 border border-rose-200/60">
                                    Pendiente
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-right">
                            <a href="/admin/informes/{{ $informe->id }}/pdf"
                               target="_blank"
                               class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 text-xs font-bold transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                                PDF
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-10 text-slate-400 font-medium italic">
                            No existen informes registrados para este usuario.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection