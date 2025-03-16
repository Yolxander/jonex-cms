<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\Site;

class PageSeeder extends Seeder
{
    public function run()
    {
        $site = Site::where('slug', 'jonex-sas')->first();

        Page::create([
            'site_id' => $site->id,
            'title' => 'Landing Page',
            'slug' => 'landing'
        ]);
    }
}
