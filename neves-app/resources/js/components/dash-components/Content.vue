<template>
  <!--Contains all the components for the diferent menus -->
  <div class="content">
    <h1 class="titulo">{{ title }}</h1>
    <h2 class="titulo_alt">( {{ metaTitle }} )</h2>

    <add-product v-if="id == 1 && metaTitle == 'Adicionar'"></add-product>
    <defenitions-product v-if="id == 1 && metaTitle == 'Defenições'"></defenitions-product>

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