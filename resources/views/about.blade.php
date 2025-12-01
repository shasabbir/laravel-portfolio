{{-- Use the main layout template "layouts.app" so header/footer etc. are shared --}}
@extends('layouts.app')

{{-- Set the <title> of this page to "About" --}}
@section('title', 'About')

{{-- Main page content starts here --}}
@section('content')
<div class="about-page relative container mx-auto max-w-5xl px-4 py-12 md:px-6 md:py-20">
  {{-- ^ Wrapper for the whole About page content with max width and padding --}}

  {{-- =======================
       HEADER (TITLE + TAGLINE)
      ======================= --}}
  <header class="relative text-center reveal delay-0">
    {{-- Soft blurred gradient "halo" behind the title --}}
    <div class="pointer-events-none absolute inset-x-0 -top-10 -z-10 mx-auto h-64 max-w-3xl rounded-full bg-gradient-to-r from-primary/10 via-accent/10 to-primary/10 blur-3xl"></div>

    {{-- Main heading with your full name --}}
    <h1 class="font-headline text-4xl font-bold tracking-tight md:text-5xl">
      About GAZI SALAH UDDIN NUHASH
    </h1>

    {{-- Short tagline describing your domains and focus --}}
    <p class="mt-4 text-lg text-muted-foreground">
      Genomics • Proteomics • Biotechnology — focused on neurodegenerative disease research.
    </p>
  </header>

  {{-- =========================================
       TOP GRID: PHOTO (LEFT) + BIO + 3 CARDS
      ========================================= --}}
  <div class="mt-12 grid grid-cols-1 gap-12 md:grid-cols-3">
    {{-- LEFT COLUMN: AVATAR + CV BUTTON --}}
    <div class="reveal delay-100">
      {{-- Avatar wrapper with glow and floating animation --}}
      <div class="about-avatar-wrap relative mx-auto max-w-sm">
        {{-- Colored glow behind the avatar image --}}
        <div class="about-avatar-glow"></div>

        {{-- Actual avatar container with border and background --}}
        <div class="about-avatar-float overflow-hidden rounded-2xl border border-border/70 bg-background/80 shadow-xl">
          {{-- Avatar image itself --}}
          <img
            src="https://i.postimg.cc/50FkXX3x/nuhash.jpg"
            alt="GAZI SALAH UDDIN NUHASH"
            class="h-full w-full object-cover"
          />
        </div>
      </div>

      {{-- Download CV button (full width on the card) --}}
      <a
        href="/cv.pdf" {{-- Path to your CV file --}}
        download="Gazi_Salah_Uddin_Nuhash_CV.pdf" {{-- Filename suggestion for download --}}
        class="mt-6 inline-flex w-full items-center justify-center gap-2 rounded-lg bg-primary px-5 py-3 text-sm font-semibold text-primary-foreground shadow-lg shadow-primary/25 transition hover:-translate-y-0.5 hover:shadow-xl"
      >
        {{-- Small download icon on the left --}}
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
          <polyline points="7 10 12 15 17 10" />
          <line x1="12" y1="15" x2="12" y2="3" />
        </svg>

        {{-- Button label --}}
        <span>Download CV</span>
      </a>
    </div>

    {{-- RIGHT SIDE: BIOGRAPHY + 3 SMALL INFO CARDS --}}
    <div class="md:col-span-2 reveal delay-200">
      {{-- ====================
           BIOGRAPHY CARD
          ==================== --}}
      <div class="rounded-2xl border border-border/70 bg-card/60 shadow-sm backdrop-blur">
        {{-- Card header with title "Biography" --}}
        <div class="border-b border-border/60 p-6">
          <h2 class="font-headline text-2xl text-primary">Biography</h2>
        </div>

        {{-- Card body: 3 paragraphs of bio text --}}
        <div class="space-y-4 p-6 pt-4 text-base leading-relaxed text-muted-foreground">
          <p>
            Researcher specializing in Alzheimer&apos;s disease and other tauopathies with
            hands-on expertise in computer-aided drug design, molecular dynamics, and wet-lab workflows.
            Experienced in identifying kinase targets and evaluating drug–target interactions using
            GROMACS/VMD and cheminformatics pipelines.
          </p>
          <p>
            Strong academic foundation (B.Sc. Biochemistry &amp; Biotechnology, cum laude; currently M.S.
            in Biotechnology) with a track record in NGS projects and collaborative, mentor-style lab work.
          </p>
          <p>
            Seeking roles where rigorous science, data-driven decision-making, and cross-disciplinary teamwork
            translate into therapies with real patient impact.
          </p>
        </div>
      </div>

      {{-- ==================================
           3 SMALL CARDS: SKILLS / COMPETENCIES / SPEAKING
          ================================== --}}
      <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-3">
        {{-- CARD 1: Research Skills --}}
        <div class="rounded-2xl border border-border/70 bg-card/60 p-4 shadow-sm reveal delay-200">
          <div class="flex items-center justify-between pb-2">
            {{-- Card title --}}
            <h3 class="text-sm font-medium">Research Skills</h3>

            {{-- Small flask icon to represent lab skills --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M10 2v7.31L5.17 17a4 4 0 0 0 3.4 6h7.86a4 4 0 0 0 3.4-6L15 9.31V2" />
              <path d="M8.5 2h7" />
              <path d="M7 16h10" />
            </svg>
          </div>

          {{-- List of specific research skill areas --}}
          <ul class="list-disc list-inside text-sm text-muted-foreground">
            <li>Alzheimer&apos;s / Tauopathies</li>
            <li>CADD &amp; MD (GROMACS)</li>
            <li>Drug Design &amp; Discovery</li>
            <li>NGS &amp; Data Analysis</li>
          </ul>
        </div>

        {{-- CARD 2: Core Competencies --}}
        <div class="rounded-2xl border border-border/70 bg-card/60 p-4 shadow-sm reveal delay-250">
          <div class="flex items-center justify-between pb-2">
            {{-- Card title --}}
            <h3 class="text-sm font-medium">Core Competencies</h3>

            {{-- Users/team icon for soft skills --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
              <circle cx="9" cy="7" r="4" />
              <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
              <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>
          </div>

          {{-- List of key competencies --}}
          <ul class="list-disc list-inside text-sm text-muted-foreground">
            <li>Project Management</li>
            <li>Leadership &amp; Mentorship</li>
            <li>Scientific Communication</li>
          </ul>
        </div>

        {{-- CARD 3: Public Speaking --}}
        <div class="rounded-2xl border border-border/70 bg-card/60 p-4 shadow-sm reveal delay-300">
          <div class="flex items-center justify-between pb-2">
            {{-- Card title --}}
            <h3 class="text-sm font-medium">Public Speaking</h3>

            {{-- Presentation/screen icon --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M2 3h20v14H2z" />
              <path d="M12 17v4" />
              <path d="M8 21h8" />
              <path d="M7 9h3" />
              <path d="M7 13h6" />
            </svg>
          </div>

          {{-- Short highlight text --}}
          <div class="text-sm font-medium">Conference-ready Presenter</div>

          {{-- Extra detail about speaking experience --}}
          <p class="text-xs text-muted-foreground">
            Experience includes AAIC 2024/2025 and lab seminars.
          </p>
        </div>
      </div>
    </div>
  </div>

  {{-- ======================================
       RESEARCH PHILOSOPHY + ACADEMIC BACKGROUND
      ====================================== --}}
  <div class="mt-16 grid grid-cols-1 gap-8 md:grid-cols-2">
    {{-- CARD: Research Philosophy --}}
    <div class="rounded-2xl border border-border/60 bg-accent/20 p-6 shadow-sm backdrop-blur reveal delay-200">
      <h3 class="flex items-center gap-2 font-headline text-2xl text-primary">
        {{-- Lightbulb icon for ideas/vision --}}
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="11" r="4" />
          <path d="M8 15a4 4 0 0 0 8 0" />
          <path d="M9 18h6" />
          <path d="M10 22h4" />
        </svg>
        {{-- Card title --}}
        <span>Research Philosophy</span>
      </h3>

      {{-- Paragraphs describing your approach to research --}}
      <div class="mt-4 space-y-4 text-base text-muted-foreground">
        <p>
          I pursue hypothesis-driven discovery at the interface of neurobiology and computation:
          target identification (e.g., tau kinases/GSK3β), in silico screening, and validation with
          reproducible experiments.
        </p>
        <p>
          Collaboration and mentorship are central—aligning wet-lab rigor with modern bioinformatics
          to accelerate translational outcomes.
        </p>
      </div>
    </div>

    {{-- CARD: Academic Background --}}
    <div class="rounded-2xl border border-border/60 bg-accent/20 p-6 shadow-sm backdrop-blur reveal delay-300">
      <h3 class="flex items-center gap-2 font-headline text-2xl text-primary">
        {{-- Graduation cap icon for education --}}
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M22 10L12 3 2 10l10 7 10-7z" />
          <path d="M6 12v5c0 .4.2.8.6 1l5.4 3.2L17.4 18c.4-.2.6-.6.6-1v-5" />
        </svg>
        {{-- Card title --}}
        <span>Academic Background</span>
      </h3>

      {{-- Degrees and short descriptions --}}
      <div class="mt-4 space-y-4 text-base text-muted-foreground">
        <p>
          <span class="font-medium">M.S. in Biotechnology</span>, Texas Tech University, USA (Aug 2025–Present).
        </p>
        <p>
          <span class="font-medium">B.Sc. in Biochemistry &amp; Biotechnology</span>, North South University, Bangladesh (2018–2022), cum laude; CGPA 3.51/4.00.
          Undergraduate project: mutational analysis of SARS-CoV-2 genomes (Nepal).
        </p>
      </div>
    </div>
  </div>

  {{-- =====================================
       HONORS / AWARDS + CERTIFICATIONS / TRAINING
      ===================================== --}}
  <div class="mt-16 grid grid-cols-1 gap-8 md:grid-cols-2">
    {{-- CARD: Honors, Awards & Scholarships --}}
    <div class="rounded-2xl border border-border/70 bg-card/60 p-6 shadow-sm backdrop-blur reveal delay-200">
      <h3 class="flex items-center gap-2 font-headline text-2xl text-primary">
        {{-- Award/medal icon --}}
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="8" r="4" />
          <path d="M8.5 12.5L7 22l5-3 5 3-1.5-9.5" />
        </svg>
        {{-- Card title --}}
        <span>Honors, Awards &amp; Scholarships</span>
      </h3>

      {{-- Bullet list of achievements --}}
      <ul class="mt-4 list-disc list-inside space-y-2 text-sm text-muted-foreground">
        <li>Scholar, KL-YES Exchange Program (Texas) — U.S. Dept. of State (2013–2014)</li>
        <li>Full Tuition Scholarship — North South University (2018)</li>
        <li>Merit Scholarship — Board of Intermediate &amp; Secondary Education (2017)</li>
        <li>Winner, Environmental Presentation — 2nd International Nature Summit (2016)</li>
        <li>Quarter-Finalist, Asian English Olympics (BINUS University, Indonesia) (2016)</li>
      </ul>
    </div>

    {{-- CARD: Certifications & Training --}}
    <div class="rounded-2xl border border-border/70 bg-card/60 p-6 shadow-sm backdrop-blur reveal delay-300">
      <h3 class="flex items-center gap-2 font-headline text-2xl text-primary">
        {{-- DNA-style icon for scientific training --}}
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M4 4c4 0 8 4 8 8s4 8 8 8" />
          <path d="M4 20c4 0 8-4 8-8s4-8 8-8" />
          <path d="M8 6h8" />
          <path d="M8 18h8" />
          <path d="M7 9h2" />
          <path d="M15 15h2" />
        </svg>
        {{-- Card title --}}
        <span>Certifications &amp; Training</span>
      </h3>

      {{-- Bullet list of conferences and trainings --}}
      <ul class="mt-4 list-disc list-inside space-y-2 text-sm text-muted-foreground">
        <li>AAIC 2025 — Toronto, Canada</li>
        <li>AAIC 2024 — Philadelphia, USA</li>
        <li>Hands-on: Next-Generation Pathogen Sequencing — CHRF (2025)</li>
        <li>Hands-on: Computer-Aided Drug Design — ABCD Laboratory (2023)</li>
        <li>AI Tools for Academic Research — ABCD Laboratory (2024)</li>
        <li>Bioinformatics for Biotechnological Research — NIB (2021)</li>
      </ul>
    </div>
  </div>

  {{-- =====================================
       CAREER ASPIRATIONS TIMELINE
      ===================================== --}}
  <div class="mt-16 rounded-2xl border border-border/70 bg-card/60 shadow-sm backdrop-blur reveal delay-200">
    {{-- Timeline header --}}
    <div class="border-b border-border/60 px-6 py-6">
      <h3 class="flex items-center gap-3 font-headline text-2xl text-primary">
        {{-- Milestone / upward arrow icon --}}
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 22V8" />
          <path d="M8 12l4-4 4 4" />
          <path d="M3 3h18v4H3z" />
        </svg>
        {{-- Section title --}}
        <span>Career Aspirations</span>
      </h3>
      {{-- Short description under the title --}}
      <p class="mt-1 text-sm text-muted-foreground">
        A timeline of key milestones and achievements.
      </p>
    </div>

    {{-- Timeline body --}}
    <div class="px-6 pb-8 pt-4">
      {{-- Left border line acts as the vertical timeline line --}}
      <div class="relative ml-3 border-l-2 border-primary/60 pl-6">
        {{-- TIMELINE ITEM: Present --}}
        <div class="timeline-item group mb-8">
          {{-- Glowing dot on the timeline (styled in CSS) --}}
          <div class="timeline-dot"></div>

          {{-- Year/period label --}}
          <p class="text-sm font-semibold text-primary">Present</p>

          {{-- Role/position title --}}
          <h4 class="text-lg font-semibold text-foreground">M.S. Candidate, Biotechnology (TTU)</h4>

          {{-- Short description of activities --}}
          <p class="text-sm text-muted-foreground">
            Advancing expertise in life sciences with a focus on neurodegeneration and data-driven therapeutics.
          </p>
        </div>

        {{-- TIMELINE ITEM: 2024–2025 --}}
        <div class="timeline-item group mb-8">
          <div class="timeline-dot"></div>
          <p class="text-sm font-semibold text-primary">2024–2025</p>
          <h4 class="text-lg font-semibold text-foreground">Research Assistant, ABCD Laboratory</h4>
          <p class="text-sm text-muted-foreground">
            Led tauopathy projects; identified kinase targets; ran MD simulations to assess drug stability and efficacy.
          </p>
        </div>

        {{-- TIMELINE ITEM: 2018–2022 --}}
        <div class="timeline-item group">
          <div class="timeline-dot"></div>
          <p class="text-sm font-semibold text-primary">2018–2022</p>
          <h4 class="text-lg font-semibold text-foreground">B.Sc., NSU (cum laude)</h4>
          <p class="text-sm text-muted-foreground">
            Built a strong foundation in genomics, proteomics, and bioinformatics; completed NGS-driven research project.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

{{-- =====================
     EXTRA PAGE STYLES
    ===================== --}}
@push('styles')
<style>
  /* Global background for the about page: soft radial gradients top and bottom */
  .about-page::before {
    content: '';
    position: absolute;
    inset: 0;
    pointer-events: none;
    z-index: -1;
    background:
      radial-gradient(circle at top, rgba(59,130,246,0.12) 0%, transparent 55%),
      radial-gradient(circle at bottom, rgba(45,212,191,0.10) 0%, transparent 60%);
  }

  /* Avatar container: provides size + relative positioning for glow */
  .about-avatar-wrap {
    position: relative;
    max-width: 18rem;
  }

  /* Colored glowing background behind the avatar */
  .about-avatar-glow {
    position: absolute;
    inset: 8%;
    border-radius: 1.75rem;
    background:
      radial-gradient(circle at 0% 0%, rgba(59,130,246,0.4), transparent 60%),
      radial-gradient(circle at 100% 100%, rgba(45,212,191,0.4), transparent 60%);
    filter: blur(24px);
    opacity: 0.85;
    z-index: -1;
    animation: avatarGlow 8s ease-in-out infinite alternate;
  }

  /* Floating animation applied to the avatar card */
  .about-avatar-float {
    animation: avatarFloat 5s ease-in-out infinite;
    will-change: transform;
  }

  /* Animation: subtle pulsing glow effect around avatar */
  @keyframes avatarGlow {
    0% {
      transform: scale(1);
      opacity: 0.8;
    }
    50% {
      transform: scale(1.03);
      opacity: 1;
    }
    100% {
      transform: scale(0.98);
      opacity: 0.75;
    }
  }

  /* Animation: avatar moves slightly up and down to feel alive */
  @keyframes avatarFloat {
    0%, 100% {
      transform: translateY(0);
    }
    50% {
      transform: translateY(-10px);
    }
  }

  /* Base state for reveal-on-scroll elements:
     - Slightly transparent
     - Slightly moved down and scaled */
  .reveal {
    opacity: 0;
    transform: translateY(28px) scale(.98);
    transition:
      opacity .7s cubic-bezier(.16, 1, .3, 1),
      transform .7s cubic-bezier(.16, 1, .3, 1);
    will-change: opacity, transform;
  }

  /* When .visible is added by JS, element becomes fully visible */
  .reveal.visible {
    opacity: 1;
    transform: translateY(0) scale(1);
  }

  /* Delay utilities for staggered reveal animation */
  .reveal.delay-0   { transition-delay: 0ms; }
  .reveal.delay-100 { transition-delay: 100ms; }
  .reveal.delay-150 { transition-delay: 150ms; }
  .reveal.delay-200 { transition-delay: 200ms; }
  .reveal.delay-250 { transition-delay: 250ms; }
  .reveal.delay-300 { transition-delay: 300ms; }
  .reveal.delay-400 { transition-delay: 400ms; }

  /* Timeline item base: used to align text nicely with the vertical line */
  .timeline-item {
    position: relative;
    padding-left: 0.5rem;
  }

  /* On hover, make the text of the timeline item highlight with primary color */
  .timeline-item:hover p,
  .timeline-item:hover h4 {
    color: hsl(var(--primary));
  }

  /* Circular glowing dot on the left of each timeline item */
  .timeline-dot {
    position: absolute;
    left: -1.65rem;
    top: 0.45rem;
    width: 1.1rem;
    height: 1.1rem;
    border-radius: 9999px;
    background: radial-gradient(circle at 30% 30%, #ffffff, #38bdf8);
    box-shadow:
      0 0 0 4px rgba(56,189,248,0.35),
      0 10px 20px rgba(15,23,42,0.35);
    animation: dotPulse 3s ease-in-out infinite;
  }

  /* Pulse animation for timeline dots (scale + shadow changes) */
  @keyframes dotPulse {
    0%, 100% {
      transform: scale(1);
      box-shadow:
        0 0 0 4px rgba(56,189,248,0.35),
        0 10px 20px rgba(15,23,42,0.35);
    }
    50% {
      transform: scale(1.06);
      box-shadow:
        0 0 0 6px rgba(56,189,248,0.20),
        0 16px 30px rgba(15,23,42,0.45);
    }
  }
</style>
@endpush

{{-- =====================
     EXTRA PAGE SCRIPTS
    ===================== --}}
@push('scripts')
<script>
  // Run this once the DOM is fully loaded
  document.addEventListener('DOMContentLoaded', () => {
    // Select all elements that should reveal on scroll
    const els = document.querySelectorAll('.reveal');

    // Create an IntersectionObserver to watch when elements enter the viewport
    const obs = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        // If element is visible on screen
        if (entry.isIntersecting) {
          // Add the .visible class (triggers CSS animation)
          entry.target.classList.add('visible');
          // Stop observing this element (so animation only runs once)
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15 }); // 0.15 = start animation when 15% of element is visible

    // Attach the observer to each .reveal element
    els.forEach((el) => obs.observe(el));
  });
</script>
@endpush
