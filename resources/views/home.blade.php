{{-- Use the main app layout (shared header/footer/navigation) --}}
@extends('layouts.app')

{{-- Set browser tab/page title --}}
@section('title', 'Home')

{{-- Main content of the Home page --}}
@section('content')
    <div class="home-page relative">
        {{-- ^ Wrapper div for the full home page, used for scoped styles and background effects --}}

        {{-- ================= HERO ================= --}}
        <section id="hero" class="relative w-full overflow-hidden bg-background py-20 md:py-32">
            @include('home.inline-editor', ['section' => 'hero'])
            {{-- Hero section: full-width top section with video background and intro content --}}

            {{-- FULLSCREEN BACKGROUND VIDEO --}}
            <div class="hero-video-wrapper pointer-events-none absolute inset-0 -z-20">
                {{-- Background video element covering entire hero --}}
                <video class="hero-video h-full w-full object-cover"
                    src="{{ $siteContent->value('home_12') }}"
                    autoplay muted loop playsinline></video>

                {{-- OVERLAY ON TOP OF VIDEO TO MAKE TEXT READABLE --}}
                <div class="hero-video-overlay absolute inset-0"></div>
            </div>

            {{-- LARGE BACKGROUND TEAL GRADIENT ON THE RIGHT --}}
            <div class="hero-spotlight pointer-events-none absolute right-[-8rem] top-[-6rem] -z-10 hidden md:block"></div>

            {{-- Main hero content layout: 2 columns on desktop, stacked on mobile --}}
            <div
                class="container relative z-10 mx-auto grid max-w-7xl grid-cols-1 items-center gap-12 px-4 text-center md:grid-cols-2 md:px-6 md:text-left">

                {{-- LEFT CONTENT: NAME + TAGLINE + DESCRIPTION + CTA BUTTONS --}}
                <div class="z-10 reveal delay-0">
                    {{-- Main name / title --}}
                    <h1 class="font-headline uppercase text-5xl font-bold tracking-tight text-foreground md:text-6xl lg:text-6xl">{!! $siteContent->formatted('home_23') !!}</h1>

                    {{-- Sub-heading / role line with gradient text --}}
                    <p
                        class="mt-4 bg-gradient-to-r from-primary to-accent bg-clip-text text-2xl font-semibold text-transparent">{!! $siteContent->formatted('home_24') !!}</p>

                    {{-- Short description paragraph --}}
                    <p class="mx-auto mt-6 max-w-prose text-lg leading-relaxed text-muted-foreground md:mx-0">{!! $siteContent->formatted('home_25') !!}</p>

                    {{-- Hero call-to-action buttons --}}
                    <div class="mt-8 flex justify-center gap-4 md:justify-start">
                        {{-- Button linking to publications page --}}
                        <a href="{{ $siteContent->value('publications_button_url') }}"
                            class="inline-flex items-center gap-2 rounded bg-primary px-5 py-3 text-base font-semibold text-primary-foreground shadow transition hover:opacity-90">{!! $siteContent->formatted('home_26') !!}</a>

                        {{-- Button linking to contact page --}}
                        <a href="{{ $siteContent->value('contact_button_url') }}"
                            class="inline-flex items-center gap-2 rounded border border-border px-5 py-3 text-base font-semibold transition hover:bg-accent/10">{!! $siteContent->formatted('home_27') !!}</a>
                    </div>
                </div>

                {{-- RIGHT VISUAL: AVATAR + ANIMATED BACKGROUND --}}
                <div class="relative z-10 flex items-center justify-center reveal delay-200">

                    {{-- SOFT, ALMOST-WHITE ANIMATED BACKGROUND (glow behind image) --}}
                    <div
                        class="pointer-events-none absolute left-1/2 top-1/2 -z-10 flex -translate-x-1/2 -translate-y-1/2 items-center justify-center">
                        <div
                            class="relative h-72 w-72 rounded-full md:h-80 md:w-80 overflow-hidden bg-white/90 shadow-[0_24px_70px_rgba(15,23,42,0.14)]">
                            {{-- Subtle looping video inside circular background --}}
                            <video class="h-full w-full object-cover opacity-35 mix-blend-screen"
                                src="{{ $siteContent->value('home_13') }}"
                                autoplay muted loop playsinline>
                            </video>

                            {{-- Very soft radial gradient overlay so the edge looks smooth --}}
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
                        <div class="avatar-shadow pointer-events-none absolute left-1/2 top-[72%] -z-10 -translate-x-1/2">
                        </div>

                        {{-- ACTUAL AVATAR (circular image with floating animation) --}}
                        <div
                            class="avatar-float relative h-64 w-64 overflow-hidden rounded-full border-[4px] border-white bg-white/60 shadow-avatar md:h-72 md:w-72">
                            <img src="{{ $siteContent->value('home_14') }}" alt="{{ $siteContent->value('portrait_alt') }}"
                                class="h-full w-full object-cover" />
                        </div>
                    </div>
                </div>

            </div>
        </section>



        {{-- ================= 3 INFO CARDS ================= --}}
        <section class="relative overflow-hidden bg-white py-16 text-slate-800">
            @include('home.inline-editor', ['section' => 'research'])
            {{-- Section with three high-level capability cards --}}

            {{-- soft blobs in the background --}}
            <div class="pointer-events-none absolute inset-0 -z-10">
                <div class="absolute -left-24 top-0 h-64 w-64 rounded-full bg-[#FDEDED] blur-3xl opacity-70"></div>
                <div class="absolute right-[-4rem] top-16 h-72 w-72 rounded-full bg-[#EDF5FD] blur-3xl opacity-60"></div>
                <div
                    class="absolute bottom-[-3rem] left-1/2 h-64 w-64 -translate-x-1/2 rounded-full bg-[#FDFAED] blur-3xl opacity-60">
                </div>
            </div>

            <div class="mx-auto max-w-7xl px-4">
                {{-- Cards grid: stacked on mobile, 3 in a row on desktop --}}
                <div class="grid grid-cols-1 gap-12 text-center md:grid-cols-3">

                    {{-- Card 1: Neurodegeneration & Tauopathies --}}
                    <div class="group flex flex-col items-center">
                        {{-- Icon circle with hover effects --}}
                        <div
                            class="mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-sky-500 text-white shadow-lg shadow-sky-500/40 transition-all duration-300 group-hover:scale-110 group-hover:shadow-xl group-hover:shadow-sky-500/60">
                            {{-- brain icon --}}
                            @if($siteContent->value('home_1'))<img src="{{ $siteContent->value('home_1') }}" alt="" class="h-10 w-10 object-contain" />@else<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-10 w-10">
                                <path fill="currentColor"
                                    d="M9 2a3 3 0 0 0-3 3v.2A3 3 0 0 0 3 8a3 3 0 0 0 1.1 2.3A3 3 0 0 0 4 12a3 3 0 0 0 2 2.82V15a3 3 0 0 0 3 3h.5A2.5 2.5 0 0 0 12 20.5V5a3 3 0 0 0-3-3Zm6 0a3 3 0 0 1 3 3v.2A3 3 0 0 1 21 8a3 3 0 0 1-1.1 2.3A3 3 0 0 1 20 12a3 3 0 0 1-2 2.82V15a3 3 0 0 1-3 3h-.5A2.5 2.5 0 0 1 12 20.5V5a3 3 0 0 1 3-3Z" />
                            </svg>@endif
                        </div>

                        {{-- Card title --}}
                        <h3 class="text-lg font-semibold text-slate-900">{!! $siteContent->formatted('home_29') !!}</h3>

                        {{-- Card description --}}
                        <p class="mt-3 max-w-xs text-sm leading-relaxed text-slate-500">{!! $siteContent->formatted('home_30') !!}</p>
                    </div>

                    {{-- Card 2: CADD, MD & Drug Design --}}
                    <div class="group flex flex-col items-center">
                        {{-- Icon circle with hover effects --}}
                        <div
                            class="mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-emerald-500 text-white shadow-lg shadow-emerald-500/40 transition-all duration-300 group-hover:scale-110 group-hover:shadow-xl group-hover:shadow-emerald-500/60">
                            {{-- flask / chemistry icon --}}
                            @if($siteContent->value('home_2'))<img src="{{ $siteContent->value('home_2') }}" alt="" class="h-10 w-10 object-contain" />@else<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-10 w-10">
                                <path fill="currentColor"
                                    d="M10 2v7.3L5.2 17A4 4 0 0 0 8.6 23h6.8A4 4 0 0 0 18.8 17L14 9.3V2h-4Zm-1.5 0h7v2h-7v-2Z" />
                            </svg>@endif
                        </div>

                        {{-- Card title --}}
                        <h3 class="text-lg font-semibold text-slate-900">{!! $siteContent->formatted('home_32') !!}</h3>

                        {{-- Card description --}}
                        <p class="mt-3 max-w-xs text-sm leading-relaxed text-slate-500">{!! $siteContent->formatted('home_33') !!}</p>
                    </div>

                    {{-- Card 3: NGS, Data & Communication --}}
                    <div class="group flex flex-col items-center">
                        {{-- Icon circle with hover effects --}}
                        <div
                            class="mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-indigo-500 text-white shadow-lg shadow-indigo-500/40 transition-all duration-300 group-hover:scale-110 group-hover:shadow-xl group-hover:shadow-indigo-500/60">
                            {{-- DNA / data icon --}}
                            @if($siteContent->value('home_3'))<img src="{{ $siteContent->value('home_3') }}" alt="" class="h-10 w-10 object-contain" />@else<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-10 w-10">
                                <path fill="currentColor"
                                    d="M4 4c4 0 8 4 8 8s4 8 8 8M4 20c4 0 8-4 8-8s4-8 8-8M8 6h8M8 18h8M7 9h2M15 15h2" />
                            </svg>@endif
                        </div>

                        {{-- Card title --}}
                        <h3 class="text-lg font-semibold text-slate-900">{!! $siteContent->formatted('home_35') !!}</h3>

                        {{-- Card description --}}
                        <p class="mt-3 max-w-xs text-sm leading-relaxed text-slate-500">{!! $siteContent->formatted('home_36') !!}</p>
                    </div>

                </div>
            </div>
        </section>


        {{-- ================= ABOUT / VIDEO SPLIT ================= --}}
        <section id="about-snippet" class="relative overflow-hidden">
            @include('home.inline-editor', ['section' => 'about-snippet'])
            {{-- Section combining about text on left with a video on right --}}

            {{-- subtle background spot --}}
            <div class="pointer-events-none absolute inset-0 -z-10">
                <div class="absolute left-[-5rem] top-10 h-72 w-72 rounded-full bg-[#EDF5FD] blur-3xl opacity-70"></div>
                <div class="absolute bottom-[-4rem] right-[-3rem] h-72 w-72 rounded-full bg-[#FDEDED] blur-3xl opacity-60">
                </div>
            </div>

            {{-- Two-column grid layout for text + video --}}
            <div class="grid md:grid-cols-2">

                {{-- LEFT TEXT CONTENT --}}
                <div class="mx-0 flex items-center justify-center pt-8 md:mx-10 ">
                    <div class="max-w-xl text-center md:text-left reveal delay-0">
                        {{-- Section heading --}}
                        <h2 class="font-headline text-3xl font-bold md:text-4xl">{!! $siteContent->formatted('home_37') !!}</h2>

                        {{-- Short bio paragraph --}}
                        <p class="px-4 md:px-0  mt-4 text-lg leading-relaxed">{!! $siteContent->formatted('home_38') !!}</p>

                        {{-- Row: "Learn More" button + animated scientist GIF --}}
                        <div class="mt-6 flex  items-center  gap-6">
                            {{-- Button leading to full About page --}}
                            <a href="{{ $siteContent->value('about_button_url') }}"
                                class="mt-8 inline-flex items-center gap-2 rounded border border-border bg-background ml-5 md:ml-0 px-5 py-3 text-base font-semibold transition hover:bg-accent/10">
                                {!! $siteContent->formatted('about_button_text') !!}
                                {{-- Arrow icon inside button --}}
                                @if($siteContent->value('home_4'))<img src="{{ $siteContent->value('home_4') }}" alt="" class="h-5 w-5 object-contain" />@else<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14"></path>
                                    <path d="M12 5l7 7-7 7"></path>
                                </svg>@endif
                            </a>

                            {{-- SCIENTIST GIF UNDER THE TEXT --}}
                            <div class="relative inline-flex items-center justify-center">
                                {{-- soft glow behind GIF --}}
                                <div
                                    class="pointer-events-none absolute inset-0 -z-10 md:h-24 md:w-24 rounded-full bg-[radial-gradient(circle_at_30%_20%,rgba(59,130,246,0.35),transparent_60%)] blur-2xl opacity-80">
                                </div>

                                {{-- circular "chip" background containing GIF --}}
                                <div
                                    class="relative flex md:h-60 md:w-60 items-center justify-center rounded-full  bg-white/70  backdrop-blur">
                                    <img src="{{ $siteContent->value('home_15') }}" alt="{{ $siteContent->value('animation_alt') }}"
                                        class="h-40 w-40 object-contain" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- RIGHT VIDEO --}}
                <div class="relative min-h-[300px] w-full md:min-h-0">
                    <div class="h-full w-full reveal delay-200">
                        {{-- Full-height video on the right side --}}
                        <video src="{{ $siteContent->value('home_16') }}" autoplay loop muted
                            playsinline class="h-full w-full object-cover"></video>
                        {{-- Semi-transparent overlay tint --}}
                        <div class="absolute inset-0 bg-primary/20"></div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ================= EXPERTISE ================= --}}
        <section id="expertise" class="relative w-full overflow-hidden py-16 md:py-24">
            @include('home.inline-editor', ['section' => 'expertise'])
            {{-- Section describing "Areas of Expertise" --}}

            {{-- background spots --}}
            <div class="pointer-events-none absolute inset-0 -z-10">
                <div
                    class="absolute left-1/2 top-[-4rem] h-72 w-72 -translate-x-1/2 rounded-full bg-[#EDF5FD] blur-3xl opacity-70">
                </div>
                <div class="absolute bottom-[-4rem] left-0 h-72 w-72 rounded-full bg-[#FDFAED] blur-3xl opacity-60"></div>
                <div class="absolute bottom-[-4rem] right-[-2rem] h-72 w-72 rounded-full bg-[#FDEDED] blur-3xl opacity-60">
                </div>
            </div>

            <div class="container mx-auto px-4 md:px-6">
                {{-- Section heading and intro text --}}
                <div class="text-center reveal delay-0">
                    <h2 class="font-headline text-3xl font-bold md:text-4xl">{!! $siteContent->formatted('home_40') !!}</h2>
                    <p class="mx-auto mt-4 max-w-3xl text-center text-muted-foreground">{!! $siteContent->formatted('home_41') !!}</p>
                </div>

                {{-- 3 columns of expertise cards --}}
                <div class="mt-12 grid grid-cols-1 gap-8 md:grid-cols-3">

                    {{-- Expertise card 1 --}}
                    <div class="flex flex-col items-center text-center reveal delay-0">
                        {{-- Icon for Alzheimer’s / brain --}}
                        @if($siteContent->value('home_5'))<img src="{{ $siteContent->value('home_5') }}" alt="" class="h-10 w-10 text-primary object-contain" />@else<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-primary" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M9 2v6l-2 3a7 7 0 1 0 10 0l-2-3V2" />
                            <path d="M12 2v6" />
                        </svg>@endif
                        <h3 class="mt-4 font-headline text-2xl font-bold">{!! $siteContent->formatted('home_43') !!}</h3>
                        <p class="mt-2 max-w-xs text-muted-foreground">{!! $siteContent->formatted('home_44') !!}</p>
                    </div>

                    {{-- Expertise card 2 --}}
                    <div class="flex flex-col items-center text-center reveal delay-150">
                        {{-- Icon for drug design / flask --}}
                        @if($siteContent->value('home_6'))<img src="{{ $siteContent->value('home_6') }}" alt="" class="h-10 w-10 text-primary object-contain" />@else<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-primary" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M10 2v8.3L3.2 20a2 2 0 0 0 1.7 3h14.2a2 2 0 0 0 1.7-3L14 10.3V2" />
                            <path d="M8.5 2h7" />
                            <path d="M7 16h10" />
                        </svg>@endif
                        <h3 class="mt-4 font-headline text-2xl font-bold">{!! $siteContent->formatted('home_46') !!}</h3>
                        <p class="mt-2 max-w-xs text-muted-foreground">{!! $siteContent->formatted('home_47') !!}</p>
                    </div>

                    {{-- Expertise card 3 --}}
                    <div class="flex flex-col items-center text-center reveal delay-300">
                        {{-- SVG icon for NGS & Data Analysis (imported earlier) --}}
                        @if($siteContent->value('home_7'))<img src="{{ $siteContent->value('home_7') }}" alt="" class="h-10 w-10 object-contain" />@else<svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 2048 2048"
                            class="h-10 w-10"
                        >
                            <defs>
                                <style>.fil5{fill:#d32f2f;fill-rule:nonzero}</style>
                            </defs>
                            <g id="Layer_x0020_1">
                                <g id="_363999456">
                                    <path style="fill:#1e88e5" d="M569.021 1247.41h178.256v371.163H569.021z"/>
                                    <path style="fill:#1976d2" d="M825.449 1045.49h178.256v573.082H825.449z"/>
                                    <path style="fill:#1565c0" d="M1081.88 843.57h184.11v775h-184.11z"/>
                                    <path style="fill:#0d47a1" d="M1344.17 607.998h195.826v1010.57H1344.17z"/>
                                    <path style="fill:#ef5350;fill-rule:nonzero" d="M1681.98 1681.21H365.561V349.869h125.288V1555.93H1681.98z"/>
                                    <path class="fil5" d="m256.407 429.427 140.211-140.21 33.219-33.218 33.218 33.218 140.211 140.21z"/>
                                    <path class="fil5" d="m1618.17 1445.14 140.21 140.21 33.21 33.22-33.21 33.22L1618.17 1792z"/>
                                </g>
                            </g>
                        </svg>@endif

                        <h3 class="mt-4 font-headline text-2xl font-bold">{!! $siteContent->formatted('home_49') !!}</h3>
                        <p class="mt-2 max-w-xs text-muted-foreground">{!! $siteContent->formatted('home_50') !!}</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- ================= ISTAART MEMBERSHIP (NEW SECTION) ================= --}}
        <section id="membership" class="relative overflow-hidden bg-background md:py-16">
            @include('home.inline-editor', ['section' => 'membership'])
            {{-- Section highlighting ISTAART membership --}}

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
                    {{-- Gradient ring card wrapping the content --}}
                    <div
                        class="relative rounded-3xl bg-gradient-to-br from-primary/20 via-background to-accent/20 p-[1px]">
                        <div class="relative rounded-3xl bg-background/80 px-6 py-10 backdrop-blur md:px-10">
                            {{-- Floating glow behind content --}}
                            <div
                                class="pointer-events-none absolute -inset-8 -z-10 bg-gradient-to-r from-primary/30 via-accent/30 to-primary/30 opacity-40 blur-3xl">
                            </div>

                            {{-- Inside grid: text on left, ISTAART logo card on right --}}
                            <div class="grid items-center gap-10 md:grid-cols-[1.2fr_0.8fr]">
                                {{-- Left: Text copy --}}
                                <div>
                                    {{-- Small chip / label "Member Spotlight" --}}
                                    <span
                                        class="inline-flex items-center gap-2 rounded-full border border-border bg-muted px-3 py-1 text-sm font-medium">
                                        <span class="inline-block h-2 w-2 animate-ping rounded-full bg-primary"></span>
                                        <span class="inline-block h-2 w-2 rounded-full bg-primary"></span>{!! $siteContent->formatted('home_51') !!}</span>

                                    {{-- Section heading with highlighted ISTAART word --}}
                                    <h2 class="mt-4 font-headline text-3xl font-bold md:text-4xl">{!! $siteContent->formatted('membership_heading') !!}
                                    </h2>

                                    {{-- Description paragraph about ISTAART membership --}}
                                    <p class="mt-4 text-lg leading-relaxed text-muted-foreground">{!! $siteContent->formatted('membership_paragraph') !!}</p>

                                    {{-- Bullet grid of membership benefits --}}
                                    <ul class="mt-6 grid gap-3 text-sm md:grid-cols-2">
                                        @foreach(preg_split('/\R/', $siteContent->value('membership_benefits')) as $benefit)
                                            @if(trim($benefit) !== '')
                                            <li class="flex items-center gap-2"><span class="inline-block h-1.5 w-1.5 shrink-0 rounded-full bg-primary"></span><span>{!! \App\Models\HomeContent::formatText($benefit) !!}</span></li>
                                            @endif
                                        @endforeach
                                    </ul>

                                    {{-- CTA button + verification chip --}}
                                    <div class="mt-8 flex flex-wrap items-center gap-4">
                                        {{-- Button linking to ISTAART site --}}
                                        <a href="{{ $siteContent->value('home_17') }}" target="_blank" rel="noopener noreferrer"
                                            class="inline-flex items-center justify-center rounded-full bg-primary px-5 py-2.5 text-sm font-semibold text-primary-foreground shadow-lg shadow-primary/30 transition hover:-translate-y-0.5 hover:shadow-xl">{!! $siteContent->formatted('home_61') !!}</a>

                                        {{-- Small badge showing "Verified Membership" --}}
                                        <div
                                            class="flex items-center gap-2 rounded-full border border-border px-3 py-1.5 text-xs text-muted-foreground">
                                            <span class="inline-block h-2 w-2 rounded-full bg-green-500"></span>{!! $siteContent->formatted('home_62') !!}</div>
                                    </div>
                                </div>

                                {{-- Right: ISTAART logo tile --}}
                                <div class="relative mx-auto flex w-full max-w-sm items-center justify-center">
                                    {{-- Slow spinning conic gradient glow behind the card --}}
                                    <div
                                        class="absolute inset-0 -z-10 animate-spin-slow rounded-3xl bg-[conic-gradient(from_0deg,rgba(74,13,102,0.15),rgba(255,255,255,0.08),rgba(74,13,102,0.15))] blur-xl">
                                    </div>

                                    {{-- Animated radial gradient card for ISTAART logo --}}
                                    <div
                                        class="relative w-full rounded-2xl border border-white/20 bg-[radial-gradient(120%_120%_at_0%_0%,_#4A0D66_0%,_#7C1FA8_45%,_#E0A3FF_100%)] bg-[length:200%_200%] animate-gradient p-6 shadow-sm">
                                        <div class="mx-auto flex aspect-[4/3] items-center justify-center">
                                            <div class="relative h-24 w-40 md:h-28 md:w-48">
                                                {{-- ISTAART logo image --}}
                                                <img src="{{ $siteContent->value('home_18') }}"
                                                    alt="{{ $siteContent->value('membership_logo_alt') }}"
                                                    class="h-full w-full object-contain" loading="lazy"
                                                    decoding="async" />
                                            </div>
                                        </div>

                                        {{-- Three mini-stat tiles under logo --}}
                                        <div class="mt-6 grid grid-cols-3 gap-3 text-center text-xs text-white/90">
                                            <div class="rounded-lg bg-white/10 px-3 py-2 ring-1 ring-white/10">
                                                <p class="font-semibold text-white">{!! $siteContent->formatted('membership_community') !!}</p>
                                            </div>
                                            <div class="rounded-lg bg-white/10 px-3 py-2 ring-1 ring-white/10">
                                                <p class="font-semibold text-white">{!! $siteContent->formatted('membership_focus') !!}</p>
                                            </div>
                                            <div class="rounded-lg bg-white/10 px-3 py-2 ring-1 ring-white/10">
                                                <p class="font-semibold text-white">{!! $siteContent->formatted('membership_networks') !!}</p>
                                            </div>
                                        </div>

                                        {{-- Link to explore ISTAART site --}}
                                        <div class="mt-6 text-center">
                                            <a href="{{ $siteContent->value('home_19') }}" target="_blank"
                                                rel="noopener noreferrer"
                                                class="inline-flex items-center gap-1 rounded text-sm font-medium text-white underline-offset-4 hover:underline focus:outline-none focus-visible:ring-2 focus-visible:ring-white/60">
                                                {!! $siteContent->formatted('membership_explore_text') !!}
                                                @if($siteContent->value('home_8'))<img src="{{ $siteContent->value('home_8') }}" alt="" class="h-4 w-4 object-contain" />@else<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M5 12h14" />
                                                    <path d="M12 5l7 7-7 7" />
                                                </svg>@endif
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- subtle animated divider line under the card --}}
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
            @include('home.inline-editor', ['section' => 'trust-panel'])
            {{-- Section for external profile links (ORCID, Google Scholar, LinkedIn, Email) --}}

            {{-- background spots --}}
            <div class="pointer-events-none absolute inset-0 -z-10">
                <div class="absolute left-[-4rem] top-[-3rem] h-64 w-64 rounded-full bg-[#EDF5FD] blur-3xl opacity-70">
                </div>
                <div class="absolute bottom-[-4rem] right-[-4rem] h-72 w-72 rounded-full bg-[#FDEDED] blur-3xl opacity-60">
                </div>
            </div>

            <div class="container mx-auto px-4 md:px-6 reveal delay-0">
                {{-- Section heading --}}
                <h2 class="text-center font-headline text-2xl font-bold">{!! $siteContent->formatted('home_70') !!}</h2>

                {{-- External link buttons --}}
                <div class="mt-8 flex flex-wrap justify-center gap-6 text-muted-foreground md:gap-8">
                    {{-- ORCID link --}}
                    <a href="{{ $siteContent->value('header_9') }}" target="_blank" rel="noopener noreferrer"
                        class="flex items-center gap-2 transition-colors hover:text-primary">
                        @if($siteContent->value('header_1'))<img src="{{ $siteContent->value('header_1') }}" alt="" class="h-6 w-6 object-contain" />@else<span
                            class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-primary text-[10px] font-bold text-white">{!! $siteContent->formatted('home_71') !!}</span>@endif
                        <span class="font-medium">{!! $siteContent->formatted('home_72') !!}</span>
                    </a>

                    {{-- Google Scholar link --}}
                    <a href="{{ $siteContent->value('header_10') }}" target="_blank" rel="noopener noreferrer"
                        class="flex items-center gap-2 transition-colors hover:text-primary">
                        @if($siteContent->value('header_2'))<img src="{{ $siteContent->value('header_2') }}" alt="" class="h-6 w-6 object-contain" />@else<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 11l9-7 9 7-9 7-9-7z" />
                            <path d="M9 22v-7l6-4" />
                        </svg>@endif
                        <span class="font-medium">{!! $siteContent->formatted('home_74') !!}</span>
                    </a>

                    {{-- LinkedIn link --}}
                    <a href="{{ $siteContent->value('header_11') }}" target="_blank" rel="noopener noreferrer"
                        class="flex items-center gap-2 transition-colors hover:text-primary">
                        @if($siteContent->value('header_3'))<img src="{{ $siteContent->value('header_3') }}" alt="" class="h-6 w-6 object-contain" />@else<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M4.98 3.5a2.5 2.5 0 11-.02 5 2.5 2.5 0 01.02-5zM3 8.98h4v12H3zM9 8.98h3.8v1.64h.05c.53-.95 1.82-1.95 3.74-1.95 4 0 4.74 2.63 4.74 6.06v7.25h-4v-6.43c0-1.53-.03-3.5-2.13-3.5-2.13 0-2.45 1.66-2.45 3.38v6.55H9z" />
                        </svg>@endif
                        <span class="font-medium">{!! $siteContent->formatted('home_76') !!}</span>
                    </a>

                    {{-- Email/contact link to contact page --}}
                    <a href="{{ $siteContent->value('contact_button_url') }}"
                        class="flex items-center gap-2 transition-colors hover:text-primary">
                        @if($siteContent->value('home_11'))<img src="{{ $siteContent->value('home_11') }}" alt="" class="h-6 w-6 object-contain" />@else<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16v16H4z" />
                            <path d="M22 6l-10 7L2 6" />
                        </svg>@endif
                        <span class="font-medium">{!! $siteContent->formatted('home_78') !!}</span>
                    </a>
                </div>
            </div>
        </section>

    </div> {{-- /.home-page wrapper --}}
