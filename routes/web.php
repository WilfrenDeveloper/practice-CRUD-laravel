<?php

use App\Http\Controllers\ClienteProductoController;
use App\Http\Controllers\FacturasController;
use App\Http\Controllers\ProductoController;
use App\Models\ClienteProducto;
use Illuminate\Support\Facades\Route;

Route::resource('/', 'App\Http\Controllers\ClienteProductoController');

Route::resource('/inventario', 'App\Http\Controllers\ProductoController');

Route::get('/ventas', 'App\Http\Controllers\FacturasController@index');

Route::resource('/productos', 'App\Http\Controllers\ProductoController');

Route::put('/productos/{id}/update', [ProductoController::class, 'update']);

Route::resource('/clientes', 'App\Http\Controllers\ClienteController');

Route::resource('/facturas', 'App\Http\Controllers\FacturasController');

Route::get('/generarfactura', [FacturasController::class, 'generarFactura']);

Route::get('/crearcliente', 'App\Http\Controllers\ClienteController@create');

Route::get('/getproducts', [ProductoController::class, 'getProducts']);