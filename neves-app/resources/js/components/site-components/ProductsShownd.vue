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
          <div class="min-image" v-for=" image,index in productImages.data " :key="index" @click = "setImage(image.nome)">
            <img :src="'/storage/' + image.nome" alt="product image" style="width:100px">
          </div>
        </div>
      </div>
      <div class="product-details">
        <div class="price"></div>
        <div class="shipping"></div>
        <div class="details"></div>
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
      openImage: '',
    }
  },
  methods: {
    setImage(image){
      this.openImage = '/storage/'+ image
    },
    getData() {
      let url = this.$store.state.Url + 'api/produto/' + this.id
      let urlImages = this.$store.state.Url + 'api/imagens_produto?filtro=produto_id:=:' + this.id

      axios.get(url)
        .then(response => {
          this.product.data = response.data
          // console.log(response)
        })
        .catch(errors => {
          console - log(errors)
        })

      axios.get(urlImages)
        .then(response => {
          this.productImages.data = response.data
          // console.log(response)
        })
        .catch(errors => {
          console - log(errors)
        })
    }
  },
  computed:{
    firstImage(){
      let image = []
      this.productImages.data.forEach(e=>{
        if(e.posicao == 1){
        image.push(e.nome)
        }
      })
      // console.log(image[0])
      return '/storage/' + image[0]
    }
  },
  mounted() {
    this.getData()
    // console.log(this.id)
  }
}
</script>