<template>
  <div class="productInputContent">
    <h1 class="titulo">{{ title }}</h1>
    <h2 class="titulo_alt">{{ metaTitle }}</h2>
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
          <img src="" alt="">
        </div>
      </div>
    </div>

    <div class="container-inputs">
      <!--Product selects inputs-->
      <div class="select-options">
        <input-container id="category" titulo='Categoria' help="categoryHelp"
          helpText="Escolha uma categoria para o produto">
          <select name="category" id="category" v-model="categoryValue">
            <option value="1">opção1</option>
            <option value="2">opção2</option>
            <option value="3">opção3</option>
          </select>
        </input-container>
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
          <input type="file" id="newImagem" name="newImagem" class="form-imagem" aria-describedby="newProductImage"
            placeholder="Nome do produto" @change="uploadImages($event, 1)">
          <span class="image-preview"><img src="" alt=""></span>
        </div>
        <div class="input-images">
          <input type="file" id="newImagem" name="newImagem" class="form-imagem" aria-describedby="newProductImage"
            placeholder="Nome do produto" @change="uploadImages($event, 2)">
          <span class="image-preview"><img src="" alt=""></span>
        </div>
        <div class="input-images">
          <input type="file" id="newImagem" name="newImagem" class="form-imagem" aria-describedby="newProductImage"
            placeholder="Nome do produto" @change="uploadImages($event, 3)">
          <span class="image-preview"><img src="" alt=""></span>
        </div>
        <div class="input-images">
          <input type="file" id="newImagem" name="newImagem" class="form-imagem" aria-describedby="newProductImage"
            placeholder="Nome do produto" @change="uploadImages($event, 4)">
          <span class="image-preview"><img src="" alt=""></span>
        </div>
        <div class="input-images">
          <input type="file" id="newImagem" name="newImagem" class="form-imagem" aria-describedby="newProductImage"
            placeholder="Nome do produto" @change="uploadImages($event, 5)">
          <span class="image-preview"><img src="" alt=""></span>
        </div>
        <div id="help" class="form-help-img">Selecione se for possivel costumizar</div>
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
        <div class="button-product">
          <button type="button" class="button-save" @click="salvar()">Salvar</button>
        </div>
      </div>
    </div>
  </div>
  <br>
  {{ newName }}
  {{ newMetaName }}
  {{ categoryValue }}
  {{ materialsValue }}
  {{ customizationValue }}
  {{ description }}
  {{ quantityValue }}
  {{ priceValue }}
  {{ mainImage }}
  {{ images }}
</template>

<script>
export default {
  props: ['id', 'title', 'metaTitle'],
  data() {
    return {
      newName: '',
      newMetaName: '',
      categoryValue: '',
      materialsValue: '',
      customizationValue: '',
      description: '',
      quantityValue: '',
      priceValue: '',
      mainImage: [],
      images: [],


    }
  },
  methods: {
    uploadMainImage(e) {
      this.mainImage = e.target.files
    },
    uploadImages(i, x) {
      if (x == []) {
        this.images = i.target.files
        console.log(this.images)
      }
      if (x != x) {
        this.images += i.target.files
        console.log(this.images)
      }
    },
  }

}
</script>