<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'pustakawan']);
        Role::create(['name' => 'mahasiswa']);

        User::create([
            'npm' => 001,
            'username' => 'Pustakawan',
            'first_name' => 'Pustakawan',
            'last_name' => '1',
            'email' => 'pustakawan@gmail.com',
            'password' => Hash::make('password123'),
        ])->assignRole('pustakawan');

        User::create([
            'npm' => 5520123024,
            'username' => 'Mahasiswa',
            'first_name' => 'Mahasiswa',
            'last_name' => '1',
            'email' => 'mhs1@gmail.com',
            'password' => Hash::make('password123'),
        ])->assignRole('mahasiswa');
    }
}
