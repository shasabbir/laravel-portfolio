@extends('layouts.app')

@section('title', $content->pageText('page_title'))

@push('styles')
<style>
  .about-resume { --showcase-ink: #12313b; }
  .about-resume .showcase-mesh { background-image: radial-gradient(circle, rgba(17, 113, 126, .25) 1px, transparent 1.5px); background-size: 24px 24px; }
  .about-resume .showcase-card { transition: transform .25s ease, box-shadow .25s ease; }
  .about-resume .showcase-card:hover { transform: translateY(-5px); box-shadow: 0 20px 45px rgba(9, 75, 88, .13); }
  .about-resume .showcase-icon { display: inline-flex; align-items: center; justify-content: center; width: 3.25rem; height: 3.25rem; border-radius: 1rem; background: hsl(var(--secondary)); color: hsl(var(--primary)); }
  .about-resume .showcase-icon svg { width: 1.65rem; height: 1.65rem; }
  .about-resume.motion-ready .about-reveal { opacity: 0; transform: translateY(22px); transition: opacity .65s ease, transform .65s cubic-bezier(.2,.8,.2,1); }
  .about-resume.motion-ready .about-reveal.is-visible { opacity: 1; transform: translateY(0); }
  .about-resume.motion-ready .showcase-card.about-reveal.is-visible:hover { transform: translateY(-5px); }
  @media (prefers-reduced-motion: reduce) { .about-resume .showcase-card, .about-resume.motion-ready .about-reveal { opacity: 1; transform: none; transition: none; } }
</style>
@endpush

@section('content')
@auth
@if(session('status'))
<div role="status" class="container mx-auto max-w-6xl px-5 py-4 text-primary">{{ session('status') }}</div>
@endif
@endauth
<div class="about-resume overflow-hidden">
  <svg xmlns="http://www.w3.org/2000/svg" class="absolute h-0 w-0" aria-hidden="true">
    <symbol id="research-dna" viewBox="0 0 24 24"><path d="M4 2c0 8 16 12 16 20M20 2C20 10 4 14 4 22M6 6h12M5 12h14M6 18h12"/></symbol>
    <symbol id="research-brain" viewBox="0 0 24 24"><path d="M12 5a3 3 0 0 0-5.8-1 4 4 0 0 0-2.1 6.3A4 4 0 0 0 5 18a3 3 0 0 0 7 1V5Zm0 0a3 3 0 0 1 5.8-1 4 4 0 0 1 2.1 6.3A4 4 0 0 1 19 18a3 3 0 0 1-7 1V5Z"/></symbol>
    <symbol id="research-molecule" viewBox="0 0 24 24"><circle cx="5" cy="12" r="2"/><circle cx="17" cy="5" r="2"/><circle cx="19" cy="18" r="2"/><circle cx="11" cy="14" r="2"/><path d="m7 12 2 1m3-1 4-6m-3 9 4 2"/></symbol>
    <symbol id="research-flask" viewBox="0 0 24 24"><path d="M9 2h6m-5 0v7L4 19a2 2 0 0 0 2 3h12a2 2 0 0 0 2-3L14 9V2M7 16h10"/></symbol>
    <symbol id="research-code" viewBox="0 0 24 24"><path d="m8 7-5 5 5 5m8-10 5 5-5 5M14 4l-4 16"/></symbol>
  </svg>
  <section class="relative isolate border-b border-border/60 bg-gradient-to-br from-secondary/70 via-background to-background">
    <div class="pointer-events-none absolute -right-20 top-0 h-80 w-80 rounded-full bg-primary/10 blur-3xl"></div>
    <div class="container relative mx-auto grid max-w-6xl gap-7 px-5 py-10 md:grid-cols-[1.05fr_.95fr] md:items-start md:gap-9 md:px-8 md:py-14">
      <div>
        @include('about.inline-media', ['field' => 'resume', 'label' => 'Edit resume PDF'])
        @include('about.inline-page-text', ['group' => 'intro'])
<div data-text-display="intro">
<p class="mb-5 text-xs font-bold uppercase tracking-[0.24em] text-primary"><span data-about-input="page_text[hero_label]">{{ $content->pageText('hero_label') }}</span></p>
        <h1 class="font-headline max-w-3xl text-4xl leading-tight text-foreground sm:text-5xl"><span data-about-input="page_text[hero_title]">{{ $content->pageText('hero_title') }}</span></h1>
        <p class="mt-4 max-w-2xl text-xl font-medium text-foreground/80"><span data-about-input="page_text[hero_subtitle]">{{ $content->pageText('hero_subtitle') }}</span></p>
        <p class="mt-4 max-w-2xl text-base leading-7 text-muted-foreground"><span data-about-input="page_text[hero_description]">{{ $content->pageText('hero_description') }}</span></p>
        <div class="mt-6 flex flex-wrap gap-3">
          <a data-display="resume" href="{{ route('about.media', 'resume') }}" download class="inline-flex items-center gap-2 rounded-full bg-primary px-6 py-3 text-sm font-semibold text-primary-foreground transition hover:opacity-90 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">
            <span data-about-input="page_text[resume_button]">{{ $content->pageText('resume_button') }}</span> <span aria-hidden="true">↗</span>
          </a>
          <a href="#focus-title" class="inline-flex items-center rounded-full border border-border bg-background px-6 py-3 text-sm font-semibold text-foreground transition hover:border-primary hover:text-primary focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary"><span data-about-input="page_text[research_button]">{{ $content->pageText('research_button') }}</span></a>
        </div>
        <p class="mt-4 text-sm text-muted-foreground"><span data-about-input="page_text[location]">{{ $content->pageText('location') }}</span></p>
</div>
      </div>
      <div class="mx-auto w-full max-w-lg md:pt-1">
        @include('about.inline-media', ['field' => 'portrait', 'label' => 'Edit profile image'])
        <div data-display="portrait" class="flex min-h-64 overflow-hidden rounded-[1.75rem] border border-border/70 bg-background shadow-xl shadow-primary/10 sm:min-h-80">
          <img src="{{ route('about.media', 'portrait') }}" alt="{{ $content->pageText('portrait_alt') }}" class="w-2/5 shrink-0 object-cover object-center" loading="lazy" />
          <div class="min-w-0 flex-1">@include('about.inline-page-text', ['group' => 'profile'])
<div data-text-display="profile">
<div class="flex flex-col justify-center p-5 sm:p-8"><p class="text-xs font-bold uppercase tracking-[.14em] text-primary"><span data-about-input="page_text[profile_label]">{{ $content->pageText('profile_label') }}</span></p><p class="mt-4 font-headline text-xl sm:text-2xl"><span data-about-input="page_text[profile_name]">{{ $content->pageText('profile_name') }}</span></p><p class="mt-4 text-sm leading-6 text-muted-foreground"><span data-about-input="page_text[profile_role]">{{ $content->pageText('profile_role') }}</span></p></div>
</div></div>
        </div>
      </div>
    </div>
  </section>

  <section aria-label="Research identity" class="border-b border-border/60 bg-background/80">
    @include('about.inline-page-text', ['group' => 'identity'])
<div data-text-display="identity">
<div class="mx-auto grid max-w-6xl gap-2 px-5 py-4 md:grid-cols-3 md:gap-5 md:px-8">
      <div class="flex items-center gap-4 py-2 min-w-0"><div class="min-w-0">@include('about.editable-icon', ['imageKey' => 'identity_question', 'imageLabel' => 'question', 'icon' => 'brain'])</div><div><p class="text-xs font-bold uppercase tracking-widest text-primary"><span data-about-input="page_text[identity_question_label]">{{ $content->pageText('identity_question_label') }}</span></p><p class="font-semibold"><span data-about-input="page_text[identity_question]">{{ $content->pageText('identity_question') }}</span></p></div></div>
      <div class="flex items-center gap-4 py-2 min-w-0"><div class="min-w-0">@include('about.editable-icon', ['imageKey' => 'identity_lens', 'imageLabel' => 'lens', 'icon' => 'dna'])</div><div><p class="text-xs font-bold uppercase tracking-widest text-primary"><span data-about-input="page_text[identity_lens_label]">{{ $content->pageText('identity_lens_label') }}</span></p><p class="font-semibold"><span data-about-input="page_text[identity_lens]">{{ $content->pageText('identity_lens') }}</span></p></div></div>
      <div class="flex items-center gap-4 py-2 min-w-0"><div class="min-w-0">@include('about.editable-icon', ['imageKey' => 'identity_approach', 'imageLabel' => 'approach', 'icon' => 'molecule'])</div><div><p class="text-xs font-bold uppercase tracking-widest text-primary"><span data-about-input="page_text[identity_approach_label]">{{ $content->pageText('identity_approach_label') }}</span></p><p class="font-semibold"><span data-about-input="page_text[identity_approach]">{{ $content->pageText('identity_approach') }}</span></p></div></div>
    </div>
</div>
  </section>

  <div class="container mx-auto max-w-6xl px-5 py-12 md:px-8 md:py-14">
    <section aria-labelledby="focus-title" class="grid gap-6 border-b border-border/70 pb-12 md:grid-cols-[16rem_1fr]">
      <div>
        @include('about.inline-page-text', ['group' => 'focus-heading'])
<div data-text-display="focus-heading">
<p class="text-xs font-bold uppercase tracking-[0.2em] text-primary"><span data-about-input="page_text[focus_label]">{{ $content->pageText('focus_label') }}</span></p>
        <h2 id="focus-title" class="mt-3 font-headline text-3xl"><span data-about-input="page_text[focus_heading]">{{ $content->pageText('focus_heading') }}</span></h2>
</div>
      </div>
      <div class="grid gap-4 sm:grid-cols-2">
        <div class="showcase-card overflow-hidden rounded-[1.75rem] border border-border/70 bg-card shadow-sm sm:row-span-2">
          @include('about.inline-media', ['field' => 'research', 'label' => 'Edit research image'])
          <img data-display="research" src="{{ route('about.media', 'research') }}" alt="{{ $content->pageText('research_alt') }}" class="block h-auto w-full" loading="lazy" />
          <div class="p-6">
            @include('about.editable-icon', ['imageKey' => 'focus_first', 'imageLabel' => $content->pageText('focus_first_title'), 'icon' => 'brain'])
            @include('about.inline-page-text', ['group' => 'focus-first'])
<div data-text-display="focus-first">
<h3 class="font-semibold"><span data-about-input="page_text[focus_first_title]">{{ $content->pageText('focus_first_title') }}</span></h3>
            <p class="mt-2 text-sm leading-6 text-muted-foreground"><span data-about-input="page_text[focus_first_description]">{{ $content->pageText('focus_first_description') }}</span></p>
</div>
          </div>
        </div>
        <div class="showcase-card relative overflow-hidden rounded-[1.75rem] border border-border/70 bg-card p-6 shadow-sm">
          <span class="showcase-mesh absolute right-0 top-0 h-32 w-32 opacity-40" aria-hidden="true"></span>
          @include('about.editable-icon', ['imageKey' => 'focus_second', 'imageLabel' => $content->pageText('focus_second_title'), 'icon' => 'dna'])
          @include('about.inline-page-text', ['group' => 'focus-second'])
<div data-text-display="focus-second">
<h3 class="font-semibold"><span data-about-input="page_text[focus_second_title]">{{ $content->pageText('focus_second_title') }}</span></h3>
          <p class="mt-2 text-sm leading-6 text-muted-foreground"><span data-about-input="page_text[focus_second_description]">{{ $content->pageText('focus_second_description') }}</span></p>
</div>
        </div>
        <div class="showcase-card relative overflow-hidden rounded-[1.75rem] border border-border/70 bg-card p-6 shadow-sm">
          <span class="absolute right-5 top-3 text-7xl text-primary/10" aria-hidden="true">✳</span>
          @include('about.editable-icon', ['imageKey' => 'focus_third', 'imageLabel' => $content->pageText('focus_third_title'), 'icon' => 'molecule'])
          @include('about.inline-page-text', ['group' => 'focus-third'])
<div data-text-display="focus-third">
<h3 class="font-semibold"><span data-about-input="page_text[focus_third_title]">{{ $content->pageText('focus_third_title') }}</span></h3>
          <p class="mt-2 text-sm leading-6 text-muted-foreground"><span data-about-input="page_text[focus_third_description]">{{ $content->pageText('focus_third_description') }}</span></p>
</div>
        </div>
      </div>
    </section>

    <section aria-labelledby="experience-title" class="grid gap-6 border-b border-border/70 py-12 md:grid-cols-[16rem_1fr]">
      <div>
        @include('about.inline-page-text', ['group' => 'experience-heading'])
<div data-text-display="experience-heading">
<p class="text-xs font-bold uppercase tracking-[0.2em] text-primary"><span data-about-input="page_text[experience_label]">{{ $content->pageText('experience_label') }}</span></p>
        <h2 id="experience-title" class="mt-3 font-headline text-3xl"><span data-about-input="page_text[experience_heading]">{{ $content->pageText('experience_heading') }}</span></h2>
</div>
      </div>
      <div class="space-y-6">
        @include('about.inline-content', ['section' => 'experiences'])
        <div data-display="experiences" class="space-y-6">
        @foreach($content->experiences as $entry)
        <article class="border-l-2 {{ $loop->first ? 'border-primary' : 'border-border' }} pl-5">
          <p class="text-sm font-semibold text-primary"><span data-about-input="experiences[{{ $loop->index }}][period]">{{ $entry['period'] }}</span></p>
          <h3 class="mt-1 text-xl font-semibold"><span data-about-input="experiences[{{ $loop->index }}][title]">{{ $entry['title'] }}</span></h3>
          <p class="mt-1 text-sm text-muted-foreground"><span data-about-input="experiences[{{ $loop->index }}][organization]">{{ $entry['organization'] }}</span></p>
          @if(!empty($entry['description']))<p class="mt-3 whitespace-pre-line leading-7 text-muted-foreground"><span data-about-input="experiences[{{ $loop->index }}][description]">{{ $entry['description'] }}</span></p>@endif
        </article>
        @endforeach
        @if($content->additional_experience)<p class="whitespace-pre-line text-sm text-muted-foreground"><span data-about-input="additional_experience">{{ $content->additional_experience }}</span></p>@endif
        </div>
      </div>
    </section>

    <section aria-labelledby="education-title" class="grid gap-6 border-b border-border/70 py-12 md:grid-cols-[16rem_1fr]">
      <div>
        @include('about.inline-page-text', ['group' => 'education-heading'])
<div data-text-display="education-heading">
<p class="text-xs font-bold uppercase tracking-[0.2em] text-primary"><span data-about-input="page_text[education_label]">{{ $content->pageText('education_label') }}</span></p>
        <h2 id="education-title" class="mt-3 font-headline text-3xl"><span data-about-input="page_text[education_heading]">{{ $content->pageText('education_heading') }}</span></h2>
</div>
      </div>
      <div>
        @include('about.inline-content', ['section' => 'educations'])
        <div data-display="educations" class="grid gap-4 sm:grid-cols-2">
        @foreach($content->educations as $entry)
        <article class="showcase-card rounded-[1.75rem] border border-border/70 bg-card p-6 shadow-sm">
          @if(!empty($entry['media_id']))
            @php($imageKey = 'educations_'.$entry['media_id'])
            @include('about.inline-media', ['field' => $imageKey, 'label' => 'Edit institution image'])
          @endif
          @if(!empty($entry['media_id']) && $aboutMedia?->imagePath($imageKey))
            <img src="{{ route('about.media', $imageKey) }}" alt="{{ $entry['organization'] }}" class="mb-6 h-16 w-16 rounded-2xl object-contain" loading="lazy">
          @elseif(!empty($entry['badge']))<div class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl text-lg font-black tracking-tighter text-white" style="background-color: {{ $entry['color'] }}"><span data-about-input="educations[{{ $loop->index }}][badge]">{{ $entry['badge'] }}</span></div>@endif
          <p class="text-sm font-semibold text-primary"><span data-about-input="educations[{{ $loop->index }}][period]">{{ $entry['period'] }}</span></p>
          <h3 class="mt-3 text-xl font-semibold"><span data-about-input="educations[{{ $loop->index }}][title]">{{ $entry['title'] }}</span></h3>
          <p class="mt-1 text-muted-foreground"><span data-about-input="educations[{{ $loop->index }}][organization]">{{ $entry['organization'] }}</span></p>
          @if(!empty($entry['description']))<p class="mt-4 whitespace-pre-line text-sm leading-6 text-muted-foreground"><span data-about-input="educations[{{ $loop->index }}][description]">{{ $entry['description'] }}</span></p>@endif
        </article>
        @endforeach
      </div>
      </div>
    </section>

    <section aria-labelledby="skills-title" class="grid gap-6 border-b border-border/70 py-12 md:grid-cols-[16rem_1fr]">
      <div>
        @include('about.inline-page-text', ['group' => 'methods-heading'])
<div data-text-display="methods-heading">
<p class="text-xs font-bold uppercase tracking-[0.2em] text-primary"><span data-about-input="page_text[methods_label]">{{ $content->pageText('methods_label') }}</span></p>
        <h2 id="skills-title" class="mt-3 font-headline text-3xl"><span data-about-input="page_text[methods_heading]">{{ $content->pageText('methods_heading') }}</span></h2>
</div>
      </div>
      <div>
        @include('about.inline-content', ['section' => 'methods'])
        <div data-display="methods" class="grid gap-5 sm:grid-cols-2">
          @foreach($content->methods ?? [] as $entry)
          <div class="showcase-card rounded-[1.75rem] bg-[#103542] p-7 text-white">
            @if(!empty($entry['media_id']))
              @include('about.editable-icon', ['imageKey' => 'methods_'.$entry['media_id'], 'imageLabel' => $entry['title'], 'icon' => $entry['icon']])
            @else
              <span class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-teal-300/20 text-teal-100"><svg class="h-6 w-6 fill-none stroke-current stroke-[1.6]" aria-hidden="true"><use href="#research-{{ $entry['icon'] }}"/></svg></span>
            @endif
            <h3 class="font-semibold"><span data-about-input="methods[{{ $loop->index }}][title]">{{ $entry['title'] }}</span></h3>
            <p class="mt-2 whitespace-pre-line leading-7 text-slate-200"><span data-about-input="methods[{{ $loop->index }}][description]">{{ $entry['description'] }}</span></p>
          </div>
          @endforeach
        </div>
      </div>
    </section>

    <section aria-labelledby="work-title" class="grid gap-6 border-b border-border/70 py-12 md:grid-cols-[16rem_1fr]">
      <div>
        @include('about.inline-page-text', ['group' => 'manuscripts-heading'])
<div data-text-display="manuscripts-heading">
<p class="text-xs font-bold uppercase tracking-[0.2em] text-primary"><span data-about-input="page_text[manuscripts_label]">{{ $content->pageText('manuscripts_label') }}</span></p>
        <h2 id="work-title" class="mt-3 font-headline text-3xl"><span data-about-input="page_text[manuscripts]">{{ $content->pageText('manuscripts') }}</span></h2>
</div>
      </div>
      <div>
        @include('about.inline-content', ['section' => 'manuscripts'])
        <div data-display="manuscripts" class="space-y-4">
          @foreach($content->manuscripts ?? [] as $entry)
          <div class="rounded-2xl border border-border/70 p-5">
            <span class="text-xs font-bold uppercase tracking-wider text-primary"><span data-about-input="manuscripts[{{ $loop->index }}][status]">{{ $entry['status'] }}</span></span>
            <h3 class="mt-2 font-semibold"><span data-about-input="manuscripts[{{ $loop->index }}][title]">{{ $entry['title'] }}</span></h3>
            <p class="mt-1 text-sm text-muted-foreground"><span data-about-input="manuscripts[{{ $loop->index }}][authors]">{{ $entry['authors'] }}</span></p>
          </div>
          @endforeach
        </div>
      </div>
    </section>

    <section aria-labelledby="recognition-title" class="grid gap-6 py-12 md:grid-cols-[16rem_1fr]">
      <div>
        @include('about.inline-page-text', ['group' => 'highlights-heading'])
<div data-text-display="highlights-heading">
<p class="text-xs font-bold uppercase tracking-[0.2em] text-primary"><span data-about-input="page_text[highlights_label]">{{ $content->pageText('highlights_label') }}</span></p>
        <h2 id="recognition-title" class="mt-3 font-headline text-3xl"><span data-about-input="page_text[highlights_heading]">{{ $content->pageText('highlights_heading') }}</span></h2>
</div>
      </div>
      <div>
        @include('about.inline-content', ['section' => 'highlights'])
        <div data-display="highlights" class="grid gap-6 sm:grid-cols-2">
          @foreach($content->highlights ?? [] as $entry)
          <div>
            <h3 class="font-semibold"><span data-about-input="highlights[{{ $loop->index }}][title]">{{ $entry['title'] }}</span></h3>
            <p class="mt-3 whitespace-pre-line text-sm leading-6 text-muted-foreground"><span data-about-input="highlights[{{ $loop->index }}][description]">{{ $entry['description'] }}</span></p>
          </div>
          @endforeach
        </div>
      </div>
    </section>

    @include('about.inline-page-text', ['group' => 'resume-text'])
<div data-text-display="resume-text">
<div class="rounded-[2rem] bg-primary px-6 py-7 text-primary-foreground sm:flex sm:items-center sm:justify-between sm:gap-8 sm:px-10">
      <div><h2 class="font-headline text-2xl sm:text-3xl"><span data-about-input="page_text[resume_heading]">{{ $content->pageText('resume_heading') }}</span></h2><p class="mt-2 text-sm text-primary-foreground/80"><span data-about-input="page_text[resume_description]">{{ $content->pageText('resume_description') }}</span></p></div>
      <a data-display="resume" href="{{ route('about.media', 'resume') }}" download class="mt-6 inline-flex shrink-0 items-center rounded-full bg-background px-6 py-3 text-sm font-semibold text-foreground transition hover:opacity-90 sm:mt-0"><span data-about-input="page_text[resume_footer_button]">{{ $content->pageText('resume_footer_button') }}</span><span class="ml-2" aria-hidden="true">↗</span></a>
    </div>
</div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  (() => {
    const page = document.querySelector('.about-resume');
    if (!page || !('IntersectionObserver' in window) || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    const items = page.querySelectorAll('section[aria-labelledby], .showcase-card, section article, .container > div:last-child');
    items.forEach(item => item.classList.add('about-reveal'));
    page.classList.add('motion-ready');

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        entry.target.classList.add('is-visible');
        observer.unobserve(entry.target);
      });
    }, { threshold: 0.08, rootMargin: '0px 0px -5% 0px' });

    items.forEach(item => observer.observe(item));
  })();
</script>
@endpush

@auth
@include('admin.partials.about-editor-script')
@endauth
