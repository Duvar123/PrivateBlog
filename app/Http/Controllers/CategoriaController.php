<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoriaController extends Controller
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

        $query = Categoria::query()->orderBy('id');

        if ($filter !== '') {
            $query->where('nombre', 'LIKE', '%'.$filter.'%');
        }

        $categorias = $query->paginate($recordsPerPage);

        return view('categorias.index', [
            'categorias' => $categorias,
            'data' => $request,
        ]);
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:120', 'unique:categorias,nombre'],
        ]);

        Categoria::create(['nombre' => trim($data['nombre'])]);

        return redirect()->route('categorias.index')->with('success', 'Categoría creada.');
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:120', Rule::unique('categorias', 'nombre')->ignore($categoria->id)],
        ]);

        $categoria->nombre = trim($data['nombre']);
        $categoria->save();

        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada.');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada.');
    }
}
