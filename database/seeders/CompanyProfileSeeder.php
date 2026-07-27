<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanyProfile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CompanyProfileSeeder extends Seeder
{
    public function run(): void
    {

        $source = database_path('seeders/assets/logo/logo.webp');
        $dir = 'logo';

        if (!Storage::disk('public')->exists($dir)) {
            Storage::disk('public')->makeDirectory($dir);
        }

        Storage::disk('public')->put("$dir/logo.webp", File::get($source));

        CompanyProfile::create([
            'company_name' => 'Nexora Studio Digital',
            'logo' => 'logo/logo.webp',
            'about' => 'Nexora Studio Digital is a creative digital studio specializing in modern websites, scalable applications, and digital product design.',
            'vision' => 'To become a trusted digital partner for growing brands worldwide.',
            'mission' => 'Deliver impactful digital solutions through thoughtful design, reliable technology, and long-term strategy.',
            'address' => 'South Jakarta, Indonesia',
            'phone' => '+62 812 3456 7890',
            'fax' => '+62 21 1234 5678',
            'email' => 'nexorastudiodigital@gmail.com',
            'instagram' => 'https://www.instagram.com/nexorastudio/',
            'whatsapp' => '+6281234567890',
        ]);
    }
}
