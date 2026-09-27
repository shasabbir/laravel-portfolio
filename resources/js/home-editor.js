document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.section-editor').forEach(editor => {
        const section = editor.closest('section, footer');
        const targets = section ? [...section.querySelectorAll('[data-home-text]')] : [];
        const bindings = targets.map(target => ({
            target,
            input: editor.querySelector('[name="values[' + target.dataset.homeText + ']"]'),
            original: target.innerHTML,
        })).filter(binding => binding.input);
        bindings.forEach(({ target, input }) => {
            input.closest('[data-editor-field]').classList.add('editor-inline-source');
            target.addEventListener('input', () => {
                input.value = target.innerText;
                input.dispatchEvent(new Event('input', { bubbles: true }));
            });
            target.addEventListener('click', event => {
                if (editor.open) event.preventDefault();
            });
            input.addEventListener('input', () => {
                if (editor.open && document.activeElement !== target) target.textContent = input.value;
            });
        });
        const syncInline = () => bindings.forEach(({ target, input, original }) => {
            if (editor.open) {
                target.setAttribute('contenteditable', 'plaintext-only');
                target.setAttribute('role', 'textbox');
                target.setAttribute('aria-label', input.closest('fieldset').querySelector('legend').textContent);
                target.textContent = input.value;
            } else {
                target.removeAttribute('contenteditable');
                target.removeAttribute('role');
                target.removeAttribute('aria-label');
                target.innerHTML = original;
            }
        });
        syncInline();
        if (section?.id === 'membership') {
            const list = section.querySelector('[data-membership-benefits]');
            const input = editor.querySelector('[name="values[membership_benefits]"]');
            const original = list.innerHTML;
            input.closest('[data-editor-field]').classList.add('editor-inline-source');
            const saveBenefits = () => {
                input.value = [...list.querySelectorAll('[data-benefit-text]')].map(item => item.innerText.replace(/\n/g, ' ')).join('\n');
                input.dispatchEvent(new Event('input', { bubbles: true }));
            };
            const addBenefit = (text = '') => {
                const item = document.createElement('li');
                item.className = 'membership-benefit-edit';
                const content = document.createElement('span');
                content.dataset.benefitText = '';
                content.contentEditable = 'plaintext-only';
                content.setAttribute('role', 'textbox');
                content.setAttribute('aria-label', 'Membership highlight');
                content.textContent = text;
                content.addEventListener('input', saveBenefits);
                content.addEventListener('keydown', event => {
                    if (event.key === 'Enter') event.preventDefault();
                });
                item.append(content);
                for (const [label, symbol, action] of [
                    ['Move highlight up', '↑', () => { if (item.previousElementSibling) list.insertBefore(item, item.previousElementSibling); }],
                    ['Move highlight down', '↓', () => { if (item.nextElementSibling) list.insertBefore(item.nextElementSibling, item); }],
                    ['Remove highlight', '×', () => item.remove()],
                ]) {
                    const button = document.createElement('button');
                    button.type = 'button';
                    button.textContent = symbol;
                    button.setAttribute('aria-label', label);
                    button.addEventListener('click', () => { action(); saveBenefits(); });
                    item.append(button);
                }
                list.append(item);
                return content;
            };
            const syncBenefits = () => {
                list.innerHTML = editor.open ? '' : original;
                if (editor.open) input.value.split(/\r?\n/).filter(text => text.trim()).forEach(addBenefit);
            };
            syncBenefits();
            editor.addEventListener('toggle', syncBenefits);
            section.querySelector('[data-add-benefit]').addEventListener('click', () => addBenefit().focus());
            section.querySelectorAll('[data-membership-setting]').forEach(button => {
                button.addEventListener('click', () => {
                    editor.querySelector('.editor-settings').open = true;
                    const field = editor.querySelector('[name="values[' + button.dataset.membershipSetting + ']"]').closest('fieldset');
                    field.scrollIntoView({ block: 'center', behavior: 'smooth' });
                    (field.querySelector('input[type=file]') || field.querySelector('input[type=text]')).focus({ preventScroll: true });
                });
            });
            bindings.forEach(({ target, input }) => {
                target.dataset.editLabel = input.closest('fieldset').querySelector('legend').textContent;
            });
        }
        editor.addEventListener('toggle', () => {
            syncInline();
            if (editor.open) {
                document.querySelectorAll('.section-editor[open]').forEach(other => {
                    if (other !== editor) other.open = false;
                });
            }
        });
        editor.addEventListener('input', () => {
            const status = editor.querySelector('[data-editor-status]');
            status.textContent = 'Unsaved changes';
            status.classList.add('editor-dirty');
        });
        editor.querySelectorAll('[data-rich-text]').forEach(input => {
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
                input.dispatchEvent(new Event('input', { bubbles: true }));
            };
            input.closest('[data-editor-field]').querySelector('[data-bold-target]').addEventListener('click', bold);
            input.addEventListener('keydown', event => {
                if ((event.ctrlKey || event.metaKey) && event.key.toLowerCase() === 'b') {
                    event.preventDefault();
                    bold();
                }
            });
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
            const preview = input.closest('[data-editor-field]').querySelector('[data-upload-preview]');
            const original = preview.getAttribute('src');
            input.addEventListener('change', () => {
                if (previewUrl) URL.revokeObjectURL(previewUrl);
                previewUrl = input.files[0] ? URL.createObjectURL(input.files[0]) : null;
                preview.src = previewUrl || original;
                preview.hidden = !previewUrl && !original;
                input.closest('[data-editor-field]').querySelector('[data-upload-placeholder]').hidden = !preview.hidden;
            });
        });
    });
});

