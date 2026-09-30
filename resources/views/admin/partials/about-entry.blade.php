<fieldset data-entry class="space-y-4 rounded-2xl border border-border p-5">
  <legend class="px-2 font-semibold">{{ $section === 'experiences' ? 'Experience' : 'Education' }} <span data-number>{{ $index + 1 }}</span></legend>
  @foreach(['period' => 'Dates (e.g. Sep 2026 – Present)', 'title' => $section === 'experiences' ? 'Role / position' : 'Degree / qualification', 'organization' => $section === 'experiences' ? 'Organization / location' : 'Institution / location'] as $field => $label)
    <label class="block text-sm font-semibold">{{ $label }}
      <input data-field="{{ $field }}" name="{{ $section }}[{{ $index }}][{{ $field }}]" value="{{ $entry[$field] ?? '' }}" required maxlength="{{ $field === 'period' ? 100 : 255 }}" class="mt-1 block w-full rounded border border-border bg-background p-3 font-normal" />
    </label>
  @endforeach
  <label class="block text-sm font-semibold">{{ $section === 'experiences' ? 'Responsibilities / description (optional)' : 'Details / GPA (optional)' }}
    <textarea data-field="description" name="{{ $section }}[{{ $index }}][description]" rows="4" maxlength="5000" class="mt-1 block w-full rounded border border-border bg-background p-3 font-normal">{{ $entry['description'] ?? '' }}</textarea>
  </label>
  @if($section === 'educations')
    <input type="hidden" data-field="media_id" name="{{ $section }}[{{ $index }}][media_id]" value="{{ $entry['media_id'] ?? '' }}">
    <label class="block text-sm font-semibold">Institution initials (optional)
      <input data-field="badge" name="{{ $section }}[{{ $index }}][badge]" value="{{ $entry['badge'] ?? '' }}" maxlength="10" class="mt-1 block w-full rounded border border-border bg-background p-3 font-normal" />
    </label>
    <label class="block text-sm font-semibold">Badge color
      <input data-field="color" name="{{ $section }}[{{ $index }}][color]" type="color" value="{{ $entry['color'] ?? '#123f7a' }}" class="mt-1 block h-10 w-20" />
    </label>
  @endif
  <div class="flex flex-wrap gap-4 text-sm">
    <button type="button" data-up class="text-primary underline disabled:opacity-40">Move up</button>
    <button type="button" data-down class="text-primary underline disabled:opacity-40">Move down</button>
    <button type="button" data-remove class="text-red-600 underline">Remove</button>
  </div>
</fieldset>
