<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $dir = 'products';

        if (!Storage::disk('public')->exists($dir)) {
            Storage::disk('public')->makeDirectory($dir);
        }

        Storage::disk('public')->put('products/comprof.webp', File::get(database_path('seeders/assets/products/comprof.webp')));
        Storage::disk('public')->put('products/ecom.webp', File::get(database_path('seeders/assets/products/ecom.webp')));
        Storage::disk('public')->put('products/custom.webp', File::get(database_path('seeders/assets/products/custom.webp')));
        Storage::disk('public')->put('products/landing.webp', File::get(database_path('seeders/assets/products/landing.webp')));
        Storage::disk('public')->put('products/ui.webp', File::get(database_path('seeders/assets/products/ui.webp')));
        Storage::disk('public')->put('products/admin.webp', File::get(database_path('seeders/assets/products/admin.webp')));
        Storage::disk('public')->put('products/digital.webp', File::get(database_path('seeders/assets/products/digital.webp')));
        Storage::disk('public')->put('products/maintain.webp', File::get(database_path('seeders/assets/products/maintain.webp')));

        $link = 'https://dribbble.com/shots/popular/';

        Product::create([
            'name' => 'Company Profile Website',
            'description' => 'Professional company profile website.',
            'content' => 'A modern website to represent your brand identity.',
            'image' => 'products/comprof.webp',
            'price' => 2500000,
            'delivery_type' => 'link',
            'download_url' => $link,
            'order' => 1,
            'is_active' => true,
        ]);

        Product::create([
            'name' => 'E-Commerce Platform',
            'description' => 'Custom e-commerce solution.',
            'content' => 'Sell products online with a scalable platform.',
            'image' => 'products/ecom.webp',
            'price' => 7500000,
            'delivery_type' => 'link',
            'download_url' => $link,
            'order' => 2,
            'is_active' => true,
        ]);

        Product::create([
            'name' => 'Custom Web Application',
            'description' => 'Tailored web application development.',
            'content' => 'Custom-built solutions for business processes.',
            'image' => 'products/custom.webp',
            'price' => 12000000,
            'delivery_type' => 'link',
            'download_url' => $link,
            'order' => 3,
            'is_active' => true,
        ]);

        Product::create([
            'name' => 'Landing Page Campaign',
            'description' => 'High-converting landing page.',
            'content' => 'Optimized landing pages for marketing campaigns.',
            'image' => 'products/landing.webp',
            'price' => 1800000,
            'delivery_type' => 'link',
            'download_url' => $link,
            'order' => 4,
            'is_active' => true,
        ]);

        Product::create([
            'name' => 'UI/UX Design System',
            'description' => 'Complete UI/UX design system.',
            'content' => 'Design consistency for digital products.',
            'image' => 'products/ui.webp',
            'price' => 4500000,
            'delivery_type' => 'link',
            'download_url' => $link,
            'order' => 5,
            'is_active' => true,
        ]);

        Product::create([
            'name' => 'Admin Dashboard System',
            'description' => 'Custom admin dashboard.',
            'content' => 'Manage data efficiently with a dashboard system.',
            'image' => 'products/admin.webp',
            'price' => 6500000,
            'delivery_type' => 'link',
            'download_url' => $link,
            'order' => 6,
            'is_active' => true,
        ]);

        Product::create([
            'name' => 'Digital Branding Package',
            'description' => 'Branding for digital products.',
            'content' => 'Build a strong and consistent digital brand.',
            'image' => 'products/digital.webp',
            'price' => 3500000,
            'delivery_type' => 'link',
            'download_url' => $link,
            'order' => 7,
            'is_active' => true,
        ]);

        Product::create([
            'name' => 'Website Maintenance Service',
            'description' => 'Ongoing website maintenance.',
            'content' => 'Ensure website performance and security.',
            'image' => 'products/maintain.webp',
            'price' => 1500000,
            'delivery_type' => 'link',
            'download_url' => $link,
            'order' => 8,
            'is_active' => true,
        ]);
    }
}
