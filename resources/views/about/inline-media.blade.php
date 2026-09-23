@auth
<details data-inline-edit id="edit-{{ $field }}" class="my-4 rounded-xl border border-border bg-background p-4 text-foreground" @if(old('_editor') === $field && $errors->any()) open @endif>
  <summary class="cursor-pointer text-sm font-semibold text-primary">{{ $label }}</summary>
  <form method="POST" action="{{ route('admin.about-media.update') }}" enctype="multipart/form-data" class="mt-4 space-y-3">
    <h3 class="text-lg font-semibold">{{ $label }}</h3>
    @csrf
    @method('PUT')
    <input type="hidden" name="_editor" value="{{ $field }}" />
    @if(old('_editor') === $field && $errors->any())
      <div role="alert" class="text-sm text-red-600"><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif
    <label class="block text-sm">{{ $field === 'resume' ? 'Choose PDF (up to 10 MB)' : 'Choose JPG, PNG or WebP (up to 5 MB)' }}
      <input type="file" name="{{ $field }}" required accept="{{ $field === 'resume' ? '.pdf,application/pdf' : '.jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp' }}" class="mt-2 block w-full min-w-0 text-sm" />
    </label>
    <div class="flex items-center gap-4">
      <button type="submit" class="rounded-full bg-primary px-5 py-2 text-sm font-semibold text-primary-foreground">Save</button>
      <a href="{{ route('about') }}#edit-{{ $field }}" class="text-sm text-primary underline">Cancel</a>
    </div>
  </form>
</details>
@endauth
