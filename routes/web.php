<?php

use Illuminate\Support\Facades\Route;

Route::resource('/', 'App\Http\Controllers\ClienteProductoController');

Route::resource('/inventario', 'App\Http\Controllers\ProductoController');

Route::get('/ventas', 'App\Http\Controllers\FacturasController@index');

Route::get('/crearproducto', 'App\Http\Controllers\ProductoController@create');

Route::resource('/clientes', 'App\Http\Controllers\ClienteController');

Route::resource('/generarfactura', 'App\Http\Controllers\FacturasController');

Route::get('/crearcliente', 'App\Http\Controllers\ClienteController@create');