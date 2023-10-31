<template>
  <div class="page-content">
    <h1 class="titulo">{{ title }}</h1>
    <h1 class="titulo">{{ metaTitle }}</h1>
    <div class="principal-data">

      <div class="input-form-text">
        <label for="newName">Nome</label>
        <input type="text" id="newName" name="newName" class="form-text" aria-describedby="novonomeproduto" placeholder="Nome do produto"
          v-model="newName">
        <label for="newMetaName">Meta-Nome</label>
        <input type="text" id="newMetaName" name="newMetaName" class="form-text" aria-describedby="nomeabreviado"
          placeholder="Nome abreviado para aparecer em destaque" v-model="newMetaName">
      </div>

      <div class="input-form-image">
        <label for="newImagem">Imagem principal</label>
        <input type="file" id="newImagem" name="newImagem" class="form-imagem" aria-describedby="novaimagemproduto"
          placeholder="Nome do produto" @change="uploadMainImage($event)">
        <span class="image-prevew">
          <img src="" alt="">
        </span>
      </div>
    </div>

    <div class="adicional-info">

      <div class="select-options">
        <label for="category">Categoria</label>
        <select name="category" id="categoria" v-model="categoryValue">
          <option value="1">opção1</option>
          <option value="2">opção2</option>
          <option value="3">opção3</option>
        </select>
        <label for="materials">Matéria-prima</label>
        <select name="materials" id="materiaPrima" v-model="materialsValue">
          <option value="1">opção1</option>
          <option value="2">opção2</option>
          <option value="3">opção3</option>
        </select>
        <label for="customization">Customização</label>
        <input type="checkbox" id="customization" class="form-checkbox" aria-describedby="customizacao"
          v-model="customizationValue">
      </div>

      <div class="description-text">
        <label for="description">Descrição</label>
        <input type="text" id="description" class="form-longtext" aria-describedby="descrição" v-model="description">
      </div>

      <div class="input-form-image">
        <label for="newImagem">Imagem </label>
        <input type="file" id="newImagem"  name="newImagem" class="form-imagem" aria-describedby="novaimagemproduto"
          placeholder="Nome do produto" @change="uploadImages($event, 1)">
        <span class="image-prevew"></span>
        <label for="newImagem">Imagem </label>
        <input type="file" id="newImagem" name="newImagem" class="form-imagem" aria-describedby="novaimagemproduto"
          placeholder="Nome do produto" @change="uploadImages($event, 2)">
        <span class="image-prevew"></span>
        <label for="newImagem">Imagem </label>
        <input type="file" id="newImagem" name="newImagem" class="form-imagem" aria-describedby="novaimagemproduto"
          placeholder="Nome do produto" @change="uploadImages($event, 3)">
        <span class="image-prevew"></span>
        <label for="newImagem">Imagem </label>
        <input type="file" id="newImagem" name="newImagem" class="form-imagem" aria-describedby="novaimagemproduto"
          placeholder="Nome do produto" @change="uploadImages($event, 4)">
        <span class="image-prevew"></span>
        <label for="newImagem">Imagem </label>
        <input type="file" id="newImagem" name="newImagem" class="form-imagem" aria-describedby="novaimagemproduto"
          placeholder="Nome do produto" @change="uploadImages($event, 5)">
        <span class="image-prevew"></span>
      </div>
    </div>

    <div class="ending-part">
      <div class="product-values">
        <label for="quantity">Quantidade </label>
        <input type="number" id="quantity" name="quantity" min="0" step="1" v-model="quantityValue">
        <label for="price">Preço </label>
        <input type="number" id="price" name="price" class="form-number" aria-describedby="valordoproduto"
          v-model="priceValue">
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
      if(x != x){
        this.images += i.target.files
        console.log(this.images)
      }
    },
  }

}
</script>