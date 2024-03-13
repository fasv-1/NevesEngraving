<template>
  <div class="container">
    <section class="product-info">
      <div class="product-header">
        <div class="product-title">
          <div class="title">
            <h3>{{ product.data.nome }}</h3>
          </div>
          <div class="ranking">
            <div class="bg-stars">
              <img src="/storage/images/icons/5-stars.png" alt="facebook-icon" style="height:20px">
            </div>
            <p>Reviews</p>
          </div>
        </div>
        <div class="share">
          <ul>
            <li><img src="/storage/images/icons/facebook.png" alt="facebook-icon" style="width:20px">Share</li>
            <li><img src="/storage/images/icons/instagram.png" alt="instagram-icon" style="width:20px">Share</li>
            <li><img src="/storage/images/icons/mail_646135.png" alt="mail-icon" style="width:20px">Email</li>
          </ul>
        </div>
      </div>
      <div class="product-images">
        <div class="images">
          <img :src="firstImage" alt="" style="width:500px" v-if="openImage == ''">
          <img :src="openImage" alt="product image" style="width:500px" v-else>
        </div>
        <div class="miniatures">
          <div class="min-image" v-for=" image, index in productImages.data " :key="index" @click="setImage(image.nome)">
            <img :src="'/storage/' + image.nome" alt="product image" style="width:100px">
          </div>
        </div>
      </div>
      <div class="product-details">
        <div class="price">
          <div class="sale" v-if="discount.data.ativo == 1">
            <h2>{{ getPrice }}€ Promo</h2>
            <h6>Antes:<s>{{ product.data.valor }}€</s></h6>
            <h6>Poupa:{{ (product.data.valor * discount.data.desconto).toFixed(2) }} €</h6>
          </div>
          <div class="sale" v-else>
            <h2>{{ product.data.valor }} €</h2>
          </div>
          <p>O preço inclui personalização</p>
        </div>
        <div class="shipping">
          <h5>Tempo médio de envio (BD tempo de envio)</h5>
        </div>
        <div class="details">
          <ul>
            <li v-for="detail in details.data">- {{ detail.descricao }}</li>
          </ul>
        </div>
      </div>
    </section>
    <section>
      <div class="product-description">
        <h3>Descrição geral ________________________________________________________________</h3>
        <h6>{{ product.data.meta_nome }}</h6>
        <p>{{ product.data.descricao }}</p>
      </div>
      <div class="sameCategory">
        <h3>Na mesma categoria _____________________________________________________________</h3>

        {{ sameCategory }}

        <card-component :products=categoryProducts.data :headTitle='false' :info="{
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
      categoryProducts: { data:[] }, 
      details: { data: [] },
      openImage: '',
      categoryProducts: { data: [] },
    }
  },
  methods: {
    setImage(image) {
      this.openImage = '/storage/' + image
    },
    getData() {
      let url = this.$store.state.Url + 'api/produto/' + this.id
      let urlImages = this.$store.state.Url + 'api/imagens_produto?filtro=produto_id:=:' + this.id
      let urlDetails = this.$store.state.Url + 'api/produto_detalhe?filtro=produto_id:=:' + this.id

      axios.get(url)
        .then(response => {
          this.product.data = response.data
          this.discount.data = response.data.desconto
          this.categoryId = response.data.categoria_id
          console.log(response.data)
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
    },
  },
  computed: {
    sameCategory(){
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
    getPrice(){
      let discount = this.discount.data.desconto
      let price = this.product.data.valor

      let sale = price - (price * discount)
      
      sale = sale.toFixed(2)
      return sale
    }
  },
  mounted() {
    this.getData()
    // console.log(this.id)
  }
}
</script>