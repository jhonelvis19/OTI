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

            <form method="POST"
                action="{{ isset($informe)
                    ? '/usuario/informes/'.$informe->id
                    : (auth()->user()->rol == 'admin'
                        ? '/admin/informes'
                        : '/usuario/informes') }}">

                @csrf
                @if(isset($informe))
                    @method('PUT')
                @endif

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
                                name="nombre_atendido"
                                value="{{ old('nombre_atendido') ?? ($informe->nombre_atendido ?? '') }}"
                                placeholder="Ingrese nombre completo"
                                class="w-full rounded-xl border border-indigo-300 bg-slate-50 shadow-sm
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
                                name="dni_atendido"
                                maxlength="8"
                                value="{{ old('dni_atendido') ?? ($informe->dni_atendido ?? '') }}"
                                placeholder="00000000"
                                class="w-full rounded-xl border border-indigo-300 bg-slate-50 shadow-sm
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
                                class="w-full rounded-xl border border-indigo-300 bg-slate-50 shadow-sm px-4 py-3 text-sm">

                                <option value="">Seleccione una oficina</option>

                                @foreach($oficinas as $oficina)
                                    <option value="{{ $oficina->id }}">
                                        {{ $oficina->nombre }}
                                    </option>
                                @endforeach

                            </select>
                            @error('oficina_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                                

                        <div id="otra_oficina_box" class="hidden">
                            <label class="block mb-2 text-xs font-semibold text-slate-500 uppercase tracking-wide">
                                Nueva Oficina
                            </label>

                            <input
                                type="text"
                                id="otra_oficina"
                                name="otra_oficina"
                                placeholder="Escriba la nueva oficina"
                                class="w-full rounded-xl border border-indigo-300 bg-slate-50 shadow-sm px-4 py-3 text-sm">
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
                                name="codigo_patrimonial"
                                value="{{ old('codigo_patrimonial') ?? ($informe->codigo_patrimonial ?? '') }}"
                                placeholder="Ingrese el código"
                                class="w-full rounded-xl border border-indigo-300 bg-slate-50 shadow-sm
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
            class="rounded-xl border border-indigo-300 bg-slate-50 shadow-sm
                px-4 py-3 text-sm flex-1 min-w-0
                focus:ring-2 focus:ring-indigo-400 focus:border-transparent focus:bg-white
                outline-none transition-all duration-300">

            @foreach($tiposEquipos as $equipo)
                <option value="{{ $equipo->id }}">
                    {{ $equipo->nombre }}
                </option>
            @endforeach

        </select>

        @error('tipo_equipo_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <!-- INPUT OCULTO -->
        <div id="otro_equipo_box" class="hidden flex-1 min-w-0">

            <input
                type="text"
                id="otro_equipo_input"
                name="otro_equipo"
                placeholder="Especifique el equipo"
                class="w-full rounded-xl border border-indigo-300 bg-slate-50 shadow-sm
                    px-4 py-3 text-sm
                    focus:ring-2 focus:ring-indigo-400 focus:border-transparent outline-none">

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
                                name="marca"
                                value="{{ old('marca') ?? ($informe->marca ?? '') }}"
                                placeholder="Ej: HP, Dell, Lenovo"
                                class="w-full rounded-xl border border-indigo-300 bg-slate-50 shadow-sm
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
                                name="modelo"
                                value="{{ old('modelo') ?? ($informe->modelo ?? '') }}"
                                placeholder="Ingrese el modelo"
                                class="w-full rounded-xl border border-indigo-300 bg-slate-50 shadow-sm
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
                                name="descripcion_problema"
                                rows="4"
                                placeholder="Descripcion detallada del Mantenimiento..."
                                class="w-full rounded-xl border border-indigo-300 bg-slate-50 shadow-sm
                                       px-4 py-3 text-sm
                                       focus:ring-2 focus:ring-indigo-400 focus:border-transparent focus:bg-white
                                       outline-none transition duration-200 resize-none">{{ old('descripcion_problema') ?? ($informe->descripcion_problema ?? '') }}</textarea>
                        </div>


                        <div>
                            <label class="block mb-2 text-xs font-semibold text-slate-500 uppercase tracking-wide">
                                ¿El problema se pudo solucionar?
                            </label>

                            <div class="flex gap-3">

                                <label class="flex items-center gap-2 cursor-pointer group">
                                    <input
                                        type="radio"
                                        name="problema_solucionado"
                                        value="si"
                                        {{ (isset($informe) && $informe->problema_solucionado == 'si') ? 'checked' : '' }}
                                        {{ (old('problema_solucionado') == 'si') ? 'checked' : '' }}
                                        class="w-4 h-4 text-indigo-600 border-indigo-300
                                            focus:ring-2 focus:ring-indigo-400 cursor-pointer">
                                    <span class="text-sm font-medium text-slate-600 group-hover:text-indigo-600 transition duration-200">
                                        Sí
                                    </span>
                                </label>

                                <label class="flex items-center gap-2 cursor-pointer group">
                                    <input
                                        type="radio"
                                        name="problema_solucionado"
                                        value="no"
                                        {{ (isset($informe) && $informe->problema_solucionado == 'no') ? 'checked' : '' }}
                                        {{ (old('problema_solucionado') == 'no') ? 'checked' : '' }}
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
                            class="{{ (isset($informe) && $informe->problema_solucionado == 'no') ? '' : 'hidden' }}
                                    transition-all duration-300">

                            <label class="block mb-2 text-xs font-semibold text-slate-500 uppercase tracking-wide">
                                Resolución Técnica
                            </label>
                            <textarea
                                name="resolucion_tecnica"
                                rows="4"
                                placeholder="Indicar por qué no se pudo solucionar y si se debe a causas ajenas a la OTI..."
                                class="w-full rounded-xl border border-indigo-300 bg-slate-50 shadow-sm
                                    px-4 py-3 text-sm
                                    focus:ring-2 focus:ring-indigo-400 focus:bg-white
                                    outline-none transition duration-200 resize-none">{{ old('resolucion_tecnica') ?? ($informe->resolucion_tecnica ?? '') }}</textarea>

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
                                class="w-full rounded-xl border border-indigo-300 bg-slate-50 shadow-sm
                                       px-4 py-3 text-sm
                                       focus:ring-2 focus:ring-indigo-400 focus:border-transparent focus:bg-white
                                       outline-none transition duration-200 resize-none">{{ old('observaciones') ?? ($informe->observaciones ?? '') }}</textarea>
                        </div>

                    </div>

                </div>


                <!-- BOTÓN SUBMIT -->
                <div class="flex justify-end pt-2">

                    <a href="{{ auth()->user()->rol == 'admin' ? '/admin/informes' : '/usuario/informes' }}"
                       class="px-5 py-2.5 rounded-xl border border-gray-200 text-slate-600 text-sm font-medium
                              hover:bg-slate-50 transition duration-200 mr-3">
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700
                               text-white px-7 py-2.5 rounded-xl text-sm font-medium
                               transition duration-200 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ isset($informe) ? 'Actualizar Informe' : 'Guardar Informe' }}
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<script src="{{ asset('js/formulario.js') }}"></script>

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

});

</script>



@endsection