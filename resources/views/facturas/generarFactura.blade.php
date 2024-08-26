
<a class="generarFactura_back" > <- back</a>    


<div style="display: flex; justify-content:center; align-items:center; flex-direction:column">    
    <h1>Realizar Compra</h1>
    <div>
        
        <div class="generarFactura_formCliente" style="padding: 20px; background-color:white">
            <form action="" method="POST" style="display: flex; flex-direction:column">
                @csrf
                <input class="generarFactura_input_idProducts" type="hidden">
                <select class="generarFactura_selectCliente form-select" aria-label="Small select example" name="id_cliente" id="id_cliente" style="padding: 5px 10px; margin-bottom:20px">
                    <option>Seleccione una opción</option>
                </select>
                
                <button type="submit" style="border-style:none; border-radius:5px;padding: 5px 30px; color:white; background-color:rgb(61, 141, 199)">Aceptar y Comprar</button>
            </form>
        </div>

        <table class="table table-striped table-bordered generarFactura_productsOfCart">
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
    <script src="{{asset('js/facturas/generarFactura.js')}}"></script>

</div>
