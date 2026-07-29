@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">

    <!-- Header -->
    <div class="flex items-center justify-between mb-8 pb-4 border-b border-indigo-100">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Configuración</h1>
            <p class="text-sm text-gray-500 mt-1">Gestione su perfil de administrador y su firma digital.</p>
        </div>
        <div class="h-12 w-12 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600 shadow-sm border border-indigo-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </div>
    </div>

    <!-- Mensajes de alerta -->
    <div id="alert-container" class="hidden mb-6"></div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        <!-- Columna Info Admin -->
        <div class="md:col-span-1 space-y-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                <h2 class="text-sm font-semibold text-slate-500 uppercase tracking-wide mb-4">Información Personal</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase">Nombre Completo</label>
                        <p class="text-sm font-semibold text-slate-800 mt-0.5">
                            {{ auth()->user()->name }} {{ auth()->user()->apellido }}
                        </p>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase">Correo Electrónico</label>
                        <p class="text-sm font-semibold text-slate-800 mt-0.5">{{ auth()->user()->email }}</p>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase">Rol en el Sistema</label>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 mt-1">
                            {{ ucfirst(auth()->user()->rol) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Info sobre la firma -->
            <div class="bg-indigo-50 border border-indigo-200 rounded-2xl p-5">
                <div class="flex items-start gap-3">
                    <div class="text-indigo-500 mt-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-indigo-800 mb-1">¿Para qué sirve la firma?</p>
                        <p class="text-xs text-indigo-700 leading-relaxed">
                            Su firma permanente se usará al crear informes técnicos. Al elegir <strong>"Usar mi firma guardada"</strong>, esta firma se estampará automáticamente en el acta.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Columna Firma Digital -->
        <div class="md:col-span-2 space-y-6">

            <!-- PANEL ESTADO FIRMA -->
            <div id="panel-firma-estado" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-sm font-semibold text-slate-500 uppercase tracking-wide">Firma Permanente</h2>
                    <span id="firma-badge" class="{{ auth()->user()->firma ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }} text-xs px-2.5 py-1 rounded-full font-semibold">
                        {{ auth()->user()->firma ? 'Registrada' : 'No registrada' }}
                    </span>
                </div>

                @if(auth()->user()->firma)
                    <div id="firma-actual-view" class="space-y-4">
                        <div class="border border-indigo-100 rounded-2xl p-4 bg-slate-50 flex justify-center items-center h-48 shadow-inner">
                            <img id="img-firma-actual" src="{{ asset('storage/' . auth()->user()->firma) }}" alt="Su Firma" class="max-h-full object-contain">
                        </div>
                        <div class="flex justify-between items-center text-xs text-gray-400">
                            <span>Registrado el: {{ auth()->user()->firma_actualizada_en ? auth()->user()->firma_actualizada_en->format('d/m/Y h:i A') : '—' }}</span>
                            <div class="flex gap-2">
                                <button type="button" id="btn-eliminar-firma-trigger" class="text-red-500 hover:text-red-700 font-semibold transition duration-150">
                                    Eliminar firma
                                </button>
                                <span>|</span>
                                <button type="button" id="btn-reemplazar-firma-trigger" class="text-indigo-600 hover:text-indigo-800 font-semibold transition duration-150">
                                    Reemplazar firma
                                </button>
                            </div>
                        </div>
                    </div>
                @else
                    <div id="firma-vacia-view" class="text-center py-8 space-y-4">
                        <div class="mx-auto h-16 w-16 bg-slate-100 rounded-full flex items-center justify-center text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-700">No ha registrado su firma</p>
                            <p class="text-xs text-gray-400 mt-1">Registre su firma permanente para poder utilizarla al firmar los informes técnicos.</p>
                        </div>
                        <button type="button" id="btn-registrar-firma-trigger"
                            class="inline-flex items-center gap-1 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold px-4 py-2 rounded-xl shadow-sm transition duration-200">
                            ✍ Registrar Firma
                        </button>
                    </div>
                @endif
            </div>

            <!-- PANEL FORMULARIO FIRMA -->
            <div id="panel-firma-formulario" class="hidden bg-white p-6 rounded-2xl shadow-sm border border-gray-200 space-y-6">
                <div class="flex justify-between items-center border-b border-indigo-50 pb-3">
                    <h2 id="formulario-title" class="text-sm font-semibold text-slate-500 uppercase tracking-wide">Registrar Nueva Firma</h2>
                    <button type="button" id="btn-cancelar-formulario" class="text-xs text-gray-400 hover:text-slate-600 transition duration-150">Cancelar</button>
                </div>

                <form id="form-firma-perfil" class="space-y-6">
                    @csrf
                    <input type="hidden" name="metodo_firma" id="metodo_firma" value="dibujada">
                    <input type="hidden" name="firma_base64" id="firma_base64">

                    <div class="flex gap-4">
                        <button type="button" id="btn-metodo-dibujar"
                            class="flex-1 py-3 px-4 rounded-xl border border-indigo-300 bg-indigo-600 text-white font-semibold transition duration-200 text-xs">
                            ✍ Dibujar en Pantalla
                        </button>
                        <button type="button" id="btn-metodo-foto"
                            class="flex-1 py-3 px-4 rounded-xl border border-indigo-300 bg-slate-100 text-slate-700 font-semibold hover:bg-slate-200 transition duration-200 text-xs">
                            📷 Tomar Fotografía
                        </button>
                    </div>

                    <div id="contenedor-canvas">
                        <div class="border border-indigo-200 rounded-2xl bg-white p-2 relative h-64 shadow-inner">
                            <canvas id="canvas-firma-perfil" class="w-full h-full cursor-crosshair block rounded-xl bg-slate-50"></canvas>
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Use su dedo, mouse o lápiz digital en la zona de firma.</p>
                    </div>

                    <div id="contenedor-foto" class="hidden">
                        <label class="flex flex-col items-center justify-center border-2 border-dashed border-indigo-300 rounded-2xl bg-white p-6 cursor-pointer hover:bg-indigo-50 transition duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-sm font-medium text-slate-700">Tomar Foto de la Firma</span>
                            <input type="file" id="input-foto" accept="image/jpeg,image/png,image/webp" capture="environment" class="hidden">
                        </label>
                    </div>

                    <div id="preview-container" class="hidden border border-gray-200 rounded-2xl bg-white p-4">
                        <h4 class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-2">Vista Previa:</h4>
                        <div class="flex justify-center bg-slate-50 p-2 rounded-xl">
                            <img id="preview-firma" src="#" alt="Vista previa de firma" class="max-h-32 object-contain">
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="button" id="btn-limpiar" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 transition duration-150">
                            Limpiar / Repetir firma
                        </button>
                    </div>

                    <div class="border-t border-indigo-50 pt-4 space-y-3">
                        <label class="block text-xs font-bold text-slate-700 uppercase">
                            Para guardar, ingrese su contraseña actual:
                        </label>
                        <input type="password" name="password_confirmacion" id="password_confirmacion" required
                            placeholder="••••••••"
                            class="w-full rounded-xl border border-indigo-300 bg-slate-50 px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-400 focus:border-transparent focus:bg-white outline-none transition duration-200">
                    </div>

                    <button type="submit" id="btn-guardar-firma"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-4 rounded-xl shadow-md hover:shadow-lg transition duration-200 text-sm">
                        Confirmar y Registrar Firma
                    </button>
                </form>
            </div>

            <!-- PANEL ELIMINAR FIRMA -->
            <div id="panel-firma-eliminar" class="hidden bg-white p-6 rounded-2xl shadow-sm border border-red-200 space-y-6">
                <div class="flex justify-between items-center border-b border-red-50 pb-3">
                    <h2 class="text-sm font-semibold text-red-500 uppercase tracking-wide">Eliminar Firma del Perfil</h2>
                    <button type="button" id="btn-cancelar-eliminar" class="text-xs text-gray-400 hover:text-slate-600 transition duration-150">Cancelar</button>
                </div>

                <form id="form-eliminar-firma" class="space-y-6">
                    @csrf
                    @method('DELETE')
                    <p class="text-xs text-slate-600">Al eliminar la firma, ya no podrá usar la opción "Usar mi firma guardada" en los informes técnicos nuevos. Los informes anteriores mantendrán la firma histórica.</p>
                    <div class="space-y-3">
                        <label class="block text-xs font-bold text-slate-700 uppercase">Ingrese su contraseña actual para confirmar:</label>
                        <input type="password" name="password_confirmacion" id="password_eliminar" required
                            placeholder="••••••••"
                            class="w-full rounded-xl border border-red-300 bg-slate-50 px-4 py-3 text-sm focus:ring-2 focus:ring-red-400 focus:border-transparent focus:bg-white outline-none transition duration-200">
                    </div>
                    <button type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-4 rounded-xl shadow-md hover:shadow-lg transition duration-200 text-sm">
                        Confirmar y Eliminar Firma
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

<script src="{{ asset('js/signature_pad.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const alertContainer = document.getElementById('alert-container');

    const panelEstado     = document.getElementById('panel-firma-estado');
    const panelFormulario = document.getElementById('panel-firma-formulario');
    const panelEliminar   = document.getElementById('panel-firma-eliminar');

    const btnRegistrarTrigger  = document.getElementById('btn-registrar-firma-trigger');
    const btnReemplazarTrigger = document.getElementById('btn-reemplazar-firma-trigger');
    const btnEliminarTrigger   = document.getElementById('btn-eliminar-firma-trigger');

    const btnCancelarFormulario = document.getElementById('btn-cancelar-formulario');
    const btnCancelarEliminar   = document.getElementById('btn-cancelar-eliminar');

    const formFirma   = document.getElementById('form-firma-perfil');
    const formEliminar = document.getElementById('form-eliminar-firma');

    const btnMetodoDibujar = document.getElementById('btn-metodo-dibujar');
    const btnMetodoFoto    = document.getElementById('btn-metodo-foto');
    const contenedorCanvas = document.getElementById('contenedor-canvas');
    const contenedorFoto   = document.getElementById('contenedor-foto');
    const canvas           = document.getElementById('canvas-firma-perfil');
    const inputFoto        = document.getElementById('input-foto');
    const previewContainer = document.getElementById('preview-container');
    const previewFirma     = document.getElementById('preview-firma');
    const btnLimpiar       = document.getElementById('btn-limpiar');

    const inputMetodo   = document.getElementById('metodo_firma');
    const inputBase64   = document.getElementById('firma_base64');
    const inputPassword = document.getElementById('password_confirmacion');
    const inputPasswordEliminar = document.getElementById('password_eliminar');
    const txtFormTitle  = document.getElementById('formulario-title');

    let signaturePad = null;

    function showAlert(message, type) {
        alertContainer.className = `p-4 rounded-xl text-sm font-semibold mb-6 ${
            type === 'success'
                ? 'bg-emerald-50 text-emerald-800 border border-emerald-200'
                : 'bg-red-50 text-red-800 border border-red-200'
        }`;
        alertContainer.innerText = message;
        alertContainer.classList.remove('hidden');
        alertContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    function hideAlert() {
        alertContainer.classList.add('hidden');
    }

    function resizeCanvas(canvasEl) {
        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvasEl.width  = canvasEl.offsetWidth  * ratio;
        canvasEl.height = canvasEl.offsetHeight * ratio;
        canvasEl.getContext('2d').scale(ratio, ratio);
    }

    function initSignaturePad() {
        resizeCanvas(canvas);
        signaturePad = new SignaturePad(canvas, {
            backgroundColor: 'rgba(255, 255, 255, 0)',
            penColor: 'rgb(0, 0, 0)'
        });
    }

    // Toggle panels
    if (btnRegistrarTrigger) {
        btnRegistrarTrigger.addEventListener('click', function () {
            hideAlert();
            txtFormTitle.innerText = 'Registrar Nueva Firma';
            panelEstado.classList.add('hidden');
            panelFormulario.classList.remove('hidden');
            btnMetodoDibujar.click();
        });
    }

    if (btnReemplazarTrigger) {
        btnReemplazarTrigger.addEventListener('click', function () {
            hideAlert();
            txtFormTitle.innerText = 'Reemplazar Firma Actual';
            panelEstado.classList.add('hidden');
            panelFormulario.classList.remove('hidden');
            btnMetodoDibujar.click();
        });
    }

    if (btnEliminarTrigger) {
        btnEliminarTrigger.addEventListener('click', function () {
            hideAlert();
            panelEstado.classList.add('hidden');
            panelEliminar.classList.remove('hidden');
            inputPasswordEliminar.value = '';
            inputPasswordEliminar.focus();
        });
    }

    btnCancelarFormulario.addEventListener('click', function () {
        panelFormulario.classList.add('hidden');
        window.location.reload();
    });

    btnCancelarEliminar.addEventListener('click', function () {
        panelEliminar.classList.add('hidden');
        panelEstado.classList.remove('hidden');
    });

    // Métodos de firma
    btnMetodoDibujar.addEventListener('click', function () {
        btnMetodoDibujar.classList.add('bg-indigo-600', 'text-white');
        btnMetodoDibujar.classList.remove('bg-slate-100', 'text-slate-700');
        btnMetodoFoto.classList.remove('bg-indigo-600', 'text-white');
        btnMetodoFoto.classList.add('bg-slate-100', 'text-slate-700');
        contenedorCanvas.classList.remove('hidden');
        contenedorFoto.classList.add('hidden');
        previewContainer.classList.add('hidden');
        inputMetodo.value = 'dibujada';
        inputBase64.value = '';
        setTimeout(initSignaturePad, 50);
    });

    btnMetodoFoto.addEventListener('click', function () {
        btnMetodoFoto.classList.add('bg-indigo-600', 'text-white');
        btnMetodoFoto.classList.remove('bg-slate-100', 'text-slate-700');
        btnMetodoDibujar.classList.remove('bg-indigo-600', 'text-white');
        btnMetodoDibujar.classList.add('bg-slate-100', 'text-slate-700');
        contenedorCanvas.classList.add('hidden');
        contenedorFoto.classList.remove('hidden');
        previewContainer.classList.add('hidden');
        inputMetodo.value = 'foto';
        inputBase64.value = '';
    });

    inputFoto.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (event) {
                previewFirma.src = event.target.result;
                previewContainer.classList.remove('hidden');
                inputBase64.value = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    btnLimpiar.addEventListener('click', function () {
        if (inputMetodo.value === 'dibujada' && signaturePad) {
            signaturePad.clear();
        } else if (inputMetodo.value === 'foto') {
            inputFoto.value = '';
            previewFirma.src = '#';
            previewContainer.classList.add('hidden');
            inputBase64.value = '';
        }
    });

    // Guardar firma (AJAX)
    formFirma.addEventListener('submit', function (e) {
        e.preventDefault();
        hideAlert();

        const metodo = inputMetodo.value;
        if (metodo === 'dibujada') {
            if (!signaturePad || signaturePad.isEmpty()) {
                showAlert('Por favor, dibuje su firma antes de enviar.', 'error');
                return;
            }
            inputBase64.value = signaturePad.toDataURL('image/png');
        } else if (metodo === 'foto') {
            if (!inputBase64.value) {
                showAlert('Por favor, capture una fotografía de su firma antes de enviar.', 'error');
                return;
            }
        }

        if (!inputPassword.value) {
            showAlert('Debe ingresar su contraseña actual para guardar la firma.', 'error');
            return;
        }

        const formData = new FormData(formFirma);
        formData.set('firma_base64', inputBase64.value);

        fetch('/admin/configuracion/firma', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(r => r.json().then(data => ({ status: r.status, body: data })))
        .then(res => {
            if (res.status === 200 && res.body.success) {
                showAlert(res.body.message, 'success');
                setTimeout(() => window.location.reload(), 1500);
            } else {
                showAlert(res.body.message || 'Ocurrió un error al guardar la firma.', 'error');
            }
        })
        .catch(() => showAlert('Ocurrió un error de red o de servidor.', 'error'));
    });

    // Eliminar firma (AJAX)
    formEliminar.addEventListener('submit', function (e) {
        e.preventDefault();
        hideAlert();

        if (!inputPasswordEliminar.value) {
            showAlert('Debe ingresar su contraseña actual para confirmar la eliminación.', 'error');
            return;
        }

        const formData = new FormData(formEliminar);

        fetch('/admin/configuracion/firma', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(r => r.json().then(data => ({ status: r.status, body: data })))
        .then(res => {
            if (res.status === 200 && res.body.success) {
                showAlert(res.body.message, 'success');
                setTimeout(() => window.location.reload(), 1500);
            } else {
                showAlert(res.body.message || 'La contraseña ingresada es incorrecta.', 'error');
            }
        })
        .catch(() => showAlert('Ocurrió un error al procesar la solicitud.', 'error'));
    });
});
</script>
@endsection