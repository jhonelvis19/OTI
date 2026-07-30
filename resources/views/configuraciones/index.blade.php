@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto pb-10">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-800">Configuraciones</h1>
        <p class="text-gray-500 mt-2">Administre su perfil, firma y seguridad de la cuenta.</p>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg">
            <div class="flex items-center">
                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                <p class="text-green-700 font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
            <div class="flex items-center">
                <svg class="h-5 w-5 text-red-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                <p class="text-red-700 font-medium">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <div class="flex flex-col md:flex-row gap-6">

        <!-- MENÚ LATERAL INTERNO -->
        <div class="w-full md:w-64 shrink-0">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden sticky top-24">
                
                <div class="px-5 py-4 bg-slate-50 border-b border-slate-100">
                    <h2 class="text-xs font-bold text-slate-500 uppercase tracking-wider">Menú de Opciones</h2>
                </div>

                <nav class="flex flex-col p-2 space-y-1">
                    
                    <a href="{{ route('configuraciones.perfil.edit') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl transition text-sm font-medium
                       {{ request()->routeIs('configuraciones.perfil.*') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-50' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Perfil
                    </a>

                    <a href="{{ route('configuraciones.firma.edit') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl transition text-sm font-medium
                       {{ request()->routeIs('configuraciones.firma.*') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-50' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        Firma
                    </a>

                    <a href="{{ route('configuraciones.seguridad.edit') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl transition text-sm font-medium
                       {{ request()->routeIs('configuraciones.seguridad.*') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-50' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Seguridad
                    </a>

                    @if(auth()->user()->rol === 'admin')
                    <div class="my-2 border-t border-slate-100"></div>
                    <a href="{{ route('configuraciones.plantilla.index') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl transition text-sm font-medium
                       {{ request()->routeIs('configuraciones.plantilla.*') ? 'bg-green-50 text-green-700' : 'text-slate-600 hover:bg-slate-50' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Plantilla Excel
                    </a>
                    @endif

                </nav>
            </div>
        </div>

        <!-- CONTENIDO DE LA PESTAÑA -->
        <div class="flex-1">
            @yield('config_content')
        </div>

    </div>

</div>

@endsection
