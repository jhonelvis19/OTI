function mostrarSiSelectExpandible(config) {

    const select = document.getElementById(config.selectId);
    const box = document.getElementById(config.boxId);
    const input = document.getElementById(config.inputId);

    if (!select || !box || !input) return;

    function actualizar() {

        const opcion = select.options[select.selectedIndex];

        const nombre =
            opcion.dataset.nombre ??
            opcion.text.trim();

        if (
            nombre === config.valor ||
            nombre === config.valorAlternativo
        ) {

            select.style.flex = '0 0 160px';

            box.style.maxWidth = '400px';
            box.style.opacity = '1';

        } else {

            select.style.flex = '1';

            box.style.maxWidth = '0';
            box.style.opacity = '0';

            input.value = '';

        }

    }

    actualizar();

    select.addEventListener('change', actualizar);

}

function mostrarSiRadio(config) {

    const radios =
        document.querySelectorAll(
            `input[name="${config.radioName}"]`
        );

    const box =
        document.getElementById(config.boxId);

    if (!box) return;

    function actualizar() {

        const seleccionado =
            document.querySelector(
                `input[name="${config.radioName}"]:checked`
            );

        if (
            seleccionado &&
            seleccionado.value === config.valor
        ) {

            box.classList.remove('hidden');

        } else {

            box.classList.add('hidden');

            limpiarCampos(box);

        }

    }

    actualizar();

    radios.forEach(radio => {

        radio.addEventListener(
            'change',
            actualizar
        );

    });

}

function mostrarSiSelectExpandible(config) {

    const select = document.getElementById(config.selectId);
    const box = document.getElementById(config.boxId);
    const input = document.getElementById(config.inputId);

    if (!select || !box || !input) return;

    function actualizar() {

        const texto =
            select.options[select.selectedIndex]
                .text
                .trim()
                .toLowerCase();

        if (
            texto === config.valor.toLowerCase() ||
            texto === config.valorAlternativo.toLowerCase()
        ) {

            select.style.flex = '0 0 160px';

            box.style.maxWidth = '400px';
            box.style.opacity = '1';

            input.focus();

        } else {

            select.style.flex = '1';

            box.style.maxWidth = '0';
            box.style.opacity = '0';

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

