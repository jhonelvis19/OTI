@extends('configuraciones.index')

@section('config_content')

<div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-100/80 space-y-6">
    
    <div class="border-b border-slate-100 pb-4">
        <h2 class="text-lg font-bold text-slate-800">Seguridad de la Cuenta</h2>
        <p class="text-xs text-slate-400 mt-0.5">Actualice su contraseña de acceso al sistema OTI.</p>
    </div>

    <form action="{{ route('configuraciones.seguridad.update') }}" method="POST" class="space-y-6 max-w-xl">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Contraseña actual</label>
            <input type="password" name="password_actual" required
                   class="w-full rounded-xl border {{ $errors->has('password_actual') ? 'border-rose-400 bg-rose-50' : 'border-slate-200 bg-slate-50/70' }} px-4 py-3 text-xs sm:text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 focus:bg-white outline-none transition">
            @error('password_actual')
                <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div class="border-t border-slate-100 pt-6">
            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Nueva contraseña</label>
            <input type="password" name="password" required
                   class="w-full rounded-xl border {{ $errors->has('password') ? 'border-rose-400 bg-rose-50' : 'border-slate-200 bg-slate-50/70' }} px-4 py-3 text-xs sm:text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 focus:bg-white outline-none transition">
            <p class="text-[11px] text-slate-400 mt-1.5">Debe contener mínimo 8 caracteres, al menos una mayúscula, una minúscula y un número.</p>
            @error('password')
                <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Confirmar nueva contraseña</label>
            <input type="password" name="password_confirmation" required
                   class="w-full rounded-xl border border-slate-200 bg-slate-50/70 px-4 py-3 text-xs sm:text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 focus:bg-white outline-none transition">
        </div>

        <div class="pt-4 border-t border-slate-100">
            <button type="submit" class="bg-gradient-to-r from-violet-600 to-indigo-600 hover:from-violet-700 hover:to-indigo-700 text-white font-bold text-xs px-6 py-3 rounded-2xl shadow-lg shadow-violet-500/25 transition-all hover:scale-[1.02] active:scale-95">
                Cambiar contraseña
            </button>
        </div>

    </form>

</div>

@endsection
