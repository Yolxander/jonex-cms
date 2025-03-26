<?php

namespace App\Services;

use OpenAI;
use App\Models\Category;
use App\Models\CategoryTranslation;

class OpenAITranslationService
{
    protected $client;

    public function __construct()
    {
        $this->client = OpenAI::client(config('services.openai.key'));
    }

    public function generateTranslationsFor(Category $category)
    {
        $languages = ['en' => 'English', 'es' => 'Spanish'];

        foreach ($languages as $code => $language) {
            $exists = CategoryTranslation::where('category_id', $category->id)
                ->where('language', $code)
                ->exists();

            if (! $exists) {
                $translatedDescription = $this->translate($category->name, $language);

                CategoryTranslation::create([
                    'category_id' => $category->id,
                    'language' => $code,
                    'description' => $translatedDescription,
                    'name' => 'translation'.$category->id,
                ]);
            }
        }
    }

    protected function translate(string $text, string $language): string
    {
        $prompt = <<<EOT
Translate the following category name into {$language}. Return only the translated phrase without quotation marks or explanations.

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

}
