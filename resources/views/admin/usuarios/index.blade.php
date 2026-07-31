@extends('layouts.app')

@section('content')

<div class="space-y-6">

    <!-- HEADER DE USUARIOS -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Gestión de Usuarios</h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">Administre los accesos del personal técnico y administradores.</p>
        </div>

        <button onclick="abrirModal()"
                class="inline-flex items-center gap-2 bg-gradient-to-r from-violet-600 to-indigo-600 hover:from-violet-700 hover:to-indigo-700 text-white text-xs font-bold px-5 py-3 rounded-2xl shadow-lg shadow-violet-500/25 transition-all hover:scale-[1.02] active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            <span>Nuevo Usuario</span>
        </button>
    </div>

    <!-- TABLA DE USUARIOS -->
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100/80 space-y-4">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-slate-50/80 text-slate-400 font-bold uppercase tracking-wider border-b border-slate-100">
                        <th class="py-3.5 px-4 rounded-l-2xl">Usuario</th>
                        <th class="py-3.5 px-4">Apellido</th>
                        <th class="py-3.5 px-4">Correo Electrónico</th>
                        <th class="py-3.5 px-4">Rol en el Sistema</th>
                        <th class="py-3.5 px-4 text-right rounded-r-2xl">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100/80 font-medium text-slate-700">
                    @foreach($usuarios as $usuario)
                    <tr class="hover:bg-violet-50/40 transition-colors duration-150">
                        <td class="py-3.5 px-4">
                            <div class="flex items-center gap-3">
                                <div class="h-9 w-9 rounded-full bg-gradient-to-tr from-violet-600 to-indigo-500 text-white font-bold flex items-center justify-center shadow-sm text-xs">
                                    {{ strtoupper(substr($usuario->name, 0, 1)) }}
                                </div>
                                <span class="font-bold text-slate-800">{{ $usuario->name }}</span>
                            </div>
                        </td>
                        <td class="py-3.5 px-4 font-semibold text-slate-700">
                            {{ $usuario->apellido }}
                        </td>
                        <td class="py-3.5 px-4 text-slate-500">
                            {{ $usuario->email }}
                        </td>
                        <td class="py-3.5 px-4">
                            @if($usuario->rol == 'admin')
                                <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-purple-100 text-purple-700 border border-purple-200/60">
                                    Administrador
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-sky-100 text-sky-700 border border-sky-200/60">
                                    Usuario / Técnico
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <!-- EDITAR -->
                                <button
                                    onclick="abrirModalEditar(
                                        '{{ $usuario->id }}',
                                        '{{ $usuario->name }}',
                                        '{{ $usuario->apellido }}',
                                        '{{ $usuario->email }}',
                                        '{{ $usuario->rol }}'
                                    )"
                                    class="p-2 bg-slate-100 hover:bg-amber-100 text-slate-600 hover:text-amber-600 rounded-xl transition duration-150"
                                    title="Editar Usuario">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </button>

                                <!-- HISTORIAL -->
                                <a href="/admin/usuarios/{{ $usuario->id }}/historial"
                                   class="p-2 bg-slate-100 hover:bg-violet-100 text-slate-600 hover:text-violet-700 rounded-xl transition duration-150"
                                   title="Ver Historial">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </a>

                                <!-- ELIMINAR CON MODAL CORTITO -->
                                <button
                                    type="button"
                                    onclick="abrirModalEliminar('{{ $usuario->id }}', '{{ $usuario->name }} {{ $usuario->apellido }}')"
                                    class="p-2 bg-slate-100 hover:bg-rose-100 text-slate-600 hover:text-rose-600 rounded-xl transition duration-150"
                                    title="Eliminar Usuario">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- MODAL CORTITO DE CONFIRMACIÓN DE ELIMINACIÓN DE USUARIO -->
<div id="modalConfirmarEliminar" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm transition-opacity duration-200">
    <div class="w-full max-w-sm bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-2xl border border-slate-100 dark:border-slate-800 text-center space-y-4 animate-in fade-in zoom-in duration-150">
        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-rose-100 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
        </div>
        <div class="space-y-1">
            <h3 class="text-base font-extrabold text-slate-800 dark:text-white">¿Eliminar Usuario?</h3>
            <p id="eliminarUsuarioNombre" class="text-xs text-slate-500 dark:text-slate-400">Esta acción no se puede deshacer.</p>
        </div>
        <form id="formConfirmarEliminar" method="POST" action="">
            @csrf
            @method('DELETE')
            <div class="flex items-center gap-3 pt-2">
                <button type="button" onclick="cerrarModalEliminar()" class="flex-1 py-2.5 px-4 rounded-xl border border-slate-200 text-slate-600 dark:text-slate-300 text-xs font-bold hover:bg-slate-50 transition">
                    Cancelar
                </button>
                <button type="submit" class="flex-1 py-2.5 px-4 rounded-xl bg-gradient-to-r from-rose-600 to-red-600 hover:from-rose-700 hover:to-red-700 text-white text-xs font-bold shadow-md shadow-rose-600/20 transition hover:scale-[1.02] active:scale-95">
                    Sí, eliminar
                </button>
            </div>
        </form>
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

function abrirModalEliminar(id, nombre) {
    const modal = document.getElementById('modalConfirmarEliminar');
    const form = document.getElementById('formConfirmarEliminar');
    const txtNombre = document.getElementById('eliminarUsuarioNombre');
    if (form) form.action = '/admin/usuarios/' + id;
    if (txtNombre) txtNombre.textContent = `¿Desea eliminar a ${nombre}? Esta acción no se puede deshacer.`;
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
}

function cerrarModalEliminar() {
    const modal = document.getElementById('modalConfirmarEliminar');
    if (modal) {
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }
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