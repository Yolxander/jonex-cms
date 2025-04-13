<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;
use App\Models\Translation;

class TranslationSeeder extends Seeder
{
    public function run()
    {
        $languages = [
            'es' => 'jonex_ca_es.json',
            'en' => 'jonex_ca_en.json',
        ];

        foreach ($languages as $lang => $file) {
            $translations = json_decode(file_get_contents(database_path('seeders/' . $file)), true);

            foreach ($translations as $key => $value) {
                $sectionName = explode('.', $key)[0];

                $section = Section::firstOrCreate(['name' => $sectionName]);

                Translation::updateOrCreate(
                    [
                        'section_id' => $section->id,
                        'language' => $lang,
                        'key' => $key,
                    ],
                    [
                        'value' => $value,
                    ]
                );
            }
        }
    }
}
