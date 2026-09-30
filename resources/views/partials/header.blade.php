<header class="sticky top-0 z-90 w-full border-b border-border/40 bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60">
  <div class="container mx-auto flex h-14 items-center justify-between px-4 md:px-6">
    {{-- Brand --}}
    <div class="flex items-center">
      <a href="/" class="flex items-center space-x-2">
        @if($siteContent->value('brand_logo'))<img src="{{ $siteContent->value('brand_logo') }}" alt="Site logo" class="h-9 w-auto object-contain" />@endif
        <span class="font-bold sm:inline-block">{!! $siteContent->formatted('header_15') !!}</span>
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
        if (auth()->check()) $nav[] = ['href' => route('admin.messages.index'), 'label' => 'Messages', 'is' => 'admin/messages'];
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
        <a href="{{ $siteContent->value('header_9') }}" target="_blank" aria-label="ORCID"
           class="inline-flex h-9 w-9 items-center justify-center rounded hover:bg-secondary"
           title="ORCID">
          @if($siteContent->value('header_1'))<img src="{{ $siteContent->value('header_1') }}" alt="" class="h-5 w-5 object-contain" />@else<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 256 256" fill="currentColor">
            <circle cx="128" cy="128" r="120" fill="currentColor" />
            <text x="128" y="150" text-anchor="middle" font-size="110" fill="#fff" font-family="Arial, Helvetica, sans-serif">{!! $siteContent->formatted('header_17') !!}</text>
          </svg>@endif
        </a>

        <a href="{{ $siteContent->value('header_10') }}" target="_blank" aria-label="Google Scholar"
           class="inline-flex h-9 w-9 items-center justify-center rounded hover:bg-secondary"
           title="Google Scholar">
          @if($siteContent->value('header_2'))<img src="{{ $siteContent->value('header_2') }}" alt="" class="h-5 w-5 object-contain" />@else<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 11l9-7 9 7-9 7-9-7z" />
            <path d="M9 22v-7l6-4" />
          </svg>@endif
        </a>

        <a href="{{ $siteContent->value('header_11') }}" target="_blank" aria-label="LinkedIn"
           class="inline-flex h-9 w-9 items-center justify-center rounded hover:bg-secondary"
           title="LinkedIn">
          @if($siteContent->value('header_3'))<img src="{{ $siteContent->value('header_3') }}" alt="" class="h-5 w-5 object-contain" />@else<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
            <path d="M4.98 3.5a2.5 2.5 0 11-.02 5 2.5 2.5 0 01.02-5zM3 8.98h4v12H3zM9 8.98h3.8v1.64h.05c.53-.95 1.82-1.95 3.74-1.95 4 0 4.74 2.63 4.74 6.06v7.25h-4v-6.43c0-1.53-.03-3.5-2.13-3.5-2.13 0-2.45 1.66-2.45 3.38v6.55H9z" />
          </svg>@endif
        </a>

       

           {{-- Small GIF badge (desktop only) --}}
      <div class="hidden items-center md:flex">
  <div
    class="relative inline-flex h-9 px-4 items-center justify-center overflow-hidden rounded-full bg-white/80 backdrop-blur"
  >
    <span class="welcome-letters text-xs font-semibold tracking-[0.25em] text-primary uppercase">
      @foreach(mb_str_split($siteContent->value('welcome_text')) as $letter)<span>{{ $letter }}</span>@endforeach
    </span>
  </div>
</div>
<style>
.welcome-letters span {
  display: inline-block;
  animation: welcome-bounce 1.2s ease-in-out infinite;
}

/* Staggered delays for wave effect */
.welcome-letters span:nth-child(1) { animation-delay: 0s; }
.welcome-letters span:nth-child(2) { animation-delay: 0.1s; }
.welcome-letters span:nth-child(3) { animation-delay: 0.2s; }
.welcome-letters span:nth-child(4) { animation-delay: 0.3s; }
.welcome-letters span:nth-child(5) { animation-delay: 0.4s; }
.welcome-letters span:nth-child(6) { animation-delay: 0.5s; }
.welcome-letters span:nth-child(7) { animation-delay: 0.6s; }

