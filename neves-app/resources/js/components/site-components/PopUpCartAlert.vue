<template>
  <!-- Modal -->
  <div id="cartPopUp" class="popUpCart" :class="display == true ? 'active' : ''">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title " id="ModalLabel"> Product Added to Cart </h3>
          <!-- <a class="x-close" href="#" @click="erraserror()">
            <h4>X</h4>
          </a> -->
        </div>
        <div class="modal-body">
          <div class="pop-prod">
            <img id="pop-img" :src="'/storage/' + image" alt="Product Image">
            <p id="pop-name">{{ name }}</p>
          </div>
          <div class="pop-qnt">
            <label for="pop-qnt">Qnt</label>
            <p id="pop-qnt">{{ quantity }}</p>
          </div>
        </div>
        <div class="modal-footer">
          <button class="button-save">Go to cart</button>
          <button class="button-login">Buy now</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['name', 'quantity', 'image', 'display'],
  methods: {
    erraserror() {
      this.$store.state.transaction.status = '';
      this.$store.state.transaction.message = '';
    },
  },
  mounted() {
  }
}
</script>
