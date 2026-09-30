document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.about-editor').forEach(editor => {
        const form = editor.querySelector('form');
        const status = editor.querySelector('[data-editor-status]');
        const bindings = [...document.querySelectorAll('[data-about-input]')].map(target => ({
            target, input: form.elements.namedItem(target.dataset.aboutInput), original: target.innerHTML,
        })).filter(({ input }) => input);
        const dirty = () => { status.textContent = 'Unsaved changes'; status.classList.add('editor-dirty'); };
        const sync = () => bindings.forEach(({ target, input, original }) => {
            if (editor.open && form.contains(input)) {
                target.setAttribute('contenteditable', 'plaintext-only');
                target.setAttribute('role', 'textbox');
                target.setAttribute('aria-label', input.closest('label')?.textContent.trim() || 'Edit text');
                target.textContent = input.value;
            } else {
                ['contenteditable', 'role', 'aria-label'].forEach(attribute => target.removeAttribute(attribute));
                target.innerHTML = original;
            }
        });
        bindings.forEach(({ target, input }) => {
            input.closest('[data-about-field]')?.classList.add('editor-inline-source');
            target.addEventListener('input', () => {
                if (!editor.open || !form.contains(input)) return;
                input.value = target.innerText;
                dirty();
            });
            target.addEventListener('click', event => { if (editor.open) event.preventDefault(); });
            input.addEventListener('input', () => {
                if (editor.open && document.activeElement !== target) target.textContent = input.value;
            });
        });
        form.addEventListener('input', dirty);
        form.querySelectorAll('[data-media-picker]').forEach(picker => {
            const input = picker.querySelector('[data-media-input]');
            const preview = picker.querySelector('[data-media-preview]');
            const original = preview?.getAttribute('src');
            let previewUrl;
            input.addEventListener('change', () => {
                if (previewUrl) URL.revokeObjectURL(previewUrl);
                previewUrl = null;
                const file = input.files[0];
                picker.classList.toggle('has-selection', Boolean(file));
                picker.querySelector('[data-media-filename]').textContent = file
                    ? `${file.name} · ${(file.size / 1024 / 1024).toFixed(2)} MB`
                    : 'No new file selected';
                if (preview) {
                    previewUrl = file && file.type.startsWith('image/') ? URL.createObjectURL(file) : null;
                    if (previewUrl || original) preview.src = previewUrl || original;
                    else preview.removeAttribute('src');
                    preview.parentElement.hidden = !previewUrl && !original;
                    preview.alt = previewUrl ? 'Selected image preview' : 'Current image';
                    picker.querySelector('[data-media-badge]').textContent = previewUrl ? 'New preview' : 'Current image';
                }
                dirty();
            });
            window.addEventListener('pagehide', () => { if (previewUrl) URL.revokeObjectURL(previewUrl); });
        });
        form.addEventListener('invalid', event => {
            event.target.closest('[data-about-field]')?.classList.remove('editor-inline-source');
            const settings = event.target.closest('.editor-settings');
            if (settings) settings.open = true;
        }, true);
        editor.addEventListener('toggle', () => {
            if (editor.open) document.querySelectorAll('.about-editor[open]').forEach(other => { if (other !== editor) other.open = false; });
            sync();
        });
        editor.querySelector('[data-about-close]').addEventListener('click', () => {
            editor.open = false;
            editor.querySelector('summary').focus();
        });
        editor.querySelector('[data-about-cancel]').addEventListener('click', event => {
            event.preventDefault();
            location.replace(event.currentTarget.href);
            location.reload();
        });
        sync();
    });
});
