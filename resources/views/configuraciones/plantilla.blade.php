@extends('configuraciones.index')

@section('config_content')

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    
    <div class="px-6 py-5 border-b border-slate-100 bg-slate-50">
        <h2 class="text-lg font-bold text-slate-800">Plantilla Excel</h2>
        <p class="text-sm text-slate-500 mt-1">Administre la plantilla base utilizada para exportar informes desde el historial.</p>
    </div>

    <div class="p-6">

        @if($existe)
            <div class="mb-8 p-6 bg-green-50 border border-green-200 rounded-2xl flex items-center justify-between">
                <div>
                    <h3 class="text-green-800 font-bold mb-1">Plantilla actual disponible</h3>
                    <p class="text-sm text-green-700 mb-1">Archivo: <span class="font-semibold">ACTA_INVENTARIO_HARDWARE.xlsx</span></p>
                    <p class="text-xs text-green-600">Última actualización: {{ $fechaActualizacion ? $fechaActualizacion->format('d/m/Y H:i') : 'Desconocida' }}</p>
                </div>
                <a href="{{ route('configuraciones.plantilla.download') }}" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-5 rounded-xl transition shadow-sm inline-flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Descargar
                </a>
            </div>
        @else
            <div class="mb-8 p-6 bg-red-50 border border-red-200 rounded-2xl">
                <div class="flex items-center gap-3 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <h3 class="text-red-800 font-bold">No hay plantilla configurada</h3>
                </div>
                <p class="text-sm text-red-700">Debe subir una plantilla válida (.xlsx) para que los usuarios puedan exportar sus informes.</p>
            </div>
        @endif

        <h3 class="text-md font-bold text-slate-700 mb-4">{{ $existe ? 'Reemplazar plantilla' : 'Subir plantilla inicial' }}</h3>
        
        <form action="{{ route('configuraciones.plantilla.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="max-w-md">
                
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Seleccione una nueva plantilla (.xlsx)</label>
                    <input type="file" name="plantilla" accept=".xlsx" required
                           class="w-full text-sm text-slate-500
                                  file:mr-4 file:py-2.5 file:px-4
                                  file:rounded-xl file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-indigo-50 file:text-indigo-700
                                  hover:file:bg-indigo-100 transition">
                    <p class="text-xs text-slate-400 mt-2">Tamaño máximo: 10MB. Debe contener la hoja "INVENTARIO DE HARDWARE".</p>
                    @error('plantilla')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-8 p-4 bg-orange-50 border border-orange-200 rounded-xl">
                    <label class="block text-sm font-semibold text-orange-800 mb-2">Contraseña actual</label>
                    <p class="text-xs text-orange-600 mb-3">Para subir o reemplazar la plantilla general, debe ingresar su contraseña.</p>
                    <input type="password" name="password_actual" required
                           class="w-full rounded-xl border {{ $errors->has('password_actual') ? 'border-red-400 bg-red-50' : 'border-orange-300' }} px-4 py-3 text-sm focus:ring-2 focus:ring-orange-400 focus:border-transparent outline-none transition">
                    @error('password_actual')
                        <p class="text-red-600 text-xs mt-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-start">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 px-6 rounded-xl transition shadow-sm">
                        Guardar plantilla
                    </button>
                </div>

            </div>

        </form>
    </div>

</div>

@endsection
