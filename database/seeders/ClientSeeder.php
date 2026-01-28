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
        $source = database_path('seeders/assets/clients/default.webp');
        $dir = 'clients';

        if (!Storage::disk('public')->exists($dir)) {
            Storage::disk('public')->makeDirectory($dir);
        }

        Storage::disk('public')->put("$dir/default.webp", File::get($source));

        Client::create([
            'name' => 'Alpha Tech Indonesia',
            'logo' => 'clients/default.webp',
            'website' => 'https://alphatech.co.id',
            'description' => 'Technology partner for enterprise solutions.',
            'order' => 1,
            'is_active' => true,
        ]);

        Client::create([
            'name' => 'Bright Solutions Asia',
            'logo' => 'clients/default.webp',
            'website' => 'https://brightsolutions.asia',
            'description' => 'Digital solutions provider in Asia.',
            'order' => 2,
            'is_active' => true,
        ]);

        Client::create([
            'name' => 'Creative Startup Hub',
            'logo' => 'clients/default.webp',
            'website' => 'https://creativestartup.io',
            'description' => 'Startup incubator and innovation hub.',
            'order' => 3,
            'is_active' => true,
        ]);

        Client::create([
            'name' => 'Digital Ventures Group',
            'logo' => 'clients/default.webp',
            'website' => 'https://digitalventures.com',
            'description' => 'Investment and digital growth company.',
            'order' => 4,
            'is_active' => true,
        ]);

        Client::create([
            'name' => 'Evo Technology',
            'logo' => 'clients/default.webp',
            'website' => 'https://evotechnology.io',
            'description' => 'Modern technology solutions provider.',
            'order' => 5,
            'is_active' => true,
        ]);

        Client::create([
            'name' => 'Future Innovation Lab',
            'logo' => 'clients/default.webp',
            'website' => 'https://futurelab.id',
            'description' => 'Research-driven innovation lab.',
            'order' => 6,
            'is_active' => true,
        ]);

        Client::create([
            'name' => 'Growth Partner Studio',
            'logo' => 'clients/default.webp',
            'website' => 'https://growthpartner.studio',
            'description' => 'Business growth and digital partner.',
            'order' => 7,
            'is_active' => true,
        ]);

        Client::create([
            'name' => 'Hyper Digital Agency',
            'logo' => 'clients/default.webp',
            'website' => 'https://hyperdigital.agency',
            'description' => 'Creative digital marketing agency.',
            'order' => 8,
            'is_active' => true,
        ]);
    }
}
