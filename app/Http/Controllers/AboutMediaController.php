<?php

namespace App\Http\Controllers;

use App\Models\AboutMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Throwable;

class AboutMediaController extends Controller
{
    public function edit()
    {
        return view('admin.about-media', ['media' => AboutMedia::find(1)]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'portrait' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'research' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'resume' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
        ]);

        $paths = [];
        $oldPaths = [];
        try {
            foreach (array_keys(AboutMedia::DEFAULTS) as $field) {
                if ($request->hasFile($field)) {
                    $path = $request->file($field)->store('about', 'local');
                    if ($path === false) {
                        throw new RuntimeException('Unable to store uploaded file.');
                    }
                    $paths[$field] = $path;
                }
            }
            if ($paths) {
                DB::transaction(function () use ($paths, &$oldPaths) {
                    AboutMedia::firstOrCreate(['id' => 1]);
                    $media = AboutMedia::whereKey(1)->lockForUpdate()->firstOrFail();
                    foreach ($paths as $field => $path) {
                        if ($media->$field) {
                            $oldPaths[] = $media->$field;
                        }
                        $media->$field = $path;
                    }
                    $media->save();
                });
            }
        } catch (Throwable $exception) {
            Storage::disk('local')->delete(array_values($paths));
            throw $exception;
        }

        Storage::disk('local')->delete($oldPaths);

        $redirect = in_array($request->input('_editor'), array_keys(AboutMedia::DEFAULTS), true)
            ? redirect()->to(route('about').'#edit-'.$request->input('_editor')) : back();

        return $redirect->with('status', $paths ? 'About page media updated.' : 'No new files selected. Existing files kept.');
    }

    public function show(string $kind)
    {
        abort_unless(array_key_exists($kind, AboutMedia::DEFAULTS), 404);
        $media = AboutMedia::find(1);
        $stored = $media?->$kind;
        $path = $stored
            ? Storage::disk('local')->path($stored)
            : public_path(AboutMedia::DEFAULTS[$kind]);
        abort_unless(is_file($path), 404);

        $headers = ['Cache-Control' => 'no-cache, private', 'X-Content-Type-Options' => 'nosniff'];

        return $kind === 'resume'
            ? response()->download($path, 'Gazi_Salah_Uddin_Nuhash_Resume.pdf', $headers)
            : response()->file($path, $headers);
    }
}
