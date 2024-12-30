class MediaHandler {
    constructor() {
        this.defaultImage = '/backend/resimyok.jpg';
        this.init();
    }

    init() {
    
        
        document.querySelectorAll('.image-preview-container').forEach(container => {
            // Elementleri bul ve log'la
            const input = container.querySelector('.image-preview-input');
            const preview = container.querySelector('.preview-image');
            const deleteBtn = container.querySelector('.delete-media-btn');
            const uploadArea = container.querySelector('.upload-button');

    

            // Input'u gizle
            if (input) {
                input.style.display = 'none';
                
                // Input change event'i
                input.onchange = (e) => {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            if (preview) {
                                preview.src = e.target.result;
                                if (deleteBtn) deleteBtn.style.display = 'flex';
                            }
                        };
                        reader.readAsDataURL(file);
                    }
                };
            }

            // Tıklama olayları
            if (preview) {
                preview.onclick = (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    input?.click();
                };
            }

            if (uploadArea) {
                uploadArea.onclick = (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    input?.click();
                };
            }

            // Silme butonu
            if (deleteBtn) {
                deleteBtn.onclick = async (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    if (await this.handleMediaDelete(e)) {
                        if (preview) {
                            preview.src = this.defaultImage;
                        }
                        if (input) input.value = '';
                        deleteBtn.style.display = 'none';
                    }
                };
            }
        });
    }

    async handleMediaDelete(e) {
        const button = e.currentTarget;
        const modelId = button.dataset.modelId;
        const modelType = button.dataset.modelType;
        const collection = button.dataset.collection;

        if (confirm('Bu medyayı silmek istediğinize emin misiniz?')) {
            try {
                const response = await fetch(`/go/media/delete`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ 
                        model_id: modelId,
                        model_type: modelType,
                        collection: collection 
                    })
                });

                const result = await response.json();

                if (result.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Başarılı!',
                        text: result.message,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    return true;
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Hata!',
                    text: 'Medya silinirken bir hata oluştu',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        }
        return false;
    }
}

// Sayfa yüklendiğinde başlat
document.addEventListener('DOMContentLoaded', () => {
    new MediaHandler();
}); 