class MediaHandler {
    constructor() {
        this.defaltImage = '/backend/resimyok.jpg';
        this.init();
    }

    init() {
        document.querySelectorAll('.image-preview-container').forEach(container => {
            const input = container.querySelector('.image-preview-input');
            const preview = container.querySelector('.preview-image');
            const deleteBtn = container.querySelector('.delete-media-btn');
            const uploadArea = container.querySelector('.upload-button');

            // Input'u gizle
            if (input) {
                input.style.display = 'none';
                
                // Drag & Drop olayları
                container.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    container.classList.add('dragover');
                });

                container.addEventListener('dragleave', () => {
                    container.classList.remove('dragover');
                });

                container.addEventListener('drop', (e) => {
                    e.preventDefault();
                    container.classList.remove('dragover');
                    const file = e.dataTransfer.files[0];
                    this.handleFileSelect(file, preview, deleteBtn, uploadArea);
                });

                // Input change event'i
                input.onchange = (e) => {
                    const file = e.target.files[0];
                    this.handleFileSelect(file, preview, deleteBtn, uploadArea);
                };
            }

            // Tıklama olayları
            if (preview) {
                preview.onclick = () => input?.click();
            }

            if (uploadArea) {
                uploadArea.onclick = () => input?.click();
            }

            // Silme butonu
            if (deleteBtn) {
                deleteBtn.onclick = async (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    if (await this.handleMediaDelete(e)) {
                        preview.src = this.defaultImage;
                        input.value = '';
                        deleteBtn.style.display = 'none';
                        uploadArea.style.display = 'block';
                    }
                };
            }

            // Eğer resim varsa upload alanını gizle
            if (preview && preview.src && preview.src !== this.defaultImage) {
                uploadArea.style.display = 'none';
            }
        });
    }

    handleFileSelect(file, preview, deleteBtn, uploadArea) {
        const existingInfo = preview.parentNode.querySelector('.image-size-info');
        if (existingInfo) {
            existingInfo.remove();
        }

        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                preview.src = e.target.result;
                const img = new Image();
                img.src = e.target.result;
                img.onload = () => {
                    const sizeInfo = document.createElement('p');
                    sizeInfo.className = 'image-size-info';
                    sizeInfo.textContent = `Boyut: ${Math.round(file.size / 1024)} KB, Piksel: ${img.naturalWidth} x ${img.naturalHeight}`;
                    preview.parentNode.appendChild(sizeInfo);
                };

                if (deleteBtn) deleteBtn.style.display = 'flex';
                if (uploadArea) uploadArea.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
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

    if (deleteBtn) {
        deleteBtn.style.display = 'flex'; // Butonun görünür olmasını sağla
        deleteBtn.onclick = async (e) => {
            e.preventDefault();
            e.stopPropagation();
            
            if (await this.handleMediaDelete(e)) {
                preview.src = this.defaultImage;
                input.value = '';
                deleteBtn.style.display = 'none';
                uploadArea.style.display = 'block';
            }
        };
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new MediaHandler();
}); 