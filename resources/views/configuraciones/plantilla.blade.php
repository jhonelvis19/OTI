@extends('configuraciones.index')

@section('config_content')

<div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-100/80 space-y-6">
    
    <div class="border-b border-slate-100 pb-4">
        <h2 class="text-lg font-bold text-slate-800">Plantilla Excel de Exportación</h2>
        <p class="text-xs text-slate-400 mt-0.5">Administre la plantilla base utilizada para generar reportes en Excel.</p>
    </div>

    @if($existe)
        <div class="p-6 bg-emerald-50/80 border border-emerald-200/80 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="text-emerald-900 font-bold text-sm mb-1">Plantilla actual disponible</h3>
                <p class="text-xs text-emerald-700 font-medium">Archivo: <span class="font-bold">ACTA_INVENTARIO_HARDWARE.xlsx</span></p>
                <p class="text-[11px] text-emerald-600 mt-1">Última actualización: {{ $fechaActualizacion ? $fechaActualizacion->format('d/m/Y H:i') : 'Desconocida' }}</p>
            </div>
            <a href="{{ route('configuraciones.plantilla.download') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs py-2.5 px-5 rounded-xl transition shadow-md shadow-emerald-600/20 inline-flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Descargar
            </a>
        </div>
    @else
        <div class="p-6 bg-rose-50/80 border border-rose-200/80 rounded-2xl space-y-2">
            <div class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <h3 class="text-rose-900 font-bold text-sm">No hay plantilla configurada</h3>
            </div>
            <p class="text-xs text-rose-700">Debe subir una plantilla válida (.xlsx) para que los usuarios puedan exportar sus informes.</p>
        </div>
    @endif

    <h3 class="text-xs font-bold text-slate-700 uppercase tracking-wide pt-2">{{ $existe ? 'Reemplazar plantilla' : 'Subir plantilla inicial' }}</h3>
    
    <form action="{{ route('configuraciones.plantilla.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-xl">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Seleccione una nueva plantilla (.xlsx)</label>
            <input type="file" name="plantilla" accept=".xlsx" required
                   class="w-full text-xs text-slate-500
                          file:mr-4 file:py-2.5 file:px-4
                          file:rounded-xl file:border-0
                          file:text-xs file:font-bold
                          file:bg-violet-50 file:text-violet-700
                          hover:file:bg-violet-100 transition cursor-pointer">
            <p class="text-[11px] text-slate-400 mt-1.5">Tamaño máximo: 10MB. Debe contener la hoja "INVENTARIO DE HARDWARE".</p>
            @error('plantilla')
                <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div class="p-4 bg-amber-50/80 border border-amber-200 rounded-2xl space-y-2">
            <label class="block text-xs font-bold text-amber-900 uppercase">Contraseña actual requerida</label>
            <p class="text-xs text-amber-700">Para subir o reemplazar la plantilla general del sistema, confirme su contraseña actual.</p>
            <input type="password" name="password_actual" required
                   class="w-full rounded-xl border {{ $errors->has('password_actual') ? 'border-rose-400 bg-rose-50' : 'border-amber-300 bg-white' }} px-4 py-2.5 text-xs sm:text-sm focus:ring-2 focus:ring-amber-500/20 outline-none transition">
            @error('password_actual')
                <p class="text-rose-600 text-xs font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div class="pt-2">
            <button type="submit" class="bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold text-xs px-6 py-3 rounded-2xl shadow-lg shadow-emerald-500/25 transition-all hover:scale-[1.02] active:scale-95">
                Guardar plantilla
            </button>
        </div>

    </form>

</div>

@endsection
