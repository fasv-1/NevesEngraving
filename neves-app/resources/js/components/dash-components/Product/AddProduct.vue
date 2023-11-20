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
      </div>

      <div class="container-inputs">
        <!--Product selects inputs -->
        <!-- Category -->
        <div class="select-options">
          <input-container id="category" titulo='Categoria' help="categoryHelp"
            helpText="Escolha uma categoria para o produto">
            <a href="" @click.prevent="openCategory()">Adicionar nova categoria</a>
            <select  name="category" id="category" v-model="categoryValue">
              <option v-for="c in categorias" :key="c.id" :value="c.id">{{ c.nome }}</option>
            </select>
          </input-container>
           <!-- Materials -->
          <input-container id="materials" titulo='Matéria-prima' help="materialsHelp"
            helpText="Escolha uma categoria para o produto">
            <select name="materials" id="materials" v-model="materialsValue">
              <option value="1">opção1</option>
              <option value="2">opção2</option>
              <option value="3">opção3</option>
            </select>
          </input-container>

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
            <input type="number" id="quantity" name="quantity" class="input-value" min="0" step="1"
              v-model="quantityValue">
          </input-container>
          <input-container id="price" titulo='Preço' help="priceHelp"
            helpText="Qual o valor deste produto (sem taxas, nem custos, apenas o produto)">
            <input type="number" id="price" name="price" class="input-value" aria-describedby="valordoproduto"
              v-model="priceValue">
          </input-container>
        </div>
      </div>
      <div class="button-product">
        <button type="button" class="button-save" @click="salvar()">Salvar</button>
      </div>
    </div>
    <!-- Add Category Modal  -->
    <modal-component id="addCategory" title="Adicionar Categoria" :openModal="active">
      <template v-slot:header>
        <button type="button" class="btn-modal-close" aria-label="Close" @click="openCategory()">X</button>
      </template>
      <template v-slot:alerts>
        <alert-component tipe="success" :details="detailsTransition"
          v-if="statusTransition == 'adicionado'"></alert-component>
        <alert-component tipe="danger" :details="detailsTransition" v-if="statusTransition == 'erro'"></alert-component>
      </template>
      <template v-slot:content>
        <input type="text" id="newCategory" name="newCategory" class="form-text" aria-describedby="newCategory"
          placeholder="Nome da categoria" v-model="category">
      </template>
      <template v-slot:footer>
        <button type="button" class="button-save" @click="saveCategory()">Salvar</button>
      </template>
    </modal-component>
  <br>
</template>

<script>
import axios from 'axios';

export default {
  props: ['id', 'title', 'metaTitle'],
  data() {
    return {
      urlBase: 'http://127.0.0.1:8000/api/',
      newName: '',
      newMetaName: '',
      category: '',
      categoryValue: '',
      materialsValue: '',
      customizationValue: '',
      description: '',
      quantityValue: '',
      priceValue: '',
      mainImage: [],
      images: [],
      url: '',
      urlImages: [],
      productImages: '',
      active: false,
      statusTransition: '',
      detailsTransition: '',
      categorias:[]
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
      //tentativa de criar um url para cada imagem carregada, está a criar um url novo todas as vezes que é caregada uma imagem
      //  console.log(this.urlImages);
    },
    deleteImage(del) {

      this.images.splice(del, 1);
      this.urlImages.splice(del, 1);
    },
    loadCategoria() {
      let urlCategory = this.urlBase + 'categoria';

      axios.get(urlCategory)
        .then(response =>{
          this.categorias = response.data

          // console.log(this.categorias)
        })
        .catch(errors =>{
          console.log(errors);
        })
    },
    openCategory() {
      this.active = !this.active;
      this.statusTransition = ''
      this.detailsTransition = ''
      this.category = ''
    },
    saveCategory() {
      let urlCategory = this.urlBase + 'categoria';

      let formData = new FormData();
      formData.append('nome', this.category);

      let config = {
        headers: {
          'Content-Type': 'x-www-form-urlencoded',
          'Accept': 'application/json'
        }
      }
      axios.post(urlCategory, formData, config)
        .then((response) => {
          this.statusTransition = 'adicionado'
          this.detailsTransition = {
            message: 'A categoria ' + response.data.nome + ' foi adicionada com sucesso'
          }
        })
        .catch(errors => {
          this.statusTransition = 'erro'
          this.detailsTransition = {
            message: errors.response.data.message
          }
          // console.log(errors.response.data.message)
        })
    },
    // salvar(){
    //   let urlProduct = this.urlBasePost + 'produto';

    //   let formData = new FormData();
    //   formData.append('nome', this.newName)
    //   formData.append('meta-nome', this.newMetaName)
    //   formData.append('quantidade', this.quantityValue)
    //   formData.append('descricao', this.description)
    //   formData.append('valor', this.priceValue)
    //   formData.append('costumizavel', this.customizationValue)
    //   formData.append('categoria_id', this.newMetaName)
    //   formData.append('materia_prima_id', this.newMetaName)
    //   formData.append('desconto_id', this.newMetaName)
    //   axios.post(urlProduct, )
    // }
  },
  mounted(){
    this.loadCategoria()
  }

}
</script>