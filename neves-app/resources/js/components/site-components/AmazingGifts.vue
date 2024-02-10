<template>
  <div class="container">
    <div class="side-menu">
      <div class="categorys-area">
        <div class="category" v-for="category, index in dinamycCategories" :key="index">
          <a href="#" @click.prevent="categoryFilter(category)">{{ category }}</a>
        </div>
      </div>
      <div class="ocasions-area">
        <div class="ocasion" v-for="ocasion, index in dinamycOcasions" :key="index">
          <a href="#" @click.prevent="ocasionFilter(ocasion)">{{ ocasion }}</a>
          <h3 class="menuIcon" @click.prevent='toogle(index)'>
            <img :src="active == true && id == index ? '/storage/images/Icons/LessIcon.png'
              : '/storage/images/Icons/PlusIcon.png'">
          </h3>
          <div class=" ocasionCategory" :class="{ show: id == index && active }"
            v-for="oc, ix in dinamycOcasionsCategorys" :key="ix">
            <a href="#" v-if="oc.ocasiao == ocasion" @click.prevent="ocasionCategoryFilter(oc.ocasiao, oc.categoria)">{{ oc.categoria }}</a>
          </div>
          <br>
        </div>
      </div>
      <div class="price-bar">
        <input type="range" :min="getMinPrice.minimo" :max="getMinPrice.maximo" v-model="priceRange" @change="barFilter()" class="slider" id="myRange">
      </div>

      {{ priceRange }}
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
      productsShownd: { data: [] },
      productsImages: { data: [] },
      priceRange: '0',
      minPrice:'',
      maxPrice:'',
      id: '',
      active: '',
    }
  },
  methods: {
    toogle(c) {
      //if the id have the same value of the index of menu
      if (this.id == c) {
        this.active = !this.active; //toogle the menu options
        this.id = c;// give the index value of the arrow correspondent to the menu option for validation later 
      }
      //if the id have diferent value from the index of menu
      if (this.id != c) {
        this.active = true; //opens the respective options from the menu clicked
        this.id = c;
      }
    },
    barFilter() {

      let minValue = this.getMinPrice.minimo

      let maxValue = this.priceRange

      let url = this.baseUrl + 'produto?intervalo=valor:'+ minValue + ':'+ maxValue

      axios.get(url)
        .then(response => {
          this.productsShownd.data = response.data
        })
        .catch(errors => {
          console.log(errors);
        })

    },

    categoryFilter(i) {
      let categoryId = ''
      this.categorys.data.forEach(element => {
        if (i == element.nome) {
          categoryId = element.id
        }
        return categoryId
      })
      
      let urlProductFilter = this.baseUrl + 'produto?filtro=categoria_id:=:' + categoryId + ':ocasioes_id:=:1'

      axios.get(urlProductFilter)
        .then(response => {
          this.productsShownd.data = response.data
        })
        .catch(errors => {
          console.log(errors);
        })

    },
    ocasionFilter(i) {
      let ocasionId = ''
      this.ocasions.data.forEach(element => {
        if (i == element.nome) {
          ocasionId = element.id
        }
        return ocasionId
      })

      let urlProductFilter = this.baseUrl + 'produto?filtro=ocasioes_id:=:' + ocasionId 

      axios.get(urlProductFilter)
        .then(response => {
          this.productsShownd.data = response.data
        })
        .catch(errors => {
          console.log(errors);
        })

    },
    ocasionCategoryFilter(i, e) {
      let categoryId = ''
      this.categorys.data.forEach(element => {
        if (e == element.nome) {
          categoryId = element.id
        }
        return categoryId
      })

      let ocasionId = ''
      this.ocasions.data.forEach(element => {
        if (i == element.nome) {
          ocasionId = element.id
        }
        return ocasionId
      })

      let urlProductFilter = this.baseUrl + 'produto?filtro=categoria_id:=:' + categoryId + ':ocasioes_id:=:' + ocasionId

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
  computed: {
    getMinPrice() {
      let prices = []
      
      this.products.data.forEach(element => {
        prices.push(element.valor)
      });

      let values = {'minimo' : Math.min(...prices), 'maximo': Math.max(...prices)}

      return values
    },
    dinamycCategories() { // dinamic categories withou ocasion
      let categorys = []
      this.products.data.forEach(element => {
        if (!categorys.includes(element.categoria.nome)) {
          if (element.ocasioes.id == 1) {
            categorys.push(element.categoria.nome)
          }
        }
      });
      return categorys;

    },
    dinamycOcasions() { // dinamic ocasions 
      let ocasions = []
      this.products.data.forEach(element => {

        if (!ocasions.includes(element.ocasioes.nome)) {
          ocasions.push(element.ocasioes.nome)
        }
      });
      return ocasions;

    },
    dinamycOcasionsCategorys() {
      let ocasionsCategorys = []

      this.products.data.map(element => {
        ocasionsCategorys.push({ 'ocasiao': element.ocasioes.nome, 'categoria': element.categoria.nome })
      }
      );

      //filter the array to remove duplicated objects
      ocasionsCategorys = ocasionsCategorys.filter((value, index, self) =>
        index === self.findIndex((t) => (
          t.ocasiao === value.ocasiao && t.categoria === value.categoria
        ))
      )

      return ocasionsCategorys;
    }

  },
  mounted() {
    this.getData()
  }
}
</script>