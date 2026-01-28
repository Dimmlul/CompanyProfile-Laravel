<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanyProfile;

class CompanyProfileSeeder extends Seeder
{
    public function run(): void
    {
        CompanyProfile::create([
            'company_name' => 'Nexora Studio Digital',
            'about' => 'Nexora Studio Digital is a creative digital studio specializing in modern websites, scalable applications, and digital product design.',
            'vision' => 'To become a trusted digital partner for growing brands worldwide.',
            'mission' => 'Deliver impactful digital solutions through thoughtful design, reliable technology, and long-term strategy.',
            'address' => 'South Jakarta, Indonesia',
            'phone' => '+62 812 3456 7890',
            'fax' => '+62 21 1234 5678',
            'email' => 'nexorastudiodigital@gmail.com',
        ]);
    }
}
