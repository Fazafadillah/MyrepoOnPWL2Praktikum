<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['category' => 'Knowladge'],
            ['category' => 'Fiction'],
            ['category' => 'Non-Fiction'],
            ['category' => 'Action'],
        ];

        DB::table('categories')->insert($data);
    }
}
