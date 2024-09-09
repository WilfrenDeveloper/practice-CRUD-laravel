/****         VALIDAR DATOS DEL PRODUCTO   *****/
function validateEditProduct(){
    
    // Obtener elementos del DOM
    const element = document.querySelector('#form_datosDelProducto')
    const producto = element.querySelector('#producto');
    const marca = element.querySelector('#marca');
    const modelo = element.querySelector('#modelo');
    const sistema = element.querySelector('#sistema');
    const precio = element.querySelector('#precio');
    const cantidad = element.querySelector('#cantidad');
    const imagen = element.querySelector('#imagen');

    let isValid = true;

    const elements = [producto, marca, modelo, sistema, precio, cantidad];

    for (const element of elements) {
        if(element.value.trim().length < 1){
            element.classList.add('bg-danger-subtle', 'border-danger');
            isValid = false;
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Debes llenar todos los campos!"
              });
        }
    };

   
    return isValid;
}

function validateFormProduct(){
    
    // Obtener elementos del DOM
    const element = document.querySelector('#form_datosDelProducto')
    const producto = element.querySelector('#producto');
    const marca = element.querySelector('#marca');
    const modelo = element.querySelector('#modelo');
    const sistema = element.querySelector('#sistema');
    const precio = element.querySelector('#precio');
    const cantidad = element.querySelector('#cantidad');
    const imagen = element.querySelector('#imagen');

    let isValid = true;
    
    const elements = [producto, marca, modelo, sistema, precio, cantidad, imagen];

    for (const element of elements) {
        if(element.value.trim().length < 1){
            element.classList.add('bg-danger-subtle', 'border-danger');
            isValid = false;
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Debes llenar todos los campos!"
              });
        } else if(imagen.value.trim().endsWith("jpg") || imagen.value.trim().endsWith("jpeg") || imagen.value.trim().endsWith("png")|| imagen.value.trim().endsWith("PNG")){
            imagen.closest('label').classList.remove('bg-danger-subtle', 'border-danger');   
        } else {
            imagen.closest('label').classList.add('bg-danger-subtle', 'border-danger');
            isValid = false;
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Debes adjuntar una imagen formato: jpg, jpeg o png"
            });
        };
    };

    return isValid;
}

/*
function validateProduct(producto, marca, modelo, sistema, precio, cantidad, imagen) {

    let isValid = true;

    // Validar si el valor del input es string y permite espacios
    function isString(str) {
        return /^[a-zA-ZÀ-ÿ\s]+$/.test(str);
    }

    const elements = [producto, marca, modelo, sistema, precio, cantidad, imagen];

    for (const element of elements) {
        if(element.value.trim().length < 1){
            element.classList.add('bg-danger-subtle', 'border-danger');
            isValid = false;
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Debes llenar todos los campos!"
              });
        } else if(imagen.value.trim().endsWith("jpg") || imagen.value.trim().endsWith("jpeg") || imagen.value.trim().endsWith("png")|| imagen.value.trim().endsWith("PNG")){
            imagen.closest('label').classList.remove('bg-danger-subtle', 'border-danger');   
        } else {
            imagen.closest('label').classList.add('bg-danger-subtle', 'border-danger');
            isValid = false;
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Debes adjuntar una imagen formato: jpg, jpeg o png"
            });
        };
    };

    

    return isValid;
};
*/

/******************************************** */
/****         VALIDAR DATOS DEL CLIENTE   *****/
/******************************************** */


function validateEditCliente(){

    // Obtener elementos del DOM
    const element = document.querySelector('#form_dataCliente');
    const nombre = element.querySelector('#nombre');
    const apellido = element.querySelector('#apellido');
    const direccion = element.querySelector('#direccion');
    const nacimiento = element.querySelector('#nacimiento');
    const telefono = element.querySelector('#telefono');


    // Recibir el valor de ValidateCliente()
    let isValid = validateCliente(nombre, apellido, direccion, nacimiento, telefono);

    return isValid;
}

/************************************************************* */

function validateFormCliente(){

    // Obtener elementos del DOM
    const element = document.querySelector('#form_crearCliente');
    const nombre = element.querySelector('#nombre');
    const apellido = element.querySelector('#apellido');
    const direccion = element.querySelector('#direccion');
    const nacimiento = element.querySelector('#nacimiento');
    const telefono = element.querySelector('#telefono');
    
    // Recibir el valor de ValidateCliente()
    let isValid = validateCliente(nombre, apellido, direccion, nacimiento, telefono);

    return isValid;
}
/********************************************************* */

