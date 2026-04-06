<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'npm' => '5520122001',
            'username' => 'admin',
            'first_name' => 'Admin',
            'last_name' => 'System',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Faker (50 data)
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 50; $i++) {
            DB::table('users')->insert([
                'npm' => $faker->unique()->numerify('##########'),
                'username' => $faker->userName,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
