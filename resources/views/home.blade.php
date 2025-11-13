@extends('layouts.app')

@section('title', 'Home')

@section('content')

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

        {{-- LARGE BACKGROUND TEAL GRADIENT ON THE RIGHT (optional, can keep or remove) --}}
        <div class="hero-spotlight pointer-events-none absolute right-[-8rem] top-[-6rem] -z-10 hidden md:block"></div>

        <div
            class="container mx-auto grid max-w-7xl grid-cols-1 items-center gap-12 px-4 text-center md:grid-cols-2 md:px-6 md:text-left relative z-10">

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
                        class="inline-flex items-center gap-2 rounded bg-primary px-5 py-3 text-base font-semibold text-primary-foreground shadow hover:opacity-90 transition">
                        View Publications
                    </a>
                    <a href="{{ route('contact.show') }}"
                        class="inline-flex items-center gap-2 rounded border border-border px-5 py-3 text-base font-semibold hover:bg-accent/10 transition">
                        Get in Touch
                    </a>
                </div>
            </div>

            {{-- RIGHT VISUAL --}}
            <div class="relative flex items-center justify-center reveal delay-200 z-10">

                {{-- FULL COLOR BACKGROUND ON RIGHT SIDE --}}
                <div class="absolute inset-0 -z-20" style="background: radial-gradient(circle at center, #60a5fa 0%, #93c5fd 20%, #dbeafe 40%, #f0f9ff 60%, #ffffff 85%, white 100%);"></div>

                {{-- WRAPPER so we can layer: pulsing shadow UNDER + avatar ABOVE --}}
                <div class="avatar-wrapper relative flex items-center justify-center">

                    {{-- BACKGROUND ANIMATION (rotating soft gradient behind the avatar) --}}
                    <div class="avatar-bg-anim pointer-events-none"></div>

                    {{-- SOFT OVAL SHADOW UNDER THE IMAGE (animated color/opacity) --}}
                    <div class="avatar-shadow pointer-events-none absolute left-1/2 top-[70%] -z-10 -translate-x-1/2"></div>

                    {{-- ACTUAL AVATAR (floating up/down) --}}
                    <div
                        class="avatar-float relative h-64 w-64 overflow-hidden rounded-full border-[4px] border-white shadow-avatar md:h-full md:w-80 bg-white/5">
                        <img src="{{ asset('images/nuhash.jpg') }}" alt="GAZI SALAH UDDIN NUHASH"
                            class="h-full w-full object-cover" />
                    </div>

                </div>
            </div>
        </div>
    </section>


    {{-- ================= 3 INFO CARDS ================= --}}
    <section class="bg-white py-16 text-slate-800">
        <div class="mx-auto max-w-7xl px-4">
            <div class="grid grid-cols-1 gap-12 text-center md:grid-cols-3">

                <!-- Card 1 -->
                <div class="group flex flex-col items-center">
                    <div
                        class="mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-rose-500 text-white shadow-lg shadow-rose-500/40 transition-all duration-300 group-hover:scale-110 group-hover:shadow-xl group-hover:shadow-rose-500/60">
                        <!-- Your PNG icon for card 1 -->
                        <img src="https://cdn-icons-png.flaticon.com/128/6116/6116418.png" alt="24/7 Support"
                            class="h-10 w-10 object-contain" />
                    </div>

                    <h3 class="text-lg font-semibold text-slate-900">
                        24/7 Support
                    </h3>

                    <p class="mt-3 max-w-xs text-sm leading-relaxed text-slate-500">
                        Lorem ipsum dolor sit amet conse adipiscing elit.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="group flex flex-col items-center">
                    <div
                        class="mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-emerald-500 text-white shadow-lg shadow-emerald-500/40 transition-all duration-300 group-hover:scale-110 group-hover:shadow-xl group-hover:shadow-emerald-500/60">
                        <!-- Your PNG icon for card 2 -->
                        <img src="https://cdn-icons-png.flaticon.com/512/10108/10108402.png" alt="Take Ownership"
                            class="h-10 w-10 object-contain" />
                    </div>

                    <h3 class="text-lg font-semibold text-slate-900">
                        Take Ownership
                    </h3>

                    <p class="mt-3 max-w-xs text-sm leading-relaxed text-slate-500">
                        Lorem ipsum dolor sit amet conse adipiscing elit.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="group flex flex-col items-center">
                    <div
                        class="mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-orange-500 text-white shadow-lg shadow-orange-500/40 transition-all duration-300 group-hover:scale-110 group-hover:shadow-xl group-hover:shadow-orange-500/60">
                        <!-- Your image for card 3 -->
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR4ii1Txal9a6PlmEGFYywolAJrtGaJgF1Zkw&s"
                            alt="Team Work" class="h-10 w-10 object-contain" />
                    </div>

                    <h3 class="text-lg font-semibold text-slate-900">
                        Team Work
                    </h3>

                    <p class="mt-3 max-w-xs text-sm leading-relaxed text-slate-500">
                        Lorem ipsum dolor sit amet conse adipiscing elit.
                    </p>
                </div>

            </div>
        </div>
    </section>


    {{-- ================= ABOUT / VIDEO SPLIT ================= --}}
    <section id="about-snippet" class="overflow-hidden ">
        <div class="grid md:grid-cols-2 ">

            {{-- LEFT TEXT CONTENT --}}
            <div class="flex items-center justify-center p-8 md:p-16 mx-0 md:mx-20">
                <div class="max-w-md text-center md:text-left reveal delay-0">
                    <h2 class="font-headline text-3xl font-bold md:text-4xl">A Passion for Discovery</h2>
                    <p class="mt-4 text-lg leading-relaxed ">
                        Academically distinguished life sciences graduate with exceptional leadership abilities,
                        adept at public speaking, teamwork, and effective communication. Looking to pursue further
                        opportunities and make a difference within my field and harness my potential.
                    </p>
                    <a href="{{ route('about') }}"
                        class="mt-8 inline-flex items-center gap-2 rounded border border-border bg-background px-5 py-3 text-base font-semibold hover:bg-accent/10 transition">
                        Learn More About Me
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"></path>
                            <path d="M12 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>

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
    <section id="expertise" class="w-full  py-16 md:py-24">
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

    {{-- ================= TRUST PANEL ================= --}}
    <section id="trust-panel" class="bg-background py-16">
        <div class="container mx-auto px-4 md:px-6 reveal delay-0">
            <h2 class="text-center font-headline text-2xl font-bold">Stay Connected &amp; Verify</h2>
            <div class="mt-8 flex flex-wrap justify-center gap-6 md:gap-8 text-muted-foreground">
                <a href="https://orcid.org/" target="_blank" rel="noopener noreferrer"
                    class="flex items-center gap-2 transition-colors hover:text-primary">
                    <span
                        class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-primary text-white text-[10px] font-bold">iD</span>
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
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
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

