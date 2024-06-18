<template>
  <div class="container">
    <section class="product-info " >
      <!----------------------------- Product header (name, rating and share links) --------------------------------->
      <div class="product-header">
        <div class="product-title width100">
          <div class="titulo">
            <h3>{{ product.data.nome }}</h3>
          </div>
        </div>
        <div class="ranking">
          <div class="stars">
            <img src="/storage/images/Icons/5-stars.png" alt="5stars">
            <div class="bg-stars" :style="'width:' + getRating + 'px'"></div>
          </div>
          <p>Reviews ({{ reviewsNumb }})</p>
        </div>
        <div class="share">
          <ul>
            <li><a href=""><img src="/storage/images/icons/facebook.png" alt="facebook-icon" style="width:20px">
                <p class="marginMinHor">Share</p>
              </a>
            </li>
            <li><a href=""><img src="/storage/images/icons/instagram.png" alt="instagram-icon" style="width:20px">
                <p class="marginMinHor">Share</p>
              </a>
            </li>
            <li><a href=""><img src="/storage/images/icons/mail_646135.png" alt="mail-icon" style="width:20px">
                <p class="marginMinHor">Email</p>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <!----------------------------- Product Images shownd --------------------------------->
      <div class="product-images">
        <div class="images">
          <img :src="firstImage" alt="product image" v-if="openImage == ''">
          <img :src="openImage" alt="product image" v-else>
        </div>
        <div class="miniatures">
          <div class="min-image" v-for=" image, index in productImages.data " :key="index"
            @click="setImage(image.nome)">
            <img :src="'/storage/' + image.nome" alt="product image" style="width:100px">
          </div>
        </div>
      </div>

      <!----------------------------- Product details info --------------------------------->
      <div class="product-details">
        <div class="price">
          <div class="sale" v-if="discount.data.ativo == 1">
            <div class="promo">
              <h2>{{ getPrice }} € </h2> <span>
                <h4>Promo</h4>
              </span>
            </div>
            <h6><b>Antes: <s>{{ product.data.valor }}€</s></b></h6>
            <h6><b>Poupa: {{ (product.data.valor * discount.data.desconto).toFixed(2) }} €</b></h6>
          </div>
          <div class="sale" v-else>
            <h2>{{ product.data.valor }} €</h2>
            <br>
          </div>
          <p>O preço inclui personalização</p>
        </div>
        <div class="shipping">

          <h5><b>Tempo médio de envio (BD tempo de envio)</b></h5>
        </div>
        <div class="details">
          <h6><b>Detalhes do produto</b></h6>
          <br>
          <ul>
            <li v-for="detail in details.data"> {{ detail.descricao != null ? '-' + detail.descricao : '' }}</li>
          </ul>
        </div>
        <!----------------------------- Selected info provided by the Seller --------------------------------->
        <div class="details">
          <h6><b>Costumização</b></h6>
          <br>
          <div v-if="product.data.costumizavel == 1 || product.data.costumizavel == 3">
            <div class="drop-button" @click="dropdown()">
              <p><b>{{ colorSelected.name }}</b></p><img src="/storage/images/Icons/arrow.png" alt="">
            </div>
            <div class="drop-color" :class="drop == true ? 'drop' : ''">
              <ul name="productColor" id="productColor">
                <li @click="dropdown('Sem cor')">Sem cor</li>
                <li class="flex-container" v-for="clr in getColors" :value="clr.code" @click="selectColor(clr)">
                  <div class="colorSquare" :style="'background-color:' + clr.code"></div>{{ clr.name }}
                </li>
              </ul>
            </div>
          </div>

          <div v-if="product.data.costumizavel == 2 || product.data.costumizavel == 3">
            <div>
              <input-container id="customText" title="Texto personalizado" help="customTextHelp"
                helpText="O texto não deve ultrapassar os 20 caracteres">
                <textarea name="customText" id="customText" maxlength="20" v-model="textSelected"></textarea>
              </input-container>
            </div>
          </div>
        </div>


        <form method="POST" action="" @submit.prevent="addToCart($event)">
          <input type="hidden" name="_token" :value="$store.state.csrf">
          <div class="quantity">
            
              <input type="number" min="1" name="quantity" aria-describedby="quantity" class="s-input"
                v-model="quantity">
            <div class="btn-pass">
              <button type="submit" class="button-login">
                Add to Cart
              </button>
            </div>
            
          </div>
        </form>

      </div>
    </section>
    <!----------------------------- Product extra info (description, coment and related links) --------------------------------->
    <section class="product-extra">
      <div class="product-description mrgvert2">
        <div class="title">
          <h5><b>DESCRIÇÃO GERAL</b></h5>
        </div>
        <div class="description">
          <h6>{{ product.data.meta_nome }}</h6>
          <h5>{{ product.data.descricao }}</h5>
        </div>
      </div>
      <div class="product-description mrgvert4">
        <div class="title">
          <h5><b>AVALIAÇÕES</b></h5>
          <div class="toogle-bg" @click="toogle()">
            <img src="/storage/images/Icons/arrow.png" alt="" 
              :style="isActive ? 'transform: rotate(180deg)' : ''">
          </div>
        </div>
        <div class="reviews " v-if="isActive">
          <div class="flex-container responsive-end mrghor2" v-if="$store.state.user != null">
            <a href="#addComentModal" class="button-save">Adicionar avaliação</a>
          </div>
          <div v-for="review, index in reviews.data" :key="index">
            <div class="user-review" v-if="review.comentario != null">
              <div class="stars">
                <img src="/storage/images/Icons/5-stars.png" alt="5stars">
                <div class="bg-stars" :style="'width:' + (review.rating * 100) / 5 + 'px'"></div>
              </div>
              <div class="comentary">
                <h6>{{ review.comentario }}</h6>
              </div>
            </div>
          </div>
        </div>
      </div>

      <modal-component id="addComentModal" title="Adiciona um comentário a este produto">
        <template v-slot:content>

          <input-container id="rating" title="Avaliação" help="rating" helpText="Quantas estrelas dá a este produto?"
            size="ml-input">
            <div id="rating">
              <ul>
                <li @click="starvalue(1)" :style="rating >= 1 ? 'background:#dc4151;' : ''"><img
                    src="/storage/images/Icons/Estrela.png" alt="star"></li>
                <li @click="starvalue(2)" :style="rating >= 2 ? 'background:#dc4151;' : ''"><img
                    src="/storage/images/Icons/Estrela.png" alt="star"></li>
                <li @click="starvalue(3)" :style="rating >= 3 ? 'background:#dc4151;' : ''"><img
                    src="/storage/images/Icons/Estrela.png" alt="star"></li>
                <li @click="starvalue(4)" :style="rating >= 4 ? 'background:#dc4151;' : ''"><img
                    src="/storage/images/Icons/Estrela.png" alt="star"></li>
                <li @click="starvalue(5)" :style="rating >= 5 ? 'background:#dc4151;' : ''"><img
                    src="/storage/images/Icons/Estrela.png" alt="star"></li>
              </ul>
            </div>
          </input-container>
          <input-container id="coment" title="Comentário" help="coment" helpText="Escreva o seu comentário"
            size="ml-input">
            <textarea name="coment" id="coment" v-model="comment"></textarea>
          </input-container>
        </template>

        <template v-slot:footer>
          <button class="button-save" @click="addReview()">Enviar</button>
        </template>

      </modal-component>
      <div class="same-category">
        <div class="title">
          <h5><b>PRODUTOS RELACIONADOS</b></h5>
        </div>
        {{ sameCategory }}
          <card-component :products=randomProducts :headTitle='false' :info="{
            nome: false, meta_nome: true, categoria: true, materia: false, quantidade: false, valor: true
          }" :cart="true"></card-component>
      </div>
    </section>

  </div>
