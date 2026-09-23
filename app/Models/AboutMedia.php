<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutMedia extends Model
{
    protected $table = 'about_media';

    protected $fillable = ['portrait', 'research', 'resume'];

    public const DEFAULTS = [
        'portrait' => 'images/nuhash.jpg',
        'research' => 'images/neurodegeneration-illustration.png',
        'resume' => 'resume-gazi-salah-uddin-nuhash.pdf',
    ];
}
