<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $dir = 'gallery';

        if (!Storage::disk('public')->exists($dir)) {
            Storage::disk('public')->makeDirectory($dir);
        }

        // === COPY IMAGE SESUAI YANG DIPAKAI DI DB ===
        Storage::disk('public')->put(
            'gallery/develop.webp',
            File::get(database_path('seeders/assets/gallery/develop.webp'))
        );

        Storage::disk('public')->put(
            'gallery/develop2.webp',
            File::get(database_path('seeders/assets/gallery/develop2.webp'))
        );

        Storage::disk('public')->put(
            'gallery/develop2.webp',
            File::get(database_path('seeders/assets/gallery/develop2.webp'))
        );

        Storage::disk('public')->put(
            'gallery/seminar.webp',
            File::get(database_path('seeders/assets/gallery/seminar.webp'))
        );

        Storage::disk('public')->put(
            'gallery/launch.webp',
            File::get(database_path('seeders/assets/gallery/launch.webp'))
        );

        Storage::disk('public')->put(
            'gallery/ui.webp',
            File::get(database_path('seeders/assets/gallery/ui.webp'))
        );

        Storage::disk('public')->put(
            'gallery/startup.webp',
            File::get(database_path('seeders/assets/gallery/startup.webp'))
        );

        // === DATA (TIDAK DIUBAH) ===
        Gallery::create([
            'title' => 'Office Workspace',
            'image' => 'gallery/develop.webp',
            'caption' => 'Modern office workspace at Nexora Studio.',
            'category' => 'activity',
            'order' => 1,
            'is_active' => true,
        ]);

        Gallery::create([
            'title' => 'Team Brainstorming Session',
            'image' => 'gallery/develop2.webp',
            'caption' => 'Creative brainstorming session with the Nexora team.',
            'category' => 'activity',
            'order' => 2,
            'is_active' => true,
        ]);

        Gallery::create([
            'title' => 'Client Presentation',
            'image' => 'gallery/develop.webp',
            'caption' => 'Presenting digital solutions to clients.',
            'category' => 'activity',
            'order' => 3,
            'is_active' => true,
        ]);

        Gallery::create([
            'title' => 'Design Review Process',
            'image' => 'gallery/develop2.webp',
            'caption' => 'UI/UX design review and feedback session.',
            'category' => 'design',
            'order' => 4,
            'is_active' => true,
        ]);

        Gallery::create([
            'title' => 'Development Sprint',
            'image' => 'gallery/seminar.webp',
            'caption' => 'Agile development sprint in progress.',
            'category' => 'development',
            'order' => 5,
            'is_active' => true,
        ]);

        Gallery::create([
            'title' => 'Product Launch Event',
            'image' => 'gallery/launch.webp',
            'caption' => 'Launching a new digital product.',
            'category' => 'event',
            'order' => 6,
            'is_active' => true,
        ]);

        Gallery::create([
            'title' => 'UI Design Mockup',
            'image' => 'gallery/ui.webp',
            'caption' => 'Preview of a modern UI design mockup.',
            'category' => 'design',
            'order' => 7,
            'is_active' => true,
        ]);

        Gallery::create([
            'title' => 'Company Team Building',
            'image' => 'gallery/startup.webp',
            'caption' => 'Team building activity at Nexora Studio.',
            'category' => 'culture',
            'order' => 8,
            'is_active' => true,
        ]);
    }
}
