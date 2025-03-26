<?php

namespace App\Models;

use App\Services\OpenAITranslationService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory;

    protected $fillable = ['section_id', 'language', 'key', 'value'];

    protected static function booted()
    {
        static::saving(function ($translation) {
            // ✅ Only handle English updates
            if ($translation->language !== 'en') {
                return;
            }

            // ✅ Only proceed if the 'value' field changed
            if (! array_key_exists('value', $translation->getDirty())) {
                return;
            }

            // ✅ Load the related section
            $section = $translation->section;
            if (! $section) {
                return;
            }

            // ✅ Find or create the Spanish version of this translation
            $spanish = self::firstOrNew([
                'section_id' => $section->id,
                'key' => $translation->key,
                'language' => 'es',
            ]);

            // ✅ Translate updated value to Spanish
            $sourceValue = $translation->value;
            if (!empty($sourceValue)) {
                $openai = app(OpenAITranslationService::class);
                $translatedValue = $openai->translate($sourceValue, 'Spanish');
                $spanish->value = $translatedValue;
                $spanish->save();

                logger()->info("Translated value from English to Spanish", [
                    'section_id' => $section->id,
                    'key' => $translation->key,
                ]);
            }
        });
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
