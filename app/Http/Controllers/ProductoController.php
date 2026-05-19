<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->input('filter', '');

        $recordsPerPage = 10;
        if (!empty($request->records_per_page)) {
            $recordsPerPage = (int) $request->records_per_page;
            if ($recordsPerPage > 50) {
                $recordsPerPage = 50;
            }
        }

        $query = Producto::query()->with('categoria')->orderBy('id');

        if ($filter !== '') {
            $query->where(function ($q) use ($filter) {
                $q->where('nombre', 'LIKE', '%'.$filter.'%')
                    ->orWhereHas('categoria', function ($q) use ($filter) {
                        $q->where('nombre', 'LIKE', '%'.$filter.'%');
                    });
            });
        }

        $productos = $query->paginate($recordsPerPage);

        return view('productos.index', [
            'productos' => $productos,
            'data' => $request,
        ]);
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
