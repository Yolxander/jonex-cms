<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    protected $fillable = ['section_id','type'];

    /**
     * Relationship: A Block belongs to a Section.
     */
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    /**
     * Relationship: A Block has many Contents.
     */
    public function contents()
    {
        return $this->hasMany(Content::class);
    }
}
