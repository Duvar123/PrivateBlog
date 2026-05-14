<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRoleId = DB::table('roles')->where('nombre', 'Administrador')->value('id');

        User::updateOrCreate(
            ['email' => 'admin@local.test'],
            [
                'name' => 'Admin Demo',
                'password' => Hash::make('admin1234'),
                'role_id' => $adminRoleId,
            ],
        );
    }
}
