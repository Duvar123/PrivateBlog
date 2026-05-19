<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Rol;
use App\Models\RolPermission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RolsController extends Controller
{
    public function showRols(Request $request)
    {
        $filter = $request->input('filter', '');

        $recordsPerPage = 10;
        if (!empty($request->records_per_page)) {
            $recordsPerPage = (int) $request->records_per_page;
            if ($recordsPerPage > 50) {
                $recordsPerPage = 50;
            }
        }

        $query = Rol::query()->orderBy('id');

        if ($filter !== '') {
            $query->where('name', 'LIKE', '%'.$filter.'%');
        }

        $rols = $query->paginate($recordsPerPage);

        return view('roles.rols', [
            'rols' => $rols,
            'data' => $request,
        ]);
    }

    public function create()
    {
        $modules = Permission::all()->groupBy('module');

        return view('roles.create', compact('modules'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:64', 'unique:rols,name'],
            'permissions' => ['required', 'json'],
        ], [
            'permissions.required' => 'Debe seleccionar al menos 1 permiso.',
        ]);

        $rol = new Rol();
        $rol->name = trim($data['name']);
        $rol->save();

        $this->syncPermissionsFromJson($rol, $data['permissions']);

        return redirect()->route('roles.index')->with('success', 'Rol creado.');
    }

    public function edit(Rol $rol)
    {
        $permissions = Permission::all()->map(function ($item) use ($rol) {
            $item->selected = RolPermission::where('permission_id', $item->id)
                ->where('rol_id', $rol->id)
                ->exists();

            return $item;
        });

        $modules = $permissions->groupBy('module');

        return view('roles.edit', compact('rol', 'modules'));
    }

    public function update(Request $request, Rol $rol)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:64', Rule::unique('rols', 'name')->ignore($rol->id)],
            'permissions' => ['required', 'json'],
        ], [
            'permissions.required' => 'Debe seleccionar al menos 1 permiso.',
        ]);

        $rol->name = trim($data['name']);
        $rol->save();

        $this->syncPermissionsFromJson($rol, $data['permissions']);

        return redirect()->route('roles.index')->with('success', 'Rol actualizado.');
    }

    public function destroy(Rol $rol)
    {
        if (in_array($rol->name, ['admin', 'cliente', 'vendedor'], true)) {
            return redirect()->route('roles.index')->with('error', 'No puedes borrar los roles del sistema.');
        }

        if (User::where('rol_id', $rol->id)->exists()) {
            return redirect()->route('roles.index')->with('error', 'Hay usuarios con este rol.');
        }

        DB::table('rol_permissions')->where('rol_id', $rol->id)->delete();
        $rol->delete();

        return redirect()->route('roles.index')->with('success', 'Rol eliminado.');
    }

    private function syncPermissionsFromJson(Rol $rol, string $permissionsJson): void
    {
        $permissionIds = json_decode($permissionsJson, true);
        if (!is_array($permissionIds)) {
            $permissionIds = [];
        }

        DB::table('rol_permissions')->where('rol_id', $rol->id)->delete();

        foreach ($permissionIds as $permissionId) {
            DB::table('rol_permissions')->insert([
                'rol_id' => $rol->id,
                'permission_id' => (int) $permissionId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
