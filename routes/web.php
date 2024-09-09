<?php

use App\Http\Controllers\CartProductoController;
use App\Http\Controllers\ProductosFacturasController;
use App\Http\Controllers\FacturasController;
use App\Http\Controllers\ProductoController;
use App\Models\Cliente;
use App\Models\ProductosFacturas;
use Illuminate\Support\Facades\Route;

Route::resource('/', 'App\Http\Controllers\ProductosFacturasController');

Route::get('/inventario', function(){
    return view('inventario.inventario');
});

Route::post('/productos/create', 'App\Http\Controllers\ProductoController@create');

Route::post('/productos/{id}/update', [ProductoController::class, 'update']);

Route::delete('/productos/{id}/delete', [ProductoController::class, 'destroy']);



Route::get('/ventas', 'App\Http\Controllers\FacturasController@index');

Route::get('/facturas/ventas', 'App\Http\Controllers\FacturasController@getAllFacturas');



Route::get('/clientes', function(){
    return view('clientes.clientes');
});

Route::get('/clientes/all', 'App\Http\Controllers\ClienteController@index');

Route::post('/clientes/crear', 'App\Http\Controllers\ClienteController@crearNuevoCliente');

Route::put('/cliente/{id}/edit', 'App\Http\Controllers\ClienteController@update');

Route::delete('/cliente/{id}/delete', 'App\Http\Controllers\ClienteController@eliminarCliente');



Route::get('/getproducts', [ProductoController::class, 'getProducts']);

Route::post('/generarfactura', [FacturasController::class, 'generarFacturaOfCart']);

Route::get('/metodoDePago', 'App\Http\Controllers\MetodoDePagoController@getAll');
