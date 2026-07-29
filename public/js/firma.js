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
        
        // Limpiar el pad si se rota la pantalla o se cambia el tamaño
        window.addEventListener("resize", function() {
            // Nota: resize limpia el canvas, así que lo manejamos con cuidado
            // Solo redimensionamos si está vacío o si es necesario
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

            // Limpiar errores previos de JS
            document.querySelectorAll('.js-error-msg').forEach(el => el.remove());

            // Validación rápida en frontend de campos requeridos antes de pasar a firmar
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
                el.classList.add('border-red-400', 'bg-red-50');
                el.classList.remove('border-indigo-300', 'bg-slate-50');
                
                const errorP = document.createElement('p');
                errorP.className = 'text-red-500 text-sm mt-1 js-error-msg';
                errorP.innerText = mensaje;
                el.parentNode.appendChild(errorP);
            }

            function limpiarError(el) {
                el.classList.remove('border-red-400', 'bg-red-50');
                el.classList.add('border-indigo-300', 'bg-slate-50');
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

            // Verificar DNI
            const dniEl = document.getElementById('dni_atendido');
            if (dniEl && dniEl.value.trim() && dniEl.value.trim().length !== 8) {
                mostrarError(dniEl, 'El DNI debe tener exactamente 8 dígitos.');
            }

            // Verificar si el problema solucionado es "no" y requiere resolución técnica
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
                // Buscar el primer error y scroll
                const primerError = document.querySelector('.js-error-msg');
                if (primerError && primerError.previousElementSibling) {
                    primerError.previousElementSibling.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    primerError.previousElementSibling.focus();
                }
                return;
            }

            // Ocultar formulario, mostrar sección de firmas
            formFieldsContainer.classList.add('hidden');
            seccionFirmas.classList.remove('hidden');

            // Mostrar el primer paso: Persona Atendida
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

    // Opción Dibujar Persona
    btnPersonaMetodoDibujar.addEventListener('click', function () {
        btnPersonaMetodoDibujar.classList.add('bg-indigo-600', 'text-white');
        btnPersonaMetodoDibujar.classList.remove('bg-slate-100', 'text-slate-700');
        btnPersonaMetodoFoto.classList.remove('bg-indigo-600', 'text-white');
        btnPersonaMetodoFoto.classList.add('bg-slate-100', 'text-slate-700');

        contenedorPersonaCanvas.classList.remove('hidden');
        contenedorPersonaFoto.classList.add('hidden');
        previewPersonaContainer.classList.add('hidden');

        // Inicializar canvas
        if (!padPersona) {
            padPersona = initPad(canvasPersona);
        } else {
            padPersona.clear();
        }
        inputFirmaPersonaMetodo.value = 'dibujada';
        inputFirmaPersonaData.value = '';
        btnConfirmarPersona.disabled = true;
        btnConfirmarPersona.classList.add('opacity-50', 'cursor-not-allowed');

        // Monitorear trazo
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

    // Opción Foto Persona
    btnPersonaMetodoFoto.addEventListener('click', function () {
        btnPersonaMetodoFoto.classList.add('bg-indigo-600', 'text-white');
        btnPersonaMetodoFoto.classList.remove('bg-slate-100', 'text-slate-700');
        btnPersonaMetodoDibujar.classList.remove('bg-indigo-600', 'text-white');
        btnPersonaMetodoDibujar.classList.add('bg-slate-100', 'text-slate-700');

        contenedorPersonaCanvas.classList.add('hidden');
        contenedorPersonaFoto.classList.remove('hidden');
        previewPersonaContainer.classList.add('hidden');

        inputFirmaPersonaMetodo.value = 'foto';
        inputFirmaPersonaData.value = '';
        btnConfirmarPersona.disabled = true;
        btnConfirmarPersona.classList.add('opacity-50', 'cursor-not-allowed');
    });

    // Evento al tomar foto persona
    inputPersonaFoto.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (event) {
                previewPersona.src = event.target.result;
                previewPersonaContainer.classList.remove('hidden');
                inputFirmaPersonaData.value = event.target.result; // base64
                btnConfirmarPersona.disabled = false;
                btnConfirmarPersona.classList.remove('opacity-50', 'cursor-not-allowed');
            };
            reader.readAsDataURL(file);
        }
    });

    // Limpiar Persona
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

    // Confirmar Persona
    btnConfirmarPersona.addEventListener('click', function () {
        const metodo = inputFirmaPersonaMetodo.value;
        if (metodo === 'dibujada') {
            if (padPersona && !padPersona.isEmpty()) {
                inputFirmaPersonaData.value = padPersona.toDataURL('image/png');
                personaFirmaConfirmada = true;
            }
        } else if (metodo === 'foto') {
            if (inputFirmaPersonaData.value) {
                personaFirmaConfirmada = true;
            }
        }

        if (personaFirmaConfirmada) {
            // Avanzar al paso del Técnico
            mostrarPasoTecnico();
            // Si el técnico tiene firma guardada en perfil, activar por defecto
            if (btnTecnicoMetodoPerfil) {
                btnTecnicoMetodoPerfil.click();
            } else {
                btnTecnicoMetodoDibujar.click();
            }
        }
    });


    // ==========================================
    // LÓGICA PASO 2: TÉCNICO
    // ==========================================

    // Opción Usar Perfil Técnico
    if (btnTecnicoMetodoPerfil) {
        btnTecnicoMetodoPerfil.addEventListener('click', function () {
            setTecnicoMetodoActivo(btnTecnicoMetodoPerfil);
            contenedorTecnicoPerfil.classList.remove('hidden');
            contenedorTecnicoCanvas.classList.add('hidden');
            contenedorTecnicoFoto.classList.add('hidden');
            previewTecnicoContainer.classList.add('hidden');

            inputFirmaTecnicoMetodo.value = 'perfil';
            inputFirmaTecnicoData.value = 'perfil'; // Indicador para el backend
            btnConfirmarTecnico.disabled = false;
            btnConfirmarTecnico.classList.remove('opacity-50', 'cursor-not-allowed');
        });
    }

    // Opción Dibujar Técnico
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

        // Monitorear trazo
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

    // Opción Foto Técnico
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

    // Evento foto técnico
    inputTecnicoFoto.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (event) {
                previewTecnico.src = event.target.result;
                previewTecnicoContainer.classList.remove('hidden');
                inputFirmaTecnicoData.value = event.target.result; // base64
                btnConfirmarTecnico.disabled = false;
                btnConfirmarTecnico.classList.remove('opacity-50', 'cursor-not-allowed');
            };
            reader.readAsDataURL(file);
        }
    });

    // Limpiar Técnico
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

    // Confirmar Técnico
    btnConfirmarTecnico.addEventListener('click', function () {
        const metodo = inputFirmaTecnicoMetodo.value;
        if (metodo === 'dibujada') {
            if (padTecnico && !padTecnico.isEmpty()) {
                inputFirmaTecnicoData.value = padTecnico.toDataURL('image/png');
                tecnicoFirmaConfirmada = true;
            }
        } else if (metodo === 'foto') {
            if (inputFirmaTecnicoData.value) {
                tecnicoFirmaConfirmada = true;
            }
        } else if (metodo === 'perfil') {
            tecnicoFirmaConfirmada = true;
        }

        if (tecnicoFirmaConfirmada) {
            // Mostrar y habilitar botón de Guardar
            btnGuardarInforme.classList.remove('hidden');
            btnGuardarInforme.disabled = false;
            btnGuardarInforme.classList.remove('opacity-50', 'cursor-not-allowed');

            // Ocultar botón de Ingresar Firmas para que no se duplique
            if (btnIngresarFirmas) {
                btnIngresarFirmas.classList.add('hidden');
            }

            // Desplazarse al botón de guardar
            setTimeout(function () {
                btnGuardarInforme.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }, 200);

            // Efecto visual de que está listo para guardar
            btnConfirmarTecnico.innerText = '✓ Firma Confirmada';
            btnConfirmarTecnico.classList.remove('bg-indigo-600', 'hover:bg-indigo-700');
            btnConfirmarTecnico.classList.add('bg-emerald-600', 'text-white');
        }
    });

    function setTecnicoMetodoActivo(activeBtn) {
        const btns = [btnTecnicoMetodoPerfil, btnTecnicoMetodoDibujar, btnTecnicoMetodoFoto];
        btns.forEach(btn => {
            if (btn) {
                if (btn === activeBtn) {
                    btn.classList.add('bg-indigo-600', 'text-white');
                    btn.classList.remove('bg-slate-100', 'text-slate-700');
                } else {
                    btn.classList.remove('bg-indigo-600', 'text-white');
                    btn.classList.add('bg-slate-100', 'text-slate-700');
                }
            }
        });
        
        // Reset confirmation state if they switch methods
        tecnicoFirmaConfirmada = false;
        btnConfirmarTecnico.innerText = 'Confirmar Firma';
        btnConfirmarTecnico.classList.add('bg-indigo-600', 'hover:bg-indigo-700');
        btnConfirmarTecnico.classList.remove('bg-emerald-600');
        btnGuardarInforme.disabled = true;
        btnGuardarInforme.classList.add('hidden', 'opacity-50', 'cursor-not-allowed');
        if (btnIngresarFirmas) {
            btnIngresarFirmas.classList.remove('hidden');
        }
    }

    // Volver de firmas al formulario
    const btnVolverFormulario = document.getElementById('btn-volver-formulario');
    if (btnVolverFormulario) {
        btnVolverFormulario.addEventListener('click', function () {
            if (confirm('Si regresa al formulario, deberá ingresar y confirmar las firmas nuevamente. ¿Desea continuar?')) {
                seccionFirmas.classList.add('hidden');
                formFieldsContainer.classList.remove('hidden');
                
                // Reset estados
                personaFirmaConfirmada = false;
                tecnicoFirmaConfirmada = false;
                inputFirmaPersonaData.value = '';
                inputFirmaTecnicoData.value = '';
                
                // Re-ocultar botón Guardar y volver a mostrar botón Firmas
                btnGuardarInforme.disabled = true;
                btnGuardarInforme.classList.add('hidden', 'opacity-50', 'cursor-not-allowed');
                if (btnIngresarFirmas) {
                    btnIngresarFirmas.classList.remove('hidden');
                }
            }
        });
    }
});
