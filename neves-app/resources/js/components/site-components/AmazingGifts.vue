<template>
  <div class="container">
    <div class="side-menu">
     <div class="categorys-area">
      <div class="category" v-for="category, index in categorys.data" :key="index">
      <a href="#" @click.prevent="categoryFilter()">{{ category.nome }}</a>
      </div>
     </div>
    </div>
    <div class="show-products">
      <h3>Produtos</h3>
      <card-component :products=products.data usedArea="home" :headTitle='true' :image=productsImages.data :info="{
        nome: false, meta_nome: false, categoria: true, materia: false, quantidade: true, valor: true
      }" :cart="false"></card-component>
      <h3>Imagens</h3>
      {{ productsImages }}
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      baseUrl: 'http://localhost:8000/api/',
      categorys: { data: [] },
      materials: { data: [] },
      products: { data: [] },
      productsImages: { data: [] },
    }
  },
  methods: {
    getData() {
      let urlCategory = this.baseUrl + 'categoria'
      let urlMaterial = this.baseUrl + 'materia'
      let urlProducts = this.baseUrl + 'produto'
      let urlImages = this.baseUrl + 'imagens_produto'

      // get all the categories
      axios.get(urlCategory)
        .then(response => {
          this.categorys.data = response.data
        })
        .catch(errors => {
          console.log(errors);
        })

      //get all the materials
      axios.get(urlMaterial)
        .then(response => {
          this.materials.data = response.data
        })
        .catch(errors => {
          console.log(errors);
        })

      //get all the products
      axios.get(urlProducts)
        .then(response => {
          this.products.data = response.data
        })
        .catch(errors => {
          console.log(errors);
        })

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
    this.getData()
  }
}
</script>