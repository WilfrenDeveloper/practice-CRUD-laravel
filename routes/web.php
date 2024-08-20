<?php

use App\Http\Controllers\ClienteProductoController;
use App\Http\Controllers\FacturasController;
use App\Http\Controllers\ProductoController;
use App\Models\ClienteProducto;
use Illuminate\Support\Facades\Route;

Route::resource('/', 'App\Http\Controllers\ClienteProductoController');

Route::get('/getproducts', [ClienteProductoController::class, 'show']);

Route::resource('/inventario', 'App\Http\Controllers\ProductoController');

Route::get('/ventas', 'App\Http\Controllers\FacturasController@index');

Route::resource('/productos', 'App\Http\Controllers\ProductoController');

Route::put('/productos/{id}/update', [ProductoController::class, 'update']);

Route::resource('/clientes', 'App\Http\Controllers\ClienteController');

Route::resource('/generarfactura', 'App\Http\Controllers\FacturasController');

Route::post('/generarfactura/{producto}', [FacturasController::class, 'store'])->name('generarfactura.store');

Route::get('/crearcliente', 'App\Http\Controllers\ClienteController@create');

Route::get('/search', [ProductoController::class, 'show']);