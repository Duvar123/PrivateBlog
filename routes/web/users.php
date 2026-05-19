<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [UserController::class, 'index'])
    ->name('dashboard')
    ->middleware('authorized:showUsers');

Route::get('/users/create', [UserController::class, 'create'])
    ->name('users.create')
    ->middleware('authorized:createUsers');

Route::post('/users', [UserController::class, 'store'])
    ->name('users.store')
    ->middleware('authorized:createUsers');

Route::get('/users/{user}/edit', [UserController::class, 'edit'])
    ->name('users.edit')
    ->middleware('authorized:updateUsers');

Route::put('/users/{user}', [UserController::class, 'update'])
    ->name('users.update')
    ->middleware('authorized:updateUsers');

Route::delete('/users/{user}', [UserController::class, 'destroy'])
    ->name('users.destroy')
    ->middleware('authorized:deleteUsers');
