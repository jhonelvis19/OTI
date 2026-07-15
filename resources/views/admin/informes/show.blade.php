@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto mb-10">

    <div class="bg-white rounded-2xl shadow-sm border border-indigo-300 overflow-hidden">

        <!-- HEADER -->
        <div class="flex items-center gap-3 px-8 py-5 border-b border-indigo-200 bg-slate-50">
            <img src="{{ asset('images/oti-ofic.png') }}"
                 alt="Logo"
                 class="h-12 w-auto object-contain">

            <div class="ml-auto text-right">
                <span class="px-3 py-1 bg-indigo-100 text-indigo-800 text-xs font-bold uppercase rounded-full tracking-wide">
                    {{ $informe->codigo_informe }}
                </span>
                <h1 class="text-xl font-bold text-slate-800 mt-1">
                    Detalle de Informe Técnico
                </h1>
                <p class="text-xs text-gray-400">
                    Registrado por {{ $informe->user->name }} {{ $informe->user->apellido }} el {{ $informe->fecha }} a las {{ $informe->hora_inicio }}
                </p>
            </div>
        </div>

        <!-- DETALLE CONTENIDO -->
        <div class="p-8">

            <!-- DATOS DEL USUARIO -->
            <div class="relative border border-indigo-300 rounded-2xl p-6 mb-8 mt-2">
                <div class="absolute -top-3.5 left-5 bg-white px-3">
                    <h2 class="text-sm font-semibold text-indigo-500 uppercase tracking-wide">
                        Datos del Usuario
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1">Nombre y Apellido</p>
                        <p class="text-sm font-medium text-slate-800 bg-slate-50 border border-slate-100 rounded-xl px-4 py-3">
                            {{ $informe->nombre_atendido }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1">DNI</p>
                        <p class="text-sm font-medium text-slate-800 bg-slate-50 border border-slate-100 rounded-xl px-4 py-3">
                            {{ $informe->dni_atendido }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1">Oficina</p>
                        <p class="text-sm font-medium text-slate-800 bg-slate-50 border border-slate-100 rounded-xl px-4 py-3">
                            {{ $informe->otra_oficina ?? $informe->oficina?->nombre }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- PERSONA QUE ATENDIÓ EL PROBLEMA -->
            <div class="relative border border-indigo-300 rounded-2xl p-6 mb-8">
                <div class="absolute -top-3.5 left-5 bg-white px-3">
                    <h2 class="text-sm font-semibold text-indigo-500 uppercase tracking-wide">
                        Persona que atendió el problema
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1">Sede</p>
                        <p class="text-sm font-medium text-slate-800 bg-slate-50 border border-slate-100 rounded-xl px-4 py-3">
                            {{ $informe->sede?->nombre }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1">Persona Atendida</p>
                        <p class="text-sm font-medium text-slate-800 bg-slate-50 border border-slate-100 rounded-xl px-4 py-3 capitalize">
                            {{ $informe->persona_atendida }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- INFORMACIÓN CON RESPECTO AL MANTENIMIENTO -->
            <div class="relative border border-indigo-300 rounded-2xl p-6 mb-8">
                <div class="absolute -top-3.5 left-5 bg-white px-3">
                    <h2 class="text-sm font-semibold text-indigo-500 uppercase tracking-wide">
                        Información con respecto al mantenimiento
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1">Código Patrimonial</p>
                        <p class="text-sm font-medium text-slate-800 bg-slate-50 border border-slate-100 rounded-xl px-4 py-3">
                            {{ $informe->codigo_patrimonial }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1">Tipo de Equipo</p>
                        <p class="text-sm font-medium text-slate-800 bg-slate-50 border border-slate-100 rounded-xl px-4 py-3">
                            {{ $informe->otro_equipo ?? $informe->tipoEquipo?->nombre }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1">Cantidad</p>
                        <p class="text-sm font-medium text-slate-800 bg-slate-50 border border-slate-100 rounded-xl px-4 py-3">
                            {{ $informe->numero_equipos }}
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1">Marca</p>
                        <p class="text-sm font-medium text-slate-800 bg-slate-50 border border-slate-100 rounded-xl px-4 py-3">
                            {{ $informe->marca }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1">Modelo</p>
                        <p class="text-sm font-medium text-slate-800 bg-slate-50 border border-slate-100 rounded-xl px-4 py-3">
                            {{ $informe->modelo }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1">Serie</p>
                        <p class="text-sm font-medium text-slate-800 bg-slate-50 border border-slate-100 rounded-xl px-4 py-3">
                            {{ $informe->serie ?? 'N/A' }}
                        </p>
                    </div>
                </div>

                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-2">Datos para su Resolución (Incidencias)</p>
                    <div class="flex flex-wrap gap-2 p-4 rounded-xl border border-slate-100 bg-slate-50">
                        @forelse($informe->tiposIncidencias as $incidencia)
                            <span class="px-3 py-1.5 bg-indigo-100 text-indigo-700 text-xs font-semibold rounded-lg border border-indigo-200">
                                {{ $incidencia->nombre }}
                            </span>
                        @empty
                            <span class="text-xs text-gray-400 italic">Ninguna incidencia registrada</span>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- FACTIBILIDAD DE SOLUCIÓN -->
            <div class="relative border border-indigo-300 rounded-2xl p-6 mb-8">
                <div class="absolute -top-3.5 left-5 bg-white px-3">
                    <h2 class="text-sm font-semibold text-indigo-500 uppercase tracking-wide">
                        Factibilidad de solución
                    </h2>
                </div>

                <div class="space-y-6">
                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1">Descripción del Problema</p>
                        <div class="text-sm text-slate-800 bg-slate-50 border border-slate-100 rounded-xl px-4 py-3 whitespace-pre-line leading-relaxed">
                            {{ $informe->descripcion_problema }}
                        </div>
                    </div>

                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-2">¿El problema se pudo solucionar?</p>
                        <div>
                            @if($informe->solucionado)
                                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-green-100 text-green-800 text-xs font-bold uppercase rounded-lg border border-green-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Sí, solucionado
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-red-100 text-red-800 text-xs font-bold uppercase rounded-lg border border-red-200">
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
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1">Resolución Técnica</p>
                            <div class="text-sm text-slate-800 bg-red-50/50 border border-red-100 rounded-xl px-4 py-3 whitespace-pre-line leading-relaxed">
                                {{ $informe->resolucion_tecnica }}
                            </div>
                        </div>
                    @endif

                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1">Comentario y Observaciones</p>
                        <div class="text-sm text-slate-800 bg-slate-50 border border-slate-100 rounded-xl px-4 py-3 whitespace-pre-line leading-relaxed">
                            {{ $informe->observaciones ?? 'Sin observaciones' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- BOTONES DE ACCIONES -->
            <div class="flex justify-between items-center pt-2">
                <a href="/admin/informes"
                   class="px-5 py-2.5 rounded-xl border border-gray-200 text-slate-600 text-sm font-medium
                          hover:bg-slate-50 transition duration-200 inline-flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Volver al Historial
                </a>

                <div class="flex gap-3">
                    <a href="/admin/informes/{{ $informe->id }}/pdf"
                       target="_blank"
                       class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700
                              text-white px-5 py-2.5 rounded-xl text-sm font-medium
                              transition duration-200 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Ver PDF
                    </a>

                    <a href="/admin/informes/{{ $informe->id }}/pdf/download"
                       class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700
                              text-white px-5 py-2.5 rounded-xl text-sm font-medium
                              transition duration-200 shadow-sm">
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