</template>

<script>

export default {
  props: {
    id: {
      required: true,
      type: String,
    }
  },
  data() {
    return {
      product: { data: [] },
      productImages: { data: [] },
      discount: { data: [] },
      categoryId: '',
      categoryProducts: { data: [] },
      details: { data: [] },
      reviews: { data: [] },
      openImage: '',
      quantity: 1,
      comment: '',
      rating: '',
      reviewsNumb: '',
      isActive: false,
      drop: false,
      colorSelected: {
        code: '',
        name: 'Select Color',
      },
      textSelected: '',
    }
  },
  methods: {
    addToCart(e) {

      let url = this.$store.state.Url + 'cart'

      let formData = new FormData()

      formData.append('product_id', this.id)
      formData.append('quantity', this.quantity)
      formData.append('color', this.colorSelected.code)
      formData.append('text', this.textSelected)


      let config = {
        headers: {
          'Content-Type': 'x-www-form-urlencoded',
          'Accept': 'application/json'
        }
      }
      axios.post(url, formData, config)
        .then((response) => {
          console.log(response)
          alert('Produto adicionado ao carrinho')
          location.reload()
        })
        .catch(errors => {
          console.log(errors.response.data.message)
        })
    },

    selectColor(c) {
      this.colorSelected.code = c.code
      this.colorSelected.name = c.name

      this.drop = !this.drop
    },

    dropdown(v) { //drop the color select menu
      if (v) {
        this.drop = !this.drop
        this.colorSelected.code = ''
        this.colorSelected.name = v
      } else {
        this.drop = !this.drop
      }
    },

    toogle() { // opens and closes the coments section
      this.isActive = !this.isActive
    },

    starvalue(value) { //sets the rating value
      this.rating = value
    },

    addReview() {
      let url = this.$store.state.Url + 'api/user_reviews'

      let formData = new FormData();
      // formData.append('_method', 'PATCH')

      if (this.comment != '') {
        formData.append('comentario', this.comment)
      }

      if (this.rating != '') {
        formData.append('rating', this.rating)
      }

      formData.append('user_id', this.$store.state.user.content)

      formData.append('produto_id', this.id)


      let config = {
        headers: {
          'Content-Type': 'x-www-form-urlencoded',
          'Accept': 'application/json',

        }
      }

      axios.post(url, formData, config)
        .then(response => {
          history.back()
          this.getData()
        })
        .catch(errors => {
          console.log(errors)
        })
    },

    setImage(image) {
      this.openImage = '/storage/' + image
    },

    getData() {
      let url = this.$store.state.Url + 'api/produto/' + this.id
      let urlImages = this.$store.state.Url + 'api/imagens_produto?filtro=produto_id:=:' + this.id
      let urlDetails = this.$store.state.Url + 'api/produto_detalhe?filtro=produto_id:=:' + this.id
      let urlReviews = this.$store.state.Url + 'api/user_reviews?filtro=produto_id:=:' + this.id

      axios.get(url)
        .then(response => {
          this.product.data = response.data
          this.discount.data = response.data.desconto
          this.categoryId = response.data.categoria_id
          // console.log(response.data)
        })
        .catch(errors => {
          console.log(errors)
        })

      axios.get(urlImages)
        .then(response => {
          this.productImages.data = response.data
          // console.log(response)
        })
        .catch(errors => {
          console.log(errors)
        })

      axios.get(urlDetails)
        .then(response => {
          this.details.data = response.data
          // console.log(response)
        })
        .catch(errors => {
          console.log(errors)
        })

      axios.get(urlReviews)
        .then(response => {
          this.reviews.data = response.data.review
          // console.log(response.data.review)
        })
        .catch(errors => {
          console.log(errors)
        })
    },
    shuffleArray(array) {
      for (let i = array.length - 1; i > 0; i--) {
        let j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
      }
      return array
    }
  },
  computed: {
    sameCategory() { // products in the same category
      let category = this.product.data.categoria_id
      let urlProducts = this.$store.state.Url + 'api/produto?filtro=categoria_id:=:' + category

      axios.get(urlProducts)
        .then(response => {
          response.data.paginated.data.forEach(e => {
            if (e.id != this.id) {
              this.categoryProducts.data.push(e)
            }
          })
        })
        .catch(errors => {
          console.log(errors)
        })
    },

    firstImage() { // gets the main image of the product
      let image = []
      this.productImages.data.forEach(e => {
        if (e.posicao == 1) {
          image.push(e.nome)
        }
      })

      return '/storage/' + image[0]
    },

    getPrice() { //get the price with discount
      let discount = this.discount.data.desconto
      let price = this.product.data.valor

      let sale = price - (price * discount)

      sale = sale.toFixed(2)
      return sale
    },

    getRating() { //calculates the rating from all the reviews
      let sum = 0
      let value = []
      let rating = ''

      this.reviewsNumb = Object.keys(this.reviews.data).length

      Object.values(this.reviews.data).forEach(v => {
        value.push(v.rating)
      })


      value.forEach(e => {
        sum += e
      })

      rating = Math.round(((sum / value.length) * 100) / 5)

      return rating
    },

    getColors() { // get the color info from the details
      let color = []
      let codes = []
      this.details.data.forEach(e => {
        if (e.cor) {
          color.push(e.cor.split('_'))
        }
      })

      color.forEach(c => {
        codes.push({ 'code': c[0], 'name': c[1] })
      })

      return codes
    },
    randomProducts() {
      let productsKeys = Object.keys(this.categoryProducts.data)
      let randomKeys = this.shuffleArray(productsKeys)
      let randomProducts = []
      randomKeys.forEach(e => {
        randomProducts.push(this.categoryProducts.data[e])
      })
      return randomProducts.slice(0, 4)

    }
  },
  mounted() {
    this.getData()
  }
}
</script>