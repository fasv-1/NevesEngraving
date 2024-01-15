<template>
  <div class="product-content">

    <!---------------------- Product name as title and botton edit --------------------------->
    <div class="title-cont">
      <h2 class="titulo1">{{ product.data.nome }}</h2>
      <a href=""><img src="/storage/images/Icons/edit-square-icon.svg" alt=""></a>
    </div>
    <!---------------------------- End of Product name and meta-name ------------------------>

    <!------------------------------ Product input main image -------------------------------->
    <!--If exists an main product image-->
    <div class="input-form-image" v-if="productMainImage.data != ''">
      <label for="newImagem" class="form-label-img">
        <h3>Imagem principal</h3>
      </label>
      <div class="principal-image-preview">
        <img :src="'/storage/' + productMainImage.data[0].nome">
      </div>
      <div class="image-btns">
        <button class="btn-remove ms-input" @click="removeImage()">Remover imagem</button>
      </div>
    </div>

    <!--If doesn't exists an main product image-->
    <div class="input-form-image" v-else>
      <label for="newImagem" class="form-label-img">
        <h3>Imagem principal</h3>
      </label>
      <input-container id="newImage" titulo='Imgem principal' help="newImageHelp"
        helpText="Insira uma imagem de destaque para o produto">
        <label class="imageButton">
          <input type="file" name="newImage" class="form-image" aria-describedby="newProductImage"
            placeholder="Nome do produto" @change="uploadMainImage($event)">
          <i>Carregar imagem</i>
        </label>
      </input-container>
      <div class="principal-image-preview">
        <img v-if="url" :src="url">
      </div>
      {{ mainImage.size }}
      <button v-if="mainImage != '' " class="btn-view ms-input" @click="saveImage('mainImage')">Adicionar imagem</button>
    </div>
    <!----------------------------------- End of product input main image ------------------------------->

    <!----------------------------------- Product info --------------------------------------------------->
    <div class="product-info">
      <div class="sub-title">
        <h3 class="titulo2">{{ product.data.meta_nome }}</h3>
      </div>
      <div class="info-area">
        <div>
          <label for="categoria">
            <h6>Categoria</h6>
          </label>
          <h4 name="categoria" v-for="c in categorys" :key="c.id">{{ c.id == product.data.categoria_id ? c.nome : '' }}
          </h4>
        </div>
        <div>
          <label for="materia-prima">
            <h6>Matéria-prima</h6>
          </label>
          <h4 name="materia-prima" v-for="m in materials" :key="m.id">{{ m.id == product.data.materia_prima_id ? m.nome
            :
            ''
          }}</h4>
        </div>
        <div>
          <label for="desconto">
            <h6>Desconto</h6>
          </label>
          <h4 name="desconto" v-for="d in discounts" :key="d.id">{{ d.id == product.data.desconto_id ? d.nome : '' }}
          </h4>
        </div>
        <div>
          <label for="costumizavel">
            <h6>Costumizável</h6>
          </label>
          <h4>{{ product.data.costumizavel == 1 ? 'Sim' : 'Não' }}</h4>
        </div>
      </div>
      <div class="input-form-names">
        <div>
          <label for="descrição">
            <h6>Descrição</h6>
          </label>
          <h4>{{ product.data.descricao }}</h4>
        </div>
      </div>
      <div class="info-area">
        <div>
          <label for="quantidade">
            <h6>Quantidade</h6>
          </label>
          <h4>{{ product.data.quantidade }} un</h4>
        </div>
        <div>
          <label for="preço">
            <h6>Preço</h6>
          </label>
          <h4>{{ product.data.valor }}€</h4>
        </div>
      </div>
    </div>
    <!----------------------------------- End of product info ------------------------------->

    <!----------------------------------- Product images inputs ----------------------------->
    <div class="input-product-images">
      <label for="newImagem" class="form-label-img">
        <h3>Imagens do produto</h3>
      </label>
      <input-container id="newImage" titulo='Imgem principal' help="newImageHelp"
        helpText="Insira uma ou várias imagens para o produto">
        <label class="imageButton">
          <input type="file" name="newImage" class="form-image" aria-describedby="newProductImage"
            placeholder="Nome do produto" @change="uploadImages($event)">
          <i>Carregar imagem</i>
        </label>
      </input-container>
      <div class="images-preview">
        <div class="preview-cont" v-for="(urlImage, index) in urlImages" :key="index">
          <img v-if="urlImage" :src="urlImage">
          <button class="btn-remove ms-input" @click="deleteImage(index)">Eliminar</button>
        </div>
      </div>
    </div>
    <!----------------------------------- End of product images inputs ----------------------------->
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
      productMainImage: { data: [] },
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
    uploadMainImage(e) { //variable with main image object
      this.mainImage = e.target.files[0];
      this.url = URL.createObjectURL(this.mainImage); //creats an url to preview a loaded image
      console.log(this.mainImage);
    },

    uploadImages(x) { //variable with product images object
      let productImages = x.target.files;
      this.images.push(productImages);
      this.urlImages.push(URL.createObjectURL(productImages[0]));
      //  console.log(this.urlImages);
    },

    deleteImage(del) { // delete the pre-set images from the array of product images
      this.images.splice(del, 1);
      this.urlImages.splice(del, 1);
    },

    getProduct() { //gets the product clicked
      let urlProducts = this.urlBase + 'produto/' + this.id;

      // console.log(urlProducts)
      axios.get(urlProducts)
        .then(response => {
          this.product.data = response.data
          // console.log(response.data)
        })
        .catch(errors => {
          console.log(errors);
        })
    },

    getProductMainImage() { //gets the respective main image if exists
      let urlProductMainImage = this.urlBase + 'imagens_produto?filtro=produto_id:=:' + this.id;
      axios.get(urlProductMainImage)
        .then(response => {
          this.productMainImage.data = response.data
          // console.log(response.data)
        })
        .catch(errors => {
          console.log(errors);
        })
    },

    loadCategory() { //load all the categories
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

    loadMaterials() { //load all the materials
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

    loadDiscounts() { //load all the disconts
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

    saveImage(i) { //validating the right area, saves all the product images (area set by the parameter passed)
      let urlImages = this.urlBase + 'imagens_produto';

      let formData = new FormData();

      let config = {
        headers: {
          'Content-Type': 'multipart/form-data',
          'Accept': 'application/json'
        }
      }

      if (this.mainImage && i == 'mainImage') {
        formData.append('nome', this.mainImage);
        formData.append('posicao', 1);
        formData.append('produto_id', this.id);

        axios.post(urlImages, formData, config)
          .then(response => {
            this.$store.state.transaction.status = 'added'
            this.$store.state.transaction.message = response.data.msg
            this.url = ''
            alert(response.data.msg)
            this.getProductMainImage()
          })
          .catch(errors => {
            this.$store.state.transaction.status = 'error-add'
            this.$store.state.transaction.message = errors.response.data.message
            this.mainImage = []
            alert(errors.response.data.message)

          })
      }

      if (this.images && i == 'images') {
        this.images.forEach(e => {
          formData.append('nome', e[0]);
          formData.append('posicao', 2);
          formData.append('produto_id', 1);


          axios.post(urlImages, formData, config)
            .then(response => {
              this.$store.state.transaction.status = 'added'
              this.$store.state.transaction.message = response.data.msg
            })
            .catch(errors => {
              this.$store.state.transaction.status = 'error-add'
              this.$store.state.transaction.message = errors.response.data.message
              alert(errors.response.data)
            })
        });
      }
    },
    removeImage() {
      let url = this.urlBase + 'imagens_produto/' + this.productMainImage.data[0].id;
      // console.log(url)
      let confirmation = confirm('Tem a certeza que pertende eliminar esta imagem?')
      if (confirmation) {
        console.log('chegamos aqui')

        let formData = new FormData();
        formData.append('_method', 'delete')

        axios.post(url, formData)
          .then(response => {
            this.$store.state.transaction.status = 'removed'
            this.$store.state.transaction.message = response.data.msg
            alert(response.data.msg)
            this.mainImage = []
            this.getProductMainImage()
          })
          .catch(errors => {
            console.log(errors.response.data)
            this.$store.state.transaction.status = 'error-remove'
            this.$store.state.transaction.message = errors.response.data.message
          })
      }
    }

  },
  mounted() {
    this.getProduct();
    this.loadCategory();
    this.loadDiscounts();
    this.loadMaterials();
    this.getProductMainImage()
  }
}
</script>