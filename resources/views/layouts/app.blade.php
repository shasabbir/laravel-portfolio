<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Portfolio')</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen bg-background text-foreground">
    @include('partials.header')
    <main class="min-h-[70vh]">
        @yield('content')
    </main>
    @include('partials.footer')
        <script>
            // Simple mobile menu toggler
            document.addEventListener('DOMContentLoaded', function () {
                const btn = document.querySelector('[data-mobile-toggle]');
                const sheet = document.querySelector('[data-mobile-sheet]');
                const overlay = document.querySelector('[data-mobile-overlay]');
                function toggle(open){
                    if(!sheet||!overlay) return;
                    const isOpen = open ?? !sheet.classList.contains('translate-x-0');
                    if(isOpen){
                        sheet.classList.remove('-translate-x-full');
                        sheet.classList.add('translate-x-0');
                        overlay.classList.remove('hidden');
                    } else {
                        sheet.classList.add('-translate-x-full');
                        sheet.classList.remove('translate-x-0');
                        overlay.classList.add('hidden');
                    }
                }
                if(btn){ btn.addEventListener('click', ()=>toggle()); }
                if(overlay){ overlay.addEventListener('click', ()=>toggle(false)); }
                document.querySelectorAll('[data-mobile-close]')?.forEach(el=>{
                    el.addEventListener('click', ()=>toggle(false));
                });
            });
        </script>
</body>
</html>
