<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        $dir = 'clients';

        if (!Storage::disk('public')->exists($dir)) {
            Storage::disk('public')->makeDirectory($dir);
        }

        // COPY SEMUA LOGO SESUAI DB
        Storage::disk('public')->put('clients/alpha.webp', File::get(database_path('seeders/assets/clients/alpha.webp')));
        Storage::disk('public')->put('clients/bright.webp', File::get(database_path('seeders/assets/clients/bright.webp')));
        Storage::disk('public')->put('clients/creative.webp', File::get(database_path('seeders/assets/clients/creative.webp')));
        Storage::disk('public')->put('clients/digital.webp', File::get(database_path('seeders/assets/clients/digital.webp')));
        Storage::disk('public')->put('clients/evo.webp', File::get(database_path('seeders/assets/clients/evo.webp')));
        Storage::disk('public')->put('clients/future.webp', File::get(database_path('seeders/assets/clients/future.webp')));
        Storage::disk('public')->put('clients/growth.webp', File::get(database_path('seeders/assets/clients/growth.webp')));
        Storage::disk('public')->put('clients/hyper.webp', File::get(database_path('seeders/assets/clients/hyper.webp')));

        Client::create([
            'name' => 'Alpha Tech Indonesia',
            'logo' => 'clients/alpha.webp',
            'website' => 'https://alphatech.co.id',
            'description' => 'Technology partner for enterprise solutions.',
            'order' => 1,
            'is_active' => true,
        ]);

        Client::create([
            'name' => 'Bright Solutions Asia',
            'logo' => 'clients/bright.webp',
            'website' => 'https://brightsolutions.asia',
            'description' => 'Digital solutions provider in Asia.',
            'order' => 2,
            'is_active' => true,
        ]);

        Client::create([
            'name' => 'Creative Startup Hub',
            'logo' => 'clients/creative.webp',
            'website' => 'https://creativestartup.io',
            'description' => 'Startup incubator and innovation hub.',
            'order' => 3,
            'is_active' => true,
        ]);

        Client::create([
            'name' => 'Digital Ventures Group',
            'logo' => 'clients/digital.webp',
            'website' => 'https://digitalventures.com',
            'description' => 'Investment and digital growth company.',
            'order' => 4,
            'is_active' => true,
        ]);

        Client::create([
            'name' => 'Evo Technology',
            'logo' => 'clients/evo.webp',
            'website' => 'https://evotechnology.io',
            'description' => 'Modern technology solutions provider.',
            'order' => 5,
            'is_active' => true,
        ]);

        Client::create([
            'name' => 'Future Innovation Lab',
            'logo' => 'clients/future.webp',
            'website' => 'https://futurelab.id',
            'description' => 'Research-driven innovation lab.',
            'order' => 6,
            'is_active' => true,
        ]);

        Client::create([
            'name' => 'Growth Partner Studio',
            'logo' => 'clients/growth.webp',
            'website' => 'https://growthpartner.studio',
            'description' => 'Business growth and digital partner.',
            'order' => 7,
            'is_active' => true,
        ]);

        Client::create([
            'name' => 'Hyper Digital Agency',
            'logo' => 'clients/hyper.webp',
            'website' => 'https://hyperdigital.agency',
            'description' => 'Creative digital marketing agency.',
            'order' => 8,
            'is_active' => true,
        ]);
    }
}
