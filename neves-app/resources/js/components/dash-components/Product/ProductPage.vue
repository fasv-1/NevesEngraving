<template>
  <div class="producContent">
    <!-- {{saveId($route.params.id)}} -->
    <div class="conteiner">
      <!-- Product name and meta-name -->
      <div class="title-cont">
        <h1 class="titulo2">{{ product.data.nome }}</h1>
        <h2 class="titulo2">{{ product.data.meta_nome }}</h2>
      </div>
      <!-- End of Product name and meta-name -->

      <!-- Product input main image -->
      <div class="input-form-image">
        <input-container id="newImage" titulo='Imgem principal' help="newImageHelp"
          helpText="Insira uma imagem de destaque para o produto">
          <label class="imageButton">
            <input type="file" name="newImage" class="form-image" aria-describedby="newProductImage"
              placeholder="Nome do produto" @change="uploadMainImage($event)">
            <i>Carregar imagem</i>
          </label>
        </input-container>
        <div class="image-preview">
          <img v-if="url" :src="url">
        </div>
      </div>
      <!-- End of product input main image -->

      <div class="select-options">
        <label for="categoria">
          <h4>Categoria</h4>
        </label>
        <h6 name="categoria" v-for="c in categorys" :key="c.id">{{ c.id == product.data.categoria_id ? c.nome : '' }}</h6>
        <br>
        <label for="materia-prima">
          <h4>Matéria-prima</h4>
        </label>
        <h6 name="materia-prima" v-for="m in materials" :key="m.id">{{ m.id == product.data.materia_prima_id ? m.nome : ''
        }}</h6>
        <br>
        <label for="desconto">
          <h4>Desconto</h4>
        </label>
        <h6 name="desconto" v-for="d in discounts" :key="d.id">{{ d.id == product.data.desconto_id ? d.nome : '' }}</h6>
      </div>
      <br>
      <div class="input-form-names">
        <label for="descrição">
          <h4>Descrição</h4>
        </label>
        <h6>{{ product.data.descricao }}</h6>
      </div>
      <br>
      <div class="select-options">
        <label for="quantidade">
          <h4>Quantidade</h4>
        </label>
        <h6>{{ product.data.quantidade }}</h6>
        <br>
        <label for="preço">
          <h4>Preço</h4>
        </label>
        <h6>{{ product.data.valor }}€</h6>
        <br>
        <label for="costumizavel">
          <h4>Costumizável</h4>
        </label>
        <h6>{{ product.data.costumizavel == 1 ? 'Sim' : 'Não' }}</h6>
      </div>
    </div>
    <br>
    <!--Product images inputs-->
    <div class="input-product-images">
      <label for="newImagem" class="form-label-img">
        <h4>Imagens do produto</h4>
      </label>
      <div class="input-images">
        <label class="imageButton">
          <input type="file" name="newImagem" class="form-imagem" aria-describedby="newProductImage"
            placeholder="Nome do produto" @change="uploadImages($event)">
          <i>Carregar imagem</i>
        </label>
      </div>
      <div class="image-preview">
        <div class="image-preview" v-for="(urlImage, index) in urlImages" :key="index">
          <img v-if="urlImage" :src="urlImage">
          <button @click="deleteImage(index)">Eliminar</button>
        </div>
      </div>
      <div id="help" class="form-help-img">Selecione uma ou várias imagens do produto</div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    id: {
      required: true,
      type: Number,
    }
  },
  data() {
    return {
      urlBase: 'http://127.0.0.1:8000/api/',
      product: { data: [] },
      categorys: { data: [] },
      materials: { data: [] },
      discounts: { data: [] },
      mainImage: [],
      images: [],
      url: '',
      urlImages: [],
      productImages: '',

    }
  },
  methods: {
    uploadMainImage(e) {
      this.mainImage = e.target.files[0];
      this.url = URL.createObjectURL(this.mainImage); //cria um url para a imagem carregada
    },
    uploadImages(x) {
      let productImages = x.target.files;
      this.images.push(productImages);
      this.urlImages.push(URL.createObjectURL(productImages[0]));
      //  console.log(this.urlImages);
    },
    deleteImage(del) {
      this.images.splice(del, 1);
      this.urlImages.splice(del, 1);
    },
    getProduct() {
      let urlProducts = this.urlBase + 'produto/' + this.id;

      console.log(urlProducts)
      axios.get(urlProducts)
        .then(response => {
          this.product.data = response.data
          console.log(response.data)
        })
        .catch(errors => {
          console.log(errors);
        })
    },
    loadCategory() {
      let urlCategory = this.urlBase + 'categoria';

      axios.get(urlCategory)
        .then(response => {
          this.categorys = response.data
          console.log(this.categorys)
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

  },
  mounted() {
    this.getProduct();
    this.loadCategory();
    this.loadDiscounts();
    this.loadMaterials();
  }
}
</script>