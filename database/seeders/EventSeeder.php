<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $dir = 'events';

        if (!Storage::disk('public')->exists($dir)) {
            Storage::disk('public')->makeDirectory($dir);
        }

        Storage::disk('public')->put('events/launch.webp', File::get(database_path('seeders/assets/events/launch.webp')));
        Storage::disk('public')->put('events/uiux.webp', File::get(database_path('seeders/assets/events/uiux.webp')));
        Storage::disk('public')->put('events/develop.webp', File::get(database_path('seeders/assets/events/develop.webp')));
        Storage::disk('public')->put('events/startup.webp', File::get(database_path('seeders/assets/events/startup.webp')));
        Storage::disk('public')->put('events/modern.webp', File::get(database_path('seeders/assets/events/modern.webp')));
        Storage::disk('public')->put('events/design.webp', File::get(database_path('seeders/assets/events/design.webp')));
        Storage::disk('public')->put('events/scalable.webp', File::get(database_path('seeders/assets/events/scalable.webp')));
        Storage::disk('public')->put('events/digital.webp', File::get(database_path('seeders/assets/events/digital.webp')));

        Event::create([
            'title' => 'Nexora Product Launch',
            'description' => 'Introducing Nexora’s latest digital products.',
            'content' => 'A launch event showcasing new digital solutions.',
            'image' => 'events/launch.webp',
            'location' => 'Jakarta',
            'start_date' => Carbon::now()->addDays(10),
            'end_date' => Carbon::now()->addDays(11),
            'is_active' => true,
        ]);

        Event::create([
            'title' => 'UI/UX Design Workshop',
            'description' => 'Hands-on UI/UX workshop.',
            'content' => 'Learn practical UI/UX design techniques.',
            'image' => 'events/uiux.webp',
            'location' => 'Bandung',
            'start_date' => Carbon::now()->addDays(15),
            'end_date' => Carbon::now()->addDays(16),
            'is_active' => true,
        ]);

        Event::create([
            'title' => 'Web Development Bootcamp',
            'description' => 'Intensive web development training.',
            'content' => 'Build real-world web applications.',
            'image' => 'events/develop.webp',
            'location' => 'Yogyakarta',
            'start_date' => Carbon::now()->addDays(18),
            'end_date' => Carbon::now()->addDays(20),
            'is_active' => true,
        ]);

        Event::create([
            'title' => 'Startup Digital Strategy Meetup',
            'description' => 'Strategy discussion for startups.',
            'content' => 'Networking and strategy sharing.',
            'image' => 'events/startup.webp',
            'location' => 'Surabaya',
            'start_date' => Carbon::now()->addDays(22),
            'end_date' => Carbon::now()->addDays(22),
            'is_active' => true,
        ]);

        Event::create([
            'title' => 'Modern Web Technology Seminar',
            'description' => 'Exploring modern web technologies.',
            'content' => 'Talks on latest web trends.',
            'image' => 'events/modern.webp',
            'location' => 'Bali',
            'start_date' => Carbon::now()->addDays(25),
            'end_date' => Carbon::now()->addDays(26),
            'is_active' => true,
        ]);

        Event::create([
            'title' => 'Design System Masterclass',
            'description' => 'Advanced design system workshop.',
            'content' => 'Creating scalable design systems.',
            'image' => 'events/design.webp',
            'location' => 'Online',
            'start_date' => Carbon::now()->addDays(28),
            'end_date' => Carbon::now()->addDays(28),
            'is_active' => true,
        ]);

        Event::create([
            'title' => 'Scalable App Architecture Talk',
            'description' => 'Discussion on scalable architecture.',
            'content' => 'Best practices for scaling apps.',
            'image' => 'events/scalable.webp',
            'location' => 'Online',
            'start_date' => Carbon::now()->addDays(30),
            'end_date' => Carbon::now()->addDays(30),
            'is_active' => true,
        ]);

        Event::create([
            'title' => 'Digital Business Conference',
            'description' => 'Annual digital business conference.',
            'content' => 'Industry leaders share insights.',
            'image' => 'events/digital.webp',
            'location' => 'Jakarta',
            'start_date' => Carbon::now()->addDays(35),
            'end_date' => Carbon::now()->addDays(36),
            'is_active' => true,
        ]);
    }
}
