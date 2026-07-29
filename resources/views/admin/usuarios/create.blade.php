@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">

        <h1 class="text-3xl font-bold text-slate-800 mb-8">

            Nuevo Usuario

        </h1>

        {{-- Mostrar errores de validación --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded-xl mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/admin/usuarios" method="POST">

            @csrf

            <div class="space-y-6">

                <div>

                    <label class="block mb-2 text-sm font-medium">
                        Nombre
                    </label>

                    <input type="text"
                           name="name"
                           class="w-full border border-gray-300 rounded-xl px-4 py-3">

                </div>


                <div>

                    <label class="block mb-2 text-sm font-medium">
                        Email
                    </label>

                    <input type="email"
                           name="email"
                           class="w-full border border-gray-300 rounded-xl px-4 py-3">

                </div>


                <div>

                    <label class="block mb-2 text-sm font-medium">
                        Apellido
                    </label>

                    <input type="text"
                           name="apellido"
                           class="w-full border border-gray-300 rounded-xl px-4 py-3">

                </div>


                <div>

                    <label class="block mb-2 text-sm font-medium">
                        Contraseña
                    </label>

                    <input type="password"
                           name="password"
                           class="w-full border border-gray-300 rounded-xl px-4 py-3">

                </div>
                <div>

                    <label class="block mb-2 text-sm font-medium">
                        Confirmar Contraseña
                    </label>

                    <input type="password"
                        name="password_confirmation"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3">
                        
                    <p class="text-sm text-gray-500 mt-2">
                        Mínimo 8 caracteres, una mayúscula y un número.
                    </p>

                </div>


                <div>

                    <label class="block mb-2 text-sm font-medium">
                        Rol
                    </label>

                    <select name="rol"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3">

                        <option value="usuario">
                            Usuario
                        </option>

                        <option value="admin">
                            Administrador
                        </option>

                    </select>

                </div>


                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl">

                    Guardar New User

                </button>

            </div>

        </form>

    </div>

</div>

@endsection