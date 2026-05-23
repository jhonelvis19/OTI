@extends('layouts.app')

@section('content')

<div class="mb-8">

    <h1 class="text-4xl font-bold text-slate-800">
        Panel Usuario
    </h1>

    <p class="text-gray-500 mt-2">
        Bienvenido al sistema de gestión de actas OTI.
    </p>

</div>


<!-- TARJETAS -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <!-- MIS INFORMES -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-lg font-semibold text-slate-700">
                    Mis Informes
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Total de informes registrados
                </p>

            </div>

            <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center">

                <span class="text-2xl">
                    📄
                </span>

            </div>

        </div>


        <div class="mt-8">

            <h3 class="text-5xl font-bold text-blue-700">
                0
            </h3>

        </div>

    </div>



    <!-- ESTE MES -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-lg font-semibold text-slate-700">
                    Informes Este Mes
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Actividad mensual
                </p>

            </div>

            <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center">

                <span class="text-2xl">
                    📊
                </span>

            </div>

        </div>


        <div class="mt-8">

            <h3 class="text-5xl font-bold text-green-700">
                0
            </h3>

        </div>

    </div>

</div>



<!-- TABLA -->
<div class="mt-10 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

    <div class="p-6 border-b border-gray-100">

        <h2 class="text-xl font-bold text-slate-800">
            Últimos Informes
        </h2>

    </div>


    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-slate-50">

                <tr>

                    <th class="text-left px-6 py-4 text-sm font-semibold text-slate-600">
                        Código
                    </th>

                    <th class="text-left px-6 py-4 text-sm font-semibold text-slate-600">
                        Equipo
                    </th>

                    <th class="text-left px-6 py-4 text-sm font-semibold text-slate-600">
                        Estado
                    </th>

                    <th class="text-left px-6 py-4 text-sm font-semibold text-slate-600">
                        Fecha
                    </th>

                </tr>

            </thead>


            <tbody>

                <tr class="border-t border-gray-100 hover:bg-slate-50 transition">

                    <td class="px-6 py-4">
                        INF-001
                    </td>

                    <td class="px-6 py-4">
                        Computadora Dell
                    </td>

                    <td class="px-6 py-4">

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                            Completado

                        </span>

                    </td>

                    <td class="px-6 py-4">
                        20/05/2026
                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>

@endsection