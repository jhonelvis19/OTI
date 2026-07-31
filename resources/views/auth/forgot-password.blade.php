<x-guest-layout>
    <div class="w-full max-w-md bg-white rounded-3xl p-8 shadow-xl border border-slate-100/80 space-y-6">
        <div class="text-center space-y-2">
            <div class="inline-flex p-3 rounded-2xl bg-violet-50 text-violet-600 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                </svg>
            </div>
            <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">¿Olvidó su contraseña?</h2>
            <p class="text-xs text-slate-400">
                Ingrese su correo electrónico registrado y le enviaremos un enlace para restablecerla.
            </p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">
                    Correo electrónico
                </label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                       placeholder="ejemplo@unapiquitos.edu.pe"
                       class="w-full rounded-xl border border-slate-200 bg-slate-50/70 px-4 py-3 text-xs sm:text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 focus:bg-white outline-none transition">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="space-y-3 pt-2">
                <button type="submit"
                        class="w-full bg-gradient-to-r from-violet-600 to-indigo-600 hover:from-violet-700 hover:to-indigo-700 text-white font-bold text-xs py-3.5 px-6 rounded-2xl shadow-lg shadow-violet-500/25 transition-all hover:scale-[1.02] active:scale-95">
                    Enviar enlace de recuperación
                </button>

                <a href="{{ route('login') }}" class="block text-center text-xs font-bold text-slate-500 hover:text-violet-600 transition">
                    ← Volver a iniciar sesión
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
