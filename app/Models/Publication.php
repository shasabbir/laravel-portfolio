<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $fillable = [
        'title',
        'authors',
        'venue',
        'year',
        'publication_type',
        'doi',
        'url',
        'pdf',
        'abstract',
        'citation',
    ];

    protected $casts = [
        'citation' => 'array',
    ];
}
