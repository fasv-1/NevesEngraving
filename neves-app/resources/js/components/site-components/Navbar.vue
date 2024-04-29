<template>
  <div class="navbar-container">
    <div class="navbar-top">
      <!---------------------------Logo link------------------------------------->
      <div class="navbar-logo" v-if="altroutes == true">
        <a href="/home">
          <div class="bg-logo" :class="$route.name == 'Home' ? 'active' : ''">
            <img src="/storage/images/logos/LogoVetorizadoFundBranco.png" alt="Logo marca">
          </div>
          <h4><b>Neves Engraving</b></h4>
        </a>
      </div>
      <div class="navbar-logo" v-else>
        <router-link to="/home" :class="$route.name == 'Home' ? 'active' : ''">
          <div class="bg-logo">
            <img src="/storage/images/logos/LogoVetorizadoFundBranco.png" alt="Logo marca">
          </div>
          <h4><b>Neves Engraving</b></h4>
        </router-link>
      </div>
      <!---------------------------Follow us links------------------------------------->
      <div class="nav-contacts">
        <div class="follow-us">
          <p> <b>Follow us on: </b></p>
          <a href="">
            <img src="/storage/images/Icons/facebook.png" alt="facebook-icon">
          </a>
          <a href="">
            <img src="/storage/images/Icons/instagram.png" alt="instagram-icon">
          </a>
          <a href="">
            <img src="/storage/images/Icons/whatsapp_icon.png" alt="whatsapp-icon">
          </a>
        </div>

      </div>

      <div class="nav-icons">

        <div class="wish">
          <img src="/storage/images/Icons/heart.png" alt="facebook-icon">
          <a href="/profile?wish=2">
            <p>Wish List</p>
          </a>
        </div>

        <!---------------------------Logs/Profile link------------------------------------->
        <div class="logs">
          <svg x="0px" y="0px" viewBox="0 0 1024 1024" style="enable-background:new 0 0 1024 1024;"
            xml:space="preserve">
            <path id="cabeça" class="st0" d="M660.5,372.5c-14.7,71.1-81.8,119.2-148.5,119.9c-78.8,0.8-156.5-64.8-158.5-151
	C351.4,250.2,435,174.2,523,183.1C612.4,192.1,678.5,285.7,660.5,372.5z" />
            <path id="corpo" class="st0" d="M213.3,801.3c-2.1-43.7-4.4-92.1-6.8-145.3c-2.2-49-3-76,15.6-99c39.8-49.3,115.4-14.3,282.8-14.1
	c171,0.2,247-36.2,288.6,14.1c18.5,22.4,19,48.4,18,100.5c-0.8,39.9-2.3,86.4-5.1,138.8" />
          </svg>

          <slot></slot>
        </div>
        <!---------------------------Shopping-cart link------------------------------------->
        <div class="shopping-cart" v-if="altroutes == true">
          <a href="/home/shopping_cart">
            <svg x="0px" y="0px" viewBox="0 0 1024 1024" style="enable-background:new 0 0 1024 1024;"
              xml:space="preserve">
              <g id="carrinho">
                <ellipse class="st0" cx="334.2" cy="724.4" rx="62.1" ry="64.9" />
                <ellipse class="st0" cx="635.1" cy="725.1" rx="62.1" ry="64.9" />
                <polygon class="st0" points="282.1,622.2 678.5,622.2 718,364.2 230.8,364.2 	" />
                <line class="st0" x1="241.8" y1="419.5" x2="709.5" y2="419.5" />
                <line class="st0" x1="256.5" y1="493.2" x2="698.2" y2="493.2" />
                <line class="st0" x1="270.7" y1="578.6" x2="682.4" y2="578.5" />
                <line class="st0" x1="628.2" y1="364.2" x2="595.1" y2="622.2" />
                <line class="st0" x1="305.6" y1="364.2" x2="355.8" y2="613.2" />
                <line class="st0" x1="427.4" y1="364.2" x2="429.5" y2="622.2" />
                <line class="st0" x1="528.9" y1="364.2" x2="528.9" y2="616.5" />
                <polyline class="st0" points="112.8,207.9 131.4,207.9 181.7,207.9 230.8,364.2 	" />
                <ellipse cx="112.8" cy="207.5" rx="13.8" ry="10" />
              </g>
              <g id="prenda">
                <rect x="380.5" y="324.4" class="st1" width="240.2" height="265.7" />
                <path class="st1" d="M494.9,324.4c-15.6,0.3-51.8,0.9-76.9-23.4c-7.6-7.3-18.9-21.5-15-27.9c4.5-7.3,29.2-4.4,48,6.9
		C479.2,296.9,481,324.8,494.9,324.4c13-0.4,13-24.8,37.1-41.4c21.9-15.1,52.3-15.7,56-8c3.7,7.7-18.7,25.2-21,27
		C539.5,323.2,508,324.2,494.9,324.4z" />
                <path class="st1" d="M504.4,311.7c0,6.6-5.4,12.3-11.4,11.9c-6.6-0.4-11.1-7.9-9.9-14.4c0.9-4.8,4.9-9.2,9.9-9.4
		C499,299.4,504.4,305.2,504.4,311.7z" />
              </g>
            </svg>
          </a>
          <p>nº item: {{ totalPrice }}€</p>
        </div>
        <div class="shopping-cart" v-else>
          <router-link to="/home/shopping_cart">
            <svg x="0px" y="0px" viewBox="0 0 1024 1024" style="enable-background:new 0 0 1024 1024;"
              xml:space="preserve">
              <g id="carrinho">
                <ellipse class="st0" cx="334.2" cy="724.4" rx="62.1" ry="64.9" />
                <ellipse class="st0" cx="635.1" cy="725.1" rx="62.1" ry="64.9" />
                <polygon class="st0" points="282.1,622.2 678.5,622.2 718,364.2 230.8,364.2 	" />
                <line class="st0" x1="241.8" y1="419.5" x2="709.5" y2="419.5" />
                <line class="st0" x1="256.5" y1="493.2" x2="698.2" y2="493.2" />
                <line class="st0" x1="270.7" y1="578.6" x2="682.4" y2="578.5" />
                <line class="st0" x1="628.2" y1="364.2" x2="595.1" y2="622.2" />
                <line class="st0" x1="305.6" y1="364.2" x2="355.8" y2="613.2" />
                <line class="st0" x1="427.4" y1="364.2" x2="429.5" y2="622.2" />
                <line class="st0" x1="528.9" y1="364.2" x2="528.9" y2="616.5" />
                <polyline class="st0" points="112.8,207.9 131.4,207.9 181.7,207.9 230.8,364.2 	" />
                <ellipse cx="112.8" cy="207.5" rx="13.8" ry="10" />
              </g>
              <g id="prenda">
                <rect x="380.5" y="324.4" class="st1" width="240.2" height="265.7" />
                <path class="st1" d="M494.9,324.4c-15.6,0.3-51.8,0.9-76.9-23.4c-7.6-7.3-18.9-21.5-15-27.9c4.5-7.3,29.2-4.4,48,6.9
		C479.2,296.9,481,324.8,494.9,324.4c13-0.4,13-24.8,37.1-41.4c21.9-15.1,52.3-15.7,56-8c3.7,7.7-18.7,25.2-21,27
		C539.5,323.2,508,324.2,494.9,324.4z" />
                <path class="st1" d="M504.4,311.7c0,6.6-5.4,12.3-11.4,11.9c-6.6-0.4-11.1-7.9-9.9-14.4c0.9-4.8,4.9-9.2,9.9-9.4
		C499,299.4,504.4,305.2,504.4,311.7z" />
              </g>
            </svg>

          </router-link>
          <p> <b>{{ totalProducts }}</b> item(s): <b>{{ totalPrice }}€</b></p>
        </div>


      </div>
      <div class="mini-menu-btn"><svg @click="active = !active" viewBox="0 0 200 200" fill="none" :class="active == true ? 'bar-anim':''">
          <g clip-path="url(#clip0_26_2)">
            <path class="down" d="M26 148H173" stroke="black" stroke-width="3" stroke-linecap="round" />
            <path class="midle" d="M26 100H173" stroke="black" stroke-width="3" stroke-linecap="round" />
            <path class="up" d="M26 50H173" stroke="black" stroke-width="3" stroke-linecap="round" />
          </g>
          <!-- <defs> -->
            <!-- <clipPath id="clip0_26_2"> -->
              <!-- <rect width="200" height="200" fill="white" /> -->
            <!-- </clipPath> -->
          <!-- </defs> -->
        </svg></div>
    </div>
    <!---------------------------Menu links------------------------------------->
    <div class="navbar-links" v-if="altroutes == true" :class="active == true ? 'show' : ''">
      <div class="start-links">
        <a href="/home/amazing_gifts" @click="clearStorage()" class="nav-link"
          :class="$route.name == 'AmazingGifts' ? 'active' : ''">
          <div class="glow-div">
            <h6><b>AMAZING GIFTS</b></h6>
          </div>
        </a>
        <a href="/home/engraving" @click="clearStorage()" class="nav-link"
          :class="$route.name == 'Engraving' ? 'active' : ''">
          <div class="glow-div">
            <h6><b>ENGRAVING</b></h6>
          </div>
        </a>
        <a href="/home/lazer_cut" @click="clearStorage()" class="nav-link"
          :class="$route.name == 'LazerCut' ? 'active' : ''">
          <div class="glow-div">
            <h6><b>LAZER CUT</b></h6>
          </div>
        </a>
      </div>
      <div class="end-links">
        <a href="/home/policies" @click="clearStorage()" class="nav-link"
          :class="$route.name == 'Policies' ? 'active' : ''">
          <div class="glow-div">
            <h6><b>POLICIES</b></h6>
          </div>
        </a>
        <a href="/home/contacts" @click="clearStorage()" class="nav-link"
          :class="$route.name == 'Contacts' ? 'active' : ''">
          <div class="glow-div">
            <h6><b>CONTACTS</b></h6>
          </div>
        </a>
        <a href="#searchModal" @click="clearStorage()">
          <svg class="mag-glass" x="0px" y="0px" viewBox="0 0 1024 1024" style="enable-background:new 0 0 1024 1024;"
            xml:space="preserve">
            <path id="circulo" class="st0" d="M620,452.7c0,114.5-90.8,205.7-201,205.7c-110.2,0-201-91.3-201-205.7
	C218,338.3,308.8,247,419,247C529.1,247,620,338.3,620,452.7z" />
            <path id="barrinha" class="st1" d="M780.7,738.5c8.6,6,20.6,4,26.7-4.4s4.1-20-4.5-26L780.7,738.5z M574,595.2l206.7,143.4l22.2-30.3
	L596.2,564.9L574,595.2z" />
          </svg>
        </a>
      </div>
    </div>
    <div class="navbar-links" :class="active == true ? 'open' : ''" v-else>
      <div class="start-links">
        <router-link to="/home/amazing_gifts" @click="clearStorage()" class="nav-link"
          :class="$route.name == 'AmazingGifts' ? 'active' : ''">
          <div id="glow-div">
            <h6><b>AMAZING GIFTS</b></h6>
          </div>
        </router-link>
        <router-link to="/home/engraving" @click="clearStorage()" class="nav-link"
          :class="$route.name == 'Engraving' ? 'active' : ''">
          <div id="glow-div">
            <h6><b>ENGRAVING</b></h6>
          </div>
        </router-link>
        <router-link to="/home/lazer_cut" @click="clearStorage()" class="nav-link"
          :class="$route.name == 'LazerCut' ? 'active' : ''">
          <div id="glow-div">
            <h6><b>LAZER CUT</b></h6>
          </div>
        </router-link>
      </div>
      <div class="end-links">
        <router-link to="/home/policies" @click="clearStorage()" class="nav-link"
          :class="$route.name == 'Policies' ? 'active' : ''">
          <div id="glow-div">
            <h6><b>POLICIES</b></h6>
          </div>
        </router-link>
        <router-link to="/home/contacts" @click="clearStorage()" class="nav-link"
          :class="$route.name == 'Contacts' ? 'active' : ''">
          <div id="glow-div">
            <h6><b>CONTACTS</b></h6>
          </div>
        </router-link>
        <a href="#searchModal" @click="clearStorage()">
          <svg class="mag-glass" x="0px" y="0px" viewBox="0 0 1024 1024" style="enable-background:new 0 0 1024 1024;"
            xml:space="preserve">
            <path id="circulo" class="st0" d="M620,452.7c0,114.5-90.8,205.7-201,205.7c-110.2,0-201-91.3-201-205.7
	C218,338.3,308.8,247,419,247C529.1,247,620,338.3,620,452.7z" />
            <path id="barrinha" class="st1" d="M780.7,738.5c8.6,6,20.6,4,26.7-4.4s4.1-20-4.5-26L780.7,738.5z M574,595.2l206.7,143.4l22.2-30.3
	L596.2,564.9L574,595.2z" />
          </svg>
        </a>
      </div>
    </div>
  </div>

  <modal-component id="searchModal" title="O que procuras em especifico?">
    <template v-slot:content>
      <input type="text" name="search" aria-describedby="search">
    </template>

    <template v-slot:footer>
      <button class="button-save" @click="search()">Procurar</button>
      <!--The seconde parameter defines the endpoint for the url-->
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
      // location.reload();
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
          //   console.log(response.data)
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
    this.getData()
    // console.log(this.altroutes)
    // console.log(this.$router)
  }
}
</script>