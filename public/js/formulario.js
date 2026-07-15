function mostrarSiRadio(config) {

    const radios = document.querySelectorAll(
        `input[name="${config.radioName}"]`
    );

    const box = document.getElementById(config.boxId);

    if (!box) return;

    function actualizar() {

        const seleccionado = document.querySelector(
            `input[name="${config.radioName}"]:checked`
        );

        if (seleccionado && seleccionado.value === config.valor) {
            box.classList.remove('hidden');
        } else {
            box.classList.add('hidden');
            limpiarCampos(box);
        }
    }

    actualizar();

    radios.forEach(radio => {
        radio.addEventListener('change', actualizar);
    });
}

function mostrarSiSelectExpandible(config) {

    const select = document.getElementById(config.selectId);
    const box = document.getElementById(config.boxId);
    const input = document.getElementById(config.inputId);

    if (!select || !box || !input) return;

    function actualizar() {

        if (select.value == config.valor) {

            box.classList.remove('hidden');
            input.focus();

        } else {

            box.classList.add('hidden');
            input.value = '';
        }
    }

    actualizar();
    select.addEventListener('change', actualizar);
}

function limpiarCampos(box) {

    box.querySelectorAll('input').forEach(input => {
        input.value = '';
    });

    box.querySelectorAll('textarea').forEach(textarea => {
        textarea.value = '';
    });

    box.querySelectorAll('select').forEach(select => {
        select.selectedIndex = 0;
    });
}