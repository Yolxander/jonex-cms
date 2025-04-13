<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Site;

class SiteSeeder extends Seeder
{
    public function run()
    {
//        Site::create([
//            'name' => 'Jonex S.A.S.',
//            'slug' => 'jonex-sas',
//            'url' => 'https://jonex.co',
//            'description' => 'Import/Export and trade solutions for Latin America and Canada.'
//        ]);

        Site::create([
            'name' => 'Jonex Canada',
            'slug' => 'jonex-ca',
            'url' => 'https://jonex.ca',
            'description' => 'Canadian import/export and trade services for Latin America.'
        ]);
    }
}
