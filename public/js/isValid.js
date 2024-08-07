function validateForm(fields) {
    let isValid = true;
    
    fields.forEach(function(field) {
        const input = document.getElementById(field);
        if (!input.value.trim()) {
            isValid = false;
            input.style.borderColor = 'red';
            input.setAttribute('placeholder', 'Agrega un valor aquí')
            console.log(input);
        } else {
            input.style.borderColor = '';
            input.removeAttribute('placeholder');
        }
    });
    
    if (!isValid) {
        alert('Por favor, complete todos los campos.');
    }
    
    return isValid;

}

function validateFormProduct() {
    const fields = ['producto', 'marca', 'modelo', 'sistema', 'imagen'];
    
    return validateForm(fields);
    
}

function validateFormCliente() {
    const fields = ['nombre', 'apellido', 'nacimiento', 'telefono'];
    
    return validateForm(fields);
}

