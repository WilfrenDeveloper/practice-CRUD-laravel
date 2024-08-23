function addToCart (){
    const getItemCart = localStorage.getItem('cart');
    const arrayCart = JSON.parse(getItemCart) || [];
    $('.offcanvas-body').html('');
    arrayCart.forEach(producto => {
        $('.offcanvas-body').append(`
            <div class="card mb-3 cart_product_${producto.productId}" style="max-width: 350px">
                <div class="row g-0">
                    <div class="col-md-4 d-flex justify-content-center align-items-center" height="100%">
                        <img src="imagen/${producto.imagen}" class="img-fluid rounded-start" alt="..." style="height:80px">
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <h6 class="card-title">${producto.producto} ${producto.marca} ${producto.modelo}</h6>
                        <div class="d-flex justify-content-between">
                            <p class="card-text"><small class="text-body-secondary">Cantidad: </small>${producto.quantity}</p>
                            <button class="btn btn-primary btn_deleteProductCart" data-id="${producto.productId}">
                                <i class='bx bxs-trash'></i>
                            </button>
                        </div>
                        <p class="card-text">Precio: <small class="text-body-secondary">5000</small></p>
                    </div>
                    </div>
                </div>
            </div>
        `);
    });
    const total = 0;
    $('.offcanvas-body').append(`
        <h5>Precio total: <strong>${total}</strong></h5>
    `)
}