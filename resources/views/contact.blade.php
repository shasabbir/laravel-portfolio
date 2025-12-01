@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<section class="relative" id="contact">
    {{-- soft radial highlight for style --}}
    <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_20%_20%,rgba(59,130,246,.15),transparent_60%)]"></div>

    <div class="relative mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-24">
        {{-- content card --}}
        <div class="mx-auto w-full max-w-6xl rounded-2xl border border-gray-200 bg-white p-6 shadow-xl backdrop-blur-sm md:p-10 lg:p-12 animate-[fadeIn_0.5s_ease-out]">
            <div class="grid gap-10 md:grid-cols-2 md:gap-12">
                <!-- LEFT SIDE INFO -->
                <div class="h-full">
                    <p class="text-base leading-relaxed text-black mb-10">
                        Whether you have a question, a proposal, or just want to say hi —
                        drop a message. Let me know what you're building or researching.
                    </p>

                    <ul class="space-y-8">
                        {{-- LOCATION --}}
                        <li class="flex">
                            <div class="flex h-12 w-12 flex-none items-center justify-center rounded-lg bg-blue-900 text-gray-50">
                                {{-- location pin icon --}}
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                    <path
                                        d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4 py-3">
                                <p class="mt-1 text-sm font-semibold text-black">
                                    Center for Biotechnology &amp; Genomics
                                </p>
                                <p class="text-sm text-black">
                                    Texas Tech University, Canton &amp; Main Experimental Sciences Building,<br>
                                    Lubbock, TX 79409
                                </p>
                            </div>
                        </li>

                        {{-- EMAIL ONLY (no phone) --}}
                        <li class="flex">
                            <div class="flex h-12 w-12 flex-none items-center justify-center rounded-lg bg-blue-900 text-gray-50">
                                {{-- email / envelope icon (replaces phone icon) --}}
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="5" width="18" height="14" rx="2" ry="2"></rect>
                                    <path d="M3 7l9 6l9-6"></path>
                                </svg>
                            </div>
                            <div class="ml-4 py-3">
                                <p class="mt-1 text-sm text-black">
                                    Email: gazi.nuhash@ttu.edu
                                </p>
                            </div>
                        </li>

                        {{-- AVAILABILITY / HOURS (unchanged) --}}
                        <li class="flex">
                            <div class="flex h-12 w-12 flex-none items-center justify-center rounded-lg bg-blue-900 text-gray-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                    <path d="M12 7v5l3 3"></path>
                                </svg>
                            </div>
                            <div class="ml-4 py-3">
                                <p class="mt-1 text-sm text-black">
                                    Mon – Fri: 09:00 – 17:00
                                </p>
                                <p class="text-sm text-black">
                                    Weekends: Flexible for urgent requests
                                </p>
                            </div>
                        </li>
                    </ul>

                    {{-- MAP UPDATED TO TTU --}}
                    <div class="mt-10">
                        <div class="overflow-hidden rounded-xl border border-gray-200 shadow-sm">
                            <iframe
                                class="w-full h-64 sm:h-72 md:h-64 lg:h-72"
                                style="border:0;"
                                loading="lazy"
                                allowfullscreen
                                referrerpolicy="no-referrer-when-downgrade"
                                src="https://www.google.com/maps?q=Center+for+Biotechnology+and+Genomics+Texas+Tech+University+Lubbock+TX+79409&output=embed">
                            </iframe>
                        </div>
                        <p class="mt-3 text-xs text-black">
                            Center for Biotechnology &amp; Genomics, Texas Tech University
                        </p>
                    </div>
                </div>

                <!-- RIGHT SIDE FORM (unchanged) -->
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-lg md:p-8 lg:p-10">
                    <h2 class="mb-6 text-2xl font-bold text-black">
                        Send a Message
                    </h2>

                    {{-- success flash message --}}
                    @if(session('status'))
                        <div class="mb-6 rounded-md border border-green-300 bg-green-50 px-4 py-3 text-sm font-medium text-green-700">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contact.submit') }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <!-- Name -->
                            <div class="flex flex-col">
                                <label for="name"
                                       class="mb-3 text-xs font-semibold uppercase tracking-wider text-black">
                                    Name
                                </label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    autocomplete="given-name"
                                    placeholder="Your name"
                                    value="{{ old('name') }}"
                                    class="w-full rounded-lg border border-gray-300 bg-white py-3 px-3 text-sm text-black shadow-sm outline-none ring-0 transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500"
                                />
                                @error('name')
                                    <p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="flex flex-col">
                                <label for="email"
                                       class="mb-3 text-xs font-semibold uppercase tracking-wider text-black">
                                    Email
                                </label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    autocomplete="email"
                                    placeholder="your@email.com"
                                    value="{{ old('email') }}"
                                    class="w-full rounded-lg border border-gray-300 bg-white py-3 px-3 text-sm text-black shadow-sm outline-none ring-0 transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500"
                                />
                                @error('email')
                                    <p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Message -->
                        <div class="flex flex-col">
                            <label for="message"
                                   class="mb-3 text-xs font-semibold uppercase tracking-wider text-black">
                                Message
                            </label>
                            <textarea
                                id="message"
                                name="message"
                                rows="6"
                                placeholder="Write your message..."
                                class="w-full rounded-lg border border-gray-300 bg-white py-3 px-3 text-sm text-black shadow-sm outline-none ring-0 transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500"
                            >{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit -->
                        <div class="pt-2 text-center">
                            <button
                                type="submit"
                                class="group relative inline-flex w-full items-center justify-center overflow-hidden rounded-lg bg-blue-600 px-6 py-3 text-base font-semibold text-white shadow-md ring-0 transition hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-white"
                            >
                                <span class="relative z-10">Send Message</span>
                                <span
                                    class="absolute inset-0 -z-0 opacity-0 blur-xl transition-opacity duration-300 group-hover:opacity-40 bg-blue-400">
                                </span>
                            </button>
                        </div>

                        <p class="text-center text-[11px] leading-relaxed text-black">
                            By submitting, you agree to be contacted back regarding your inquiry.
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- tiny keyframes for fade-in --}}
    <style>
        @keyframes fadeIn {
            0%   { opacity: 0; translate: 0 12px; }
            100% { opacity: 1; translate: 0 0; }
        }
    </style>
</section>
@endsection
