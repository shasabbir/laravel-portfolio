<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    public function pdfPath(): ?string
    {
        $path = parse_url($this->pdf ?? '', PHP_URL_PATH);
        if (!is_string($path)) return null;
        $path = preg_replace('~^/?storage/~', '', $path);
        return preg_match('~\Apublications/[a-zA-Z0-9_.-]+\.pdf\z~i', $path) ? $path : null;
    }

    public function pdfUrl(): ?string
    {
        if ($this->pdfPath()) return route('publications.pdf', $this);
        return filter_var($this->pdf, FILTER_VALIDATE_URL) && in_array(parse_url($this->pdf, PHP_URL_SCHEME), ['http', 'https'], true) ? $this->pdf : null;
    }

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
