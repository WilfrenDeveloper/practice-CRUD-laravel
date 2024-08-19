    @foreach ($productos as $product)
        <div class="card_product" style="">
            <figure class="figure" style="">
                <img class="img_product" src="/imagen/{{$product->imagen}}" alt="" style="">
            </figure>
            <hr>
            <div style="height: 180px; position:relative">
                <h3>{{$product->producto}} {{$product->marca}} {{$product->modelo}}</h3>
                <p style="opacity: 0.6">Sistema Operativo:</p>
                <p style="margin-top:-15px;">{{$product->sistema}}</p>

                <a class="a_button" href="/generarfactura/{{$product->id}}" style="position:absolute; bottom:0px;border-style:none; border-radius:10px; padding:5px 20px 5px 20px; background-color:#00c7c2 "  style="width: 22px">
                    <i class='bx bx-cart'></i>
                </a>
            </div>
        </div>
        @endforeach