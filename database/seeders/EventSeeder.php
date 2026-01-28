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
        $source = database_path('seeders/assets/events/default.webp');
        $dir = 'events';

        if (!Storage::disk('public')->exists($dir)) {
            Storage::disk('public')->makeDirectory($dir);
        }

        Storage::disk('public')->put("$dir/default.webp", File::get($source));

        Event::create([
            'title' => 'Nexora Product Launch',
            'description' => 'Introducing Nexora’s latest digital products.',
            'content' => 'A launch event showcasing new digital solutions.',
            'image' => 'events/default.webp',
            'location' => 'Jakarta',
            'start_date' => Carbon::now()->addDays(10),
            'end_date' => Carbon::now()->addDays(11),
            'is_active' => true,
        ]);

        Event::create([
            'title' => 'UI/UX Design Workshop',
            'description' => 'Hands-on UI/UX workshop.',
            'content' => 'Learn practical UI/UX design techniques.',
            'image' => 'events/default.webp',
            'location' => 'Bandung',
            'start_date' => Carbon::now()->addDays(15),
            'end_date' => Carbon::now()->addDays(16),
            'is_active' => true,
        ]);

        Event::create([
            'title' => 'Web Development Bootcamp',
            'description' => 'Intensive web development training.',
            'content' => 'Build real-world web applications.',
            'image' => 'events/default.webp',
            'location' => 'Yogyakarta',
            'start_date' => Carbon::now()->addDays(18),
            'end_date' => Carbon::now()->addDays(20),
            'is_active' => true,
        ]);

        Event::create([
            'title' => 'Startup Digital Strategy Meetup',
            'description' => 'Strategy discussion for startups.',
            'content' => 'Networking and strategy sharing.',
            'image' => 'events/default.webp',
            'location' => 'Surabaya',
            'start_date' => Carbon::now()->addDays(22),
            'end_date' => Carbon::now()->addDays(22),
            'is_active' => true,
        ]);

        Event::create([
            'title' => 'Modern Web Technology Seminar',
            'description' => 'Exploring modern web technologies.',
            'content' => 'Talks on latest web trends.',
            'image' => 'events/default.webp',
            'location' => 'Bali',
            'start_date' => Carbon::now()->addDays(25),
            'end_date' => Carbon::now()->addDays(26),
            'is_active' => true,
        ]);

        Event::create([
            'title' => 'Design System Masterclass',
            'description' => 'Advanced design system workshop.',
            'content' => 'Creating scalable design systems.',
            'image' => 'events/default.webp',
            'location' => 'Online',
            'start_date' => Carbon::now()->addDays(28),
            'end_date' => Carbon::now()->addDays(28),
            'is_active' => true,
        ]);

        Event::create([
            'title' => 'Scalable App Architecture Talk',
            'description' => 'Discussion on scalable architecture.',
            'content' => 'Best practices for scaling apps.',
            'image' => 'events/default.webp',
            'location' => 'Online',
            'start_date' => Carbon::now()->addDays(30),
            'end_date' => Carbon::now()->addDays(30),
            'is_active' => true,
        ]);

        Event::create([
            'title' => 'Digital Business Conference',
            'description' => 'Annual digital business conference.',
            'content' => 'Industry leaders share insights.',
            'image' => 'events/default.webp',
            'location' => 'Jakarta',
            'start_date' => Carbon::now()->addDays(35),
            'end_date' => Carbon::now()->addDays(36),
            'is_active' => true,
        ]);
    }
}
