@auth
<details data-inline-edit id="edit-{{ $section }}" class="my-4 rounded-xl border border-border bg-background p-4 text-foreground" @if(old('section') === $section && $errors->any()) open @endif>
  <summary class="cursor-pointer text-sm font-semibold text-primary">Edit {{ $section === 'experiences' ? 'research & work' : 'academic path' }}</summary>
  <form method="POST" action="{{ route('admin.about-content.update') }}" class="mt-4 space-y-4">
    <h3 class="text-lg font-semibold">{{ $section === 'experiences' ? 'Edit research & work' : 'Edit academic path' }}</h3>
    @csrf
    @method('PUT')
    <input type="hidden" name="section" value="{{ $section }}" />
    @if(old('section') === $section && $errors->any())
      <div role="alert" class="text-red-600"><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif
    <div data-editor="{{ $section }}">
      <div data-entries class="space-y-4">
        @foreach(old('section') === $section ? old($section, []) : ($content->$section ?? []) as $entry)
          @include('admin.partials.about-entry', ['entry' => $entry, 'section' => $section, 'index' => $loop->index])
        @endforeach
      </div>
      <button type="button" data-add class="my-4 rounded-full border border-primary px-5 py-2 text-primary">{{ $section === 'experiences' ? 'Add experience' : 'Add education' }}</button>
      <template>@include('admin.partials.about-entry', ['entry' => [], 'section' => $section, 'index' => 0])</template>
    </div>
    @if($section === 'experiences')
      <label class="block text-sm font-semibold">Additional experience (optional)
        <textarea name="additional_experience" rows="4" maxlength="5000" class="mt-2 block w-full rounded border border-border bg-background p-3 font-normal">{{ old('section') === $section ? old('additional_experience') : $content->additional_experience }}</textarea>
      </label>
    @endif
    <div class="flex items-center gap-4">
      <button type="submit" class="rounded-full bg-primary px-5 py-2 text-sm font-semibold text-primary-foreground">Save changes</button>
      <a href="{{ route('about') }}#edit-{{ $section }}" class="text-sm text-primary underline">Cancel</a>
    </div>
  </form>
</details>
@endauth
