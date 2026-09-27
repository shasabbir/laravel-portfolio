@auth
  <details data-inline-edit id="edit-{{ $group }}" class="section-editor about-editor my-4" @if(old('text_group') === $group && $errors->any()) open @endif>
    <summary class="editor-trigger">Edit {{ \App\Models\AboutContent::TEXT_GROUPS[$group]['label'] }}</summary>
    <form method="POST" action="{{ route('admin.about-content.update') }}" class="editor-panel">
      <div class="editor-heading"><div><span class="editor-eyebrow">Edit {{ \App\Models\AboutContent::TEXT_GROUPS[$group]['label'] }}</span><h3>Click the text below to edit</h3><p data-editor-status>Changes appear after saving</p></div><button type="button" class="editor-close" data-about-close aria-label="Close editor">&times;</button></div>
      @csrf
      @method('PUT')
      <input type="hidden" name="section" value="page_text">
      <input type="hidden" name="text_group" value="{{ $group }}">
      @if(old('text_group') === $group && $errors->any())
        <div role="alert" class="text-red-600"><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
      @endif
      <details class="editor-settings"><summary>Other settings</summary><div class="space-y-4 editor-fields">
        @foreach(\App\Models\AboutContent::TEXT_GROUPS[$group]['fields'] as $key)
          @php($default = \App\Models\AboutContent::PAGE_TEXT[$key])
          <label data-about-field class="block text-sm font-semibold">{{ \Illuminate\Support\Str::headline($key) }}
            <textarea name="page_text[{{ $key }}]" rows="{{ mb_strlen($default) > 100 ? 4 : 2 }}" required maxlength="5000" class="mt-2 block w-full rounded border border-border bg-background p-3 font-normal">{{ old('text_group') === $group ? old('page_text.'.$key, $content->pageText($key)) : $content->pageText($key) }}</textarea>
          </label>
        @endforeach
      </div>
      </details>
      <div class="editor-footer">
        <button type="submit" class="editor-save">Save changes</button>
        <a data-about-cancel href="{{ route('about') }}#edit-{{ $group }}" class="text-sm text-primary underline">Cancel</a>
      </div>
    </form>
  </details>
@endauth