@endsection

{{-- Push page-specific styles into the "styles" stack of the layout --}}
@push('styles')
    <style>
        /* ===================== GLOBAL TYPOGRAPHY (WORD-LIKE) ===================== */

        :root {
            /* Base browser font size (16px is the real-world standard) */
            font-size: 16px;
        }

        /* BODY TEXT — same size for all sections inside .home-page */
        .home-page p,
        .home-page li {
            font-size: 0.95rem;
            /* ~15px on mobile */
            line-height: 1.7;
        }

        @media (min-width: 768px) {
            .home-page p,
            .home-page li {
                font-size: 1rem;
                /* 16px on desktop/laptop */
            }
        }

        /* Force Tailwind text utilities to use our global font sizes inside .home-page */
        .home-page .text-sm,
        .home-page .text-base,
        .home-page .text-lg,
        .home-page .text-xl,
        .home-page .text-2xl {
            font-size: inherit;
            line-height: inherit;
        }

        /* HEADINGS — same responsive scale across sections */

        .home-page h1,
        .home-page h1.font-headline {
            font-weight: 700;
            line-height: 1.1;
            /* ~32px on mobile → up to ~48px on large screens */
            font-size: clamp(2rem, 1.5rem + 2vw, 3rem);
        }

        .home-page h2,
        .home-page h2.font-headline {
            font-weight: 700;
            line-height: 1.2;
            /* ~26px → ~34px */
            font-size: clamp(1.6rem, 1.2rem + 1.3vw, 2.1rem);
        }

        .home-page h3,
        .home-page h3.font-headline {
            font-weight: 600;
            line-height: 1.3;
            /* ~20px → ~24px */
            font-size: clamp(1.2rem, 1rem + 0.8vw, 1.5rem);
        }

        /* ===================== HERO & BACKGROUND EFFECTS ===================== */

        /* Ensure hero is positioned properly for overlays */
        #hero {
            position: relative;
        }

        /* Overlay over background video: multi radial gradient for soft pastel look */
        .hero-video-overlay {
            background:
                radial-gradient(circle at 20% 20%, rgba(237, 245, 253, 0.8) 0%, transparent 55%),
                radial-gradient(circle at 80% 80%, rgba(253, 237, 237, 0.8) 0%, transparent 55%),
                radial-gradient(circle at 50% 110%, rgba(253, 250, 237, 0.85) 0%, transparent 65%);
            mix-blend-mode: soft-light;
        }

        /* 3 Info Cards section background (white bg with soft spots) */
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

        /* About snippet split section background */
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

        /* Expertise section background */
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

        /* Trust panel background */
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

        /* Animated background behind the avatar blob (if used) */
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

        /* Soft pulsing effect for avatar glow */
        @keyframes avatarPulse {
            0%, 100% {
                opacity: 0.8;
                filter: blur(60px) saturate(1.15);
            }

            50% {
                opacity: 0.55;
                filter: blur(55px) saturate(1.25);
            }
        }

        /* Pulse the teal shadow intensity under avatar */
        @keyframes shadowPulse {
            0%, 100% {
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
            0%, 100% {
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
            0%, 100% {
                transform: scale(1) translateY(0);
                opacity: 0.8;
            }

            50% {
                transform: scale(1.05) translateY(-6px);
                opacity: 0.9;
            }
        }

        /* Scroll Reveal Animations base state */
        .reveal {
            opacity: 0;
            transform: translateY(32px) scale(.98);
            will-change: opacity, transform;
            transition:
                opacity .6s cubic-bezier(.16, 1, .3, 1),
                transform .6s cubic-bezier(.16, 1, .3, 1);
        }

        /* When visible, fully show element */
        .reveal.visible {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        /* Delay classes for staggered reveal */
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

{{-- Push page-specific scripts into the "scripts" stack --}}
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const openEditor = () => {
                const editor = document.getElementById(location.hash.slice(1));
                if (editor?.matches('details[data-inline-edit]')) editor.open = true;
            };
            openEditor();
            window.addEventListener('hashchange', openEditor);
            // IntersectionObserver to reveal elements with .reveal class when they enter the viewport
            const els = document.querySelectorAll('.reveal');

            const obs = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    // If element is visible in viewport
                    if (entry.isIntersecting) {
                        // Add .visible class to trigger CSS transition
                        entry.target.classList.add('visible');
                        // Stop observing once revealed (animation only once)
                        obs.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.15 // Reveal when 15% of the element is visible
            });

            // Start observing all .reveal elements
            els.forEach((el) => obs.observe(el));
        });
    </script>
@endpush
