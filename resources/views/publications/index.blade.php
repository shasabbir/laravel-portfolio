@extends('layouts.app')

@section('title', 'Publications')

@section('content')
<div class="container mx-auto px-4 py-10 md:px-6">
  <div class="mb-8 flex items-center justify-between">
    <h1 class="font-headline text-3xl font-bold">Publications</h1>
    <a href="{{ route('publications.create') }}" class="inline-flex items-center gap-2 rounded-md bg-primary px-4 py-2 text-primary-foreground shadow hover:shadow-md">New Publication</a>
  </div>
  <div class="grid grid-cols-1 gap-6">
    @forelse($publications as $pub)
      @php
        $type = strtolower($pub->publication_type ?? '');
      @endphp
      <div class="rounded-xl border bg-card p-5 shadow-sm transition hover:shadow-md">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
          <div class="min-w-0 flex-1">
            <div class="mb-1 flex items-center gap-2">
              <span class="inline-flex items-center rounded-full bg-secondary px-2.5 py-0.5 text-xs font-medium text-secondary-foreground">
                {{ ucfirst($pub->publication_type) }}
              </span>
              @if($pub->doi)
                <a href="https://doi.org/{{ $pub->doi }}" target="_blank" class="text-xs text-primary hover:underline">DOI: {{ $pub->doi }}</a>
              @endif
            </div>
            <h3 class="font-headline text-xl font-semibold leading-snug">{{ $pub->title }}</h3>
            <p class="mt-1 text-sm text-muted-foreground">{{ $pub->authors }} • {{ $pub->venue }} • {{ $pub->year }}</p>
            @if($pub->abstract)
              <p class="mt-3 text-sm text-muted-foreground">{{ \Illuminate\Support\Str::limit($pub->abstract, 220) }}</p>
            @endif
          </div>
          <div class="flex shrink-0 items-center gap-2 self-start">
            @if($pub->url)
              <a href="{{ $pub->url }}" target="_blank" class="rounded-md border border-border px-3 py-1 text-sm hover:bg-accent">Link</a>
            @endif
            @if($pub->pdf)
              <a href="{{ $pub->pdf }}" target="_blank" class="rounded-md border border-border px-3 py-1 text-sm hover:bg-accent">PDF</a>
            @endif
            <a href="{{ route('publications.edit', $pub) }}" class="rounded-md border border-border px-3 py-1 text-sm hover:bg-accent">Edit</a>
            <form method="POST" action="{{ route('publications.destroy', $pub) }}" onsubmit="return confirm('Delete this publication?');">
              @csrf
              @method('DELETE')
              <button class="rounded-md border border-destructive px-3 py-1 text-sm text-destructive hover:bg-destructive/10">Delete</button>
            </form>
          </div>
        </div>
      </div>
    @empty
      <p class="text-muted-foreground">No publications yet.</p>
    @endforelse
  </div>
  <div class="mt-10">{{ $publications->links() }}</div>
</div>
@endsection
