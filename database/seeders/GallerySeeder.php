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
        $source = database_path('seeders/assets/gallery/default.webp');
        $dir = 'gallery';

        if (!Storage::disk('public')->exists($dir)) {
            Storage::disk('public')->makeDirectory($dir);
        }

        Storage::disk('public')->put("$dir/default.webp", File::get($source));

        Gallery::create([
            'title' => 'Office Workspace',
            'image' => 'gallery/default.webp',
            'caption' => 'Modern office workspace at Nexora Studio.',
            'category' => 'activity',
            'order' => 1,
            'is_active' => true,
        ]);

        Gallery::create([
            'title' => 'Team Brainstorming Session',
            'image' => 'gallery/default.webp',
            'caption' => 'Creative brainstorming session with the Nexora team.',
            'category' => 'activity',
            'order' => 2,
            'is_active' => true,
        ]);

        Gallery::create([
            'title' => 'Client Presentation',
            'image' => 'gallery/default.webp',
            'caption' => 'Presenting digital solutions to clients.',
            'category' => 'activity',
            'order' => 3,
            'is_active' => true,
        ]);

        Gallery::create([
            'title' => 'Design Review Process',
            'image' => 'gallery/default.webp',
            'caption' => 'UI/UX design review and feedback session.',
            'category' => 'design',
            'order' => 4,
            'is_active' => true,
        ]);

        Gallery::create([
            'title' => 'Development Sprint',
            'image' => 'gallery/default.webp',
            'caption' => 'Agile development sprint in progress.',
            'category' => 'development',
            'order' => 5,
            'is_active' => true,
        ]);

        Gallery::create([
            'title' => 'Product Launch Event',
            'image' => 'gallery/default.webp',
            'caption' => 'Launching a new digital product.',
            'category' => 'event',
            'order' => 6,
            'is_active' => true,
        ]);

        Gallery::create([
            'title' => 'UI Design Mockup',
            'image' => 'gallery/default.webp',
            'caption' => 'Preview of a modern UI design mockup.',
            'category' => 'design',
            'order' => 7,
            'is_active' => true,
        ]);

        Gallery::create([
            'title' => 'Company Team Building',
            'image' => 'gallery/default.webp',
            'caption' => 'Team building activity at Nexora Studio.',
            'category' => 'culture',
            'order' => 8,
            'is_active' => true,
        ]);
    }
}
