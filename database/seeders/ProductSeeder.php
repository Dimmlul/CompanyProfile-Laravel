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

        Storage::disk('public')->put('products/comprof.png', File::get(database_path('seeders/assets/products/comprof.png')));
        Storage::disk('public')->put('products/ecom.jpeg', File::get(database_path('seeders/assets/products/ecom.jpeg')));
        Storage::disk('public')->put('products/custom.jpeg', File::get(database_path('seeders/assets/products/custom.jpeg')));
        Storage::disk('public')->put('products/landing.jpeg', File::get(database_path('seeders/assets/products/landing.jpeg')));
        Storage::disk('public')->put('products/ui.png', File::get(database_path('seeders/assets/products/ui.png')));
        Storage::disk('public')->put('products/admin.jpeg', File::get(database_path('seeders/assets/products/admin.jpeg')));
        Storage::disk('public')->put('products/digital.jpeg', File::get(database_path('seeders/assets/products/digital.jpeg')));
        Storage::disk('public')->put('products/maintain.jpg', File::get(database_path('seeders/assets/products/maintain.jpg')));

        Product::create([
            'name' => 'Company Profile Website',
            'description' => 'Professional company profile website.',
            'content' => 'A modern website to represent your brand identity.',
            'image' => 'products/comprof.png',
            'price' => 2500000,
            'order' => 1,
            'is_active' => true,
        ]);

        Product::create([
            'name' => 'E-Commerce Platform',
            'description' => 'Custom e-commerce solution.',
            'content' => 'Sell products online with a scalable platform.',
            'image' => 'products/ecom.jpeg',
            'price' => 7500000,
            'order' => 2,
            'is_active' => true,
        ]);

        Product::create([
            'name' => 'Custom Web Application',
            'description' => 'Tailored web application development.',
            'content' => 'Custom-built solutions for business processes.',
            'image' => 'products/custom.jpeg',
            'price' => 12000000,
            'order' => 3,
            'is_active' => true,
        ]);

        Product::create([
            'name' => 'Landing Page Campaign',
            'description' => 'High-converting landing page.',
            'content' => 'Optimized landing pages for marketing campaigns.',
            'image' => 'products/landing.jpeg',
            'price' => 1800000,
            'order' => 4,
            'is_active' => true,
        ]);

        Product::create([
            'name' => 'UI/UX Design System',
            'description' => 'Complete UI/UX design system.',
            'content' => 'Design consistency for digital products.',
            'image' => 'products/ui.png',
            'price' => 4500000,
            'order' => 5,
            'is_active' => true,
        ]);

        Product::create([
            'name' => 'Admin Dashboard System',
            'description' => 'Custom admin dashboard.',
            'content' => 'Manage data efficiently with a dashboard system.',
            'image' => 'products/admin.jpeg',
            'price' => 6500000,
            'order' => 6,
            'is_active' => true,
        ]);

        Product::create([
            'name' => 'Digital Branding Package',
            'description' => 'Branding for digital products.',
            'content' => 'Build a strong and consistent digital brand.',
            'image' => 'products/digital.jpeg',
            'price' => 3500000,
            'order' => 7,
            'is_active' => true,
        ]);

        Product::create([
            'name' => 'Website Maintenance Service',
            'description' => 'Ongoing website maintenance.',
            'content' => 'Ensure website performance and security.',
            'image' => 'products/maintain.jpg',
            'price' => 1500000,
            'order' => 8,
            'is_active' => true,
        ]);
    }
}
