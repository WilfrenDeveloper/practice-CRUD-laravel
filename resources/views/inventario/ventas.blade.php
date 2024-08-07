@extends('../plantillaBase')
@section('ventas')
    <div style="display: flex; justify-content:center; align-items:center; flex-direction:column">
        <h1>Ventas</h1>
        <table style="border: 1px solid gray">
            <thead  style="background-color: black; color:white; text-aling:center;" >
                <th style="padding: 10px">factura</th>
                <th style="padding: 10px">producto</th>
                <th style="padding: 10px">marca</th>
                <th style="padding: 10px">modelo</th>
                <th style="padding: 10px">nombre del cliente</th>
                <th style="padding: 10px">fecha de venta</th>
                <th style="padding: 10px">imagen</th>
            </thead>
            <tbody>
                @foreach ($facturas as $factura)
                @if (isset($factura->productoDeLaFactura[0]))
                    <tr>
                        <td>{{$factura->codigo}}</td>
                        <td>{{$factura->productoDeLaFactura[0]->producto}}</td>
                        <td>{{$factura->productoDeLaFactura[0]->marca}}</td>
                        <td>{{$factura->productoDeLaFactura[0]->modelo}}</td>
                        <td>{{$factura->clienteDeLaFactura[0]->nombre ?? ''}} {{$factura->clienteDeLaFactura[0]->apellido ?? ''}}</td>
                        <td>{{$factura->fecha_de_compra}}</td>
                        <td style="display:flex; justify-content:center; align-items:center">
                            <img src="/imagen/{{$factura->productoDeLaFactura[0]->imagen}}" alt="imagendelproducto" style="width:50px">
                        </td>
                    </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>

@endsection