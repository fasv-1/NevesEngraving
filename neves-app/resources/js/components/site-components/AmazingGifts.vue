<template>
  <div class="gifts-container">

    <div class="menu-container" :class = "openMenu == true ? 'open': ''">
      <!-----------------------------------------Side menu--------------------------------------------->
      <div class="side-menu" >
        <div class="categorys-area">
          <h5 class="group-title">Categorys</h5>
          <a class="category" :class="'All' == linkcliked ? 'high-link' : ''" href="#"
            @click.prevent="getProducts()">All</a>
          <div class="category" v-for="category, index in dinamycCategories" :key="index">
            <a href="#" :class="category == linkcliked ? 'high-link' : ''" @click.prevent="categoryFilter(category)">{{
            category }}</a>
          </div>
        </div>
        <div class="ocasions-area">
          <h5 class="group-title">Ocasions</h5>
          <div class="ocasion" v-for="ocasion, index in  dinamycOcasions" :key="index">
            <div class="ocs">
              <a href="#" :class="ocasion == linkcliked ? 'high-link' : ''" @click.prevent="ocasionFilter(ocasion)">{{
            ocasion }}</a>
              <h3 class="menu-icon" @click.prevent='toogle(index)'>
                <img :src="active == true && id == index ? '/storage/images/Icons/LessIcon.png'
            : '/storage/images/Icons/PlusIcon.png'">
              </h3>
            </div>
            <div class="ocasionCategory" :class="{ show: id == index && active }"
              v-for="oc, ix in dinamycOcasionsCategorys" :key="ix">
              <a href="#" :class="oc.ocasiao + '/' + oc.categoria == linkcliked ? 'high-link' : ''"
                v-if="oc.ocasiao == ocasion" @click.prevent="ocasionCategoryFilter(oc.ocasiao, oc.categoria)">{{
            oc.categoria }}</a>
            </div>
            <br>
          </div>
        </div>

        <div class="materials-area">
          <h5 class="group-title">Materials</h5>
          <div class="materials" v-for="material, index in materials.data" :key="index">
            <a href="#" :class="material.nome == linkcliked ? 'high-link' : ''"
              @click.prevent="materialFilter(material.id, material.nome)">{{ material.nome }}</a>
          </div>
        </div>
        <div class="price-bar">
          <h5 class="group-title">Price filter</h5>
          <input type="range" :min="getPrice.minimo" :max="getPrice.maximo" v-model="priceRange" @change="barFilter()"
            class="slider" id="priceRange">
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

        </div>

        <div class="discount-area">
          <h5 class="group-title">Discounts</h5>
          <div class="discounts" v-for="discount, index in discounts.data" :key="index">
            <a href="" :class="discount.nome == linkcliked ? 'high-link' : ''" class="discount"
              @click.prevent="discountFilter(discount.id, discount.nome)">{{ discount.ativo == 1 ? discount.nome : ''
              }}</a>
          </div>
        </div>

      </div>
      <div class="gift-btn" @click="openMenu = !openMenu">
        <h5>F</h5>
        <h5>I</h5>
        <h5>L</h5>
        <h5>T</h5>
        <h5>E</h5>
        <h5>R</h5>
        <h5>S</h5>
      </div>
    </div>
    
    <!-----------------------------------------Area where the products are showned--------------------------------------------->
    <div class="show-products">
      <div class="show-header">
        <h3>{{ linkcliked }}</h3>
        <select name="orderby" id="orderby" @change="orderBy()" v-model="order">
          <option value="" disabled>Order By</option>
          <option value="valor:asc">Price asc</option>
          <option value="valor:desc">Price desc</option>
          <option value="nome:asc">Name asc</option>
          <option value="nome:desc">Name desc</option>
          <option value="created_at:desc">Added recently</option>
        </select>
        
      </div>
      <div class="cart-empty text-red" v-if="productsShownd.data == ''">
        <h1>Não existem produtos</h1>
      </div>
      <!----------------------------------------- Cards with products --------------------------------------------->
      <card-component :products=productsShownd.data :headTitle='false' :info="{
            nome: false, meta_nome: true, categoria: false, materia: false, quantidade: false, valor: true
          }" :cart="true"></card-component>

      <!----------------------------------------- Pagination --------------------------------------------->
      <div class="pagination">
        <ul v-if="productsShownd.data != ''">
          <li v-for="pages, index in pagination.links" :key="index">
            <a href="" v-if="pages.label != index && index == 0" @click.prevent="localStorage(pages.url)">{{ '<' }}</a>
                <a href="" v-if="pages.label == index && pages.url != null"
                  :class="pages.active == true ? 'high-link' : ''" @click.prevent="localStorage(pages.url)">{{
            pages.label }}</a>
                <a href="" v-if="pages.label != index && index != 0" @click.prevent="localStorage(pages.url)">{{ '>'
                  }}</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      baseUrl: this.$store.state.Url + 'api/',
      categorys: { data: [] },
      ocasions: { data: [] },
      materials: { data: [] },
      discounts: { data: [] },
      products: { data: [] },
      productsShownd: { data: [] },
      priceRange: '0',
      categoria: '',
      ocasiao: '',
      ocasiaoCategoria: '',
      maxPrice: '',
      id: '',
      active: '',
      pagination: [],
      linkcliked: 'All',
      order: '',
      openMenu: false,
    }
  },
  methods: {
    orderBy() { 
      let orderBy = this.order

      localStorage.setItem('order', orderBy)

      this.localStorage()
    },
    toogle(c) {
      //if the id have the same value of the index on menu
      if (this.id == c) {
        this.active = !this.active; //toogle the menu options
        this.id = c;// give the index value of the correspondent menu option for validation later 
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

      localStorage.setItem('minValue', minValue)
      localStorage.setItem('maxValue', maxValue)

      this.localStorage()
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

      // this.linkcliked = i

      localStorage.setItem('category', categoryId)
      localStorage.setItem('linkcliked', i)

      this.localStorage()
    },

    materialFilter(i, e) {
      localStorage.clear()
      // this.linkcliked = e
      let materialId = i

      localStorage.setItem('linkcliked', e)

      localStorage.setItem('material', materialId)

      this.localStorage()
    },

    discountFilter(i, e) {
      localStorage.clear()
      // this.linkcliked = e
      let discountId = i

      localStorage.setItem('linkcliked', e)

      localStorage.setItem('discount', discountId)

      this.localStorage()
    },

    ocasionFilter(i) {
      localStorage.clear()
      // this.linkcliked = i
      localStorage.setItem('linkcliked', i)
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

      // this.linkcliked = i + '/' + e
      // this.linkcliked = i + '/' + e
      localStorage.setItem('linkcliked', i + '/' + e)

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

      this.linkcliked = 'All'

      if (this.priceRange != '0') {

        localStorage.setItem('minValue', this.getPrice.minimo)
        localStorage.setItem('maxValue', this.priceRange)

      }

      this.localStorage()

    },

    getData() {
      let urlCategory = this.baseUrl + 'categoria'
      let urlOcasion = this.baseUrl + 'ocasiao'
      let urlMaterial = this.baseUrl + 'materia'
      let urlDiscount = this.baseUrl + 'desconto'
      let urlProducts = this.baseUrl + 'produto'

      // get all the discounts
      axios.get(urlDiscount)
        .then(response => {
          this.discounts.data = response.data
        })
        .catch(errors => {
          console.log(errors);
        })
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
          this.products.data = response.data.all
        })
        .catch(errors => {
          console.log(errors);
        })

    },
    localStorage(url) { //build the queries and save's them in local storage (when the browser reloads, don't lose the search)
      let categoria = localStorage.getItem("category");
      let ocasiao = localStorage.getItem("ocasion");
      let ocasiaoCategoria = localStorage.getItem("ocasionCategory");
      let ocasiaodaCategoria = localStorage.getItem("ocasiondaCategory");
      let material = localStorage.getItem("material");
      let minValue = localStorage.getItem("minValue");
      let maxValue = localStorage.getItem("maxValue");
      let desconto = localStorage.getItem("discount");
      let order = localStorage.getItem("order");
      let linkcliked = localStorage.getItem("linkcliked");

      let urlProducts = this.baseUrl + 'produto?page=1'

      //changes the url to change the pages
      if (url != null) {
        urlProducts = url
      }

      //gets the products only filtred by the price-bar 
      if (categoria == null && ocasiao == null && ocasiaoCategoria == null && maxValue != null && material == null && order == null) {

        urlProducts = urlProducts + '&intervalo=valor:' + minValue + ':' + maxValue
        this.priceRange = maxValue
      }

      //gets the products only filtred by order
      if (categoria == null && ocasiao == null && ocasiaoCategoria == null && maxValue == null && material == null && order != null) {

        urlProducts = urlProducts + '&orderby=' + order

      }

      //gets the products filtred by material, and if is set, price-bar
      if (material != null) {
        this.linkcliked = linkcliked 
        urlProducts = urlProducts + '&filtro=materia_prima_id:=:' + material

        if (this.priceRange != '0') {
          urlProducts = urlProducts + '&intervalo=valor:' + this.getPrice.minimo + ':' + this.priceRange
          localStorage.setItem('maxValue', this.priceRange)
        }

        if (maxValue != null && this.priceRange == '0') {
          this.priceRange = maxValue
          urlProducts = urlProducts + '&intervalo=valor:' + minValue + ':' + maxValue
        }

        if (this.order != '') {
          urlProducts = urlProducts + '&orderby=' + this.order
          localStorage.setItem('order', this.order)
        }

        if (this.order == '' && order != null) {
          urlProducts = urlProducts + '&orderby=' + order
          this.order = order
        }
      }
      //gets the products filtred by material, and if is set, price-bar
      if (desconto != null) {
        this.linkcliked = linkcliked 
        urlProducts = urlProducts + '&filtro=desconto_id:=:' + desconto

        if (this.priceRange != '0') {
          urlProducts = urlProducts + '&intervalo=valor:' + this.getPrice.minimo + ':' + this.priceRange
          localStorage.setItem('maxValue', this.priceRange)
        }

        if (maxValue != null && this.priceRange == '0') {
          this.priceRange = maxValue
          urlProducts = urlProducts + '&intervalo=valor:' + minValue + ':' + maxValue
        }

        if (this.order != '') {
          urlProducts = urlProducts + '&orderby=' + this.order
          localStorage.setItem('order', this.order)
        }

        if (this.order == '' && order != null) {
          urlProducts = urlProducts + '&orderby=' + order
          this.order = order
        }
      }

      //gets the products filtred by category, and if is set, price-bar
      if (categoria != null) {
        this.linkcliked = linkcliked 
        urlProducts = urlProducts + '&filtro=categoria_id:=:' + categoria + ':ocasioes_id:=:1'

        if (this.priceRange != '0') {
          urlProducts = urlProducts + '&intervalo=valor:' + this.getPrice.minimo + ':' + this.priceRange
          localStorage.setItem('maxValue', this.priceRange)
        }

        if (maxValue != null && this.priceRange == '0') {
          this.priceRange = maxValue
          urlProducts = urlProducts + '&intervalo=valor:' + minValue + ':' + maxValue
        }

        if (this.order != '') {
          urlProducts = urlProducts + '&orderby=' + this.order
          localStorage.setItem('order', this.order)
        }

        if (this.order == '' && order != null) {
          urlProducts = urlProducts + '&orderby=' + order
          this.order = order
        }
      }

      //gets the products filtred by ocasion, and if is set, price-bar
      if (ocasiao != null) {
        this.linkcliked = linkcliked 
        urlProducts = urlProducts + '&filtro=ocasioes_id:=:' + ocasiao

        if (this.priceRange != '0') {
          urlProducts = urlProducts + '&intervalo=valor:' + this.getPrice.minimo + ':' + this.priceRange
          localStorage.setItem('maxValue', this.priceRange)
        }

        if (maxValue != null && this.priceRange == '0') {
          this.priceRange = maxValue
          urlProducts = urlProducts + '&intervalo=valor:' + minValue + ':' + maxValue
        }

        if (this.order != '') {
          urlProducts = urlProducts + '&orderby=' + this.order
          localStorage.setItem('order', this.order)
        }

        if (this.order == '' && order != null) {
          urlProducts = urlProducts + '&orderby=' + order
          this.order = order
        }
      }

      //gets the products filtred by category ocasion, and if is set, price-bar
      if (ocasiaoCategoria != null) {
        this.linkcliked = linkcliked 
        urlProducts = urlProducts + '&filtro=categoria_id:=:' + ocasiaoCategoria + ':ocasioes_id:=:' + ocasiaodaCategoria

        if (this.priceRange != '0') {
          urlProducts = urlProducts + '&intervalo=valor:' + this.getPrice.minimo + ':' + this.priceRange
          localStorage.setItem('maxValue', this.priceRange)
        }

        if (maxValue != null && this.priceRange == '0') {
          this.priceRange = maxValue
          urlProducts = urlProducts + '&intervalo=valor:' + minValue + ':' + maxValue
        }

        if (this.order != '') {
          urlProducts = urlProducts + '&orderby=' + this.order
          localStorage.setItem('order', this.order)
        }

        if (this.order == '' && order != null) {
          urlProducts = urlProducts + '&orderby=' + order
          this.order = order
        }

      }

      console.log(urlProducts)
      //gets the products and sets the pagination
      axios.get(urlProducts)
        .then(response => {
          this.productsShownd.data = response.data.paginated.data
          this.pagination = response.data.paginated
        })
        .catch(errors => {
          console.log(errors);
        })
    },
  },

  computed: {
    getPrice() { // get the min and max price based on the products add
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