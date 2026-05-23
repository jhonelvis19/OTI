<!DOCTYPE html>
<html lang="es" class="h-full">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Sistema OTI</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body class="bg-slate-100 min-h-screen">

    <div class="flex">

        <!-- SIDEBAR -->
        @include('layouts.sidebar')


        <!-- CONTENIDO -->
        <div class="flex-1 ml-72 min-h-screen">

            <!-- NAVBAR -->
            @include('layouts.navbar')


            <!-- MAIN -->
            <main class="p-8">

                @yield('content')

            </main>

        </div>

    </div>

</body>

</html>