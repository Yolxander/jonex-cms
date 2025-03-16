<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Translation;
use App\Models\Section;

class TranslationController extends Controller
{
    public function getTranslations(Request $request)
    {
        // Get the requested language (default to "es" if not provided)
        $language = $request->query('lang', 'es');

        // Fetch all translations from the database
        $translations = Translation::where('language', $language)->get();

        // Organize translations by section
        $organizedTranslations = [];

        foreach ($translations as $translation) {
            // Extract section name from key
            $section = Section::where('id', $translation->section_id)->first();

            if ($section) {
                if (!isset($organizedTranslations[$language][$section->name])) {
                    $organizedTranslations[$language][$section->name] = [];
                }
                $organizedTranslations[$language][$section->name][$translation->key] = $translation->value;
            }
        }

        return response()->json($organizedTranslations);
    }
}
