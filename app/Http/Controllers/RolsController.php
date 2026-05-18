<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;


class RolsController extends Controller{
    public function showRols()
    {
        $rols = Rol::all();
        return view('roles/rols', compact('rols'));
    }
}