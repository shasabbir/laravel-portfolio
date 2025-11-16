@extends('layouts.app')

@section('title', 'Blog')

@section('content')
    <div class="container mx-auto px-4 py-10 md:px-6">
        @php
            $featured = $blogs->first();
        @endphp

        {{-- Page header --}}
        <section
            class="mb-10 flex flex-col gap-4 border-b border-border/50 pb-6 md:flex-row md:items-center md:justify-between">
            <div class="space-y-2">
                <p class="text-xs font-semibold uppercase tracking-[0.25em] text-muted-foreground">
                    Insights & Reflections
                </p>
                <h1 class="font-headline text-3xl font-bold md:text-4xl">
                    Blog
                </h1>
                <p class="max-w-2xl text-sm text-muted-foreground md:text-base">
                    Long-form thoughts, research stories, and behind-the-scenes notes from Nuhash Gazi’s work in life
                    sciences, academia, and beyond.
                </p>
            </div>

            @auth
                <div class="flex justify-start md:justify-end">
                    <a href="{{ route('blog.create') }}"
                       class="inline-flex items-center gap-2 rounded-full bg-primary px-5 py-2.5 text-sm font-semibold text-primary-foreground shadow-lg shadow-primary/20 transition hover:-translate-y-0.5 hover:shadow-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 5v14" />
                            <path d="M5 12h14" />
                        </svg>
                        New Post
                    </a>
                </div>
            @endauth
        </section>

        @if ($featured && $blogs->count() > 0)
            <div class="grid gap-10 md:grid-cols-3">
                {{-- FEATURED BLOG --}}
                <div class="md:col-span-2 blog-fade-in">
                    <article
                        class="group relative overflow-hidden rounded-2xl  bg-card/80 shadow-sm backdrop-blur-sm transition-all duration-300 hover:-translate-y-1 hover:border-primary/70 hover:shadow-2xl"
                    >
                        {{-- IMAGE AREA – tuned to be more "fitable" --}}
                        <a
                            href="{{ route('blog.show', $featured) }}"
                            class="relative block w-full overflow-hidden rounded-t-2xl bg-muted/40"
                        >
                            <div class="aspect-[4/3] md:aspect-[16/9] w-full">
                                @if ($featured->image_url)
                                    <img
                                        src="{{ $featured->image_url }}"
                                        alt="{{ $featured->title }}"
                                        loading="lazy"
                                        decoding="async"
                                        class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                    />
                                @else
                                    <div
                                        class="flex h-full w-full items-center justify-center bg-gradient-to-br from-primary/20 via-accent/20 to-secondary/30 text-xs text-muted-foreground">
                                        No image provided
                                    </div>
                                @endif
                            </div>

                            {{-- soft gradient on bottom for future overlays (title, etc.) --}}
                            <div
                                class="pointer-events-none absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-black/35 via-black/5 to-transparent">
                            </div>
                        </a>

                        <div class="p-6 md:p-8">
                            {{-- Tags --}}
                            @if (!empty($featured->tags))
                                <div class="mb-4 flex flex-wrap gap-2">
                                    @foreach ($featured->tags as $tag)
                                        <span
                                            class="inline-flex items-center rounded-full bg-secondary/80 px-3 py-1 text-xs font-semibold text-secondary-foreground/90">
                                            {{ $tag }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            {{-- Title --}}
                            <a href="{{ route('blog.show', $featured) }}"
                               class="font-headline mb-3 inline-block text-3xl font-bold leading-tight text-foreground transition-colors hover:text-primary md:text-4xl">
                                {{ $featured->title }}
                            </a>

                            {{-- Excerpt --}}
                            <p class="mb-6 text-base text-muted-foreground md:text-lg">
                                {{ $featured->excerpt }}
                            </p>

                            <div class="flex flex-col gap-4 border-t border-border/70 pt-4 text-sm md:flex-row md:items-center md:justify-between">
                                {{-- Author / date --}}
                                <div class="flex items-center gap-3">
                                    @if ($featured->author_avatar)
                                        <img
                                            src="{{ $featured->author_avatar }}"
                                            class="h-10 w-10 rounded-full ring-2 ring-background/90 ring-offset-2 ring-offset-card"
                                            alt="{{ $featured->author_name }}"
                                            loading="lazy"
                                            decoding="async"
                                        />
                                    @endif

                                    <div>
                                        <p class="text-sm font-medium text-foreground">
                                            {{ $featured->author_name }}
                                        </p>
                                        <p class="text-xs text-muted-foreground">
                                            {{ $featured->date->format('M d, Y') }}
                                        </p>
                                    </div>
                                </div>

                                {{-- Actions --}}
                                @auth
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('blog.edit', $featured) }}"
                                           class="rounded-full border border-border/80 px-4 py-1.5 text-xs font-medium text-foreground transition hover:bg-accent/40">
                                            Edit
                                        </a>

                                        <form method="POST" action="{{ route('blog.destroy', $featured) }}"
                                              onsubmit="return confirm('Delete this post?');">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="rounded-full border border-destructive/80 px-4 py-1.5 text-xs font-semibold text-destructive transition hover:bg-destructive/10">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </article>
                </div>

                {{-- SIDEBAR: RECENT POSTS --}}
                {{-- SIDEBAR: RECENT POSTS --}}
