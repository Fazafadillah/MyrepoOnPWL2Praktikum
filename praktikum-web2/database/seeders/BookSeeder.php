<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('books')->insert([
            'title' => 'Buku 1',
            'author' => 'penulis 1',
            'year' => 2025,
            'publisher' => 'Labtif',
            'city' => 'Cianjur',
            'cover' => 'kosong',
            'bookshelf_id' => 1,
        ]);

        DB::table('books')->insert([
            'title' => 'Buku 2',
            'author' => 'penulis 2',
            'year' => 2026,
            'publisher' => 'Labtif',
            'city' => 'Cianjur',
            'cover' => 'kosong',
            'bookshelf_id' => 1,
        ]);
    }
}
