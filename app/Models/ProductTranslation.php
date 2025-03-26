<?php

namespace App\Models;

use App\Services\OpenAITranslationService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'language', 'title', 'subtitle', 'description'];

    protected static function booted()
    {
        static::saving(function ($translation) {
            if ($translation->language !== 'en') {
                return;
            }

            $product = $translation->product;

            if (! $product) {
                return;
            }

            // Only track fields that are being changed
            $dirtyFields = collect($translation->getDirty())
                ->only(['title', 'subtitle', 'description'])
                ->keys()
                ->toArray();

            if (empty($dirtyFields)) {
                return; // Nothing relevant changed
            }

            $spanish = self::firstOrNew([
                'product_id' => $product->id,
                'language' => 'es',
            ]);

            $openai = app(OpenAITranslationService::class);
            $updated = false;

            foreach ($dirtyFields as $field) {
                $sourceValue = $translation->{$field};

                if (!empty($sourceValue)) {
                    $translatedValue = $openai->translate($sourceValue, 'Spanish');
                    $spanish->{$field} = $translatedValue;
                    $updated = true;
                }
            }

            if ($updated) {
                $spanish->save();
                logger()->info("Updated Spanish product translation fields", [
                    'product_id' => $product->id,
                    'fields' => $dirtyFields,
                ]);
            }
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
