<?php

use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::get('/productos', [ProductoController::class, 'index'])
    ->name('productos.index')
    ->middleware('authorized:showProductos');

Route::get('/productos/create', [ProductoController::class, 'create'])
    ->name('productos.create')
    ->middleware('authorized:createProductos');

Route::post('/productos', [ProductoController::class, 'store'])
    ->name('productos.store')
    ->middleware('authorized:createProductos');

Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])
    ->name('productos.edit')
    ->middleware('authorized:updateProductos');

Route::put('/productos/{producto}', [ProductoController::class, 'update'])
    ->name('productos.update')
    ->middleware('authorized:updateProductos');

Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])
    ->name('productos.destroy')
    ->middleware('authorized:deleteProductos');
