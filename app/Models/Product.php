<?php

namespace App\Models;

use App\Services\OpenAITranslationService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'sku', 'price', 'category_id', 'live' ,'hide_price', 'hide_formats'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function translations()
    {
        return $this->hasMany(ProductTranslation::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function formats()
    {
        return $this->hasMany(ProductFormat::class);
    }

    public function product_translation()
    {
        return $this->hasMany(ProductTranslation::class);
    }
}
