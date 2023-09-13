<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'last_name' => 'admin',
            'role_id' => 1,
            'email' => 'admin@gmail.com',
            'password' => '12345'
        ]);
    }
}
