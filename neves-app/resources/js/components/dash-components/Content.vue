<template>
  <!--Contains all the components for the diferent menus -->
  <div class="content">
    <div class="title-cont">
      <h1 class="titulo">{{ title }}</h1>
    </div>

    <router-view></router-view>
  </div>
</template>

<script>
export default {
  props: ['title'],
  // data (){
  //   return{

  //   }
  // }
}
</script>