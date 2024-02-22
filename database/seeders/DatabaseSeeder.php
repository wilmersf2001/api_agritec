<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'nombres' => 'Wilmer Yoel',
            'apellidos' => 'Suclupe Farroñan',
            'email' => 'wsuclupef@gmail.com',
            'telefono' => '987654321',
            'usuario' => 'wsuclupef',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
        ]);
        \App\Models\User::factory()->create([
            'nombres' => 'Jonathan',
            'apellidos' => 'Solis Chozo',
            'email' => 'jsolisch@gmail.com',
            'telefono' => '987654300',
            'usuario' => 'jsolisch',
            'password' => bcrypt('12345678'),
            'role' => 'cliente',
        ]);
        \App\Models\User::factory()->create([
            'nombres' => 'Luis',
            'apellidos' => 'Perez Perez',
            'email' => 'lperezp@gmail.com',
            'telefono' => '987654322',
            'usuario' => 'lperezp',
            'password' => bcrypt('12345678'),
            'role' => 'cliente',
        ]);
    }
}
