<aside class="w-72 bg-slate-950 text-white h-screen fixed left-0 top-0 flex flex-col">

<div class="px-6 py-5 border-b border-slate-800">
        <img src="{{ asset('images/oti-ofic.png') }}" class="h-8 w-auto object-contain" alt="Logo OTI">

</div>

    <!-- MENÚ -->
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">

        @if(auth()->user()->rol === 'admin')

            <a href="/admin/dashboard"

            class="flex items-center gap-3 px-4 py-3 rounded-xl transition

            {{ request()->is('admin/dashboard')
                    ? 'bg-blue-600 text-white'
                    : 'hover:bg-slate-800 text-slate-300' }}">

            <span>Dashboard</span>

            </a>

            <a href="/admin/informes/create"

            class="flex items-center gap-3 px-4 py-3 rounded-xl transition

            {{ request()->is('admin/informes/create')
                    ? 'bg-blue-600 text-white'
                    : 'hover:bg-slate-800 text-slate-300' }}">

                <span>Nuevo Informe</span>

            </a>


            <a href="/admin/informes"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition
               {{ request()->is('admin/informes')
                       ? 'bg-blue-600 text-white'
                       : 'hover:bg-slate-800 text-slate-300' }}">
                <span>Historial</span>

            </a>


            <a href="/admin/usuarios"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition
               {{ request()->is('admin/usuarios')
                       ? 'bg-blue-600 text-white'
                       : 'hover:bg-slate-800 text-slate-300' }}">
                <span>Usuarios</span>

            </a>  


            <a href="/admin/configuracion"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition
               {{ request()->is('admin/configuracion')
                       ? 'bg-blue-600 text-white'
                       : 'hover:bg-slate-800 text-slate-300' }}">
                <span>Configuración</span>

            </a>

        @endif



        @if(auth()->user()->rol === 'usuario')

            <a href="/usuario/dashboard"

            class="flex items-center gap-3 px-4 py-3 rounded-xl transition

            {{ request()->is('usuario/dashboard')
                    ? 'bg-blue-600 text-white'
                    : 'hover:bg-slate-800 text-slate-300' }}">
                    <span>Dashboard</span>

            </a>


            <a href="/usuario/informes/create"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition
               {{ request()->is('usuario/informes/create')
                       ? 'bg-blue-600 text-white'
                       : 'hover:bg-slate-800 text-slate-300' }}">
                <span>Crear Informe</span>

            </a>

            <a href="/usuario/informes"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition
               {{ request()->is('usuario/informes')
                       ? 'bg-blue-600 text-white'
                       : 'hover:bg-slate-800 text-slate-300' }}">
                <span>Mi Historial</span>

            </a>


            <a href="/usuario/perfil"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition
               {{ request()->is('usuario/perfil')
                       ? 'bg-blue-600 text-white'
                       : 'hover:bg-slate-800 text-slate-300' }}">
                <span>Perfil</span>

            </a>

        @endif

    </nav>

    <div class="p-4 border-t border-slate-800">

        <div class="flex items-center justify-between">

            <div>

                <p class="font-semibold">
                    {{ auth()->user()->apellido }}
                </p>

                <p class="text-sm text-slate-400">
                    {{ auth()->user()->rol }}
                </p>

            </div>


            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    class="text-red-400 hover:text-red-500"
                    type="submit">

                    Salir

                </button>

            </form>

        </div>

    </div>

</aside>