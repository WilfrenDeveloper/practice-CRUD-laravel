function localStorageCart(product, operation = 'plus'){
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
    const addProductToLocalStorage = {productId, producto, marca, modelo, precio, imagen, quantity:1};

    if(productMatched){
        switch(operation){
            case ('plus'):
                productMatched.quantity++;
                updateProductOfCart(productMatched);
                break;
            case ('minus'):
                productMatched.quantity--;
                updateProductOfCart(productMatched);
                break;
            default:
                productMatched.quantity = operation;
                updateProductOfCart(productMatched);
                break;
        }
    } else {
        arrayCart.push(addProductToLocalStorage);
        addProductToCart(addProductToLocalStorage);
    }

    const arrayJSON = JSON.stringify(arrayCart);
    localStorage.setItem('cart', arrayJSON);

    return arrayCart.length;
}

function deleteElementOfLocalStorage(id){
    const getItemCart = localStorage.getItem('cart');
    const arrayCart = JSON.parse(getItemCart);

    const newArrayCart = arrayCart.filter((product) => product.productId !== id);

    const arrayJSON = JSON.stringify(newArrayCart);
    localStorage.setItem('cart', arrayJSON);
    

    return arrayCart.length;
}