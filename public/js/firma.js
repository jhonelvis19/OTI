// public/js/firma.js

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('informe-form');
    if (!form) return;

    // Elementos del formulario y secciones
    const formFieldsContainer = document.getElementById('form-fields-container');
    const btnIngresarFirmas = document.getElementById('btn-ingresar-firmas');
    const seccionFirmas = document.getElementById('seccion-firmas');

    // Paso 1: Firma Persona Atendida
    const pasoPersona = document.getElementById('paso-firma-persona');
    const btnPersonaMetodoDibujar = document.getElementById('btn-persona-dibujar');
    const btnPersonaMetodoFoto = document.getElementById('btn-persona-foto');
    const contenedorPersonaCanvas = document.getElementById('contenedor-persona-canvas');
    const contenedorPersonaFoto = document.getElementById('contenedor-persona-foto');
    const canvasPersona = document.getElementById('canvas-persona');
    const inputPersonaFoto = document.getElementById('input-persona-foto');
    const previewPersona = document.getElementById('preview-persona');
    const previewPersonaContainer = document.getElementById('preview-persona-container');
    const btnLimpiarPersona = document.getElementById('btn-limpiar-persona');
    const btnConfirmarPersona = document.getElementById('btn-confirmar-persona');

    // Inputs hidden para enviar al servidor
    const inputFirmaPersonaData = document.getElementById('firma_persona_data');
    const inputFirmaPersonaMetodo = document.getElementById('firma_persona_metodo');
    const inputFirmaTecnicoData = document.getElementById('firma_tecnico_data');
    const inputFirmaTecnicoMetodo = document.getElementById('firma_tecnico_metodo');

    // Paso 2: Firma Técnico
    const pasoTecnico = document.getElementById('paso-firma-tecnico');
    const btnTecnicoMetodoPerfil = document.getElementById('btn-tecnico-perfil');
    const btnTecnicoMetodoDibujar = document.getElementById('btn-tecnico-dibujar');
    const btnTecnicoMetodoFoto = document.getElementById('btn-tecnico-foto');
    const contenedorTecnicoCanvas = document.getElementById('contenedor-tecnico-canvas');
    const contenedorTecnicoFoto = document.getElementById('contenedor-tecnico-foto');
    const contenedorTecnicoPerfil = document.getElementById('contenedor-tecnico-perfil');
    const canvasTecnico = document.getElementById('canvas-tecnico');
    const inputTecnicoFoto = document.getElementById('input-tecnico-foto');
    const previewTecnico = document.getElementById('preview-tecnico');
    const previewTecnicoContainer = document.getElementById('preview-tecnico-container');
    const btnLimpiarTecnico = document.getElementById('btn-limpiar-tecnico');
    const btnConfirmarTecnico = document.getElementById('btn-confirmar-tecnico');

    // Botón Final Guardar
    const btnGuardarInforme = document.getElementById('btn-guardar-informe');

    // Instancias de SignaturePad
    let padPersona = null;
    let padTecnico = null;

    // Estado local
    let personaFirmaConfirmada = false;
    let tecnicoFirmaConfirmada = false;

    /**
     * Helper para comprimir y redimensionar fotos de firmas (evita desbordamiento de búfer POST errno=28)
     */
    function compressBase64Image(dataUrl, maxWidth, maxHeight, quality, callback) {
        const img = new Image();
        img.onload = function () {
            let width = img.width;
            let height = img.height;

            if (width > height) {
                if (width > maxWidth) {
                    height = Math.round((height * maxWidth) / width);
                    width = maxWidth;
                }
            } else {
                if (height > maxHeight) {
                    width = Math.round((width * maxHeight) / height);
                    height = maxHeight;
                }
            }

            const cvs = document.createElement('canvas');
            cvs.width = width;
            cvs.height = height;
            const ctx = cvs.getContext('2d');
            ctx.fillStyle = '#FFFFFF';
            ctx.fillRect(0, 0, width, height);
            ctx.drawImage(img, 0, 0, width, height);

            const compressedDataUrl = cvs.toDataURL('image/jpeg', quality);
            callback(compressedDataUrl);
        };
        img.onerror = function() {
            callback(dataUrl);
        };
        img.src = dataUrl;
    }

    // Resize del canvas para SignaturePad
    function resizeCanvas(canvas) {
        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
    }

    // Inicializar Signature Pad
    function initPad(canvas) {
        resizeCanvas(canvas);
        const pad = new SignaturePad(canvas, {
            backgroundColor: 'rgba(255, 255, 255, 0)',
            penColor: 'rgb(0, 0, 0)'
        });
        
        window.addEventListener("resize", function() {
            if (pad.isEmpty()) {
                resizeCanvas(canvas);
            }
        });
        return pad;
    }

    // Al presionar "Ingresar firmas"
    if (btnIngresarFirmas) {
        btnIngresarFirmas.addEventListener('click', function (e) {
            e.preventDefault();

            document.querySelectorAll('.js-error-msg').forEach(el => el.remove());

            const camposRequeridos = [
                { id: 'nombre_atendido', nombre: 'Nombre de la persona atendida' },
                { id: 'dni_atendido', nombre: 'DNI de la persona atendida' },
                { id: 'sede_id', nombre: 'Sede' },
                { id: 'oficina', nombre: 'Oficina' },
                { id: 'tipo_equipo_id', nombre: 'Tipo de equipo' },
                { id: 'codigo_patrimonial', nombre: 'Código patrimonial' },
                { id: 'marca', nombre: 'Marca' },
                { id: 'modelo', nombre: 'Modelo' },
                { id: 'descripcion_problema', nombre: 'Descripción del problema' }
            ];

            let hayErrores = false;

            function mostrarError(el, mensaje) {
                hayErrores = true;
                el.classList.add('border-rose-400', 'bg-rose-50');
                
                const errorP = document.createElement('p');
                errorP.className = 'text-rose-500 text-xs mt-1 js-error-msg font-medium';
                errorP.innerText = mensaje;
                el.parentNode.appendChild(errorP);
            }

            function limpiarError(el) {
                el.classList.remove('border-rose-400', 'bg-rose-50');
            }

            camposRequeridos.forEach(function (campo) {
                const el = document.getElementById(campo.id);
                if (el) {
                    if (!el.value.trim()) {
                        mostrarError(el, 'El campo ' + campo.nombre.toLowerCase() + ' es obligatorio.');
                    } else {
                        limpiarError(el);
                    }
                }
            });

            const dniEl = document.getElementById('dni_atendido');
            if (dniEl && dniEl.value.trim() && dniEl.value.trim().length !== 8) {
                mostrarError(dniEl, 'El DNI debe tener exactamente 8 dígitos.');
            }

            const solucionadoNo = document.getElementById('solucionado_no');
            const resolucion = document.getElementById('resolucion_tecnica');
            if (solucionadoNo && solucionadoNo.checked && resolucion) {
                if (!resolucion.value.trim()) {
                    mostrarError(resolucion, 'Debe ingresar la resolución técnica si el problema no fue solucionado.');
                } else {
                    limpiarError(resolucion);
                }
            }

            if (hayErrores) {
                const primerError = document.querySelector('.js-error-msg');
                if (primerError && primerError.previousElementSibling) {
                    primerError.previousElementSibling.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    primerError.previousElementSibling.focus();
                }
                return;
            }

            formFieldsContainer.classList.add('hidden');
            seccionFirmas.classList.remove('hidden');

            mostrarPasoPersona();
        });
    }

    function mostrarPasoPersona() {
        pasoPersona.classList.remove('hidden');
        pasoTecnico.classList.add('hidden');
        document.getElementById('firma-header-title').innerText = 'Firma de la Persona Atendida';
        document.getElementById('firma-header-step').innerText = 'Paso 1 de 2';
    }

    function mostrarPasoTecnico() {
        pasoPersona.classList.add('hidden');
        pasoTecnico.classList.remove('hidden');
        document.getElementById('firma-header-title').innerText = 'Firma del Técnico Responsable';
        document.getElementById('firma-header-step').innerText = 'Paso 2 de 2';
    }

    // ==========================================
    // LÓGICA PASO 1: PERSONA ATENDIDA
    // ==========================================

    btnPersonaMetodoDibujar.addEventListener('click', function () {
        btnPersonaMetodoDibujar.classList.add('bg-violet-600', 'text-white');
        btnPersonaMetodoDibujar.classList.remove('bg-white', 'text-slate-700');
        btnPersonaMetodoFoto.classList.remove('bg-violet-600', 'text-white');
        btnPersonaMetodoFoto.classList.add('bg-white', 'text-slate-700');

        contenedorPersonaCanvas.classList.remove('hidden');
        contenedorPersonaFoto.classList.add('hidden');
        previewPersonaContainer.classList.add('hidden');

        if (!padPersona) {
            padPersona = initPad(canvasPersona);
        } else {
            padPersona.clear();
        }
        inputFirmaPersonaMetodo.value = 'dibujada';
        inputFirmaPersonaData.value = '';
        btnConfirmarPersona.disabled = true;
        btnConfirmarPersona.classList.add('opacity-50', 'cursor-not-allowed');

        canvasPersona.addEventListener('pointerup', checkPersonaCanvas);
        canvasPersona.addEventListener('mouseup', checkPersonaCanvas);
        canvasPersona.addEventListener('touchend', checkPersonaCanvas);
    });

    function checkPersonaCanvas() {
        if (padPersona && !padPersona.isEmpty()) {
            btnConfirmarPersona.disabled = false;
            btnConfirmarPersona.classList.remove('opacity-50', 'cursor-not-allowed');
        }
    }

    btnPersonaMetodoFoto.addEventListener('click', function () {
        btnPersonaMetodoFoto.classList.add('bg-violet-600', 'text-white');
        btnPersonaMetodoFoto.classList.remove('bg-white', 'text-slate-700');
        btnPersonaMetodoDibujar.classList.remove('bg-violet-600', 'text-white');
        btnPersonaMetodoDibujar.classList.add('bg-white', 'text-slate-700');

        contenedorPersonaCanvas.classList.add('hidden');
        contenedorPersonaFoto.classList.remove('hidden');
        previewPersonaContainer.classList.add('hidden');

        inputFirmaPersonaMetodo.value = 'foto';
        inputFirmaPersonaData.value = '';
        btnConfirmarPersona.disabled = true;
        btnConfirmarPersona.classList.add('opacity-50', 'cursor-not-allowed');
    });

    inputPersonaFoto.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (event) {
                // Compresión optimizada para evitar desbordamiento errno=28
                compressBase64Image(event.target.result, 800, 600, 0.7, function(compressedUrl) {
                    previewPersona.src = compressedUrl;
                    previewPersonaContainer.classList.remove('hidden');
                    inputFirmaPersonaData.value = compressedUrl;
                    btnConfirmarPersona.disabled = false;
                    btnConfirmarPersona.classList.remove('opacity-50', 'cursor-not-allowed');
                });
            };
            reader.readAsDataURL(file);
        }
    });

    btnLimpiarPersona.addEventListener('click', function () {
        const metodo = inputFirmaPersonaMetodo.value;
        if (metodo === 'dibujada' && padPersona) {
            padPersona.clear();
            inputFirmaPersonaData.value = '';
            btnConfirmarPersona.disabled = true;
            btnConfirmarPersona.classList.add('opacity-50', 'cursor-not-allowed');
        } else if (metodo === 'foto') {
            inputPersonaFoto.value = '';
            previewPersona.src = '#';
            previewPersonaContainer.classList.add('hidden');
            inputFirmaPersonaData.value = '';
            btnConfirmarPersona.disabled = true;
            btnConfirmarPersona.classList.add('opacity-50', 'cursor-not-allowed');
        }
    });

    btnConfirmarPersona.addEventListener('click', function () {
        const metodo = inputFirmaPersonaMetodo.value;
        if (metodo === 'dibujada') {
            if (padPersona && !padPersona.isEmpty()) {
                const rawUrl = padPersona.toDataURL('image/png');
                compressBase64Image(rawUrl, 600, 400, 0.8, function(compressedUrl) {
                    inputFirmaPersonaData.value = compressedUrl;
                    personaFirmaConfirmada = true;
                    avanzarATecnico();
                });
                return;
            }
        } else if (metodo === 'foto') {
            if (inputFirmaPersonaData.value) {
                personaFirmaConfirmada = true;
            }
        }
        if (personaFirmaConfirmada) {
            avanzarATecnico();
        }
    });

    function avanzarATecnico() {
        mostrarPasoTecnico();
        if (btnTecnicoMetodoPerfil) {
            btnTecnicoMetodoPerfil.click();
        } else {
            btnTecnicoMetodoDibujar.click();
        }
    }

    // ==========================================
    // LÓGICA PASO 2: TÉCNICO
    // ==========================================

    if (btnTecnicoMetodoPerfil) {
        btnTecnicoMetodoPerfil.addEventListener('click', function () {
            setTecnicoMetodoActivo(btnTecnicoMetodoPerfil);
            contenedorTecnicoPerfil.classList.remove('hidden');
            contenedorTecnicoCanvas.classList.add('hidden');
            contenedorTecnicoFoto.classList.add('hidden');
            previewTecnicoContainer.classList.add('hidden');

            inputFirmaTecnicoMetodo.value = 'perfil';
            inputFirmaTecnicoData.value = 'perfil';
            btnConfirmarTecnico.disabled = false;
            btnConfirmarTecnico.classList.remove('opacity-50', 'cursor-not-allowed');
        });
    }

    btnTecnicoMetodoDibujar.addEventListener('click', function () {
        setTecnicoMetodoActivo(btnTecnicoMetodoDibujar);
        if (contenedorTecnicoPerfil) contenedorTecnicoPerfil.classList.add('hidden');
        contenedorTecnicoCanvas.classList.remove('hidden');
        contenedorTecnicoFoto.classList.add('hidden');
        previewTecnicoContainer.classList.add('hidden');

        if (!padTecnico) {
            padTecnico = initPad(canvasTecnico);
        } else {
            padTecnico.clear();
        }

        inputFirmaTecnicoMetodo.value = 'dibujada';
        inputFirmaTecnicoData.value = '';
        btnConfirmarTecnico.disabled = true;
        btnConfirmarTecnico.classList.add('opacity-50', 'cursor-not-allowed');

        canvasTecnico.addEventListener('pointerup', checkTecnicoCanvas);
        canvasTecnico.addEventListener('mouseup', checkTecnicoCanvas);
        canvasTecnico.addEventListener('touchend', checkTecnicoCanvas);
    });

    function checkTecnicoCanvas() {
        if (padTecnico && !padTecnico.isEmpty()) {
            btnConfirmarTecnico.disabled = false;
            btnConfirmarTecnico.classList.remove('opacity-50', 'cursor-not-allowed');
        }
    }

    btnTecnicoMetodoFoto.addEventListener('click', function () {
        setTecnicoMetodoActivo(btnTecnicoMetodoFoto);
        if (contenedorTecnicoPerfil) contenedorTecnicoPerfil.classList.add('hidden');
        contenedorTecnicoCanvas.classList.add('hidden');
        contenedorTecnicoFoto.classList.remove('hidden');
        previewTecnicoContainer.classList.add('hidden');

        inputFirmaTecnicoMetodo.value = 'foto';
        inputFirmaTecnicoData.value = '';
        btnConfirmarTecnico.disabled = true;
        btnConfirmarTecnico.classList.add('opacity-50', 'cursor-not-allowed');
    });

    inputTecnicoFoto.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (event) {
                // Compresión optimizada foto técnico
                compressBase64Image(event.target.result, 800, 600, 0.7, function(compressedUrl) {
                    previewTecnico.src = compressedUrl;
                    previewTecnicoContainer.classList.remove('hidden');
                    inputFirmaTecnicoData.value = compressedUrl;
                    btnConfirmarTecnico.disabled = false;
                    btnConfirmarTecnico.classList.remove('opacity-50', 'cursor-not-allowed');
                });
            };
            reader.readAsDataURL(file);
        }
    });

    btnLimpiarTecnico.addEventListener('click', function () {
        const metodo = inputFirmaTecnicoMetodo.value;
        if (metodo === 'dibujada' && padTecnico) {
            padTecnico.clear();
            inputFirmaTecnicoData.value = '';
            btnConfirmarTecnico.disabled = true;
            btnConfirmarTecnico.classList.add('opacity-50', 'cursor-not-allowed');
        } else if (metodo === 'foto') {
            inputTecnicoFoto.value = '';
            previewTecnico.src = '#';
            previewTecnicoContainer.classList.add('hidden');
            inputFirmaTecnicoData.value = '';
            btnConfirmarTecnico.disabled = true;
            btnConfirmarTecnico.classList.add('opacity-50', 'cursor-not-allowed');
        }
    });

    btnConfirmarTecnico.addEventListener('click', function () {
        const metodo = inputFirmaTecnicoMetodo.value;
        if (metodo === 'dibujada') {
            if (padTecnico && !padTecnico.isEmpty()) {
                const rawUrl = padTecnico.toDataURL('image/png');
                compressBase64Image(rawUrl, 600, 400, 0.8, function(compressedUrl) {
                    inputFirmaTecnicoData.value = compressedUrl;
                    tecnicoFirmaConfirmada = true;
                    finalizarFirmas();
                });
                return;
            }
        } else if (metodo === 'foto') {
            if (inputFirmaTecnicoData.value) {
                tecnicoFirmaConfirmada = true;
            }
        } else if (metodo === 'perfil') {
            tecnicoFirmaConfirmada = true;
        }

        if (tecnicoFirmaConfirmada) {
            finalizarFirmas();
        }
    });

    function finalizarFirmas() {
        btnGuardarInforme.classList.remove('hidden');
        btnGuardarInforme.disabled = false;
        btnGuardarInforme.classList.remove('opacity-50', 'cursor-not-allowed');

        if (btnIngresarFirmas) {
            btnIngresarFirmas.classList.add('hidden');
        }

        setTimeout(function () {
            btnGuardarInforme.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }, 200);

        btnConfirmarTecnico.innerText = '✓ Firma Confirmada';
        btnConfirmarTecnico.classList.remove('bg-violet-600', 'hover:bg-violet-700');
        btnConfirmarTecnico.classList.add('bg-emerald-600', 'text-white');
    }

    function setTecnicoMetodoActivo(activeBtn) {
        const btns = [btnTecnicoMetodoPerfil, btnTecnicoMetodoDibujar, btnTecnicoMetodoFoto];
        btns.forEach(btn => {
            if (btn) {
                if (btn === activeBtn) {
                    btn.classList.add('bg-violet-600', 'text-white');
                    btn.classList.remove('bg-white', 'text-slate-700');
                } else {
                    btn.classList.remove('bg-violet-600', 'text-white');
                    btn.classList.add('bg-white', 'text-slate-700');
                }
            }
        });
        
        tecnicoFirmaConfirmada = false;
        btnConfirmarTecnico.innerText = 'Confirmar Firma';
        btnConfirmarTecnico.classList.add('bg-violet-600', 'hover:bg-violet-700');
        btnConfirmarTecnico.classList.remove('bg-emerald-600');
        btnGuardarInforme.disabled = true;
        btnGuardarInforme.classList.add('hidden', 'opacity-50', 'cursor-not-allowed');
        if (btnIngresarFirmas) {
            btnIngresarFirmas.classList.remove('hidden');
        }
    }

    const btnVolverFormulario = document.getElementById('btn-volver-formulario');
    if (btnVolverFormulario) {
        btnVolverFormulario.addEventListener('click', function () {
            if (confirm('Si regresa al formulario, deberá ingresar y confirmar las firmas nuevamente. ¿Desea continuar?')) {
                seccionFirmas.classList.add('hidden');
                formFieldsContainer.classList.remove('hidden');
                
                personaFirmaConfirmada = false;
                tecnicoFirmaConfirmada = false;
                inputFirmaPersonaData.value = '';
                inputFirmaTecnicoData.value = '';
                
                btnGuardarInforme.disabled = true;
                btnGuardarInforme.classList.add('hidden', 'opacity-50', 'cursor-not-allowed');
                if (btnIngresarFirmas) {
                    btnIngresarFirmas.classList.remove('hidden');
                }
            }
        });
    }
});