function validateCliente(nombre, apellido, direccion, nacimiento, telefono) {

    let isValid = true;

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
        nombre.classList.add('bg-danger-subtle', 'border-danger')
        nombre.value = '';
    } else if(!esNombre) {
        isValid = false;
        nombre.classList.add('bg-danger-subtle', 'border-danger')
        nombre.closest('#container').querySelector('#error').style.display = "block";
    } else {
        nombre.closest('#container').querySelector('#error').style.display = "none";
    };

    if (apellido.value.trim().length < 3) {
        isValid = false;
        apellido.classList.add('bg-danger-subtle', 'border-danger')
        apellido.value = '';
    } else if(!esApellido) {
        isValid = false;
        apellido.classList.add('bg-danger-subtle', 'border-danger');
        apellido.closest('#container').querySelector('#error').style.display = "block";
    } else {
        apellido.closest('#container').querySelector('#error').style.display = "none";
    }

    if(direccion.value.trim().length < 5) {
        isValid = false;
        direccion.classList.add('bg-danger-subtle', 'border-danger')
        apellido.closest('#container').querySelector('#error').style.display = "block";
    }

    if (!isDateValid) {
        isValid = false;
        nacimiento.classList.add('bg-danger-subtle', 'border-danger');
        nacimiento.closest('#container').querySelector('#error').style.display = "block";
    } else {
        nacimiento.closest('#container').querySelector('#error').style.display = "none";
    }

    if (!isCel || telefono.value.trim().length !== 10) {
        isValid = false;
        telefono.classList.add('bg-danger-subtle', 'border-danger');
        telefono.setAttribute('placeholder', 'Inserta un número de teléfono');
        telefono.closest('#container').querySelector('#error').style.display = "block";
    } else if (telefono.value.trim()[0] != '3'){
        isValid = false;
        telefono.classList.add('bg-danger-subtle', 'border-danger')
        telefono.style.backgroundColor = 'var(--color-error)';
        telefono.closest('#container').querySelector('#error').style.display = "none";
    } else {
        telefono.closest('#container').querySelector('#error').style.display = "none";
    }

    return isValid;
}

/************************************* */

function validateClienteOfCart() {

    const element = document.querySelector('.generarFactura_form');
    const nombre = element.querySelector('#nombre');
    const apellido = element.querySelector('#apellido');
    const direccion = element.querySelector('#direccion');
    const telefono = element.querySelector('#telefono');
    let isValid = true;

    // Validar si el valor del input es string y permite espacios
    function isString(str) {
        return /^[a-zA-ZÀ-ÿ\s]+$/.test(str);
    }

    const esNombre = isString(nombre.value.trim());
    const esApellido = isString(apellido.value.trim());


    // Validar si el valor es un número de 10 dígitos
    function isNumCel(num) {
        return num.length === 10 && !isNaN(Number(num));
    }

    const isCel = isNumCel(telefono.value.trim());

    if (nombre.value.trim().length < 3) {
        isValid = false;
        nombre.value = '';
        nombre.setAttribute('placeholder', 'Inserta un nombre');
        nombre.classList.add('bg-danger-subtle', 'border-danger');
        
    } else if(!esNombre) {
        isValid = false;
        nombre.nextSibling.nextSibling.style.display = "block";
    } else {
        nombre.nextSibling.nextSibling.style.display = "none";
    };

    if (apellido.value.trim().length < 3) {
        isValid = false;
        apellido.value = '';
        apellido.setAttribute('placeholder', 'Inserta un apellido');
        apellido.classList.add('bg-danger-subtle', 'border-danger');
    } else if(!esApellido) {
        isValid = false;
        apellido.nextSibling.nextSibling.style.display = "block";
    } else {
        apellido.nextSibling.nextSibling.style.display = "none";
    }

    if (direccion.value.length < 5) {
        isValid = false;
        direccion.classList.add('bg-danger-subtle', 'border-danger');
        direccion.nextElementSibling.style.display = "block";
    } else {
        direccion.nextElementSibling.style.display = "none";
    }

    if (!isCel || telefono.value.trim().length !== 10) {
        isValid = false;
        telefono.setAttribute('placeholder', 'Inserta un número de teléfono');
        telefono.classList.add('bg-danger-subtle', 'border-danger');
        telefono.nextElementSibling.style.display = "block";
    } else if (telefono.value.trim()[0] != '3'){
        isValid = false;
        telefono.classList.add('bg-danger-subtle', 'border-danger');
        telefono.nextElementSibling.style.display = "none";
        telefono.nextElementSibling.nextElementSibling.style.display = "block";
    } else {
        telefono.nextSibling.nextSibling.style.display = "none";
        telefono.nextElementSibling.nextElementSibling.style.display = "none";
    }

    return isValid;
}

function allCorrectCliente() {
    const element = document.querySelector('.generarFactura_form');
    const nombre = element.querySelector('#nombre');
    const apellido = element.querySelector('#apellido');
    const direccion = element.querySelector('#direccion');
    const telefono = element.querySelector('#telefono');

    nombre.value = "";
    nombre.nextSibling.nextSibling.style.display = "none";
    nombre.style.backgroundColor = '';

    apellido.value="";
    apellido.nextSibling.nextSibling.style.display = "none";
    apellido.style.backgroundColor = '';

    direccion.value="";
    direccion.style.backgroundColor = '';
    direccion.nextElementSibling.style.display = "none";

    telefono.value="";
    telefono.style.backgroundColor = '';
    telefono.nextElementSibling.style.display = "none";
    telefono.nextElementSibling.nextElementSibling.style.display = "none";

}