<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutContent extends Model
{
    protected $table = 'about_content';

    protected $fillable = ['experiences', 'educations', 'additional_experience', 'methods', 'manuscripts', 'highlights'];

    public const SECTIONS = [
        'experiences' => 'Research & work', 'educations' => 'Academic path',
        'methods' => 'Methods & tools', 'manuscripts' => 'Manuscripts', 'highlights' => 'Selected highlights',
    ];

    protected function casts(): array
    {
        return array_fill_keys(array_keys(self::SECTIONS), 'array');
    }
}
