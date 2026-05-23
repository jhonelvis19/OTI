@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto">

    <div class="mb-8">

        <h1 class="text-4xl font-bold text-slate-800">
            Nuevo Informe Técnico
        </h1>

        <p class="text-gray-500 mt-2">
            Registro de mantenimiento y soporte técnico.
        </p>

    </div>


    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">

        <form method="POST" action="/admin/informes">

            @csrf


            <!-- ========================= -->
            <!-- DATOS DEL ATENDIDO -->
            <!-- ========================= -->

            <div class="mb-10">

                <h2 class="text-xl font-bold text-slate-700 mb-6">
                    Datos del Atendido
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- NOMBRE -->
                    <div>

                        <label class="block mb-2 font-semibold text-sm text-slate-700">
                            Nombre Completo
                        </label>

                        <input
                            type="text"
                            name="nombre_atendido"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                    </div>


                    <!-- DNI -->
                    <div>

                        <label class="block mb-2 font-semibold text-sm text-slate-700">
                            DNI
                        </label>

                        <input
                            type="text"
                            name="dni_atendido"
                            maxlength="8"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                    </div>

                </div>

            </div>



            <!-- ========================= -->
            <!-- UBICACIÓN -->
            <!-- ========================= -->

            <div class="mb-10">

                <h2 class="text-xl font-bold text-slate-700 mb-6">
                    Ubicación
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- SEDE -->
                    <div>

                        <label class="block mb-2 font-semibold text-sm text-slate-700">
                            Sede
                        </label>

                        <select
                            name="sede_id"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                            <option value="1">Sede Principal</option>

                        </select>

                    </div>


                    <!-- PERSONA -->
                    <div>

                        <label class="block mb-2 font-semibold text-sm text-slate-700">
                            Persona Atendida
                        </label>

                        <select
                            name="persona_atendida"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                            <option value="titular">
                                Titular
                            </option>

                            <option value="usuario">
                                Usuario
                            </option>

                            <option value="otros">
                                Otros
                            </option>

                        </select>

                    </div>

                </div>

            </div>



            <!-- ========================= -->
            <!-- EQUIPO -->
            <!-- ========================= -->

            <div class="mb-10">

                <h2 class="text-xl font-bold text-slate-700 mb-6">
                    Datos del Equipo
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- CÓDIGO -->
                    <div>

                        <label class="block mb-2 font-semibold text-sm text-slate-700">
                            Código Patrimonial
                        </label>

                        <input
                            type="text"
                            name="codigo_patrimonial"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3">

                    </div>


                    <!-- TIPO -->
                    <div>

                        <label class="block mb-2 font-semibold text-sm text-slate-700">
                            Tipo de Equipo
                        </label>

                        <select
                            name="tipo_equipo_id"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3">

                            <option value="1">
                                Computadora
                            </option>

                        </select>

                    </div>


                    <!-- MARCA -->
                    <div>

                        <label class="block mb-2 font-semibold text-sm text-slate-700">
                            Marca
                        </label>

                        <input
                            type="text"
                            name="marca"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3">

                    </div>


                    <!-- MODELO -->
                    <div>

                        <label class="block mb-2 font-semibold text-sm text-slate-700">
                            Modelo
                        </label>

                        <input
                            type="text"
                            name="modelo"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3">

                    </div>


                    <!-- SERIE -->
                    <div>

                        <label class="block mb-2 font-semibold text-sm text-slate-700">
                            Serie
                        </label>

                        <input
                            type="text"
                            name="serie"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3">

                    </div>


                    <!-- CANTIDAD -->
                    <div>

                        <label class="block mb-2 font-semibold text-sm text-slate-700">
                            Cantidad de Equipos
                        </label>

                        <input
                            type="number"
                            name="numero_equipos"
                            value="1"
                            min="1"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3">

                    </div>

                </div>

            </div>



            <!-- ========================= -->
            <!-- PROBLEMA -->
            <!-- ========================= -->

            <div class="mb-10">

                <h2 class="text-xl font-bold text-slate-700 mb-6">
                    Descripción Técnica
                </h2>


                <!-- PROBLEMA -->
                <div class="mb-6">

                    <label class="block mb-2 font-semibold text-sm text-slate-700">
                        Descripción del Problema
                    </label>

                    <textarea
                        name="descripcion_problema"
                        rows="5"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3"></textarea>

                </div>


                <!-- SOLUCIÓN -->
                <div class="mb-6">

                    <label class="block mb-2 font-semibold text-sm text-slate-700">
                        Resolución Técnica
                    </label>

                    <textarea
                        name="resolucion_tecnica"
                        rows="5"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3"></textarea>

                </div>


                <!-- OBSERVACIONES -->
                <div>

                    <label class="block mb-2 font-semibold text-sm text-slate-700">
                        Observaciones
                    </label>

                    <textarea
                        name="observaciones"
                        rows="4"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3"></textarea>

                </div>

            </div>



            <!-- BOTÓN -->
            <div class="pt-6 border-t border-gray-200">

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl transition">

                    Guardar Informe

                </button>

            </div>

        </form>

    </div>

</div>

@endsection