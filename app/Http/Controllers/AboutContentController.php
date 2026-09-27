<?php

namespace App\Http\Controllers;

use App\Models\AboutContent;
use Illuminate\Http\Request;

class AboutContentController extends Controller
{
    public function show()
    {
        return view('about', ['content' => AboutContent::findOrFail(1), 'aboutMedia' => \App\Models\AboutMedia::find(1)]);
    }

    public function edit()
    {
        return redirect()->to(route('about').'#edit-experiences');
    }

    public function update(Request $request)
    {
        $request->validate(['section' => ['nullable', 'in:'.implode(',', [...array_keys(AboutContent::SECTIONS), 'page_text'])]]);
        $selected = $request->input('section');
        if ($selected === 'page_text') {
            $request->validate(['text_group' => ['required', 'in:'.implode(',', array_keys(AboutContent::TEXT_GROUPS))]]);
            $group = $request->input('text_group');
            $fields = AboutContent::TEXT_GROUPS[$group]['fields'];
            $rules = ['page_text' => ['required', 'array:'.implode(',', $fields)]];
            foreach ($fields as $key) {
                $rules['page_text.'.$key] = ['sometimes', 'required', 'string', 'max:5000'];
            }
            $validated = $request->validate($rules);
            $content = AboutContent::findOrFail(1);
            $content->update(['page_text' => array_replace($content->page_text ?? [], $validated['page_text'])]);

            return redirect()->to(route('about').'#edit-'.$group)->with('status', 'About page text updated.');
        }
        $rules = ['additional_experience' => ['nullable', 'string', 'max:5000']];
        foreach (['experiences', 'educations'] as $section) {
            $rules[$section] = ['sometimes', 'array', 'max:50'];
            $keys = 'period,title,organization,description'.($section === 'educations' ? ',badge,color,media_id' : '');
            $rules[$section.'.*'] = ['required', 'array:'.$keys];
            foreach (['period' => 100, 'title' => 255, 'organization' => 255] as $field => $max) {
                $rules[$section.'.*.'.$field] = ['required', 'string', 'max:'.$max];
            }
            $rules[$section.'.*.description'] = ['nullable', 'string', 'max:5000'];
        }
        $rules['educations.*.badge'] = ['nullable', 'string', 'max:10'];
        $rules['educations.*.color'] = ['required', 'regex:/\A#[0-9a-fA-F]{6}\z/'];
        foreach (['methods' => ['title', 'description', 'icon'], 'manuscripts' => ['title', 'status', 'authors'], 'highlights' => ['title', 'description']] as $section => $fields) {
            $rules[$section] = ['sometimes', 'array', 'max:50'];
            $rules[$section.'.*'] = ['required', 'array:'.implode(',', $fields).($section === 'methods' ? ',media_id' : '')];
            foreach ($fields as $field) {
                $rules[$section.'.*.'.$field] = ['required', 'string', 'max:'.($field === 'description' ? 5000 : 500)];
            }
        }
        $rules['methods.*.icon'] = ['required', 'in:flask,code,brain,dna,molecule'];
        foreach (['educations', 'methods'] as $section) {
            $rules[$section.'.*.media_id'] = ['sometimes', 'nullable', 'uuid', 'distinct'];
        }
        $data = $request->validate($rules);
        $data['experiences'] = array_values($data['experiences'] ?? []);
        $data['educations'] = array_values($data['educations'] ?? []);
        $data['additional_experience'] = $data['additional_experience'] ?? null;
        if ($selected) {
            $data[$selected] = array_values($data[$selected] ?? []);
            $data = array_intersect_key($data, array_flip($selected === 'experiences'
                ? ['experiences', 'additional_experience'] : [$selected]));
        }
        foreach (['educations', 'methods'] as $section) {
            if (!isset($data[$section])) continue;
            foreach ($data[$section] as &$entry) {
                $entry['media_id'] = $entry['media_id'] ?? (string) \Illuminate\Support\Str::uuid();
            }
            unset($entry);
        }
        AboutContent::findOrFail(1)->update($data);

        if ($selected) {
            return redirect()->to(route('about').'#edit-'.$selected)->with('status', 'About page content updated.');
        }
        return redirect()->route('about')->with('status', 'About page content updated.');
    }
}
