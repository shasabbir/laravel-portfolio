<header class="sticky top-0 z-90 w-full border-b border-border/40 bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60">
  <div class="container mx-auto flex h-14 items-center justify-between px-4 md:px-6">
    {{-- Brand --}}
    <div class="flex items-center">
      <a href="/" class="flex items-center space-x-2">
        <span class="font-bold sm:inline-block">Nuhash Gazi</span>
      </a>
    </div>

    {{-- Desktop Nav --}}
    <nav class="hidden flex-1 items-center justify-center space-x-1 md:flex">
      @php
        $nav = [
          ['href' => route('home'), 'label' => 'Home', 'is' => '/'],
          ['href' => route('about'), 'label' => 'About', 'is' => 'about'],
          ['href' => route('publications.index'), 'label' => 'Publications', 'is' => 'publications*'],
          ['href' => route('blog.index'), 'label' => 'Blog', 'is' => 'blog*'],
          ['href' => route('contact.show'), 'label' => 'Contact', 'is' => 'contact'],
        ];
      @endphp

      @foreach ($nav as $link)
        @php
          $active = request()->is($link['is']);
        @endphp

        <a
          href="{{ $link['href'] }}"
          class="group relative px-3 py-2 text-sm font-medium transition-colors
            {{ $active
                ? 'text-primary'
                : 'text-muted-foreground hover:text-foreground'
            }}"
        >
          {{-- Link text --}}
          <span class="relative z-10">
            {{ $link['label'] }}
          </span>

          {{-- Animated underline bar --}}
          <span
            class="
              pointer-events-none
              absolute left-3 right-3 bottom-0 h-[2px] rounded-full
              transition-all duration-300 ease-out origin-left
              {{ $active
                  ? 'bg-blue-600 opacity-100 scale-x-100'
                  : 'bg-blue-600 opacity-0 scale-x-0 group-hover:opacity-100 group-hover:scale-x-100'
              }}
            "
          ></span>
        </a>
      @endforeach
    </nav>

    {{-- Right side icons + GIF --}}
    <div class="flex items-center justify-end space-x-2">
   

      <div class="hidden gap-2 md:flex">
        <a href="https://orcid.org/" target="_blank" aria-label="ORCID"
           class="inline-flex h-9 w-9 items-center justify-center rounded hover:bg-secondary"
           title="ORCID">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 256 256" fill="currentColor">
            <circle cx="128" cy="128" r="120" fill="currentColor" />
            <text x="128" y="150" text-anchor="middle" font-size="110" fill="#fff" font-family="Arial, Helvetica, sans-serif">iD</text>
          </svg>
        </a>

        <a href="https://scholar.google.com/" target="_blank" aria-label="Google Scholar"
           class="inline-flex h-9 w-9 items-center justify-center rounded hover:bg-secondary"
           title="Google Scholar">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 11l9-7 9 7-9 7-9-7z" />
            <path d="M9 22v-7l6-4" />
          </svg>
        </a>

        <a href="https://www.linkedin.com/" target="_blank" aria-label="LinkedIn"
           class="inline-flex h-9 w-9 items-center justify-center rounded hover:bg-secondary"
           title="LinkedIn">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
            <path d="M4.98 3.5a2.5 2.5 0 11-.02 5 2.5 2.5 0 01.02-5zM3 8.98h4v12H3zM9 8.98h3.8v1.64h.05c.53-.95 1.82-1.95 3.74-1.95 4 0 4.74 2.63 4.74 6.06v7.25h-4v-6.43c0-1.53-.03-3.5-2.13-3.5-2.13 0-2.45 1.66-2.45 3.38v6.55H9z" />
          </svg>
        </a>

        <a href="/blog/rss.xml" aria-label="RSS"
           class="inline-flex h-9 w-9 items-center justify-center rounded hover:bg-secondary"
           title="RSS">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
            <path d="M6.18 17.82a2.18 2.18 0 11-4.36 0 2.18 2.18 0 014.36 0z" />
            <path d="M2 10a12 12 0 0112 12h-3A9 9 0 002 13v-3z" />
            <path d="M2 4a18 18 0 0118 18h-3A15 15 0 002 7V4z" />
          </svg>
        </a>

           {{-- Small GIF badge (desktop only) --}}
      <div class="hidden items-center md:flex">
        <div class="relative inline-flex h-9 w-14 items-center justify-center overflow-hidden rounded-full b bg-white/80  backdrop-blur">
          <img
            src="{{ asset('svg/Welcome.gif') }}"
            alt="Welcome animation"
            class="h-10 w-14 object-contain"
          />
        </div>
      </div>
      </div>

      @auth
        <div class="hidden items-center gap-3 md:flex">
          <span class="text-sm font-medium text-foreground">Hi, {{ auth()->user()->name }}!</span>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="inline-flex items-center rounded-full border border-border px-3 py-1.5 text-sm font-semibold text-foreground transition hover:bg-accent/40">
              Log out
            </button>
          </form>
        </div>
      @endauth

      @guest
        <a href="{{ route('login') }}" class="hidden md:inline-flex items-center rounded-full border border-primary px-3 py-1.5 text-sm font-semibold text-primary transition hover:bg-primary/10">
          Log in
        </a>
      @endguest

      {{-- Mobile burger --}}
      <div class="md:hidden">
        <button
          type="button"
          data-mobile-toggle
          class="inline-flex h-9 w-9 items-center justify-center rounded hover:bg-secondary"
          aria-label="Toggle Menu">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24"
               fill="none" stroke="currentColor" stroke-width="2"
               stroke-linecap="round" stroke-linejoin="round">
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
          </svg>
        </button>
      </div>
    </div>
  </div>

  {{-- Mobile overlay --}}
  <div data-mobile-overlay class="fixed inset-0 z-40 hidden bg-black/40"></div>

  {{-- Mobile sheet --}}
  <aside
    data-mobile-sheet
    class="fixed inset-y-0 left-0 z-50 w-72 -translate-x-full transform bg-background shadow transition-transform duration-200"
  >
    <div class="flex items-center justify-between border-b p-4 bg-white">
      <a href="/" class="font-bold" data-mobile-close>Nuhash Gazi</a>
      <button type="button" class="rounded p-2 hover:bg-secondary" data-mobile-close aria-label="Close">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
             fill="none" stroke="currentColor" stroke-width="2"
             stroke-linecap="round" stroke-linejoin="round">
          <line x1="18" y1="6" x2="6" y2="18"/>
          <line x1="6" y1="6" x2="18" y2="18"/>
        </svg>
      </button>
    </div>

    <nav class="flex flex-col space-y-1 p-4 bg-white z-50">
      @foreach($nav as $link)
        @php
          $active = request()->is($link['is']);
        @endphp
        <a
          href="{{ $link['href'] }}"
          class="rounded px-3 py-2 text-lg font-medium transition-colors
            {{ $active
                ? 'text-primary'
                : 'text-muted-foreground hover:text-foreground'
            }}"
          data-mobile-close
        >
          {{ $link['label'] }}
        </a>
      @endforeach

      <div class="mt-4 flex gap-2 border-t pt-4">
        <a href="https://orcid.org/" class="inline-flex h-9 w-9 items-center justify-center rounded hover:bg-secondary" title="ORCID">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 256 256" fill="currentColor">
            <circle cx="128" cy="128" r="120" fill="currentColor"/><text x="128" y="150" text-anchor="middle" font-size="110" fill="#fff" font-family="Arial, Helvetica, sans-serif">iD</text>
          </svg>
        </a>
        <a href="https://scholar.google.com/" class="inline-flex h-9 w-9 items-center justify-center rounded hover:bg-secondary" title="Google Scholar">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="2"
               stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 11l9-7 9 7-9 7-9-7z"/><path d="M9 22v-7l6-4"/>
          </svg>
        </a>
        <a href="https://www.linkedin.com/" class="inline-flex h-9 w-9 items-center justify-center rounded hover:bg-secondary" title="LinkedIn">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
            <path d="M4.98 3.5a2.5 2.5 0 11-.02 5 2.5 2.5 0 01.02-5zM3 8.98h4v12H3zM9 8.98h3.8v1.64h.05c.53-.95 1.82-1.95 3.74-1.95 4 0 4.74 2.63 4.74 6.06v7.25h-4v-6.43c0-1.53-.03-3.5-2.13-3.5-2.13 0-2.45 1.66-2.45 3.38v6.55H9z"/>
          </svg>
        </a>
      </div>

      @auth
        <div class="mt-4 flex flex-col gap-3 border-t pt-4">
          <span class="text-sm font-medium text-foreground">Signed in as {{ auth()->user()->name }}</span>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="inline-flex items-center justify-center rounded-full border border-border px-4 py-2 text-sm font-semibold text-foreground transition hover:bg-accent/40">
              Log out
            </button>
          </form>
        </div>
      @else
        <div class="mt-4 border-t pt-4">
          <a href="{{ route('login') }}" class="inline-flex w-full items-center justify-center rounded-full bg-primary px-4 py-2 text-sm font-semibold text-primary-foreground transition hover:bg-primary/90">
            Log in
          </a>
        </div>
      @endauth
    </nav>
  </aside>
</header>

{{-- Minimal JS for mobile menu (you can move this into app.js if you want) --}}
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const toggle   = document.querySelector('[data-mobile-toggle]');
    const overlay  = document.querySelector('[data-mobile-overlay]');
    const sheet    = document.querySelector('[data-mobile-sheet]');
    const closers  = document.querySelectorAll('[data-mobile-close]');

    if (!toggle || !overlay || !sheet) return;

    const openMenu = () => {
      overlay.classList.remove('hidden');
      sheet.classList.remove('-translate-x-full');
    };

    const closeMenu = () => {
      overlay.classList.add('hidden');
      sheet.classList.add('-translate-x-full');
    };

    toggle.addEventListener('click', openMenu);
    overlay.addEventListener('click', closeMenu);
    closers.forEach(el => el.addEventListener('click', closeMenu));
  });
</script>
