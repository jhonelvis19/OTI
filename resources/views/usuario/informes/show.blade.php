@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="bg-white rounded-2xl shadow-sm border p-8">

        <h1 class="text-3xl font-bold mb-6">
            Detalle del Informe
        </h1>

        <p>
            <strong>Código:</strong>
            {{ $informe->codigo_informe }}
        </p>

        <p>
            <strong>Fecha:</strong>
            {{ $informe->fecha }}
        </p>

        <p>
            <strong>Atendido:</strong>
            {{ $informe->nombre_atendido }}
        </p>

        <p>
            <strong>DNI:</strong>
            {{ $informe->dni_atendido }}
        </p>

        <p>
            <strong>Marca:</strong>
            {{ $informe->marca }}
        </p>

        <p>
            <strong>Modelo:</strong>
            {{ $informe->modelo }}
        </p>

        <p>
            <strong>Problema:</strong>
            {{ $informe->descripcion_problema }}
        </p>

        <p>
            <strong>Resolución:</strong>
            {{ $informe->resolucion_tecnica }}
        </p>

    </div>

</div>

@endsection