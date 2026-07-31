@extends('layouts.app')

@section('content')

<div class="space-y-6 max-w-5xl mx-auto">

    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-100/80 overflow-hidden space-y-8">

        <!-- HEADER FORMULARIO CON INDICADOR DE PROCESO DE PASOS (STEPPER WIZARD) -->
        <div class="space-y-6 border-b border-slate-100 pb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="p-2.5 rounded-2xl bg-violet-50 text-violet-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl sm:text-2xl font-extrabold text-slate-800 tracking-tight">
                            {{ isset($informe) ? 'Editar Informe Técnico' : 'Nuevo Informe Técnico' }}
                        </h1>
                        <p class="text-xs text-slate-400 mt-0.5">
                            Complete los campos requeridos para avanzar en el proceso del informe.
                        </p>
                    </div>
                </div>
                <img src="{{ asset('images/oti-ofic.png') }}" alt="Logo OTI" class="h-14 sm:h-16 w-auto object-contain hidden sm:block filter drop-shadow-sm transition-transform hover:scale-105">
            </div>

            <!-- BARRA DE PROCESO / STEPPER WIZARD -->
            <div class="pt-2">
                <div class="relative flex items-center justify-between w-full max-w-4xl mx-auto px-2 sm:px-6">
                    <!-- Linea de fondo -->
                    <div class="absolute left-6 right-6 top-1/2 -translate-y-1/2 h-1 bg-slate-100 rounded-full z-0"></div>
                    <!-- Linea activa -->
                    <div id="progress-bar-fill" class="absolute left-6 top-1/2 -translate-y-1/2 h-1 bg-gradient-to-r from-violet-600 to-indigo-600 rounded-full transition-all duration-300 z-0" style="width: 0%;"></div>

                    <!-- PASO 1 -->
                    <div id="step-btn-1" class="relative z-10 flex flex-col items-center cursor-pointer" onclick="goToStep(1)">
                        <div id="step-circle-1" class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-gradient-to-r from-violet-600 to-indigo-600 text-white font-bold text-xs flex items-center justify-center shadow-lg shadow-violet-500/30 transition-all duration-300 ring-4 ring-white">
                            1
                        </div>
                        <span id="step-label-1" class="text-[10px] sm:text-[11px] font-bold text-violet-700 mt-1.5 tracking-wide">1. Usuario</span>
                    </div>

                    <!-- PASO 2 -->
                    <div id="step-btn-2" class="relative z-10 flex flex-col items-center cursor-pointer" onclick="goToStep(2)">
                        <div id="step-circle-2" class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-slate-100 text-slate-400 font-bold text-xs flex items-center justify-center transition-all duration-300 ring-4 ring-white">
                            2
                        </div>
                        <span id="step-label-2" class="text-[10px] sm:text-[11px] font-semibold text-slate-400 mt-1.5 tracking-wide">2. Sede</span>
                    </div>

                    <!-- PASO 3 -->
                    <div id="step-btn-3" class="relative z-10 flex flex-col items-center cursor-pointer" onclick="goToStep(3)">
                        <div id="step-circle-3" class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-slate-100 text-slate-400 font-bold text-xs flex items-center justify-center transition-all duration-300 ring-4 ring-white">
                            3
                        </div>
                        <span id="step-label-3" class="text-[10px] sm:text-[11px] font-semibold text-slate-400 mt-1.5 tracking-wide">3. Equipo</span>
                    </div>

                    <!-- PASO 4 -->
                    <div id="step-btn-4" class="relative z-10 flex flex-col items-center cursor-pointer" onclick="goToStep(4)">
                        <div id="step-circle-4" class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-slate-100 text-slate-400 font-bold text-xs flex items-center justify-center transition-all duration-300 ring-4 ring-white">
                            4
                        </div>
                        <span id="step-label-4" class="text-[10px] sm:text-[11px] font-semibold text-slate-400 mt-1.5 tracking-wide">4. Diagnóstico</span>
                    </div>

                    <!-- PASO 5 -->
                    <div id="step-btn-5" class="relative z-10 flex flex-col items-center cursor-pointer" onclick="goToStep(5)">
                        <div id="step-circle-5" class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-slate-100 text-slate-400 font-bold text-xs flex items-center justify-center transition-all duration-300 ring-4 ring-white">
                            5
                        </div>
                        <span id="step-label-5" class="text-[10px] sm:text-[11px] font-semibold text-slate-400 mt-1.5 tracking-wide">5. Firmas</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- FORMULARIO -->
        <form id="informe-form" method="POST"
            action="{{ isset($informe)
                ? (auth()->user()->rol == 'admin'
                    ? '/admin/informes/'.$informe->id
                    : '/usuario/informes/'.$informe->id)
                : (auth()->user()->rol == 'admin'
                    ? '/admin/informes'
                    : '/usuario/informes') }}">

            @csrf
            @if(isset($informe))
                @method('PUT')
            @endif

            <input type="hidden" name="redirect_to" value="{{ old('redirect_to', url()->previous()) }}">

            @if(!isset($informe))
                <input type="hidden" name="firma_persona_data" id="firma_persona_data">
                <input type="hidden" name="firma_persona_metodo" id="firma_persona_metodo">
                <input type="hidden" name="firma_tecnico_data" id="firma_tecnico_data">
                <input type="hidden" name="firma_tecnico_metodo" id="firma_tecnico_metodo">
            @endif

            <div id="form-fields-container">

                <!-- PASO 1: DATOS DEL USUARIO -->
                <div id="step-content-1" class="step-panel space-y-6">
                    <div class="border border-slate-200/80 rounded-3xl p-6 bg-slate-50/40 space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-200/60 pb-3 mb-2">
                            <h2 class="text-xs font-extrabold text-violet-700 uppercase tracking-wide flex items-center gap-2">
                                <span class="w-6 h-6 rounded-full bg-violet-100 text-violet-700 text-xs flex items-center justify-center font-bold">1</span>
                                Datos del Usuario Atendido
                            </h2>
                            <span class="text-xs text-slate-400 font-medium">Paso 1 de 5</span>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                            <!-- NOMBRE Y APELLIDO -->
                            <div>
                                <label class="block mb-2 text-xs font-bold text-slate-700 uppercase tracking-wide">
                                    Nombre y Apellido <span class="text-rose-500 font-bold">*</span>
                                </label>
                                <input
                                    type="text"
                                    id="nombre_atendido"
                                    name="nombre_atendido"
                                    value="{{ old('nombre_atendido', $informe->nombre_atendido ?? '') }}"
                                    placeholder="Ingrese nombre completo"
                                    class="w-full rounded-xl border {{ $errors->has('nombre_atendido') ? 'border-rose-400 bg-rose-50' : 'border-slate-200 bg-white' }} px-4 py-3 text-xs sm:text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 outline-none transition">
                                @error('nombre_atendido')
                                    <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- DNI -->
                            <div>
                                <label class="block mb-2 text-xs font-bold text-slate-700 uppercase tracking-wide">
                                    DNI <span class="text-rose-500 font-bold">*</span>
                                </label>
                                <input
                                    type="text"
                                    id="dni_atendido"
                                    name="dni_atendido"
                                    maxlength="8"
                                    value="{{ old('dni_atendido', $informe->dni_atendido ?? '') }}"
                                    placeholder="00000000"
                                    class="w-full rounded-xl border {{ $errors->has('dni_atendido') ? 'border-rose-400 bg-rose-50' : 'border-slate-200 bg-white' }} px-4 py-3 text-xs sm:text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 outline-none transition">
                                @error('dni_atendido')
                                    <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- OFICINA -->
                            <div>
                                <label class="block mb-2 text-xs font-bold text-slate-700 uppercase tracking-wide">
                                    Oficina <span class="text-rose-500 font-bold">*</span>
                                </label>
                                <select
                                    id="oficina"
                                    name="oficina_id"
                                    class="w-full rounded-xl border {{ $errors->has('oficina_id') ? 'border-rose-400 bg-rose-50' : 'border-slate-200 bg-white' }} px-4 py-3 text-xs sm:text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 outline-none transition">
                                    <option value="">Seleccione una oficina</option>
                                    @foreach($oficinas as $oficina)
                                        <option value="{{ $oficina->id }}"
                                            {{ old('oficina_id', $informe->oficina_id ?? '') == $oficina->id ? 'selected' : '' }}>
                                            {{ $oficina->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('oficina_id')
                                    <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- NUEVA OFICINA -->
                            <div id="otra_oficina_box" class="{{ old('oficina_id', $informe->oficina_id ?? '') == $oficinaOtrosId ? '' : 'hidden' }}">
                                <label class="block mb-2 text-xs font-bold text-slate-700 uppercase tracking-wide">
                                    Nueva Oficina <span class="text-rose-500 font-bold">*</span>
                                </label>
                                <input
                                    type="text"
                                    id="otra_oficina"
                                    name="otra_oficina"
                                    value="{{ old('otra_oficina', $informe->otra_oficina ?? '') }}"
                                    placeholder="Escriba la nueva oficina"
                                    class="w-full rounded-xl border {{ $errors->has('otra_oficina') ? 'border-rose-400 bg-rose-50' : 'border-slate-200 bg-white' }} px-4 py-3 text-xs sm:text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 outline-none transition">
                                @error('otra_oficina')
                                    <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PASO 2: SEDE Y PERSONA ATENDIDA -->
                <div id="step-content-2" class="step-panel hidden space-y-6">
                    <div class="border border-slate-200/80 rounded-3xl p-6 bg-slate-50/40 space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-200/60 pb-3 mb-2">
                            <h2 class="text-xs font-extrabold text-violet-700 uppercase tracking-wide flex items-center gap-2">
                                <span class="w-6 h-6 rounded-full bg-violet-100 text-violet-700 text-xs flex items-center justify-center font-bold">2</span>
                                Sede y Tipo de Atendido
                            </h2>
                            <span class="text-xs text-slate-400 font-medium">Paso 2 de 5</span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block mb-2 text-xs font-bold text-slate-700 uppercase tracking-wide">
                                    Sede <span class="text-rose-500 font-bold">*</span>
                                </label>
                                <select
                                    id="sede_id"
                                    name="sede_id"
                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-xs sm:text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 outline-none transition">
                                    @foreach($sedes as $sede)
                                        <option value="{{ $sede->id }}"
                                            {{ old('sede_id', $informe->sede_id ?? '') == $sede->id ? 'selected' : '' }}>
                                            {{ $sede->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('sede_id')
                                    <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block mb-2 text-xs font-bold text-slate-700 uppercase tracking-wide">
                                    Persona Atendida <span class="text-rose-500 font-bold">*</span>
                                </label>
                                <select
                                    id="persona_atendida"
                                    name="persona_atendida"
                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-xs sm:text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 outline-none transition">
                                    <option value="titular" {{ (isset($informe) && $informe->persona_atendida == 'titular') ? 'selected' : '' }}>Titular</option>
                                    <option value="usuario" {{ (isset($informe) && $informe->persona_atendida == 'usuario') ? 'selected' : '' }}>Usuario</option>
                                    <option value="otros" {{ (isset($informe) && $informe->persona_atendida == 'otros') ? 'selected' : '' }}>Otros</option>
                                </select>
                                @error('persona_atendida')
                                    <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PASO 3: INFORMACIÓN DEL EQUIPO E INCIDENCIAS -->
                <div id="step-content-3" class="step-panel hidden space-y-6">
                    <div class="border border-slate-200/80 rounded-3xl p-6 bg-slate-50/40 space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-200/60 pb-3 mb-2">
                            <h2 class="text-xs font-extrabold text-violet-700 uppercase tracking-wide flex items-center gap-2">
                                <span class="w-6 h-6 rounded-full bg-violet-100 text-violet-700 text-xs flex items-center justify-center font-bold">3</span>
                                Información del Equipo & Incidencia
                            </h2>
                            <span class="text-xs text-slate-400 font-medium">Paso 3 de 5</span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block mb-2 text-xs font-bold text-slate-700 uppercase tracking-wide">
                                    Código Patrimonial <span class="text-rose-500 font-bold">*</span>
                                </label>
                                <input
                                    type="text"
                                    id="codigo_patrimonial"
                                    name="codigo_patrimonial"
                                    value="{{ old('codigo_patrimonial', $informe->codigo_patrimonial ?? '') }}"
                                    placeholder="Ingrese el código patrimonial"
                                    class="w-full rounded-xl border {{ $errors->has('codigo_patrimonial') ? 'border-rose-400 bg-rose-50' : 'border-slate-200 bg-white' }} px-4 py-3 text-xs sm:text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 outline-none transition">
                                @error('codigo_patrimonial')
                                    <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block mb-2 text-xs font-bold text-slate-700 uppercase tracking-wide">
                                    Tipo de Equipo <span class="text-rose-500 font-bold">*</span>
                                </label>
                                <div class="flex gap-3 items-center">
                                    <select
                                        id="tipo_equipo_id"
                                        name="tipo_equipo_id"
                                        class="rounded-xl border {{ $errors->has('tipo_equipo_id') ? 'border-rose-400 bg-rose-50' : 'border-slate-200 bg-white' }} px-4 py-3 text-xs sm:text-sm flex-1 min-w-0 focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 outline-none transition">
                                        @foreach($tiposEquipos as $equipo)
                                            <option value="{{ $equipo->id }}"
                                                {{ old('tipo_equipo_id', $informe->tipo_equipo_id ?? '') == $equipo->id ? 'selected' : '' }}>
                                                {{ $equipo->nombre }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <div id="otro_equipo_box" class="{{ old('tipo_equipo_id', $informe->tipo_equipo_id ?? '') == $tipoEquipoOtrosId ? 'flex-1 min-w-0' : 'hidden flex-1 min-w-0' }}">
                                        <input
                                            type="text"
                                            id="otro_equipo_input"
                                            name="otro_equipo"
                                            value="{{ old('otro_equipo', $informe->otro_equipo ?? '') }}"
                                            placeholder="Especifique el equipo"
                                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-xs sm:text-sm focus:ring-2 focus:ring-violet-500/20 outline-none">
                                    </div>
                                </div>
                                @error('tipo_equipo_id')
                                    <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block mb-2 text-xs font-bold text-slate-700 uppercase tracking-wide">
                                    Marca <span class="text-rose-500 font-bold">*</span>
                                </label>
                                <input
                                    type="text"
                                    id="marca"
                                    name="marca"
                                    value="{{ old('marca', $informe->marca ?? '') }}"
                                    placeholder="Ej: HP, Dell, Lenovo"
                                    class="w-full rounded-xl border {{ $errors->has('marca') ? 'border-rose-400 bg-rose-50' : 'border-slate-200 bg-white' }} px-4 py-3 text-xs sm:text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 outline-none transition">
                                @error('marca')
                                    <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block mb-2 text-xs font-bold text-slate-700 uppercase tracking-wide">
                                    Modelo <span class="text-rose-500 font-bold">*</span>
                                </label>
                                <input
                                    type="text"
                                    id="modelo"
                                    name="modelo"
                                    value="{{ old('modelo', $informe->modelo ?? '') }}"
                                    placeholder="Ingrese el modelo"
                                    class="w-full rounded-xl border {{ $errors->has('modelo') ? 'border-rose-400 bg-rose-50' : 'border-slate-200 bg-white' }} px-4 py-3 text-xs sm:text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 outline-none transition">
                                @error('modelo')
                                    <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block mb-2 text-xs font-bold text-slate-700 uppercase tracking-wide">Serie</label>
                                <input
                                    type="text"
                                    name="serie"
                                    value="{{ old('serie') ?? ($informe->serie ?? '') }}"
                                    placeholder="Número de serie"
                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-xs sm:text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 outline-none transition">
                            </div>

                            <div class="flex items-end gap-4">
                                <div class="flex-1">
                                    <label class="block mb-2 text-xs font-bold text-slate-700 uppercase tracking-wide">
                                        Datos para su Resolución
                                    </label>
                                    <div class="flex flex-wrap gap-3 p-4 rounded-2xl border border-slate-200 bg-white shadow-sm">
                                        @foreach($tiposIncidencias as $incidencia)
                                            <label class="flex items-center gap-2 cursor-pointer group">
                                                <input
                                                    type="checkbox"
                                                    name="tipo_incidencia_id[]"
                                                    value="{{ $incidencia->id }}"
                                                    {{ in_array($incidencia->id, old('tipo_incidencia_id', isset($informe) ? $informe->tiposIncidencias->pluck('id')->toArray() : [])) ? 'checked' : '' }}
                                                    class="w-4 h-4 rounded border-slate-300 text-violet-600 focus:ring-2 focus:ring-violet-500/30 cursor-pointer">
                                                <span class="text-xs font-medium text-slate-600 group-hover:text-violet-600 transition">
                                                    {{ $incidencia->nombre }}
                                                </span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="w-28">
                                    <label class="block mb-2 text-xs font-bold text-slate-700 uppercase tracking-wide">Cantidad</label>
                                    <input
                                        type="number"
                                        name="numero_equipos"
                                        value="{{ old('numero_equipos') ?? ($informe->numero_equipos ?? '1') }}"
                                        min="1"
                                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-xs sm:text-sm text-center font-bold text-slate-800 focus:ring-2 focus:ring-violet-500/20 outline-none">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PASO 4: FACTIBILIDAD Y DIAGNÓSTICO -->
                <div id="step-content-4" class="step-panel hidden space-y-6">
                    <div class="border border-slate-200/80 rounded-3xl p-6 bg-slate-50/40 space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-200/60 pb-3 mb-2">
                            <h2 class="text-xs font-extrabold text-violet-700 uppercase tracking-wide flex items-center gap-2">
                                <span class="w-6 h-6 rounded-full bg-violet-100 text-violet-700 text-xs flex items-center justify-center font-bold">4</span>
                                Factibilidad & Observaciones
                            </h2>
                            <span class="text-xs text-slate-400 font-medium">Paso 4 de 5</span>
                        </div>

                        <div class="space-y-5">
                            <div>
                                <label class="block mb-2 text-xs font-bold text-slate-700 uppercase tracking-wide">
                                    Descripción del Problema <span class="text-rose-500 font-bold">*</span>
                                </label>
                                <textarea
                                    id="descripcion_problema"
                                    name="descripcion_problema"
                                    rows="4"
                                    placeholder="Descripción detallada del mantenimiento o problema presentado..."
                                    class="w-full rounded-xl border {{ $errors->has('descripcion_problema') ? 'border-rose-400 bg-rose-50' : 'border-slate-200 bg-white' }} px-4 py-3 text-xs sm:text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 outline-none transition resize-none">{{ old('descripcion_problema', $informe->descripcion_problema ?? '') }}</textarea>
                                @error('descripcion_problema')
                                    <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block mb-2 text-xs font-bold text-slate-700 uppercase tracking-wide">
                                    ¿El problema se pudo solucionar?
                                </label>
                                <div class="flex gap-4">
                                    <label class="flex items-center gap-2 cursor-pointer group px-4 py-2 bg-white rounded-xl border border-slate-200 shadow-sm">
                                        <input
                                            type="radio"
                                            id="solucionado_si"
                                            name="problema_solucionado"
                                            value="si"
                                            {{ old('problema_solucionado', isset($informe) ? ($informe->solucionado ? 'si' : 'no') : 'si') == 'si' ? 'checked' : '' }}
                                            class="w-4 h-4 text-violet-600 border-slate-300 focus:ring-violet-500">
                                        <span class="text-xs font-bold text-slate-700 group-hover:text-violet-600 transition">Sí</span>
                                    </label>

                                    <label class="flex items-center gap-2 cursor-pointer group px-4 py-2 bg-white rounded-xl border border-slate-200 shadow-sm">
                                        <input
                                            type="radio"
                                            id="solucionado_no"
                                            name="problema_solucionado"
                                            value="no"
                                            {{ old('problema_solucionado', isset($informe) ? ($informe->solucionado ? 'si' : 'no') : '') == 'no' ? 'checked' : '' }}
                                            class="w-4 h-4 text-violet-600 border-slate-300 focus:ring-violet-500">
                                        <span class="text-xs font-bold text-slate-700 group-hover:text-violet-600 transition">No</span>
                                    </label>
                                </div>
                            </div>

                            <div id="resolucion_box" class="{{ old('problema_solucionado', isset($informe) ? ($informe->solucionado ? 'si' : 'no') : '') == 'no' ? '' : 'hidden' }} transition-all duration-300">
                                <label class="block mb-2 text-xs font-bold text-slate-700 uppercase tracking-wide">
                                    Resolución Técnica <span class="text-rose-500 font-bold">*</span>
                                </label>
                                <textarea
                                    id="resolucion_tecnica"
                                    name="resolucion_tecnica"
                                    rows="4"
                                    placeholder="Indicar por qué no se pudo solucionar..."
                                    class="w-full rounded-xl border {{ $errors->has('resolucion_tecnica') ? 'border-rose-400 bg-rose-50' : 'border-slate-200 bg-white' }} px-4 py-3 text-xs sm:text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 outline-none transition resize-none">{{ old('resolucion_tecnica', $informe->resolucion_tecnica ?? '') }}</textarea>
                                @error('resolucion_tecnica')
                                    <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block mb-2 text-xs font-bold text-slate-700 uppercase tracking-wide">
                                    Comentarios u Observaciones Adicionales
                                </label>
                                <textarea
                                    name="observaciones"
                                    rows="3"
                                    placeholder="Observaciones adicionales (opcional)..."
                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-xs sm:text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 outline-none transition resize-none">{{ old('observaciones', $informe->observaciones ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- /form-fields-container -->

            <!-- PASO 5: SECCIÓN DE FIRMAS DIGITALES -->
            <div id="step-content-5" class="step-panel hidden space-y-6">
                <div id="seccion-firmas" class="relative border border-violet-200 rounded-3xl p-6 sm:p-8 bg-gradient-to-br from-violet-50/50 to-indigo-50/50 space-y-6">
                    <div class="flex justify-between items-center border-b border-violet-200/80 pb-4">
                        <h3 id="firma-header-title" class="text-lg font-bold text-slate-800">Firmas Digitales del Acta</h3>
                        <span id="firma-header-step" class="text-xs font-bold uppercase bg-violet-600 text-white px-3.5 py-1 rounded-full shadow-sm">Etapa 1 de 2</span>
                    </div>

                    <!-- ETAPA 1 FIRMAS: FIRMA PERSONA ATENDIDA -->
                    <div id="paso-firma-persona" class="space-y-6">
                        <p class="text-xs sm:text-sm text-slate-600 font-medium">Por favor, la persona atendida debe registrar su firma para dar conformidad al mantenimiento realizado:</p>
                        
                        <div class="flex flex-col sm:flex-row gap-4">
                            <button type="button" id="btn-persona-dibujar" class="flex-1 py-3 px-4 rounded-2xl border border-slate-200 bg-white text-slate-700 font-bold hover:bg-violet-50 transition text-xs shadow-sm inline-flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                Dibujar en Pantalla
                            </button>
                            <button type="button" id="btn-persona-foto" class="flex-1 py-3 px-4 rounded-2xl border border-slate-200 bg-white text-slate-700 font-bold hover:bg-violet-50 transition text-xs shadow-sm inline-flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Tomar Fotografía
                            </button>
                        </div>

                        <!-- PANEL CANVAS FIRMA PERSONA (ALTA VISIBILIDAD) -->
                        <div id="contenedor-persona-canvas" class="hidden">
                            <div class="border-2 border-violet-400 dark:border-violet-500 rounded-3xl bg-white p-3 relative h-64 shadow-lg ring-4 ring-violet-500/10">
                                <canvas id="canvas-persona" class="w-full h-full cursor-crosshair block rounded-2xl bg-white"></canvas>
                                <div class="absolute bottom-3 left-4 pointer-events-none text-[11px] font-semibold text-slate-400 flex items-center gap-1.5 opacity-60">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-violet-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                    Firma de la persona atendida
                                </div>
                            </div>
                            <p class="text-xs text-slate-400 mt-1.5">Use su dedo, mouse o lápiz digital en el recuadro blanco.</p>
                        </div>

                        <div id="contenedor-persona-foto" class="hidden">
                            <label class="flex flex-col items-center justify-center border-2 border-dashed border-violet-300 rounded-3xl bg-white p-8 cursor-pointer hover:bg-violet-50/50 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-violet-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-xs font-bold text-slate-700">Tomar Foto con la Cámara</span>
                                <input type="file" id="input-persona-foto" accept="image/jpeg,image/png,image/webp" capture="environment" class="hidden">
                            </label>
                        </div>

                        <div id="preview-persona-container" class="hidden border border-slate-200 rounded-2xl bg-white p-4">
                            <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Vista Previa:</h4>
                            <div class="flex justify-center bg-slate-50 p-2 rounded-xl">
                                <img id="preview-persona" src="#" alt="Firma Persona" class="max-h-32 object-contain">
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-2">
                            <button type="button" id="btn-limpiar-persona" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 text-xs font-semibold hover:bg-slate-50 transition">
                                Limpiar / Repetir
                            </button>
                            <button type="button" id="btn-confirmar-persona" disabled class="px-5 py-2.5 rounded-xl bg-violet-600 text-white text-xs font-bold hover:bg-violet-700 transition opacity-50 cursor-not-allowed shadow-md">
                                Confirmar Firma
                            </button>
                        </div>
                    </div>

                    <!-- ETAPA 2 FIRMAS: FIRMA TÉCNICO -->
                    <div id="paso-firma-tecnico" class="hidden space-y-6">
                        <p class="text-xs sm:text-sm text-slate-600 font-medium">Por favor, el técnico responsable del mantenimiento debe firmar a continuación:</p>

                        <div class="flex flex-col sm:flex-row gap-4">
                            @if(auth()->user()->firma)
                            <button type="button" id="btn-tecnico-perfil" class="flex-1 py-3 px-4 rounded-2xl border border-slate-200 bg-white text-slate-700 font-bold hover:bg-violet-50 transition text-xs shadow-sm inline-flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Usar mi firma guardada
                            </button>
                            @endif
                            <button type="button" id="btn-tecnico-dibujar" class="flex-1 py-3 px-4 rounded-2xl border border-slate-200 bg-white text-slate-700 font-bold hover:bg-violet-50 transition text-xs shadow-sm inline-flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                Dibujar en Pantalla
                            </button>
                            <button type="button" id="btn-tecnico-foto" class="flex-1 py-3 px-4 rounded-2xl border border-slate-200 bg-white text-slate-700 font-bold hover:bg-violet-50 transition text-xs shadow-sm inline-flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Tomar Fotografía
                            </button>
                        </div>

                        @if(auth()->user()->firma)
                        <div id="contenedor-tecnico-perfil" class="hidden border border-slate-200 rounded-2xl bg-white p-4">
                            <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Su firma guardada:</h4>
                            <div class="flex justify-center bg-slate-50 p-2 rounded-xl">
                                <img src="{{ asset('storage/' . auth()->user()->firma) }}" alt="Firma Guardada" class="max-h-32 object-contain">
                            </div>
                        </div>
                        @endif

                        <!-- PANEL CANVAS FIRMA TÉCNICO (ALTA VISIBILIDAD) -->
                        <div id="contenedor-tecnico-canvas" class="hidden">
                            <div class="border-2 border-violet-400 dark:border-violet-500 rounded-3xl bg-white p-3 relative h-64 shadow-lg ring-4 ring-violet-500/10">
                                <canvas id="canvas-tecnico" class="w-full h-full cursor-crosshair block rounded-2xl bg-white"></canvas>
                                <div class="absolute bottom-3 left-4 pointer-events-none text-[11px] font-semibold text-slate-400 flex items-center gap-1.5 opacity-60">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-violet-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                    Firma del técnico responsable
                                </div>
                            </div>
                            <p class="text-xs text-slate-400 mt-1.5">Use su dedo, mouse o lápiz digital en el recuadro blanco.</p>
                        </div>

                        <div id="contenedor-tecnico-foto" class="hidden">
                            <label class="flex flex-col items-center justify-center border-2 border-dashed border-violet-300 rounded-3xl bg-white p-8 cursor-pointer hover:bg-violet-50/50 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-violet-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-xs font-bold text-slate-700">Tomar Foto con la Cámara</span>
                                <input type="file" id="input-tecnico-foto" accept="image/jpeg,image/png,image/webp" capture="environment" class="hidden">
                            </label>
                        </div>

                        <div id="preview-tecnico-container" class="hidden border border-slate-200 rounded-2xl bg-white p-4">
                            <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Vista Previa:</h4>
                            <div class="flex justify-center bg-slate-50 p-2 rounded-xl">
                                <img id="preview-tecnico" src="#" alt="Firma Técnico" class="max-h-32 object-contain">
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-2">
                            <button type="button" id="btn-limpiar-tecnico" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 text-xs font-semibold hover:bg-slate-50 transition">
                                Limpiar / Repetir
                            </button>
                            <button type="button" id="btn-confirmar-tecnico" disabled class="px-5 py-2.5 rounded-xl bg-violet-600 text-white text-xs font-bold hover:bg-violet-700 transition opacity-50 cursor-not-allowed shadow-md">
                                Confirmar Firma
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BOTONES DE NAVEGACIÓN WIZARD Y SUBMIT -->
            @php
                $cancelUrl = old('redirect_to', url()->previous());
                if (!$cancelUrl || $cancelUrl == url()->current() || !str_contains($cancelUrl, auth()->user()->rol)) {
                    $cancelUrl = auth()->user()->rol == 'admin' ? '/admin/informes' : '/usuario/informes';
                }
            @endphp
            <div class="flex items-center justify-between pt-6 border-t border-slate-100">
                <!-- Botón Cancelar o Anterior -->
                <div>
                    <button type="button" id="btn-wizard-prev" onclick="changeStep(-1)" class="hidden inline-flex items-center gap-2 px-5 py-3 rounded-2xl border border-slate-200 text-slate-600 text-xs font-bold hover:bg-slate-50 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                        Anterior
                    </button>

                    <a id="btn-wizard-cancel" href="{{ $cancelUrl }}"
                       class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl border border-slate-200 text-slate-600 text-xs font-bold hover:bg-slate-50 transition">
                        Cancelar
                    </a>
                </div>

                <!-- Botón Siguiente o Guardar -->
                <div class="flex items-center gap-3">
                    <button type="button" id="btn-wizard-next" onclick="changeStep(1)" class="inline-flex items-center gap-2 bg-gradient-to-r from-violet-600 to-indigo-600 hover:from-violet-700 hover:to-indigo-700 text-white text-xs font-bold px-7 py-3 rounded-2xl shadow-lg shadow-violet-500/25 transition-all hover:scale-[1.02] active:scale-95">
                        Siguiente
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    @if(!isset($informe))
                        <!-- Botón real para enviar (se activa al completar el paso 5 de firmas) -->
                        <button
                            type="submit"
                            id="btn-guardar-informe"
                            disabled
                            class="hidden inline-flex items-center gap-2 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white text-xs font-bold px-7 py-3 rounded-2xl shadow-lg shadow-emerald-500/20 transition-all opacity-50 cursor-not-allowed">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Guardar Informe
                        </button>
                    @else
                        <button
                            type="submit"
                            id="btn-guardar-informe"
                            class="hidden inline-flex items-center gap-2 bg-gradient-to-r from-violet-600 to-indigo-600 hover:from-violet-700 hover:to-indigo-700 text-white text-xs font-bold px-7 py-3 rounded-2xl shadow-lg shadow-violet-500/25 transition-all hover:scale-[1.02] active:scale-95">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Actualizar Informe
                        </button>
                    @endif
                </div>
            </div>

        </form>

    </div>

</div>

<script src="{{ asset('js/formulario.js') }}"></script>
@if(!isset($informe))
    <script src="{{ asset('js/signature_pad.js') }}"></script>
    <script src="{{ asset('js/firma.js') }}"></script>
@endif

<script>
let currentStep = 1;
const totalSteps = 5;

function updateStepperUI() {
    // Actualizar barra de progreso
    const progressFill = document.getElementById('progress-bar-fill');
    if (progressFill) {
        const percent = ((currentStep - 1) / (totalSteps - 1)) * 100;
        progressFill.style.width = percent + '%';
    }

    // Ocultar/Mostrar paneles de contenido
    for (let i = 1; i <= totalSteps; i++) {
        const panel = document.getElementById('step-content-' + i);
        const circle = document.getElementById('step-circle-' + i);
        const label = document.getElementById('step-label-' + i);

        if (panel) {
            panel.classList.toggle('hidden', i !== currentStep);
        }

        if (circle && label) {
            if (i < currentStep) {
                // Completado
                circle.className = "w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-emerald-500 text-white font-bold text-xs flex items-center justify-center shadow-md transition-all duration-300 ring-4 ring-white";
                circle.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>`;
                label.className = "text-[10px] sm:text-[11px] font-bold text-emerald-600 mt-1.5 tracking-wide";
            } else if (i === currentStep) {
                // Actual
                circle.className = "w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-gradient-to-r from-violet-600 to-indigo-600 text-white font-bold text-xs flex items-center justify-center shadow-lg shadow-violet-500/30 transition-all duration-300 ring-4 ring-white";
                circle.innerHTML = i;
                label.className = "text-[10px] sm:text-[11px] font-bold text-violet-700 mt-1.5 tracking-wide";
            } else {
                // Pendiente
                circle.className = "w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-slate-100 text-slate-400 font-bold text-xs flex items-center justify-center transition-all duration-300 ring-4 ring-white";
                circle.innerHTML = i;
                label.className = "text-[10px] sm:text-[11px] font-semibold text-slate-400 mt-1.5 tracking-wide";
            }
        }
    }

    // Botones de navegación inferiores
    const btnPrev = document.getElementById('btn-wizard-prev');
    const btnCancel = document.getElementById('btn-wizard-cancel');
    const btnNext = document.getElementById('btn-wizard-next');
    const btnSubmit = document.getElementById('btn-guardar-informe');

    if (currentStep > 1) {
        btnPrev?.classList.remove('hidden');
        btnCancel?.classList.add('hidden');
    } else {
        btnPrev?.classList.add('hidden');
        btnCancel?.classList.remove('hidden');
    }

    if (currentStep === totalSteps) {
        btnNext?.classList.add('hidden');
        btnSubmit?.classList.remove('hidden');
    } else {
        btnNext?.classList.remove('hidden');
        btnSubmit?.classList.add('hidden');
    }

    // En el paso 5 (firmas), asegurar inicialización del layout de canvas
    if (currentStep === 5) {
        const btnPersonaDibujar = document.getElementById('btn-persona-dibujar');
        if (btnPersonaDibujar && !btnPersonaDibujar.dataset.initialized) {
            btnPersonaDibujar.dataset.initialized = "true";
            btnPersonaDibujar.click();
        }
    }
}

function validarPasoActual(step) {
    let isValid = true;
    let firstInvalidInput = null;

    function checkInput(inputEl, condition, errorMsg) {
        if (!inputEl) return;
        if (!condition) {
            isValid = false;
            inputEl.classList.add('border-rose-500', 'bg-rose-50');
            if (!firstInvalidInput) firstInvalidInput = inputEl;
        } else {
            inputEl.classList.remove('border-rose-500', 'bg-rose-50');
        }
    }

    if (step === 1) {
        const nombre = document.getElementById('nombre_atendido');
        checkInput(nombre, nombre && nombre.value.trim().length > 0, "Nombre es requerido");

        const dni = document.getElementById('dni_atendido');
        checkInput(dni, dni && dni.value.trim().length === 8 && /^\d+$/.test(dni.value.trim()), "DNI debe tener 8 dígitos");

        const oficina = document.getElementById('oficina');
        checkInput(oficina, oficina && oficina.value !== "", "Oficina es requerida");

        if (oficina && oficina.value == {{ $oficinaOtrosId }}) {
            const otraOfic = document.getElementById('otra_oficina');
            checkInput(otraOfic, otraOfic && otraOfic.value.trim().length > 0, "Escriba la nueva oficina");
        }
    } else if (step === 2) {
        const sede = document.getElementById('sede_id');
        checkInput(sede, sede && sede.value !== "", "Sede es requerida");

        const personaAtendida = document.getElementById('persona_atendida');
        checkInput(personaAtendida, personaAtendida && personaAtendida.value !== "", "Persona atendida es requerida");
    } else if (step === 3) {
        const codPat = document.getElementById('codigo_patrimonial');
        checkInput(codPat, codPat && codPat.value.trim().length > 0, "Código patrimonial es requerido");

        const tipoEq = document.getElementById('tipo_equipo_id');
        checkInput(tipoEq, tipoEq && tipoEq.value !== "", "Tipo de equipo es requerido");

        if (tipoEq && tipoEq.value == {{ $tipoEquipoOtrosId }}) {
            const otroEq = document.getElementById('otro_equipo_input');
            checkInput(otroEq, otroEq && otroEq.value.trim().length > 0, "Especifique el equipo");
        }

        const marca = document.getElementById('marca');
        checkInput(marca, marca && marca.value.trim().length > 0, "Marca es requerida");

        const modelo = document.getElementById('modelo');
        checkInput(modelo, modelo && modelo.value.trim().length > 0, "Modelo es requerido");
    } else if (step === 4) {
        const desc = document.getElementById('descripcion_problema');
        checkInput(desc, desc && desc.value.trim().length > 0, "Descripción del problema es requerida");

        const solucionNo = document.getElementById('solucionado_no');
        if (solucionNo && solucionNo.checked) {
            const resTec = document.getElementById('resolucion_tecnica');
            checkInput(resTec, resTec && resTec.value.trim().length > 0, "Resolución técnica es requerida si no se pudo solucionar");
        }
    }

    if (!isValid && firstInvalidInput) {
        firstInvalidInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
        if (typeof firstInvalidInput.focus === 'function') {
            firstInvalidInput.focus();
        }
    }

    return isValid;
}

function changeStep(delta) {
    const nextStep = currentStep + delta;
    if (delta > 0 && !validarPasoActual(currentStep)) {
        return;
    }
    if (nextStep >= 1 && nextStep <= totalSteps) {
        currentStep = nextStep;
        updateStepperUI();
        window.scrollTo({ top: 100, behavior: 'smooth' });
    }
}

function goToStep(targetStep) {
    if (targetStep < currentStep) {
        currentStep = targetStep;
        updateStepperUI();
    } else if (targetStep > currentStep) {
        for (let s = currentStep; s < targetStep; s++) {
            if (!validarPasoActual(s)) return;
        }
        currentStep = targetStep;
        updateStepperUI();
    }
}

document.addEventListener('DOMContentLoaded', function () {
    mostrarSiSelectExpandible({
        selectId: 'oficina',
        boxId: 'otra_oficina_box',
        inputId: 'otra_oficina',
        valor: {{ $oficinaOtrosId }}
    });

    mostrarSiRadio({
        radioName: 'problema_solucionado',
        valor: 'no',
        boxId: 'resolucion_box'
    });

    mostrarSiSelectExpandible({
        selectId: 'tipo_equipo_id',
        boxId: 'otro_equipo_box',
        inputId: 'otro_equipo_input',
        valor: {{ $tipoEquipoOtrosId }}
    });

    updateStepperUI();

    @if($errors->any())
        setTimeout(function() {
            const firstErrorField = document.querySelector('.border-rose-400, .border-rose-500, .bg-rose-50');
            if (firstErrorField) {
                firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }, 300);
    @endif
});
</script>

@endsection