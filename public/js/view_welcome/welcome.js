$(document).ready(function() {
    $('.div_title').html(`
        <div class="input-group">
            <input id="search" name="search" type="search" class="form-control input-search rounded-0 me-2">
            <button class="btn btn-info rounded-0 text-light fs-6 border-0 m-0" type="button" id="btn-search button-addon2">Buscar</button>
        </div>`)
    $('.cart_icon').show();
    
    getProducts();
});

//Valor del input Search
let inputValue = "";

//Obtener productos al presionar el botón VER MAS...
let offset = 0
$('body').on('click', '.btn_verMas', function (e) {
    e.preventDefault();
    offset += 5
    getProducts(inputValue, offset);
});

$('body').on('click', '#btn-search', function(e){
    e.preventDefault()
    inputValue = $('.input-search').val();
    if(inputValue){
        offset = 0
        getProducts(inputValue)
        offset += 5
    }
});

$('body').on('click',  '.btn_addToCart', function(e){
    e.preventDefault();
    let id = $(this).data('id');
    if( parseInt( $(`.card_product_${id}`).find('.cardProduct_disponible').text() ) > 0){
        const productInString = $(`.data_products_${id}`).val();
        const stringToObject = JSON.parse(productInString);
        localStorageCart(stringToObject);
    }   
});




