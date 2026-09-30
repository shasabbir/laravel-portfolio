<?php

namespace App\Support;

use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class GoogleMapLink
{
    private function reject(): never
    {
        throw ValidationException::withMessages(['values.map_url' => 'Paste a Google Maps location, share or embed link. If a short link cannot be opened, open it in your browser and copy the full URL.']);
    }

    private function check(string $url): array
    {
        $parts = parse_url($url);
        if (!$parts || ($parts['scheme'] ?? '') !== 'https' || isset($parts['user']) || isset($parts['pass']) || isset($parts['port'])
            || !in_array(strtolower($parts['host'] ?? ''), ['www.google.com', 'google.com', 'maps.google.com', 'maps.app.goo.gl', 'goo.gl'], true)) $this->reject();
        return $parts;
    }

    public function embed(string $url): string
    {
        $url = trim($url);
        for ($hop = 0; $hop < 5; $hop++) {
            $parts = $this->check($url);
            $host = strtolower($parts['host']);
            if (!in_array($host, ['maps.app.goo.gl', 'goo.gl'], true)) break;
            if ($host === 'goo.gl' && !str_starts_with($parts['path'] ?? '', '/maps/')) $this->reject();
            try {
                $response = Http::withOptions(['allow_redirects' => false])->connectTimeout(3)->timeout(8)->get($url);
            } catch (\Throwable) {
                $this->reject();
            }
            if (!$response->redirect() || !$response->header('Location')) $this->reject();
            $url = $response->header('Location');
        }
        $parts = $this->check($url);
        $path = $parts['path'] ?? '';
        if (!in_array(strtolower($parts['host']), ['www.google.com', 'google.com', 'maps.google.com'], true)
            || (!str_starts_with($path, '/maps') && $path !== '/')) $this->reject();
        parse_str($parts['query'] ?? '', $query);
        if ($path === '/maps/embed' && !empty($query['pb']) && is_string($query['pb'])) return $url;
        $location = $query['q'] ?? $query['query'] ?? $query['destination'] ?? null;
        $decoded = urldecode($url);
        // A place's coordinates are more precise than the map camera position.
        if (!$location && preg_match('/!3d(-?\d+(?:\.\d+)?)!4d(-?\d+(?:\.\d+)?)/', $decoded, $match)) $location = $match[1].','.$match[2];
        if (!$location && preg_match('~/maps/(?:place|search)/([^/]+)~', urldecode($path), $match)) $location = $match[1];
        if (!$location && preg_match('/@(-?\d+(?:\.\d+)?),(-?\d+(?:\.\d+)?)/', $decoded, $match)) $location = $match[1].','.$match[2];
        if (!is_string($location) || trim($location) === '') $this->reject();
        return 'https://maps.google.com/maps?q='.rawurlencode($location).'&z=15&output=embed';
    }
}
