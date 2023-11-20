import './bootstrap';

import { createApp } from 'vue';




const app = createApp({});

import example from './components/example.vue';
app.component('example', example);

//--------------------------DASHBOARD-----------------------------------------
import Dashboard from './components/Dashboard.vue';
app.component('dashboard', Dashboard);

import Content from './components/dash-components/Content.vue';
app.component('content-component', Content);

import AddProduct from './components/dash-components/Product/AddProduct.vue';
app.component('add-product', AddProduct);

import DefProduct from './components/dash-components/Product/DefProduct.vue';
app.component('defenitions-product', DefProduct);

import InputContainer from './components/dash-components/InputContainer.vue';
app.component('input-container', InputContainer);

import Modal from './components/dash-components/Modal.vue';
app.component('modal-component', Modal);

import Alert from './components/Alert.vue';
app.component('alert-component', Alert);
  
app.mount("#app");