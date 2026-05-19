<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::query()->with('categoria')->orderBy('id')->get();

        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::query()->orderBy('nombre')->get();

        return view('productos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:180'],
            'categoria_id' => ['required', 'integer', 'exists:categorias,id'],
        ]);

        Producto::create([
            'nombre' => trim($data['nombre']),
            'categoria_id' => (int) $data['categoria_id'],
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto creado.');
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::query()->orderBy('nombre')->get();

        return view('productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, Producto $producto)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:180'],
            'categoria_id' => ['required', 'integer', 'exists:categorias,id'],
        ]);

        $producto->nombre = trim($data['nombre']);
        $producto->categoria_id = (int) $data['categoria_id'];
        $producto->save();

        return redirect()->route('productos.index')->with('success', 'Producto actualizado.');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado.');
    }
}
