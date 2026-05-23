<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlottingSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['name' => 'ITPT', 'location' => 'Toraja', 'max_capacity' => 30],
            ['name' => 'IRPT', 'location' => 'Toraja', 'max_capacity' => 30],
            ['name' => 'ITPR', 'location' => 'Makassar', 'max_capacity' => 30],
            ['name' => 'IRPR', 'location' => 'Makassar', 'max_capacity' => 30],
        ];

        DB::table('plottings')->insert($data);
    }
}