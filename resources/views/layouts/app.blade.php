<!DOCTYPE html>
<html lang="es" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema OTI - Gestión de Mantenimiento</title>

    <script>
        // Script de inicialización de tema antes de renderizar para evitar parpadeos
        (function() {
            const storedTheme = localStorage.getItem('theme');
            if (storedTheme === 'dark' || (!storedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f3f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        html.dark ::-webkit-scrollbar-track {
            background: #0f172a;
        }
        html.dark ::-webkit-scrollbar-thumb {
            background: #334155;
        }
    </style>
</head>

<body class="bg-[#f4f5fa] text-slate-800 antialiased min-h-screen selection:bg-violet-500 selection:text-white transition-colors duration-200">

    @include('layouts.header')

    <!-- Overlay móvil -->
    <div id="overlay"
         class="lg:hidden fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-30 hidden transition-opacity duration-300"
         onclick="cerrarMenu()">
    </div>

    <div class="flex min-h-[calc(100vh-5rem)]">
        @include('layouts.sidebar')

        <main class="flex-1 p-4 sm:p-6 lg:p-8 lg:ml-72 transition-all duration-300 w-full overflow-x-hidden">
            @yield('content')
        </main>
    </div>

    <!-- MODAL GLOBAL DE OPERACIÓN EXITOSA / ERROR -->
    @if(session('success') || session('error'))
    <div id="global-status-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm transition-opacity duration-300">
        <div class="relative w-full max-w-md bg-white dark:bg-slate-900 rounded-3xl p-6 sm:p-8 shadow-2xl border border-slate-100 dark:border-slate-800 text-center space-y-5 animate-in fade-in zoom-in duration-200">
            
            @if(session('success'))
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-emerald-100 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div class="space-y-2">
                <h3 class="text-xl font-extrabold text-slate-800 dark:text-white">¡Operación Exitosa!</h3>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 font-medium">{{ session('success') }}</p>
            </div>
            <div class="pt-2">
                <button type="button" onclick="closeGlobalModal()" class="w-full bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-bold text-xs py-3 px-6 rounded-2xl shadow-lg shadow-emerald-500/25 transition-all hover:scale-[1.02] active:scale-95">
                    Aceptar
                </button>
            </div>
            @endif

            @if(session('error'))
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-rose-100 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <div class="space-y-2">
                <h3 class="text-xl font-extrabold text-slate-800 dark:text-white">Atención / Error</h3>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 font-medium">{{ session('error') }}</p>
            </div>
            <div class="pt-2">
                <button type="button" onclick="closeGlobalModal()" class="w-full bg-gradient-to-r from-rose-500 to-red-600 hover:from-rose-600 hover:to-red-700 text-white font-bold text-xs py-3 px-6 rounded-2xl shadow-lg shadow-rose-500/25 transition-all hover:scale-[1.02] active:scale-95">
                    Entendido
                </button>
            </div>
            @endif

        </div>
    </div>
    <script>
        function closeGlobalModal() {
            const modal = document.getElementById('global-status-modal');
            if (modal) modal.remove();
        }
        // Auto-cerrar después de 4 segundos
        setTimeout(() => closeGlobalModal(), 4000);
    </script>
    @endif

    <script>
    function toggleDarkMode() {
        const isDark = document.documentElement.classList.toggle('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
        updateThemeUI();
    }

    function updateThemeUI() {
        const isDark = document.documentElement.classList.contains('dark');
        document.querySelectorAll('.theme-icon-sun').forEach(el => el.classList.toggle('hidden', !isDark));
        document.querySelectorAll('.theme-icon-moon').forEach(el => el.classList.toggle('hidden', isDark));
        document.querySelectorAll('.theme-text').forEach(el => el.textContent = isDark ? 'Oscuro' : 'Claro');
    }

    document.addEventListener('DOMContentLoaded', updateThemeUI);

    function abrirMenu() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
        document.getElementById('iconAbrir')?.classList.add('hidden');
        document.getElementById('iconCerrar')?.classList.remove('hidden');
    }

    function cerrarMenu() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        document.getElementById('iconAbrir')?.classList.remove('hidden');
        document.getElementById('iconCerrar')?.classList.add('hidden');
    }

    const menuToggle = document.getElementById('menuToggle');
    if (menuToggle) {
        menuToggle.addEventListener('click', function () {
            const sidebar = document.getElementById('sidebar');
            if (sidebar.classList.contains('-translate-x-full')) {
                abrirMenu();
            } else {
                cerrarMenu();
            }
        });
    }
    </script>

</body>

</html>