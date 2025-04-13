<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\Section;

class SectionSeeder extends Seeder
{
    public function run()
    {
//        $page = Page::where('slug', 'landing')->first();
//        $sections = ['nav', 'hero', 'services', 'products', 'capabilities', 'stats', 'footer', 'mobile'];
//
//        foreach ($sections as $section) {
//            Section::create([
//                'page_id' => $page->id,
//                'name' => $section
//            ]);
//        }

        $page = Page::firstOrCreate([
            'slug' => 'jonex-canada-landing',
        ], [
            'title' => 'Jonex Canada Landing Page',
        ]);

        $sections = ['navigation', 'hero', 'about', 'ourPromise', 'globalPresence', 'contact', 'products'];

        foreach ($sections as $section) {
            Section::firstOrCreate([
                'page_id' => $page->id,
                'name' => $section,
            ]);
        }
    }
}
