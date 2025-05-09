<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['site_id', 'title', 'slug'];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
