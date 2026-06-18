<header class="fixed top-0 left-0 right-0 z-50 h-20 bg-white border-b border-slate-200 shadow-sm px-5">

    <div class="h-full flex items-center min-w-0 gap-4">

        <!-- BOTÓN HAMBURGUESA (solo móvil) -->
        <button id="menuToggle"
                class="lg:hidden flex-shrink-0 bg-indigo-700 text-white p-2 rounded-xl">
            <svg id="iconAbrir" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg id="iconCerrar" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- IMAGEN -->
        <img src="{{ asset('images/oti-ofic.png') }}"
             alt="Logo"
             class="h-12 w-auto object-contain flex-shrink-0">

        <!-- TEXTO -->
        <div class="min-w-0 flex-1 text-center lg:text-left">
            <h2 class="text-lg font-bold text-slate-700 truncate">
                SUB UNIDAD DE SOPORTE Y MANTENIMIENTO
            </h2>
            <p class="text-sm text-slate-500 truncate items-center flex">
                Sistema de Gestión de Actas de Mantenimiento
            </p>
        </div>

                <!-- DERECHA -->
        <div class="flex items-center gap-3 flex-shrink-0 ml-4">
            <img src="{{ asset('images/sunedu_logo.png') }}"
             alt="Logo"
             class="h-12 w-auto object-contain flex-shrink-0 mr-2">
        </div>

    </div>

</header>

<div class="h-20"></div>