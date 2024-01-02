<template>
  <div class="productInputContent">
    <div class="container-inputs">
      <!--Product names inputs-->
      <div class="input-form-names">
        <input-container id="newName" titulo='Nome' help="nameHelp" helpText="Insira o nome do produto">
          <input type="text" id="newName" name="newName" class="form-text" aria-describedby="newNameProduct"
            placeholder="Nome do produto" v-model="newName">
        </input-container>
        <input-container id="newMetaName" titulo='Meta-Nome' help="MetaNameHelp"
          helpText="Insira um meta-nome para o produto">
          <input type="text" id="newMetaName" name="newMetaName" class="form-text" aria-describedby="MetaName"
            placeholder="Nome abreviado para aparecer em destaque" v-model="newMetaName">
        </input-container>
      </div>

      <!--Product image input-->
      
    </div>

    <div class="container-inputs">
      <!--Product selects inputs -->
      <!-- Category -->
      <div class="select-options">
        <input-container id="category" titulo='Categoria' help="categoryHelp"
          helpText="Escolha uma categoria para o produto">
          <select name="category" id="category" v-model="categoryValue">
            <option v-for="c in categorias" :key="c.id" :value="c.id">{{ c.nome }}</option>
          </select>
        </input-container>
        <!-- End category -->
        <!-- Materials -->
        <input-container id="materials" titulo='Materia-prima' help="materialsHelp"
          helpText="Escolha uma matéria-prima para o produto">
          <select name="materials" v-model="materialsValue">
            <option v-for="m in materials" :key="m.id" :value="m.id">{{ m.nome }}</option>
          </select>
        </input-container>
        <!--End Materials-->
        <!--Discounts-->
        <input-container id="discount" titulo='Desconto' help="discountHelp"
          helpText="Escolha um desconto para o produto">
          <select name="discount" v-model="discountValue">
            <option v-for="d in discount" :key="d.id" :value="d.id">{{ d.nome }}</option>
          </select>
        </input-container>
        <!--End Discounts-->

        <div class="customization-form">
          <label for="costumization" class="form-label"> Customização</label>
          <input type="checkbox" id="customization" class="form-checkbox" aria-describedby="customization"
            v-model="customizationValue">
          <div id="help" class="form-help">Selecione se for possivel costumizar</div>
        </div>

      </div>
      <!--Product description input-->
      <div class="input-form-description">
        <input-container id="description" titulo='Descrição' help="descriptionHelp"
          helpText="Adicione uma descrição para o produto">
          <textarea id="description" class="form-longtext" aria-describedby="description"
            v-model="description"></textarea>
        </input-container>
      </div>
      <!--Product images inputs-->
      <div class="input-product-images">
        <label for="newImagem" class="form-label-img"> Imagens do produto </label>
        <div class="input-images">
          <label class="imageButton">
            <input type="file" id="newImagem" name="newImagem" class="form-imagem" aria-describedby="newProductImage"
              placeholder="Nome do produto" @change="uploadImages($event)">
            <i>Carregar imagem</i>
          </label>
        </div>
        <div class="image-preview" v-for="(urlImage, index) in urlImages" :key="index">
          <img v-if="urlImage" :src="urlImage">
          <button @click="deleteImage(index)">Eliminar</button>
        </div>
        <div id="help" class="form-help-img">Selecione uma ou várias imagens do produto</div>
      </div>
    </div>

    <div class="container-inputs">
      <!--Product values inputs-->
      <div class="product-values">
        <input-container id="quantity" titulo='Quantidade' help="quantityHelp"
          helpText="Quantos produtos irá adicionar em stock?">
          <input type="number" id="quantity" name="quantity" class="input-value" min="0" step="1" v-model="quantityValue">
        </input-container>
        <input-container id="price" titulo='Preço' help="priceHelp"
          helpText="Qual o valor deste produto (sem taxas, nem custos, apenas o produto)">
          <input type="number" id="price" name="price" class="input-value" aria-describedby="valordoproduto"
            v-model="priceValue">
        </input-container>
      </div>
    </div>
    <div class="button-product">
      <button type="button" class="button-save" @click="save()">Salvar</button>
    </div>
  </div>
  <!-- Add Images Modal  -->
  <!-- Start table to show the products-->
  <table-component :data="products.data" :view="{ visible: true, dataTarget: '#modalProductView' }"
    :update="{ visible: false, dataTarget: '#modalDiscountUpdate' }"
    :remove="{ visible: false, dataTarget: '#modalDiscountRemove' }" :titles="{
      id: { title: 'ID', type: 'text' },
      nome: { title: 'Nome', type: 'text' },
    }">
  </table-component>
  <!-- End table to show the products-->
  <!-- Start modal to update categorys-->
  <modal-component id="modalProductView" title="Adicionar imagens">
        <template v-slot:alerts>
          <alert-component tipe="danger" :details="$store.state.transaction.message"
            v-if="$store.state.transaction.status == 'error-update'"></alert-component>
        </template>
        <template v-slot:content>
          <h1>{{ $store.state.item.id }}</h1>
          <h1>{{ $store.state.item.nome }}</h1>

          <div class="input-form-image">
        <input-container id="newImage" titulo='Imgem principal' help="newImageHelp"
          helpText="Insira uma imagem de destaque para o produto">
          <label class="imageButton">
            <input type="file" id="newImage" name="newImage" class="form-image" aria-describedby="newProductImage"
              placeholder="Nome do produto" @change="uploadMainImage($event)">
            <i>Carregar imagem</i>
          </label>
        </input-container>
        <div class="image-preview">
          <img v-if="url" :src="url">
        </div>
      </div>
        </template>

        <template v-slot:footer>
          <button @click="saveImage('mainImage')">Adicionar imagem</button>
          <!--The seconde parameter defines the endpoint for the url-->
        </template>

      </modal-component>
