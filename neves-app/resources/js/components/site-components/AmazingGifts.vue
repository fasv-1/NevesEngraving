<template>
  <div class="site-container">
    <div class="algo">
      <div class="side-menu">
        <div class="categorys-area">
          <h5 class="group-title">Categorys</h5>
          <a class="category" href="#" @click.prevent="getProducts()">All</a>
          <div class="category" v-for="category, index in dinamycCategories" :key="index">
            <a href="#" @click.prevent="categoryFilter(category)">{{ category }}</a>
          </div>
        </div>
        <div class="ocasions-area">
          <h5 class="group-title">Ocasions</h5>
          <div class="ocasion" v-for="ocasion, index in dinamycOcasions" :key="index">
            <div class="ocs">
              <a href="#" @click.prevent="ocasionFilter(ocasion)">{{ ocasion }}</a>
              <h3 class="menu-icon" @click.prevent='toogle(index)'>
                <img :src="active == true && id == index ? '/storage/images/Icons/LessIcon.png'
                  : '/storage/images/Icons/PlusIcon.png'">
              </h3>
            </div>
            <div class=" ocasionCategory" :class="{ show: id == index && active }"
              v-for="oc, ix in dinamycOcasionsCategorys" :key="ix">
              <a href="#" v-if="oc.ocasiao == ocasion" @click.prevent="ocasionCategoryFilter(oc.ocasiao, oc.categoria)">{{
                oc.categoria }}</a>
            </div>
            <br>
          </div>
        </div>
        <div class="price-bar">
          <h5 class="group-title">Price filter</h5>
          <div class="bar-caption">
            <p>{{ getPrice.minimo }}€</p>
            <svg width="50%" height="100%" viewBox="0 0 906 270" fill="none" xmlns="http://www.w3.org/2000/svg">
              <line y1="133.5" x2="906" y2="133.5" stroke="black" stroke-width="3" />
              <line x1="454.5" y1="34" x2="454.5" y2="230" stroke="black" stroke-width="3" />
              <line x1="228" y1="70" x2="228" y2="200" stroke="black" stroke-width="3" />
              <line x1="681" y1="70" x2="681" y2="200" stroke="black" stroke-width="3" />
            </svg>
            <p>{{ (getPrice.minimo + getPrice.maximo) / 2 }}€</p>
            <svg width="50%" height="100%" viewBox="0 0 906 270" fill="none" xmlns="http://www.w3.org/2000/svg">
              <line y1="133.5" x2="906" y2="133.5" stroke="black" stroke-width="3" />
              <line x1="454.5" y1="34" x2="454.5" y2="230" stroke="black" stroke-width="3" />
              <line x1="228" y1="70" x2="228" y2="200" stroke="black" stroke-width="3" />
              <line x1="681" y1="70" x2="681" y2="200" stroke="black" stroke-width="3" />
            </svg>
            <p>{{ getPrice.maximo }}€</p>

          </div>
          <input type="range" :min="getPrice.minimo" :max="getPrice.maximo" v-model="priceRange" @change="barFilter()"
            class="slider" id="priceRange">
        </div>
      </div>
    </div>
    <div class="show-products">
      <h3>Gifts</h3>
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
      categoria: '',
      ocasiao: '',
      ocasiaoCategoria: '',
      maxPrice: '',
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
      let minValue = this.getPrice.minimo

      let maxValue = this.priceRange

      let url = this.baseUrl + 'produto?intervalo=valor:' + minValue + ':' + maxValue

      localStorage.setItem('priceRange', maxValue)

      axios.get(url)
        .then(response => {
          this.productsShownd.data = response.data
        })
        .catch(errors => {
          console.log(errors);
        })

    },

    categoryFilter(i) {
      localStorage.clear()
      let categoryId = ''

      this.categorys.data.forEach(element => {
        if (i == element.nome) {
          categoryId = element.id
        }
        return categoryId
      })

      localStorage.setItem('category', categoryId)

      this.localStorage()
    },
    ocasionFilter(i) {
      localStorage.clear()
      let ocasionId = ''
      this.ocasions.data.forEach(element => {
        if (i == element.nome) {
          ocasionId = element.id
        }
        return ocasionId
      })

      localStorage.setItem('ocasion', ocasionId)

      this.localStorage()
    },

    ocasionCategoryFilter(i, e) {
      localStorage.clear()

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

      localStorage.setItem('ocasiondaCategory', ocasionId)
      localStorage.setItem('ocasionCategory', categoryId)

      this.localStorage()
    },

    getProducts() {
      localStorage.clear()

      let urlProducts = this.baseUrl + 'produto'

      axios.get(urlProducts)
        .then(response => {
          this.products.data = response.data
          this.productsShownd.data = response.data
        })

    },

    getData() {
      let urlCategory = this.baseUrl + 'categoria'
      let urlOcasion = this.baseUrl + 'ocasiao'
      let urlMaterial = this.baseUrl + 'materia'
      let urlProducts = this.baseUrl + 'produto'
      let urlImages = this.baseUrl + 'imagens_produto'

      // localStorage.clear()


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
          // this.productsShownd.data = response.data
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
    localStorage() {
      let categoria = localStorage.getItem("category");
      let ocasiao = localStorage.getItem("ocasion");
      let ocasiaoCategoria = localStorage.getItem("ocasionCategory");
      let ocasiaodaCategoria = localStorage.getItem("ocasiondaCategory");

      console.log(categoria)
      console.log(ocasiao)
      console.log(ocasiaoCategoria)
      console.log(ocasiaodaCategoria)

      if (categoria != null) {

        let urlProductFilter = this.baseUrl + 'produto?filtro=categoria_id:=:' + categoria + ':ocasioes_id:=:1'

        axios.get(urlProductFilter)
          .then(response => {
            this.productsShownd.data = response.data
          })
          .catch(errors => {
            console.log(errors);
          })
      } else if (ocasiao != null) {

        let urlProductFilter = this.baseUrl + 'produto?filtro=ocasioes_id:=:' + ocasiao

        axios.get(urlProductFilter)
          .then(response => {
            this.productsShownd.data = response.data
          })
          .catch(errors => {
            console.log(errors);
          })

      } else if (ocasiaoCategoria != null) {

        let urlProductFilter = this.baseUrl + 'produto?filtro=categoria_id:=:' + ocasiaoCategoria + ':ocasioes_id:=:' + ocasiaodaCategoria

        axios.get(urlProductFilter)
          .then(response => {
            this.productsShownd.data = response.data
          })
          .catch(errors => {
            console.log(errors);
          })

      } else {
        let urlProducts = this.baseUrl + 'produto'

        axios.get(urlProducts)
          .then(response => {
            this.productsShownd.data = response.data
          })
          .catch(errors => {
            console.log(errors);
          })
      }
    },
  },

  computed: {
    getPrice() {
      let prices = []

      this.products.data.forEach(element => {
        prices.push(element.valor)
      });

      let values = { 'minimo': Math.min(...prices), 'maximo': Math.max(...prices) }

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
    this.localStorage()
  }
}
</script>