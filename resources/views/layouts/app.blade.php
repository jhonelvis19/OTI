<!DOCTYPE html>
<html lang="es" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema OTI</title>
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<body class="bg-slate-50 text-slate-800 antialiased overflow-x-hidden">

    @include('layouts.sidebar')

    <div id="overlay"
         class="lg:hidden fixed inset-0 bg-black/50 z-30 hidden"
         onclick="cerrarMenu()">
    </div>

    <div class="flex flex-col min-h-screen lg:ml-64">
        @include('layouts.header')
        <main class="flex-1 p-6 lg:p-8">
            @yield('content')
        </main>
    </div>

    <script>
    function abrirMenu() {
        document.getElementById('sidebar').classList.remove('-translate-x-full');
        document.getElementById('overlay').classList.remove('hidden');
        document.getElementById('iconAbrir').classList.add('hidden');
        document.getElementById('iconCerrar').classList.remove('hidden');
    }

    function cerrarMenu() {
        document.getElementById('sidebar').classList.add('-translate-x-full');
        document.getElementById('overlay').classList.add('hidden');
        document.getElementById('iconAbrir').classList.remove('hidden');
        document.getElementById('iconCerrar').classList.add('hidden');
    }

    document.getElementById('menuToggle').addEventListener('click', function () {
        const sidebar = document.getElementById('sidebar');
        if (sidebar.classList.contains('-translate-x-full')) {
            abrirMenu();
        } else {
            cerrarMenu();
        }
    });
    </script>

</body>

</html>