import './bootstrap';

import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';

window.Livewire = Livewire;
window.Alpine = Alpine;

Livewire.start();
console.log('Livewire Ready!');
console.log('Alpine Ready!');

