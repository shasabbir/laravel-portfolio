@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container mx-auto flex min-h-[70vh] items-center justify-center px-4 py-16 md:px-6">
    <div class="w-full max-w-md rounded-2xl border border-border/60 bg-card/80 p-8 shadow-lg backdrop-blur">
        <h1 class="text-center text-2xl font-bold text-foreground">Sign in</h1>
        <p class="mt-2 text-center text-sm text-muted-foreground">
            Use your administrator credentials to manage blog posts and publications.
        </p>

        <form method="POST" action="{{ route('login.perform') }}" class="mt-8 space-y-5">
            @csrf
            <div>
                <label for="email" class="mb-1 block text-sm font-medium text-foreground">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="w-full rounded-lg border border-input bg-background px-3 py-2 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                />
                @error('email')
                    <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="mb-1 block text-sm font-medium text-foreground">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    class="w-full rounded-lg border border-input bg-background px-3 py-2 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20"
                />
                @error('password')
                    <p class="mt-1 text-sm text-destructive">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <label for="remember" class="flex items-center gap-2 text-sm text-muted-foreground">
                    <input id="remember" name="remember" type="checkbox" class="h-4 w-4 rounded border border-input text-primary focus:ring-primary/30">
                    Remember me
                </label>

                <a href="{{ route('home') }}" class="text-sm font-medium text-primary hover:underline">Back to home</a>
            </div>

            <button type="submit"
                class="inline-flex w-full items-center justify-center rounded-lg bg-primary px-4 py-2 text-sm font-semibold text-primary-foreground transition hover:bg-primary/90">
                Log in
            </button>
        </form>

        @if (session('status'))
            <div class="mt-4 rounded-lg bg-muted/60 px-4 py-3 text-sm text-foreground">
                {{ session('status') }}
            </div>
        @endif

        <p class="mt-6 text-center text-xs text-muted-foreground">
            Having trouble? Contact the site administrator to request access.
        </p>
    </div>
</div>
@endsection
