@extends('layouts.app')

@section('title', $blog->title)

@section('content')
<div class="container mx-auto px-4 py-10 md:px-6">
  <article class="mx-auto max-w-3xl">
    @php($fallbackImage = asset('images/nuhash.jpg'))
    @php($authorImage = asset('images/nuhash.jpg'))
    <img src="{{ $blog->image_url ?: $fallbackImage }}" alt="{{ $blog->title }}" class="mb-6 h-64 w-full rounded object-cover md:h-96" />
    <h1 class="font-headline mb-2 text-4xl font-bold">{{ $blog->title }}</h1>
    <div class="mb-6 flex items-center gap-3 text-sm text-muted-foreground">
      <img src="{{ $authorImage }}" class="h-8 w-8 rounded-full" alt="{{ $blog->author_name }}" />
      <span>{{ $blog->author_name }}</span>
      <span>•</span>
      <time datetime="{{ $blog->date?->toDateString() }}">{{ optional($blog->date)->format('M d, Y') }}</time>
    </div>
    <div class="prose prose-slate max-w-none dark:prose-invert">
      {!! nl2br(e($blog->content)) !!}
    </div>
  </article>
</div>
@endsection
