<div id="modalEditarUsuario"
     class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 overflow-y-auto p-6">

    <div class="bg-white w-full max-w-2xl rounded-2xl shadow-xl p-8 relative my-10 max-h-[95vh] overflow-y-auto">

        <!-- BOTON CERRAR -->
        <button onclick="cerrarModalEditar()"
                class="absolute top-4 right-4 text-gray-400 hover:text-red-500 hover:bg-red-50
                       w-8 h-8 flex items-center justify-center rounded-full transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
            
        </button>

        <!-- TITULO -->
        <div class="mb-7">
            <div class="flex items-center gap-3 mb-1">
                <div class="bg-yellow-100 p-2 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-slate-800">Editar Usuario</h2>
            </div>
            <p class="text-gray-400 text-sm ml-12">Modifica los datos del usuario seleccionado.</p>
        </div>

        <!-- SEPARADOR -->
        <div class="border-t border-gray-100 mb-7"></div>

        <!-- FORMULARIO -->
        <form id="formEditarUsuario" method="POST" class="space-y-5">

            @csrf
            @method('PUT')

            <!-- FILA: NOMBRE + APELLIDO -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-2">
                        Nombre
                    </label>
                    <input type="text"
                           id="edit_name"
                           name="name"
                           placeholder="Ingrese nombres"
                           required
                           class="w-full border border-gray-200 bg-slate-50 rounded-xl px-4 py-3 text-sm
                                  focus:ring-2 focus:ring-yellow-400 focus:border-transparent focus:bg-white
                                  transition duration-200 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-2">
                        Apellidos
                    </label>
                    <input type="text"
                           id="edit_apellido"
                           name="apellido"
                           placeholder="Ingrese apellidos"
                           required
                           class="w-full border border-gray-200 bg-slate-50 rounded-xl px-4 py-3 text-sm
                                  focus:ring-2 focus:ring-yellow-400 focus:border-transparent focus:bg-white
                                  transition duration-200 outline-none">
                </div>

            </div>

            <!-- EMAIL -->
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-2">
                    Correo Electrónico
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </div>
                    <input type="email"
                           id="edit_email"
                           name="email"
                           placeholder="correo@ejemplo.com"
                           required
                           class="w-full border border-gray-200 bg-slate-50 rounded-xl pl-11 pr-4 py-3 text-sm
                                  focus:ring-2 focus:ring-yellow-400 focus:border-transparent focus:bg-white
                                  transition duration-200 outline-none">
                </div>
            </div>

            <!-- ROL -->
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-2">
                    Rol
                </label>
                <select id="edit_rol"
                        name="rol"
                        required
                        class="w-full border border-gray-200 bg-slate-50 rounded-xl px-4 py-3 text-sm
                               focus:ring-2 focus:ring-yellow-400 focus:border-transparent focus:bg-white
                               transition duration-200 outline-none">
                    <option value="admin">Administrador</option>
                    <option value="usuario">Usuario</option>
                </select>
            </div>

            <!-- NUEVA CONTRASEÑA -->
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-2">
                    Nueva Contraseña
                    <span class="normal-case text-gray-400 font-normal ml-1">(opcional)</span>
                </label>
                <div class="relative">
                    <input type="password"
                           id="edit_password"
                           name="password"
                           placeholder="Dejar vacío para no cambiar"
                           class="w-full border border-gray-200 bg-slate-50 rounded-xl px-4 py-3 pr-11 text-sm
                                  focus:ring-2 focus:ring-yellow-400 focus:border-transparent focus:bg-white
                                  transition duration-200 outline-none">
                    <button type="button"
                            onclick="togglePasswordEditar()"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-slate-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- SEPARADOR -->
            <div class="border-t border-gray-100 pt-2"></div>

            <!-- BOTONES -->
            <div class="flex justify-end gap-3">

                <button type="button"
                        onclick="cerrarModalEditar()"
                        class="px-5 py-2.5 rounded-xl border border-gray-200 text-slate-600 text-sm font-medium
                               hover:bg-slate-50 transition duration-200">
                    Cancelar
                </button>

                <button type="submit"
                        class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600
                               text-white px-6 py-2.5 rounded-xl text-sm font-medium
                               transition duration-200 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    Actualizar Usuario
                </button>

            </div>

        </form>

    </div>

</div>

<script>
function togglePasswordEditar() {
    const input = document.getElementById('edit_password');
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>