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
            'email' => 'arielmejiadev@gmail.com',
            'name' => 'Ariel Mejia',
        ]);

        User::factory()->create([
            'email' => 'john@doe.com',
            'name' => 'John Doe',
        ]);

        User::factory()->count(5)->create();
    }
}