<aside class="space-y-4 md:space-y-5 blog-fade-in blog-fade-in-delay">
    <div class="flex items-center justify-between">
        <h3 class="font-headline text-xl font-bold text-foreground">
            Recent Posts
        </h3>
        <span class="rounded-full bg-secondary/60 px-3 py-1 text-xs font-medium text-secondary-foreground/90">
            {{ $blogs->count() }} total
        </span>
    </div>

    @foreach ($blogs as $sidePost)
        @if ($sidePost->id !== $featured->id)
            <a
                href="{{ route('blog.show', $sidePost) }}"
                class="group flex items-center gap-4 rounded-xl px-1 py-3 transition-colors hover:bg-muted/30"
            >
                {{-- Thumbnail image, like your screenshot --}}
                <div class="relative h-16 w-16 shrink-0 overflow-hidden rounded-xl bg-muted/60">
                    @if ($sidePost->image_url)
                        <img
                            src="{{ $sidePost->image_url }}"
                            alt="{{ $sidePost->title }}"
                            loading="lazy"
                            decoding="async"
                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                        />
                    @else
                        <div class="flex h-full w-full items-center justify-center text-[10px] text-muted-foreground">
                            No image
                        </div>
                    @endif
                </div>

                {{-- Text content --}}
                <div class="min-w-0 flex-1">
                    <h4
                        class="font-headline text-sm font-semibold leading-snug text-foreground transition-colors group-hover:text-primary line-clamp-2"
                    >
                        {{ $sidePost->title }}
                    </h4>

                    <p class="mt-0.5 text-xs text-muted-foreground">
                        {{ $sidePost->date->format('M d, Y') }}
                    </p>

                    @if (!empty($sidePost->tags))
                        <div class="mt-1">
                            <span
                                class="inline-flex items-center rounded-full bg-secondary/80 px-3 py-1 text-[11px] font-medium text-secondary-foreground/90"
                            >
                                {{ $sidePost->tags[0] }}
                            </span>
                        </div>
                    @endif
                </div>
            </a>
        @endif
    @endforeach
</aside>

            </div>
        @else
            <p class="blog-fade-in mt-6 text-muted-foreground">
                No blog posts yet. When you publish your first article, it will appear here as a featured post.
            </p>
        @endif

        {{-- Pagination --}}
        @if ($blogs->hasPages())
            <div class="mt-10 flex justify-center">
                {{ $blogs->links() }}
            </div>
        @endif
    </div>

    @push('styles')
        <style>
            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            @keyframes blog-fade-in-up {
                0% {
                    opacity: 0;
                    transform: translateY(12px);
                }
                100% {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .blog-fade-in {
                animation: blog-fade-in-up 0.55s ease-out both;
            }

            .blog-fade-in-delay {
                animation-delay: 0.12s;
            }
        </style>
    @endpush
@endsection
