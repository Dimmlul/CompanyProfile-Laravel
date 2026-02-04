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

        // Copy assets
        Storage::disk('public')->put('articles/1.jpeg', File::get(database_path('seeders/assets/articles/1.jpeg')));
        Storage::disk('public')->put('articles/2.jpg', File::get(database_path('seeders/assets/articles/2.jpg')));
        Storage::disk('public')->put('articles/3.webp', File::get(database_path('seeders/assets/articles/3.webp')));
        Storage::disk('public')->put('articles/4.png', File::get(database_path('seeders/assets/articles/4.png')));
        Storage::disk('public')->put('articles/5.png', File::get(database_path('seeders/assets/articles/5.png')));
        Storage::disk('public')->put('articles/6.jpg', File::get(database_path('seeders/assets/articles/6.jpg')));
        Storage::disk('public')->put('articles/7.webp', File::get(database_path('seeders/assets/articles/7.webp')));
        Storage::disk('public')->put('articles/8.png', File::get(database_path('seeders/assets/articles/8.png')));

        // ================= ARTICLES =================

        Article::create([
            'title' => 'The Importance of Digital Presence for Modern Businesses',
            'content' => "In today’s competitive landscape, digital presence is no longer optional. Customers often discover, evaluate, and trust a business based on its online appearance before making any direct contact.\n\nA strong digital presence helps businesses establish credibility, communicate value clearly, and remain accessible across different platforms. From a well-structured website to consistent branding, every touchpoint contributes to how a brand is perceived.\n\nCompanies that invest in their digital presence are better positioned to adapt, scale, and stay relevant in an increasingly digital-driven market.",
            'thumbnail' => 'articles/1.jpeg',
            'author' => 'Nexora Studio Digital',
            'is_published' => true,
            'published_at' => Carbon::now()->subDays(10),
        ]);

        Article::create([
            'title' => 'Why UI/UX Design Impacts User Trust',
            'content' => "User trust is built through experience, and UI/UX design plays a critical role in shaping that experience. When users interact with a product, clarity and ease of use directly influence their confidence.\n\nThoughtful UI/UX design reduces friction, guides users intuitively, and ensures that interactions feel natural. Poor design choices, on the other hand, can quickly lead to confusion and frustration.\n\nBy prioritizing user-centered design, businesses create products that feel reliable, professional, and trustworthy from the very first interaction.",
            'thumbnail' => 'articles/2.jpg',
            'author' => 'Nexora Studio Digital',
            'is_published' => true,
            'published_at' => Carbon::now()->subDays(12),
        ]);

        Article::create([
            'title' => 'Scalable Web Applications for Growing Companies',
            'content' => "Scalability is a crucial factor for businesses planning long-term growth. Web applications that are not built with scalability in mind often face performance issues as usage increases.\n\nA scalable architecture allows systems to handle growth efficiently, whether it’s an increase in users, data, or features. This reduces the risk of costly rework in the future.\n\nBy investing in scalable solutions early, companies can focus on growth without being limited by technical constraints.",
            'thumbnail' => 'articles/3.webp',
            'author' => 'Nexora Studio Digital',
            'is_published' => true,
            'published_at' => Carbon::now()->subDays(15),
        ]);

        Article::create([
            'title' => 'Choosing the Right Tech Stack for Startups',
            'content' => "For startups, choosing the right tech stack is a strategic decision that can influence development speed and long-term sustainability. The wrong choice can lead to technical debt and slow progress.\n\nA well-selected tech stack balances flexibility, performance, and maintainability. It should support rapid iteration while remaining stable as the product evolves.\n\nStartups that make informed technology decisions early are better equipped to scale and adapt as their business grows.",
            'thumbnail' => 'articles/4.png',
            'author' => 'Nexora Studio Digital',
            'is_published' => true,
            'published_at' => Carbon::now()->subDays(18),
        ]);

        Article::create([
            'title' => 'How Landing Pages Increase Conversion Rates',
            'content' => "Landing pages are designed with a single purpose: guiding users toward a specific action. Unlike general pages, they eliminate distractions and focus attention.\n\nAn effective landing page combines clear messaging, strong visuals, and a compelling call to action. Every element should support the user’s decision-making process.\n\nWhen executed well, landing pages significantly improve conversion rates and overall marketing performance.",
            'thumbnail' => 'articles/5.png',
            'author' => 'Nexora Studio Digital',
            'is_published' => true,
            'published_at' => Carbon::now()->subDays(20),
        ]);

        Article::create([
            'title' => 'Digital Transformation for SMEs',
            'content' => "Digital transformation enables small and medium-sized enterprises to operate more efficiently and compete with larger organizations. It goes beyond adopting tools—it changes how businesses work.\n\nFrom automation to data-driven decision-making, digital solutions help SMEs streamline operations and improve customer experiences.\n\nBy embracing digital transformation, SMEs can unlock new growth opportunities and build resilience in a rapidly changing market.",
            'thumbnail' => 'articles/6.jpg',
            'author' => 'Nexora Studio Digital',
            'is_published' => true,
            'published_at' => Carbon::now()->subDays(22),
        ]);

        Article::create([
            'title' => 'Security Best Practices in Web Development',
            'content' => "Security should be an integral part of web development, not an afterthought. Vulnerabilities can compromise data, reputation, and user trust.\n\nImplementing best practices such as secure authentication, data validation, and regular updates helps reduce potential risks.\n\nA proactive approach to security ensures that applications remain reliable and protected as they grow.",
            'thumbnail' => 'articles/7.webp',
            'author' => 'Nexora Studio Digital',
            'is_published' => true,
            'published_at' => Carbon::now()->subDays(25),
        ]);

        Article::create([
            'title' => 'Future Trends in Digital Product Development',
            'content' => "Digital product development continues to evolve as technology advances. Trends such as automation, personalization, and AI-driven solutions are shaping the future.\n\nSuccessful teams stay adaptable by continuously learning and refining their processes. This allows them to respond quickly to changing user needs.\n\nBy understanding emerging trends, businesses can build products that remain relevant and competitive in the long term.",
            'thumbnail' => 'articles/8.png',
            'author' => 'Nexora Studio Digital',
            'is_published' => true,
            'published_at' => Carbon::now()->subDays(30),
        ]);
    }
}
