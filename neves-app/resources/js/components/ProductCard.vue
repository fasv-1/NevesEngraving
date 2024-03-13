<template>
  <!-- Modal -->

  <div class="card-box">
    <div class="card-prd" v-for="value, indexValue in products" :key="indexValue">
      <a :href="'/home/amazing_gifts/' + teste(value.id)" class="b-input">
        <div class="label-area" v-if="headTitle">
          <h4>{{ value.meta_nome }}</h4>
          <h6>ID{{ value.id }}</h6>
        </div>
        <div class="img-area">
          <div v-for="i, indexValue in  productsImages.data" :key="indexValue">
            <div class="img-cont" v-if="i.produto_id == value.id && i.posicao == 1">
              <img class="img-prd" :src="'/storage/' + i.nome" alt="">
            </div>
          </div>
        </div>
        <div class="info-area">
          <h6 v-if="info.nome">{{ value.nome }}</h6>
          <h3 v-if="info.meta_nome">{{ value.meta_nome }}</h3>
          <h5 v-if="info.categoria">{{ value.ocasioes_categoria_id }}</h5>
          <h5 v-if="info.materia">{{ value.materia_prima.nome }}</h5>
          <h5 v-if="info.quantidade">Quant.: {{ value.quantidade }} </h5>
          <div class="discount" v-if="info.valor">
            <div v-if="value.desconto.ativo == 1">
              <h2>{{ round(value.valor - (value.valor * value.desconto.desconto)) }} €</h2>
              <s><h6>{{ value.valor }} €</h6></s>

            </div>
            <div v-if="value.desconto.ativo == 0">
              <h2>{{ value.valor }} €</h2>
            </div>
          </div>

        </div>
        <div class="stars">
          <img src="/storage/images/Icons/5-stars.png" alt="5stars">
          <div class="bg-stars"></div>
        </div>
      </a>
      <div class="cart-btn" v-if="cart">
        <h6><b>Add to cart</b></h6>
      </div>
    </div>

  </div>
</template>

<script>
export default {
  props: ['products', 'headTitle', 'info', 'cart'],
  data() {
    return {
      productsImages: { data: [] },
    }
  },
  methods: {
    round(n) {
      let round = n.toFixed(2);

      return round
    },
    teste(id) {
      let idEncode = btoa(id)
      // console.log(this.products)
      // this.products.forEach(element => {
      //   idEncode 
      // });

      return idEncode
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
  mounted() {
    this.getImage()
  }

}
</script>