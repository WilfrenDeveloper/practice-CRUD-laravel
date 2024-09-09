$(document).ready(function() {
    $('.div_title').html(`
        <div class="input-group">
            <input id="search" name="search" type="search" class="input-search form-control rounded-0 me-2">
            <button id="btn-search" class="btn btn-info rounded-0 text-light fs-6 border-0 m-0" type="button">Buscar</button>
        </div>`)
    $('.cart_icon').show()

    getProducts()
});

//Obtener productos al presionar el botón VER MAS...
let offset = 0;
const limit = 5;

$('input').on('input', function (e) { 
    e.preventDefault();
    $(this).removeClass('bg-danger-subtle border-danger');
});

$('body').on('click', '.btn_verMas', function (e) {
    e.preventDefault();
    let inputValue = $('.input-search').val();
    offset += limit;
    getProducts(inputValue, offset, limit);
});

$('body').on('click', '#btn-search', function(e){
    e.preventDefault()
    $('.cards_products').html('');
    let inputValue = $('.input-search').val();
    offset = 0;
    getProducts(inputValue, offset, limit);
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




