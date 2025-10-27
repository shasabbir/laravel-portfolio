@extends('layouts.app')

@section('title', 'Home')

@section('content')
  <section id="hero" class="relative w-full overflow-hidden bg-background py-20 md:py-32">
    <div class="container mx-auto grid grid-cols-1 items-center gap-12 px-4 text-center md:grid-cols-2 md:px-6 md:text-left">
      <div class="z-10">
        <h1 class="font-headline text-5xl font-bold tracking-tight text-foreground md:text-6xl lg:text-7xl">
          GAZI SALAH UDDIN NUHASH
        </h1>
        <p class="mt-4 bg-gradient-to-r from-primary to-accent bg-clip-text text-2xl font-semibold text-transparent">
          Life Sciences Researcher
        </p>
        <p class="mt-6 max-w-prose text-lg leading-relaxed text-muted-foreground">
          Driven, ambitious and self-motivated researcher with a strong background in Alzheimer's Disease, drug design and discovery, and next-generation sequencing.
        </p>
        <div class="mt-8 flex justify-center gap-4 md:justify-start">
          <a href="/publications" class="inline-flex items-center gap-2 rounded bg-primary px-5 py-3 text-primary-foreground">View Publications</a>
          <a href="/contact" class="inline-flex items-center gap-2 rounded border border-border px-5 py-3">Get in Touch</a>
        </div>
      </div>
      <div class="relative flex justify-center">
        <div class="absolute inset-0 z-0 scale-125">
          <svg viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg" class="h-auto w-full text-primary/10 blur-xl">
            <path fill="currentColor" d="M441.9,134.3C471.2,192.3,441.4,269.8,392.5,324.5C343.6,379.2,275.6,411.1,208.5,416.8C141.4,422.5,75.2,402,36,353.9C-3.2,305.8,-15.5,230.1,23.1,173.1C61.7,116.1,157.6,77.8,229.3,55.3C301,32.8,348.5,26.1,388,60.9C427.5,95.7,412.6,76.3,441.9,134.3Z" />
          </svg>
        </div>
        <div class="absolute inset-0 z-0">
          <svg viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg" class="h-auto w-full text-secondary">
            <path fill="currentColor" d="M451.3,277.6c-2.3,63.9-52,118.4-106,146.4c-54.1,28-112.5,29.4-162.3,4.2c-49.8-25.2-91-77.1-105.7-133.3C62.6,241.6,79,176.1,120,132.8c41-43.3,106.7-64.8,162.8-55.9C338.9,85.8,385.9,135,420.2,185.3C454.5,235.5,453.6,213.7,451.3,277.6z" />
          </svg>
        </div>
        <img src="https://i.postimg.cc/50FkXX3x/nuhash.jpg" alt="GAZI SALAH UDDIN NUHASH" class="relative z-10 h-64 w-64 rounded-full border-4 border-background object-cover shadow-lg md:h-80 md:w-80" />
      </div>
    </div>
  </section>

  <section id="about-snippet" class="bg-muted py-16 md:py-24">
    <div class="container mx-auto max-w-4xl px-4 text-center md:px-6">
      <h2 class="font-headline text-3xl font-bold md:text-4xl">A Passion for Discovery</h2>
      <p class="mt-4 text-lg leading-relaxed text-muted-foreground">
        Academically distinguished life sciences graduate with exceptional leadership abilities, adept at public speaking, teamwork, and effective communication. Looking to pursue further opportunities and make a difference within my field and harness my potential.
      </p>
      <a href="/about" class="mt-8 inline-flex items-center gap-2 rounded border border-border px-5 py-3">Learn More About Me →</a>
    </div>
  </section>

  <section id="trust-panel" class="bg-background py-16">
    <div class="container mx-auto px-4 md:px-6">
      <h2 class="text-center font-headline text-2xl font-bold">Stay Connected & Verify</h2>
      <div class="mt-8 flex flex-wrap justify-center gap-6 md:gap-8">
        <a href="https://orcid.org/" target="_blank" class="flex items-center gap-2 text-muted-foreground transition-colors hover:text-primary">ORCID</a>
        <a href="https://scholar.google.com/" target="_blank" class="flex items-center gap-2 text-muted-foreground transition-colors hover:text-primary">Google Scholar</a>
        <a href="https://www.linkedin.com/" target="_blank" class="flex items-center gap-2 text-muted-foreground transition-colors hover:text-primary">LinkedIn</a>
        <a href="/contact" class="flex items-center gap-2 text-muted-foreground transition-colors hover:text-primary">Email</a>
      </div>
    </div>
  </section>
@endsection
