<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BebidasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('bebidas')->insert([
            [
                'nombre' => 'Coca-Cola',
                'tipo' => 'Refresco',
                'imagen' => 'coca-cola.jpg',
            ],
            [
                'nombre' => 'Pepsi',
                'tipo' => 'Refresco',
                'imagen' => 'pepsi.jpg',
            ],
            [
                'nombre' => 'Jugo de Naranja',
                'tipo' => 'Jugo',
                'imagen' => 'jugo-naranja.jpg',
            ],
            // Agrega más bebidas según sea necesario
        ]);
    }
}
