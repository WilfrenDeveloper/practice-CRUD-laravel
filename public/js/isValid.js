function validateForm(fields) {
    let isValid = true;

    fields.forEach(function (field) {
        const input = document.getElementById(field);
        if (!input.value.trim()) {
            isValid = false;
            input.style.backgroundColor = 'var(--color-error)';
            input.style.border = 'solid 1px red';
            input.setAttribute('placeholder', 'Agrega un valor aquí');
        } else {
            input.style.backgroundColor = '';
            input.style.border = '';
            input.removeAttribute('placeholder');
        }
    });

    return isValid;
}

function validateFormProduct() {
    const fields = ['producto', 'marca', 'modelo', 'sistema', 'imagen'];

    const isValid = validateForm(fields);

    if (!isValid) {
        alert('Por favor, Ingresa valores válidos.');
    }

    return isValid;
}

function validateFormCliente() {
    const fields = ['nombre', 'apellido', 'nacimiento', 'telefono'];

    let isValid = validateForm(fields);

    // Obtener elementos del DOM
    const nombre = document.getElementById('nombre');
    const apellido = document.getElementById('apellido');
    const nacimiento = document.getElementById('nacimiento');
    const telefono = document.getElementById('telefono');

    // Validar si el valor del input es string y permite espacios
    function isString(str) {
        return /^[a-zA-ZÀ-ÿ\s]+$/.test(str);
    }

    const esNombre = isString(nombre.value.trim());
    const esApellido = isString(apellido.value.trim());

    // Validar si la fecha es correcta
    const now = new Date();
    const year = now.getFullYear() - 18;
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');
    const limitDate = `${year}-${month}-${day}`;
    const isDateValid = new Date(nacimiento.value) <= new Date(limitDate);

    // Validar si el valor es un número de 10 dígitos
    function isNumCel(num) {
        return num.length === 10 && num[0] == 3 && !isNaN(Number(num));
    }

    const isCel = isNumCel(telefono.value.trim());

    if (!esNombre || nombre.value.trim().length < 3) {
        isValid = false;
        nombre.value = '';
        nombre.setAttribute('placeholder', 'Inserta un nombre válido');
        nombre.style.backgroundColor = 'var(--color-error)';
    } else {
        nombre.style.backgroundColor = '';
    }

    if (!esApellido || apellido.value.trim().length < 3) {
        isValid = false;
        apellido.value = '';
        apellido.setAttribute('placeholder', 'Inserta un apellido válido');
        apellido.style.backgroundColor = 'var(--color-error)';
    } else {
        apellido.style.backgroundColor = '';
    }

    if (!isDateValid) {
        isValid = false;
        nacimiento.value = '';
        nacimiento.setAttribute('placeholder', 'Debe tener al menos 18 años');
        nacimiento.style.backgroundColor = 'var(--color-error)';
    } else {
        nacimiento.style.backgroundColor = '';
    }

    if (!isCel) {
        isValid = false;
        telefono.value = '';
        telefono.setAttribute('placeholder', 'Inserta un número válido');
        telefono.style.backgroundColor = 'var(--color-error)';
    } else {
        telefono.style.backgroundColor = '';
    }

    if (!isValid) {
        alert('Por favor, ingresa valores válidos.');
    }

    return isValid;
}