<template>
  <!--Product filter area-->
  <div class="title-cont">
    <h1 class="titulo">Produtos</h1>
  </div>
  <div class="space-between">
    <h4>Pesquisar produtos</h4>
    <div class="marg-r">
      <a class="high-link" href="#addProductModal">Adicionar novo produto +</a>
    </div>
  </div>

  <div class="product-filters">
    <!-- Category filter -->
    <input-container id="Todos" title='Todos' help="productHelp" helpText="Carregar todos os produtos">
      <button class="button1" @click="loadProducts()">Todos os produtos</button>
    </input-container>
    <div></div>
    <!-- End category filter-->
    <!-- Category filter -->
    <input-container id="category" title='Por categoria' help="categoryHelp" helpText="Filtrar produtos por categoria">
      <select id="category" v-model="categoryFilter" @change= "filtro(categoryFilter,1)">
        <option v-for="c in categorys" :key="c.id" :value="c.id" >{{ c.nome }}</option>
      </select>
    </input-container>
    <div></div>
    <!-- End category filter-->
    <!-- Materials filter-->
    <input-container id="materials" title='Por materia-prima' help="materialsHelp"
      helpText="Filtrar produtos por matéria-prima">
      <select id="materials" v-model="materialFilter" @change= "filtro(materialFilter,2)">
        <option v-for="m in materials" :key="m.id" :value="m.id">{{ m.nome }}</option>
      </select>
    </input-container>
    <!--End Materials filter-->
    <!-- By name filter-->
      <input-container id="Search" title='Procurar por nome' help="SearchHelp" helpText="Filtrar produtos por nome"
        size="">
        <input type="text" id="Search" placeholder="Nome do produto" class="long-name" v-model="nameFilter" >
      </input-container>
      <button class="button1" @click="filtro(nameFilter,3)">Procurar</button>
    <!--End Materials filter-->
  </div>
  <!--End of Product filter area-->
  <!--Products display-->
  <div class="card-box">

    <div class="card-prd-dash" v-for="value, indexValue in products.data" :key="indexValue">
      <router-link :to="'/dashboard/produtos/' + value.id" class="b-input">
          <div class="label-area">
            <h4>{{ value.meta_nome }}</h4>
            <h6>ID{{ value.id }}</h6>
          </div>
          <div class="img-area">
            <div v-for="i, indexValue in mainImage.data" :key="indexValue">
              <div class="img-cont" v-if="i.produto_id == value.id && i.posicao == 1">
                <img class="img-prd-dash" :src="'/storage/' + i.nome" alt="">
              </div>
            </div>
          </div>
          <div class="category-area" >
            <h5>{{value.categoria.nome }}</h5>
          </div>
          <div class="info-area">
            <h5>Quant.: {{ value.quantidade }} </h5>
            <h6> Preço: {{ value.valor }} €</h6>
          </div>
      </router-link>
    </div>
  </div>
  <!--End of Products display-->
  <!--Modal to add new products-->
  <modal-component id="addProductModal" title="Adicionar novo produto">
    <template v-slot:alerts>
      <alert-component tipe="danger" :details="$store.state.transaction"
        v-if="$store.state.transaction.status == 'error-add'"></alert-component>
      <alert-component tipe="success" :details="$store.state.transaction.message"
        v-if="$store.state.transaction.status == 'added'"></alert-component>
    </template>
    <template v-slot:content>
      <div class="container-inputs">
        <div class="input-form-names">
          <input-container id="productName" title="Nome" help="productNameHelp" helpText="Nome do produto" size="m-input">
            <input type="text" class="long-name" name="productName" aria-describedby="productName"
              v-model="newProduct.name">
          </input-container>

          <input-container id="productMetaName" title="Meta-Nome" help="productMetaNameHelp"
            helpText="Nome abreviado do produto">
            <input type="text" name="productMetaName" aria-describedby="productMetaName" v-model="newProduct.metaName">
          </input-container>
        </div>
        <div class="select-options">
          <input-container id="category" title="Categoria" help="categoryHelp" helpText="Escolha uma categoria">
            <select name="category" v-model="newProduct.category" required>
              <option value="" disabled>Escolhe uma</option>
              <option v-for="c in categorys" :key="c.id" :value="c.id">{{ c.nome }}</option>
            </select>
          </input-container>

          <input-container id="material" title="Materia-prima" help="materialHelp" helpText="Escolha uma matéria-prima">
            <select name="material" v-model="newProduct.material" required>
              <option value="" disabled>Escolhe uma</option>
              <option v-for="m in materials" :key="m.id" :value="m.id">{{ m.nome }}</option>
            </select>
          </input-container>

          <input-container id="discount" title="Desconto" help="discountHelp" helpText="Escolha um desconto">
            <select name="materials" v-model="newProduct.discount" required>
              <option value="" disabled>Escolhe uma</option>
              <option v-for="d in discounts " :key="d.id" :value="d.id">{{ d.nome }}</option>
            </select>
          </input-container>

          <input-container id="customization" title="Costumização" help="costumizationHelp"
            helpText="Caso seja possível costumizar">
            <input type="checkbox" name="customization" class="form-checkbox" aria-describedby="customization"
              v-model="newProduct.customization">
          </input-container>
        </div>

        <div class="input-form-names">
          <input-container id="description" title="Descrição do produto" help="descriptionHelp"
            helpText="Descrição do produto" size="mb-input">
            <textarea name="description" aria-describedby="description" v-model="newProduct.description">
            </textarea>
          </input-container>
        </div>

        <div class="select-options">
          <input-container id="quantity" title="Quantidade do produto" help="quantityHelp"
            helpText="Quantidade deste produto que pretende adicionar">
            <input type="number" name="quantity" aria-describedby="quantity" v-model="newProduct.quantity"
              class="small-field">
          </input-container>

          <input-container id="price" title="Preço do produto " help="priceHelp"
            helpText="Preço do produto (sem taxas, nem descontos)">
            <input type="number" name="price" aria-describedby="price" v-model="newProduct.price" class="small-field">
          </input-container>
        </div>
      </div>
    </template>

    <template v-slot:footer>
      <button class="button-save" @click="save()">Adicionar</button>
    </template>

  </modal-component>
  <!--End of modal to add new products-->
