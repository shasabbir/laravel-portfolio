<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeContent extends Model
{
    protected $table = 'home_content';
    protected $guarded = [];
    protected function casts(): array
    {
        return ['values' => 'array'];
    }

    public static function fields(): array
    {
        static $fields;
        return $fields ??= json_decode(file_get_contents(config_path('home-content.json')), true, 512, JSON_THROW_ON_ERROR);
    }

    public static function sections(): array
    {
        static $sections;
        return $sections ??= json_decode(file_get_contents(config_path('home-sections.json')), true, 512, JSON_THROW_ON_ERROR);
    }

    public function value(string $key): string
    {
        if (!array_key_exists($key, $this->values ?? []) && isset(self::fields()[$key]['parts'])) {
            $parts = array_map(fn ($part) => $this->value($part), self::fields()[$key]['parts']);
            return $key === 'membership_paragraph'
                ? trim($parts[0]).' **'.trim($parts[1]).'**'. $parts[2]
                : implode(self::fields()[$key]['join'] ?? ' ', array_map('trim', $parts));
        }
        return ($this->values ?? [])[$key] ?? self::fields()[$key]['default'] ?? '';
    }

    public static function formatText(string $text): string
    {
        // Escape everything first; only our bold markers produce HTML.
        return nl2br(preg_replace('/\*\*(.+?)\*\*/s', '<strong>$1</strong>', e($text)));
    }

    public function formatted(string $key): string
    {
        return self::formatText($this->value($key));
    }
}
