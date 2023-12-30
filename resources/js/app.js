import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


// resources/js/app.js

import Livewire from 'livewire';

document.addEventListener('livewire:load', () => {
    Livewire.hook('element.updated', (el, component) => {
        window.addEventListener('scroll', () => {
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
                Livewire.emit('loadMorePosts');
            }
        });
    });
});

Livewire.on('loadMorePosts', () => {
    Livewire.visit(route('load-more-posts'));
});
