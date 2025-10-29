@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<div class="container mx-auto max-w-6xl px-4 py-12 md:px-6 md:py-20">
  <header class="text-center">
    <h1 class="font-headline text-4xl font-bold tracking-tight md:text-5xl">Get in Touch</h1>
    <p class="mt-4 text-lg text-muted-foreground">I'm always open to discussing new research, collaborations, or speaking opportunities.</p>
  </header>

  <div class="mt-12 grid grid-cols-1 items-center gap-12 md:grid-cols-2">
    <div class="order-2 rounded-lg bg-muted p-8 shadow-lg md:order-1">
      @if(session('status'))
        <div class="mb-4 rounded border border-green-300 bg-green-50 p-3 text-green-700">{{ session('status') }}</div>
      @endif
      <form method="POST" action="{{ route('contact.submit') }}" class="space-y-6">
        @csrf
        <div>
          <label class="label">Name</label>
          <input name="name" value="{{ old('name') }}" class="input" placeholder="Your Name" />
          @error('name')<p class="text-sm text-destructive">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="label">Email</label>
          <input type="email" name="email" value="{{ old('email') }}" class="input" placeholder="your.email@example.com" />
          @error('email')<p class="text-sm text-destructive">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="label">Message</label>
          <textarea name="message" rows="6" class="textarea" placeholder="Tell me how I can help.">{{ old('message') }}</textarea>
          @error('message')<p class="text-sm text-destructive">{{ $message }}</p>@enderror
        </div>
        <button class="btn w-full">Send Message</button>
      </form>
    </div>
    <div class="order-1 md:order-2">
      <img src="https://picsum.photos/800/600" alt="Contact illustration" class="rounded-lg object-cover w-full" />
    </div>
  </div>
</div>
@endsection