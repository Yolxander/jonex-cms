<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory;

    protected $fillable = ['section_id', 'language', 'key', 'value'];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
