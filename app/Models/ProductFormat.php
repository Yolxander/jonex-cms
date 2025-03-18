<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductFormat extends Model
{
    protected $fillable = ['product_id', 'format', 'price_per_format','packaging'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
