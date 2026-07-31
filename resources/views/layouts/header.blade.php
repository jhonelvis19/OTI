<header class="sticky top-0 z-40 h-20 bg-white/90 dark:bg-slate-900/90 backdrop-blur-md border-b border-slate-100 dark:border-slate-800 shadow-sm px-4 sm:px-6 lg:px-8 overflow-visible">

    <div class="h-full flex items-center justify-between gap-4 max-w-7xl mx-auto lg:max-w-none">

        <!-- LADO IZQUIERDO: MENÚ MÓVIL Y LOGO OTI DE GRAN TAMAÑO -->
        <div class="flex items-center gap-3 sm:gap-5 flex-shrink-0">
            <!-- BOTÓN HAMBURGUESA (solo móvil) -->
            <button id="menuToggle"
                    type="button"
                    class="lg:hidden flex items-center justify-center h-10 w-10 bg-violet-50 text-violet-600 hover:bg-violet-100 rounded-xl transition-all duration-200">
                <svg id="iconAbrir" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg id="iconCerrar" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- LOGO OTI MÁS GRANDE CON BLANCO EN MODO OSCURO -->
            <a href="/" class="flex items-center gap-3 sm:gap-4 py-0">
                <img src="{{ asset('images/oti-ofic.png') }}"
                     alt="Logo OTI"
                     class="h-28 sm:h-32 lg:h-36 -my-5 sm:-my-7 w-auto object-contain transition-all hover:scale-105 filter drop-shadow-md dark:brightness-0 dark:invert">
                <div class="hidden sm:block border-l border-slate-200 dark:border-slate-700 pl-4">
                    <h2 class="text-xs sm:text-sm font-extrabold text-slate-800 dark:text-white tracking-wide uppercase">
                        SUB UNIDAD DE SOPORTE Y MANTENIMIENTO
                    </h2>
                    <p class="text-[11px] sm:text-xs font-medium text-slate-400 dark:text-slate-400">
                        Sistema de Gestión de Actas de Mantenimiento
                    </p>
                </div>
            </a>
        </div>

        <!-- LADO DERECHO: LOGO SUNEDU IGUALMENTE AMPLIADO Y BLANCO EN MODO OSCURO -->
        <div class="flex items-center gap-3 flex-shrink-0">
            <div class="flex items-center py-0">
                <img src="{{ asset('images/sunedu_logo.png') }}"
                     alt="Logo SUNEDU"
                     class="h-28 sm:h-32 lg:h-36 -my-5 sm:-my-7 w-auto object-contain filter drop-shadow-md transition-all hover:scale-105 dark:brightness-0 dark:invert">
            </div>
        </div>

    </div>

</header>