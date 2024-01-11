import './bootstrap';

//----------------------Vue-----------------------------

import { createApp } from 'vue';

import { createRouter, createWebHistory } from 'vue-router';



//-----------------Vuex----------------------------------------------------------------

import { createStore } from 'vuex'

const store = createStore({
  state() {
    return {
      item: {},
      transaction: { status: '', message: '' }
    }
  }
})

//--------------------------------------Routes----------------------------------------------------
const routes = [
  { path: '/dashboard/produtos', component: Products },
  {
    path: '/dashboard/produtos/:id',
    name: 'produtos',
    component: ProductPage,
    props: (route) => {
      const id = Number.parseInt(route.params.id);
      return {id}
    }
  },
  { path: '/dashboard/produtos/descontos', component: DescProduct },
  { path: '/dashboard/produtos/defenicoes', component: DefProduct },
  { path: '/dashboard/conteudo', component: example },
  { path: '/dashboard/conteudo/geral', component: example },
  { path: '/dashboard/conteudo/politicas', component: example },
  { path: '/dashboard/conteudo/informacao', component: example },
  { path: '/dashboard/estatisticas', component: example },
  { path: '/dashboard/estatisticas/avaliacoes', component: example },
  { path: '/dashboard/estatisticas/lucros', component: example },
  { path: '/dashboard/estatisticas/encomendas', component: example },
  { path: '/dashboard/estatisticas/logs', component: example },
  { path: '/dashboard/clientes', component: example },
  { path: '/dashboard/clientes/mensagens', component: example },
  { path: '/dashboard/clientes/pedidos', component: example },
  { path: '/dashboard/clientes/avaliacoes', component: example },
  { path: '/dashboard/defenicoes', component: example },
  { path: '/dashboard/defenicoes/cores', component: example },
  { path: '/dashboard/defenicoes/letra', component: example },

]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

//-------------------------Components-----------------------------------------
const app = createApp({});

import example from './components/example.vue';
app.component('example', example);

import Dashboard from './components/Dashboard.vue';
app.component('dashboard', Dashboard);

import Content from './components/dash-components/Content.vue';
app.component('content-component', Content);

import Products from './components/dash-components/Product/Products.vue';
app.component('products', Products);

import ProductPage from './components/dash-components/Product/ProductPage.vue';
app.component('product-page', ProductPage);

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
  formatDateTime(d) {
    if (!d) return ''

    d = d.split('T')

    let data = d[0]
    let tempo = d[1]

    //formatando a data
    data = data.split('-')
    data = data[2] + '/' + data[1] + '/' + data[0]

    //formatar o tempo 
    tempo = tempo.split('.')
    tempo = tempo[0]

    return data + ' ' + tempo
  }
};

app.use(router)
app.use(store)
app.mount('#app');

