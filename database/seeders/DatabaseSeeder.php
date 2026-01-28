<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CompanyProfileSeeder::class,
            ArticleSeeder::class,
            ProductSeeder::class,
            EventSeeder::class,
            ClientSeeder::class,
            GallerySeeder::class,
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
        ]);
    }
}
