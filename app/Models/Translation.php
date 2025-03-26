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
        static::saved(function ($translation) {
            // Trigger only when English version is saved
            if ($translation->language === 'en') {
                $section = $translation->section;

                if ($section) {
                    $spanishExists = self::where('section_id', $section->id)
                        ->where('key', $translation->key)
                        ->where('language', 'es')
                        ->exists();

                    if (! $spanishExists) {
                        app(OpenAITranslationService::class)->generateTranslationsForModel(
                            $section,
                            self::class,
                            'section_id',
                            ['value'],
                            ['es' => 'Spanish']
                        );
                    }
                }
            }
        });
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
