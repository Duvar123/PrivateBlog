<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $usuarioId = DB::table('roles')->where('nombre', 'Usuario')->value('id');

        Schema::table('users', function (Blueprint $table) use ($usuarioId) {
            $table->foreignId('role_id')
                  ->default($usuarioId)
                  ->after('avatar')
                  ->constrained('roles')
                  ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
};
