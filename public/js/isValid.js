function validateFormProduct() {

    let isValid = true;

    // Obtener elementos del DOM
    const producto = document.getElementById('producto');
    const marca = document.getElementById('marca');
    const modelo = document.getElementById('modelo');
    const sistema = document.getElementById('sistema');
    const imagen = document.getElementById('imagen');

    // Validar si el valor del input es string y permite espacios
    function isString(str) {
        return /^[a-zA-ZÀ-ÿ\s]+$/.test(str);
    }
    const esNombre = isString(producto.value.trim());
    const esApellido = isString(marca.value.trim());

    const element = [producto, marca, modelo, sistema];

    function validateInfo(element){
        if(element.value.trim().length < 2){
            //element.setAttribute('style', 'border: 1px solid red; background-color: var(--color-error)')
            //element.nextSibling.nextSibling.setAttribute('style', "display:block");
            element.style.backgroundColor = "var(--color-error)";
            element.style.border = "1px solid red";
            element.nextSibling.nextSibling.style.display = "block";
            isValid = false;
         } else {
            element.nextSibling.nextSibling.style.display = "none";
            element.removeAttribute('style');
         };
    }

    element.forEach(element => {
        validateInfo(element)
    });

     if(imagen.value.trim() === "" || !imagen.value.trim().endsWith("jpg" || !imagen.value.trim().endsWith("jpeg") || !imagen.value.trim().endsWith("ppg"))){
        imagen.style.backgroundColor = "var(--color-error)";
        imagen.style.border = "1px solid red";
        imagen.nextSibling.nextSibling.style.display = "block";
        imagen.nextSibling.nextSibling.style.marginLeft = "45px";
        isValid = false;
     } else {
        //imagen.nextSibling.nextSibling.setAttribute('style', "display:none");
        imagen.nextSibling.nextSibling.style.display = "none";
        imagen.removeAttribute('style');
     };

    return isValid;
};



function validateFormCliente() {

    let isValid = true;

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
        return num.length === 10 && !isNaN(Number(num));
    }

    const isCel = isNumCel(telefono.value.trim());

    if (nombre.value.trim().length < 3) {
        isValid = false;
        nombre.value = '';
        nombre.setAttribute('placeholder', 'Inserta un nombre');
        nombre.style.backgroundColor = 'var(--color-error)';
        
    } else if(!esNombre) {
        isValid = false;
        nombre.nextSibling.nextSibling.style.display = "block";
    } else {
        nombre.nextSibling.nextSibling.style.display = "none";
        nombre.style.backgroundColor = '';
    };

    if (apellido.value.trim().length < 3) {
        isValid = false;
        apellido.value = '';
        apellido.setAttribute('placeholder', 'Inserta un apellido');
        apellido.style.backgroundColor = 'var(--color-error)';
    } else if(!esApellido) {
        isValid = false;
        apellido.nextSibling.nextSibling.style.display = "block";
    } else {
        apellido.nextSibling.nextSibling.style.display = "none";
        apellido.style.backgroundColor = '';
    }

    if (!isDateValid) {
        isValid = false;
        nacimiento.style.backgroundColor = 'var(--color-error)';
        nacimiento.nextSibling.nextSibling.style.display = "block";
    } else {
        nacimiento.style.backgroundColor = '';
        nacimiento.nextSibling.nextSibling.style.display = "none";
    }

    if (!isCel) {
        isValid = false;
        telefono.setAttribute('placeholder', 'Inserta un número de teléfono');
        telefono.style.backgroundColor = 'var(--color-error)';
        telefono.nextElementSibling.style.display = "block";
    }else if(telefono.value.trim()[0] != '3'){
        telefono.style.backgroundColor = 'var(--color-error)';
        telefono.nextElementSibling.style.display = "none";
        telefono.nextElementSibling.nextElementSibling.style.display = "block";
    } else {
        telefono.style.backgroundColor = '';
        telefono.nextSibling.nextSibling.style.display = "none";
        telefono.nextElementSibling.nextElementSibling.style.display = "none";
    }

    return isValid;
}