<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $fillable = [
        'word', 'transcription', 'translation', 'example', 'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
