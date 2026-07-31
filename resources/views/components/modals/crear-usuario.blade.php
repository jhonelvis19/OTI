<div id="modalUsuario"
     class="fixed inset-0 bg-slate-900/40 backdrop-blur-md hidden items-center justify-center z-50 overflow-y-auto p-4 sm:p-6">

    <div class="bg-white w-full max-w-2xl rounded-3xl shadow-2xl p-6 sm:p-8 relative my-8 max-h-[90vh] overflow-y-auto border border-slate-100">

        <!-- BOTON CERRAR -->
        <button onclick="cerrarModal()"
                class="absolute top-5 right-5 text-slate-400 hover:text-rose-500 hover:bg-rose-50
                       w-9 h-9 flex items-center justify-center rounded-full transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- TITULO -->
        <div class="mb-6">
            <div class="flex items-center gap-3 mb-1">
                <div class="bg-violet-100 p-2.5 rounded-2xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl sm:text-2xl font-extrabold text-slate-800 tracking-tight">Crear Nuevo Usuario</h2>
                    <p class="text-xs text-slate-400">Registra un nuevo usuario o técnico en el sistema.</p>
                </div>
            </div>
        </div>

        <div class="border-t border-slate-100 mb-6"></div>

        <!-- FORMULARIO -->
        <form action="/admin/usuarios" method="POST" class="space-y-5">
            @csrf

            @if (session('success') && session('success_type') === 'create')
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-2xl shadow-sm mb-5 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-semibold text-xs sm:text-sm">{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any() && !old('id'))
                <div class="bg-rose-50 border border-rose-200 text-rose-800 p-4 rounded-2xl shadow-sm mb-5">
                    <div class="flex items-center gap-3 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-rose-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span class="font-bold text-xs sm:text-sm">Por favor corrige los siguientes errores:</span>
                    </div>
                    <ul class="list-disc list-inside text-xs space-y-1 ml-6 text-rose-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">
                        Nombre
                    </label>
                    <input type="text"
                           name="name"
                           value="{{ old('name') }}"
                           placeholder="Ingrese nombres"
                           required
                           class="w-full border border-slate-200 bg-slate-50/70 rounded-xl px-4 py-3 text-xs sm:text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 focus:bg-white transition duration-200 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">
                        Apellidos
                    </label>
                    <input type="text"
                           name="apellido"
                           value="{{ old('apellido') }}"
                           placeholder="Ingrese apellidos"
                           required
                           class="w-full border border-slate-200 bg-slate-50/70 rounded-xl px-4 py-3 text-xs sm:text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 focus:bg-white transition duration-200 outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">
                    Correo Electrónico
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </div>
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="correo@ejemplo.com"
                           required
                           class="w-full border border-slate-200 bg-slate-50/70 rounded-xl pl-10 pr-4 py-3 text-xs sm:text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 focus:bg-white transition duration-200 outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">
                    Rol
                </label>
                <select name="rol"
                        required
                        class="w-full border border-slate-200 bg-slate-50/70 rounded-xl px-4 py-3 text-xs sm:text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 focus:bg-white transition duration-200 outline-none">
                    <option value="">Seleccione un rol</option>
                    <option value="admin" {{ old('rol') === 'admin' ? 'selected' : '' }}>Administrador</option>
                    <option value="usuario" {{ old('rol') === 'usuario' ? 'selected' : '' }}>Usuario / Técnico</option>
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">
                        Contraseña
                    </label>
                    <div class="relative">
                        <input type="password"
                               id="password"
                               name="password"
                               placeholder="Mín. 8 caracteres"
                               required
                               class="w-full border border-slate-200 bg-slate-50/70 rounded-xl px-4 py-3 pr-10 text-xs sm:text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 focus:bg-white transition duration-200 outline-none">
                        <button type="button"
                                onclick="togglePassword()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">
                        Confirmar Contraseña
                    </label>
                    <div class="relative">
                        <input type="password"
                               id="password_confirmation"
                               name="password_confirmation"
                               placeholder="Repita la contraseña"
                               required
                               class="w-full border border-slate-200 bg-slate-50/70 rounded-xl px-4 py-3 pr-10 text-xs sm:text-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 focus:bg-white transition duration-200 outline-none">
                        <button type="button"
                                onclick="togglePasswordConfirm()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <p class="text-[11px] text-slate-400 mt-1">
                La contraseña debe contener al menos 8 caracteres, mayúsculas, minúsculas y números.
            </p>

            <div class="border-t border-slate-100 pt-4 flex justify-end gap-3">
                <button type="button"
                        onclick="cerrarModal()"
                        class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 text-xs font-semibold hover:bg-slate-50 transition duration-200">
                    Cancelar
                </button>

                <button type="submit"
                        class="inline-flex items-center gap-2 bg-gradient-to-r from-violet-600 to-indigo-600 hover:from-violet-700 hover:to-indigo-700 text-white text-xs font-bold px-6 py-2.5 rounded-xl shadow-md shadow-violet-500/20 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    Crear Usuario
                </button>
            </div>

        </form>

    </div>

</div>

<script>
function togglePassword() {
    const input = document.getElementById('password');
    input.type = input.type === 'password' ? 'text' : 'password';
}
function togglePasswordConfirm() {
    const input = document.getElementById('password_confirmation');
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>