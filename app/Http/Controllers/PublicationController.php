<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use Illuminate\Support\Facades\Redirect;

class PublicationController extends Controller
{
    public function index()
    {
        $publications = Publication::query()->orderByDesc('year')->paginate(20);
        return view('publications.index', compact('publications'));
    }

    public function create()
    {
        return view('publications.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string'],
            'authors' => ['required', 'string'],
            'venue' => ['required', 'string'],
            'year' => ['required', 'string'],
            'publication_type' => ['required', 'string', 'in:Journal,Conference,Preprint'],
            'doi' => ['nullable', 'string'],
            'url' => ['nullable', 'string'],
            'pdf' => ['nullable', 'string'],
            'abstract' => ['nullable', 'string'],
        ]);

        $publication = Publication::create($data);
        return Redirect::route('publications.index')->with('status', 'Publication created');
    }

    public function edit(Publication $publication)
    {
        return view('publications.edit', compact('publication'));
    }

    public function update(Request $request, Publication $publication)
    {
        $data = $request->validate([
            'title' => ['required', 'string'],
            'authors' => ['required', 'string'],
            'venue' => ['required', 'string'],
            'year' => ['required', 'string'],
            'publication_type' => ['required', 'string', 'in:Journal,Conference,Preprint'],
            'doi' => ['nullable', 'string'],
            'url' => ['nullable', 'string'],
            'pdf' => ['nullable', 'string'],
            'abstract' => ['nullable', 'string'],
        ]);

        $publication->update($data);
        return Redirect::route('publications.index')->with('status', 'Publication updated');
    }

    public function destroy(Publication $publication)
    {
        $publication->delete();
        return Redirect::route('publications.index')->with('status', 'Publication deleted');
    }
}
