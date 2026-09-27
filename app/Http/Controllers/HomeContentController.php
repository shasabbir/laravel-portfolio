<?php

namespace App\Http\Controllers;

use App\Models\HomeContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use RuntimeException;
use Throwable;

class HomeContentController extends Controller
{
    public function edit()
    {
        return redirect()->to(route('home').'#edit-hero');
    }

    public function update(Request $request)
    {
        if ($request->has('values')) {
            return $this->updateSection($request);
        }
        $request->validate([
            'field' => ['required', Rule::in(array_keys(HomeContent::fields()))],
            '_editor' => ['nullable', Rule::in(array_keys(HomeContent::sections()))],
        ]);
        $key = $request->string('field')->toString();
        $field = HomeContent::fields()[$key];
        $rules = ['nullable', 'string', 'max:10000'];
        if ($field['type'] !== 'text') {
            $rules[] = function ($attribute, $value, $fail) {
                if (!preg_match('~^(?:https?://[^\s]+|/(?!/)[^\s\\\\]*)$~i', $value)) {
                    $fail('Enter an http(s) URL or a local path beginning with /.');
                }
            };
        }
        $request->validate([
            'value' => $rules,
            'upload' => $field['type'] === 'image'
                ? ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:5120']
                : ($field['type'] === 'video' ? ['nullable', 'file', 'mimes:mp4,webm', 'max:20480'] : ['prohibited']),
            'reset' => ['nullable', 'boolean'],
        ]);

        $path = null;
        $oldPath = null;
        try {
            if (!$request->boolean('reset') && $request->hasFile('upload')) {
                $path = $request->file('upload')->store('home', 'local');
                if (!$path) {
                    throw new RuntimeException('Unable to save uploaded file.');
                }
            }
            DB::transaction(function () use ($request, $key, $path, &$oldPath) {
                HomeContent::firstOrCreate(['id' => 1]);
                $content = HomeContent::whereKey(1)->lockForUpdate()->firstOrFail();
                $values = $content->values ?? [];
                $oldPath = $values[$key.'_file'] ?? null;
                if ($request->boolean('reset')) {
                    unset($values[$key], $values[$key.'_file']);
                    foreach (HomeContent::fields()[$key]['parts'] ?? [] as $part) {
                        unset($values[$part]);
                    }
                } elseif ($path) {
                    $values[$key] = route('home.media', ['key' => $key], false);
                    $values[$key.'_file'] = $path;
                } else {
                    $values[$key] = $request->input('value') ?? '';
                    if ($values[$key] === route('home.media', ['key' => $key], false)) {
                        $oldPath = null;
                    } else {
                        unset($values[$key.'_file']);
                    }
                }
                $content->values = $values;
                $content->save();
            });
        } catch (Throwable $exception) {
            if ($path) Storage::disk('local')->delete($path);
            throw $exception;
        }
        if ($oldPath) Storage::disk('local')->delete($oldPath);

        $section = $request->input('_editor');
        if (!$section || !in_array($key, HomeContent::sections()[$section]['fields'], true)) {
            $section = collect(HomeContent::sections())->search(fn ($section) => in_array($key, $section['fields'], true));
        }

        $section = $section ?: 'membership';

        return redirect()->to(route('home').'#edit-'.$section)
            ->with('status', 'Homepage updated.')->with('home_editor', $section);
    }

    private function updateSection(Request $request)
    {
        $request->validate(['_editor' => ['required', Rule::in(array_keys(HomeContent::sections()))]]);
        $section = $request->input('_editor');
        $keys = HomeContent::sections()[$section]['fields'];
        $rules = [
            'values' => ['required', 'array:'.implode(',', $keys)],
            'uploads' => ['sometimes', 'array:'.implode(',', $keys)],
            'resets' => ['sometimes', 'array:'.implode(',', $keys)],
        ];
        foreach ($keys as $key) {
            $type = HomeContent::fields()[$key]['type'];
            $rules['values.'.$key] = ['present', 'nullable', 'string', 'max:10000'];
            if ($type !== 'text') {
                $rules['values.'.$key][] = function ($attribute, $value, $fail) {
                    if (!preg_match('~^(?:https?://[^\\s]+|/(?!/)[^\\s\\\\\\\\]*)$~i', $value)) {
                        $fail('Enter an http(s) URL or a local path beginning with /.');
                    }
                };
            }
            $rules['uploads.'.$key] = match ($type) {
                'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:5120'],
                'video' => ['nullable', 'file', 'mimes:mp4,webm', 'max:20480'],
                default => ['prohibited'],
            };
            $rules['resets.'.$key] = ['sometimes', 'boolean'];
        }
        $data = $request->validate($rules);
        $paths = [];
        $obsolete = [];
        try {
            foreach ($keys as $key) {
                if (empty($data['resets'][$key]) && $request->hasFile('uploads.'.$key)) {
                    $path = $request->file('uploads.'.$key)->store('home', 'local');
                    if (!$path) throw new RuntimeException('Unable to save uploaded file.');
                    $paths[$key] = $path;
                }
            }
            DB::transaction(function () use ($data, $keys, $paths, &$obsolete) {
                HomeContent::firstOrCreate(['id' => 1]);
                $content = HomeContent::whereKey(1)->lockForUpdate()->firstOrFail();
                $values = $content->values ?? [];
                foreach ($keys as $key) {
                    $oldPath = $values[$key.'_file'] ?? null;
                    if (!empty($data['resets'][$key])) {
                        unset($values[$key], $values[$key.'_file']);
                        foreach (HomeContent::fields()[$key]['parts'] ?? [] as $part) unset($values[$part]);
                    } elseif (isset($paths[$key])) {
                        $values[$key] = route('home.media', ['key' => $key], false);
                        $values[$key.'_file'] = $paths[$key];
                    } else {
                        $values[$key] = $data['values'][$key] ?? '';
                        if ($values[$key] !== route('home.media', ['key' => $key], false)) unset($values[$key.'_file']);
                    }
                    if ($oldPath && $oldPath !== ($values[$key.'_file'] ?? null)) $obsolete[] = $oldPath;
                }
                $content->values = $values;
                $content->save();
            });
        } catch (Throwable $exception) {
            foreach ($paths as $path) Storage::disk('local')->delete($path);
            throw $exception;
        }
        foreach ($obsolete as $path) Storage::disk('local')->delete($path);
        return redirect()->to(route('home').'#edit-'.$section)
            ->with('status', 'Homepage updated.')->with('home_editor', $section);
    }

    public function media(string $key)
    {
        abort_unless(in_array(HomeContent::fields()[$key]['type'] ?? null, ['image', 'video']), 404);
        $path = (HomeContent::find(1)?->values ?? [])[$key.'_file'] ?? null;
        abort_unless($path && Storage::disk('local')->exists($path), 404);

        return response()->file(Storage::disk('local')->path($path), [
            'Cache-Control' => 'no-cache, private', 'X-Content-Type-Options' => 'nosniff',
        ]);
    }
}
