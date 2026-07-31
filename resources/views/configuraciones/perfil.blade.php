@extends('configuraciones.index')

@section('config_content')

<div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-100/80 space-y-6">
    
    <div class="border-b border-slate-100 pb-4">
        <h2 class="text-lg font-bold text-slate-800">Perfil de Usuario</h2>
        <p class="text-xs text-slate-400 mt-0.5">Actualice su información personal y correo institucional.</p>
    </div>

    <form action="{{ route('configuraciones.perfil.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Nombres -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Nombres</label>
                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required
                       class="w-full rounded-xl border {{ $errors->has('name') ? 'border-rose-400 bg-rose-50' : 'border-slate-200 bg-slate-50/70' }} px-4 py-3 text-xs sm:text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 focus:bg-white outline-none transition">
                @error('name')
                    <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Apellidos -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Apellidos</label>
                <input type="text" name="apellido" value="{{ old('apellido', auth()->user()->apellido) }}" required
                       class="w-full rounded-xl border {{ $errors->has('apellido') ? 'border-rose-400 bg-rose-50' : 'border-slate-200 bg-slate-50/70' }} px-4 py-3 text-xs sm:text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 focus:bg-white outline-none transition">
                @error('apellido')
                    <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Correo electrónico</label>
            <input type="email" name="email" id="email_input" value="{{ old('email', auth()->user()->email) }}" required
                   class="w-full rounded-xl border {{ $errors->has('email') ? 'border-rose-400 bg-rose-50' : 'border-slate-200 bg-slate-50/70' }} px-4 py-3 text-xs sm:text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 focus:bg-white outline-none transition"
                   data-original-email="{{ auth()->user()->email }}">
            <p class="text-xs text-slate-400 mt-1.5">Este correo se utiliza para iniciar sesión en el sistema.</p>
            @error('email')
                <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Contraseña Actual (Se muestra si cambia el correo) -->
        <div id="password_section" class="{{ old('email') && old('email') !== auth()->user()->email ? 'block' : 'hidden' }} p-4 bg-amber-50/80 border border-amber-200 rounded-2xl space-y-2">
            <label class="block text-xs font-bold text-amber-900 uppercase">Contraseña actual requerida</label>
            <p class="text-xs text-amber-700">Para cambiar su correo electrónico, debe ingresar su contraseña actual por seguridad.</p>
            <input type="password" name="password_actual" 
                   class="w-full rounded-xl border {{ $errors->has('password_actual') ? 'border-rose-400 bg-rose-50' : 'border-amber-300 bg-white' }} px-4 py-2.5 text-xs sm:text-sm focus:ring-2 focus:ring-amber-500/20 outline-none transition">
            @error('password_actual')
                <p class="text-rose-600 text-xs font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end pt-4 border-t border-slate-100">
            <button type="submit" class="bg-gradient-to-r from-violet-600 to-indigo-600 hover:from-violet-700 hover:to-indigo-700 text-white font-bold text-xs px-6 py-3 rounded-2xl shadow-lg shadow-violet-500/25 transition-all hover:scale-[1.02] active:scale-95">
                Guardar cambios
            </button>
        </div>
    </form>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const emailInput = document.getElementById('email_input');
        const passwordSection = document.getElementById('password_section');
        const originalEmail = emailInput.getAttribute('data-original-email');

        emailInput.addEventListener('input', function() {
            if (this.value.trim() !== originalEmail) {
                passwordSection.classList.remove('hidden');
                passwordSection.classList.add('block');
            } else {
                passwordSection.classList.add('hidden');
                passwordSection.classList.remove('block');
            }
        });
    });
</script>

@endsection
