document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.section-editor').forEach(editor => {
        editor.querySelectorAll('[data-rich-text]').forEach(input => {
            const preview = input.form.querySelector('[data-text-preview]');
            const render = () => {
                const fragment = document.createDocumentFragment();
                input.value.split(/(\*\*[\s\S]+?\*\*)/g).forEach(part => {
                    if (part.startsWith('**') && part.endsWith('**') && part.length > 4) {
                        const bold = document.createElement('strong');
                        bold.textContent = part.slice(2, -2);
                        fragment.append(bold);
                    } else fragment.append(document.createTextNode(part));
                });
                preview.replaceChildren(fragment);
            };
            const bold = () => {
                const start = input.selectionStart;
                const end = input.selectionEnd;
                const selected = input.value.slice(start, end);
                if (start >= 2 && input.value.slice(start - 2, start) === '**' && input.value.slice(end, end + 2) === '**') {
                    input.setRangeText(selected, start - 2, end + 2, 'select');
                } else if (selected.startsWith('**') && selected.endsWith('**') && selected.length > 4) {
                    input.setRangeText(selected.slice(2, -2), start, end, 'select');
                } else {
                    input.setRangeText('**' + selected + '**', start, end, 'select');
                    input.setSelectionRange(start + 2, end + 2);
                }
                input.focus();
                render();
            };
            input.form.querySelector('[data-bold-target]').addEventListener('click', bold);
            input.addEventListener('input', render);
            input.addEventListener('keydown', event => {
                if ((event.ctrlKey || event.metaKey) && event.key.toLowerCase() === 'b') {
                    event.preventDefault();
                    bold();
                }
            });
            render();
        });
        editor.querySelectorAll('[data-editor-close]').forEach(button => button.addEventListener('click', () => {
            editor.open = false;
            editor.querySelector('summary').focus();
        }));
        editor.querySelectorAll('[data-editor-filter]').forEach(button => button.addEventListener('click', () => {
            editor.querySelectorAll('[data-editor-filter]').forEach(filter => filter.setAttribute('aria-pressed', String(filter === button)));
            editor.querySelectorAll('[data-editor-category]').forEach(field => {
                field.hidden = field.dataset.editorCategory !== button.dataset.editorFilter;
            });
        }));
        editor.querySelectorAll('input[type=file]').forEach(input => {
            let previewUrl;
            const preview = input.form.querySelector('[data-upload-preview]');
            const original = preview.getAttribute('src');
            input.addEventListener('change', () => {
                if (previewUrl) URL.revokeObjectURL(previewUrl);
                previewUrl = input.files[0] ? URL.createObjectURL(input.files[0]) : null;
                preview.src = previewUrl || original;
                preview.hidden = !previewUrl && !original;
                input.form.querySelector('[data-upload-placeholder]').hidden = !preview.hidden;
            });
        });
    });
});
