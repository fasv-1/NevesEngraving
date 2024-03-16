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

      transaction: { status: '', message: '' },

      Url: 'http://127.0.0.1:8000/',
      
      user: document.querySelector("meta[name='user-id']"),
    }
  }
})

// axios.defaults.headers.common['Authorization'] = `Bearer ${store.getters.token}`;

//--------------------------------------Routes----------------------------------------------------
const routes = [
  //------------------------------------Site-routes----------------------------------------------
  {
    path: '/home',
    component: Home,
    name: 'Home',
    meta: {
      breadcrumb: 'home'
    }
  },
  {
    path: '/profile',
    component: Profile,
    name: 'Profile',
    meta: {
      breadcrumb: 'profile'
    },
    props:true
  },
  {
    path: '/login',
    component: login,
    name: 'Login',
    meta: {
      breadcrumb: 'login'
    },
  },
  {
    path: '/home/amazing_gifts',
    component: AmazingGifts,
    name: 'AmazingGifts',
    meta: {
      breadcrumb: 'amazing_gifts'
    }
  },
  {
    path: '/home/amazing_gifts/:id',
    component: ProductsShownd,
    name: 'Product',
    meta: {
      breadcrumb: ':id'
    },
    props: (route) => {
      const id = atob(route.params.id);
      return { id }
    }
  },
  {
    path: '/home/engraving',
    component: Engraving,
    name: 'Engraving',
    meta: {
      breadcrumb: 'engraving'
    }
  },
  {
    path: '/home/lazer_cut',
    component: LazerCut,
    name: 'LazerCut',
    meta: {
      breadcrumb: 'lazer_cut'
    }
  },
  {
    path: '/home/business_cards',
    component: BusinessCards,
    name: 'BusinessCards',
    meta: {
      breadcrumb: 'business_cards'
    }
  },
  {
    path: '/home/help',
    component: Help,
    name: 'Help',
    meta: {
      breadcrumb: 'help'
    }
  },
  {
    path: '/home/contacts',
    component: Contacts,
    name: 'Contacts',
    meta: {
      breadcrumb: 'contacts'
    }
  },
  {
    path: '/home/shopping_cart',
    component: ShoppingCart,
    name: 'ShoppingCart',
    meta: {
      breadcrumb: 'shopping_cart'
    }
  },


  //----------------------------------Dashboard-routes--------------------------------------------
  { path: '/dashboard/produtos', component: Products },
  {
    path: '/dashboard/produtos/:id',
    name: 'produto',
    component: ProductPage,
    props: (route) => {
      const id = atob(route.params.id);
      return { id }
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


//-----------------------------Auth-Components----------------------------------------------------

import login from './components/auth/login.vue';
app.component('login-component', login)

import register from './components/auth/register.vue';
app.component('register-component', register)

//-----------------------------Dashboard-Components---------------------------------

import example from './components/example.vue';
app.component('example', example);

import Dashboard from './components/Dashboard.vue';
app.component('dashboard-component', Dashboard);

import Content from './components/dash-components/Content.vue';
app.component('content-component', Content);

import Products from './components/dash-components/Product/Products.vue';
app.component('products', Products);

import ProductPage from './components/dash-components/Product/ProductPage.vue';
app.component('product-page', ProductPage);

import DescProduct from './components/dash-components/Product/DescProduct.vue';
app.component('desconto-product', DescProduct);

import DefProduct from './components/dash-components/Product/DefProduct.vue';
app.component('defenitions-product', DefProduct);

import InputContainer from './components/dash-components/InputContainer.vue';
app.component('input-container', InputContainer);

import Modal from './components/dash-components/Modal.vue';
app.component('modal-component', Modal);

import Table from './components/dash-components/Table.vue';
app.component('table-component', Table);

//--------------------------------Site-Components------------------------------------

import Home from './components/Home.vue';
app.component('home-component', Home);

import Profile from './components/Profile.vue';
app.component('profile-component', Profile);

import Breadcrumb from './components/site-components/Breadcrumb.vue';
app.component('breadcrumb-component', Breadcrumb);

import Navbar from './components/site-components/Navbar.vue';
app.component('navbar-component', Navbar);

import AmazingGifts from './components/site-components/AmazingGifts.vue';
app.component('gifts-component', AmazingGifts);

import ProductsShownd from './components/site-components/ProductsShownd.vue';
app.component('gifts-products-component', ProductsShownd);

import BusinessCards from './components/site-components/BusinessCards.vue';
app.component('cards-component', BusinessCards);

import Engraving from './components/site-components/Engraving.vue';
app.component('engraving-component', Engraving);

import LazerCut from './components/site-components/LazerCut.vue';
app.component('lazer-component', LazerCut);

import Help from './components/site-components/Help.vue';
app.component('help-component', Help);

import ShoppingCart from './components/site-components/ShoppingCart.vue';
app.component('cart-component', ShoppingCart);

import Contacts from './components/site-components/Contacts.vue';
app.component('contacts-component', Contacts);

//-------------------------------------General-Components-------------------------------
import Alert from './components/Alert.vue';
app.component('alert-component', Alert);

import ProductCard from './components/ProductCard.vue';
app.component('card-component', ProductCard);




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

