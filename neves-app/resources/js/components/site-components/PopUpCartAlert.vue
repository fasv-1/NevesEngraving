<template>
  <!-- Modal -->
  <div id="cartPopUp" class="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title " id="ModalLabel">{{ title }}</h2>
          <a class="x-close" href="#" @click="erraserror()">
            <h4>X</h4>
          </a>
        </div>
        <h1>{{ name }}</h1>
        <h4>{{ quantity }}</h4>
        <img :src="'/storage/' + image" alt="Product Image">
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['name', 'quantity', 'image'],
  methods: {
    erraserror() {
      this.$store.state.transaction.status = '';
      this.$store.state.transaction.message = '';
    },
    timeOut() {
      
    },
  },
  mounted() {
    this.timeOut()
  }
}
</script>
