<template>
  <div class="product-content">

    <!---------------------- Product name as title and botton edit --------------------------->
    <div class="title-cont">
      <h2 class="titulo1">{{ product.data.nome }}</h2>
      <div>
        <a href="#updateProductModal"><img class="edit-btn" src="/storage/images/Icons/edit-square-icon.svg" alt=""></a>
        <a href="#deleteProductModal"><img class="delete-btn" src="/storage/images/Icons/delete.svg" style="width:40px" alt=""></a>
      </div>
    </div>
    <!---------------------------- End of Product name and meta-name ------------------------>

    <!------------------------------ Product input main image -------------------------------->
    <!--If exists an main product image-->
    <div class="input-form-image" v-if="productMainImage != ''">
      <label for="newImagem" class="form-label-img">
        <h3>Imagem principal</h3>
      </label>
      <div class="principal-image-preview">
        <div>
          <img :src="'/storage/' + productMainImage[0].nome">
        </div>
        <div class="image-btns">
          <button class="btn-remove" @click="removeImage(productMainImage[0].id)">Remover imagem</button>
        </div>
      </div>
    </div>

    <!--If doesn't exists an main product image-->
    <div class="input-form-image" v-else>
      <label for="newImagem" class="form-label-img">
        <h3>Imagem principal</h3>
      </label>
      <input-container id="newImage" titulo='Imgem principal' help="newImageHelp"
        helpText="Insira uma imagem de capa para o produto (não deve exceder 2mb)">
        <label class="imageButton">
          <input type="file" name="newImage" class="form-image" aria-describedby="newProductImage"
            placeholder="Nome do produto" @change="uploadMainImage($event)">
          <i>Carregar imagem</i>
        </label>
      </input-container>
      <div class="principal-image-preview">
        <img v-if="url" :src="url">
        <p v-if="mainImage != ''">Tamanho: {{ mbConversion }} MB</p>
      </div>
      <div class="image-cont-button">
        <button v-if="mainImage != ''" class="button-save" @click="saveImage('mainImage')">Adicionar imagem</button>
      </div>
    </div>
    <!----------------------------------- End of product input main image ------------------------------->

    <!----------------------------------- Product info --------------------------------------------------->
    <div class="product-information">
      <div class="sub-title">
        <h3 class="titulo2">{{ product.data.meta_nome }}</h3>
      </div>
      <div class="info-area">
        <div>
          <label for="ocasions">
            <h6>Ocasiões</h6>
          </label>
          <h4 name="ocasions" v-for="o in ocasions.data" :key="o.id">{{ o.id == product.data.ocasioes_id ? o.nome : ''
            }}
          </h4>
        </div>
        <div>
          <label for="categoria">
            <h6>Categoria</h6>
          </label>
          <h4 name="categoria" v-for="c in categorys.data" :key="c.id">{{ c.id == product.data.categoria_id ? c.nome :
        ''
            }}
          </h4>
        </div>
        <div>
          <label for="materia-prima">
            <h6>Matéria-prima</h6>
          </label>
          <h4 name="materia-prima" v-for="m in materials.data" :key="m.id">{{ m.id == product.data.materia_prima_id ?
        m.nome
        :
        ''
            }}</h4>
        </div>
        <div>
          <label for="desconto">
            <h6>Desconto</h6>
          </label>
          <h4 name="desconto" v-for="d in discounts.data" :key="d.id">{{ d.id == product.data.desconto_id ? d.nome : ''
            }}
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
        <div class="details-area">
          <div class="space-between mrgvert1">
            <label for="detalhes">
              <h6>Detalhes do produto:</h6>
            </label>
            <a href="#addDetailsModal">
              <h6><b>Adicionar detalhes +</b></h6>
            </a>
          </div>
          <ul >
            <li  class="space-between marginMinvert" v-for="detail, index in details.data" :key="index">
              <h4>- {{ detail.descricao }}</h4>
              <a href="" @click.prevent="removeDetail(detail.id)"><img class="delete-btn"
                  src="/storage/images/Icons/delete.svg" alt="" style="width: 20px;"></a>
            </li>
          </ul>

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

    <!--If exists images of the product already charged -->
    <div class="product-images" v-if="productImages != ''">
      <label for="Images" class="form-label-img">
        <h3>Imagens do produto</h3>
      </label>
      <div class="images-preview" v-if="productImages != ''">
        <div class="preview-cont" v-for="i, indexValue in productImages" :key="indexValue">
          <img :src="'/storage/' + i.nome">
          <button class="btn-remove" @click="removeImage(i.id)">Remover imagem</button>
        </div>
      </div>
    </div>

    <!-- Input to add new images -->
    <div class="input-product-images">
      <label for="newImages" class="form-label-img">
        <h3>Adicionar imagens novas</h3>
      </label>
      <input-container id="newImage" title='' help="newImageHelp"
        helpText="Insira uma ou várias imagens para o produto (o tamanho das imagens não deve exceder os 2MB)">
        <label class="imageButton">
          <input type="file" name="newImage" class="form-image" aria-describedby="newProductImage"
            placeholder="Nome do produto" @change="uploadImages($event)">
          <i>Carregar imagem</i>
        </label>
      </input-container>
      <div class="images-preview brd-grey" v-if="urlImages != ''">
        <div class="preview-cont" v-for="(urlImage, index) in urlImages" :key="index">
          <img v-if="urlImage" :src="urlImage">
          <p v-if="urlImages">Tamanho:{{ ((this.images[index][0].size / 1024) / 1024).toFixed(2) }} MB</p>
          <button class="btn-remove ms-input" @click="deleteImage(index)">Eliminar</button>
        </div>
      </div>
      <div class="image-cont-button">
        <button v-if="urlImages != ''" class="button-save" @click="saveImage('images')">Adicionar imagens</button>
      </div>
    </div>
    <!----------------------------------- End of product images inputs ----------------------------->

    <!----------------------------Modal to update the product-------------------------------------->
    <modal-component id="updateProductModal" title="Atualizar produto">
      <template v-slot:alerts>
        <alert-component tipe="danger" :details="$store.state.transaction"
          v-if="$store.state.transaction.status == 'error-add'"></alert-component>
        <alert-component tipe="success" :details="$store.state.transaction.message"
          v-if="$store.state.transaction.status == 'added'"></alert-component>
      </template>
      <template v-slot:content>
        <div class="container-inputs">
          <div class="input-form-names">
            <input-container id="productName" title="Nome" help="productNameHelp" helpText="Nome do produto"
              size="m-input">
              <input type="text" class="long-name" :placeholder="product.data.nome" name="productName"
                aria-describedby="productName" v-model="updateProduct.name">
            </input-container>

            <input-container id="productMetaName" title="Meta-Nome" help="productMetaNameHelp"
              helpText="Nome abreviado do produto">
              <input type="text" name="productMetaName" :placeholder="product.data.meta_nome"
                aria-describedby="productMetaName" v-model="updateProduct.metaName">
            </input-container>
          </div>
          <div class="select-options">
            <input-container id="ocasion" title="Ocasião" help="ocasionHelp" helpText="Escolha uma ocasião">
              <select name="ocasion" v-model="updateProduct.ocasion">
                <option value="" disabled>Escolhe uma</option>
                <option v-for="o in ocasions.data" :key="o.id" :value="o.id"
                  :selected="o.id == product.data.categoria_id ? true : false">{{ o.nome }}</option>
              </select>
            </input-container>

            <input-container id="category" title="Categoria" help="categoryHelp" helpText="Escolha uma categoria">
              <select name="category" v-model="updateProduct.category">
                <option value="" disabled>Escolhe uma</option>
                <option v-for="c in categorys.data" :key="c.id" :value="c.id"
                  :selected="c.id == product.data.categoria_id ? true : false">{{ c.nome }}</option>
              </select>
            </input-container>


            <input-container id="material" title="Materia-prima" help="materialHelp"
              helpText="Escolha uma matéria-prima">
              <select name="material" v-model="updateProduct.material">
                <option value="" disabled>Escolhe uma</option>
                <option v-for="m in materials.data" :key="m.id" :value="m.id"
                  :selected="m.id == product.data.materia_prima_id ? true : false">{{ m.nome }}</option>
              </select>
            </input-container>

            <input-container id="discount" title="Desconto" help="discountHelp" helpText="Escolha um desconto">
              <select name="materials" v-model="updateProduct.discount">
                <option value="" disabled>Escolhe uma</option>
                <option v-for="d in discounts.data " :key="d.id" :value="d.id"
                  :selected="d.id == product.data.discount_id ? true : false">{{ d.nome }}</option>
              </select>
            </input-container>

            <input-container id="customization" title="Costumização" help="costumizationHelp"
              helpText="Caso seja possível costumizar">
              <input type="checkbox" name="customization" class="form-checkbox" aria-describedby="customization"
                :checked="product.data.costumizavel == 1 ? 'checked' : ''" v-model="updateProduct.customization">
            </input-container>
          </div>

          <div class="input-form-names">
            <input-container id="description" title="Descrição do produto" help="descriptionHelp"
              helpText="Descrição do produto" size="ml-input">
              <textarea name="description" aria-describedby="description" :placeholder="product.data.descricao"
                v-model="updateProduct.description">
            </textarea>
            </input-container>
          </div>

          <div class="select-options">
            <input-container id="quantity" title="Quantidade do produto" help="quantityHelp"
              helpText="Quantidade deste produto que pretende adicionar">
              <input type="number" name="quantity" aria-describedby="quantity" :placeholder="product.data.quantidade"
                v-model="updateProduct.quantity" class="s-input">
            </input-container>

            <input-container id="price" title="Preço do produto " help="priceHelp"
              helpText="Preço do produto (sem taxas, nem descontos)">
              <input type="number" name="price" aria-describedby="price" class="s-input"
                :placeholder="product.data.valor" v-model="updateProduct.price">
            </input-container>
          </div>
        </div>
      </template>

      <template v-slot:footer>
        <button class="button-save" @click="update()">Atualizar</button>
      </template>

    </modal-component>
    <!-----------------------------------------------End of modal to update new products---------------------------------------------->

    <!----------------------------Modal to delete the product-------------------------------------->
    <modal-component id="deleteProductModal" title="Eliminar produto">
      <template v-slot:alerts>
        <alert-component tipe="danger" :details="$store.state.transaction"
          v-if="$store.state.transaction.status == 'error-add'"></alert-component>
        <alert-component tipe="success" :details="$store.state.transaction.message"
          v-if="$store.state.transaction.status == 'added'"></alert-component>
      </template>
      <template v-slot:content>
        <div>
          <h4>Tem a certeza que pretende eliminar este produto?</h4>
          <br />
          <p>Ao eliminar este produto, irá eliminar também todas a imagens associadas a ele.</p>
        </div>
      </template>

      <template v-slot:footer>
        <button class="button-save" @click="remove()">Eliminar</button>
      </template>

    </modal-component>
    <!-----------------------------------------------End of modal to delete new products---------------------------------------------->

    <!----------------------------Modal add details to product-------------------------------------->
    <modal-component id="addDetailsModal" title="Adiconar novo detalhe">
      <template v-slot:alerts>
        <alert-component tipe="danger" :details="$store.state.transaction"
          v-if="$store.state.transaction.status == 'error-add'"></alert-component>
      </template>
      <template v-slot:content>
        <input-container id="descricao" title="Detalhe " help="descricao"
          helpText="Descrição do detalhe como irá aparecer em publico" size="ml-input">
          <textarea name="descricao" aria-describedby="descricao" v-model="addDetail"></textarea>
        </input-container>
      </template>

      <template v-slot:footer>
        <button class="button-save" @click="detail()">Adicionar</button>
      </template>

    </modal-component>
    <!-----------------------------------------------End of modal to delete new products---------------------------------------------->

    <!-- Calls the computed method to separate the images by posicion-->
    {{ separateImages }}
    <!-- End of call computed -->
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
      productAllImages: [],
      productMainImage: [],
      productImages: [],
      categorys: { data: [] },
      details: { data: [] },
      ocasions: { data: [] },
      materials: { data: [] },
      discounts: { data: [] },
      mainImage: [],
      images: [],
      addDetail: '',
      url: '',
      urlImages: [],
      productImages: '',
      updateProduct: {
        name: '',
        metaName: '',
        ocasion: '',
        category: '',
        material: '',
        discount: '',
        customization: '',
        description: '',
        quantity: '',
        price: '',
      },

    }
  },
  methods: {
    uploadMainImage(e) { //variable with main image object
      this.mainImage = e.target.files[0];
      this.url = URL.createObjectURL(this.mainImage); //creats an url to preview a loaded image
      // console.log(this.mainImage);
    },

    uploadImages(x) { //variable with product images object
      let productImages = x.target.files;
      this.images.push(productImages);
      this.urlImages.push(URL.createObjectURL(productImages[0]));
      // console.log(this.images);
      // console.log(this.urlImages);
    },

    deleteImage(del) { // delete the pre-set images from the array of product images
      this.images.splice(del, 1);
      this.urlImages.splice(del, 1);
    },

    getProduct() { //gets the product clicked
      let urlProducts = this.urlBase + 'produto/' + this.id;

      console.log(urlProducts)

      axios.get(urlProducts)
        .then(response => {
          this.product.data = response.data
        })
        .catch(errors => {
          console.log(errors);
        })
    },

    getProductImages() { //gets the respective main image if exists

      let urlProductImages = this.urlBase + 'imagens_produto?filtro=produto_id:=:' + this.id;

      axios.get(urlProductImages)
        .then(response => {
          this.productAllImages = response.data
        })
        .catch(errors => {
          console.log(errors);
        })
    },

    loadDetails() {
      let urlDetails = this.urlBase + 'produto_detalhe?filtro=produto_id:=:' + this.id;

      axios.get(urlDetails)
        .then(response => {
          this.details.data = response.data
          console.log(this.details)
        })
        .catch(errors => {
          console.log(errors);
        })
    },
    detail() {
      let urlDetails = this.urlBase + 'produto_detalhe'

      let formData = new FormData()
      formData.append('descricao', this.addDetail)
      formData.append('produto_id', this.id)

      let config = {
        headers: {
          'Content-Type': 'multipart/form-data',
          'Accept': 'application/json'
        }
      }

      axios.post(urlDetails, formData, config)
        .then(response => {
          this.$store.state.transaction.status = 'added'
          this.$store.state.transaction.message = response.data.msg
          this.addDetail = ''
          this.loadDetails()
          history.back()
        })
        .catch(errors => {
          this.$store.state.transaction.status = 'error-add'
          this.$store.state.transaction.message = errors.response.data.message
          console.log(errors.response.data)
        })

    },

    removeDetail(id) {
      let url = this.urlBase + 'produto_detalhe/' + id;

      let formData = new FormData();
      formData.append('_method', 'delete')

      axios.post(url, formData)
        .then(response => {
          this.$store.state.transaction.status = 'removed'
          this.$store.state.transaction.message = response.data.msg
          this.loadDetails()
        })
        .catch(errors => {
          this.$store.state.transaction.status = 'error-remove'
          this.$store.state.transaction.message = errors.response.data.message
        })
    },

    loadCategory() { //load all the categories
      let urlCategory = this.urlBase + 'categoria';

      axios.get(urlCategory)
        .then(response => {
          this.categorys.data = response.data
          // console.log(this.categorys)
        })
        .catch(errors => {
          console.log(errors);
        })
    },

    loadOcasions() { //load all the categories
      let urlOcasion = this.urlBase + 'ocasiao';

      axios.get(urlOcasion)
        .then(response => {
          this.ocasions.data = response.data
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
          this.materials.data = response.data

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
          this.discounts.data = response.data

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

        if (this.mainImage.size < 2097152) {

          formData.append('nome', this.mainImage);
          formData.append('posicao', 1);
          formData.append('produto_id', this.id);

          axios.post(urlImages, formData, config)
            .then(response => {
              this.$store.state.transaction.status = 'added'
              this.$store.state.transaction.message = response.data.msg
              this.url = ''
              alert(response.data.msg)
              this.getProductImages()
            })
            .catch(errors => {
              this.$store.state.transaction.status = 'error-add'
              this.$store.state.transaction.message = errors.response.data.message
              this.mainImage = []
              this.url = ''
              console.log(errors.response.data)

            })
        } else {
          alert('A imagem carregada é demasiado grande, o maximo permitido é 2MB')
        }
      }

      if (this.images && i == 'images') {
        this.images.forEach(element => {

          if (element[0].size < 2097152) {
            formData.append('nome', element[0]);
            formData.append('posicao', 2);
            formData.append('produto_id', this.id);

            axios.post(urlImages, formData, config)
              .then(response => {
                this.$store.state.transaction.status = 'added'
                this.$store.state.transaction.message = response.data.msg
                this.urlImages = []
                this.images = []
                alert(response.data.msg)
                this.getProductImages()
              })
              .catch(errors => {
                this.$store.state.transaction.status = 'error-add'
                this.$store.state.transaction.message = errors.response.data.message
                this.urlImages = []
                this.images = []
                alert(errors.response.data.message)
              })
          } else {
            alert('a imagem ' + element[0].name + ' é demasiado grande')
          }
        });

      }
    },
    removeImage(id) {
      let url = this.urlBase + 'imagens_produto/' + id;
      // console.log(url)
      let confirmation = confirm('Tem a certeza que pertende eliminar esta imagem?')
      if (confirmation) {
        let formData = new FormData();
        formData.append('_method', 'delete')

        axios.post(url, formData)
          .then(response => {
            this.$store.state.transaction.status = 'removed'
            this.$store.state.transaction.message = response.data.msg
            this.mainImage = []
            this.getProductImages()
          })
          .catch(errors => {
            console.log(errors.response.data)
            this.$store.state.transaction.status = 'error-remove'
            this.$store.state.transaction.message = errors.response.data.message
          })
      }
    },
    update() {
      let url = this.urlBase + 'produto/' + this.id

      let formData = new FormData();
      formData.append('_method', 'patch')

      if (this.updateProduct.name != '') {
        formData.append('nome', this.updateProduct.name);
      }
      if (this.updateProduct.metaName != '') {
        formData.append('meta_nome', this.updateProduct.metaName);
      }
      if (this.updateProduct.quantity != '') {
        formData.append('quantidade', this.updateProduct.quantity);
      }
      if (this.updateProduct.description != '') {
        formData.append('descricao', this.updateProduct.description);
      }
      if (this.updateProduct.price != '') {
        let value = this.updateProduct.price.toFixed(2);
        formData.append('valor', value);
      }
      if (this.updateProduct.customization == true) {
        let customization = 1;
        formData.append('costumizavel', customization);
      }
      if (this.updateProduct.customization == false) {
        let customization = 0;
        formData.append('costumizavel', customization);
      }


      if (this.updateProduct.ocasion != '') {
        formData.append('ocasioes_id', this.updateProduct.ocasion);
      }
      if (this.updateProduct.category != '') {
        formData.append('categoria_id', this.updateProduct.category);
      }
      if (this.updateProduct.material != '') {
        formData.append('materia_prima_id', this.updateProduct.material);
      }
      if (this.updateProduct.discount != '') {
        formData.append('desconto_id', this.updateProduct.discount);
      }

      // console.log(url)

      let config = {
        headers: {
          'Content-Type': 'x-www-form-urlencoded',
          'Accept': 'application/json'
        }
      }

      axios.post(url, formData, config)
        .then(response => {

          this.$store.state.transaction.status = 'updated'
          this.$store.state.transaction.message = response.data.msg
          alert(response.data.msg)
          this.updateProduct.name = ''
          this.updateProduct.metaName = ''
          this.updateProduct.quantity = ''
          this.updateProduct.description = ''
          this.updateProduct.price = ''
          this.updateProduct.customization = ''
          this.updateProduct.ocasion = ''
          this.updateProduct.category = ''
          this.updateProduct.material = ''
          this.updateProduct.discount = ''
          this.getProduct();
          history.back()

        })
        .catch(errors => {
          console.log('erro de atualização', errors.response.data)
          this.$store.state.transaction.status = 'error-update'
          this.$store.state.transaction.message = errors.response.data
          this.updateProduct.name = ''
          this.updateProduct.metaName = ''
          this.updateProduct.quantity = ''
          this.updateProduct.description = ''
          this.updateProduct.price = ''
          this.updateProduct.customization = ''
          this.updateProduct.ocasion = ''
          this.updateProduct.category = ''
          this.updateProduct.material = ''
          this.updateProduct.discount = ''
        })
    },
    remove() {
      let url = this.urlBase + 'produto/' + this.id

      if (this.productAllImages) {
        this.productAllImages.forEach(element => {
          this.removeImage(element.id)
        });
      }

      if (this.details.data != '') {
        this.details.data.forEach(element => {
          this.removeDetail(element.id)
        });
      }

      let formData = new FormData();
      formData.append('_method', 'delete')

      axios.post(url, formData)
        .then(response => {
          this.$store.state.transaction.status = 'removed'
          this.$store.state.transaction.message = response.data.msg
          alert(response.data.msg)
          window.location.href = 'http://127.0.0.1:8000/dashboard/produtos';
        })
        .catch(errors => {
          console.log(errors.response.data)
          this.$store.state.transaction.status = 'error-remove'
          this.$store.state.transaction.message = errors.response.data.message
        })

    },


  },
  computed: {
    mbConversion() {
      if (this.mainImage != '') {
        let $convers = (this.mainImage.size / 1024) / 1024
        $convers = $convers.toFixed(2)
        return $convers
      }
    },
    separateImages() {
      let mainImage = []
      let images = []
      this.productAllImages.forEach(e => {

        if (e.posicao == 1) {
          mainImage.push(e)
        } else {
          images.push(e)
        }
      })

      this.productMainImage = mainImage
      this.productImages = images
    },
  },
  mounted() {
    this.getProduct();
    this.loadCategory();
    this.loadDiscounts();
    this.loadMaterials();
    this.getProductImages();
    this.loadOcasions();
    this.loadDetails()
  }
}
</script>