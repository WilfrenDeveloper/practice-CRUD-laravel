function localStorageCart(product){
    const productId = product.id;
    const producto = product.producto;
    const marca = product.marca;
    const modelo = product.modelo;
    const precio = product.precio;
    const imagen = product.imagen;

    //obtener el carrito del localStorage y en caso que no exista vamos a crear uno
    const getItemCart = localStorage.getItem('cart');
    const arrayCart = JSON.parse(getItemCart) || [];

    const productMatched = arrayCart.find((product) => product.productId === productId);
    const addProductToLocalStorage = {productId, producto, marca, modelo, precio, descuento: 0, imagen, quantity:1};

    if(productMatched){
        productMatched.quantity++;
        updateProductOfCart(productMatched);
    } else {
        arrayCart.push(addProductToLocalStorage);
        addProductToCart(addProductToLocalStorage);
    }

    const arrayJSON = JSON.stringify(arrayCart);
    localStorage.setItem('cart', arrayJSON);

    return arrayCart.length;
}

function editElementOfLocalStorage(id){

    const quantityOfProduct = $(`.tr_product_${id}`).find('.productOfCart_product_quantity').val();
    const descOfProduct = $(`.tr_product_${id}`).find('.productOfCart_descuento').val();

    const getItemCart = localStorage.getItem('cart');
    const arrayCart = JSON.parse(getItemCart);

    const elementOfCart = arrayCart.find((product) => product.productId === id);
    
    let cantidad = parseInt(quantityOfProduct.replace(/,/g, ''), 10) || 0;
    let descuento = parseFloat(descOfProduct.replace(/,/g, ''));
    
    if(elementOfCart){
        elementOfCart.quantity = cantidad;
        elementOfCart.descuento = descuento;
    }

    const arrayJSON = JSON.stringify(arrayCart);
    localStorage.setItem('cart', arrayJSON);
}

function deleteElementOfLocalStorage(id){
    const getItemCart = localStorage.getItem('cart');
    const arrayCart = JSON.parse(getItemCart);

    const newArrayCart = arrayCart.filter((product) => product.productId !== id);

    const arrayJSON = JSON.stringify(newArrayCart);
    localStorage.setItem('cart', arrayJSON);
    
    return arrayCart.length;
}