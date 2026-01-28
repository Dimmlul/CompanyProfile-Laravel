<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $dir = 'articles';

        if (!Storage::disk('public')->exists($dir)) {
            Storage::disk('public')->makeDirectory($dir);
        }

        // Copy assets satu per satu (TANPA foreach)
        Storage::disk('public')->put(
            'articles/1.jpeg',
            File::get(database_path('seeders/assets/articles/1.jpeg'))
        );

        Storage::disk('public')->put(
            'articles/2.jpg',
            File::get(database_path('seeders/assets/articles/2.jpg'))
        );

        Storage::disk('public')->put(
            'articles/3.webp',
            File::get(database_path('seeders/assets/articles/3.webp'))
        );

        Storage::disk('public')->put(
            'articles/4.png',
            File::get(database_path('seeders/assets/articles/4.png'))
        );

        Storage::disk('public')->put(
            'articles/5.png',
            File::get(database_path('seeders/assets/articles/5.png'))
        );

        Storage::disk('public')->put(
            'articles/6.jpg',
            File::get(database_path('seeders/assets/articles/6.jpg'))
        );

        Storage::disk('public')->put(
            'articles/7.webp',
            File::get(database_path('seeders/assets/articles/7.webp'))
        );

        Storage::disk('public')->put(
            'articles/8.png',
            File::get(database_path('seeders/assets/articles/8.png'))
        );

        // ==== DATA ARTIKEL ====

        Article::create([
            'title' => 'The Importance of Digital Presence for Modern Businesses',
            'content' => 'Digital presence is essential for building credibility and reaching customers.',
            'thumbnail' => 'articles/1.jpeg',
            'author' => 'Nexora Studio Digital',
            'is_published' => true,
            'published_at' => Carbon::now()->subDays(10),
        ]);

        Article::create([
            'title' => 'Why UI/UX Design Impacts User Trust',
            'content' => 'Good UI/UX design builds confidence and improves user satisfaction.',
            'thumbnail' => 'articles/2.jpg',
            'author' => 'Nexora Studio Digital',
            'is_published' => true,
            'published_at' => Carbon::now()->subDays(12),
        ]);

        Article::create([
            'title' => 'Scalable Web Applications for Growing Companies',
            'content' => 'Scalability ensures long-term performance and growth.',
            'thumbnail' => 'articles/3.webp',
            'author' => 'Nexora Studio Digital',
            'is_published' => true,
            'published_at' => Carbon::now()->subDays(15),
        ]);

        Article::create([
            'title' => 'Choosing the Right Tech Stack for Startups',
            'content' => 'The right tech stack affects development speed and maintenance.',
            'thumbnail' => 'articles/4.png',
            'author' => 'Nexora Studio Digital',
            'is_published' => true,
            'published_at' => Carbon::now()->subDays(18),
        ]);

        Article::create([
            'title' => 'How Landing Pages Increase Conversion Rates',
            'content' => 'Effective landing pages guide users toward actions.',
            'thumbnail' => 'articles/5.png',
            'author' => 'Nexora Studio Digital',
            'is_published' => true,
            'published_at' => Carbon::now()->subDays(20),
        ]);

        Article::create([
            'title' => 'Digital Transformation for SMEs',
            'content' => 'SMEs can grow faster through digital transformation.',
            'thumbnail' => 'articles/6.jpg',
            'author' => 'Nexora Studio Digital',
            'is_published' => true,
            'published_at' => Carbon::now()->subDays(22),
        ]);

        Article::create([
            'title' => 'Security Best Practices in Web Development',
            'content' => 'Security must be integrated from the beginning.',
            'thumbnail' => 'articles/7.webp',
            'author' => 'Nexora Studio Digital',
            'is_published' => true,
            'published_at' => Carbon::now()->subDays(25),
        ]);

        Article::create([
            'title' => 'Future Trends in Digital Product Development',
            'content' => 'Technology trends shape digital product innovation.',
            'thumbnail' => 'articles/8.png',
            'author' => 'Nexora Studio Digital',
            'is_published' => true,
            'published_at' => Carbon::now()->subDays(30),
        ]);
    }
}
