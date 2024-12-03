<template>
  <div id="navbar-container">
    <div class="navbar-top">
      <!---------------------------Logo link------------------------------------->
      <!---------------------------Follow us links------------------------------------->

      <div class="nav-icons">
        <div class="search">
          <a href="#" id="search-input">
            <input type="text">
          </a>
        </div>

        <div class="wish">
          <a href="/profile?wish=2">
            <img src="@/images/Icons/heart.png" alt="wish-icon">
            <p class="wish-label">WISH LIST</p>
          </a>
        </div>

        <!---------------------------Logs/Profile link------------------------------------->
        <div class="logs">
          <img src="@/images/Icons/user-check.png" alt="user-icon">

          <slot></slot>
        </div>
        <!---------------------------Shopping-cart link------------------------------------->
        <div class="shopping-cart" v-if="altroutes == true">
          <a href="/home/shopping_cart">
            <img src="@/images/Icons/shopping-cart-1.png" alt="user-icon">
            <p class="num-items"> <b>{{ cartTotal }}</b></p>
            <p class="total"><b>{{ totalPrice }}€</b></p>
          </a>
        </div>
        <div class="shopping-cart" v-else>
          <router-link to="/home/shopping_cart" @click="active = false">
            <img src="@/images/Icons/shopping-cart-1.png" alt="user-icon">
            <p class="num-items"> <b>{{ cartTotal }}</b></p>
            <p class="total"><b>{{ totalPrice }}€</b></p>
          </router-link>

        </div>


      </div>
      <div class="mini-menu-btn"><svg @click="active = !active" viewBox="0 0 200 200" fill="none"
          :class="active == true ? 'bar-anim' : ''">
          <g clip-path="url(#clip0_26_2)">
            <path class="down" d="M26 148H173" stroke-linecap="round" />
            <path class="middle" d="M26 100H173" stroke-linecap="round" />
            <path class="up" d="M26 50H173" stroke-linecap="round" />
          </g>
        </svg></div>
    </div>

    <div class="navbar-logo" v-if="altroutes == true">
      <a href="/home">
        <div class="bg-logo" >
          <img src="@/images/logos/LogoVetorizadoFundBranco.png" width="50" alt="Logo marca">
        </div>
      </a>
    </div>
    <div class="navbar-logo" v-else>
      <router-link to="/home" >
        <div class="bg-logo">
          <img src="@/images/logos/LogoVetorizadoFundBranco.png" width="50" alt="Logo marca">
        </div>
      </router-link>
    </div>

    <!---------------------------Menu links------------------------------------->
    <div class="navbar-links" v-if="altroutes == true" :class="active == true ? 'open' : ''">
      <div class="start-links">
        <a href="/home/amazing_gifts" @click="clearStorage()" class="nav-link"
          :class="$route.name == 'AmazingGifts' ? 'active' : ''">
          <div id="glow-div">
            <p><b>GIFTS</b></p>
          </div>
        </a>
        <a href="/home/engraving" @click="clearStorage()" class="nav-link"
          :class="$route.name == 'Engraving' ? 'active' : ''">
          <div id="glow-div">
            <p><b>ENGRAVING</b></p>
          </div>
        </a>
        <a href="/home/lazer_cut" @click="clearStorage()" class="nav-link"
          :class="$route.name == 'LazerCut' ? 'active' : ''">
          <div id="glow-div">
            <p><b>LAZER CUT</b></p>
          </div>
        </a>
        <a href="/home/policies" @click="clearStorage()" class="nav-link"
          :class="$route.name == 'Policies' ? 'active' : ''">
          <div id="glow-div">
            <p><b>POLICIES</b></p>
          </div>
        </a>
        <a href="/home/contacts" @click="clearStorage()" class="nav-link"
          :class="$route.name == 'Contacts' ? 'active' : ''">
          <div id="glow-div">
            <p><b>CONTACTS</b></p>
          </div>
        </a>
      </div>
    </div>
    <div class="navbar-links" :class="active == true ? 'open' : ''" v-else>
      <div class="start-links">
        <router-link to="/home/amazing_gifts" @click="clearStorage()" class="nav-link"
          :class="$route.name == 'AmazingGifts' ? 'active' : ''">
          <div id="glow-div">
            <p><b>GIFTS</b></p>
          </div>
        </router-link>
        <router-link to="/home/engraving" @click="clearStorage()" class="nav-link"
          :class="$route.name == 'Engraving' ? 'active' : ''">
          <div id="glow-div">
            <p><b>ENGRAVING</b></p>
          </div>
        </router-link>
        <router-link to="/home/lazer_cut" @click="clearStorage()" class="nav-link"
          :class="$route.name == 'LazerCut' ? 'active' : ''">
          <div id="glow-div">
            <p><b>LAZER CUT</b></p>
          </div>
        </router-link>
        <router-link to="/home/policies" @click="clearStorage()" class="nav-link"
          :class="$route.name == 'Policies' ? 'active' : ''">
          <div id="glow-div">
            <p><b>POLICIES</b></p>
          </div>
        </router-link>
        <router-link to="/home/contacts" @click="clearStorage()" class="nav-link"
          :class="$route.name == 'Contacts' ? 'active' : ''">
          <div id="glow-div">
            <p><b>CONTACTS</b></p>
          </div>
        </router-link>
      </div>
    </div>
  </div>

  <modal-component id="searchModal" title="O que procuras em especifico?">
    <template v-slot:content>
      <input type="text" name="search" aria-describedby="search">
    </template>

    <template v-slot:footer>
      <button class="button-save" @click="search()">Procurar</button>
    </template>

  </modal-component>
  <!---------------------------Breadcrumb------------------------------------->
  <breadcrumb-component></breadcrumb-component>
  {{ sessionTotal }}
</template>

<script>
export default {
  props: {
    altroutes: {
      type: Boolean,
      required: true
    }
  },
  data() {
    return {
      cartProducts: { data: [] },
      cartTotal: '',
      totalProducts: '',
      discounts: { data: [] },
      totalPrice: '',
      active: false,
    }
  },
  methods: {

    clearStorage() {
      localStorage.clear();
      this.getData();
      this.active = !this.active;
    },

    calculatedValue(p) {
      let price = p.strike_price
      let discountValue = ''
      let quantity = p.quantity

      this.discounts.data.forEach(e => {
        if (e.id == p.discount_price && e.ativo == 1) {
          discountValue = e.desconto
        }
      })

      let priceDiscounted = price - (discountValue * price)

      let total = (priceDiscounted * quantity).toFixed(2)

      return total
    },
    getData() {
      let url = this.$store.state.Url + 'cart'
      let urlDiscount = this.$store.state.Url + 'api/desconto'

      axios.get(urlDiscount)
        .then((response) => {
          this.discounts.data = response.data
          //   console.log(response.data)
        })
        .catch(errors => {
          console.log(errors.response.data.message)
        })
      axios.get(url)
        .then((response) => {
          this.cartProducts.data = response.data.cart_products
          this.cartTotal = response.data.cart_total
          this.totalProducts = response.data.total_products_count
            // console.log(response.data)
        })
        .catch(errors => {
          console.log(errors.response.data.message)
        })
    }
  },
  computed: {
    sessionTotal() {
      let values = []
      let total = 0

      Object.values(this.cartProducts.data).forEach(v => {
        values.push(this.calculatedValue(v))
      })

      function sum(a) {
        return (a.length && parseFloat(a[0]) + sum(a.slice(1))) || 0;
      }

      total = sum(values).toFixed(2)

      this.totalPrice = total

    },
  },
  mounted() {
    this.getData();
    // console.log(this.$router)
  }
}
</script>
