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

    const matched = arrayCart.find((product) => product.productId === productId);

    if(matched){
        matched.quantity++
    } else {
        arrayCart.push({productId, producto, marca, modelo, precio, imagen, quantity: 1});
    }

    const arrayJSON = JSON.stringify(arrayCart);
    localStorage.setItem('cart', arrayJSON);

    addToCart();
    return arrayCart.length;
}

function deleteElementOfLocalStorage(id){
    const getItemCart = localStorage.getItem('cart');
    const arrayCart = JSON.parse(getItemCart);

    const newArrayCart = arrayCart.filter((product) => product.productId !== id);

    const arrayJSON = JSON.stringify(newArrayCart);
    localStorage.setItem('cart', arrayJSON);

    addToCart();
    return arrayCart.length;
}