<x-guest-layout>
    @push('head')
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="referrer" content="strict-origin-when-cross-origin">
    @endpush

    {{-- Estilos de la onda animada --}}
    @push('styles')
    <style>
        .wave-header {
            position: relative;
            overflow: hidden;
            border-radius: 1rem 1rem 0 0;
            background: linear-gradient(160deg, #1e1b4b 0%, #312e81 60%, #4338ca 100%);
            height: 170px;
        }
        .wave-text {
            position: absolute;
            top: 22px;
            left: 0; right: 0;
            text-align: center;
            z-index: 10;
            padding: 0 1.5rem;
        }
        .wave-shield {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 46px;
            height: 46px;
            border-radius: 14px;
            background: rgba(255,255,255,0.12);
            border: 1.5px solid rgba(255,255,255,0.28);
            margin-bottom: 8px;
            backdrop-filter: blur(4px);
        }
        .wave-svg {
            position: absolute;
            bottom: 0; left: 0;
            width: 100%;
            height: 88px;
            pointer-events: none;
        }
        .wave-path-1 { animation: wave1 4s ease-in-out infinite; }
        .wave-path-2 { animation: wave2 5s ease-in-out infinite; }
        .wave-path-3 { animation: wave3 6s ease-in-out infinite; }

        @keyframes wave1 {
            0%,100% { d: path("M0,38 C80,8 160,68 240,38 C320,8 400,68 480,38 C560,8 640,68 720,38 L720,88 L0,88 Z"); }
            50%      { d: path("M0,58 C80,28 160,88 240,58 C320,28 400,88 480,58 C560,28 640,88 720,58 L720,88 L0,88 Z"); }
        }
        @keyframes wave2 {
            0%,100% { d: path("M0,53 C100,23 200,78 300,48 C400,18 500,73 600,48 C670,30 720,58 720,58 L720,88 L0,88 Z"); }
            50%      { d: path("M0,33 C100,63 200,18 300,48 C400,78 500,23 600,48 C670,66 720,38 720,38 L720,88 L0,88 Z"); }
        }
        @keyframes wave3 {
            0%,100% { d: path("M0,63 C120,43 240,83 360,63 C480,43 600,83 720,63 L720,88 L0,88 Z"); }
            50%      { d: path("M0,43 C120,63 240,23 360,43 C480,63 600,23 720,43 L720,88 L0,88 Z"); }
        }
    </style>
    @endpush

    <div class="fixed inset-0 min-h-screen flex items-center justify-center bg-cover bg-center bg-no-repeat"
         style="background-image: url('{{ asset('images/fondo oti.jpg') }}');">

        <div class="absolute inset-0"
             style="background: radial-gradient(ellipse at center, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0.52) 100%);"></div>

        <div class="relative w-full max-w-md mx-4 z-10">

            {{-- Halo exterior violeta --}}
            <div class="absolute -inset-1 rounded-3xl blur-xl opacity-50"
                 style="background: linear-gradient(135deg, rgba(99,102,241,0.55) 0%, rgba(139,92,246,0.35) 50%, rgba(99,102,241,0.55) 100%);"></div>

            <div class="relative rounded-2xl overflow-hidden
                        shadow-[0_32px_80px_rgba(0,0,0,0.5),0_8px_24px_rgba(0,0,0,0.35)]
                        border border-white/50 dark:border-indigo-900/40">

                {{-- ══════════════════════════════
                     ENCABEZADO CON ONDA ANIMADA
                ══════════════════════════════ --}}
                <div class="wave-header items-center justify-center text-center">
                    <div class="wave-text">
                        <div class="wave-shield">
                        </div>
                        <h1 class="text-2xl font-bold text-white tracking-tight" style="text-shadow: 0 2px 12px rgba(0,0,0,0.35);">
                            Bienvenido
                        </h1>
                        <p class="text-sm mt-1" style="color: rgba(255,255,255,0.70);">
                            Ingresa tus credenciales para acceder al sistema
                        </p>
                    </div>

                    {{-- Ondas SVG animadas --}}
                    <svg class="wave-svg" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 720 88" preserveAspectRatio="none">
                        <path class="wave-path-1"
                              d="M0,38 C80,8 160,68 240,38 C320,8 400,68 480,38 C560,8 640,68 720,38 L720,88 L0,88 Z"
                              fill="rgba(99,102,241,0.30)"/>
                        <path class="wave-path-2"
                              d="M0,53 C100,23 200,78 300,48 C400,18 500,73 600,48 C670,30 720,58 720,58 L720,88 L0,88 Z"
                              fill="rgba(99,102,241,0.52)"/>
                        <path class="wave-path-3"
                              d="M0,63 C120,43 240,83 360,63 C480,43 600,83 720,63 L720,88 L0,88 Z"
                              fill="rgba(248,250,252,0.97)"/>
                    </svg>
                </div>

                {{-- ══════════════════════════════
                     CUERPO DEL FORMULARIO
                ══════════════════════════════ --}}
                <div class="bg-white/[0.97] dark:bg-gray-950/[0.97] backdrop-blur-xl px-8 py-7">

                    <x-auth-session-status class="mb-5" :status="session('status')" />

                    @if($errors->any())
                        <div class="flex items-start gap-3 mb-5 p-3.5 rounded-xl
                                    bg-red-50 dark:bg-red-950/40 border border-red-200 dark:border-red-800/50
                                    shadow-[0_2px_8px_rgba(239,68,68,0.12)]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/>
                                <line x1="12" y1="8" x2="12" y2="12"/>
                                <line x1="12" y1="16" x2="12.01" y2="16"/>
                            </svg>
                            <p class="text-sm text-red-700 dark:text-red-400">
                                Credenciales incorrectas. Por seguridad, verifica tus datos e intenta nuevamente.
                            </p>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}"
                          class="space-y-5"
                          novalidate spellcheck="false" autocomplete="on">
                        @csrf

                        {{-- Campo Email --}}
                        <div class="group">
                            <label for="email"
                                   class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-2">
                                Correo electrónico
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="w-5 h-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors duration-200"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="2" y="4" width="20" height="16" rx="3"/>
                                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                                    </svg>
                                </div>
                                <input id="email" type="email" name="email"
                                       value="{{ old('email') }}"
                                       required autofocus
                                       autocomplete="username"
                                       autocapitalize="none"
                                       spellcheck="false"
                                       inputmode="email"
                                       maxlength="254"
                                       placeholder="nombre@empresa.com"
                                       class="block w-full pl-11 pr-4 py-3 text-sm
                                              text-gray-900 dark:text-white
                                              bg-gray-50 dark:bg-gray-900
                                              border border-gray-200 dark:border-gray-700 rounded-xl
                                              focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500
                                              shadow-[inset_0_2px_4px_rgba(0,0,0,0.05)]
                                              hover:border-gray-300 transition-all duration-200 placeholder-gray-400" />
                            </div>
                            @error('email')
                                <p class="flex items-center gap-1.5 mt-1.5 text-xs text-red-600 dark:text-red-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 flex-shrink-0" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"/>
                                        <line x1="12" y1="8" x2="12" y2="12"/>
                                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Campo Contraseña con toggle Alpine --}}
                        <div class="group" x-data="{ show: false }">
                            <label for="password"
                                   class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-2">
                                Contraseña
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="w-5 h-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors duration-200"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="11" width="18" height="11" rx="2"/>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                        <circle cx="12" cy="16" r="1" fill="currentColor"/>
                                    </svg>
                                </div>
                                <input id="password"
                                       :type="show ? 'text' : 'password'"
                                       name="password"
                                       required
                                       autocomplete="current-password"
                                       maxlength="128"
                                       spellcheck="false"
                                       placeholder="••••••••••••"
                                       class="block w-full pl-11 pr-12 py-3 text-sm
                                              text-gray-900 dark:text-white
                                              bg-gray-50 dark:bg-gray-900
                                              border border-gray-200 dark:border-gray-700 rounded-xl
                                              focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500
                                              shadow-[inset_0_2px_4px_rgba(0,0,0,0.05)]
                                              hover:border-gray-300 transition-all duration-200 placeholder-gray-400" />

                                {{-- Toggle ver/ocultar contraseña --}}
                                <button type="button"
                                        @click="show = !show"
                                        :aria-label="show ? 'Ocultar contraseña' : 'Mostrar contraseña'"
                                        :aria-pressed="show"
                                        class="absolute inset-y-0 right-0 flex items-center pr-3.5
                                               text-gray-400 hover:text-indigo-500 dark:hover:text-indigo-400
                                               focus:outline-none transition-colors duration-200 cursor-pointer select-none">
                                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg"
                                         class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                    <svg x-show="show" xmlns="http://www.w3.org/2000/svg"
                                         class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
                                        <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
                                        <line x1="1" y1="1" x2="23" y2="23"/>
                                    </svg>
                                </button>
                            </div>

                            @error('password')
                                <p class="flex items-center gap-1.5 mt-1 text-xs text-red-600 dark:text-red-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 flex-shrink-0" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"/>
                                        <line x1="12" y1="8" x2="12" y2="12"/>
                                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Recuérdame + Olvidé contraseña --}}
                        <div class="flex items-center justify-between">
                            <label for="remember_me" class="inline-flex items-center gap-2.5 cursor-pointer group/check select-none">
                                <div class="relative flex-shrink-0">
                                    <input id="remember_me" type="checkbox" name="remember" class="peer sr-only" />
                                    <div class="w-5 h-5 rounded-md border-2 border-gray-300 dark:border-gray-600
                                                peer-checked:bg-indigo-600 peer-checked:border-indigo-600
                                                peer-focus:ring-2 peer-focus:ring-indigo-500/40
                                                group-hover/check:border-indigo-400
                                                transition-all duration-200 flex items-center justify-center">
                                        <svg class="w-3 h-3 text-white hidden peer-checked:block"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="3.5"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                    </div>
                                </div>
                                <span class="text-sm text-gray-600 dark:text-gray-400 group-hover/check:text-gray-800 transition-colors">
                                    Recordarme
                                </span>
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                   class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800
                                          font-medium underline-offset-2 hover:underline
                                          focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:rounded
                                          transition-colors duration-200">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            @endif
                        </div>

                        {{-- Botón Iniciar sesión --}}
                        <div class="pt-1">
                            <button type="submit"
                                    class="relative w-full flex items-center justify-center gap-2.5
                                           py-3.5 px-6 rounded-xl text-sm font-semibold text-white
                                           overflow-hidden group/btn
                                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
                                           dark:focus:ring-offset-gray-950
                                           transition-all duration-200 active:scale-[0.98]
                                           shadow-[0_4px_18px_rgba(99,102,241,0.5),0_2px_6px_rgba(99,102,241,0.3)]
                                           hover:shadow-[0_6px_26px_rgba(99,102,241,0.6)]"
                                    style="background: linear-gradient(135deg, #6366f1 0%, #7c3aed 100%);">
                                <span class="absolute inset-0 opacity-0 group-hover/btn:opacity-100 transition-opacity duration-300"
                                      style="background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, transparent 60%);"></span>
                                <span class="relative z-10">Iniciar sesión</span>
                            </button>
                        </div>

                    </form>

                    
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-guest-layout>