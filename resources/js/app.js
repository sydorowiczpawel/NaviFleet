import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

if (!crypto.randomUUID) {
    crypto.randomUUID = () => Math.random().toString(36).substring(2, 10);
}

Alpine.start();