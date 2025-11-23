@extends('layouts.app')

@section('title', $blog->title)

@section('content')
<div class="container mx-auto px-4 py-10 md:px-6">
  <article class="mx-auto max-w-3xl">
    @php($fallbackImage = asset('images/nuhash.jpg'))
    @php($authorImage = asset('images/nuhash.jpg'))
    <img src="{{ $blog->image_url ?: $fallbackImage }}" alt="{{ $blog->title }}" class="mb-6 h-64 w-full rounded object-cover md:h-96" />
    <h1 class="font-headline mb-2 text-4xl font-bold">{{ $blog->title }}</h1>
    <div class="mb-6 flex flex-col gap-4 text-sm text-muted-foreground md:flex-row md:items-center md:justify-between">
      <div class="flex items-center gap-3">
        <img src="/storage/images/nuhash.jpg" class="h-8 w-8 rounded-full" alt="{{ $blog->author_name }}" />
        <span>{{ $blog->author_name }}</span>
        <span>•</span>
        <time datetime="{{ $blog->date?->toDateString() }}">{{ optional($blog->date)->format('M d, Y') }}</time>
      </div>
      @auth
      <div class="flex flex-wrap gap-3">
        <a href="{{ route('blog.edit', $blog) }}" class="inline-flex items-center gap-2 rounded bg-blue-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
          <span>Edit</span>
        </a>
        <form method="POST" action="{{ route('blog.destroy', $blog) }}" onsubmit="return confirm('Delete this blog post?');" class="inline-flex">
          @csrf
          @method('DELETE')
          <button type="submit" class="inline-flex items-center gap-2 rounded bg-red-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
            <span>Delete</span>
          </button>
        </form>
      </div>
      @endauth
    </div>
    <div class="prose prose-slate max-w-none dark:prose-invert">
      {!! nl2br(e($blog->content)) !!}
    </div>
  </article>
</div>
@endsection
