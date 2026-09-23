<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutContent extends Model
{
    protected $table = 'about_content';

    protected $fillable = ['experiences', 'educations', 'additional_experience'];

    protected function casts(): array
    {
        return ['experiences' => 'array', 'educations' => 'array'];
    }
}
