@extends('layouts.app')

@section('title', 'New Publication')

@section('content')
<div class="container mx-auto max-w-3xl px-4 py-10 md:px-6">
  <h1 class="mb-6 text-3xl font-bold">Create Publication</h1>
  <form method="POST" action="{{ route('publications.store') }}" class="space-y-4">
    @csrf
    <div>
      <label class="mb-1 block text-sm">Title</label>
      <input name="title" class="w-full rounded border border-input bg-background px-3 py-2" required />
    </div>
    <div>
      <label class="mb-1 block text-sm">Authors</label>
      <input name="authors" class="w-full rounded border border-input bg-background px-3 py-2" required />
    </div>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
      <div>
        <label class="mb-1 block text-sm">Venue</label>
        <input name="venue" class="w-full rounded border border-input bg-background px-3 py-2" required />
      </div>
      <div>
        <label class="mb-1 block text-sm">Year</label>
        <input name="year" class="w-full rounded border border-input bg-background px-3 py-2" required />
      </div>
      <div>
        <label class="mb-1 block text-sm">Type</label>
        <select name="publication_type" class="w-full rounded border border-input bg-background px-3 py-2" required>
          <option value="Journal">Journal</option>
          <option value="Conference">Conference</option>
          <option value="Preprint">Preprint</option>
        </select>
      </div>
    </div>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
      <div>
        <label class="mb-1 block text-sm">DOI</label>
        <input name="doi" class="w-full rounded border border-input bg-background px-3 py-2" />
      </div>
      <div>
        <label class="mb-1 block text-sm">URL</label>
        <input name="url" class="w-full rounded border border-input bg-background px-3 py-2" />
      </div>
      <div>
        <label class="mb-1 block text-sm">PDF</label>
        <input name="pdf" class="w-full rounded border border-input bg-background px-3 py-2" />
      </div>
    </div>
    <div>
      <label class="mb-1 block text-sm">Abstract</label>
      <textarea name="abstract" class="w-full rounded border border-input bg-background px-3 py-2" rows="6"></textarea>
    </div>
    <div class="flex gap-3">
      <button class="rounded bg-primary px-5 py-2 text-primary-foreground">Create</button>
      <a href="{{ route('publications.index') }}" class="rounded border border-border px-5 py-2">Cancel</a>
    </div>
  </form>
</div>
@endsection
