<?php

use Illuminate\Support\Facades\Route;

require __DIR__.'/web/home.php';
require __DIR__.'/web/auth.php';

Route::middleware('auth')->group(function () {
    require __DIR__.'/web/users.php';
    require __DIR__.'/web/roles.php';
    require __DIR__.'/web/categorias.php';
    require __DIR__.'/web/productos.php';
});
