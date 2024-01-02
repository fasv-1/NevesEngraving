<template>
  <div class="card-prd-dash" v-for="value, indexValue in products.data" :key="indexValue">
    <div class="label-area">
      <h1>{{ value.nome }}</h1>
      <h3>{{ value.id }}</h3>
    </div>
    <div class="img-area" v-for="i, indexValue in mainImage.data" :key="indexValue">
      <div class="img-cont" v-if="i.produto_id == value.id"> 
        <img class="img-prd-dash" :src="'/storage/' + i.nome " alt="">
      </div>
    </div>
    <div class="category-area" v-for="c, indexValue in categorias" :key="indexValue">
      <h5>{{ c.id == value.categoria_id ? c.nome : ''}}</h5>
    </div>
    <div class="info-area">
      <h5> {{ value.quantidade }} </h5>
      <h5> {{ value.valor }} </h5>
    </div>
  </div>

</template>

<script>
export default {
  data() {
    return {
      urlBase: 'http://127.0.0.1:8000/api/',
      categorias: [],
      materials: [],
      discount: [],
      products: { data: [] },
      mainImage: { data: [] },
    }
  },
    methods: {
    loadCategory() {
      let urlCategory = this.urlBase + 'categoria';

      axios.get(urlCategory)
        .then(response => {
          this.categorias = response.data

          // console.log(this.categorias)
        })
        .catch(errors => {
          console.log(errors);
        })
    },
    loadMaterials() {
      let urlMaterials = this.urlBase + 'materia';

      axios.get(urlMaterials)
        .then(response => {
          this.materials = response.data

          // console.log(this.materials)
        })
        .catch(errors => {
          console.log(errors);
        })
    },
    loadDiscounts() {
      let urlDiscounts = this.urlBase + 'desconto';
      axios.get(urlDiscounts)
        .then(response => {
          this.discount = response.data

          // console.log(this.discount)
        })
        .catch(errors => {
          console.log(errors);
        })
    },
    loadProducts() {
      let urlProducts = this.urlBase + 'produto';
      axios.get(urlProducts)
        .then(response => {
          this.products.data = response.data
        })
        .catch(errors => {
          console.log(errors);
        })
    },
    loadImages() {
      let urlImages = this.urlBase + 'imagens_produto';
      axios.get(urlImages)
        .then(response => {
          this.mainImage.data = response.data
        })
        .catch(errors => {
          console.log(errors);
        })
    },
  },
  mounted() {
    this.loadCategory();
    this.loadMaterials();
    this.loadDiscounts();
    this.loadProducts();
    this.loadImages();
  }
}
</script>