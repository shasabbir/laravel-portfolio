@auth
<details data-inline-edit id="edit-{{ $section }}" class="section-editor about-editor my-4" @if(old('section') === $section && $errors->any()) open @endif>
  <summary class="editor-trigger">Edit {{ \App\Models\AboutContent::SECTIONS[$section] }}</summary>
  <form method="POST" action="{{ route('admin.about-content.update') }}" class="editor-panel">
    <div class="editor-heading"><div><span class="editor-eyebrow">Edit {{ \App\Models\AboutContent::SECTIONS[$section] }}</span><h3>Click the text below to edit</h3><p data-editor-status>Changes appear after saving</p></div><button type="button" class="editor-close" data-about-close aria-label="Close editor">&times;</button></div>
    @csrf
    @method('PUT')
    <input type="hidden" name="section" value="{{ $section }}" />
    @if(old('section') === $section && $errors->any())
      <div role="alert" class="text-red-600"><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif
    <details class="editor-settings"><summary>Add, reorder &amp; other settings</summary><div class="p-4">
    <div data-editor="{{ $section }}">
      <div data-entries class="space-y-4">
        @foreach(old('section') === $section ? old($section, []) : ($content->$section ?? []) as $entry)
          @include(in_array($section, ['experiences', 'educations']) ? 'admin.partials.about-entry' : 'admin.partials.about-extra-entry', ['entry' => $entry, 'section' => $section, 'index' => $loop->index])
        @endforeach
      </div>
      <button type="button" data-add class="my-4 rounded-full border border-primary px-5 py-2 text-primary">Add {{ ['experiences' => 'experience', 'educations' => 'education', 'methods' => 'method group', 'manuscripts' => 'manuscript', 'highlights' => 'highlight group'][$section] }}</button>
      <template>@include(in_array($section, ['experiences', 'educations']) ? 'admin.partials.about-entry' : 'admin.partials.about-extra-entry', ['entry' => [], 'section' => $section, 'index' => 0])</template>
    </div>
    @if($section === 'experiences')
      <label class="block text-sm font-semibold">Additional experience (optional)
        <textarea name="additional_experience" rows="4" maxlength="5000" class="mt-2 block w-full rounded border border-border bg-background p-3 font-normal">{{ old('section') === $section ? old('additional_experience') : $content->additional_experience }}</textarea>
      </label>
    @endif
    </div></details>
    <div class="editor-footer">
      <button type="submit" class="editor-save">Save changes</button>
      <a data-about-cancel href="{{ route('about') }}#edit-{{ $section }}" class="text-sm text-primary underline">Cancel</a>
    </div>
  </form>
</details>
@endauth
