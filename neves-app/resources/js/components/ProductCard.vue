<template>
  <!------------------------------------ Container to show the products ------------------------------>

  <div :class="scroll == true ? 'scroll-side' : 'card-box'">

    <div class="card-prd" v-for="value, indexValue in products" :key="indexValue">

      <!----------------------------------Put product on the wish list-------------------------------------->
      <div class="wish" v-if="this.$store.state.user == null">
        <a href="/login"><img src="@/images/Icons/heart.png" alt="small heart"></a>
      </div>
      <div class="wish" v-if="this.$store.state.user != null">
        <a href="" @click.prevent="addWish(value.id)"><img src="@/images/Icons/heart.png" alt="small heart"></a>
      </div>
      <div class="wish" v-if="userFavorites.data != ''">
        <div v-for="favorites, index in userFavorites.data" :key="index">
          <a href="" v-if="favorites.produto_id == value.id">
            <img @click.prevent="removeWish(favorites.id)" src="@/images/Icons/full-heart.png" alt="small heart">
          </a>
        </div>
      </div>
      <!----------------------------------end of wish list -------------------------------------------------->

      <!-------------------------------------------promo------------------------------------------------------->

      <div class="icon-cont" v-if="info.valor">
        <div class="promo-icon" v-if="value.desconto.ativo == 1">
          <p>{{ value.desconto.desconto * 100 }}%</p>
        </div>
      </div>
      <!-------------------------------------------end promo------------------------------------------------------->

      <!----------------------------------product info and image -------------------------------------------------->
      <a :href="'/home/amazing_gifts/' + encrypt(value.id)" class="label-area">
        <div class="img-area">
          <div v-for="i, indexValue in  productsImages.data" :key="indexValue">
            <div class="img-cont" v-if="i.produto_id == value.id && i.posicao == 1">
              <img class="img-prd" :src="'/storage/' + i.nome" alt="">
            </div>
          </div>
        </div>
        <div class="info-area">
          <h6 v-if="info.nome">{{ value.nome }}</h6>
          <h4 v-if="info.meta_nome">{{ value.meta_nome }}</h4>
          <h5 v-if="info.categoria">{{ value.ocasioes_categoria_id }}</h5>
          <h5 v-if="info.materia">{{ value.materia_prima.nome }}</h5>
          <h5 v-if="info.quantidade">Quant.: {{ value.quantidade }} </h5>
          <div class="discount" v-if="info.valor">
            <div v-if="value.desconto.ativo == 1">
              <h3>{{ round(value.valor - (value.valor * value.desconto.desconto)) }} €</h3>
              <s>
                <h6>{{ value.valor }} €</h6>
              </s>

            </div>
            <div v-if="value.desconto.ativo == 0">
              <h3>{{ value.valor }} €</h3>
            </div>
          </div>

        </div>
        <div class="stars">
          <img src="@/images/Icons/5-stars.png" alt="5stars">
          <div class="bg-stars" :style="'width:' + reviewCalc(value.id) + 'px'"></div>
        </div>
      </a>
      <!----------------------------------end of product info and image -------------------------------------------------->

      <!----------------------------------product add to cart button -------------------------------------------------->
      <div class="cart-btn" v-if="cart">
        <form method="POST" action="" @submit.prevent="addToCart(value.id)">
          <input type="hidden" name="_token" :value="$store.state.csrf">

          <button type="submit">
            <div class="bg-anim"></div>
            <h5>Add to cart</h5>
          </button>

        </form>
      </div>
      <!----------------------------------end of product add to cart -------------------------------------------------->
    </div>
  </div>
  <popupCart-component :name = popUpInfo.name :quantity = popUpInfo.quantity :image = popUpInfo.image :display = "active"></popupCart-component>
</template>

