<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    />

    <title>@yield('title', 'Scientist Site')</title>

    {{-- Optional: match the Next.js fonts you mentioned --}}
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  {{-- ✅ Inter font from Google --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
  href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@500;600;700;800&display=swap"
  rel="stylesheet"
/>

    {{-- Tailwind / app assets (make sure Vite is set up in Laravel 12) --}}
    @vite(['resources/css/app.css','resources/js/app.js'])

    {{-- PAGE-LEVEL EXTRA STYLES --}}
    @stack('styles')
</head>
<body class="min-h-screen bg-background antialiased text-foreground">
    <div class="relative flex min-h-dvh flex-col bg-background">
        {{-- Header --}}
        @include('partials.header')

        {{-- Main page content --}}
        <main class="flex-1">
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('partials.footer')
    </div>

    {{-- PAGE-LEVEL EXTRA SCRIPTS --}}
    @stack('scripts')
</body>
</html>
