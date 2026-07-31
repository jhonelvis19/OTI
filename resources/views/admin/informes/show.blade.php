@extends('layouts.app')

@section('content')

<div class="space-y-6 max-w-5xl mx-auto">

    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-100/80 overflow-hidden space-y-8">

        <!-- HEADER -->
        <div class="flex items-center justify-between border-b border-slate-100 pb-5">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/oti-ofic.png') }}"
                     alt="Logo OTI"
                     class="h-10 w-auto object-contain">
                <div>
                    <h1 class="text-xl sm:text-2xl font-extrabold text-slate-800 tracking-tight">
                        Detalle del Informe Técnico
                    </h1>
                    <p class="text-xs text-slate-400 mt-0.5">
                        Registrado por {{ $informe->user->name }} {{ $informe->user->apellido }} el {{ $informe->fecha }} a las {{ $informe->hora_inicio }}
                    </p>
                </div>
            </div>

            <span class="px-3.5 py-1.5 bg-violet-50 text-violet-700 text-xs font-bold uppercase rounded-full border border-violet-100 shadow-sm">
                {{ $informe->codigo_informe }}
            </span>
        </div>

        <!-- DETALLE CONTENIDO -->
        <div class="space-y-8">

            <!-- 1. DATOS DEL USUARIO -->
            <div class="relative border border-slate-200/80 rounded-3xl p-6 bg-slate-50/40">
                <div class="absolute -top-3.5 left-5 bg-white px-3 py-0.5 rounded-full border border-slate-200/60 shadow-sm">
                    <h2 class="text-xs font-extrabold text-violet-700 uppercase tracking-wide">
                        1. Datos del Usuario
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-2">
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wide mb-1">Nombre y Apellido</p>
                        <p class="text-xs sm:text-sm font-semibold text-slate-800 bg-white border border-slate-200/80 rounded-xl px-4 py-3">
                            {{ $informe->nombre_atendido }}
                        </p>
                    </div>

                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wide mb-1">DNI</p>
                        <p class="text-xs sm:text-sm font-semibold text-slate-800 bg-white border border-slate-200/80 rounded-xl px-4 py-3">
                            {{ $informe->dni_atendido }}
                        </p>
                    </div>

                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wide mb-1">Oficina</p>
                        <p class="text-xs sm:text-sm font-semibold text-slate-800 bg-white border border-slate-200/80 rounded-xl px-4 py-3">
                            {{ $informe->otra_oficina ?? $informe->oficina?->nombre }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- 2. PERSONA QUE ATENDIÓ EL PROBLEMA -->
            <div class="relative border border-slate-200/80 rounded-3xl p-6 bg-slate-50/40">
                <div class="absolute -top-3.5 left-5 bg-white px-3 py-0.5 rounded-full border border-slate-200/60 shadow-sm">
                    <h2 class="text-xs font-extrabold text-violet-700 uppercase tracking-wide">
                        2. Persona que atendió el problema
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wide mb-1">Sede</p>
                        <p class="text-xs sm:text-sm font-semibold text-slate-800 bg-white border border-slate-200/80 rounded-xl px-4 py-3">
                            {{ $informe->sede?->nombre }}
                        </p>
                    </div>

                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wide mb-1">Persona Atendida</p>
                        <p class="text-xs sm:text-sm font-semibold text-slate-800 bg-white border border-slate-200/80 rounded-xl px-4 py-3 capitalize">
                            {{ $informe->persona_atendida }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- 3. INFORMACIÓN DEL MANTENIMIENTO -->
            <div class="relative border border-slate-200/80 rounded-3xl p-6 bg-slate-50/40">
                <div class="absolute -top-3.5 left-5 bg-white px-3 py-0.5 rounded-full border border-slate-200/60 shadow-sm">
                    <h2 class="text-xs font-extrabold text-violet-700 uppercase tracking-wide">
                        3. Información del Equipo & Incidencias
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-2 mb-6">
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wide mb-1">Código Patrimonial</p>
                        <p class="text-xs sm:text-sm font-semibold text-slate-800 bg-white border border-slate-200/80 rounded-xl px-4 py-3">
                            {{ $informe->codigo_patrimonial }}
                        </p>
                    </div>

                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wide mb-1">Tipo de Equipo</p>
                        <p class="text-xs sm:text-sm font-semibold text-slate-800 bg-white border border-slate-200/80 rounded-xl px-4 py-3">
                            {{ $informe->otro_equipo ?? $informe->tipoEquipo?->nombre }}
                        </p>
                    </div>

                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wide mb-1">Cantidad de Equipos</p>
                        <p class="text-xs sm:text-sm font-bold text-slate-800 bg-white border border-slate-200/80 rounded-xl px-4 py-3">
                            {{ $informe->numero_equipos }}
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wide mb-1">Marca</p>
                        <p class="text-xs sm:text-sm font-semibold text-slate-800 bg-white border border-slate-200/80 rounded-xl px-4 py-3">
                            {{ $informe->marca }}
                        </p>
                    </div>

                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wide mb-1">Modelo</p>
                        <p class="text-xs sm:text-sm font-semibold text-slate-800 bg-white border border-slate-200/80 rounded-xl px-4 py-3">
                            {{ $informe->modelo }}
                        </p>
                    </div>

                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wide mb-1">Serie</p>
                        <p class="text-xs sm:text-sm font-semibold text-slate-800 bg-white border border-slate-200/80 rounded-xl px-4 py-3">
                            {{ $informe->serie ?? 'N/A' }}
                        </p>
                    </div>
                </div>

                <div>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wide mb-2">Incidencias Atendidas</p>
                    <div class="flex flex-wrap gap-2 p-4 rounded-2xl border border-slate-200/80 bg-white">
                        @forelse($informe->tiposIncidencias as $incidencia)
                            <span class="px-3 py-1.5 bg-violet-50 text-violet-700 text-xs font-bold rounded-xl border border-violet-100">
                                {{ $incidencia->nombre }}
                            </span>
                        @empty
                            <span class="text-xs text-slate-400 italic">Ninguna incidencia registrada</span>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- 4. FACTIBILIDAD DE SOLUCIÓN -->
            <div class="relative border border-slate-200/80 rounded-3xl p-6 bg-slate-50/40">
                <div class="absolute -top-3.5 left-5 bg-white px-3 py-0.5 rounded-full border border-slate-200/60 shadow-sm">
                    <h2 class="text-xs font-extrabold text-violet-700 uppercase tracking-wide">
                        4. Factibilidad de solución & Observaciones
                    </h2>
                </div>

                <div class="space-y-6 pt-2">
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wide mb-1">Descripción del Problema</p>
                        <div class="text-xs sm:text-sm text-slate-800 bg-white border border-slate-200/80 rounded-xl px-4 py-3 whitespace-pre-line leading-relaxed break-words">
                            {{ $informe->descripcion_problema }}
                        </div>
                    </div>

                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wide mb-2">¿El problema se pudo solucionar?</p>
                        <div>
                            @if($informe->solucionado)
                                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-emerald-100 text-emerald-800 text-xs font-bold uppercase rounded-xl border border-emerald-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Sí, solucionado
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-rose-100 text-rose-800 text-xs font-bold uppercase rounded-xl border border-rose-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    No solucionado
                                </span>
                            @endif
                        </div>
                    </div>

                    @if(!$informe->solucionado && $informe->resolucion_tecnica)
                        <div>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wide mb-1">Resolución Técnica</p>
                            <div class="text-xs sm:text-sm text-slate-800 bg-rose-50/50 border border-rose-100 rounded-xl px-4 py-3 whitespace-pre-line leading-relaxed break-words">
                                {{ $informe->resolucion_tecnica }}
                            </div>
                        </div>
                    @endif

                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wide mb-1">Comentarios y Observaciones</p>
                        <div class="text-xs sm:text-sm text-slate-800 bg-white border border-slate-200/80 rounded-xl px-4 py-3 whitespace-pre-line leading-relaxed break-words">
                            {{ $informe->observaciones ?? 'Sin observaciones' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- BOTONES DE ACCIONES -->
            @php
                $previousUrl = url()->previous();
                $volverUrl = '/admin/informes';
                $volverTexto = 'Volver al Historial';

                if (str_contains($previousUrl, 'mis-informes')) {
                    $volverUrl = '/admin/mis-informes';
                    $volverTexto = 'Volver a Mis Informes';
                }
            @endphp
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pt-4 border-t border-slate-100">
                <a href="{{ $volverUrl }}"
                   class="px-5 py-3 rounded-2xl border border-slate-200 text-slate-600 text-xs font-bold hover:bg-slate-50 transition inline-flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    {{ $volverTexto }}
                </a>

                <div class="flex items-center gap-3 justify-end">
                    <a href="/admin/informes/{{ $informe->id }}/pdf"
                       target="_blank"
                       class="inline-flex items-center gap-2 bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold px-5 py-3 rounded-2xl shadow-lg shadow-rose-600/20 transition-all hover:scale-[1.02] active:scale-95">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Ver PDF
                    </a>

                    <a href="/admin/informes/{{ $informe->id }}/pdf/download"
                       class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white text-xs font-bold px-5 py-3 rounded-2xl shadow-lg shadow-emerald-500/20 transition-all hover:scale-[1.02] active:scale-95">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Descargar PDF
                    </a>
                </div>
            </div>

        </div>

    </div>

</div>

@endsection