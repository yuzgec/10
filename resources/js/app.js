import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('livewire:initialized', () => {
    Livewire.on('swal:success', (data) => {
        Swal.fire({
            icon: data.type,
            title: data.message,
            text: data.text,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    });
});
