<header
    class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-8 ml-71">

    <!-- IZQUIERDA -->
    <div>

        <h2 class="text-2xl font-bold text-slate-800">
            SUB UNIDAD DE SOPORTE Y MANTENIMIENTO
        </h2>

        <p class="text-sm text-gray-500">
            Sistema de Gestión de Actas de Mantenimiento
        </p>

    </div>



    <!-- DERECHA -->
    <div class="flex items-center gap-4">

        <!-- PERFIL -->
        <div class="flex items-center gap-3">

            <div class="text-right">

                <p class="font-semibold text-slate-800">
                    {{ auth()->user()->apellido }} 
                </p>

                <p class="text-sm text-gray-500">
                    {{ auth()->user()->email }}
                </p>

            </div>


            <!-- AVATAR -->
            <div
                class="w-12 h-12 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">

                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

            </div>

        </div>

    </div>

</header>

