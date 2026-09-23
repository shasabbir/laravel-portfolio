@extends('layouts.app')

@section('title', 'Manage About media')

@section('content')
<div class="container mx-auto max-w-3xl px-5 py-12">
    <h1 class="font-headline text-3xl">About page media</h1>
    <p class="mt-3 text-muted-foreground">Update your portrait, research illustration and résumé. Leave a field empty to keep its current file.</p>
    <a href="{{ route('about') }}" class="mt-4 inline-block text-primary underline">View About page</a>
    <a href="{{ route('admin.about-content.edit') }}" class="mt-4 inline-block text-primary underline">Edit research &amp; education</a>

    @if(session('status'))
        <p role="status" class="mt-6 rounded-xl bg-secondary p-4">{{ session('status') }}</p>
    @endif
    @if($errors->any())
        <div role="alert" class="mt-6 rounded-xl border border-red-600 p-4 text-red-600">
            <p>Please correct the following:</p>
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.about-media.update') }}" method="POST" enctype="multipart/form-data" class="mt-8 space-y-8">
        @csrf
        @method('PUT')
        @foreach(['portrait' => 'Profile image', 'research' => 'Research illustration', 'resume' => 'Résumé PDF'] as $field => $label)
            <div class="rounded-2xl border border-border p-6">
                <label for="{{ $field }}" class="block text-lg font-semibold">{{ $label }}</label>
                @if(($media?->$field) || is_file(public_path(\App\Models\AboutMedia::DEFAULTS[$field])))
                    @if($field === 'resume')
                        <a href="{{ route('about.media', $field) }}" class="my-4 inline-block text-primary underline">Download current résumé</a>
                    @else
                        <img src="{{ route('about.media', $field) }}" alt="Current {{ strtolower($label) }}" class="my-4 h-48 max-w-full rounded-xl object-contain" />
                    @endif
                @else
                    <p class="my-4 text-muted-foreground">No file available. Upload one below.</p>
                @endif
                <input id="{{ $field }}" name="{{ $field }}" type="file" accept="{{ $field === 'resume' ? '.pdf,application/pdf' : '.jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp' }}" aria-describedby="{{ $field }}-help" class="block w-full rounded border border-border p-3" />
                <p id="{{ $field }}-help" class="mt-2 text-sm text-muted-foreground">{{ $field === 'resume' ? 'PDF, up to 10 MB.' : 'JPG, PNG or WebP, up to 5 MB.' }}</p>
            </div>
        @endforeach
        <button type="submit" class="rounded-full bg-primary px-6 py-3 font-semibold text-primary-foreground">Save changes</button>
    </form>
</div>
@endsection
