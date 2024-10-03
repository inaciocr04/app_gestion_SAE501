<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'gestionnaire',
            'email' => 'gestionnaire@unistra.fr',
            'password' => 'password',
            'role' => 'manager'
        ]);
        User::factory()->create([
            'name' => 'jean ferry',
            'email' => 'jean.ferry@unistra.fr',
            'password' => 'password',
            'role' => 'teacher'
        ]);
        User::factory()->create([
            'name' => 'inacio rodrigues',
            'email' => 'inacio.rodrigues@etu.unistra.fr',
            'password' => 'password',
            'role' => 'student',
        ]);
    }
}
