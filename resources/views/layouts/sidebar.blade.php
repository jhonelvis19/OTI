<aside id="sidebar"
       class="w-64 bg-indigo-700 text-white h-screen fixed left-0 top-16 z-40
              flex flex-col border-r border-indigo-600 shadow-xl
              transition-transform duration-300
              -translate-x-full lg:translate-x-0">

    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">

        @if(auth()->user()->rol === 'admin')

            <a href="/admin/dashboard" onclick="cerrarMenu()"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition font-medium
               {{ request()->is('admin/dashboard') ? 'bg-blue-600 text-white' : 'hover:bg-indigo-600 text-indigo-100' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span>Inicio</span>
            </a>

            <a href="/admin/informes/create" onclick="cerrarMenu()"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition font-medium
               {{ request()->is('admin/informes/create') ? 'bg-blue-600 text-white' : 'hover:bg-indigo-600 text-indigo-100' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                <span>Nuevo Informe</span>
            </a>

            <a href="/admin/informes" onclick="cerrarMenu()"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition font-medium
               {{ request()->is('admin/informes') ? 'bg-blue-600 text-white' : 'hover:bg-indigo-600 text-indigo-100' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                </svg>
                <span>Historial</span>
            </a>

            <a href="/admin/mis-informes" onclick="cerrarMenu()"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition font-medium
               {{ request()->is('admin/mis-informes') ? 'bg-blue-600 text-white' : 'hover:bg-indigo-600 text-indigo-100' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span>Mis Informes</span>
            </a>

            <a href="/admin/usuarios" onclick="cerrarMenu()"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition font-medium
               {{ request()->is('admin/usuarios') ? 'bg-blue-600 text-white' : 'hover:bg-indigo-600 text-indigo-100' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span>Usuarios</span>
            </a>

            <a href="/configuraciones" onclick="cerrarMenu()"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition font-medium
               {{ request()->is('configuraciones*') ? 'bg-blue-600 text-white' : 'hover:bg-indigo-600 text-indigo-100' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span>Configuraciones</span>
            </a>

            <a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit(); cerrarMenu()"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition font-medium hover:bg-indigo-600 text-indigo-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                </svg>
                <span>Cerrar sesión</span>
            </a>

            <form id="logout-form" action="/logout" method="POST" class="hidden">
                @csrf
            </form>


        @endif

        @if(auth()->user()->rol === 'usuario')

            <a href="/usuario/dashboard" onclick="cerrarMenu()"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition font-medium
               {{ request()->is('usuario/dashboard') ? 'bg-blue-600 text-white' : 'hover:bg-indigo-600 text-indigo-100' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span>Inicio</span>
            </a>

            <a href="/usuario/informes/create" onclick="cerrarMenu()"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition font-medium
               {{ request()->is('usuario/informes/create') ? 'bg-blue-600 text-white' : 'hover:bg-indigo-600 text-indigo-100' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                <span>Nuevo Informe</span>
            </a>

            <a href="/usuario/informes" onclick="cerrarMenu()"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition font-medium
               {{ request()->is('usuario/informes') ? 'bg-blue-600 text-white' : 'hover:bg-indigo-600 text-indigo-100' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                </svg>
                <span>Mi Historial</span>
            </a>

            <a href="/configuraciones" onclick="cerrarMenu()"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition font-medium
               {{ request()->is('configuraciones*') ? 'bg-blue-600 text-white' : 'hover:bg-indigo-600 text-indigo-100' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span>Configuraciones</span>
            </a>

            <a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit(); cerrarMenu()"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition font-medium hover:bg-indigo-600 text-indigo-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                </svg>
                <span>Cerrar sesión</span>
            </a>

            <form id="logout-form" action="/logout" method="POST" class="hidden">
                @csrf
            </form>

        @endif

    </nav>



</aside>