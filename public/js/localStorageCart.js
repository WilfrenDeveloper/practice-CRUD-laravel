function localStorageCart(id, producto, marca, modelo, imagen){

    //obtener el carrito del localStorage y en caso que no exista vamos a crear uno
    const getItemCart = localStorage.getItem('cart');
    const arrayCart = JSON.parse(getItemCart) || [];

    const matched = arrayCart.find((product) => product.productId === id);

    if(matched){
        matched.quantity++
    } else {
        arrayCart.push({ 
            productId: id, 
            producto,
            marca,
            modelo,
            imagen,
            quantity: 1 });
    }

    const arrayJSON = JSON.stringify(arrayCart);
    localStorage.setItem('cart', arrayJSON);

    addToCart();
    return;
}

function deleteElementOfLocalStorage(id){
    const getItemCart = localStorage.getItem('cart');
    const arrayCart = JSON.parse(getItemCart);

    const newArrayCart = arrayCart.filter((product) => product.productId !== id);

    const arrayJSON = JSON.stringify(newArrayCart);
    localStorage.setItem('cart', arrayJSON);

    addToCart();
}