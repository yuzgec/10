function initSortable(routeName) {
    console.log('initSortable called with route:', routeName);
    
    const table = document.getElementById('sortableTable');
    if (!table) {
        console.error('Table not found!');
        return;
    }

    const tbody = table.querySelector('tbody');
    if (!tbody) {
        console.error('Tbody not found!');
        return;
    }

    new Sortable(tbody, {
        handle: 'td',
        animation: 150,
        onEnd: function (evt) {
            const rows = table.querySelectorAll('tr');
            let order = Array.from(rows).map(row => row.dataset.id);
            console.log('Sorting order:', order);

            // Yükleniyor toast mesajı
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });

            fetch(routeName, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ order: order })
            })
            .then(response => response.json())
            .then(data => {
                // Başarılı toast mesajı
                Toast.fire({
                    icon: 'success',
                    title: 'Sıralama güncellendi'
                });
            })
            .catch(error => {
                // Hata toast mesajı
                Toast.fire({
                    icon: 'error',
                    title: 'Sıralama güncellenirken bir hata oluştu!'
                });
                console.error('Error:', error);
            });
        }
    });
}

function initGallerySortable(routeName, modelName, mainId) {
    const gallery = document.getElementById('sortable-gallery');
    if (!gallery) {
        console.error('Gallery container not found!');
        return;
    }

    new Sortable(gallery, {
        animation: 150,
        onEnd: function (evt) {
            const order = Array.from(gallery.children).map(row => row.dataset.id);

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });

            fetch(routeName, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ 
                    order: order,
                    model: modelName,
                    main_id: mainId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Galeri sıralaması güncellendi'
                    });
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: data.message || 'Galeri sıralaması güncellenirken bir hata oluştu!'
                    });
                }
            })
            .catch(error => {
                Toast.fire({
                    icon: 'error',
                    title: 'İstek başarısız oldu!'
                });
                console.error('Error:', error);
            });
        }
    });
} 