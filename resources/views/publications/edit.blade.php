@extends('layouts.app')

@section('title', 'Edit Publication')

@section('content')
    <div class="container mx-auto max-w-3xl px-4 py-10 md:px-6">
        <h1 class="mb-6 text-3xl font-bold">Edit Publication</h1>
        <form method="POST" action="{{ route('publications.update', $publication) }}" class="space-y-4"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <label class="mb-1 block text-sm">Title</label>
                <input name="title" value="{{ old('title', $publication->title) }}"
                    class="w-full rounded border border-input bg-background px-3 py-2" required />
            </div>
            <div>
                <label class="mb-1 block text-sm">Authors</label>
                <input name="authors" value="{{ old('authors', $publication->authors) }}"
                    class="w-full rounded border border-input bg-background px-3 py-2" required />
            </div>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div>
                    <label class="mb-1 block text-sm">Venue</label>
                    <input name="venue" value="{{ old('venue', $publication->venue) }}"
                        class="w-full rounded border border-input bg-background px-3 py-2" required />
                </div>
                <div>
                    <label class="mb-1 block text-sm">Year</label>
                    <input name="year" value="{{ old('year', $publication->year) }}"
                        class="w-full rounded border border-input bg-background px-3 py-2" required />
                </div>
                <div>
                    <label class="mb-1 block text-sm">Type</label>
                    <select name="publication_type" class="w-full rounded border border-input bg-background px-3 py-2"
                        required>
                        @foreach (['Journal', 'Conference', 'Preprint'] as $type)
                            <option value="{{ $type }}" @selected($publication->publication_type === $type)>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div>
                    <label class="mb-1 block text-sm">DOI</label>
                    <input name="doi" value="{{ old('doi', $publication->doi) }}"
                        class="w-full rounded border border-input bg-background px-3 py-2" />
                </div>
                <div>
                    <label class="mb-1 block text-sm">URL</label>
                    <input name="url" value="{{ old('url', $publication->url) }}"
                        class="w-full rounded border border-input bg-background px-3 py-2" />
                </div>
                <div>
                    <label class="mb-1 block text-sm">PDF File</label>
                    <input type="file" name="pdf" accept=".pdf"
                        class="w-full rounded border border-input bg-background px-3 py-2" />
                    <p class="mt-1 text-xs text-muted-foreground">Upload a PDF file (max 10MB)</p>
                    @if ($publication->pdf)
                        <p class="mt-2 text-xs text-muted-foreground">Current: <a href="{{ $publication->pdf }}"
                                target="_blank" class="text-primary hover:underline">View PDF</a></p>
                    @endif
                </div>
            </div>
            <div>
                <label class="mb-1 block text-sm">Abstract</label>
                <textarea name="abstract" class="w-full rounded border border-input bg-background px-3 py-2" rows="6">{{ old('abstract', $publication->abstract) }}</textarea>
            </div>
            <div class="flex gap-3">
                <button class="rounded bg-primary px-5 py-2 text-primary-foreground">Update</button>
                <a href="{{ route('publications.index') }}" class="rounded border border-border px-5 py-2">Cancel</a>
            </div>
        </form>
    </div>
@endsection
