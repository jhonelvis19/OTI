@extends('configuraciones.index')

@section('config_content')

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    
    <div class="px-6 py-5 border-b border-slate-100 bg-slate-50">
        <h2 class="text-lg font-bold text-slate-800">Perfil de Usuario</h2>
        <p class="text-sm text-slate-500 mt-1">Actualice su información personal.</p>
    </div>

    <div class="p-6">
        <form action="{{ route('configuraciones.perfil.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Nombres -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Nombres</label>
                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required
                           class="w-full rounded-xl border {{ $errors->has('name') ? 'border-red-400 bg-red-50' : 'border-slate-200' }} px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-400 focus:border-transparent outline-none transition">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Apellidos -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Apellidos</label>
                    <input type="text" name="apellido" value="{{ old('apellido', auth()->user()->apellido) }}" required
                           class="w-full rounded-xl border {{ $errors->has('apellido') ? 'border-red-400 bg-red-50' : 'border-slate-200' }} px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-400 focus:border-transparent outline-none transition">
                    @error('apellido')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Correo electrónico</label>
                <input type="email" name="email" id="email_input" value="{{ old('email', auth()->user()->email) }}" required
                       class="w-full rounded-xl border {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-slate-200' }} px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-400 focus:border-transparent outline-none transition"
                       data-original-email="{{ auth()->user()->email }}">
                <p class="text-xs text-slate-400 mt-2">Este correo se utiliza para iniciar sesión en el sistema.</p>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Contraseña Actual (Oculto por defecto, se muestra si el correo cambia) -->
            <div id="password_section" class="{{ old('email') && old('email') !== auth()->user()->email ? 'block' : 'hidden' }} mb-6 p-4 bg-orange-50 border border-orange-200 rounded-xl">
                <label class="block text-sm font-semibold text-orange-800 mb-2">Contraseña actual</label>
                <p class="text-xs text-orange-600 mb-3">Para cambiar su correo electrónico, debe ingresar su contraseña actual por seguridad.</p>
                <input type="password" name="password_actual" 
                       class="w-full rounded-xl border {{ $errors->has('password_actual') ? 'border-red-400 bg-red-50' : 'border-orange-300' }} px-4 py-3 text-sm focus:ring-2 focus:ring-orange-400 focus:border-transparent outline-none transition">
                @error('password_actual')
                    <p class="text-red-600 text-xs mt-1 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end pt-4 border-t border-slate-100">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 px-6 rounded-xl transition shadow-sm">
                    Guardar cambios
                </button>
            </div>
        </form>
    </div>

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
