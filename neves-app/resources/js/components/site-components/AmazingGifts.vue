<template>
  <div class="container">
    <div class="side-menu">
     <div class="categorys-area">
      <div class="category" v-for="category, index in dinamycCategories" :key="index">
      <a href="#" @click.prevent="categoryFilter(category)">{{ category }}</a>
      </div>
     </div>
    </div>
    <div class="show-products">
      <h3 @click="getData()">Produtos</h3>
      <card-component :products=productsShownd.data usedArea="home" :headTitle='false' :image=productsImages.data :info="{
        nome: false, meta_nome: true, categoria: true, materia: false, quantidade: false, valor: true
      }" :cart="true"></card-component>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      baseUrl: 'http://localhost:8000/api/',
      categorys: { data: [] },
      ocasions: { data: [] },
      materials: { data: [] },
      products: { data: [] },
      productsShownd: {data: []},
      productsImages: { data: [] },
      ocasionsCategorys:[]
    }
  },
  methods: {
    categoryFilter(i){
      let categoryId = ''
      this.categorys.data.forEach(element=>{
        if(i == element.nome){
          categoryId = element.id
        }
        return categoryId

        
      })
      let urlProductFilter = 'http://127.0.0.1:8000/api/produto?filtro=categoria_id:=:'+ categoryId +':ocasioes_id:=:1'

      axios.get(urlProductFilter)
        .then(response => {
          this.productsShownd.data = response.data
        })
        .catch(errors => {
          console.log(errors);
        })

    },
    getData() {
      let urlCategory = this.baseUrl + 'categoria'
      let urlOcasion = this.baseUrl + 'ocasiao'
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

      // get all the ocasions
      axios.get(urlOcasion)
        .then(response => {
          this.ocasions.data = response.data
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
          this.productsShownd.data = response.data
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
  computed:{
    dinamycCategories(){ // dinamic categories withou ocasion
      let categorys = []
      this.products.data.forEach(element => {
        if(!categorys.includes(element.categoria.nome)){
          if(element.ocasioes.id == 1){
          categorys.push(element.categoria.nome)
          }
        }
      });
      return categorys;
      
    },
    dinamycOcasions(){ // dinamic ocasions 
      let ocasions = []
      this.products.data.forEach(element => {

        if(!ocasions.includes(element.ocasioes.nome)){
            ocasions.push(element.ocasioes.nome)
        }
      });
      return ocasions;
      
    },
    dinamycOcasionsCategorys(){
      this.products.data.map(element => {
        this.ocasionsCategorys.push({[element.ocasioes.nome] : element.categoria.nome})
      });
    }
    
  },
  mounted() {
    this.getData()
  }
}
</script>