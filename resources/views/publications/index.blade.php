@extends('layouts.app')

@section('title', 'Publications')

@section('content')
    <div class="container mx-auto px-4 py-10 md:px-6">

        {{-- COVER / HERO SECTION --}}
        <section class="mb-10 overflow-hidden rounded-2xl border border-border/60 bg-card shadow-sm backdrop-blur-sm">
            <div class="relative h-52 w-full md:h-64 lg:h-72">
                <img
                    src="https://images.pexels.com/photos/373543/pexels-photo-373543.jpeg?auto=compress&cs=tinysrgb&w=1600"
                    alt="Scientific research and publications"
                    class="h-full w-full object-cover"
                    loading="lazy"
                    decoding="async"
                />

                <div class="absolute inset-0 bg-gradient-to-r from-background/90 via-background/70 to-background/30"></div>

                <div class="absolute inset-0 flex items-center">
                    <div class="px-6 py-6 md:px-10">
                        <p class="text-xs font-semibold uppercase tracking-[0.3em] text-muted-foreground">
                            Research Output
                        </p>
                        <h1 class="font-headline mt-2 text-3xl font-bold text-foreground md:text-4xl">
                            Publications
                        </h1>
                        <p class="mt-2 max-w-2xl text-sm text-muted-foreground md:text-base">
                            Peer-reviewed articles, preprints, and conference contributions authored or co-authored by
                            Nuhash Gazi, spanning life sciences, neurodegeneration, and data-driven discovery.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- HEADER BAR (title + button) --}}
        <div class="mb-6 flex items-center justify-between">
            <h2 class="font-headline text-2xl font-semibold md:text-3xl">
                All Publications
            </h2>

            <a href="{{ route('publications.create') }}"
               class="inline-flex items-center gap-2 rounded-full bg-primary px-4 py-2 text-sm font-semibold text-primary-foreground shadow-lg shadow-primary/20 transition hover:-translate-y-0.5 hover:shadow-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 5v14" />
                    <path d="M5 12h14" />
                </svg>
                New Publication
            </a>
        </div>

        {{-- FILTER BUTTONS --}}
        <div class="mb-6 flex flex-wrap gap-2">
            <button
                class="filter-btn active rounded-full border-2 border-primary bg-primary px-4 py-2 text-sm font-semibold text-primary-foreground transition hover:opacity-90"
                data-filter="all">
                All
            </button>
            <button
                class="filter-btn rounded-full border-2 border-border px-4 py-2 text-sm font-semibold text-foreground transition hover:bg-accent/60"
                data-filter="journal">
                Journal
            </button>
            <button
                class="filter-btn rounded-full border-2 border-border px-4 py-2 text-sm font-semibold text-foreground transition hover:bg-accent/60"
                data-filter="preprint">
                Preprint
            </button>
            <button
                class="filter-btn rounded-full border-2 border-border px-4 py-2 text-sm font-semibold text-foreground transition hover:bg-accent/60"
                data-filter="conference">
                Conference
            </button>
        </div>

        {{-- PUBLICATIONS LIST (5 per page thanks to controller paginate(5)) --}}
        <div class="grid grid-cols-1 gap-6">
            @forelse($publications as $pub)
                @php
                    $type = strtolower($pub->publication_type ?? '');

                    // Chip color
                    $pillColorClass = match ($type) {
                        'journal' => 'bg-blue-100 text-blue-900',
                        'preprint' => 'bg-purple-100 text-purple-900',
                        'conference' => 'bg-green-100 text-green-900',
                        default => 'bg-secondary text-secondary-foreground',
                    };

                    // Rotate these three light custom colors
                    $bgColors = [
                        'bg-[#FDEDED]', // soft pink
                        'bg-[#EDF5FD]', // soft blue
                        'bg-[#FDFAED]', // soft cream
                    ];
                    $cardBgClass = $bgColors[$loop->index % count($bgColors)];
                @endphp

                <div
                    class="publication-card {{ $cardBgClass }} rounded-xl border border-border/60 p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-primary/60 hover:shadow-md"
                    data-type="{{ $type }}">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                        <div class="min-w-0 flex-1">
                            <div class="mb-1 flex flex-wrap items-center gap-2">
                                <span
                                    class="inline-flex items-center rounded-full px-3 py-1 text-xs font-bold {{ $pillColorClass }}">
                                    {{ ucfirst($pub->publication_type ?? 'Other') }}
                                </span>

                                @if ($pub->doi)
                                    <a href="https://doi.org/{{ $pub->doi }}" target="_blank"
                                       class="text-xs font-medium text-primary hover:underline">
                                        DOI: {{ $pub->doi }}
                                    </a>
                                @endif
                            </div>

                            <h3 class="font-headline text-xl font-bold leading-snug text-foreground md:text-2xl">
                                {{ $pub->title }}
                            </h3>

                            <p class="mt-2 text-sm font-medium text-muted-foreground md:text-base">
                                {{ $pub->authors }}
                                @if ($pub->venue)
                                    • {{ $pub->venue }}
                                @endif
                                @if ($pub->year)
                                    • {{ $pub->year }}
                                @endif
                            </p>

                            @if ($pub->abstract)
                                <p class="mt-3 text-sm text-foreground/90">
                                    {{ \Illuminate\Support\Str::limit($pub->abstract, 220) }}
                                </p>
                            @endif
                        </div>

                        <div class="flex shrink-0 flex-wrap items-center gap-2 self-start">
                            @if ($pub->url)
                                <a href="{{ $pub->url }}" target="_blank"
                                   class="rounded-full border border-border px-3 py-1 text-xs font-medium hover:bg-accent/60">
                                    Link
                                </a>
                            @endif

                            @if ($pub->pdf)
                                <a href="{{ $pub->pdf }}" target="_blank"
                                   class="rounded-full border border-border px-3 py-1 text-xs font-medium hover:bg-accent/60">
                                    PDF
                                </a>
                            @endif

                            <a href="{{ route('publications.edit', $pub) }}"
                               class="rounded-full border border-border px-3 py-1 text-xs font-medium hover:bg-accent/60">
                                Edit
                            </a>

                            <form method="POST" action="{{ route('publications.destroy', $pub) }}"
                                  onsubmit="return confirm('Delete this publication?');">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="rounded-full border border-destructive px-3 py-1 text-xs font-semibold text-destructive hover:bg-destructive/10">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted-foreground">No publications yet.</p>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        @if ($publications->hasPages())
            <div class="mt-10 flex justify-center">
                {{ $publications->links() }}
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const filterBtns = document.querySelectorAll('.filter-btn');
            const publicationCards = document.querySelectorAll('.publication-card');

            filterBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const filterValue = btn.dataset.filter;

                    filterBtns.forEach(b => {
                        b.classList.remove(
                            'active',
                            'border-primary',
                            'bg-primary',
                            'text-primary-foreground'
                        );
                        b.classList.add('border-border', 'text-foreground');
                    });

                    btn.classList.add('active', 'border-primary', 'bg-primary', 'text-primary-foreground');
                    btn.classList.remove('border-border', 'text-foreground');

                    publicationCards.forEach(card => {
                        if (filterValue === 'all' || card.dataset.type === filterValue) {
                            card.style.display = 'block';
                            card.classList.remove('animate-fadeIn');
                            setTimeout(() => card.classList.add('animate-fadeIn'), 10);
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>
@endpush

@push('styles')
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.3s ease-in-out;
        }
    </style>
@endpush
