@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-4xl font-bold text-slate-800">
                Usuarios
            </h1>

        </div>

        <!-- BOTON MODAL -->
        <button onclick="abrirModal()"
                class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700
                       text-white px-5 py-3 rounded-xl font-medium
                       transition duration-200 shadow-md hover:shadow-lg">

            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>

            <span>Nuevo Usuario</span>

        </button>

    </div>


    {{-- ALERTAS --}}
    @if (session('success'))
        <div class="mb-6 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 p-4 rounded-xl shadow-sm flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="font-medium text-sm">{{ session('success') }}</span>
        </div>
    @endif



    <!-- TABLA -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

        <table class="w-full">

            <thead class="bg-slate-100">

                <tr>

                    <th class="text-left px-6 py-4 text-slate-600 font-medium">
                        Nombre
                    </th>

                    <th class="text-left px-6 py-4 text-slate-600 font-medium">
                        Apellido
                    </th>

                    <th class="text-left px-6 py-4 text-slate-600 font-medium">
                        Email
                    </th>

                    <th class="text-left px-6 py-4 text-slate-600 font-medium">
                        Rol
                    </th>

                    <th class="text-left px-6 py-4 text-slate-600 font-medium">
                        Acciones
                    </th>

                </tr>

            </thead>

            <tbody>

                @foreach($usuarios as $usuario)

                <tr class="border-b border-gray-100 hover:bg-indigo-50 transition duration-150
                           {{ $loop->odd ? 'bg-white' : 'bg-slate-50' }}">

                    <td class="px-6 py-4 font-medium text-slate-700">
                        {{ $usuario->name }}
                    </td>

                    <td class="px-6 py-4 text-slate-600">
                        {{ $usuario->apellido }}
                    </td>

                    <td class="px-6 py-4 text-slate-600">
                        {{ $usuario->email }}
                    </td>

                    <td class="px-6 py-4">

                        @if($usuario->rol == 'admin')

                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-medium">
                                Admin
                            </span>

                        @else

                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">
                                Usuario
                            </span>

                        @endif

                    </td>

                    <td class="px-6 py-4">

                        <div class="flex gap-2 flex-wrap">

                            <!-- EDITAR -->
                            <button
                                onclick="abrirModalEditar(
                                    '{{ $usuario->id }}',
                                    '{{ $usuario->name }}',
                                    '{{ $usuario->apellido }}',
                                    '{{ $usuario->email }}',
                                    '{{ $usuario->rol }}'
                                )"
                                class="text-slate-600 hover:text-yellow-500 transition duration-200"
                                title="Editar Usuario">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>

                            </button>

                            <!-- HISTORIAL -->
                            <a href="/admin/usuarios/{{ $usuario->id }}/historial"
                               class="text-slate-600 hover:text-indigo-600 transition duration-200"
                               title="Ver Historial">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>

                            </a>

                            <!-- ELIMINAR -->
                            <form action="/admin/usuarios/{{ $usuario->id }}" method="POST" class="inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    onclick="return confirm('¿Estás seguro de eliminar este usuario?')"
                                    class="text-slate-600 hover:text-red-600 transition duration-200"
                                    title="Eliminar Usuario">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>


<!-- MODALES -->
@include('components.modals.crear-usuario')
@include('components.modals.editar-usuario')


<!-- SCRIPTS -->
<script>

function abrirModal() {
    document.getElementById('modalUsuario').classList.remove('hidden');
    document.getElementById('modalUsuario').classList.add('flex');
}

function cerrarModal() {
    document.getElementById('modalUsuario').classList.remove('flex');
    document.getElementById('modalUsuario').classList.add('hidden');
}

function abrirModalEditar(id, name, apellido, email, rol) {
    document.getElementById('modalEditarUsuario').classList.remove('hidden');
    document.getElementById('modalEditarUsuario').classList.add('flex');

    document.getElementById('edit_name').value = name;
    document.getElementById('edit_apellido').value = apellido;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_rol').value = rol;

    document.getElementById('formEditarUsuario').action = '/admin/usuarios/' + id;
}

function cerrarModalEditar() {
    document.getElementById('modalEditarUsuario').classList.remove('flex');
    document.getElementById('modalEditarUsuario').classList.add('hidden');
}

@if($errors->any() && !old('id'))
document.addEventListener('DOMContentLoaded', function() {
    abrirModal();
});
@endif

@if(session('success') && session('success_type') === 'create')
document.addEventListener('DOMContentLoaded', function() {
    abrirModal();
    setTimeout(function() {
        cerrarModal();
    }, 2500);
});
@endif

@if($errors->any() && old('id'))
document.addEventListener('DOMContentLoaded', function() {
    abrirModalEditar(
        "{{ old('id') }}",
        "{{ old('name') }}",
        "{{ old('apellido') }}",
        "{{ old('email') }}",
        "{{ old('rol') }}"
    );
});
@endif

@if(session('success') && session('success_type') === 'edit')
document.addEventListener('DOMContentLoaded', function() {
    abrirModalEditar(
        "{{ session('success_id') }}",
        "{{ session('success_name') }}",
        "{{ session('success_apellido') }}",
        "{{ session('success_email') }}",
        "{{ session('success_rol') }}"
    );
    setTimeout(function() {
        cerrarModalEditar();
    }, 2500);
});
@endif

</script>

@endsection