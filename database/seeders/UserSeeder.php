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
        User::factory(1)->create([
            'name' => 'admin',
            'email' => 'talalminfo@gmail.com',
            'password' => bcrypt('1234'),
        ]);
        User::factory(29)->create();
    }
}
