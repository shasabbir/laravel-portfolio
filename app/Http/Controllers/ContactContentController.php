<?php

namespace App\Http\Controllers;

use App\Models\ContactContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ContactContentController extends Controller
{
    public function update(Request $request)
    {
        $request->validate(['group' => ['required', 'in:'.implode(',', array_keys(ContactContent::GROUPS))]]);
        $group = $request->input('group');
        $schema = ContactContent::GROUPS[$group];
        $rules = ['values' => ['required', 'array:'.implode(',', $schema['fields'])],
            'uploads' => $schema['images'] ? ['sometimes', 'array:'.implode(',', $schema['images'])] : ['prohibited']];
        foreach ($schema['fields'] as $key) {
            $rules['values.'.$key] = ['sometimes', 'required', 'string', 'max:5000'];
            if ($key === 'email') $rules['values.'.$key][] = 'email';
            if ($key === 'map_url') $rules['values.'.$key] = ['sometimes', 'nullable', 'string', 'max:5000'];
        }
        foreach ($schema['images'] as $key) $rules['uploads.'.$key] = ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'];
        $data = $request->validate($rules);
        if ($group === 'contact-map' && array_key_exists('map_url', $data['values'])) {
            $data['values']['map_url'] = trim($data['values']['map_url'] ?? '');
            $data['values']['map_embed_url'] = $data['values']['map_url'] !== ''
                ? app(\App\Support\GoogleMapLink::class)->embed($data['values']['map_url']) : null;
        }
        $paths = [];
        $obsolete = [];
        try {
            foreach ($schema['images'] as $key) {
                if ($request->hasFile('uploads.'.$key)) {
                    $path = $request->file('uploads.'.$key)->store('contact', 'local');
                    if (!$path) throw new \RuntimeException('Unable to save image.');
                    $paths[$key] = $path;
                }
            }
            DB::transaction(function () use ($data, $paths, &$obsolete) {
                ContactContent::firstOrCreate(['id' => 1]);
                $content = ContactContent::whereKey(1)->lockForUpdate()->firstOrFail();
                $images = $content->images ?? [];
                foreach ($paths as $key => $path) {
                    if (!empty($images[$key])) $obsolete[] = $images[$key];
                    $images[$key] = $path;
                }
                $content->update(['values' => array_replace($content->values ?? [], $data['values']), 'images' => $images]);
            });
        } catch (\Throwable $error) {
            Storage::disk('local')->delete(array_values($paths));
            throw $error;
        }
        Storage::disk('local')->delete($obsolete);
        return redirect()->to(route('contact.show').'#edit-'.$group)->with('editor_status', 'Contact page updated.');
    }

    public function media(string $key)
    {
        abort_unless(in_array($key, ['location', 'email', 'hours'], true), 404);
        $path = (ContactContent::find(1)?->images ?? [])[$key] ?? null;
        abort_unless($path && Storage::disk('local')->exists($path), 404);
        return response()->file(Storage::disk('local')->path($path), ['Cache-Control' => 'no-cache, private', 'X-Content-Type-Options' => 'nosniff']);
    }
}
