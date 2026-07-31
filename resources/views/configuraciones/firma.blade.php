@extends('configuraciones.index')

@section('config_content')

<div class="space-y-6">

    <!-- PANEL ESTADO FIRMA -->
    <div id="panel-firma-estado" class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-100/80 space-y-6">
        <div class="flex justify-between items-center border-b border-slate-100 pb-4">
            <div>
                <h2 class="text-lg font-bold text-slate-800">Firma Digital Permanente</h2>
                <p class="text-xs text-slate-400 mt-0.5">Su firma digital se aplicará automáticamente al generar informes técnicos.</p>
            </div>
            <span id="firma-badge" class="{{ auth()->user()->firma ? 'bg-emerald-100 text-emerald-800 border-emerald-200' : 'bg-amber-100 text-amber-800 border-amber-200' }} text-xs px-3.5 py-1 rounded-full font-bold border">
                {{ auth()->user()->firma ? 'Registrada' : 'No registrada' }}
            </span>
        </div>

        @if(auth()->user()->firma)
            <div id="firma-actual-view" class="space-y-4">
                <div class="border-2 border-dashed border-violet-200 dark:border-slate-700 rounded-3xl p-6 bg-slate-50/50 dark:bg-slate-800/40 flex justify-center items-center h-52 shadow-inner relative">
                    <img id="img-firma-actual" src="{{ asset('storage/' . auth()->user()->firma) }}?v={{ time() }}" alt="Su Firma" class="max-h-full object-contain">
                </div>
                <div class="flex flex-col sm:flex-row justify-between items-center text-xs text-slate-400 gap-2">
                    <span>Registrado el: {{ auth()->user()->firma_actualizada_en ? auth()->user()->firma_actualizada_en->format('d/m/Y h:i A') : '—' }}</span>
                    <div class="flex gap-4">
                        <button type="button" id="btn-eliminar-firma-trigger" class="text-rose-500 hover:text-rose-700 font-bold transition">
                            Eliminar firma
                        </button>
                        <span class="text-slate-300">|</span>
                        <button type="button" id="btn-reemplazar-firma-trigger" class="text-violet-600 hover:text-violet-800 font-bold transition">
                            Reemplazar firma
                        </button>
                    </div>
                </div>
            </div>
        @else
            <div id="firma-vacia-view" class="text-center py-10 space-y-4">
                <div class="mx-auto h-16 w-16 bg-violet-50 rounded-2xl flex items-center justify-center text-violet-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-700">No ha registrado su firma digital</p>
                    <p class="text-xs text-slate-400 mt-1 max-w-md mx-auto">Registre su firma permanente para asociarla directamente a sus actas de mantenimiento.</p>
                </div>
                <button type="button" id="btn-registrar-firma-trigger"
                    class="inline-flex items-center gap-2 bg-gradient-to-r from-violet-600 to-indigo-600 hover:from-violet-700 hover:to-indigo-700 text-white text-xs font-bold px-6 py-3 rounded-2xl shadow-lg shadow-violet-500/25 transition-all hover:scale-[1.02] active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    Registrar Firma Digital
                </button>
            </div>
        @endif
    </div>

    <!-- PANEL FORMULARIO FIRMA -->
    <div id="panel-firma-formulario" class="hidden bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-100/80 space-y-6">
        <div class="flex justify-between items-center border-b border-slate-100 pb-3">
            <h2 id="formulario-title" class="text-xs font-bold text-slate-500 uppercase tracking-wide">Registrar Nueva Firma</h2>
            <button type="button" id="btn-cancelar-formulario" class="text-xs font-bold text-slate-400 hover:text-slate-600 transition">Cancelar</button>
        </div>

        <form id="form-firma-perfil" class="space-y-6">
            @csrf
            <input type="hidden" name="metodo_firma" id="metodo_firma" value="dibujada">
            <input type="hidden" name="firma_base64" id="firma_base64">

            <div class="flex gap-4">
                <button type="button" id="btn-metodo-dibujar"
                    class="flex-1 py-3 px-4 rounded-2xl border border-violet-200 bg-violet-600 text-white font-bold transition text-xs inline-flex items-center justify-center gap-2 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    Dibujar en Pantalla
                </button>
                <button type="button" id="btn-metodo-foto"
                    class="flex-1 py-3 px-4 rounded-2xl border border-slate-200 bg-slate-50 text-slate-700 font-bold hover:bg-slate-100 transition text-xs inline-flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Tomar Fotografía
                </button>
            </div>

            <!-- PANEL CANVAS RESALTADO DE ALTA VISIBILIDAD -->
            <div id="contenedor-canvas">
                <div class="border-2 border-violet-400 dark:border-violet-500 rounded-3xl bg-white p-3 relative h-64 shadow-lg ring-4 ring-violet-500/10">
                    <canvas id="canvas-firma-perfil" class="w-full h-full cursor-crosshair block rounded-2xl bg-white"></canvas>
                    <div class="absolute bottom-3 left-4 pointer-events-none text-[11px] font-semibold text-slate-400 flex items-center gap-1.5 opacity-60">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-violet-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        Firme dentro del recuadro
                    </div>
                </div>
                <p class="text-xs text-slate-400 mt-1.5">Use su dedo, mouse o lápiz digital en la zona blanca de firma.</p>
            </div>

            <div id="contenedor-foto" class="hidden">
                <label class="flex flex-col items-center justify-center border-2 border-dashed border-violet-300 rounded-3xl bg-slate-50 p-8 cursor-pointer hover:bg-violet-50/50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-violet-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="text-xs font-bold text-slate-700">Tomar Foto de la Firma</span>
                    <input type="file" id="input-foto" accept="image/jpeg,image/png,image/webp" capture="environment" class="hidden">
                </label>
            </div>

            <div id="preview-container" class="hidden border border-slate-200 rounded-2xl bg-white p-4">
                <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Vista Previa:</h4>
                <div class="flex justify-center bg-slate-50 p-2 rounded-xl">
                    <img id="preview-firma" src="#" alt="Vista previa de firma" class="max-h-32 object-contain">
                </div>
            </div>

            <div class="flex justify-end">
                <button type="button" id="btn-limpiar" class="text-xs font-bold text-violet-600 hover:text-violet-800 transition">
                    Limpiar / Repetir firma
                </button>
            </div>

            <div class="p-4 bg-amber-50/80 border border-amber-200 rounded-2xl space-y-2">
                <label class="block text-xs font-bold text-amber-900 uppercase">
                    Ingrese su contraseña actual para confirmar:
                </label>
                <input type="password" name="password_confirmacion" id="password_confirmacion" required
                    placeholder="••••••••"
                    class="w-full rounded-xl border border-amber-300 bg-white px-4 py-2.5 text-xs sm:text-sm focus:ring-2 focus:ring-amber-500/20 outline-none transition">
            </div>

            <button type="submit" id="btn-guardar-firma"
                class="w-full bg-gradient-to-r from-violet-600 to-indigo-600 hover:from-violet-700 hover:to-indigo-700 text-white font-bold py-3.5 px-4 rounded-2xl shadow-lg shadow-violet-500/25 transition-all hover:scale-[1.01] active:scale-95 text-xs">
                Confirmar y Registrar Firma
            </button>
        </form>
    </div>

    <!-- PANEL ELIMINAR FIRMA -->
    <div id="panel-firma-eliminar" class="hidden bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-rose-200 space-y-6">
        <div class="flex justify-between items-center border-b border-rose-100 pb-3">
            <h2 class="text-xs font-bold text-rose-600 uppercase tracking-wide">Eliminar Firma del Perfil</h2>
            <button type="button" id="btn-cancelar-eliminar" class="text-xs font-bold text-slate-400 hover:text-slate-600 transition">Cancelar</button>
        </div>

        <form id="form-eliminar-firma" class="space-y-6">
            @csrf
            @method('DELETE')
            <p class="text-xs text-slate-600">Al eliminar la firma, ya no podrá usar la opción "Usar mi firma guardada" en los informes técnicos nuevos. Los informes anteriores mantendrán su firma guardada en PDF.</p>
            <div class="p-4 bg-rose-50/80 border border-rose-200 rounded-2xl space-y-2">
                <label class="block text-xs font-bold text-rose-900 uppercase">Ingrese su contraseña actual para confirmar:</label>
                <input type="password" name="password_confirmacion" id="password_eliminar" required
                    placeholder="••••••••"
                    class="w-full rounded-xl border border-rose-300 bg-white px-4 py-2.5 text-xs sm:text-sm focus:ring-2 focus:ring-rose-500/20 outline-none transition">
            </div>
            <button type="submit"
                class="w-full bg-gradient-to-r from-rose-600 to-red-600 hover:from-rose-700 hover:to-red-700 text-white font-bold py-3.5 px-4 rounded-2xl shadow-lg shadow-rose-600/25 transition-all hover:scale-[1.01] active:scale-95 text-xs">
                Confirmar y Eliminar Firma
            </button>
        </form>
    </div>

