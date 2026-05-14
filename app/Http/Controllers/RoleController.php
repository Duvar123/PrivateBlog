<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    private const BASE_ROLES = ['Administrador', 'Usuario'];

    public function index()
    {
        $roles = Role::query()->orderBy('id')->get();

        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:120', 'unique:roles,nombre'],
        ]);

        Role::create(['nombre' => trim($data['nombre'])]);

        return redirect()->route('roles.index')->with('success', 'Rol creado.');
    }

    public function edit(Role $role)
    {
        if (in_array($role->nombre, self::BASE_ROLES, true)) {
            return redirect()->route('roles.index')
                ->with('error', 'Los roles base no se pueden modificar.');
        }

        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        if (in_array($role->nombre, self::BASE_ROLES, true)) {
            return redirect()->route('roles.index')
                ->with('error', 'Los roles base no se pueden modificar.');
        }

        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:120', Rule::unique('roles', 'nombre')->ignore($role->id)],
        ]);

        $role->nombre = trim($data['nombre']);
        $role->save();

        return redirect()->route('roles.index')->with('success', 'Rol actualizado.');
    }

    public function destroy(Role $role)
    {
        if (in_array($role->nombre, self::BASE_ROLES, true)) {
            return redirect()->route('roles.index')
                ->with('error', 'Los roles base no se pueden eliminar.');
        }

        try {
            $role->delete();
        } catch (QueryException $e) {
            return redirect()->route('roles.index')
                ->with('error', 'No se puede eliminar un rol asignado a usuarios.');
        }

        return redirect()->route('roles.index')->with('success', 'Rol eliminado.');
    }
}