</template>

<script>
export default {
  data() {
    return {
      urlBase: 'http://127.0.0.1:8000/api/',
      newProduct: {
        name: '',
        metaName: '',
        category: '',
        material: '',
        discount: '',
        customization: false,
        description: '',
        quantity: '',
        price: '',
      },
      categorys: { data: [] },
      materials: { data: [] },
      discounts: { data: [] },
      products: { data: [] },
      mainImage: { data: [] },
      categoryFilter:'',
      materialFilter:'',
      nameFilter:'',
    }
  },
  methods: {
    filtro(f,n){
      if(n == 1){

      let urlProducts = this.urlBase + 'produto?filtro=categoria_id:=:'+ f;

      axios.get(urlProducts)
        .then(response => {
          this.products.data = response.data
          // console.log(response.data)
        })
        .catch(errors => {
          console.log(errors);
        })
      }

      if(n == 2){
        let urlProducts = this.urlBase + 'produto?filtro=materia_prima_id:=:'+ f;
        axios.get(urlProducts)
        .then(response => {
          this.products.data = response.data
          // console.log(response.data)
        })
        .catch(errors => {
          console.log(errors);
        })
      }

      if(n == 3){
        let urlProducts = this.urlBase + 'produto?filtro=nome:like:%'+ f +'%';
        axios.get(urlProducts)
        .then(response => {
          this.products.data = response.data
          // console.log(response.data)
        })
        .catch(errors => {
          console.log(errors);
        })
      }

      
    },
    loadCategory() {
      let urlCategory = this.urlBase + 'categoria';

      axios.get(urlCategory)
        .then(response => {
          this.categorys = response.data

          // console.log(this.categorys)
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
          this.discounts = response.data

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
          // console.log(response.data)
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
    save() {
      let url = this.urlBase + 'produto';

      if (this.newProduct.customization == true) {
        this.newProduct.customization = 1
      } else {
        this.newProduct.customization = 0
      }

      let formData = new FormData();

      formData.append('nome', this.newProduct.name);
      formData.append('meta_nome', this.newProduct.metaName);
      formData.append('quantidade', this.newProduct.quantity);
      formData.append('descricao', this.newProduct.description);

      if (this.newProduct.price) {
        formData.append('valor', this.newProduct.price.toFixed(2));
      } else {
        formData.append('valor', this.newProduct.price);
      }
      formData.append('costumizavel', this.newProduct.customization);
      formData.append('categoria_id', this.newProduct.category);
      formData.append('materia_prima_id', this.newProduct.material);
      formData.append('desconto_id', this.newProduct.discount);

      let config = {
        headers: {
          'Content-Type': 'x-www-form-urlencoded',
          'Accept': 'application/json'
        }
      }

      axios.post(url, formData, config)
        .then(response => {
          this.$store.state.transaction.status = 'added';
          this.$store.state.transaction.message = response.data.msg;
          console.log(response.data.msg);
          this.newProduct.name = '';
          this.newProduct.metaName = '';
          this.newProduct.quantity = '';
          this.newProduct.description = '';
          this.newProduct.price = '';
          this.newProduct.customization = '';
          this.newProduct.category = '';
          this.newProduct.material = '';
          this.newProduct.discount = '';
          alert(response.data.msg);
          this.loadProducts();
          history.back();
        })
        .catch(errors => {
          this.$store.state.transaction.status = 'error-add'
          this.$store.state.transaction.message = errors.response.data.message
          console.log(errors.response.data.message)
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