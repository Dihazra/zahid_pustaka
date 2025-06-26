<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('zahid_categories')->insert([
            [
                'name' => 'Fiksi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Non-Fiksi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fantasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Biografi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sejarah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Teknologi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sains',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kesehatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pendidikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Agama',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Seni',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Psikologi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ekonomi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Politik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hukum',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lingkungan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Olahraga',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Travel',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Makanan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hobi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Komik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Misteri',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Petualangan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Romansa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Thriller',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Klasik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Modern',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Anak-anak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Remaja',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dewasa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lainnya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
