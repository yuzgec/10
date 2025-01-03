class FormSubmitHandler {
    constructor() {
        this.init();
        this.translations = {
            loading: document.documentElement.getAttribute('data-loading-text') || 'Yükleniyor...',
            please_wait: document.documentElement.getAttribute('data-wait-text') || 'Lütfen bekleyin...',
            processing: document.documentElement.getAttribute('data-processing-text') || 'İşleniyor...',
            saving: document.documentElement.getAttribute('data-saving-text') || 'Kaydediliyor...',
            deleting: document.documentElement.getAttribute('data-deleting-text') || 'Siliniyor...',
            updating: document.documentElement.getAttribute('data-updating-text') || 'Güncelleniyor...',
            search: document.documentElement.getAttribute('data-search-text') || 'Aranıyor...'
        };
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

        // Form action'ına göre uygun mesajı seç
        const action = form.getAttribute('data-action') || 'default';
        const loadingText = this.getLoadingText(action);

        this.disableSubmitButton(submitButton, loadingText);
    }

    getLoadingText(action) {
        switch(action) {
            case 'save':
                return this.translations.saving;
            case 'delete':
                return this.translations.deleting;
            case 'update':
                return this.translations.updating;
            case 'process':
                return this.translations.processing;
            case 'search':
                return this.translations.search;
            default:
                return this.translations.saving;
        }
    }

    disableSubmitButton(button, loadingText) {
        button.disabled = true;
        button.dataset.originalHtml = button.innerHTML;
        button.innerHTML = `
            <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
            ${loadingText}
        `;
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new FormSubmitHandler();
}); 