<x-guest-layout>

    <!-- ════════════════════════════════════════════════════════════════
         FONDO A PANTALLA COMPLETA SIN SCROLLBAR (H-SCREEN OVERFLOW-HIDDEN)
    ════════════════════════════════════════════════════════════════ -->
    <div class="relative h-screen w-full flex items-center justify-center lg:justify-end bg-cover bg-center bg-no-repeat p-2 sm:p-4 lg:px-16 overflow-hidden"
         style="background-image: url('{{ asset('images/fondo oti.jpg') }}');">

        <!-- Capa de oscurecimiento sutil y ajuste de brillo/saturación para resaltar la imagen de fondo con contraste -->
        <div class="absolute inset-0 bg-slate-950/45 backdrop-brightness-75 backdrop-contrast-125 z-0"></div>

        <!-- Halo brillante azul sutil detrás del formulario -->
        <div class="absolute right-10 lg:right-24 w-96 h-96 bg-blue-600/30 rounded-full blur-3xl pointer-events-none z-0"></div>

        <!-- ════════════════════════════════════════════════════════════════
             TARJETA DE FORMULARIO DE LOGIN COMPACTA
        ════════════════════════════════════════════════════════════════ -->
        <div class="relative z-10 w-full max-w-md my-auto space-y-1.5 lg:mr-4 xl:mr-12 bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl p-4 sm:p-5 rounded-3xl shadow-[0_20px_50px_-10px_rgba(0,0,0,0.5)] border border-white/60 dark:border-slate-800 overflow-hidden">

            <!-- LOGO / ENCABEZADO: IMÁGENES SE VUELVEN BLANCAS EN MODO OSCURO (DARK:BRIGHTNESS-0 DARK:INVERT) -->
            <div class="flex items-center justify-center gap-2 -my-6 sm:-my-8 p-0">
                <img src="{{ asset('images/oti-ofic.png') }}"
                     alt="Logo OTI"
                     class="h-36 sm:h-44 w-auto object-contain filter drop-shadow-md transition-all hover:scale-105 dark:brightness-0 dark:invert">
                <img src="{{ asset('images/sunedu_logo.png') }}"
                     alt="Logo SUNEDU"
                     class="h-36 sm:h-44 w-auto object-contain filter drop-shadow-md transition-all hover:scale-105 dark:brightness-0 dark:invert">
            </div>

            <!-- TITULO Y SUBTITULO -->
            <div class="text-center space-y-0.5 pt-1">
                <h1 class="text-2xl font-extrabold text-blue-950 dark:text-white tracking-tight">
                    Iniciar Sesión
                </h1>
                <p class="text-[10px] font-bold text-blue-600 dark:text-blue-400 uppercase tracking-widest">
                    OTI | PANEL DE CONTROL
                </p>
            </div>

            <!-- MENSAJE DE ESTADO DE SESIÓN -->
            <x-auth-session-status class="mb-1" :status="session('status')" />

            <!-- ERRORES DE VALIDACIÓN -->
            @if($errors->any())
                <div class="p-2 rounded-xl bg-rose-50 dark:bg-rose-950/50 border border-rose-200 dark:border-rose-800 text-rose-700 dark:text-rose-300 text-xs font-semibold flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-rose-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8" x2="12" y2="12"/>
                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    <span>Credenciales incorrectas. Verifique sus datos.</span>
                </div>
            @endif

            <!-- FORMULARIO DE ACCESO -->
            <form method="POST" action="{{ route('login') }}" class="space-y-2" novalidate spellcheck="false">
                @csrf

                <!-- CAMPO CORREO ELECTRONICO -->
                <div>
                    <label for="email" class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-0.5 pl-1">
                        Correo Electrónico
                    </label>
                    <input id="email"
                           type="email"
                           name="email"
                           value="{{ old('email') }}"
                           required autofocus
                           autocomplete="username"
                           placeholder="nombre@empresa.com"
                           class="w-full px-3.5 py-2 rounded-xl border-2 border-blue-200 dark:border-slate-700 focus:border-blue-600 focus:ring-2 focus:ring-blue-500/20 text-slate-800 dark:text-white text-xs font-bold placeholder-slate-400 outline-none transition bg-white dark:bg-slate-800 shadow-sm" />
                    @error('email')
                        <p class="text-rose-600 dark:text-rose-400 text-[10px] mt-0.5 font-semibold pl-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- CAMPO CONTRASEÑA -->
                <div x-data="{ show: false }">
                    <label for="password" class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-0.5 pl-1">
                        Contraseña
                    </label>
                    <div class="relative">
                        <input id="password"
                               :type="show ? 'text' : 'password'"
                               name="password"
                               required
                               autocomplete="current-password"
                               placeholder="••••••••••••"
                               class="w-full px-3.5 py-2 pr-10 rounded-xl border-2 border-blue-200 dark:border-slate-700 focus:border-blue-600 focus:ring-2 focus:ring-blue-500/20 text-slate-800 dark:text-white text-xs font-bold placeholder-slate-400 outline-none transition bg-white dark:bg-slate-800 shadow-sm" />
                        
                        <button type="button"
                                @click="show = !show"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-blue-500 hover:text-blue-700 dark:hover:text-blue-400 transition">
                            <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.04 10.04 0 013.98-.823c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-rose-600 dark:text-rose-400 text-[10px] mt-0.5 font-semibold pl-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- OPCIONES: RECORDARME + RECUPERAR CONTRASEÑA -->
                <div class="flex items-center justify-between px-1">
                    <label for="remember_me" class="inline-flex items-center gap-1.5 cursor-pointer select-none">
                        <input id="remember_me"
                               type="checkbox"
                               name="remember"
                               class="w-3.5 h-3.5 rounded-full border-2 border-blue-300 text-blue-600 focus:ring-0 cursor-pointer" />
                        <span class="text-[11px] font-bold text-slate-700 dark:text-slate-300">
                            Recordarme
                        </span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="text-[11px] font-bold text-blue-600 dark:text-blue-400 hover:text-blue-800 transition hover:underline">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>

                <!-- BOTON INICIAR SESION (DEGRADADO AZUL) -->
                <div class="pt-0.5">
                    <button type="submit"
                            class="w-full py-2.5 px-5 rounded-xl text-xs font-extrabold tracking-wider text-white uppercase shadow-lg shadow-blue-500/30 hover:shadow-xl transition-all transform hover:scale-[1.01] active:scale-95 cursor-pointer bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700">
                        INICIAR SESIÓN
                    </button>
                </div>

            </form>

            <!-- PIE DE PAGINA -->
            <div class="pt-1 text-center">
                <p class="text-[9px] font-bold text-blue-600 dark:text-blue-400 uppercase tracking-widest">
                    Subunidad de Soporte y Mantenimiento
                </p>
            </div>

        </div>

    </div>

</x-guest-layout>