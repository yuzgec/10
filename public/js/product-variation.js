document.addEventListener('DOMContentLoaded', function() {
    console.log('Product variation script loaded');
    
    // Özellik seçim işlevleri
    const attributeSelect = document.getElementById('attribute-select');
    const generateVariantsBtn = document.getElementById('generate-variants');
    const variantsContainer = document.getElementById('variants-container');
    
    if (attributeSelect && generateVariantsBtn && variantsContainer) {
        generateVariantsBtn.addEventListener('click', function() {
            const selectedOptions = Array.from(attributeSelect.selectedOptions);
            
            if (selectedOptions.length === 0) {
                alert('Lütfen en az bir özellik seçin.');
                return;
            }
            
            const selectedAttributes = selectedOptions.map(option => {
                return {
                    id: option.value,
                    name: option.textContent.trim(),
                    values: JSON.parse(option.dataset.values || '[]')
                };
            });
            
            generateCombinations(selectedAttributes);
        });
        
        function generateCombinations(attributes) {
            // Bu kod JS tarafında varyasyon kombinasyonlarını oluşturur
            if (attributes.length === 0) {
                variantsContainer.innerHTML = '<div class="alert alert-warning">Varyasyon oluşturmak için özellik seçmelisiniz.</div>';
                return;
            }
            
            const combinations = getCombinations(attributes);
            renderCombinationTable(combinations, attributes);
        }
        
        function getCombinations(attributes) {
            // Recursive olarak tüm kombinasyonları oluşturur
            if (attributes.length === 1) {
                return attributes[0].values.map(value => ({
                    [attributes[0].id]: value.id
                }));
            }
            
            const [first, ...rest] = attributes;
            const restCombinations = getCombinations(rest);
            const result = [];
            
            first.values.forEach(value => {
                restCombinations.forEach(combination => {
                    result.push({
                        [first.id]: value.id,
                        ...combination
                    });
                });
            });
            
            return result;
        }
        
        function renderCombinationTable(combinations, attributes) {
            // HTML tablosu oluştur
            let html = `
                <div class="table-responsive mt-4">
                    <table class="table table-vcenter">
                        <thead>
                            <tr>
                                <th>Kombinasyon</th>
                                <th>SKU</th>
                                <th>Fiyat</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
            `;
            
            combinations.forEach((combination, index) => {
                html += `<tr>
                    <td>`;
                
                // Her özellik için badge ekle
                Object.entries(combination).forEach(([attrId, valueId]) => {
                    const attribute = attributes.find(a => a.id == attrId);
                    if (attribute) {
                        const value = attribute.values.find(v => v.id == valueId);
                        if (value) {
                            html += `<span class="badge bg-blue me-1">${attribute.name}: ${value.name}</span>`;
                        }
                    }
                });
                
                html += `</td>
                    <td>
                        <input type="text" class="form-control" 
                            name="variations[${index}][sku]" placeholder="SKU">
                    </td>
                    <td>
                        <input type="number" class="form-control" step="0.01" 
                            name="variations[${index}][price]" placeholder="Fiyat">
                    </td>
                    <td>
                        <input type="number" class="form-control" 
                            name="variations[${index}][stock]" placeholder="Stok">
                    </td>
                </tr>`;
                
                // Gizli alanları ekle
                Object.entries(combination).forEach(([attrId, valueId]) => {
                    html += `<input type="hidden" name="variations[${index}][attributes][${attrId}]" value="${valueId}">`;
                });
            });
            
            html += `
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Varyasyonları Kaydet</button>
                </div>
            `;
            
            variantsContainer.innerHTML = html;
        }
    }
    
    // Livewire özelliklerini sayfaya aktarmak için dinleyiciler
    document.addEventListener('livewire:load', function() {
        Livewire.on('variationsGenerated', function() {
            // Varyasyonlar oluşturulduğunda sayfayı güncelle
            const variantsSection = document.getElementById('variants-section');
            if (variantsSection) {
                variantsSection.scrollIntoView({ behavior: 'smooth' });
            }
        });
        
        Livewire.on('variationsSaved', function() {
            // Başarılı kayıt mesajı göster
            const successMessage = document.createElement('div');
            successMessage.className = 'alert alert-success';
            successMessage.textContent = 'Varyasyonlar başarıyla kaydedildi.';
            
            const messagesContainer = document.getElementById('messages-container');
            if (messagesContainer) {
                messagesContainer.appendChild(successMessage);
                
                // 5 saniye sonra mesajı kaldır
                setTimeout(function() {
                    successMessage.remove();
                }, 5000);
            }
        });
    });
    
    // Form işleme ve validasyon
    const productForm = document.getElementById('product-variable-form');
    if (productForm) {
        productForm.addEventListener('submit', function(e) {
            const selectedAttributes = document.querySelectorAll('input[name^="variations"]:checked');
            if (selectedAttributes.length === 0) {
                e.preventDefault();
                alert('Lütfen en az bir varyasyon seçin veya oluşturun.');
                return;
            }
            
            // Varyasyon verilerini kontrol et
            const variations = [];
            const variantRows = document.querySelectorAll('.variant-row');
            
            let isValid = true;
            variantRows.forEach(row => {
                const priceInput = row.querySelector('input[name$="[price]"]');
                if (priceInput && (priceInput.value === '' || isNaN(parseFloat(priceInput.value)))) {
                    isValid = false;
                    priceInput.classList.add('is-invalid');
                } else if (priceInput) {
                    priceInput.classList.remove('is-invalid');
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                alert('Lütfen tüm varyasyonlar için geçerli fiyat bilgisi girin.');
                return;
            }
        });
    }

    // Ürün tipi seçimi
    const productTypeRadios = document.querySelectorAll('input[name="type"]');
    const productTypeSelect = document.getElementById('product-type');
    const variableProductFields = document.querySelector('.variable-product-fields');
    const simpleProductFields = document.getElementById('simple-product-fields');
    
    function handleProductTypeChange(isVariable) {
        console.log('Product type changed:', isVariable ? 'Variable' : 'Simple');
        
        if (simpleProductFields) {
            simpleProductFields.style.display = isVariable ? 'none' : 'block';
        }
        
        if (variableProductFields) {
            variableProductFields.style.display = isVariable ? 'block' : 'none';
            
            // Livewire bileşenine show değerini güncelle
            if (window.Livewire) {
                console.log('Dispatching to Livewire');
                window.Livewire.dispatch('productTypeChanged', { type: isVariable ? '2' : '1' });
            }
        }
    }
    
    // Select elementi için event listener
    if (productTypeSelect) {
        console.log('Product type select found');
        productTypeSelect.addEventListener('change', function() {
            const isVariable = this.value === '2'; // 2: Variable, 1: Simple
            handleProductTypeChange(isVariable);
        });
        
        // Sayfa yüklendiğinde mevcut seçime göre göster/gizle
        const isVariable = productTypeSelect.value === '2';
        handleProductTypeChange(isVariable);
    }
    
    // Radio butonları için event listener
    if (productTypeRadios.length) {
        console.log('Product type radios found');
        productTypeRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                const isVariable = this.value === '2'; // 2: Variable, 1: Simple
                handleProductTypeChange(isVariable);
            });
        });
        
        // Sayfa yüklendiğinde mevcut seçime göre göster/gizle
        const selectedType = document.querySelector('input[name="type"]:checked');
        if (selectedType) {
            const isVariable = selectedType.value === '2';
            handleProductTypeChange(isVariable);
        }
    }
}); 