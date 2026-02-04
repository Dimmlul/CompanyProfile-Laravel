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
        Storage::disk('public')->put('clients/alpha.png', File::get(database_path('seeders/assets/clients/alpha.png')));
        Storage::disk('public')->put('clients/bright.png', File::get(database_path('seeders/assets/clients/bright.png')));
        Storage::disk('public')->put('clients/creative.png', File::get(database_path('seeders/assets/clients/creative.png')));
        Storage::disk('public')->put('clients/digital.png', File::get(database_path('seeders/assets/clients/digital.png')));
        Storage::disk('public')->put('clients/evo.png', File::get(database_path('seeders/assets/clients/evo.png')));
        Storage::disk('public')->put('clients/future.png', File::get(database_path('seeders/assets/clients/future.png')));
        Storage::disk('public')->put('clients/growth.png', File::get(database_path('seeders/assets/clients/growth.png')));
        Storage::disk('public')->put('clients/hyper.png', File::get(database_path('seeders/assets/clients/hyper.png')));

        Client::create([
            'name' => 'Alpha Tech Indonesia',
            'logo' => 'clients/alpha.png',
            'website' => 'https://alphatech.co.id',
            'description' => 'Technology partner for enterprise solutions.',
            'order' => 1,
            'is_active' => true,
        ]);

        Client::create([
            'name' => 'Bright Solutions Asia',
            'logo' => 'clients/bright.png',
            'website' => 'https://brightsolutions.asia',
            'description' => 'Digital solutions provider in Asia.',
            'order' => 2,
            'is_active' => true,
        ]);

        Client::create([
            'name' => 'Creative Startup Hub',
            'logo' => 'clients/creative.png',
            'website' => 'https://creativestartup.io',
            'description' => 'Startup incubator and innovation hub.',
            'order' => 3,
            'is_active' => true,
        ]);

        Client::create([
            'name' => 'Digital Ventures Group',
            'logo' => 'clients/digital.png',
            'website' => 'https://digitalventures.com',
            'description' => 'Investment and digital growth company.',
            'order' => 4,
            'is_active' => true,
        ]);

        Client::create([
            'name' => 'Evo Technology',
            'logo' => 'clients/evo.png',
            'website' => 'https://evotechnology.io',
            'description' => 'Modern technology solutions provider.',
            'order' => 5,
            'is_active' => true,
        ]);

        Client::create([
            'name' => 'Future Innovation Lab',
            'logo' => 'clients/future.png',
            'website' => 'https://futurelab.id',
            'description' => 'Research-driven innovation lab.',
            'order' => 6,
            'is_active' => true,
        ]);

        Client::create([
            'name' => 'Growth Partner Studio',
            'logo' => 'clients/growth.png',
            'website' => 'https://growthpartner.studio',
            'description' => 'Business growth and digital partner.',
            'order' => 7,
            'is_active' => true,
        ]);

        Client::create([
            'name' => 'Hyper Digital Agency',
            'logo' => 'clients/hyper.png',
            'website' => 'https://hyperdigital.agency',
            'description' => 'Creative digital marketing agency.',
            'order' => 8,
            'is_active' => true,
        ]);
    }
}