<script>
export default {
  props: ['products', 'headTitle', 'info', 'cart', 'scroll'],
  data() {
    return {
      productsImages: { data: [] },
      userFavorites: { data: [] },
      reviews: { data: [] },
      popUpInfo : {},
      active: false,

    }
  },
  methods: {
    forceRerender() {
      this.$store.state.componentKey += 1;
    },
    addedProductPopUp(n){
      let image = ''
      let name = ''
      let quantity = 1

      this.allImages.forEach(i =>{
        if(i.produto_id == n && i.posicao == 1){
          image = i.nome
        }
      })

      this.products.forEach(p =>{
        if(p.id == n){
          name = p.meta_nome
        }
      })

      this.popUpInfo = {'name' : name, 'quantity' : quantity, 'image' : image}

      this.active = true

     setTimeout(() => {
       this.active = false
     }, 2000);

    },
    addToCart(e) {

      let url = 'http://127.0.0.1:8000/cart'

      let formData = new FormData()

      formData.append('product_id', e)
      formData.append('quantity', 1)

      let config = {
        headers: {
          'Content-Type': 'x-www-form-urlencoded',
          'Accept': 'application/json'
        }
      }
      axios.post(url, formData, config)
        .then((response) => {
          console.log(response)
          this.forceRerender()
        })
        .catch(errors => {
          console.log(errors.response.data.message)
        })

        this.addedProductPopUp(e)

    },

    addWish(id) {
      let url = this.$store.state.Url + 'api/user_favorites'

      let formData = new FormData()

      formData.append('user_id', this.$store.state.user.content)
      formData.append('produto_id', id)

      let config = {
        headers: {
          'Content-Type': 'x-www-form-urlencoded',
          'Accept': 'application/json'
        }
      }

      axios.post(url, formData, config)
        .then(response => {
          console.log(response)
          this.getFavorites()
        })
        .catch(errors => {
          console.log(errors)
        })

    },

    removeWish(id) {
      let url = this.$store.state.Url + 'api/user_favorites/' + id

      let formData = new FormData();
      formData.append('_method', 'delete')

      axios.post(url, formData)
        .then(response => {
          console.log(response)
          this.getFavorites()

        })
        .catch(errors => {
          console.log(errors)
        })

    },

    getFavorites() {
      if (this.$store.state.user != null) {
        let url = this.$store.state.Url + 'api/user_favorites?filtro=user_id:=:' + this.$store.state.user.content

        axios.get(url)
          .then(response => {
            this.userFavorites.data = response.data.favorites
            // console.log()
          })
          .catch(errors => {
            console.log(errors)
          })
      }

    },

    round(n) {
      let round = n.toFixed(2);

      return round
    },

    encrypt(id) {
      let idEncode = btoa(id)

      return idEncode
    },

    reviewCalc(id) { // calculates the star scale from all the reviews
      let reviews = []
      let sum = 0

      let rating = ''

      this.reviews.data.forEach(element => {
        if (element.produto_id == id && element.rating) {
          reviews.push(element.rating)
        }
      })

      reviews.forEach(e => {
        sum += e
      })

      rating = Math.round(((sum / reviews.length) * 100) / 5)

      return rating

    },

    getReviews() {
      let urlReviews = this.$store.state.Url + 'api/user_reviews'

      axios.get(urlReviews)
        .then(response => {
          this.reviews.data = response.data.review
          // console.log()
        })
        .catch(errors => {
          console.log(errors)
        })
    },

    erraserror() {
      this.$store.state.transaction.status = '';
      this.$store.state.transaction.message = '';
    },

    getImage() {
      let urlImages = this.$store.state.Url + 'api/imagens_produto'

      //get all the products image
      axios.get(urlImages)
        .then(response => {
          this.productsImages.data = response.data
        })
        .catch(errors => {
          console.log(errors);
        })
    },




  },
  computed: {
    allImages(){
      let allImages = [];
      this.productsImages.data.forEach(element => {
        allImages.push(element)
      });

      return allImages
    }
  },
  mounted() {
    this.getImage()
    this.getFavorites()
    this.getReviews()
  }

}
</script>
