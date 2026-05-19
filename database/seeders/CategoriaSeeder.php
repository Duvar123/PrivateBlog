<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Bebidas'],
            ['nombre' => 'Snacks'],
            ['nombre' => 'Lácteos'],
            ['nombre' => 'Frutas'],
        ];

        foreach ($categorias as $categoria) {
            Categoria::firstOrCreate($categoria);
        }
    }
}
