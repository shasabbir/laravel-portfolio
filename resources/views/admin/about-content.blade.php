@extends('layouts.app')
@section('title', 'Edit research & education')
@section('content')
<div class="container mx-auto max-w-3xl px-5 py-12">
  <h1 class="font-headline text-3xl">Research &amp; education</h1>
  <p class="mt-3 text-muted-foreground">Add, edit or remove entries and use Move up / Move down to set their order. Changes appear on your About page after saving.</p>
  <div class="my-4 flex gap-4"><a class="text-primary underline" href="{{ route('about') }}">View About page</a><a class="text-primary underline" href="{{ route('admin.about-media.edit') }}">Edit images &amp; résumé</a></div>
  @if(session('status'))<p role="status" class="my-4 rounded-xl bg-secondary p-4">{{ session('status') }}</p>@endif
  @if($errors->any())
    <div role="alert" class="my-4 rounded-xl border border-red-600 p-4 text-red-600"><p>Please correct the following:</p><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
  @endif
  <form method="POST" action="{{ route('admin.about-content.update') }}" id="about-content-form" class="space-y-8">
    @csrf
    @method('PUT')
    @foreach(['experiences' => 'Research & work', 'educations' => 'Academic path'] as $section => $heading)
      <section data-editor="{{ $section }}">
        <h2 class="mb-4 font-headline text-2xl">{{ $heading }}</h2>
        <div data-entries class="space-y-4">
          @foreach(session()->hasOldInput() ? old($section, []) : ($content->$section ?? []) as $entry)
            @include('admin.partials.about-entry', ['entry' => $entry, 'section' => $section, 'index' => $loop->index])
          @endforeach
        </div>
        <button type="button" data-add class="mt-4 rounded-full border border-primary px-5 py-2 font-semibold text-primary">{{ $section === 'experiences' ? 'Add experience' : 'Add education' }}</button>
        <template>@include('admin.partials.about-entry', ['entry' => [], 'section' => $section, 'index' => 0])</template>
      </section>
    @endforeach
    <label class="block font-semibold">Additional experience (optional)
      <textarea name="additional_experience" rows="4" maxlength="5000" class="mt-2 block w-full rounded border border-border bg-background p-3 font-normal">{{ old('additional_experience', $content->additional_experience) }}</textarea>
    </label>
    <button class="rounded-full bg-primary px-6 py-3 font-semibold text-primary-foreground" type="submit">Save changes</button>
  </form>
</div>
@endsection
@include('admin.partials.about-editor-script')
