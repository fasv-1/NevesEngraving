<template>
  <!-- Modal -->
  <div :class="style">
    <p>{{ details.message }}</p>
  </div>
  
</template>

<script>

export default {
  props:['tipe', 'details'],
  computed: {
    style(){
      return 'alert-'+this.tipe
    }
  }
}
</script>