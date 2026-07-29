@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto">

    <div class="bg-white rounded-2xl shadow-sm border border-indigo-300 overflow-hidden">

        <!-- HEADER -->
        <div class="flex items-center gap-3 px-8 py-5 border-b border-indigo-200 bg-slate-50">
        
                <img src="{{ asset('images/oti-ofic.png') }}"
                alt="Logo"
                class="h-12 w-auto object-contain">
           

            <div class="ml-auto text-right">
                <h1 class="text-xl font-bold text-slate-800">
                    {{ isset($informe) ? 'Editar Informe Técnico' : 'Nuevo Informe Técnico' }}
                </h1>
                <p class="text-xs text-gray-400 mt-0.5">
                    Complete todos los campos requeridos.
                </p>
            </div>
        </div>

        

        <!-- FORMULARIO -->
        <div class="p-8">

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
                <div class="relative border border-indigo-300 rounded-2xl p-6 mb-8">

                    <div class="absolute -top-3.5 left-5 bg-white px-3">
                        <h2 class="text-sm font-semibold text-indigo-500 uppercase tracking-wide">
                            Datos del Usuario
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mt-2">

                        <!-- NOMBRE Y APELLIDO -->
                        <div>
                            <label class="block mb-2 text-xs font-semibold text-slate-500 uppercase tracking-wide">
                                Nombre y Apellido
                            </label>
                            <input
                                type="text"
                                id="nombre_atendido"
                                name="nombre_atendido"
                                value="{{ old('nombre_atendido', $informe->nombre_atendido ?? '') }}"
                                placeholder="Ingrese nombre completo"
                                class="w-full rounded-xl border {{ $errors->has('nombre_atendido') ? 'border-red-400 bg-red-50' : 'border-indigo-300 bg-slate-50' }} shadow-sm
                                       px-4 py-3 text-sm
                                       focus:ring-2 focus:ring-indigo-400 focus:border-transparent focus:bg-white
                                       outline-none transition duration-200">
                            @error('nombre_atendido')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- DNI -->
                        <div>
                            <label class="block mb-2 text-xs font-semibold text-slate-500 uppercase tracking-wide">
                                DNI
                            </label>
                            <input
                                type="text"
                                id="dni_atendido"
                                name="dni_atendido"
                                maxlength="8"
                                value="{{ old('dni_atendido', $informe->dni_atendido ?? '') }}"
                                placeholder="00000000"
                                class="w-full rounded-xl border {{ $errors->has('dni_atendido') ? 'border-red-400 bg-red-50' : 'border-indigo-300 bg-slate-50' }} shadow-sm
                                       px-4 py-3 text-sm
                                       focus:ring-2 focus:ring-indigo-400 focus:border-transparent focus:bg-white
                                       outline-none transition duration-200">
                            @error('dni_atendido')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-2 text-xs font-semibold text-slate-500 uppercase tracking-wide">
                                Oficina
                            </label>

                            <select
                                id="oficina"
                                name="oficina_id"
                                class="w-full rounded-xl border {{ $errors->has('oficina_id') ? 'border-red-400 bg-red-50' : 'border-indigo-300 bg-slate-50' }} shadow-sm px-4 py-3 text-sm
                                       focus:ring-2 focus:ring-indigo-400 focus:border-transparent focus:bg-white
                                       outline-none transition duration-200">

                                <option value="">Seleccione una oficina</option>

                                @foreach($oficinas as $oficina)
                                    <option value="{{ $oficina->id }}"
                                        {{ old('oficina_id', $informe->oficina_id ?? '') == $oficina->id ? 'selected' : '' }}>
                                        {{ $oficina->nombre }}
                                    </option>
                                @endforeach

                            </select>
                            @error('oficina_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <div id="otra_oficina_box" class="{{ old('oficina_id', $informe->oficina_id ?? '') == $oficinaOtrosId ? '' : 'hidden' }}">
                            <label class="block mb-2 text-xs font-semibold text-slate-500 uppercase tracking-wide">
                                Nueva Oficina
                            </label>

                            <input
                                type="text"
                                id="otra_oficina"
                                name="otra_oficina"
                                value="{{ old('otra_oficina', $informe->otra_oficina ?? '') }}"
                                placeholder="Escriba la nueva oficina"
                                class="w-full rounded-xl border {{ $errors->has('otra_oficina') ? 'border-red-400 bg-red-50' : 'border-indigo-300 bg-slate-50' }} shadow-sm px-4 py-3 text-sm
                                       focus:ring-2 focus:ring-indigo-400 focus:border-transparent focus:bg-white
                                       outline-none transition duration-200">
                            @error('otra_oficina')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                </div>


                <div class="relative border border-indigo-300 rounded-2xl p-6 mb-8">

                    <div class="absolute -top-3.5 left-5 bg-white px-3">
                        <h2 class="text-sm font-semibold text-indigo-500 uppercase tracking-wide">
                            Persona que atendió el problema
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-2">

                        <!-- SEDE -->
                        <div>
                            <label class="block mb-2 text-xs font-semibold text-slate-500 uppercase tracking-wide">
                                Cede
                            </label>
                                <select
                                    id="sede_id"
                                    name="sede_id"
                                    class="w-full rounded-xl border border-indigo-300 bg-slate-50 shadow-sm
                                        px-4 py-3 text-sm
                                        focus:ring-2 focus:ring-indigo-400 focus:border-transparent focus:bg-white
                                        outline-none transition duration-200">

                                    @foreach($sedes as $sede)
                                        <option value="{{ $sede->id }}"
                                            {{ old('sede_id', $informe->sede_id ?? '') == $sede->id ? 'selected' : '' }}>
                                            {{ $sede->nombre }}
                                        </option>
                                    @endforeach

                                </select>
                                @error('sede_id')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                        </div>

                        <!-- PERSONA ATENDIDA -->
                        <div>
                            <label class="block mb-2 text-xs font-semibold text-slate-500 uppercase tracking-wide">
                                Persona Atendida
                            </label>
                            <select
                                name="persona_atendida"
                                class="w-full rounded-xl border border-indigo-300 bg-slate-50 shadow-sm
                                       px-4 py-3 text-sm
                                       focus:ring-2 focus:ring-indigo-400 focus:border-transparent focus:bg-white
                                       outline-none transition duration-200">
                                <option value="titular" {{ (isset($informe) && $informe->persona_atendida == 'titular') ? 'selected' : '' }}>
                                    Titular
                                </option>
                                <option value="usuario" {{ (isset($informe) && $informe->persona_atendida == 'usuario') ? 'selected' : '' }}>
                                    Usuario
                                </option>
                                <option value="otros" {{ (isset($informe) && $informe->persona_atendida == 'otros') ? 'selected' : '' }}>
                                    Otros
                                </option>
                            </select>

                            @error('persona_atendida')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                </div>

                <div class="relative border border-indigo-300 rounded-2xl p-6 mb-8">

                    <div class="absolute -top-3.5 left-5 bg-white px-3">
                        <h2 class="text-sm font-semibold text-indigo-500 uppercase tracking-wide">
                            Información con respecto al mantenimiento
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-2">

                        <div>
                            <label class="block mb-2 text-xs font-semibold text-slate-500 uppercase tracking-wide">
                                Código Patrimonial
                            </label>
                            <input
                                type="text"
                                id="codigo_patrimonial"
                                name="codigo_patrimonial"
                                value="{{ old('codigo_patrimonial', $informe->codigo_patrimonial ?? '') }}"
                                placeholder="Ingrese el código"
                                class="w-full rounded-xl border {{ $errors->has('codigo_patrimonial') ? 'border-red-400 bg-red-50' : 'border-indigo-300 bg-slate-50' }} shadow-sm
                                       px-4 py-3 text-sm
                                       focus:ring-2 focus:ring-indigo-400 focus:border-transparent focus:bg-white
                                       outline-none transition duration-200">
                                @error('codigo_patrimonial')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                        </div>

                        <div>
    <label class="block mb-2 text-xs font-semibold text-slate-500 uppercase tracking-wide">
        Tipo de Equipo
    </label>

    <div class="flex gap-3 items-center">

        <!-- SELECT -->
        <select
            id="tipo_equipo_id"
            name="tipo_equipo_id"
            class="rounded-xl border {{ $errors->has('tipo_equipo_id') ? 'border-red-400 bg-red-50' : 'border-indigo-300 bg-slate-50' }} shadow-sm
                px-4 py-3 text-sm flex-1 min-w-0
                focus:ring-2 focus:ring-indigo-400 focus:border-transparent focus:bg-white
                outline-none transition-all duration-300">

            @foreach($tiposEquipos as $equipo)
                <option value="{{ $equipo->id }}"
                    {{ old('tipo_equipo_id', $informe->tipo_equipo_id ?? '') == $equipo->id ? 'selected' : '' }}>
                    {{ $equipo->nombre }}
                </option>
            @endforeach

        </select>

        @error('tipo_equipo_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <!-- INPUT OCULTO -->
        <div id="otro_equipo_box" class="{{ old('tipo_equipo_id', $informe->tipo_equipo_id ?? '') == $tipoEquipoOtrosId ? 'flex-1 min-w-0' : 'hidden flex-1 min-w-0' }}">

            <input
                type="text"
                id="otro_equipo_input"
                name="otro_equipo"
                value="{{ old('otro_equipo', $informe->otro_equipo ?? '') }}"
                placeholder="Especifique el equipo"
                class="w-full rounded-xl border {{ $errors->has('otro_equipo') ? 'border-red-400 bg-red-50' : 'border-indigo-300 bg-slate-50' }} shadow-sm
                    px-4 py-3 text-sm
                    focus:ring-2 focus:ring-indigo-400 focus:border-transparent outline-none">
            @error('otro_equipo')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

        </div>

    </div>
</div>

                        <!-- MARCA -->
                        <div>
                            <label class="block mb-2 text-xs font-semibold text-slate-500 uppercase tracking-wide">
                                Marca
                            </label>
                            <input
                                type="text"
                                id="marca"
                                name="marca"
                                value="{{ old('marca', $informe->marca ?? '') }}"
                                placeholder="Ej: HP, Dell, Lenovo"
                                class="w-full rounded-xl border {{ $errors->has('marca') ? 'border-red-400 bg-red-50' : 'border-indigo-300 bg-slate-50' }} shadow-sm
                                       px-4 py-3 text-sm
                                       focus:ring-2 focus:ring-indigo-400 focus:border-transparent focus:bg-white
                                       outline-none transition duration-200">
                            @error('marca')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror

                        </div>

                        <!-- MODELO -->
                        <div>
                            <label class="block mb-2 text-xs font-semibold text-slate-500 uppercase tracking-wide">
                                Modelo
                            </label>
                            <input
                                type="text"
                                id="modelo"
                                name="modelo"
                                value="{{ old('modelo', $informe->modelo ?? '') }}"
                                placeholder="Ingrese el modelo"
                                class="w-full rounded-xl border {{ $errors->has('modelo') ? 'border-red-400 bg-red-50' : 'border-indigo-300 bg-slate-50' }} shadow-sm
                                       px-4 py-3 text-sm
                                       focus:ring-2 focus:ring-indigo-400 focus:border-transparent focus:bg-white
                                       outline-none transition duration-200">
                                @error('modelo')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                        </div>

                        <!-- SERIE -->
                        <div>
                            <label class="block mb-2 text-xs font-semibold text-slate-500 uppercase tracking-wide">
                                Serie
                            </label>
                            <input
                                type="text"
                                name="serie"
                                value="{{ old('serie') ?? ($informe->serie ?? '') }}"
                                placeholder="Número de serie"
                                class="w-full rounded-xl border border-indigo-300 bg-slate-50 shadow-sm
                                       px-4 py-3 text-sm
                                       focus:ring-2 focus:ring-indigo-400 focus:border-transparent focus:bg-white
                                       outline-none transition duration-200">
                        </div>

                        <div class="flex items-end gap-4">

    
                        <!-- DATOS PARA SU RESOLUCIÓN -->
                        <div class="flex-1">
                            <label class="block mb-2 text-xs font-semibold text-slate-500 uppercase tracking-wide">
                                Datos para su Resolución
                            </label>
                            <div class="flex flex-wrap gap-3 p-4 rounded-xl border border-indigo-300 bg-slate-50 shadow-sm">
                                @foreach($tiposIncidencias as $incidencia)
                                    <label class="flex items-center gap-2 cursor-pointer group">
                                        <input
                                            type="checkbox"
                                            name="tipo_incidencia_id[]"
                                            value="{{ $incidencia->id }}"

                                            {{ in_array(
                                                $incidencia->id,
                                                old(
                                                    'tipo_incidencia_id',
                                                    isset($informe)
                                                        ? $informe->tiposIncidencias->pluck('id')->toArray()
                                                        : []
                                                )
                                            ) ? 'checked' : '' }}

                                            class="w-4 h-4 rounded border-indigo-300 text-indigo-600
                                                focus:ring-2 focus:ring-indigo-400 cursor-pointer">

                                        <span class="text-sm text-slate-600 group-hover:text-indigo-600 transition duration-200">
                                            {{ $incidencia->nombre }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- CANTIDAD -->
                        <div class="w-28">
                            <label class="block mb-2 text-xs font-semibold text-slate-500 uppercase tracking-wide">
                                Cantidad
                            </label>
                            <input
                                type="number"
                                name="numero_equipos"
                                value="{{ old('numero_equipos') ?? ($informe->numero_equipos ?? '1') }}"
                                min="1"
                                placeholder="1"
                                class="w-full rounded-xl border border-indigo-300 bg-slate-50 shadow-sm
                                    px-4 py-3 text-sm text-center
                                    focus:ring-2 focus:ring-indigo-400 focus:bg-white
                                    outline-none transition duration-200">
                        </div>

                        </div>

                    </div>

                </div>


                <div class="relative border border-indigo-300 rounded-2xl p-6 mb-8">

                    <div class="absolute -top-3.5 left-5 bg-white px-3">
                        <h2 class="text-sm font-semibold text-indigo-500 uppercase tracking-wide">
                            FACtibilidad de solucion
                        </h2>
                    </div>

                    <div class="space-y-5 mt-2">

                        <!-- PROBLEMA -->
                        <div>
                            <label class="block mb-2 text-xs font-semibold text-slate-500 uppercase tracking-wide">
                                Descripción del Problema
                            </label>
                            <textarea
                                id="descripcion_problema"
                                name="descripcion_problema"
                                rows="4"
                                placeholder="Descripcion detallada del Mantenimiento..."
                                class="w-full rounded-xl border {{ $errors->has('descripcion_problema') ? 'border-red-400 bg-red-50' : 'border-indigo-300 bg-slate-50' }} shadow-sm
                                       px-4 py-3 text-sm
                                       focus:ring-2 focus:ring-indigo-400 focus:border-transparent focus:bg-white
                                       outline-none transition duration-200 resize-none">{{ old('descripcion_problema', $informe->descripcion_problema ?? '') }}</textarea>
                            @error('descripcion_problema')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <div>
                            <label class="block mb-2 text-xs font-semibold text-slate-500 uppercase tracking-wide">
                                ¿El problema se pudo solucionar?
                            </label>

                            <div class="flex gap-3">

                                <label class="flex items-center gap-2 cursor-pointer group">
                                    <input
                                        type="radio"
                                        id="solucionado_si"
                                        name="problema_solucionado"
                                        value="si"
                                        {{ old('problema_solucionado', isset($informe) ? ($informe->solucionado ? 'si' : 'no') : 'si') == 'si' ? 'checked' : '' }}
                                        class="w-4 h-4 text-indigo-600 border-indigo-300
                                            focus:ring-2 focus:ring-indigo-400 cursor-pointer">
                                    <span class="text-sm font-medium text-slate-600 group-hover:text-indigo-600 transition duration-200">
                                        Sí
                                    </span>
                                </label>

                                <label class="flex items-center gap-2 cursor-pointer group">
                                    <input
                                        type="radio"
                                        id="solucionado_no"
                                        name="problema_solucionado"
                                        value="no"
                                        {{ old('problema_solucionado', isset($informe) ? ($informe->solucionado ? 'si' : 'no') : '') == 'no' ? 'checked' : '' }}
                                        class="w-4 h-4 text-indigo-600 border-indigo-300
                                            focus:ring-2 focus:ring-indigo-400 cursor-pointer">
                                    <span class="text-sm font-medium text-slate-600 group-hover:text-indigo-600 transition duration-200">
                                        No
                                    </span>
                                </label>

                            </div>

                        </div>

                        <!-- RESOLUCIÓN TÉCNICA: solo aparece si se marca NO -->
                        <div id="resolucion_box"
                            class="{{ old('problema_solucionado', isset($informe) ? ($informe->solucionado ? 'si' : 'no') : '') == 'no' ? '' : 'hidden' }}
                                    transition-all duration-300">

                            <label class="block mb-2 text-xs font-semibold text-slate-500 uppercase tracking-wide">
                                Resolución Técnica
                            </label>
                            <textarea
                                id="resolucion_tecnica"
                                name="resolucion_tecnica"
                                rows="4"
                                placeholder="Indicar por qué no se pudo solucionar y si se debe a causas ajenas a la OTI..."
                                class="w-full rounded-xl border {{ $errors->has('resolucion_tecnica') ? 'border-red-400 bg-red-50' : 'border-indigo-300 bg-slate-50' }} shadow-sm
                                    px-4 py-3 text-sm
                                    focus:ring-2 focus:ring-indigo-400 focus:bg-white
                                    outline-none transition duration-200 resize-none">{{ old('resolucion_tecnica', $informe->resolucion_tecnica ?? '') }}</textarea>
                            @error('resolucion_tecnica')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- OBSERVACIONES -->
                        <div>
                            <label class="block mb-2 text-xs font-semibold text-slate-500 uppercase tracking-wide">
                                Comentario y Observaciones
                            </label>
                            <textarea
                                name="observaciones"
                                rows="3"
                                placeholder="Observaciones adicionales (opcional)..."
                                class="w-full rounded-xl border {{ $errors->has('observaciones') ? 'border-red-400 bg-red-50' : 'border-indigo-300 bg-slate-50' }} shadow-sm
                                       px-4 py-3 text-sm
                                       focus:ring-2 focus:ring-indigo-400 focus:border-transparent focus:bg-white
                                       outline-none transition duration-200 resize-none">{{ old('observaciones', $informe->observaciones ?? '') }}</textarea>
                            @error('observaciones')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                </div>

                </div> <!-- /form-fields-container -->

                @if(!isset($informe))
                <!-- SECCIÓN DE FIRMAS (PASO MULTI-ETAPAS) -->
                <div id="seccion-firmas" class="hidden relative border border-indigo-300 rounded-2xl p-6 mb-8 bg-slate-50">
                    <div class="flex justify-between items-center mb-6 border-b border-indigo-200 pb-3">
                        <h3 id="firma-header-title" class="text-lg font-bold text-slate-800">Firmas del Acta</h3>
                        <span id="firma-header-step" class="text-xs font-semibold uppercase bg-indigo-100 text-indigo-800 px-2.5 py-1 rounded-full">Paso 1 de 2</span>
                    </div>

                    <!-- PASO 1: FIRMA PERSONA ATENDIDA -->
                    <div id="paso-firma-persona" class="space-y-6">
                        <p class="text-sm text-slate-600">Por favor, la persona atendida debe firmar a continuación para dar conformidad al mantenimiento realizado:</p>
                        
                        <div class="flex flex-col sm:flex-row gap-4">
                            <button type="button" id="btn-persona-dibujar" class="flex-1 py-3 px-4 rounded-xl border border-indigo-300 bg-slate-100 text-slate-700 font-semibold hover:bg-slate-200 transition duration-200 text-sm">
                                ✍ Dibujar en Pantalla
                            </button>
                            <button type="button" id="btn-persona-foto" class="flex-1 py-3 px-4 rounded-xl border border-indigo-300 bg-slate-100 text-slate-700 font-semibold hover:bg-slate-200 transition duration-200 text-sm">
                                📷 Tomar Fotografía
                            </button>
                        </div>

                        <div id="contenedor-persona-canvas" class="hidden">
                            <div class="border border-indigo-200 rounded-2xl bg-white p-2 relative h-64 shadow-inner">
                                <canvas id="canvas-persona" class="w-full h-full cursor-crosshair block rounded-xl bg-slate-50"></canvas>
                            </div>
                            <p class="text-xs text-gray-400 mt-1">Use su dedo, mouse o lápiz digital en la zona de firma.</p>
                        </div>

                        <div id="contenedor-persona-foto" class="hidden">
                            <label class="flex flex-col items-center justify-center border-2 border-dashed border-indigo-300 rounded-2xl bg-white p-6 cursor-pointer hover:bg-indigo-50 transition duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-sm font-medium text-slate-700">Tomar Foto con la Cámara</span>
                                <input type="file" id="input-persona-foto" accept="image/jpeg,image/png,image/webp" capture="environment" class="hidden">
                            </label>
                        </div>

                        <div id="preview-persona-container" class="hidden border border-gray-200 rounded-2xl bg-white p-4">
                            <h4 class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-2">Vista Previa de la Firma:</h4>
                            <div class="flex justify-center bg-slate-50 p-2 rounded-xl">
                                <img id="preview-persona" src="#" alt="Firma Persona" class="max-h-32 object-contain">
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-2">
                            <button type="button" id="btn-limpiar-persona" class="px-5 py-2.5 rounded-xl border border-gray-200 text-slate-600 text-sm font-medium hover:bg-slate-50 transition duration-200">
                                Limpiar / Repetir
                            </button>
                            <button type="button" id="btn-confirmar-persona" disabled class="px-5 py-2.5 rounded-xl bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700 transition duration-200 opacity-50 cursor-not-allowed">
                                Confirmar Firma
                            </button>
                        </div>
                    </div>

                    <!-- PASO 2: FIRMA TÉCNICO -->
                    <div id="paso-firma-tecnico" class="hidden space-y-6">
                        <p class="text-sm text-slate-600">Por favor, el técnico responsable del mantenimiento debe firmar a continuación:</p>

                        <div class="flex flex-col sm:flex-row gap-4">
                            @if(auth()->user()->firma)
                            <button type="button" id="btn-tecnico-perfil" class="flex-1 py-3 px-4 rounded-xl border border-indigo-300 bg-slate-100 text-slate-700 font-semibold hover:bg-slate-200 transition duration-200 text-sm">
                                💼 Usar mi firma guardada
                            </button>
                            @endif
                            <button type="button" id="btn-tecnico-dibujar" class="flex-1 py-3 px-4 rounded-xl border border-indigo-300 bg-slate-100 text-slate-700 font-semibold hover:bg-slate-200 transition duration-200 text-sm">
                                ✍ Dibujar en Pantalla
                            </button>
                            <button type="button" id="btn-tecnico-foto" class="flex-1 py-3 px-4 rounded-xl border border-indigo-300 bg-slate-100 text-slate-700 font-semibold hover:bg-slate-200 transition duration-200 text-sm">
                                📷 Tomar Fotografía
                            </button>
                        </div>

                        @if(auth()->user()->firma)
                        <div id="contenedor-tecnico-perfil" class="hidden border border-gray-200 rounded-2xl bg-white p-4">
                            <h4 class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-2">Su firma guardada:</h4>
                            <div class="flex justify-center bg-slate-50 p-2 rounded-xl">
                                <img src="{{ asset('storage/' . auth()->user()->firma) }}" alt="Firma Guardada" class="max-h-32 object-contain">
                            </div>
                        </div>
                        @endif

                        <div id="contenedor-tecnico-canvas" class="hidden">
                            <div class="border border-indigo-200 rounded-2xl bg-white p-2 relative h-64 shadow-inner">
                                <canvas id="canvas-tecnico" class="w-full h-full cursor-crosshair block rounded-xl bg-slate-50"></canvas>
                            </div>
                            <p class="text-xs text-gray-400 mt-1">Use su dedo, mouse o lápiz digital en la zona de firma.</p>
                        </div>

                        <div id="contenedor-tecnico-foto" class="hidden">
                            <label class="flex flex-col items-center justify-center border-2 border-dashed border-indigo-300 rounded-2xl bg-white p-6 cursor-pointer hover:bg-indigo-50 transition duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-sm font-medium text-slate-700">Tomar Foto con la Cámara</span>
                                <input type="file" id="input-tecnico-foto" accept="image/jpeg,image/png,image/webp" capture="environment" class="hidden">
                            </label>
                        </div>

                        <div id="preview-tecnico-container" class="hidden border border-gray-200 rounded-2xl bg-white p-4">
                            <h4 class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-2">Vista Previa de la Firma:</h4>
                            <div class="flex justify-center bg-slate-50 p-2 rounded-xl">
                                <img id="preview-tecnico" src="#" alt="Firma Técnico" class="max-h-32 object-contain">
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-2">
                            <button type="button" id="btn-limpiar-tecnico" class="px-5 py-2.5 rounded-xl border border-gray-200 text-slate-600 text-sm font-medium hover:bg-slate-50 transition duration-200">
                                Limpiar / Repetir
                            </button>
                            <button type="button" id="btn-confirmar-tecnico" disabled class="px-5 py-2.5 rounded-xl bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700 transition duration-200 opacity-50 cursor-not-allowed">
                                Confirmar Firma
                            </button>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t border-indigo-200 flex justify-start">
                        <button type="button" id="btn-volver-formulario" class="inline-flex items-center gap-1.5 text-xs font-semibold text-indigo-600 hover:text-indigo-800 transition duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Volver a modificar el formulario
                        </button>
                    </div>
                </div>
                @endif

                <!-- BOTÓN SUBMIT / FIRMAS -->
                @php
                    $cancelUrl = old('redirect_to', url()->previous());
                    if (!$cancelUrl || $cancelUrl == url()->current() || !str_contains($cancelUrl, auth()->user()->rol)) {
                        $cancelUrl = auth()->user()->rol == 'admin' ? '/admin/informes' : '/usuario/informes';
                    }
                @endphp
                <div class="flex justify-end pt-2">

                    <a href="{{ $cancelUrl }}"
                       class="px-5 py-2.5 rounded-xl border border-gray-200 text-slate-600 text-sm font-medium
                               hover:bg-slate-50 transition duration-200 mr-3">
                        Cancelar
                    </a>

                    @if(!isset($informe))
                        <!-- Botón para iniciar firmas -->
                        <button
                            type="button"
                            id="btn-ingresar-firmas"
                            class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700
                                   text-white px-7 py-2.5 rounded-xl text-sm font-medium
                                   transition duration-200 shadow-sm">
                            ✍ Ingresar firmas
                        </button>

                        <!-- Botón real para enviar (oculto / deshabilitado al inicio) -->
                        <button
                            type="submit"
                            id="btn-guardar-informe"
                            disabled
                            class="hidden inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700
                                   text-white px-7 py-2.5 rounded-xl text-sm font-medium
                                   transition duration-200 shadow-sm opacity-50 cursor-not-allowed">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Guardar Informe
                        </button>
                    @else
                        <button
                            type="submit"
                            class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700
                                   text-white px-7 py-2.5 rounded-xl text-sm font-medium
                                   transition duration-200 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Actualizar Informe
                        </button>
                    @endif

                </div>

            </form>

        </div>

    </div>

</div>


<script src="{{ asset('js/formulario.js') }}"></script>
@if(!isset($informe))
    <script src="{{ asset('js/signature_pad.js') }}"></script>
    <script src="{{ asset('js/firma.js') }}"></script>
@endif

<script>

document.addEventListener('DOMContentLoaded', function () {

    mostrarSiSelectExpandible({
        selectId: 'oficina',
        boxId: 'otra_oficina_box',
        inputId: 'otra_oficina',
        valor: {{ $oficinaOtrosId }}
    });

    // RADIO
    mostrarSiRadio({
        radioName: 'problema_solucionado',
        valor: 'no',
        boxId: 'resolucion_box'
    });

    // TIPO DE EQUIPO
    mostrarSiSelectExpandible({
        selectId: 'tipo_equipo_id',
        boxId: 'otro_equipo_box',
        inputId: 'otro_equipo_input',
        valor: {{ $tipoEquipoOtrosId }}
    });

    // Auto-scroll al primer campo con error de validación si existe
    @if($errors->any())
        setTimeout(function() {
            const firstErrorField = document.querySelector('.border-red-400, .text-red-500');
            if (firstErrorField) {
                // Desplazarse de forma suave y centrar el campo
                firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                
                // Darle foco si es un input, select o textarea
                const inputElement = firstErrorField.closest('input, select, textarea') || 
                                     firstErrorField.querySelector('input, select, textarea') || 
                                     firstErrorField;
                if (typeof inputElement.focus === 'function') {
                    inputElement.focus();
                }
            }
        }, 300); // Pequeño delay para asegurar que el DOM y otros scripts de renderizado terminen
    @endif

});

</script>



@endsection