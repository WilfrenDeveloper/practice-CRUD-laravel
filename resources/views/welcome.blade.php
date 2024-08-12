@extends('plantillaBase')
@section('welcome')

    <form class="form_search" action="{{ url('/') }}">
        <input class="input" id="search" name="search"  type="search" style="width: 300px">
        <button type="submit" style="border-style:none;  padding: 12px 30px; color:white; background-color:#00c7c2"> Buscar </button>
    </form>

    <div style="display:flex; align-items:center; gap:10px">
        @if ($message != "")
            <i class='bx bx-error-circle' style='font-size: 30px;color:#d90000;'></i>  
            <p style="font-size: 20px">{{$message}}</p>
        @endif
    </div>

    <div style="display: flex; gap:10px; flex-wrap: wrap; justify-content:center; position:relative;">
        @foreach ($productos as $product)
        <div class="card_product" style="">
            <figure class="figure" style="">
                <img class="img_product" src="/imagen/{{$product->imagen}}" alt="" style="">
            </figure>
            <hr>
            <div style="height: 180px; position:relative">
                <h3>{{$product->nombre}} {{$product->marca}} {{$product->modelo}}</h3>
                <p style="opacity: 0.6">Sistema Operativo:</p>
                <p style="margin-top:-15px;">{{$product->sistema}}</p>

                <a class="a_button" href="/generarfactura/{{$product->id}}" style="position:absolute; bottom:0px;border-style:none; border-radius:10px; padding:5px 20px 5px 20px; background-color:#00c7c2 "  style="width: 22px">
                    <i class='bx bx-cart'></i>
                </a>
            </div>
        </div>
        @endforeach
    </div>
@endsection
