<fieldset data-entry class="space-y-4 rounded-2xl border border-border p-5">
  <legend class="px-2 font-semibold">Entry <span data-number>{{ $index + 1 }}</span></legend>
  @foreach($section === 'manuscripts' ? ['title' => 'Manuscript title', 'status' => 'Status (e.g. In review)', 'authors' => 'Authors / credit'] : ['title' => 'Group title'] as $field => $label)
    <label class="block text-sm font-semibold">{{ $label }}
      <input data-field="{{ $field }}" name="{{ $section }}[{{ $index }}][{{ $field }}]" value="{{ $entry[$field] ?? '' }}" required maxlength="500" class="mt-1 block w-full rounded border border-border bg-background p-3 font-normal" />
    </label>
  @endforeach
  @if($section !== 'manuscripts')
    <label class="block text-sm font-semibold">{{ $section === 'highlights' ? 'Highlights (one item per line)' : 'Methods and tools' }}
      <textarea data-field="description" name="{{ $section }}[{{ $index }}][description]" rows="5" required maxlength="5000" class="mt-1 block w-full rounded border border-border bg-background p-3 font-normal">{{ $entry['description'] ?? '' }}</textarea>
    </label>
  @endif
  @if($section === 'methods')
    <label class="block text-sm font-semibold">Icon
      <select data-field="icon" name="{{ $section }}[{{ $index }}][icon]" class="mt-1 block w-full rounded border border-border bg-background p-3 font-normal">
        @foreach(['flask' => 'Laboratory', 'code' => 'Computational', 'brain' => 'Brain', 'dna' => 'DNA', 'molecule' => 'Molecule'] as $value => $label)
          <option value="{{ $value }}" @selected(($entry['icon'] ?? 'flask') === $value)>{{ $label }}</option>
        @endforeach
      </select>
    </label>
  @endif
  <div class="flex flex-wrap gap-4 text-sm">
    <button type="button" data-up class="text-primary underline disabled:opacity-40">Move up</button>
    <button type="button" data-down class="text-primary underline disabled:opacity-40">Move down</button>
    <button type="button" data-remove class="text-red-600 underline">Remove</button>
  </div>
</fieldset>
