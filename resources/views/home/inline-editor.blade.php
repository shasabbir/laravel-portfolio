@auth
@php
    $editorSection = \App\Models\HomeContent::sections()[$section];
    $schema = \App\Models\HomeContent::fields();
    $categories = ['text' => 'Content', 'media' => 'Images & video', 'url' => 'Links'];
    $activeCategory = old('_editor') === $section ? ($schema[old('field')]['type'] ?? 'text') : 'text';
    if (in_array($activeCategory, ['image', 'video'])) $activeCategory = 'media';
@endphp
<div class="home-editor-anchor container relative z-20 mx-auto px-4 md:px-6">
<details data-inline-edit id="edit-{{ $section }}" class="section-editor" @if(old('_editor') === $section && $errors->any()) open @endif>
    <summary class="editor-trigger"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path d="m16 3 5 5L8 21H3v-5L16 3Z"/><path d="m14 5 5 5"/></svg><span>Edit section</span><span class="editor-trigger-label">{{ $editorSection['label'] }}</span><span aria-hidden="true">⌄</span></summary>
    <div class="editor-panel">
        <div class="editor-heading"><div><span class="editor-eyebrow">SECTION SETTINGS</span><h3>{{ $editorSection['label'] }}</h3><p>Make it yours. Changes appear as soon as you save.</p></div><button type="button" class="editor-close" aria-label="Close section editor" data-editor-close>×</button></div>
        @if(session('home_editor') === $section)<div role="status" class="editor-notice">✓ {{ session('status') }}</div>@endif
        @if(old('_editor') === $section && $errors->any())<div role="alert" class="editor-notice editor-error">@foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>@endif
        <div class="editor-filters" role="group" aria-label="Field categories">
        @foreach($categories as $category => $label)
            @php
                $count = collect($editorSection['fields'])->filter(fn ($key) => ($category === 'media' ? in_array($schema[$key]['type'], ['image', 'video']) : $schema[$key]['type'] === $category))->count();
            @endphp
            @if($count)<button type="button" data-editor-filter="{{ $category }}" aria-pressed="{{ $activeCategory === $category ? 'true' : 'false' }}">{{ $label }}<span>{{ $count }}</span></button>@endif
        @endforeach
        </div>
        <div class="editor-fields">
        @foreach($editorSection['fields'] as $key)
            @php
                $field = $schema[$key];
                $category = in_array($field['type'], ['image', 'video']) ? 'media' : $field['type'];
                $value = old('_editor') === $section && old('field') === $key ? old('value') : $siteContent->value($key);
                $inputId = 'input-'.$section.'-'.$key;
                $isParagraph = $category === 'text' && mb_strlen($field['default']) > 100;
            @endphp
            <details class="editor-field {{ $isParagraph ? 'editor-paragraph-field' : '' }}" data-editor-category="{{ $category }}" @if($category !== $activeCategory) hidden @endif @if($isParagraph || (old('_editor') === $section && old('field') === $key)) open @endif>
                <summary>
                    @if($field['type'] === 'image' && $siteContent->value($key))<img class="editor-thumbnail" src="{{ $siteContent->value($key) }}" alt="" loading="lazy">@else<span class="editor-symbol" aria-hidden="true">{{ ['text' => 'Aa', 'url' => '↗', 'image' => '▧', 'video' => '▷'][$field['type']] }}</span>@endif
                    <span class="editor-description"><strong>{{ $field['label'] }}</strong><span>{{ $category === 'media' ? ($value ? 'Replace or update media' : 'Using the original design') : ($value ?: 'Add '.$field['type']) }}</span></span><span class="editor-edit-label">Edit ↗</span>
                </summary>
                <form method="POST" action="{{ route('admin.home-content.update') }}" enctype="multipart/form-data" class="editor-form">
                    @csrf @method('PUT')
                    <input type="hidden" name="_editor" value="{{ $section }}"><input type="hidden" name="field" value="{{ $key }}">
                    @if($category === 'media')
                        <div class="editor-preview">
                            @if($field['type'] === 'image')<img data-upload-preview src="{{ $siteContent->value($key) }}" alt="Current image" @if(!$siteContent->value($key)) hidden @endif>
                            @else<video data-upload-preview src="{{ $siteContent->value($key) }}" controls preload="none" @if(!$siteContent->value($key)) hidden @endif></video>@endif
                            <span data-upload-placeholder @if($siteContent->value($key)) hidden @endif>Choose your {{ $field['type'] === 'image' ? 'image or logo' : 'video' }}</span>
                        </div>
                        <label class="editor-upload" for="upload-{{ $inputId }}"><strong>Choose a new {{ $field['type'] }}</strong><span>{{ $field['type'] === 'image' ? 'JPG, PNG, GIF or WebP · Up to 5 MB' : 'MP4 or WebM · Up to 20 MB' }}</span><input id="upload-{{ $inputId }}" type="file" name="upload" accept="{{ $field['type'] === 'image' ? '.jpg,.jpeg,.png,.gif,.webp' : '.mp4,.webm' }}"></label>
                    @endif
                    <label class="editor-input-label" for="{{ $inputId }}">{{ $category === 'media' ? 'Or use a media URL' : ($category === 'url' ? 'Destination URL' : 'Content') }}</label>
                    @if($category === 'text' && !str_ends_with($key, '_alt'))
                        <div class="editor-text-toolbar"><button type="button" data-bold-target="{{ $inputId }}" aria-label="Make selected text bold"><strong>B</strong> Bold</button><span>Select text, then click Bold</span></div>
                        <textarea data-rich-text id="{{ $inputId }}" name="value" rows="{{ $isParagraph ? 7 : 2 }}" maxlength="10000" aria-label="{{ $field['label'] }}">{{ $value }}</textarea>
                        <div class="editor-text-preview"><span>PREVIEW</span><div data-text-preview>{!! \App\Models\HomeContent::formatText($value ?? '') !!}</div></div>
                    @else<input id="{{ $inputId }}" name="value" type="text" value="{{ $value }}" maxlength="10000" @if($category !== 'text') spellcheck="false" @endif>@endif
                    <div class="editor-actions"><button class="editor-reset" name="reset" value="1" type="submit">Restore original</button><button class="editor-save" type="submit">Save changes ↗</button></div>
                </form>
            </details>
        @endforeach
        </div>
        <div class="editor-footer"><span>Only visible while signed in</span><button type="button" data-editor-close>Done editing</button></div>
    </div>
</details>
</div>
@endauth
