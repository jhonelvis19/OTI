@extends('configuraciones.index')

@section('config_content')

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    
    <div class="px-6 py-5 border-b border-slate-100 bg-slate-50">
        <h2 class="text-lg font-bold text-slate-800">Seguridad</h2>
        <p class="text-sm text-slate-500 mt-1">Cambie su contraseña de acceso.</p>
    </div>

    <div class="p-6">
        <form action="{{ route('configuraciones.seguridad.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="max-w-md">
                
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Contraseña actual</label>
                    <input type="password" name="password_actual" required
                           class="w-full rounded-xl border {{ $errors->has('password_actual') ? 'border-red-400 bg-red-50' : 'border-slate-200' }} px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-400 focus:border-transparent outline-none transition">
                    @error('password_actual')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6 border-t border-slate-100 pt-6">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Nueva contraseña</label>
                    <input type="password" name="password" required
                           class="w-full rounded-xl border {{ $errors->has('password') ? 'border-red-400 bg-red-50' : 'border-slate-200' }} px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-400 focus:border-transparent outline-none transition">
                    <p class="text-xs text-slate-400 mt-2">Debe contener mínimo 8 caracteres, al menos una mayúscula, una minúscula y un número.</p>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-8">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Confirmar nueva contraseña</label>
                    <input type="password" name="password_confirmation" required
                           class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-400 focus:border-transparent outline-none transition">
                </div>

                <div class="flex justify-start">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 px-6 rounded-xl transition shadow-sm">
                        Cambiar contraseña
                    </button>
                </div>

            </div>

        </form>
    </div>

</div>

@endsection