@keyframes welcome-bounce {
  0%, 80%, 100% {
    transform: translateY(0);
    opacity: 0.6;
  }
  40% {
    transform: translateY(-3px);
    opacity: 1;
  }
}
</style>
      </div>

      @auth
        <div class="hidden items-center gap-3 md:flex">
          <span class="text-sm font-medium text-foreground">Hi, {{ auth()->user()->name }}!</span>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="inline-flex items-center rounded-full border border-border px-3 py-1.5 text-sm font-semibold text-foreground transition hover:bg-accent/40">{!! $siteContent->formatted('header_27') !!}</button>
          </form>
        </div>
      @endauth

      @guest
        <a href="{{ route('login') }}" class="hidden md:inline-flex items-center rounded-full border border-primary px-3 py-1.5 text-sm font-semibold text-primary transition hover:bg-primary/10">{!! $siteContent->formatted('header_28') !!}</a>
      @endguest

      {{-- Mobile burger --}}
      <div class="md:hidden">
        <button
          type="button"
          data-mobile-toggle
          class="inline-flex h-9 w-9 items-center justify-center rounded hover:bg-secondary"
          aria-label="Toggle Menu">
          @if($siteContent->value('header_4'))<img src="{{ $siteContent->value('header_4') }}" alt="" class="h-6 w-6 object-contain" />@else<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24"
               fill="none" stroke="currentColor" stroke-width="2"
               stroke-linecap="round" stroke-linejoin="round">
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
          </svg>@endif
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
      <a href="/" class="font-bold" data-mobile-close>@if($siteContent->value('brand_logo'))<img src="{{ $siteContent->value('brand_logo') }}" alt="Site logo" class="h-9 w-auto object-contain" />@endif{!! $siteContent->formatted('header_15') !!}</a>
      <button type="button" class="rounded p-2 hover:bg-secondary" data-mobile-close aria-label="Close">
        @if($siteContent->value('header_5'))<img src="{{ $siteContent->value('header_5') }}" alt="" class="h-5 w-5 object-contain" />@else<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
             fill="none" stroke="currentColor" stroke-width="2"
             stroke-linecap="round" stroke-linejoin="round">
          <line x1="18" y1="6" x2="6" y2="18"/>
          <line x1="6" y1="6" x2="18" y2="18"/>
        </svg>@endif
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
        <a href="{{ $siteContent->value('header_9') }}" class="inline-flex h-9 w-9 items-center justify-center rounded hover:bg-secondary" title="ORCID">
          @if($siteContent->value('header_1'))<img src="{{ $siteContent->value('header_1') }}" alt="" class="h-5 w-5 object-contain" />@else<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 256 256" fill="currentColor">
            <circle cx="128" cy="128" r="120" fill="currentColor"/><text x="128" y="150" text-anchor="middle" font-size="110" fill="#fff" font-family="Arial, Helvetica, sans-serif">{!! $siteContent->formatted('header_33') !!}</text>
          </svg>@endif
        </a>
        <a href="{{ $siteContent->value('header_10') }}" class="inline-flex h-9 w-9 items-center justify-center rounded hover:bg-secondary" title="Google Scholar">
          @if($siteContent->value('header_2'))<img src="{{ $siteContent->value('header_2') }}" alt="" class="h-5 w-5 object-contain" />@else<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="2"
               stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 11l9-7 9 7-9 7-9-7z"/><path d="M9 22v-7l6-4"/>
          </svg>@endif
        </a>
        <a href="{{ $siteContent->value('header_11') }}" class="inline-flex h-9 w-9 items-center justify-center rounded hover:bg-secondary" title="LinkedIn">
          @if($siteContent->value('header_3'))<img src="{{ $siteContent->value('header_3') }}" alt="" class="h-5 w-5 object-contain" />@else<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
            <path d="M4.98 3.5a2.5 2.5 0 11-.02 5 2.5 2.5 0 01.02-5zM3 8.98h4v12H3zM9 8.98h3.8v1.64h.05c.53-.95 1.82-1.95 3.74-1.95 4 0 4.74 2.63 4.74 6.06v7.25h-4v-6.43c0-1.53-.03-3.5-2.13-3.5-2.13 0-2.45 1.66-2.45 3.38v6.55H9z"/>
          </svg>@endif
        </a>
      </div>

      @auth
        <div class="mt-4 flex flex-col gap-3 border-t pt-4">
          <span class="text-sm font-medium text-foreground">Signed in as {{ auth()->user()->name }}</span>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="inline-flex items-center justify-center rounded-full border border-border px-4 py-2 text-sm font-semibold text-foreground transition hover:bg-accent/40">{!! $siteContent->formatted('header_36') !!}</button>
          </form>
        </div>
      @else
        <div class="mt-4 border-t pt-4">
          <a href="{{ route('login') }}" class="inline-flex w-full items-center justify-center rounded-full bg-primary px-4 py-2 text-sm font-semibold text-primary-foreground transition hover:bg-primary/90">{!! $siteContent->formatted('header_37') !!}</a>
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
