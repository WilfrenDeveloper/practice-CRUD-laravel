<?php

use App\Http\Controllers\CartProductoController;
use App\Http\Controllers\ProductosFacturasController;
use App\Http\Controllers\FacturasController;
use App\Http\Controllers\ProductoController;
use App\Models\Cliente;
use App\Models\ProductosFacturas;
use Illuminate\Support\Facades\Route;

Route::resource('/', 'App\Http\Controllers\ProductosFacturasController');

Route::resource('/inventario', 'App\Http\Controllers\ProductoController');

Route::get('/ventas', 'App\Http\Controllers\FacturasController@index');

Route::get('/facturas/ventas', 'App\Http\Controllers\FacturasController@getAllFacturas');

Route::resource('/productos', 'App\Http\Controllers\ProductoController');

Route::put('/productos/{id}/update', [ProductoController::class, 'update']);

Route::resource('/clientes', 'App\Http\Controllers\ClienteController');

Route::resource('/facturas', 'App\Http\Controllers\FacturasController');

Route::get('/crearcliente', 'App\Http\Controllers\ClienteController@create');

Route::get('/getproducts', [ProductoController::class, 'getProducts']);

Route::post('/generarfactura', [FacturasController::class, 'generarFacturaOfCart']);

Route::get('/metodoDePago', 'App\Http\Controllers\MetodoDePagoController@getAll');
