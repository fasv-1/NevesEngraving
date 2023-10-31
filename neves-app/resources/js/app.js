import './bootstrap';

import { createApp } from 'vue';




const app = createApp({});

import example from './components/example.vue';
app.component('example', example);

//--------------------------DASHBOARD-----------------------------------------
import dashboard from './components/dashboard.vue';
app.component('dashboard', dashboard);

import addProduct from './components/dash-components/addProduct.vue';
app.component('add-product', addProduct);
  
app.mount("#app");