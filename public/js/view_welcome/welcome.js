$(document).ready(function() {
    //Obtener todos los productos al recargar la página
    getProducts();
    cartProducts();
});

//Valor del input Search
let inputValue = "";

//Obtener productos al presionar el botón VER MAS...
let offset = 0
$('body').on('click', '.btn_verMas', function (e) {
    e.preventDefault();
    offset += 4
    getProducts(inputValue, offset);
});

$('body').on('click', '#btn-search', function(e){
    e.preventDefault()
    inputValue = $('.input-search').val();
    if(inputValue){
        offset = 0
        getProducts(inputValue)
        offset +=4
    }
});

$('body').on('click',  '.btn_addToCart', function(e){
    e.preventDefault();
    let id = $(this).data('id');

    const productInString = $(`.data_products_${id}`).val();
    const stringToObject = JSON.parse(productInString);
    localStorageCart(stringToObject);   
});


