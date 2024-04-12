<template>
  <div class="container margin2">
    <section class="product-info">
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
          <p>Reviews ({{ (reviews.data).length }})</p>
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
      <div class="product-details">
        <div class="price">
          <div class="sale" v-if="discount.data.ativo == 1">
            <div class="promo">
              <h2>{{ getPrice }} € </h2> <span>
                <h4>Promo</h4>
              </span>
            </div>
            <h6>Antes: <s>{{ product.data.valor }}€</s></h6>
            <h6>Poupa: {{ (product.data.valor * discount.data.desconto).toFixed(2) }} €</h6>
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
            <input-container id="quantity" title='Quantidade' help="quantityHelp" helpText="Escolha a quantidade"
              size="ms-input">
              <input type="number" name="quantity" aria-describedby="quantity" class="ms-input" v-model="quantity">
            </input-container>
            <div class="btn-pass">
              <button type="submit" class="button1">
                addToCart
              </button>
            </div>
          </div>
        </form>


      </div>
    </section>
    <section class="product-extra">
      <div class="product-description mrgvert2">
        <div class="title">
          <h3><b>DESCRIÇÃO GERAL</b></h3>
        </div>
        <div class="description">
          <h6>{{ product.data.meta_nome }}</h6>
          <h5>{{ product.data.descricao }}</h5>
        </div>
      </div>
      <div class="product-description mrgvert4">
        <div class="title">
          <h3><b>AVALIAÇÕES</b></h3>
          <div class="toogle-bg">
            <img src="/storage/images/Icons/arrow.png" alt="" @click="toogle()"
              :style="isActive ? 'transform: rotate(180deg)' : ''">
          </div>
        </div>
        <div class="reviews " v-if="isActive">
          <div class="add-reviews" v-if="$store.state.user != null">
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
      <div class="sameCategory mrgvert2">
        <div class="title">
          <h3><b>PRODUTOS RELACIONADOS</b></h3>
        </div>
        {{ sameCategory }}
        <card-component :products=categoryProducts.data :headTitle='false' :info="{
              nome: false, meta_nome: true, categoria: true, materia: false, quantidade: false, valor: true
            }" :cart="true"></card-component>
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
          <!--The seconde parameter defines the endpoint for the url-->
        </template>

      </modal-component>
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
      categoryProducts: { data: [] },
      quantity: 1,
      comment: '',
      rating: '',
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

      let url = 'http://127.0.0.1:8000/cart'

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
    dropdown(v) {
      if (v) {
        this.drop = !this.drop
        this.colorSelected.code = ''
        this.colorSelected.name = v
      } else {
        this.drop = !this.drop
      }
    },
    toogle() {
      this.isActive = !this.isActive
    },
    starvalue(value) {
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
  },
  computed: {
    sameCategory() {
      let category = this.product.data.categoria_id
      let urlProducts = this.$store.state.Url + 'api/produto?filtro=categoria_id:=:' + category

      axios.get(urlProducts)
        .then(response => {
          this.categoryProducts.data = response.data.paginated.data
        })
        .catch(errors => {
          console.log(errors)
        })
    },
    firstImage() {
      let image = []
      this.productImages.data.forEach(e => {
        if (e.posicao == 1) {
          image.push(e.nome)
        }
      })
      // console.log(image[0])
      return '/storage/' + image[0]
    },
    getPrice() {
      let discount = this.discount.data.desconto
      let price = this.product.data.valor

      let sale = price - (price * discount)

      sale = sale.toFixed(2)
      return sale
    },
    getRating() {
      let sum = 0
      let value = []
      let rating = ''

      this.reviews.data.forEach(e => {
        if (e.rating) {
          value.push(e.rating)
        }
      })
      value.forEach(e => {
        sum += e
      })

      rating = Math.round(((sum / value.length) * 100) / 5)

      return rating
    },
    getColors() {
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
    }
  },
  mounted() {
    this.getData()
  }
}
</script>