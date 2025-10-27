<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'excerpt',
        'image_url',
        'image_hint',
        'content',
        'author_name',
        'author_avatar',
        'tags',
        'date',
    ];

    protected $casts = [
        'tags' => 'array',
        'date' => 'datetime',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
