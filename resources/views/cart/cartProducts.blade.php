
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" style="width:650px">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Carrito de Compras</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body container_productsOfCart">
        
        <table class="table table-striped table-bordered" style="font-size:13px">
            <thead class="table-dark">
                <tr style="text-align: center">
                    <th scope="col" style="width: 35px">Imagen</th>
                    <th scope="col" style="width: 100px">Producto</th>   
                    <th scope="col" style="width: 50px">Precio Unidad</th>
                    <th scope="col" style="width: 40px">Cantidad</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col" >Descuento %</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>   
            </tbody>
        </table>

    </div>

    <div class="ms-3 d-flex justify-content-between me-3 mb-2">
        <div style="font-size: 13px">
            <p class="m-0">Total items = <strong class="totalItemsOfCart">0</strong></p>
            <p class="m-0">Total bruto = <strong class="totalBrutoOfCart">0</strong></p>
            <p class="m-0">Subtotal = <strong class="totalSubtotalOfCart">0</strong></p> 
            <p class="m-0">Total descuentos = <strong class="totalDescOfCart">0</strong></p>
        </div>
        <!-- Button trigger modal -->
        <div class="position-relative">
            <p class="m-0">Precio total: <strong class="totalPriceOfCart" style="font-size: 20px">0</strong></p>
            <button class="btn_cartProducts-comprar btn btn-primary btn_generarFactura_cancel right-0 position-absolute end-0" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" style="height: 40px; display:none">
                Comprar
            </button>
        </div>

        
    </div>
    
    
    
</div>
@include('facturas/generarFactura')
    
<script src="{{asset('js/cart/cartProducts.js')}}"></script>
