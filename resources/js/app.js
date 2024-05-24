import './bootstrap';

import { createApp } from 'vue';
import BriefsComponent from './components/home.vue';

const app = createApp({});
app.component('briefs-component', BriefsComponent);
app.mount('#app');
