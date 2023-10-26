import './bootstrap';

import { createApp } from 'vue';




const app = createApp({});

import example from './components/example.vue';
app.component('example', example);

//--------------------------DASHBOARD-----------------------------------------
import dashboard from './components/dashboard.vue';
app.component('dashboard', dashboard);

import dashMenu from './components/dash-components/dashMenu.vue';
app.component('dash-menu', dashMenu);

import dashScreen from './components/dash-components/dashScreen.vue';
app.component('dash-screen', dashScreen);
  
app.mount("#app");