@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="mb-8">

        <h1 class="text-4xl font-bold text-slate-800">
            Nuevo Informe
        </h1>

        <p class="text-gray-500 mt-2">
            Registro de mantenimiento y soporte técnico.
        </p>

    </div>


    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">

        <form>

            <!-- FECHA -->
            <div class="mb-6">

                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Fecha
                </label>

                <input
                    type="date"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

            </div>


            <!-- NOMBRE ATENDIDO -->
            <div class="mb-6">

                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Nombre del Atendido
                </label>

                <input
                    type="text"
                    placeholder="Ingrese nombre"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

            </div>


            <!-- DNI -->
            <div class="mb-6">

                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    DNI
                </label>

                <input
                    type="text"
                    maxlength="8"
                    placeholder="Ingrese DNI"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

            </div>


            <!-- BOTÓN -->
            <div class="mt-8">

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl transition">

                    Guardar Informe

                </button>

            </div>

        </form>

    </div>

</div>

@endsection