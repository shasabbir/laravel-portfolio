@extends('layouts.app')

@section('title', 'New Blog Post')

@section('content')
<div class="container mx-auto max-w-3xl px-4 py-10 md:px-6">
  <h1 class="mb-6 text-3xl font-bold">Create Blog Post</h1>
  <form method="POST" action="{{ route('blog.store') }}" enctype="multipart/form-data" class="space-y-4">
    @csrf
    <div>
      <label class="mb-1 block text-sm">Title</label>
      <input name="title" class="w-full rounded border border-input bg-background px-3 py-2" required />
      @error('title')<p class="text-sm text-destructive">{{ $message }}</p>@enderror
    </div>
    <div>
      <label class="mb-1 block text-sm">Excerpt</label>
      <textarea name="excerpt" class="w-full rounded border border-input bg-background px-3 py-2" rows="3" required></textarea>
      @error('excerpt')<p class="text-sm text-destructive">{{ $message }}</p>@enderror
    </div>
    <div>
      <label class="mb-1 block text-sm">Content</label>
      <textarea name="content" class="w-full rounded border border-input bg-background px-3 py-2" rows="8" required></textarea>
      @error('content')<p class="text-sm text-destructive">{{ $message }}</p>@enderror
    </div>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
      <div>
        <label class="mb-1 block text-sm">Image URL</label>
        <input name="image_url" class="w-full rounded border border-input bg-background px-3 py-2" />
        <p class="mt-1 text-xs text-muted-foreground">Provide a URL or upload a file below.</p>
        @error('image_url')<p class="text-sm text-destructive">{{ $message }}</p>@enderror
      </div>
      <div>
        <label class="mb-1 block text-sm">Image Hint</label>
        <input name="image_hint" class="w-full rounded border border-input bg-background px-3 py-2" required />
        @error('image_hint')<p class="text-sm text-destructive">{{ $message }}</p>@enderror
      </div>
    </div>
    <div>
      <label class="mb-1 block text-sm">Or Upload Image</label>
      <input type="file" name="image" accept="image/*" class="w-full rounded border border-input bg-background px-3 py-2" />
      @error('image')<p class="text-sm text-destructive">{{ $message }}</p>@enderror
    </div>
    <div>
      <label class="mb-1 block text-sm">Tags (comma separated)</label>
      <input name="tags" class="w-full rounded border border-input bg-background px-3 py-2" />
      @error('tags')<p class="text-sm text-destructive">{{ $message }}</p>@enderror
    </div>
    <div>
      <label class="mb-1 block text-sm">Slug (optional)</label>
      <input name="slug" class="w-full rounded border border-input bg-background px-3 py-2" />
      @error('slug')<p class="text-sm text-destructive">{{ $message }}</p>@enderror
    </div>
    <div class="flex gap-3">
      <button class="rounded bg-primary px-5 py-2 text-primary-foreground">Create</button>
      <a href="{{ route('blog.index') }}" class="rounded border border-border px-5 py-2">Cancel</a>
    </div>
  </form>
</div>
@endsection
