import './bootstrap';

//----------------------Vue-----------------------------

import { createApp } from 'vue';



//-----------------Vuex----------------------------------------------------------------

import { createStore } from 'vuex'

const store = createStore({
  state() {
    return {
      item: {},
      transaction:{ status:'', message:'' }
    }
  }
})

//-------------------------Components-----------------------------------------
const app = createApp({});

import example from './components/example.vue';
app.component('example', example);

import Dashboard from './components/Dashboard.vue';
app.component('dashboard', Dashboard);

import Content from './components/dash-components/Content.vue';
app.component('content-component', Content);

import AddProduct from './components/dash-components/Product/AddProduct.vue';
app.component('add-product', AddProduct);

import DescProduct from './components/dash-components/Product/DescProduct.vue';
app.component('desconto-product', DescProduct);

import DefProduct from './components/dash-components/Product/DefProduct.vue';
app.component('defenitions-product', DefProduct);

import InputContainer from './components/dash-components/InputContainer.vue';
app.component('input-container', InputContainer);

import Modal from './components/dash-components/Modal.vue';
app.component('modal-component', Modal);

import Alert from './components/Alert.vue';
app.component('alert-component', Alert);

import Table from './components/dash-components/Table.vue';
app.component('table-component', Table);
  

//---------------------------------------Filters------------------------------------------------------------
app.config.globalProperties.$filters = {
  formatDateTime(d){
    if(!d) return ''

  d = d.split('T')

  let data = d[0]
  let tempo = d[1]

  //formatando a data
  data = data.split('-')
  data = data [2] + '/' + data[1] + '/' + data[0]

  //formatar o tempo 
  tempo = tempo.split('.')
  tempo = tempo[0]

  return data + ' ' + tempo
  }
};


app.use(store)
app.mount('#app');

