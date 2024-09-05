<template>
  <!-- Input to add new images -->
  
        <div class="principal-image-preview"> 
          <img v-if="url" :src="url">
          <p v-if="data != ''">Tamanho: {{ mbConversion(data.size) }} MB</p>
        </div>
  
  
      <!----------------------------------- End of product images inputs ----------------------------->
  </template>
  
  <script>
  export default {
    props: ['url','data'],
    data(){
      return{
      }
    },
    methods:{
      mbConversion(v){
        let conversion = ((v / 1024) / 1024).toFixed(2)
  
        return conversion
      },
    },
  }
  </script>