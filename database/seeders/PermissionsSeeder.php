<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            ['name' => 'showCategorias', 'description' => 'Ver Categorías', 'module' => 'Categorias'],
            ['name' => 'createCategorias', 'description' => 'Crear Categorías', 'module' => 'Categorias'],
            ['name' => 'updateCategorias', 'description' => 'Editar Categorías', 'module' => 'Categorias'],
            ['name' => 'deleteCategorias', 'description' => 'Eliminar Categorías', 'module' => 'Categorias'],

            ['name' => 'showProductos', 'description' => 'Ver Productos', 'module' => 'Productos'],
            ['name' => 'createProductos', 'description' => 'Crear Productos', 'module' => 'Productos'],
            ['name' => 'updateProductos', 'description' => 'Editar Productos', 'module' => 'Productos'],
            ['name' => 'deleteProductos', 'description' => 'Eliminar Productos', 'module' => 'Productos'],

            ['name' => 'showUsers', 'description' => 'Ver Usuarios', 'module' => 'Usuarios'],
            ['name' => 'createUsers', 'description' => 'Crear Usuarios', 'module' => 'Usuarios'],
            ['name' => 'updateUsers', 'description' => 'Editar Usuarios', 'module' => 'Usuarios'],
            ['name' => 'deleteUsers', 'description' => 'Eliminar Usuarios', 'module' => 'Usuarios'],

            ['name' => 'showRoles', 'description' => 'Ver Roles', 'module' => 'Roles'],
            ['name' => 'createRoles', 'description' => 'Crear Roles', 'module' => 'Roles'],
            ['name' => 'updateRoles', 'description' => 'Editar Roles', 'module' => 'Roles'],
            ['name' => 'deleteRoles', 'description' => 'Eliminar Roles', 'module' => 'Roles'],
        ];

        foreach ($permissions as $permission) {
            $exists = Permission::where('name', $permission['name'])
                ->where('module', $permission['module'])
                ->first();

            if (!$exists) {
                $new = new Permission();
                $new->name = $permission['name'];
                $new->description = $permission['description'];
                $new->module = $permission['module'];
                $new->save();
            }
        }
    }
}
