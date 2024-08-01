import './bootstrap';
import { createApp } from 'vue';
import Router from './router.js';
import App from './components/App.vue';

const app = createApp({});
app.use(Router);
app.mount('#app-vue');

