<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Sentence extends Model
{
    protected $fillable = [
        'date',
        'content',
        'author',
        'rating'
    ];

    protected function content(): Attribute {
        return Attribute::make(
            get: fn($value) => $value,
            set: fn($value) => str_replace(',','.', $value)
        );    
    }
}
