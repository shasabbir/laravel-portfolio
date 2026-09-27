@extends('layouts.app')
@section('title', 'Contact messages')
@section('content')
<section class="container mx-auto max-w-5xl px-5 py-12">
  <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
    <div><p class="text-sm font-semibold text-primary">Admin inbox</p><h1 class="mt-2 font-headline text-3xl">Contact messages</h1><p class="mt-2 text-sm text-muted-foreground">{{ $messages->total() }} {{ \Illuminate\Support\Str::plural('message', $messages->total()) }}</p></div>
    <a href="{{ route('contact.show') }}" class="rounded-full border border-border px-5 py-2 text-sm">Contact page ↗</a>
  </div>
  <div class="space-y-5">
    @forelse($messages as $message)
      <article class="rounded-2xl border border-border bg-card p-6 shadow-sm">
        <div class="flex flex-wrap items-start justify-between gap-3">
          <div class="min-w-0"><h2 class="break-words text-lg font-semibold">{{ $message->name }}</h2><a class="break-all text-sm text-primary underline" href="mailto:{{ $message->email }}">{{ $message->email }}</a></div>
          <time class="text-xs text-muted-foreground" datetime="{{ $message->created_at->toIso8601String() }}">{{ $message->created_at->format('d M Y, h:i A') }}</time>
        </div>
        <p class="mt-5 whitespace-pre-wrap break-words leading-7">{{ $message->message }}</p>
      </article>
    @empty
      <div class="rounded-2xl border border-dashed border-border p-12 text-center text-muted-foreground">No messages yet. New contact submissions will appear here.</div>
    @endforelse
  </div>
  <div class="mt-8">{{ $messages->links() }}</div>
</section>
@endsection
