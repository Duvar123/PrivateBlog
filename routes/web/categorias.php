<?php

use App\Http\Controllers\CategoriaController;
use Illuminate\Support\Facades\Route;

Route::get('/categorias', [CategoriaController::class, 'index'])
    ->name('categorias.index')
    ->middleware('authorized:showCategorias');

Route::get('/categorias/create', [CategoriaController::class, 'create'])
    ->name('categorias.create')
    ->middleware('authorized:createCategorias');

Route::post('/categorias', [CategoriaController::class, 'store'])
    ->name('categorias.store')
    ->middleware('authorized:createCategorias');

Route::get('/categorias/{categoria}/edit', [CategoriaController::class, 'edit'])
    ->name('categorias.edit')
    ->middleware('authorized:updateCategorias');

Route::put('/categorias/{categoria}', [CategoriaController::class, 'update'])
    ->name('categorias.update')
    ->middleware('authorized:updateCategorias');

Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy'])
    ->name('categorias.destroy')
    ->middleware('authorized:deleteCategorias');
