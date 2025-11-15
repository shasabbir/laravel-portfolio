@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="home-page relative">

 {{-- ================= HERO ================= --}}
<section id="hero" class="relative w-full overflow-hidden bg-background py-20 md:py-32">

    {{-- FULLSCREEN BACKGROUND VIDEO --}}
    <div class="hero-video-wrapper pointer-events-none absolute inset-0 -z-20">
        <video class="hero-video h-full w-full object-cover"
            src="https://media.istockphoto.com/id/1494372561/video/soft-background-animation-abstract-blurred-and-beautiful-clean-and-shiny-motion-design-the.mp4?s=mp4-640x640-is&k=20&c=o8TfyL_c12J3qKRK3RPjTRDrSxJ0bvnt9a5wjH45SdU="
            autoplay muted loop playsinline></video>

        {{-- OVERLAY ON TOP OF VIDEO TO MAKE TEXT READABLE --}}
        <div class="hero-video-overlay absolute inset-0"></div>
    </div>

    {{-- LARGE BACKGROUND TEAL GRADIENT ON THE RIGHT --}}
    <div class="hero-spotlight pointer-events-none absolute right-[-8rem] top-[-6rem] -z-10 hidden md:block"></div>

    <div
        class="container relative z-10 mx-auto grid max-w-7xl grid-cols-1 items-center gap-12 px-4 text-center md:grid-cols-2 md:px-6 md:text-left">

        {{-- LEFT CONTENT --}}
        <div class="z-10 reveal delay-0">
            <h1 class="font-headline text-5xl font-bold tracking-tight text-foreground md:text-6xl lg:text-6xl">
                GAZI SALAH UDDIN NUHASH
            </h1>

            <p
                class="mt-4 bg-gradient-to-r from-primary to-accent bg-clip-text text-2xl font-semibold text-transparent">
                Life Sciences Researcher
            </p>

            <p class="mx-auto mt-6 max-w-prose text-lg leading-relaxed text-muted-foreground md:mx-0">
                Driven, ambitious and self-motivated researcher with a strong background in Alzheimer's Disease,
                drug design and discovery, and next-generation sequencing.
            </p>

            <div class="mt-8 flex justify-center gap-4 md:justify-start">
                <a href="{{ route('publications.index') }}"
                    class="inline-flex items-center gap-2 rounded bg-primary px-5 py-3 text-base font-semibold text-primary-foreground shadow transition hover:opacity-90">
                    View Publications
                </a>
                <a href="{{ route('contact.show') }}"
                    class="inline-flex items-center gap-2 rounded border border-border px-5 py-3 text-base font-semibold transition hover:bg-accent/10">
                    Get in Touch
                </a>
            </div>
        </div>

{{-- RIGHT VISUAL --}}
<div class="relative z-10 flex items-center justify-center reveal delay-200">

    {{-- SOFT, ALMOST-WHITE ANIMATED BACKGROUND (glow behind image) --}}
    <div
        class="pointer-events-none absolute left-1/2 top-1/2 -z-10 flex -translate-x-1/2 -translate-y-1/2 items-center justify-center">
        <div
            class="relative h-72 w-72 rounded-full md:h-80 md:w-80 overflow-hidden bg-white/90 shadow-[0_24px_70px_rgba(15,23,42,0.14)]">
            <video
                class="h-full w-full object-cover opacity-35 mix-blend-screen"
                src="https://cdnl.iconscout.com/lottie/premium/preview-watermark/background-animation-gif-download-7501792.mp4"
                autoplay
                muted
                loop
                playsinline>
            </video>

            {{-- very soft white/blue gradient so border is not obvious --}}
            <div class="pointer-events-none absolute inset-0 rounded-full"
                style="background: radial-gradient(circle at 50% 45%,
                          rgba(255,255,255,0.98) 0%,
                          rgba(239,246,255,0.96) 35%,
                          rgba(226,239,255,0.90) 60%,
                          rgba(255,255,255,0.85) 80%,
                          rgba(255,255,255,0) 100%);">
            </div>
        </div>
    </div>

    {{-- AVATAR + SHADOW (now wider/larger) --}}
    <div class="avatar-wrapper relative flex items-center justify-center">

        {{-- SOFT OVAL SHADOW UNDER THE IMAGE --}}
        <div class="avatar-shadow pointer-events-none absolute left-1/2 top-[72%] -z-10 -translate-x-1/2"></div>

        {{-- ACTUAL AVATAR (bigger circle) --}}
        <div
            class="avatar-float relative h-64 w-64 overflow-hidden rounded-full border-[4px] border-white bg-white/60 shadow-avatar md:h-72 md:w-72">
            <img src="{{ asset('images/nuhash.jpg') }}" alt="GAZI SALAH UDDIN NUHASH"
                 class="h-full w-full object-cover" />
        </div>
    </div>
