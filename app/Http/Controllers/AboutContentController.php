<?php

namespace App\Http\Controllers;

use App\Models\AboutContent;
use Illuminate\Http\Request;

class AboutContentController extends Controller
{
    public function show()
    {
        return view('about', ['content' => AboutContent::findOrFail(1)]);
    }

    public function edit()
    {
        return view('admin.about-content', ['content' => AboutContent::findOrFail(1)]);
    }

    public function update(Request $request)
    {
        $request->validate(['section' => ['nullable', 'in:experiences,educations']]);
        $selected = $request->input('section');
        $rules = ['additional_experience' => ['nullable', 'string', 'max:5000']];
        foreach (['experiences', 'educations'] as $section) {
            $rules[$section] = ['sometimes', 'array', 'max:50'];
            $keys = 'period,title,organization,description'.($section === 'educations' ? ',badge,color' : '');
            $rules[$section.'.*'] = ['required', 'array:'.$keys];
            foreach (['period' => 100, 'title' => 255, 'organization' => 255] as $field => $max) {
                $rules[$section.'.*.'.$field] = ['required', 'string', 'max:'.$max];
            }
            $rules[$section.'.*.description'] = ['nullable', 'string', 'max:5000'];
        }
        $rules['educations.*.badge'] = ['nullable', 'string', 'max:10'];
        $rules['educations.*.color'] = ['required', 'regex:/\A#[0-9a-fA-F]{6}\z/'];
        $data = $request->validate($rules);
        $data['experiences'] = array_values($data['experiences'] ?? []);
        $data['educations'] = array_values($data['educations'] ?? []);
        $data['additional_experience'] = $data['additional_experience'] ?? null;
        if ($selected) {
            $data = array_intersect_key($data, array_flip($selected === 'experiences'
                ? ['experiences', 'additional_experience'] : ['educations']));
        }
        AboutContent::findOrFail(1)->update($data);

        if ($selected) {
            return redirect()->to(route('about').'#edit-'.$selected)->with('status', 'About page content updated.');
        }
        return redirect()->route('admin.about-content.edit')->with('status', 'About page content updated.');
    }
}
