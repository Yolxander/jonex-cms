<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\Site;

class PageSeeder extends Seeder
{
    public function run()
    {
//        // Jonex S.A.S. landing page
//        $sasSite = Site::where('slug', 'jonex-sas')->first();
//
//        Page::firstOrCreate([
//            'site_id' => $sasSite->id,
//            'slug' => 'landing'
//        ], [
//            'title' => 'Landing Page',
//        ]);

        // Jonex Canada landing page
        $caSite = Site::where('slug', 'jonex-ca')->first();

        Page::firstOrCreate([
            'site_id' => $caSite->id,
            'slug' => 'jonex-canada-landing'
        ], [
            'title' => 'Jonex Canada Landing Page',
        ]);
    }
}
