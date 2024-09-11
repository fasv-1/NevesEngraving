<template>
  <!-- Input to add new images -->

  <div class="principal-image-preview" v-if="data != ''">
    <div v-if="dataType == 'video'">
      <video controls>
        <source :src="url">
      </video>
    </div>
    <div v-else>
      <img :src="url">
      <p>Tamanho: {{ mbConversion(data.size) }} MB</p>
    </div>
  </div>

  <!----------------------------------- End of product images inputs ----------------------------->
</template>

<script>
export default {
  props: ['data'],
  data() {
    return {
    }
  },
  methods: {
    mbConversion(v) {
      let conversion = ((v / 1024) / 1024).toFixed(2)

      return conversion
    },
  },
  computed: {
    url() {
      let urlImage = URL.createObjectURL(this.data); //creats an url to preview a loaded image

      return urlImage
    },
    dataType() {
      let dataType = this.data.type.split("/")
      return dataType[0]
    }
  }
}
</script>