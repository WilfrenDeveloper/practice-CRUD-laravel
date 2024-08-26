
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" style="width:650px">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Carrito de Compras</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body container_productsOfCart">
        
        <table class="table table-striped table-bordered" style="font-size:13px">
            <thead class="table-dark">
                <tr style="text-align: center">
                    <th scope="col">Imagen</th>
                    <th scope="col">Producto</th>   
                    <th scope="col">Precio Unidad</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Descuento %</th>
                    <th scope="col">Precio Total</th>
                </tr>
            </thead>
            <tbody>   
            </tbody>
        </table>

    </div>

    <div class="ms-3 d-flex justify-content-between">
        <div>
            <h6>Total items = <strong class="totalItemsOfCart">0</strong></h6> 
            <h5>Precio total: <strong class="totalPriceOfCart">0</strong></h5>
        </div>
        <!-- Button trigger modal -->
        <button class="btn_cartProducts-comprar btn btn-primary"  style="height: 40px">
            Comprar
        </button>
    </div>
</div>
    
<script src="{{asset('js/cart/productOfCart.js')}}"></script>
