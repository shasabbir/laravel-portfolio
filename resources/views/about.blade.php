@extends('layouts.app')

@section('title', 'About | Gazi Salah Uddin Nuhash')

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
        <p class="mb-5 text-xs font-bold uppercase tracking-[0.24em] text-primary">Researcher · Biotechnology &amp; Genomics</p>
        <h1 class="font-headline max-w-3xl text-4xl leading-tight text-foreground sm:text-5xl">From molecular clues to meaningful discovery.</h1>
        <p class="mt-4 max-w-2xl text-xl font-medium text-foreground/80">Exploring the molecular signatures of Alzheimer’s disease.</p>
        <p class="mt-4 max-w-2xl text-base leading-7 text-muted-foreground">I work across genomics, neuroscience and bioinformatics to study neurodegeneration. My experience spans omics analysis, computational drug discovery and laboratory research.</p>
        <div class="mt-6 flex flex-wrap gap-3">
          <a href="{{ asset('resume-gazi-salah-uddin-nuhash.pdf') }}" download="Gazi_Salah_Uddin_Nuhash_Resume.pdf" class="inline-flex items-center gap-2 rounded-full bg-primary px-6 py-3 text-sm font-semibold text-primary-foreground transition hover:opacity-90 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">
            Download résumé <span aria-hidden="true">↗</span>
          </a>
          <a href="#focus-title" class="inline-flex items-center rounded-full border border-border bg-background px-6 py-3 text-sm font-semibold text-foreground transition hover:border-primary hover:text-primary focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">Explore the research</a>
        </div>
        <p class="mt-4 text-sm text-muted-foreground">Based in Lubbock, Texas · Texas Tech University</p>
      </div>
      <div class="mx-auto w-full max-w-lg md:pt-1">
        <div class="flex min-h-64 overflow-hidden rounded-[1.75rem] border border-border/70 bg-background shadow-xl shadow-primary/10 sm:min-h-80">
          <img src="{{ asset('images/nuhash.jpg') }}" alt="Gazi Salah Uddin Nuhash" class="w-2/5 shrink-0 object-cover object-center" loading="lazy" />
          <div class="flex flex-col justify-center p-5 sm:p-8"><p class="text-xs font-bold uppercase tracking-[.14em] text-primary">Behind the research</p><p class="mt-4 font-headline text-xl sm:text-2xl">Gazi Salah Uddin Nuhash</p><p class="mt-4 text-sm leading-6 text-muted-foreground">Biotechnology &amp; genomics researcher</p></div>
        </div>
      </div>
    </div>
  </section>

  <section aria-label="Research identity" class="border-b border-border/60 bg-background/80">
    <div class="mx-auto grid max-w-6xl gap-2 px-5 py-4 md:grid-cols-3 md:gap-5 md:px-8">
      <div class="flex items-center gap-4 py-2"><span class="showcase-icon"><svg class="fill-none stroke-current stroke-[1.6]" aria-hidden="true"><use href="#research-brain"/></svg></span><div><p class="text-xs font-bold uppercase tracking-widest text-primary">Question</p><p class="font-semibold">What drives neurodegeneration?</p></div></div>
      <div class="flex items-center gap-4 py-2"><span class="showcase-icon"><svg class="fill-none stroke-current stroke-[1.6]" aria-hidden="true"><use href="#research-dna"/></svg></span><div><p class="text-xs font-bold uppercase tracking-widest text-primary">Lens</p><p class="font-semibold">Genomics &amp; bioinformatics</p></div></div>
      <div class="flex items-center gap-4 py-2"><span class="showcase-icon"><svg class="fill-none stroke-current stroke-[1.6]" aria-hidden="true"><use href="#research-molecule"/></svg></span><div><p class="text-xs font-bold uppercase tracking-widest text-primary">Approach</p><p class="font-semibold">From data to discovery</p></div></div>
    </div>
  </section>

  <div class="container mx-auto max-w-6xl px-5 py-12 md:px-8 md:py-14">
    <section aria-labelledby="focus-title" class="grid gap-6 border-b border-border/70 pb-12 md:grid-cols-[16rem_1fr]">
      <div>
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-primary">01 / Focus</p>
        <h2 id="focus-title" class="mt-3 font-headline text-3xl">Inside the research</h2>
      </div>
      <div class="grid gap-4 sm:grid-cols-2">
        <div class="showcase-card overflow-hidden rounded-[1.75rem] border border-border/70 bg-card shadow-sm sm:row-span-2">
          <img src="{{ asset('images/neurodegeneration-illustration.png') }}" alt="Illustration of a brain with connected neural pathways" class="block h-auto w-full" loading="lazy" />
          <div class="p-6">
            <span class="showcase-icon mb-4"><svg class="fill-none stroke-current stroke-[1.6]" aria-hidden="true"><use href="#research-brain"/></svg></span>
            <h3 class="font-semibold">Neurodegeneration</h3>
            <p class="mt-2 text-sm leading-6 text-muted-foreground">Alzheimer’s disease, amyloid-β pathology, tau dysregulation and neuroinflammation.</p>
          </div>
        </div>
        <div class="showcase-card relative overflow-hidden rounded-[1.75rem] border border-border/70 bg-card p-6 shadow-sm">
          <span class="showcase-mesh absolute right-0 top-0 h-32 w-32 opacity-40" aria-hidden="true"></span>
          <span class="showcase-icon mb-5"><svg class="fill-none stroke-current stroke-[1.6]" aria-hidden="true"><use href="#research-dna"/></svg></span>
          <h3 class="font-semibold">Omics &amp; bioinformatics</h3>
          <p class="mt-2 text-sm leading-6 text-muted-foreground">Gene expression, protein abundance, molecular biomarkers and reproducible data analysis.</p>
        </div>
        <div class="showcase-card relative overflow-hidden rounded-[1.75rem] border border-border/70 bg-card p-6 shadow-sm">
          <span class="absolute right-5 top-3 text-7xl text-primary/10" aria-hidden="true">✳</span>
          <span class="showcase-icon mb-5"><svg class="fill-none stroke-current stroke-[1.6]" aria-hidden="true"><use href="#research-molecule"/></svg></span>
          <h3 class="font-semibold">Drug discovery</h3>
          <p class="mt-2 text-sm leading-6 text-muted-foreground">Virtual screening, cheminformatics and molecular dynamics for therapeutic research.</p>
        </div>
      </div>
    </section>

    <section aria-labelledby="experience-title" class="grid gap-6 border-b border-border/70 py-12 md:grid-cols-[16rem_1fr]">
      <div>
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-primary">02 / Experience</p>
        <h2 id="experience-title" class="mt-3 font-headline text-3xl">Research &amp; work</h2>
      </div>
      <div class="space-y-6">
        <article class="border-l-2 border-primary pl-5">
          <p class="text-sm font-semibold text-primary">Sep 2026 – Present</p>
          <h3 class="mt-1 text-xl font-semibold">Graduate Research Assistant</h3>
          <p class="mt-1 text-sm text-muted-foreground">Center for Biotechnology and Genomics · Texas Tech University</p>
          <p class="mt-3 leading-7 text-muted-foreground">Investigating molecular fingerprints of Alzheimer’s disease through genomic and biological datasets. Preparing quality-controlled analyses, pathway visualizations and figures for research presentations and manuscripts.</p>
        </article>
        <article class="border-l-2 border-border pl-5">
          <p class="text-sm font-semibold text-primary">Jul 2024 – Feb 2026</p>
          <h3 class="mt-1 text-xl font-semibold">Research Assistant &amp; Assistant Lab Manager</h3>
          <p class="mt-1 text-sm text-muted-foreground">ABCD Laboratory · Bangladesh</p>
          <p class="mt-3 leading-7 text-muted-foreground">Led computational drug discovery projects focused on neurodegenerative pathways. Studied tau kinase targets using virtual screening and molecular dynamics with GROMACS and VMD, while mentoring junior researchers and supporting laboratory operations.</p>
        </article>
        <article class="border-l-2 border-border pl-5">
          <p class="text-sm font-semibold text-primary">Aug 2023 – Jun 2024</p>
          <h3 class="mt-1 text-xl font-semibold">Junior Research Collaborator</h3>
          <p class="mt-1 text-sm text-muted-foreground">ABCD Laboratory · Bangladesh</p>
          <p class="mt-3 leading-7 text-muted-foreground">Explored natural products, therapeutic protein targets and computer-aided drug design methods.</p>
        </article>
        <article class="border-l-2 border-border pl-5">
          <p class="text-sm font-semibold text-primary">Feb 2020 – Jun 2022</p>
          <h3 class="mt-1 text-xl font-semibold">Research Intern</h3>
          <p class="mt-1 text-sm text-muted-foreground">NSU Genome Research Institute · North South University</p>
          <p class="mt-3 leading-7 text-muted-foreground">Worked on bacterial culture, antibiotic resistance and next-generation sequencing projects, including an analysis of SARS-CoV-2 genomes from Nepal.</p>
        </article>
        <p class="text-sm text-muted-foreground">Additional experience: Project Manager at Wholesome Alive (2022–2023), Laboratory Assistant at North South University (2019–2020), and Student Assistant at Texas Tech University (2026).</p>
      </div>
    </section>

    <section aria-labelledby="education-title" class="grid gap-6 border-b border-border/70 py-12 md:grid-cols-[16rem_1fr]">
      <div>
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-primary">03 / Education</p>
        <h2 id="education-title" class="mt-3 font-headline text-3xl">Academic path</h2>
      </div>
      <div class="grid gap-4 sm:grid-cols-2">
        <article class="showcase-card rounded-[1.75rem] border border-border/70 bg-card p-6 shadow-sm">
          <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-[#a6192e] text-lg font-black tracking-tighter text-white" aria-label="Texas Tech University initials">TTU</div>
          <p class="text-sm font-semibold text-primary">2025 – Present</p>
          <h3 class="mt-3 text-xl font-semibold">M.S. in Biotechnology</h3>
          <p class="mt-1 text-muted-foreground">Texas Tech University · Lubbock, Texas</p>
          <p class="mt-4 text-sm leading-6 text-muted-foreground">Life sciences research concentration · Current GPA 4.00 / 4.00</p>
        </article>
        <article class="showcase-card rounded-[1.75rem] border border-border/70 bg-card p-6 shadow-sm">
          <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-[#123f7a] text-lg font-black tracking-tighter text-white" aria-label="North South University initials">NSU</div>
          <p class="text-sm font-semibold text-primary">2018 – 2022</p>
          <h3 class="mt-3 text-xl font-semibold">B.S. in Biochemistry &amp; Biotechnology</h3>
          <p class="mt-1 text-muted-foreground">North South University · Dhaka, Bangladesh</p>
          <p class="mt-4 text-sm leading-6 text-muted-foreground">Graduated cum laude, top 5% of class · CGPA 3.51 / 4.00</p>
        </article>
      </div>
    </section>

    <section aria-labelledby="skills-title" class="grid gap-6 border-b border-border/70 py-12 md:grid-cols-[16rem_1fr]">
      <div>
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-primary">04 / Capabilities</p>
        <h2 id="skills-title" class="mt-3 font-headline text-3xl">Methods &amp; tools</h2>
      </div>
      <div class="grid gap-5 sm:grid-cols-2">
        <div class="showcase-card rounded-[1.75rem] bg-[#103542] p-7 text-white">
          <span class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-teal-300/20 text-teal-100"><svg class="h-6 w-6 fill-none stroke-current stroke-[1.6]" aria-hidden="true"><use href="#research-flask"/></svg></span>
          <h3 class="font-semibold">Laboratory</h3>
          <p class="mt-2 leading-7 text-slate-200">NGS, PCR, RT-qPCR, ELISA, Western blot, DNA/RNA extraction, mammalian and bacterial cell culture, CRISPR-Cas9 systems, immunofluorescence, mouse handling and aseptic surgery.</p>
        </div>
        <div class="showcase-card rounded-[1.75rem] bg-[#103542] p-7 text-white">
          <span class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-teal-300/20 text-teal-100"><svg class="h-6 w-6 fill-none stroke-current stroke-[1.6]" aria-hidden="true"><use href="#research-code"/></svg></span>
          <h3 class="font-semibold">Computational</h3>
          <p class="mt-2 leading-7 text-slate-200">Python, R, C/C++, GROMACS, NAMD, VMD, AutoDock Vina, PyMOL, Gaussian, genome annotation and data mining.</p>
        </div>
      </div>
    </section>

    <section aria-labelledby="work-title" class="grid gap-6 border-b border-border/70 py-12 md:grid-cols-[16rem_1fr]">
      <div>
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-primary">05 / Scientific work</p>
        <h2 id="work-title" class="mt-3 font-headline text-3xl">Manuscripts</h2>
      </div>
      <div class="space-y-4">
        <div class="rounded-2xl border border-border/70 p-5"><span class="text-xs font-bold uppercase tracking-wider text-primary">In preparation</span><h3 class="mt-2 font-semibold">Molecular Fingerprints in Natural Products to Address Alzheimer’s Disease – A Computational Approach</h3><p class="mt-1 text-sm text-muted-foreground">Nuhash GSU, Crasto CJ</p></div>
        <div class="rounded-2xl border border-border/70 p-5"><span class="text-xs font-bold uppercase tracking-wider text-primary">Submitted</span><h3 class="mt-2 font-semibold">Lamellarins – An Updated Review of Sources, Synthesis, Pharmacology, Pharmacokinetics and Toxicity</h3><p class="mt-1 text-sm text-muted-foreground">Nuhash GSU, Junaid M</p></div>
        <div class="rounded-2xl border border-border/70 p-5"><span class="text-xs font-bold uppercase tracking-wider text-primary">In review</span><h3 class="mt-2 font-semibold">Revivify studies on inflammatory stress and immune cell activation</h3><p class="mt-1 text-sm text-muted-foreground">Co-author on two manuscripts</p></div>
      </div>
    </section>

    <section aria-labelledby="recognition-title" class="grid gap-6 py-12 md:grid-cols-[16rem_1fr]">
      <div>
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-primary">06 / Recognition</p>
        <h2 id="recognition-title" class="mt-3 font-headline text-3xl">Selected highlights</h2>
      </div>
      <div class="grid gap-6 sm:grid-cols-2">
        <div>
          <h3 class="font-semibold">Honors</h3>
          <ul class="mt-3 space-y-3 text-sm leading-6 text-muted-foreground">
            <li>Graduate School Competitive Tuition Scholarship · Texas Tech University, 2025–2026</li>
            <li>Full tuition scholarship · North South University, 2018</li>
            <li>KL-YES Exchange Scholar · U.S. Department of State, 2013–2014</li>
          </ul>
        </div>
        <div>
          <h3 class="font-semibold">Conferences &amp; training</h3>
          <ul class="mt-3 space-y-3 text-sm leading-6 text-muted-foreground">
            <li>Alzheimer’s Association International Conference · 2024 &amp; 2025</li>
            <li>Next-Generation Pathogen Sequencing · CHRF, 2025</li>
            <li>Aseptic Surgery and Working with Mice in Research · CITI Program, 2026</li>
          </ul>
        </div>
      </div>
    </section>

    <div class="rounded-[2rem] bg-primary px-6 py-7 text-primary-foreground sm:flex sm:items-center sm:justify-between sm:gap-8 sm:px-10">
      <div><h2 class="font-headline text-2xl sm:text-3xl">Explore the full résumé</h2><p class="mt-2 text-sm text-primary-foreground/80">Experience, technical skills, scientific work and references in one document.</p></div>
      <a href="{{ asset('resume-gazi-salah-uddin-nuhash.pdf') }}" download="Gazi_Salah_Uddin_Nuhash_Resume.pdf" class="mt-6 inline-flex shrink-0 items-center rounded-full bg-background px-6 py-3 text-sm font-semibold text-foreground transition hover:opacity-90 sm:mt-0">Download PDF <span class="ml-2" aria-hidden="true">↗</span></a>
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
