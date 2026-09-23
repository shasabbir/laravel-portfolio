@push('scripts')
<script>
document.querySelectorAll('[data-editor]').forEach(editor => {
  const entries = editor.querySelector('[data-entries]');
  const add = editor.querySelector('[data-add]');
  const renumber = () => {
    [...entries.children].forEach((row, index) => {
      row.querySelector('[data-number]').textContent = index + 1;
      row.querySelectorAll('[data-field]').forEach(input => {
        input.name = `${editor.dataset.editor}[${index}][${input.dataset.field}]`;
      });
      row.querySelector('[data-up]').disabled = index === 0;
      row.querySelector('[data-down]').disabled = index === entries.children.length - 1;
    });
    add.disabled = entries.children.length >= 50;
  };
  add.addEventListener('click', () => {
    entries.append(editor.querySelector('template').content.cloneNode(true));
    renumber();
    entries.lastElementChild.querySelector('input').focus();
  });
  entries.addEventListener('click', event => {
    const button = event.target.closest('button');
    if (!button) return;
    const row = button.closest('[data-entry]');
    if (button.hasAttribute('data-remove')) {
      if (!confirm('Remove this entry? Save changes to apply the removal.')) return;
      row.remove();
    }
    if (button.hasAttribute('data-up') && row.previousElementSibling) entries.insertBefore(row, row.previousElementSibling);
    if (button.hasAttribute('data-down') && row.nextElementSibling) entries.insertBefore(row.nextElementSibling, row);
    renumber();
  });
  renumber();
});
</script>
@endpush