</div>

<script src="{{ asset('js/signature_pad.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const alertContainer = document.createElement('div');
    alertContainer.id = 'alert-container-firma';
    alertContainer.className = 'hidden mb-6';
    document.getElementById('panel-firma-estado').parentNode.insertBefore(alertContainer, document.getElementById('panel-firma-estado'));

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
        alertContainer.className = `p-4 rounded-2xl text-xs font-bold mb-6 ${
            type === 'success'
                ? 'bg-emerald-50 text-emerald-800 border border-emerald-200'
                : 'bg-rose-50 text-rose-800 border border-rose-200'
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
            penColor: 'rgb(15, 23, 42)'
        });
    }

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

    btnMetodoDibujar.addEventListener('click', function () {
        btnMetodoDibujar.classList.add('bg-violet-600', 'text-white');
        btnMetodoDibujar.classList.remove('bg-slate-50', 'text-slate-700');
        btnMetodoFoto.classList.remove('bg-violet-600', 'text-white');
        btnMetodoFoto.classList.add('bg-slate-50', 'text-slate-700');
        contenedorCanvas.classList.remove('hidden');
        contenedorFoto.classList.add('hidden');
        previewContainer.classList.add('hidden');
        inputMetodo.value = 'dibujada';
        inputBase64.value = '';
        setTimeout(initSignaturePad, 50);
    });

    btnMetodoFoto.addEventListener('click', function () {
        btnMetodoFoto.classList.add('bg-violet-600', 'text-white');
        btnMetodoFoto.classList.remove('bg-slate-50', 'text-slate-700');
        btnMetodoDibujar.classList.remove('bg-violet-600', 'text-white');
        btnMetodoDibujar.classList.add('bg-slate-50', 'text-slate-700');
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

        fetch('{{ route('configuraciones.firma.store') }}', {
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

    formEliminar.addEventListener('submit', function (e) {
        e.preventDefault();
        hideAlert();

        if (!inputPasswordEliminar.value) {
            showAlert('Debe ingresar su contraseña actual para confirmar la eliminación.', 'error');
            return;
        }

        const formData = new FormData(formEliminar);

        fetch('{{ route('configuraciones.firma.destroy') }}', {
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
