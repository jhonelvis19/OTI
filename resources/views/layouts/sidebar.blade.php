<aside id="sidebar"
       class="w-72 bg-white h-[calc(100vh-5rem)] fixed left-0 top-20 z-40
              flex flex-col border-r border-slate-100/80 shadow-sm
              transition-transform duration-300 ease-in-out
              -translate-x-full lg:translate-x-0">

    <!-- SECCIÓN PERFIL DE USUARIO (ESTILO DOJOBS) -->
    <div class="p-5 border-b border-slate-100/80">
        <div class="flex items-center gap-3.5 p-3 rounded-2xl bg-slate-50/80 border border-slate-100">
            <div class="relative flex-shrink-0">
                <div class="h-11 w-11 rounded-full bg-gradient-to-tr from-violet-600 to-indigo-500 text-white font-bold flex items-center justify-center shadow-md shadow-violet-500/20 text-sm">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}{{ strtoupper(substr(auth()->user()->apellido ?? '', 0, 1)) }}
                </div>
                <span class="absolute bottom-0 right-0 h-3 w-3 rounded-full bg-emerald-500 ring-2 ring-white"></span>
            </div>
            <div class="min-w-0 flex-1">
                <h3 class="text-sm font-bold text-slate-800 truncate leading-tight">
                    {{ auth()->user()->name }} {{ auth()->user()->apellido }}
                </h3>
                <p class="text-xs text-slate-400 truncate mt-0.5">
                    {{ auth()->user()->email }}
                </p>
                <span class="inline-block mt-1 px-2 py-0.5 text-[10px] font-semibold tracking-wide uppercase rounded-md bg-violet-100 text-violet-700">
                    {{ ucfirst(auth()->user()->rol) }}
                </span>
            </div>
        </div>
    </div>

    <!-- MENÚ DE NAVEGACIÓN -->
    <nav class="flex-1 px-4 py-5 space-y-1.5 overflow-y-auto">

        @if(auth()->user()->rol === 'admin')

            <!-- Inicio -->
            <a href="/admin/dashboard" onclick="cerrarMenu()"
               class="flex items-center gap-3.5 px-4 py-3.5 rounded-2xl transition-all duration-200 font-semibold text-xs tracking-wide
               {{ request()->is('admin/dashboard')
                   ? 'bg-gradient-to-r from-violet-600 to-indigo-600 text-white shadow-lg shadow-violet-500/25'
                   : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                <span>Inicio</span>
            </a>

            <!-- Nuevo Informe -->
            <a href="/admin/informes/create" onclick="cerrarMenu()"
               class="flex items-center gap-3.5 px-4 py-3.5 rounded-2xl transition-all duration-200 font-semibold text-xs tracking-wide
               {{ request()->is('admin/informes/create')
                   ? 'bg-gradient-to-r from-violet-600 to-indigo-600 text-white shadow-lg shadow-violet-500/25'
                   : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                <span>Nuevo Informe</span>
            </a>

            <!-- Historial -->
            <a href="/admin/informes" onclick="cerrarMenu()"
               class="flex items-center gap-3.5 px-4 py-3.5 rounded-2xl transition-all duration-200 font-semibold text-xs tracking-wide
               {{ request()->is('admin/informes')
                   ? 'bg-gradient-to-r from-violet-600 to-indigo-600 text-white shadow-lg shadow-violet-500/25'
                   : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span>Historial</span>
            </a>

            <!-- Mis Informes -->
            <a href="/admin/mis-informes" onclick="cerrarMenu()"
               class="flex items-center gap-3.5 px-4 py-3.5 rounded-2xl transition-all duration-200 font-semibold text-xs tracking-wide
               {{ request()->is('admin/mis-informes')
                   ? 'bg-gradient-to-r from-violet-600 to-indigo-600 text-white shadow-lg shadow-violet-500/25'
                   : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <span>Mis Informes</span>
            </a>

            <!-- Usuarios -->
            <a href="/admin/usuarios" onclick="cerrarMenu()"
               class="flex items-center gap-3.5 px-4 py-3.5 rounded-2xl transition-all duration-200 font-semibold text-xs tracking-wide
               {{ request()->is('admin/usuarios*')
                   ? 'bg-gradient-to-r from-violet-600 to-indigo-600 text-white shadow-lg shadow-violet-500/25'
                   : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span>Usuarios</span>
            </a>

            <!-- Configuraciones -->
            <a href="/configuraciones" onclick="cerrarMenu()"
               class="flex items-center gap-3.5 px-4 py-3.5 rounded-2xl transition-all duration-200 font-semibold text-xs tracking-wide
               {{ request()->is('configuraciones*')
                   ? 'bg-gradient-to-r from-violet-600 to-indigo-600 text-white shadow-lg shadow-violet-500/25'
                   : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span>Configuraciones</span>
            </a>

        @endif

        @if(auth()->user()->rol === 'usuario')

            <!-- Inicio Usuario -->
            <a href="/usuario/dashboard" onclick="cerrarMenu()"
               class="flex items-center gap-3.5 px-4 py-3.5 rounded-2xl transition-all duration-200 font-semibold text-xs tracking-wide
               {{ request()->is('usuario/dashboard')
                   ? 'bg-gradient-to-r from-violet-600 to-indigo-600 text-white shadow-lg shadow-violet-500/25'
                   : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                <span>Inicio</span>
            </a>

            <!-- Nuevo Informe -->
            <a href="/usuario/informes/create" onclick="cerrarMenu()"
               class="flex items-center gap-3.5 px-4 py-3.5 rounded-2xl transition-all duration-200 font-semibold text-xs tracking-wide
               {{ request()->is('usuario/informes/create')
                   ? 'bg-gradient-to-r from-violet-600 to-indigo-600 text-white shadow-lg shadow-violet-500/25'
                   : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                <span>Nuevo Informe</span>
            </a>

            <!-- Mi Historial -->
            <a href="/usuario/informes" onclick="cerrarMenu()"
               class="flex items-center gap-3.5 px-4 py-3.5 rounded-2xl transition-all duration-200 font-semibold text-xs tracking-wide
               {{ request()->is('usuario/informes')
                   ? 'bg-gradient-to-r from-violet-600 to-indigo-600 text-white shadow-lg shadow-violet-500/25'
                   : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span>Mi Historial</span>
            </a>

            <!-- Configuraciones -->
            <a href="/configuraciones" onclick="cerrarMenu()"
               class="flex items-center gap-3.5 px-4 py-3.5 rounded-2xl transition-all duration-200 font-semibold text-xs tracking-wide
               {{ request()->is('configuraciones*')
                   ? 'bg-gradient-to-r from-violet-600 to-indigo-600 text-white shadow-lg shadow-violet-500/25'
                   : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span>Configuraciones</span>
            </a>

        @endif

        <div class="pt-4 border-t border-slate-100/80">
            <!-- Cerrar Sesión -->
            <a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit(); cerrarMenu()"
               class="flex items-center gap-3.5 px-4 py-3.5 rounded-2xl transition-all duration-200 font-semibold text-xs tracking-wide text-rose-500 hover:bg-rose-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                </svg>
                <span>Cerrar sesión</span>
            </a>

            <form id="logout-form" action="/logout" method="POST" class="hidden">
                @csrf
            </form>
        </div>

    </nav>

    <!-- FOOTER SIDEBAR: BOTÓN INTERRUPTOR COMPLETO DE TEMA -->
    <div class="p-4 border-t border-slate-100/80 bg-slate-50/50">
        <button type="button"
                onclick="toggleDarkMode()"
                aria-label="Alternar modo claro u oscuro"
                class="w-full flex items-center justify-between p-3 rounded-2xl bg-white border border-slate-200/80 hover:border-violet-300 shadow-sm transition-all duration-200 text-xs font-bold text-slate-700">
            <span class="flex items-center gap-2.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-amber-500 theme-icon-sun hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-violet-600 theme-icon-moon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
                <span>Modo <span class="theme-text">Claro</span></span>
            </span>

            <!-- INTERRUPTOR SWITCH DESLIZANTE -->
            <span class="relative inline-flex h-6 w-11 flex-shrink-0 rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out bg-slate-300 dark:bg-violet-600">
                <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out translate-x-0 dark:translate-x-5"></span>
            </span>
        </button>
    </div>

</aside>