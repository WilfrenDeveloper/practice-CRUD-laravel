/****         VALIDAR DATOS DEL PRODUCTO   *****/
function validateEditProduct(){
    
    // Obtener elementos del DOM
    const producto = document.querySelector('.edit_producto');
    const marca = document.querySelector('.edit_marca');
    const modelo = document.querySelector('.edit_modelo');
    const sistema = document.querySelector('.edit_sistema');
    const precio = document.querySelector('.edit_precio');
    const imagen = document.querySelector('.edit_imagen');

    //  console.log(producto.value)
    //  console.log(marca.value)
    //  console.log(modelo.value)
    //  console.log(sistema.value)
    //  console.log(imagen.value)

    let isValid = validateProduct(producto, marca, modelo, sistema, precio, imagen)
    console.log(isValid)
    return isValid;
}

function validateFormProduct(){
    
    // Obtener elementos del DOM
    const producto = document.getElementById('producto');
    const marca = document.getElementById('marca');
    const modelo = document.getElementById('modelo');
    const sistema = document.getElementById('sistema');
    const precio = document.getElementById('precio');
    const imagen = document.getElementById('imagen');

    let isValid = validateProduct(producto, marca, modelo, sistema, precio, imagen)

    return isValid;
}

function validateProduct(producto, marca, modelo, sistema, precio, imagen) {

    let isValid = true;

    // Validar si el valor del input es string y permite espacios
    function isString(str) {
        return /^[a-zA-ZÀ-ÿ\s]+$/.test(str);
    }

    const element = [producto, marca, modelo, sistema, precio];

    function validateInfo(element){
        if(element.value.trim().length < 2){
            element.style.backgroundColor = "var(--color-error)";
            element.nextElementSibling.style.display = "block";
            isValid = false;
         } else {
            element.nextElementSibling.style.display = "none";
            element.removeAttribute('style');
         };
    }

    element.forEach(element => {
        validateInfo(element)
    });

     if(imagen.value.trim().endsWith("jpg") || imagen.value.trim().endsWith("jpeg") || imagen.value.trim().endsWith("png")|| imagen.value.trim().endsWith("PNG")){
        imagen.nextElementSibling.style.display = "none";
        imagen.removeAttribute('style');
     } else {
        imagen.style.backgroundColor = "var(--color-error)";
        imagen.style.border = "1px solid red";
        imagen.nextElementSibling.style.display = "block";
        imagen.nextElementSibling.style.top = "20px";
        isValid = false;
     };

    return isValid;
};


/******************************************** */
/****         VALIDAR DATOS DEL CLIENTE   *****/
/******************************************** */


function validateEditCliente(){

    // Obtener elementos del DOM
    const nombre = document.querySelector('.edit_nombre');
    const apellido = document.querySelector('.edit_apellido');
    const nacimiento = document.querySelector('.edit_nacimiento');
    const telefono = document.querySelector('.edit_telefono');


    // Recibir el valor de ValidateCliente()
    let isValid = validateCliente(nombre, apellido, nacimiento, telefono);

    return isValid;
}

/************************************************************* */

function validateFormCliente(){

    // Obtener elementos del DOM
    const nombre = document.querySelector('#nombre');
    const apellido = document.querySelector('#apellido');
    const nacimiento = document.querySelector('#nacimiento');
    const telefono = document.querySelector('#telefono');
    
    // Recibir el valor de ValidateCliente()
    let isValid = validateCliente(nombre, apellido, nacimiento, telefono);

    return isValid;
}
/********************************************************* */

function validateCliente(nombre, apellido, nacimiento, telefono) {

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

    if (!isCel || telefono.value.trim().length !== 10) {
        isValid = false;
        telefono.setAttribute('placeholder', 'Inserta un número de teléfono');
        telefono.style.backgroundColor = 'var(--color-error)';
        telefono.nextElementSibling.style.display = "block";
    } else if (telefono.value.trim()[0] != '3'){
        isValid = false;
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

    if (direccion.value.length < 5) {
        isValid = false;
        direccion.style.backgroundColor = 'var(--color-error)';
        direccion.nextElementSibling.style.display = "block";
    } else {
        direccion.style.backgroundColor = '';
        direccion.nextElementSibling.style.display = "none";
    }

    if (!isCel || telefono.value.trim().length !== 10) {
        isValid = false;
        telefono.setAttribute('placeholder', 'Inserta un número de teléfono');
        telefono.style.backgroundColor = 'var(--color-error)';
        telefono.nextElementSibling.style.display = "block";
    } else if (telefono.value.trim()[0] != '3'){
        isValid = false;
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