</div>

    </div>
</section>



{{-- ================= 3 INFO CARDS ================= --}}
<section class="relative overflow-hidden bg-white py-16 text-slate-800">
    {{-- soft blobs --}}
    <div class="pointer-events-none absolute inset-0 -z-10">
        <div class="absolute -left-24 top-0 h-64 w-64 rounded-full bg-[#FDEDED] blur-3xl opacity-70"></div>
        <div class="absolute right-[-4rem] top-16 h-72 w-72 rounded-full bg-[#EDF5FD] blur-3xl opacity-60"></div>
        <div class="absolute bottom-[-3rem] left-1/2 h-64 w-64 -translate-x-1/2 rounded-full bg-[#FDFAED] blur-3xl opacity-60"></div>
    </div>

    <div class="mx-auto max-w-7xl px-4">
        <div class="grid grid-cols-1 gap-12 text-center md:grid-cols-3">

            {{-- Card 1: Neurodegeneration & Tauopathies --}}
            <div class="group flex flex-col items-center">
                <div
                    class="mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-sky-500 text-white shadow-lg shadow-sky-500/40 transition-all duration-300 group-hover:scale-110 group-hover:shadow-xl group-hover:shadow-sky-500/60">
                    {{-- brain icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-10 w-10">
                        <path fill="currentColor"
                              d="M9 2a3 3 0 0 0-3 3v.2A3 3 0 0 0 3 8a3 3 0 0 0 1.1 2.3A3 3 0 0 0 4 12a3 3 0 0 0 2 2.82V15a3 3 0 0 0 3 3h.5A2.5 2.5 0 0 0 12 20.5V5a3 3 0 0 0-3-3Zm6 0a3 3 0 0 1 3 3v.2A3 3 0 0 1 21 8a3 3 0 0 1-1.1 2.3A3 3 0 0 1 20 12a3 3 0 0 1-2 2.82V15a3 3 0 0 1-3 3h-.5A2.5 2.5 0 0 1 12 20.5V5a3 3 0 0 1 3-3Z"/>
                    </svg>
                </div>

                <h3 class="text-lg font-semibold text-slate-900">
                    Neurodegeneration &amp; Tauopathies
                </h3>

                <p class="mt-3 max-w-xs text-sm leading-relaxed text-slate-500">
                    Specializing in Alzheimer&apos;s disease and tauopathies, with a focus on disease mechanisms,
                    kinase targets and translational impact.
                </p>
            </div>

            {{-- Card 2: CADD, MD & Drug Design --}}
            <div class="group flex flex-col items-center">
                <div
                    class="mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-emerald-500 text-white shadow-lg shadow-emerald-500/40 transition-all duration-300 group-hover:scale-110 group-hover:shadow-xl group-hover:shadow-emerald-500/60">
                    {{-- flask / chemistry icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-10 w-10">
                        <path fill="currentColor"
                              d="M10 2v7.3L5.2 17A4 4 0 0 0 8.6 23h6.8A4 4 0 0 0 18.8 17L14 9.3V2h-4Zm-1.5 0h7v2h-7v-2Z"/>
                    </svg>
                </div>

                <h3 class="text-lg font-semibold text-slate-900">
                    Drug Design &amp; Molecular Dynamics
                </h3>

                <p class="mt-3 max-w-xs text-sm leading-relaxed text-slate-500">
                    Hands-on experience in computer-aided drug design, docking and MD simulations
                    (GROMACS/VMD), linked with wet-lab validation.
                </p>
            </div>

            {{-- Card 3: NGS, Data & Communication --}}
            <div class="group flex flex-col items-center">
                <div
                    class="mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-indigo-500 text-white shadow-lg shadow-indigo-500/40 transition-all duration-300 group-hover:scale-110 group-hover:shadow-xl group-hover:shadow-indigo-500/60">
                    {{-- DNA / data icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-10 w-10">
                        <path fill="currentColor"
                              d="M4 4c4 0 8 4 8 8s4 8 8 8M4 20c4 0 8-4 8-8s4-8 8-8M8 6h8M8 18h8M7 9h2M15 15h2"/>
                    </svg>
                </div>

                <h3 class="text-lg font-semibold text-slate-900">
                    NGS &amp; Scientific Communication
                </h3>

                <p class="mt-3 max-w-xs text-sm leading-relaxed text-slate-500">
                    Strong background in NGS projects, data analysis and conference-ready
                    communication, including AAIC 2024/2025 presentations.
                </p>
            </div>

        </div>
    </div>
</section>


    {{-- ================= ABOUT / VIDEO SPLIT ================= --}}
    <section id="about-snippet" class="relative overflow-hidden">
        {{-- subtle background spot --}}
        <div class="pointer-events-none absolute inset-0 -z-10">
            <div class="absolute left-[-5rem] top-10 h-72 w-72 rounded-full bg-[#EDF5FD] blur-3xl opacity-70"></div>
            <div class="absolute bottom-[-4rem] right-[-3rem] h-72 w-72 rounded-full bg-[#FDEDED] blur-3xl opacity-60"></div>
        </div>

        <div class="grid md:grid-cols-2">

           {{-- LEFT TEXT CONTENT --}}
<div class="mx-0 flex items-center justify-center pt-8 md:mx-10 ">
    <div class="max-w-xl text-center md:text-left reveal delay-0">
        <h2 class="font-headline text-3xl font-bold md:text-4xl">A Passion for Discovery</h2>

        <p class="mt-4 text-lg leading-relaxed">
            Academically distinguished life sciences graduate with exceptional leadership abilities,
            adept at public speaking, teamwork, and effective communication. Looking to pursue further
            opportunities and make a difference within my field and harness my potential.
        </p>


<div class="mt-6 flex  items-center  gap-6">

        <a href="{{ route('about') }}"
           class="mt-8 inline-flex items-center gap-2 rounded border border-border bg-background px-5 py-3 text-base font-semibold transition hover:bg-accent/10">
            Learn More About Me
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14"></path>
                <path d="M12 5l7 7-7 7"></path>
            </svg>
       
        </a>
          {{-- SCIENTIST GIF UNDER THE TEXT --}}
       <div class="relative inline-flex items-center justify-center">
    {{-- soft glow behind --}}
    <div
        class="pointer-events-none absolute inset-0 -z-10 h-24 w-24 rounded-full bg-[radial-gradient(circle_at_30%_20%,rgba(59,130,246,0.35),transparent_60%)] blur-2xl opacity-80">
    </div>

    {{-- circular chip --}}
    <div
        class="relative flex h-60 w-60 items-center justify-center rounded-full  bg-white/70  backdrop-blur">
        <img
            src="{{ asset('svg/Robot-Bot.gif') }}"
            alt="Scientist animation"
            class="h-40 w-40 object-contain"
        />
    </div>
</div>

</div>
       
    
        
      
    </div>
</div>


            {{-- RIGHT VIDEO --}}
            <div class="relative min-h-[300px] w-full md:min-h-0">
                <div class="h-full w-full reveal delay-200">
                    <video src="https://cdn.pixabay.com/video/2024/04/20/208773_large.mp4" autoplay loop muted playsinline
                        class="h-full w-full object-cover"></video>
                    <div class="absolute inset-0 bg-primary/20"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= EXPERTISE ================= --}}
    <section id="expertise" class="relative w-full overflow-hidden py-16 md:py-24">
        {{-- background spots --}}
        <div class="pointer-events-none absolute inset-0 -z-10">
            <div class="absolute left-1/2 top-[-4rem] h-72 w-72 -translate-x-1/2 rounded-full bg-[#EDF5FD] blur-3xl opacity-70"></div>
            <div class="absolute bottom-[-4rem] left-0 h-72 w-72 rounded-full bg-[#FDFAED] blur-3xl opacity-60"></div>
            <div class="absolute bottom-[-4rem] right-[-2rem] h-72 w-72 rounded-full bg-[#FDEDED] blur-3xl opacity-60"></div>
        </div>

        <div class="container mx-auto px-4 md:px-6">
            <div class="text-center reveal delay-0">
                <h2 class="font-headline text-3xl font-bold md:text-4xl">Areas of Expertise</h2>
                <p class="mx-auto mt-4 max-w-3xl text-center text-muted-foreground">
                    Specializing in fields that advance our understanding of complex diseases and therapeutic interventions.
                </p>
            </div>

            <div class="mt-12 grid grid-cols-1 gap-8 md:grid-cols-3">

                <div class="flex flex-col items-center text-center reveal delay-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-primary" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M9 2v6l-2 3a7 7 0 1 0 10 0l-2-3V2" />
                        <path d="M12 2v6" />
                    </svg>
                    <h3 class="mt-4 font-headline text-2xl font-bold">Alzheimer's Disease</h3>
                    <p class="mt-2 max-w-xs text-muted-foreground">
                        Strong background in researching and understanding Alzheimer's Disease.
                    </p>
                </div>

                <div class="flex flex-col items-center text-center reveal delay-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-primary" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M10 2v8.3L3.2 20a2 2 0 0 0 1.7 3h14.2a2 2 0 0 0 1.7-3L14 10.3V2" />
                        <path d="M8.5 2h7" />
                        <path d="M7 16h10" />
                    </svg>
                    <h3 class="mt-4 font-headline text-2xl font-bold">Drug Design &amp; Discovery</h3>
                    <p class="mt-2 max-w-xs text-muted-foreground">
                        Experienced in the design and discovery of novel therapeutic drugs.
                    </p>
                </div>

                <div class="flex flex-col items-center text-center reveal delay-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-primary" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M17 3c-5 0-8 4-8 9s3 9 8 9" />
                        <path d="M7 3c5 0 8 4 8 9s-3 9-8 9" />
                        <path d="M4 9h10" />
                        <path d="M10 15h10" />
                    </svg>
                    <h3 class="mt-4 font-headline text-2xl font-bold">NGS &amp; Data Analysis</h3>
                    <p class="mt-2 max-w-xs text-muted-foreground">
                        Adept at next-generation sequencing and analyzing complex biological data.
                    </p>
                </div>

            </div>
        </div>
    </section>

    {{-- ================= ISTAART MEMBERSHIP (NEW SECTION) ================= --}}
    <section id="membership" class="relative overflow-hidden bg-background py-16">
        {{-- Soft animated background blobs --}}
        <div class="absolute inset-0 -z-10 opacity-60">
            <div
                class="pointer-events-none absolute -left-24 top-0 h-72 w-72 animate-pulse rounded-full bg-primary/20 blur-3xl">
            </div>
            <div
                class="pointer-events-none absolute -right-24 bottom-0 h-72 w-72 animate-pulse rounded-full bg-accent/20 blur-3xl">
            </div>
        </div>

        <div class="container mx-auto px-4 md:px-6">
            <div class="mx-auto max-w-7xl reveal delay-0">
                {{-- Gradient ring card --}}
                <div class="relative rounded-3xl bg-gradient-to-br from-primary/20 via-background to-accent/20 p-[1px]">
                    <div
                        class="relative rounded-3xl bg-background/80 px-6 py-10 backdrop-blur md:px-10">
                        {{-- Floating glow behind content --}}
                        <div
                            class="pointer-events-none absolute -inset-8 -z-10 bg-gradient-to-r from-primary/30 via-accent/30 to-primary/30 opacity-40 blur-3xl">
                        </div>

                        <div class="grid items-center gap-10 md:grid-cols-[1.2fr_0.8fr]">
                            {{-- Left: Text copy --}}
                            <div>
                                <span
                                    class="inline-flex items-center gap-2 rounded-full border border-border bg-muted px-3 py-1 text-sm font-medium">
                                    <span class="inline-block h-2 w-2 animate-ping rounded-full bg-primary"></span>
                                    <span class="inline-block h-2 w-2 rounded-full bg-primary"></span>
                                    Member Spotlight
                                </span>

                                <h2 class="mt-4 font-headline text-3xl font-bold md:text-4xl">
                                    Member of
                                    <span
                                        class="bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">ISTAART</span>
                                </h2>

                                <p class="mt-4 text-lg leading-relaxed text-muted-foreground">
                                    I’m an active member of the
                                    <span class="font-semibold">
                                        International Society to Advance Alzheimer’s Research and Treatment (ISTAART)
                                    </span>,
                                    a global professional community advancing research, collaboration, and knowledge-sharing
                                    in Alzheimer’s and dementia.
                                </p>

                                <ul class="mt-6 grid gap-3 text-sm md:grid-cols-2">
                                    <li class="flex items-center gap-2">
                                        <span class="inline-block h-1.5 w-1.5 rounded-full bg-primary"></span>
                                        Access to cutting-edge research communities &amp; PIA networks
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="inline-block h-1.5 w-1.5 rounded-full bg-primary"></span>
                                        Collaboration with global researchers &amp; clinicians
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="inline-block h-1.5 w-1.5 rounded-full bg-primary"></span>
                                        Ongoing training, events &amp; annual AAIC engagement
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="inline-block h-1.5 w-1.5 rounded-full bg-primary"></span>
                                        Commitment to evidence-based, translational impact
                                    </li>
                                </ul>

                                <div class="mt-8 flex flex-wrap items-center gap-4">
                                    <a href="https://istaart.alz.org/home" target="_blank" rel="noopener noreferrer"
                                        class="inline-flex items-center justify-center rounded-full bg-primary px-5 py-2.5 text-sm font-semibold text-primary-foreground shadow-lg shadow-primary/30 transition hover:-translate-y-0.5 hover:shadow-xl">
                                        View ISTAART Community
                                    </a>

                                    <div
                                        class="flex items-center gap-2 rounded-full border border-border px-3 py-1.5 text-xs text-muted-foreground">
                                        <span class="inline-block h-2 w-2 rounded-full bg-green-500"></span>
                                        Verified Membership
                                    </div>
                                </div>
                            </div>

                            {{-- Right: ISTAART logo tile --}}
                            <div class="relative mx-auto flex w-full max-w-sm items-center justify-center">
                                <div
                                    class="absolute inset-0 -z-10 animate-spin-slow rounded-3xl bg-[conic-gradient(from_0deg,rgba(74,13,102,0.15),rgba(255,255,255,0.08),rgba(74,13,102,0.15))] blur-xl">
                                </div>

                                {{-- Animated radial gradient card --}}
                                <div
                                    class="relative w-full rounded-2xl border border-white/20 bg-[radial-gradient(120%_120%_at_0%_0%,_#4A0D66_0%,_#7C1FA8_45%,_#E0A3FF_100%)] bg-[length:200%_200%] animate-gradient p-6 shadow-sm">
                                    <div class="mx-auto flex aspect-[4/3] items-center justify-center">
                                        <div class="relative h-24 w-40 md:h-28 md:w-48">
                                            <img
                                                src="https://static.prod01.ue1.p.pcomm.net/istaartcommunity/content/images/ISTAART-RGB-White%20(1).png"
                                                alt="ISTAART — International Society to Advance Alzheimer’s Research and Treatment"
                                                class="h-full w-full object-contain" loading="lazy" decoding="async" />
                                        </div>
                                    </div>

                                    <div class="mt-6 grid grid-cols-3 gap-3 text-center text-xs text-white/90">
                                        <div
                                            class="rounded-lg bg-white/10 px-3 py-2 ring-1 ring-white/10">
                                            <p class="font-semibold text-white">Global</p>
                                            <p>Community</p>
                                        </div>
                                        <div
                                            class="rounded-lg bg-white/10 px-3 py-2 ring-1 ring-white/10">
                                            <p class="font-semibold text-white">Alzheimer’s</p>
                                            <p>Focus</p>
                                        </div>
                                        <div
                                            class="rounded-lg bg-white/10 px-3 py-2 ring-1 ring-white/10">
                                            <p class="font-semibold text-white">PIA</p>
                                            <p>Networks</p>
                                        </div>
                                    </div>

                                    <div class="mt-6 text-center">
                                        <a href="https://istaart.alz.org/home" target="_blank"
                                            rel="noopener noreferrer"
                                            class="inline-flex items-center gap-1 rounded text-sm font-medium text-white underline-offset-4 hover:underline focus:outline-none focus-visible:ring-2 focus-visible:ring-white/60">
                                            Explore ISTAART
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M5 12h14" />
                                                <path d="M12 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- subtle animated divider line --}}
                        <div
                            class="pointer-events-none mt-10 h-px w-full bg-gradient-to-r from-transparent via-border to-transparent">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= TRUST PANEL ================= --}}
    <section id="trust-panel" class="relative overflow-hidden bg-background py-16">
        {{-- background spots --}}
        <div class="pointer-events-none absolute inset-0 -z-10">
            <div class="absolute left-[-4rem] top-[-3rem] h-64 w-64 rounded-full bg-[#EDF5FD] blur-3xl opacity-70"></div>
            <div class="absolute bottom-[-4rem] right-[-4rem] h-72 w-72 rounded-full bg-[#FDEDED] blur-3xl opacity-60"></div>
        </div>

        <div class="container mx-auto px-4 md:px-6 reveal delay-0">
            <h2 class="text-center font-headline text-2xl font-bold">Stay Connected &amp; Verify</h2>
            <div class="mt-8 flex flex-wrap justify-center gap-6 text-muted-foreground md:gap-8">
                <a href="https://orcid.org/" target="_blank" rel="noopener noreferrer"
                    class="flex items-center gap-2 transition-colors hover:text-primary">
                    <span
                        class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-primary text-[10px] font-bold text-white">iD</span>
                    <span class="font-medium">ORCID</span>
                </a>
                <a href="https://scholar.google.com/" target="_blank" rel="noopener noreferrer"
                    class="flex items-center gap-2 transition-colors hover:text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 11l9-7 9 7-9 7-9-7z" />
                        <path d="M9 22v-7l6-4" />
                    </svg>
                    <span class="font-medium">Google Scholar</span>
                </a>
                <a href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer"
                    class="flex items-center gap-2 transition-colors hover:text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M4.98 3.5a2.5 2.5 0 11-.02 5 2.5 2.5 0 01.02-5zM3 8.98h4v12H3zM9 8.98h3.8v1.64h.05c.53-.95 1.82-1.95 3.74-1.95 4 0 4.74 2.63 4.74 6.06v7.25h-4v-6.43c0-1.53-.03-3.5-2.13-3.5-2.13 0-2.45 1.66-2.45 3.38v6.55H9z" />
                    </svg>
                    <span class="font-medium">LinkedIn</span>
                </a>
                <a href="{{ route('contact.show') }}"
                    class="flex items-center gap-2 transition-colors hover:text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16v16H4z" />
                        <path d="M22 6l-10 7L2 6" />
                    </svg>
                    <span class="font-medium">Email</span>
                </a>
            </div>
        </div>
    </section>

</div> {{-- /.home-page --}}
@endsection

@push('styles')
<style>
    /* ===================== GLOBAL SOFT SPOT GRADIENTS ===================== */
    /* Hero: soft pastel spots over the video (using your colors) */
    #hero {
        position: relative;
    }

    .hero-video-overlay {
        background:
            radial-gradient(circle at 20% 20%, rgba(237, 245, 253, 0.8) 0%, transparent 55%),
            radial-gradient(circle at 80% 80%, rgba(253, 237, 237, 0.8) 0%, transparent 55%),
            radial-gradient(circle at 50% 110%, rgba(253, 250, 237, 0.85) 0%, transparent 65%);
        mix-blend-mode: soft-light;
    }

    /* 3 Info Cards section (white bg) */
    section.bg-white.py-16.text-slate-800 {
        position: relative;
        overflow: hidden;
    }

    section.bg-white.py-16.text-slate-800::before {
        content: '';
        position: absolute;
        inset: 0;
        z-index: -1;
        pointer-events: none;
        background:
            radial-gradient(circle at 0% 0%, rgba(253, 237, 237, 0.9) 0%, transparent 55%),
            radial-gradient(circle at 100% 15%, rgba(237, 245, 253, 0.9) 0%, transparent 55%),
            radial-gradient(circle at 50% 100%, rgba(253, 250, 237, 0.9) 0%, transparent 60%);
    }

    /* About snippet split section */
    #about-snippet {
        position: relative;
    }

    #about-snippet::before {
        content: '';
        position: absolute;
        inset: 0;
        z-index: -1;
        pointer-events: none;
        background:
            radial-gradient(circle at 0% 20%, rgba(237, 245, 253, 0.9) 0%, transparent 55%),
            radial-gradient(circle at 100% 80%, rgba(253, 237, 237, 0.9) 0%, transparent 55%);
    }

    /* Expertise section */
    #expertise {
        position: relative;
        overflow: hidden;
    }

    #expertise::before {
        content: '';
        position: absolute;
        inset: 0;
        z-index: -1;
        pointer-events: none;
        background:
            radial-gradient(circle at 20% 0%, rgba(237, 245, 253, 0.9) 0%, transparent 55%),
            radial-gradient(circle at 80% 100%, rgba(253, 250, 237, 0.9) 0%, transparent 60%);
    }

    /* Trust panel */
    #trust-panel {
        position: relative;
        overflow: hidden;
    }

    #trust-panel::before {
        content: '';
        position: absolute;
        inset: 0;
        z-index: -1;
        pointer-events: none;
        background:
            radial-gradient(circle at 0% 100%, rgba(253, 237, 237, 0.9) 0%, transparent 55%),
            radial-gradient(circle at 100% 0%, rgba(237, 245, 253, 0.9) 0%, transparent 55%);
    }

    /* ===================== EXISTING EFFECTS (kept from your file) ===================== */

    /* HERO TEAL BACKGROUND GLOW (right side cloud) */
    .hero-spotlight {
        width: 42rem;
        height: 42rem;
        border-radius: 9999px;
        background: radial-gradient(circle at 40% 40%,
                rgba(6, 78, 94, 0.55) 0%,
                rgba(6, 78, 94, 0.38) 30%,
                rgba(6, 78, 94, 0.18) 55%,
                rgba(6, 78, 94, 0) 75%);
        filter: blur(80px);
        opacity: 0.8;
        animation: glowPulse 7s ease-in-out infinite;
        pointer-events: none;
    }

    /* OVAL SHADOW UNDER AVATAR */
    .avatar-shadow {
        width: 22rem;
        height: 10rem;
        border-radius: 9999px;
        background: radial-gradient(ellipse at 50% 30%,
                rgba(4, 78, 94, 0.28) 0%,
                rgba(4, 78, 94, 0.18) 40%,
                rgba(4, 78, 94, 0) 70%);
        filter: blur(30px);
        opacity: 0.45;
        animation: shadowPulse 5s ease-in-out infinite;
    }

    /* Animated background behind the avatar blob */
    .avatar-bg-anim {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 35rem;
        height: 35rem;
        border-radius: 9999px;
        z-index: -5;
        overflow: hidden;
    }

    .avatar-bg-anim .rot {
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at center,
                rgba(135, 206, 250, 0.5) 0%,
                rgba(100, 180, 240, 0.35) 20%,
                rgba(75, 150, 220, 0.22) 40%,
                rgba(59, 130, 246, 0.15) 60%,
                rgba(45, 110, 220, 0.08) 80%,
                rgba(30, 90, 200, 0) 100%);
        filter: blur(60px) saturate(1.15);
        opacity: 0.8;
        transform-origin: 50% 50%;
        animation: avatarPulse 6s ease-in-out infinite;
    }

    @media (min-width: 768px) {
        .avatar-bg-anim {
            width: 35rem;
            height: 35rem;
        }
    }

    @keyframes avatarPulse {

        0%,
        100% {
            opacity: 0.8;
            filter: blur(60px) saturate(1.15);
        }

        50% {
            opacity: 0.55;
            filter: blur(55px) saturate(1.25);
        }
    }

    /* pulse the teal shadow intensity */
    @keyframes shadowPulse {

        0%,
        100% {
            opacity: 0.38;
            filter: blur(30px);
            transform: translate(-50%, 0) scale(1);
        }

        50% {
            opacity: 0.55;
            filter: blur(34px);
            transform: translate(-50%, -4px) scale(1.03);
        }
    }

    /* AVATAR FLOAT (subtle up/down animation) */
    .avatar-float {
        animation: floatY 4s ease-in-out infinite;
        will-change: transform;
    }

    @keyframes floatY {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    /* AVATAR DROP SHADOW */
    .shadow-avatar {
        box-shadow:
            0 25px 40px rgba(0, 0, 0, 0.25),
            0 6px 18px rgba(0, 0, 0, 0.18);
        background-clip: padding-box;
    }

    /* HERO BACKGROUND GLOW PULSE */
    @keyframes glowPulse {

        0%,
        100% {
            transform: scale(1) translateY(0);
            opacity: 0.8;
        }

        50% {
            transform: scale(1.05) translateY(-6px);
            opacity: 0.9;
        }
    }

    /* Scroll Reveal Animations */
    .reveal {
        opacity: 0;
        transform: translateY(32px) scale(.98);
        will-change: opacity, transform;
        transition:
            opacity .6s cubic-bezier(.16, 1, .3, 1),
            transform .6s cubic-bezier(.16, 1, .3, 1);
    }

    .reveal.visible {
        opacity: 1;
        transform: translateY(0) scale(1);
    }

    .reveal.delay-0 {
        transition-delay: 0ms;
    }

    .reveal.delay-100 {
        transition-delay: 100ms;
    }

    .reveal.delay-150 {
        transition-delay: 150ms;
    }

    .reveal.delay-200 {
        transition-delay: 200ms;
    }

    .reveal.delay-300 {
        transition-delay: 300ms;
    }

    .reveal.delay-400 {
        transition-delay: 400ms;
    }

    /* Extra: slow spin + gradient animation for ISTAART card */
    @keyframes spin-slow {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    .animate-spin-slow {
        animation: spin-slow 14s linear infinite;
    }

    @keyframes gradient-move {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    .animate-gradient {
        background-size: 200% 200%;
        animation: gradient-move 14s ease-in-out infinite;
    }
</style>
@endpush



@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // IntersectionObserver for .reveal
            const els = document.querySelectorAll('.reveal');
            const obs = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        obs.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.15
            });

            els.forEach((el) => obs.observe(el));
        });
    </script>
@endpush
