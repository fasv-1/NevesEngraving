import './bootstrap';

import { createApp } from 'vue';




const app = createApp({});

import example from './components/example.vue';
app.component('example', example);

import dashboard from './components/dashboard.vue';
app.component('dashboard', dashboard);
  
app.mount("#app");