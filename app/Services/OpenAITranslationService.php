<?php

namespace App\Services;

use OpenAI;
use Illuminate\Database\Eloquent\Model;

class OpenAITranslationService
{
    protected $client;

    public function __construct()
    {
        $this->client = OpenAI::client(config('services.openai.key'));
    }

    /**
     * Translate a given string into a target language using OpenAI.
     */
    public function translate(string $text, string $language): string
    {
        $prompt = <<<EOT
Translate the following into {$language}. Return only the translated phrase without quotation marks or explanations.

{$text}
EOT;

        $response = $this->client->chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        return trim($response->choices[0]->message->content);
    }

    /**
     * Generic method to generate translations for a model.
     *
     * @param Model $record The model being translated (Category, Product, Section, etc.)
     * @param string $translationModelClass e.g. App\Models\CategoryTranslation
     * @param string $foreignKey e.g. 'category_id', 'product_id', 'section_id'
     * @param array $fieldsToTranslate e.g. ['name', 'description']
     * @param array $languages Language map ['en' => 'English', 'es' => 'Spanish']
     */
    public function generateTranslationsForModel(
        Model $record,
        string $translationModelClass,
        string $foreignKey,
        array $fieldsToTranslate,
        array $languages = ['en' => 'English', 'es' => 'Spanish']
    ): void {
        foreach ($languages as $langCode => $langName) {
            $exists = $translationModelClass::where($foreignKey, $record->id)
                ->where('language', $langCode)
                ->exists();

            if (! $exists) {
                $translationData = [
                    $foreignKey => $record->id,
                    'language' => $langCode,
                ];

                foreach ($fieldsToTranslate as $field) {
                    $text = $record->{$field} ?? '';
                    $translationData[$field] = $this->translate($text, $langName);
                }

                $translationModelClass::create($translationData);
            }
        }
    }
}
