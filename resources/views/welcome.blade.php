@extends('plantillaBase')
@section('welcome')

    <form action="{{ url('/') }}" style="margin-bottom: 20px">
        <input class="input" id="search" name="search"  type="text" style="width: 300px">
        <button type="submit" style="border-style:none;  padding: 12px 30px; color:white; background-color:rgb(55, 168, 205)"> Buscar </button>
    </form>

    <div style="display: flex; gap:10px; flex-wrap: wrap; justify-content:center">
        @foreach ($productos as $product)
        <div style="width:220px; padding: 20px; border: solid rgb(218, 218, 218) 1px; border-radius:15px; background-color:white">
            <figure style="width: 150px; height: 180px; display:flex; align-items:center">
                <img src="/imagen/{{$product->imagen}}" alt="" style="width: 150px">
            </figure>
            <hr>
            <div style="height: 180px; position:relative">
                <h3>{{$product->nombre}} {{$product->marca}} {{$product->modelo}}</h3>
                <p style="opacity: 0.6">Sistema Operativo:</p>
                <p style="margin-top:-15px;">{{$product->sistema}}</p>

                <a class="a_button" href="/generarfactura/{{$product->id}}" style="position:absolute; bottom:0px;border-style:none; border-radius:10px; padding:5px 20px 5px 20px; background-color:rgb(57, 179, 255)"  style="width: 22px">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAjpJREFUWEftlz1yFDEQhbunYNW6A1XYJJA44QR2QsoR2E0g4wRQQMEJyCDZvQIpCT4BCQkksFRxB0kLNQ1yzVAaeTSS2uMtB950Wq2v3usfLcIV++EV44FroJwjA4WMMS+jAxut9TaXZM7vAyBrLcfJmfmV1joGnZNhkCsL5KOZeaW13lwaRZA4aVnTNLeZednFnhLRyd6BwguNMQeI+AkADjqVDvdRT5Nt75xb9yrtq5YmgYwxx51KZ+J5qJlt8x18GiqfHYzW2h+9bTPD9OkG9ZkF8rMJEV9cEoxPuyWiwz5/FsgHhioh4qZt258XAUTER0GzDOZcEVBY3B5IKbWSAnXd68ugr8tB9xYBjRS3eAREJTCwyxMWAcW2XWQEhPaP5SkGMsYsEXHdKb1l5pPaQRnbRUTn7i8GGlGper+FdqVqsQoo8r96v4WvidTCrgUS77fIrnPFXDWHwhaX7rfSc1UKeTDpfgunPTMnx0Y1UFzcggGZtKtqDkVvJfF+y80wkUK9df+eDseVCm1zT2ExUCVIcbgYyFr7DhFXzPwdAJ4S0cexW621DwDgLSLeYeY1ET2ZohMB7Xa7Zdu2/Rrx+b8R0b0E0FcAuNt/a5pmtVgskv9gREDOuWfM/Pr/MEP8rZRajAE553bMfDOIfa6UepNSSQp0xMyfAeBGl/h9ygpvLQA87uL+IOJ9pdSXWYF8MufcEQA8RMRfUxb4WG8xM98CgA9TMOI5VNwygkCRZYJ7io9cA+Wk+guIsy80ApawDwAAAABJRU5ErkJggg=="/>
                </a>
            </div>
        </div>
        @endforeach
    </div>
@endsection
