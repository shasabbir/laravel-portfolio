@extends('layouts.app')

@section('title', 'Blog')

@section('content')
<div class="container mx-auto px-4 py-10 md:px-6">
  <div class="mb-8 flex items-center justify-between">
    <h1 class="font-headline text-3xl font-bold">Blog</h1>
    <a href="{{ route('blog.create') }}" class="inline-flex items-center gap-2 rounded-md bg-primary px-4 py-2 text-primary-foreground shadow hover:shadow-md">New Post</a>
  </div>
  <div class="grid grid-cols-1 gap-10">
    @forelse($blogs as $post)
      @php $right = $loop->index % 2 === 1; @endphp
      <article class="grid overflow-hidden rounded-xl border bg-card shadow-sm transition-shadow duration-300 hover:shadow-xl md:grid-cols-2">
        <a class="relative block h-64 w-full md:h-full {{ $right ? 'md:order-last' : '' }}" href="{{ route('blog.show', $post) }}">
          <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="h-full w-full object-cover" />
        </a>
        <div class="flex flex-col justify-between p-6">
          <div>
            <div class="mb-3 flex flex-wrap gap-2">
              @foreach(($post->tags ?? []) as $tag)
                <span class="inline-flex items-center rounded-full bg-secondary px-2.5 py-0.5 text-xs font-medium text-secondary-foreground">{{ $tag }}</span>
              @endforeach
            </div>
            <a href="{{ route('blog.show', $post) }}" class="font-headline mb-3 inline-block text-2xl leading-tight hover:text-primary">{{ $post->title }}</a>
            <p class="text-muted-foreground">{{ $post->excerpt }}</p>
          </div>
          <div class="mt-6 flex w-full items-center justify-between text-sm text-muted-foreground">
            <div class="flex items-center gap-2">
              <img src="{{ $post->author_avatar }}" class="h-8 w-8 rounded-full ring-2 ring-background" alt="{{ $post->author_name }}" />
              <span class="text-xs font-medium">{{ $post->author_name }}</span>
            </div>
            <div class="flex items-center gap-2">
              <a href="{{ route('blog.edit', $post) }}" class="rounded-md border border-border px-3 py-1 hover:bg-accent">Edit</a>
              <form method="POST" action="{{ route('blog.destroy', $post) }}" onsubmit="return confirm('Delete this post?');">
                @csrf
                @method('DELETE')
                <button class="rounded-md border border-destructive px-3 py-1 text-destructive hover:bg-destructive/10">Delete</button>
              </form>
            </div>
          </div>
        </div>
      </article>
    @empty
      <p class="text-muted-foreground">No blog posts yet.</p>
    @endforelse
  </div>
  <div class="mt-10">{{ $blogs->links() }}</div>
</div>
@endsection
