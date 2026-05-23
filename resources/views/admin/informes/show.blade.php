@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">

        <div class="mb-8">

            <h1 class="text-4xl font-bold text-slate-800">

                {{ $informe->codigo_informe }}

            </h1>

            <p class="text-gray-500 mt-2">

                Detalle completo del informe técnico.

            </p>

        </div>


        <div class="grid grid-cols-2 gap-6">

            <div>

                <p class="text-sm text-gray-500">
                    Fecha
                </p>

                <p class="font-semibold">
                    {{ $informe->fecha }}
                </p>

            </div>


            <div>

                <p class="text-sm text-gray-500">
                    Técnico
                </p>

                <p class="font-semibold">
                    {{ $informe->user->name }}
                </p>

            </div>


            <div>

                <p class="text-sm text-gray-500">
                    Atendido
                </p>

                <p class="font-semibold">
                    {{ $informe->nombre_atendido }}
                </p>

            </div>


            <div>

                <p class="text-sm text-gray-500">
                    DNI
                </p>

                <p class="font-semibold">
                    {{ $informe->dni_atendido }}
                </p>

            </div>

        </div>


        <div class="mt-8">

            <p class="text-sm text-gray-500 mb-2">
                Problema Reportado
            </p>

            <div class="bg-slate-100 rounded-xl p-4">

                {{ $informe->descripcion_problema }}

            </div>

        </div>


        <div class="mt-6">

            <p class="text-sm text-gray-500 mb-2">
                Resolución Técnica
            </p>

            <div class="bg-slate-100 rounded-xl p-4">

                {{ $informe->resolucion_tecnica }}

            </div>

        </div>

    </div>

</div>

@endsection