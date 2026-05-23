@extends('layouts.app')

@section('content')

<div class="mb-6">

    <h1 class="text-3xl font-bold text-gray-800">
        Panel Administrador
    </h1>

    <p class="text-gray-600 mt-2">
        Bienvenido al sistema de gestión de actas OTI.
    </p>

</div>


<!-- TARJETAS -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-lg font-semibold text-gray-700">
            Usuarios Registrados
        </h2>

        <p class="text-4xl font-bold text-blue-900 mt-4">
            0
        </p>

    </div>


    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-lg font-semibold text-gray-700">
            Informes Totales
        </h2>

        <p class="text-4xl font-bold text-blue-900 mt-4">
            0
        </p>

    </div>


    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-lg font-semibold text-gray-700">
            Informes Hoy
        </h2>

        <p class="text-4xl font-bold text-blue-900 mt-4">
            0
        </p>

    </div>

</div>

@endsection