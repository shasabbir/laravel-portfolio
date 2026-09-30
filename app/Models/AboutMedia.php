<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutMedia extends Model
{
    protected $table = 'about_media';

    protected $fillable = ['portrait', 'research', 'resume', 'images'];

    protected function casts(): array
    {
        return ['images' => 'array'];
    }

    public const ICONS = [
        'identity_question' => 'brain', 'identity_lens' => 'dna', 'identity_approach' => 'molecule',
        'focus_first' => 'brain', 'focus_second' => 'dna', 'focus_third' => 'molecule',
    ];

    public static function imageKeys(): array
    {
        $keys = array_keys(self::ICONS);
        $content = AboutContent::find(1);
        foreach (['educations', 'methods'] as $section) {
            foreach ($content?->$section ?? [] as $entry) {
                if (!empty($entry['media_id'])) $keys[] = $section.'_'.$entry['media_id'];
            }
        }
        return $keys;
    }

    public function imagePath(string $key): ?string
    {
        return ($this->images ?? [])[$key] ?? null;
    }

    public const DEFAULTS = [
        'portrait' => 'images/nuhash.jpg',
        'research' => 'images/neurodegeneration-illustration.png',
        'resume' => 'resume-gazi-salah-uddin-nuhash.pdf',
    ];
}
