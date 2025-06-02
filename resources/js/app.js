import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Handle vacation request updates
document.addEventListener('livewire:initialized', () => {
    Livewire.on('vacationRequestUpdated', () => {
        // Refresh the page to show updated status
        window.location.reload();
    });
});

// Debug event handling
document.addEventListener('livewire:initialized', () => {
    Livewire.on('showVacationModal', (data) => {
        console.log('Show vacation modal event received:', data);
    });
});
