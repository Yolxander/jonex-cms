<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = ['section_id', 'type', 'value'];

    protected $casts = [
        'value' => 'string', // Ensure it's stored as a string
    ];

    public function block()
    {
        return $this->belongsTo(block::class, 'block_id');
    }

}
