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

        Storage::disk('public')->put('events/launch.png', File::get(database_path('seeders/assets/events/launch.png')));
        Storage::disk('public')->put('events/uiux.png', File::get(database_path('seeders/assets/events/uiux.png')));
        Storage::disk('public')->put('events/develop.png', File::get(database_path('seeders/assets/events/develop.png')));
        Storage::disk('public')->put('events/startup.png', File::get(database_path('seeders/assets/events/startup.png')));
        Storage::disk('public')->put('events/modern.png', File::get(database_path('seeders/assets/events/modern.png')));
        Storage::disk('public')->put('events/design.png', File::get(database_path('seeders/assets/events/design.png')));
        Storage::disk('public')->put('events/scalable.png', File::get(database_path('seeders/assets/events/scalable.png')));
        Storage::disk('public')->put('events/digital.png', File::get(database_path('seeders/assets/events/digital.png')));

        Event::create([
            'title' => 'Nexora Product Launch',
            'description' => 'Introducing Nexora’s latest digital products.',
            'content' => 'A launch event showcasing new digital solutions.',
            'image' => 'events/launch.png',
            'location' => 'Jakarta',
            'start_date' => Carbon::now()->addDays(10),
            'end_date' => Carbon::now()->addDays(11),
            'is_active' => true,
        ]);

        Event::create([
            'title' => 'UI/UX Design Workshop',
            'description' => 'Hands-on UI/UX workshop.',
            'content' => 'Learn practical UI/UX design techniques.',
            'image' => 'events/uiux.png',
            'location' => 'Bandung',
            'start_date' => Carbon::now()->addDays(15),
            'end_date' => Carbon::now()->addDays(16),
            'is_active' => true,
        ]);

        Event::create([
            'title' => 'Web Development Bootcamp',
            'description' => 'Intensive web development training.',
            'content' => 'Build real-world web applications.',
            'image' => 'events/develop.png',
            'location' => 'Yogyakarta',
            'start_date' => Carbon::now()->addDays(18),
            'end_date' => Carbon::now()->addDays(20),
            'is_active' => true,
        ]);

        Event::create([
            'title' => 'Startup Digital Strategy Meetup',
            'description' => 'Strategy discussion for startups.',
            'content' => 'Networking and strategy sharing.',
            'image' => 'events/startup.png',
            'location' => 'Surabaya',
            'start_date' => Carbon::now()->addDays(22),
            'end_date' => Carbon::now()->addDays(22),
            'is_active' => true,
        ]);

        Event::create([
            'title' => 'Modern Web Technology Seminar',
            'description' => 'Exploring modern web technologies.',
            'content' => 'Talks on latest web trends.',
            'image' => 'events/modern.png',
            'location' => 'Bali',
            'start_date' => Carbon::now()->addDays(25),
            'end_date' => Carbon::now()->addDays(26),
            'is_active' => true,
        ]);

        Event::create([
            'title' => 'Design System Masterclass',
            'description' => 'Advanced design system workshop.',
            'content' => 'Creating scalable design systems.',
            'image' => 'events/design.png',
            'location' => 'Online',
            'start_date' => Carbon::now()->addDays(28),
            'end_date' => Carbon::now()->addDays(28),
            'is_active' => true,
        ]);

        Event::create([
            'title' => 'Scalable App Architecture Talk',
            'description' => 'Discussion on scalable architecture.',
            'content' => 'Best practices for scaling apps.',
            'image' => 'events/scalable.png',
            'location' => 'Online',
            'start_date' => Carbon::now()->addDays(30),
            'end_date' => Carbon::now()->addDays(30),
            'is_active' => true,
        ]);

        Event::create([
            'title' => 'Digital Business Conference',
            'description' => 'Annual digital business conference.',
            'content' => 'Industry leaders share insights.',
            'image' => 'events/digital.png',
            'location' => 'Jakarta',
            'start_date' => Carbon::now()->addDays(35),
            'end_date' => Carbon::now()->addDays(36),
            'is_active' => true,
        ]);
    }
}
