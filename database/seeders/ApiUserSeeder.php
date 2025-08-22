<?php

namespace Database\Seeders;

use App\Models\ApiUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApiUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ApiUser::create([
            'username' => 'test',
            'password' => bcrypt('password123'), // Use bcrypt for password hashing
        ]);
    }
}
