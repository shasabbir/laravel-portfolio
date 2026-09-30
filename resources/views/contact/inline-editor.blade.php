@auth
@php($schema = \App\Models\ContactContent::GROUPS[$group])
<details data-inline-edit id="edit-{{ $group }}" class="section-editor about-editor my-4" @if(old('group') === $group && $errors->any()) open @endif>
  <summary class="editor-trigger">Edit {{ $schema['label'] }}</summary>
  <form method="POST" action="{{ route('admin.contact-content.update') }}" enctype="multipart/form-data" class="editor-panel">
    @csrf @method('PUT')
    <input type="hidden" name="group" value="{{ $group }}">
    <div class="editor-heading"><div><span class="editor-eyebrow">Editing {{ $schema['label'] }}</span><h3>Click the text below to edit</h3><p data-editor-status>Changes appear after saving</p></div><button type="button" class="editor-close" data-about-close aria-label="Close editor">&times;</button></div>
    @if(old('group') === $group && $errors->any())<div role="alert" class="editor-notice editor-error">@foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>@endif
    <details class="editor-settings" @if($group === 'contact-map') open @endif><summary>{{ $group === 'contact-map' ? 'Map link & settings' : 'Images & other settings' }}</summary>
      <div class="editor-fields">
        @foreach($schema['fields'] as $key)
          <label data-about-field class="editor-form">{{ $key === 'map_url' ? 'Google Maps location link' : ($key === 'map_query' ? 'Fallback address (when no link is set)' : \Illuminate\Support\Str::headline($key)) }}
            <textarea name="values[{{ $key }}]" @if($key !== 'map_url') required @endif maxlength="5000" rows="2" @if($key === 'map_url') placeholder="https://maps.app.goo.gl/…" @endif>{{ old('group') === $group ? old('values.'.$key, $contactContent->value($key)) : $contactContent->value($key) }}</textarea>
            @if($key === 'map_url')<span class="editor-input-label">Paste the link from Google Maps → Share → Copy link, or an embed URL. Save changes to update the map.</span>@endif
          </label>
        @endforeach
      </div>
      @foreach($schema['images'] as $key)
        @php($hasImage = !empty(($contactContent->images ?? [])[$key]))
        <div class="media-picker" data-media-picker>
          <div class="media-picker-preview" @if(!$hasImage) hidden @endif><img data-media-preview @if($hasImage) src="{{ route('contact.media', $key) }}" @endif alt="{{ ucfirst($key) }} image"><span data-media-badge>Current image</span></div>
          <label class="media-picker-control">
            <input data-media-input type="file" name="uploads[{{ $key }}]" accept=".jpg,.jpeg,.png,.webp" aria-label="Choose {{ $key }} image">
            <span class="media-picker-icon" aria-hidden="true">↑</span><span class="media-picker-title">{{ ucfirst($key) }} image</span><span class="media-picker-hint">JPG, PNG or WebP · Up to 5 MB</span><span class="media-picker-button">Choose image ↗</span>
          </label>
          <div class="media-picker-selection" role="status" aria-live="polite"><span class="media-picker-dot" aria-hidden="true"></span><span data-media-filename>No new file selected</span></div>
        </div>
      @endforeach
    </details>
    <div class="editor-footer"><button type="submit" class="editor-save">Save changes</button><a data-about-cancel href="{{ route('contact.show') }}#edit-{{ $group }}">Cancel</a></div>
  </form>
</details>
@endauth
