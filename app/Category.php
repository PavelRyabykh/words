<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'user_id',
    ];

    public function words()
    {
        return $this->hasMany(Word::class);
    }
}
