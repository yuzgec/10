class MediaHandler {
    constructor() {
        this.defaultImage = '/backend/resimyok.jpg';
        this.init();
    }

    init() {
        // Debug için log ekleyelim
        console.log('MediaHandler initialized');
        
        document.querySelectorAll('.image-preview-container').forEach(container => {
            // Elementleri bul ve log'la
            const input = container.querySelector('.image-preview-input');
            const preview = container.querySelector('.preview-image');
            const deleteBtn = container.querySelector('.delete-media-btn');
            const uploadArea = container.querySelector('.upload-button');

            console.log('Container elements:', {
                input: input?.id,
                preview: preview?.id,
                hasDeleteBtn: !!deleteBtn,
                hasUploadArea: !!uploadArea
            });

            // Input'u gizle
            if (input) {
                input.style.display = 'none';
                
                // Input change event'i
                input.onchange = (e) => {
                    console.log('Input change event triggered', input.id);
                    const file = e.target.files[0];
                    if (file) {
                        console.log('File selected:', file.name);
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            if (preview) {
                                preview.src = e.target.result;
                                console.log('Preview updated for:', preview.id);
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
                    console.log('Preview clicked:', preview.id);
                    input?.click();
                };
            }

            if (uploadArea) {
                uploadArea.onclick = (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('Upload area clicked for input:', input?.id);
                    input?.click();
                };
            }

            // Silme butonu
            if (deleteBtn) {
                deleteBtn.onclick = async (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('Delete button clicked');
                    
                    if (await this.handleMediaDelete(e)) {
                        if (preview) {
                            preview.src = this.defaultImage;
                            console.log('Preview reset to default');
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
                console.error('Medya silme hatası:', error);
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