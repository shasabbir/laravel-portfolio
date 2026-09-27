<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class PublicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'pdf']);
    }

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
            'pdf' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'abstract' => ['nullable', 'string'],
        ]);

        // Handle PDF file upload
        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('publications', 'public');
            if (!$pdfPath) throw new \RuntimeException('Unable to store PDF.');
            $data['pdf'] = $pdfPath;
        }

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
            'pdf' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'abstract' => ['nullable', 'string'],
        ]);

        // Handle PDF file upload
        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('publications', 'public');
            if (!$pdfPath) throw new \RuntimeException('Unable to store PDF.');
            $data['pdf'] = $pdfPath;
        } else {
            unset($data['pdf']);
        }

        $publication->update($data);
        return Redirect::route('publications.index')->with('status', 'Publication updated');
    }

    public function destroy(Publication $publication)
    {
        $publication->delete();
        return Redirect::route('publications.index')->with('status', 'Publication deleted');
    }

    public function pdf(Publication $publication)
    {
        $path = $publication->pdfPath();
        abort_unless($path && Storage::disk('public')->exists($path), 404, 'PDF file not found. Please upload the PDF again.');
        return response()->file(Storage::disk('public')->path($path), [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="publication-'.$publication->id.'.pdf"',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }
}
