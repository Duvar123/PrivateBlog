<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRol = Rol::where('name', 'admin')->first();
        if (empty($adminRol)) {
            $adminRol = new Rol();
            $adminRol->name = 'admin';
            $adminRol->save();
        }

        $clienteRol = Rol::where('name', 'cliente')->first();
        if (empty($clienteRol)) {
            $clienteRol = new Rol();
            $clienteRol->name = 'cliente';
            $clienteRol->save();
        }

        $vendedorRol = Rol::where('name', 'vendedor')->first();
        if (empty($vendedorRol)) {
            $vendedorRol = new Rol();
            $vendedorRol->name = 'vendedor';
            $vendedorRol->save();
        }

        foreach (Permission::all() as $permission) {
            $yaExiste = DB::table('rol_permissions')
                ->where('rol_id', $adminRol->id)
                ->where('permission_id', $permission->id)
                ->first();

            if (empty($yaExiste)) {
                DB::table('rol_permissions')->insert([
                    'rol_id' => $adminRol->id,
                    'permission_id' => $permission->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $user = User::where('email', 'admin@local.test')->first();
        if (empty($user)) {
            $user = new User();
            $user->name = 'Admin Demo';
            $user->email = 'admin@local.test';
            $user->password = Hash::make('admin1234');
            $user->rol_id = $adminRol->id;
            $user->save();
        }

        $vendedorPermissionNames = [
            'showProductos',
            'createProductos',
            'updateProductos',
        ];

        foreach ($vendedorPermissionNames as $permissionName) {
            $permission = Permission::where('name', $permissionName)->first();
            if (empty($permission)) {
                continue;
            }

            $yaExiste = DB::table('rol_permissions')
                ->where('rol_id', $vendedorRol->id)
                ->where('permission_id', $permission->id)
                ->first();

            if (empty($yaExiste)) {
                DB::table('rol_permissions')->insert([
                    'rol_id' => $vendedorRol->id,
                    'permission_id' => $permission->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $user = User::where('email', 'vendedor@local.test')->first();
        if (empty($user)) {
            $user = new User();
            $user->name = 'Vendedor Demo';
            $user->email = 'vendedor@local.test';
            $user->password = Hash::make('vendedor1234');
            $user->rol_id = $vendedorRol->id;
            $user->save();
        }

        $user = User::where('email', 'juan.perez@local.test')->first();
        if (empty($user)) {
            $user = new User();
            $user->name = 'Juan Pérez';
            $user->email = 'juan.perez@local.test';
            $user->password = Hash::make('cliente1234');
            $user->rol_id = $clienteRol->id;
            $user->save();
        }
    }
}
