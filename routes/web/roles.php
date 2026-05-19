<?php

use App\Http\Controllers\RolsController;
use Illuminate\Support\Facades\Route;

Route::get('/roles', [RolsController::class, 'showRols'])
    ->name('roles.index')
    ->middleware('authorized:showRoles');

Route::get('/roles/create', [RolsController::class, 'create'])
    ->name('roles.create')
    ->middleware('authorized:createRoles');

Route::post('/roles', [RolsController::class, 'store'])
    ->name('roles.store')
    ->middleware('authorized:createRoles');

Route::get('/roles/{rol}/edit', [RolsController::class, 'edit'])
    ->name('roles.edit')
    ->middleware('authorized:updateRoles');

Route::put('/roles/{rol}', [RolsController::class, 'update'])
    ->name('roles.update')
    ->middleware('authorized:updateRoles');

Route::delete('/roles/{rol}', [RolsController::class, 'destroy'])
    ->name('roles.destroy')
    ->middleware('authorized:deleteRoles');
