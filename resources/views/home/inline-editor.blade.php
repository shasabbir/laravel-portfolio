@auth
@php
    $editorSection = \App\Models\HomeContent::sections()[$section];
    $schema = \App\Models\HomeContent::fields();
@endphp
<div class="home-editor-anchor container relative z-20 mx-auto px-4 md:px-6">
<details data-inline-edit id="edit-{{ $section }}" class="section-editor" @if(old('_editor') === $section && $errors->any()) open @endif>
    <summary class="editor-trigger">Edit {{ $editorSection['label'] }}</summary>
    @if(session('home_editor') === $section)<p role="status" class="editor-notice">{{ session('status') }}</p>@endif
    <form method="POST" action="{{ route('admin.home-content.update') }}" enctype="multipart/form-data" class="editor-panel editor-section-form">
        @csrf @method('PUT')
        <input type="hidden" name="_editor" value="{{ $section }}">
        <div class="editor-heading"><div><span class="editor-eyebrow">EDITING {{ $editorSection['label'] }}</span><h3>Click the text below to edit</h3><p data-editor-status>Changes appear after saving</p></div><button type="button" class="editor-close" data-editor-close aria-label="Close editor">&times;</button></div>
        @if(old('_editor') === $section && $errors->any())<div role="alert" class="editor-notice editor-error">@foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>@endif
        <details class="editor-settings"><summary>Images, links &amp; other settings</summary><div class="editor-fields">
        @foreach($editorSection['fields'] as $key)
            @php
                $field = $schema[$key];
                $isMedia = in_array($field['type'], ['image', 'video']);
                $value = old('_editor') === $section ? old('values.'.$key, $siteContent->value($key)) : $siteContent->value($key);
                $inputId = 'input-'.$section.'-'.$key;
            @endphp
            <fieldset class="editor-form {{ $isMedia ? 'editor-media-field' : 'editor-value-field' }}" data-editor-field>
                <legend class="editor-field-title">{{ $field['label'] }}</legend>
                @if($isMedia)
                    <div class="editor-preview">
                        @if($field['type'] === 'image')<img data-upload-preview src="{{ $siteContent->value($key) }}" alt="Current {{ $field['label'] }}" @if(!$siteContent->value($key)) hidden @endif>
                        @else<video data-upload-preview src="{{ $siteContent->value($key) }}" controls preload="none" @if(!$siteContent->value($key)) hidden @endif></video>@endif
                        <span data-upload-placeholder @if($siteContent->value($key)) hidden @endif>Original</span>
                    </div>
                    <label class="editor-upload" for="upload-{{ $inputId }}"><strong>Replace {{ $field['label'] }}</strong><span>{{ $field['type'] === 'image' ? 'JPG, PNG, GIF or WebP; up to 5 MB' : 'MP4 or WebM; up to 20 MB' }}</span><input id="upload-{{ $inputId }}" type="file" name="uploads[{{ $key }}]" accept="{{ $field['type'] === 'image' ? '.jpg,.jpeg,.png,.gif,.webp' : '.mp4,.webm' }}"></label>
                @endif
                <label class="editor-input-label {{ !$isMedia ? 'sr-only' : '' }}" for="{{ $inputId }}">{{ $isMedia ? 'Or use a media URL' : $field['label'] }}</label>
                @if($field['type'] === 'text' && !str_ends_with($key, '_alt'))
                    <div class="editor-text-toolbar"><button type="button" data-bold-target="{{ $inputId }}"><strong>B</strong> Bold</button><span>Ctrl / ? + B</span></div>
                    <textarea data-rich-text id="{{ $inputId }}" name="values[{{ $key }}]" rows="{{ mb_strlen($field['default']) > 100 ? 3 : 1 }}" maxlength="10000">{{ $value }}</textarea>
                @else
                    <input id="{{ $inputId }}" name="values[{{ $key }}]" type="text" value="{{ $value }}" maxlength="10000">
                @endif
                <details class="editor-options"><summary>Options</summary><label class="editor-restore"><input type="checkbox" name="resets[{{ $key }}]" value="1" @checked(old('_editor') === $section && old('resets.'.$key))> Restore original on save</label></details>
            </fieldset>
        @endforeach
        </div>
        </details>
        <div class="editor-footer"><button class="editor-save" type="submit">Save changes</button><a href="{{ route('home') }}#edit-{{ $section }}" class="text-primary underline">Cancel</a></div>
    </form>
</details>
</div>
@endauth
