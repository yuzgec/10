class FormSubmitHandler {
    constructor() {
        this.init();
    }

    init() {
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', (e) => {
                this.handleSubmit(e, form);
            });
        });
    }

    handleSubmit(e, form) {
        const submitButton = form.querySelector('button[type="submit"]');
        if (!submitButton) return;

        // Submit butonunu devre dışı bırak
        this.disableSubmitButton(submitButton);
    }

    disableSubmitButton(button) {
        button.disabled = true;
        button.dataset.originalHtml = button.innerHTML;
        button.innerHTML = `
            <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
            Kaydediliyor...
        `;
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new FormSubmitHandler();
}); 