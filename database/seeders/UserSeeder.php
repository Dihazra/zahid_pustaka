<?php

namespace Database\Seeders;
use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
    DB::table('zahid_users')->insert([
            [
                'name' => 'anggota',
                'email' => 'test@gmail.com',
                'password' => bcrypt('password'),
                'phone' => '0987867',
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'),
                'phone' => '0987867',
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