</template>

<script>

export default {
  props: ['id', 'title', 'metaTitle'],
  data() {
    return {
      urlBase: 'http://127.0.0.1:8000/api/',
      newName: '',
      newMetaName: '',
      categoryValue: '',
      materialsValue: '',
      discountValue: '',
      customizationValue: false,
      description: '',
      quantityValue: '',
      priceValue: '',
      mainImage: [],
      images: [],
      url: '',
      urlImages: [],
      productImages: '',
      statusTransition: '',
      detailsTransition: '',
      categorias: [],
      materials: [],
      discount: [],
      products: { data: [] }
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
    save() {
      let url = this.urlBase + 'produto';

      if (this.customizationValue == true) {
        this.customizationValue = 1
      } else {
        this.customizationValue = 0
      }

      let price = this.priceValue.toFixed(2);

      let formData = new FormData();
      formData.append('nome', this.newName);
      formData.append('meta-nome', this.newMetaName);
      formData.append('quantidade', this.quantityValue);
      formData.append('descricao', this.description);
      formData.append('valor', price);
      formData.append('costumizavel', this.customizationValue);
      formData.append('categoria_id', this.categoryValue);
      formData.append('materia_prima_id', this.materialsValue);
      formData.append('desconto_id', this.discountValue);

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
          this.newName = '';
          this.newMetaName = '';
          this.quantityValue = '';
          this.description = '';
          this.priceValue = '';
          this.customizationValue = '';
          this.categoryValue = '';
          this.materialsValue = '';
          this.discountValue = '';
        })
        .catch(errors => {
          this.$store.state.transaction.status = 'error-add'
          this.$store.state.transaction.message = errors.response.data.message
          console.log(errors.response.data.message)
        })


    },
    saveImage(i) {
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
        formData.append('produto_id', this.$store.state.item.id);

        axios.post(urlImages, formData, config)
          .then(response => {
            this.$store.state.transaction.status = 'added'
            this.$store.state.transaction.message = response.data.msg
            this.url = ''
            history.back()
          })
          .catch(errors => {
            this.$store.state.transaction.status = 'error-add'
            this.$store.state.transaction.message = errors.response.data.message
            this.mainImage =[]
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




    }
  },
  mounted() {
    this.loadCategory();
    this.loadMaterials();
    this.loadDiscounts();
    this.loadProducts();
  }

}
</script>