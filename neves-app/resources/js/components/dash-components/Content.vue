<template>
  <!--Contains all the components for the diferent menus -->
  <div class="content">
    <div class="title-cont">
      <h1 class="titulo">{{ title }}</h1>
      <h2 class="titulo_alt">( {{ metaTitle }} )</h2>
    </div>

    <add-product v-if="id == 1 && metaTitle == 'Adicionar'"></add-product>
    <products v-if="id == 1 && metaTitle == 'Conteudo de Produtos'"></products>
    <defenitions-product v-if="id == 1 && metaTitle == 'Defenições'"></defenitions-product>
    <desconto-product v-if="id == 1 && metaTitle == 'Descontos'"></desconto-product>
  </div>
</template>

<script>
export default {
  props: ['id', 'title', 'metaTitle'],
  // data (){
  //   return{

  //   }
  // }
}
</script>