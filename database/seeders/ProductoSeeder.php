<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $productosPorCategoria = [
            'Bebidas' => [
                'Agua Mineral',
                'Jugo de Naranja',
            ],
            'Snacks' => [
                'Papas Fritas',
                'Galletas Saladas',
            ],
            'Lácteos' => [
                'Yogur Natural',
                'Leche Entera 1L',
            ],
            'Frutas' => [
                'Manzana Roja',
                'Plátano',
            ],
        ];

        foreach ($productosPorCategoria as $nombreCategoria => $productos) {
            $categoria = Categoria::where('nombre', $nombreCategoria)->first();

            if ($categoria) {
                foreach ($productos as $nombreProducto) {
                    Producto::firstOrCreate([
                        'nombre' => $nombreProducto,
                        'categoria_id' => $categoria->id,
                    ]);
                }
            }
        }
    }
}