@endsection

@push('styles')
    <style>
        /* ============================================
                   HERO TEAL BACKGROUND GLOW (right side cloud)
                   ============================================ */
        .hero-spotlight {
            width: 42rem;
            height: 42rem;
            border-radius: 9999px;
            background: radial-gradient(circle at 40% 40%,
                    rgba(6, 78, 94, 0.55) 0%,
                    rgba(6, 78, 94, 0.38) 30%,
                    rgba(6, 78, 94, 0.18) 55%,
                    rgba(6, 78, 94, 0.00) 75%);
            filter: blur(80px);
            opacity: 0.8;
            animation: glowPulse 7s ease-in-out infinite;
            pointer-events: none;
        }

        /* ============================================
                   OVAL SHADOW UNDER AVATAR
                   - teal ellipse under the profile picture
                   - slowly breathes (opacity / blur)
                   ============================================ */
        .avatar-shadow {
            width: 22rem;
            height: 10rem;
            border-radius: 9999px;
            background: radial-gradient(ellipse at 50% 30%,
                    rgba(4, 78, 94, 0.28) 0%,
                    rgba(4, 78, 94, 0.18) 40%,
                    rgba(4, 78, 94, 0.00) 70%);
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
            /* sits behind avatar but above the hero background */
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
                width: 50rem;
                height: 50rem;
            }
        }

        @keyframes avatarRotate {
            to {
                transform: rotate(360deg);
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

        /* ============================================
                   AVATAR FLOAT (subtle up/down animation)
                   ============================================ */
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

        /* ============================================
                   AVATAR DROP SHADOW
                   clean, natural depth under the circle itself
                   ============================================ */
        .shadow-avatar {
            box-shadow:
                0 25px 40px rgba(0, 0, 0, 0.25),
                0 6px 18px rgba(0, 0, 0, 0.18);
            background-clip: padding-box;
        }

        /* ============================================
                   HERO BACKGROUND GLOW PULSE (for hero-spotlight)
                   ============================================ */
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

        /* ============================================
                   Scroll Reveal Animations
                   ============================================ */
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
