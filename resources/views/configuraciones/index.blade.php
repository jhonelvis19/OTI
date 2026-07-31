@extends('layouts.app')

@section('content')

<div class="space-y-6">

    <!-- ENCABEZADO -->
    <div>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Configuraciones de la Cuenta</h1>
        <p class="text-xs sm:text-sm text-slate-400 mt-1">Administre su información personal, firma digital y seguridad.</p>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-2xl shadow-sm flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
            <p class="text-xs sm:text-sm font-semibold">{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-rose-50 border border-rose-200 text-rose-800 p-4 rounded-2xl shadow-sm flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-rose-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
            <p class="text-xs sm:text-sm font-semibold">{{ session('error') }}</p>
        </div>
    @endif

    <div class="flex flex-col md:flex-row gap-6">

        <!-- MENÚ LATERAL INTERNO (ESTILO DOJOBS) -->
        <div class="w-full md:w-64 shrink-0">
            <div class="bg-white rounded-3xl p-3 shadow-sm border border-slate-100/80 sticky top-24">
                <nav class="flex flex-col space-y-1">
                    <a href="{{ route('configuraciones.perfil.edit') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-200 text-xs font-bold
                       {{ request()->routeIs('configuraciones.perfil.*') ? 'bg-gradient-to-r from-violet-600 to-indigo-600 text-white shadow-md shadow-violet-500/20' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Perfil Personal
                    </a>

                    <a href="{{ route('configuraciones.firma.edit') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-200 text-xs font-bold
                       {{ request()->routeIs('configuraciones.firma.*') ? 'bg-gradient-to-r from-violet-600 to-indigo-600 text-white shadow-md shadow-violet-500/20' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        Firma Digital
                    </a>

                    <a href="{{ route('configuraciones.seguridad.edit') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-200 text-xs font-bold
                       {{ request()->routeIs('configuraciones.seguridad.*') ? 'bg-gradient-to-r from-violet-600 to-indigo-600 text-white shadow-md shadow-violet-500/20' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Seguridad
                    </a>

                    @if(auth()->user()->rol === 'admin')
                    <div class="my-2 border-t border-slate-100"></div>
                    <a href="{{ route('configuraciones.plantilla.index') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-200 text-xs font-bold
                       {{ request()->routeIs('configuraciones.plantilla.*') ? 'bg-gradient-to-r from-emerald-500 to-teal-600 text-white shadow-md shadow-emerald-500/20' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Plantilla Excel
                    </a>
                    @endif
                </nav>
            </div>
        </div>

        <!-- CONTENIDO DE LA PESTAÑA -->
        <div class="flex-1 min-w-0">
            @yield('config_content')
        </div>

    </div>

</div>

@endsection
