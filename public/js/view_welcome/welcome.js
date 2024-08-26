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

$('body').on('click', '.btn_deleteProductCart', function(e){
    e.preventDefault();
    let id = $(this).closest('.cart_product').data('id');
    deleteProductOfCart(id)
});

$('body').on('click', '.btn_plus_cart', function(e){
    e.preventDefault();
    let id = $(this).closest('.cart_product').data('id');
    btnPlusProducts(id)
});

$('body').on('click', '.btn_minus_cart', function(e){
    e.preventDefault();
    const input = $(this).closest('.cart_product').find('.product_quantity');
    if(input.val() <= 1){
        input.val(1)
    }else{
        let id = $(this).closest('.cart_product').data('id');
        btnMinusProducts(id)
    }
});

$('body').on('input', '.product_quantity', function(){
    const id = $(this).data('id');
    const valueInput = $(this);
    valueInput.val(parseInt(valueInput.val()));
    if(valueInput.val() == 0){
        valueInput.val(1)
    }
    const productInString = $(`.data_products_${id}`).val();
    const stringToObject = JSON.parse(productInString);
    localStorageCart(stringToObject, Number(valueInput.val()));
});

