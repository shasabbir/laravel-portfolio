@auth
<details data-inline-edit id="edit-{{ $field }}" class="section-editor about-editor my-4" @if(old('_editor') === $field && $errors->any()) open @endif>
  <summary class="editor-trigger">{{ $label }}</summary>
  <form method="POST" action="{{ route('admin.about-media.update') }}" enctype="multipart/form-data" class="editor-panel">
    <div class="editor-heading"><div><span class="editor-eyebrow">{{ $label }}</span><h3>Replace the file below</h3><p data-editor-status>Changes appear after saving</p></div><button type="button" class="editor-close" data-about-close aria-label="Close editor">&times;</button></div>
    @csrf
    @method('PUT')
    <input type="hidden" name="_editor" value="{{ $field }}" />
    @if(old('_editor') === $field && $errors->any())
      <div role="alert" class="text-sm text-red-600"><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif
    <div class="media-picker" data-media-picker>
      @if($field !== 'resume')
        @php($hasImage = array_key_exists($field, \App\Models\AboutMedia::DEFAULTS) || ($aboutMedia ?? null)?->imagePath($field))
        <div class="media-picker-preview" @if(!$hasImage) hidden @endif>
          <img data-media-preview @if($hasImage) src="{{ route('about.media', $field) }}" @endif alt="Current {{ $field }} image" loading="lazy">
          <span data-media-badge>Current image</span>
        </div>
      @endif
      <label class="media-picker-control">
        <input data-media-input type="file" name="{{ $field }}" required aria-label="{{ $field === 'resume' ? 'Choose resume PDF' : 'Choose '.$field.' image' }}" aria-describedby="upload-hint-{{ $field }}" accept="{{ $field === 'resume' ? '.pdf,application/pdf' : '.jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp' }}">
        <span class="media-picker-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 16V4m-4 4 4-4 4 4M4 15v4a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-4"/></svg></span>
        <span class="media-picker-title">{{ $field === 'resume' ? 'A fresh copy of your résumé' : 'Give your page a fresh look' }}</span>
        <span id="upload-hint-{{ $field }}" class="media-picker-hint">{{ $field === 'resume' ? 'PDF · Up to 10 MB' : 'JPG, PNG or WebP · Up to 5 MB' }}</span>
        <span class="media-picker-button">{{ $field === 'resume' ? 'Choose PDF' : 'Choose image' }} <span aria-hidden="true">↗</span></span>
      </label>
      <div class="media-picker-selection" role="status" aria-live="polite"><span class="media-picker-dot" aria-hidden="true"></span><span data-media-filename>No new file selected</span></div>
    </div>
    <div class="editor-footer">
      <button type="submit" class="editor-save">Save</button>
      <a data-about-cancel href="{{ route('about') }}#edit-{{ $field }}" class="text-sm text-primary underline">Cancel</a>
    </div>
  </form>
</details>
@endauth
