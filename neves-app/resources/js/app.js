import './bootstrap';


//----------------------Vue-----------------------------

import { createApp } from 'vue';


//---------------------- Vue Router--------------------------
import { createRouter, createWebHistory } from 'vue-router';


//-----------------Vuex----------------------------------------------------------------

import { createStore } from 'vuex'

const store = createStore({
  state() {
    return {
      item: {}, //saves the item to open in a diferent page

      transaction: { status: '', message: '' }, //saves the status of the response to further notice

      Url: 'http://127.0.0.1:8000/', //set globally the main Route
      
      user: document.querySelector("meta[name='user-id']"), // saves globally the user id
      
      csrf: document.querySelector("meta[name='csrf-token']"), // saves globally the csrf token

      token: '',

      componentKey: '',
    }
  }
})


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
    path: '/home/policies',
    component: Policies,
    name: 'Policies',
    meta: {
      breadcrumb: 'policies'
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
      const id = route.params.id;
      return { id }
    }
  },
  { path: '/dashboard/produtos/descontos', component: DescProduct },
  { path: '/dashboard/produtos/defenicoes', component: DefProduct },
  { path: '/dashboard/conteudo', component: Content },
  { path: '/dashboard/conteudo/politicas', component: Policies_editor },
  { path: '/dashboard/conteudo/contactos', component: Contacts_editor },
  { path: '/dashboard/estatisticas', component: example },
  { path: '/dashboard/estatisticas/avaliacoes', component: example },
  { path: '/dashboard/estatisticas/lucros', component: example },
  { path: '/dashboard/estatisticas/encomendas', component: example },
  { path: '/dashboard/estatisticas/logs', component: example },
  { path: '/dashboard/users', component: Users },
  { path: '/dashboard/users/mensagens', component: example },
  { path: '/dashboard/users/pedidos', component: example },
  { path: '/dashboard/users/gestao', component: Gestao },
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

import PreviewImages from './components/dash-components/PreviewImages.vue';
app.component('preview-component', PreviewImages);

import Pie from './components/dash-components/Charts/Pie.vue';
app.component('pie-component', Pie);

import Line from './components/dash-components/Charts/Line.vue';
app.component('line-component', Line);

import Bar from './components/dash-components/Charts/Bar.vue';
app.component('bar-component', Bar);

import Dashboard from './components/Dashboard.vue';
app.component('dashboard-component', Dashboard);

import Users from './components/dash-components/Users/Users.vue';
app.component('users-component', Users);

import Gestao from './components/dash-components/Users/Gestao.vue';
app.component('gestao-component', Gestao);

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

import Content from './components/dash-components/Content/Content.vue';
app.component('content-component', Content);

import Policies_editor from './components/dash-components/Content/Policies.vue';
app.component('policies_editor-component', Policies_editor);

import Contacts_editor from './components/dash-components/Content/Contacts.vue';
app.component('contacts_editor-component', Contacts_editor);

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

import Policies from './components/site-components/Policies.vue';
app.component('policies-component', Policies);

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

import Footer from './components/Footer.vue';
app.component('footer-component', Footer);

import PopUpCartAlert from './components/site-components/PopUpCartAlert.vue';
app.component('popupCart-component', PopUpCartAlert);
//-------------------------------------General-Components-------------------------------


import Alert from './components/Alert.vue';
app.component('alert-component', Alert);

import ProductCard from './components/ProductCard.vue';
app.component('card-component', ProductCard);

import FormContact from './components/FormContact.vue';
app.component('contact-component', FormContact);

import ServicesInfo from './components/ServicesInfo.vue';
app.component('services-component', ServicesInfo);

import BoxMenu from './components/BoxMenu.vue';
app.component('boxmenu-component', BoxMenu);





//---------------------------------------Filters------------------------------------------------------------
app.config.globalProperties.$filters = {
  formatDateTime(d) {
    if (!d) return ''

    d = d.split('T')

    let data = d[0]
    let tempo = d[1]

    //format the date
    data = data.split('-')
    data = data[2] + '/' + data[1] + '/' + data[0]

    //format the time 
    tempo = tempo.split('.')
    tempo = tempo[0]

    return data + ' ' + tempo
  }
};

app.use(router)
app.use(store)
app.mount('#app');

