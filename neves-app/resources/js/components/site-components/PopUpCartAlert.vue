<template>
  <!-- Modal -->
  <div id="cartPopUp" class="popUpCart" :class="display == true ? 'active' : ''">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title " id="ModalLabel">- Product Added to Cart -</h5>
          <!-- <a class="x-close" href="#" @click="erraserror()">
            <h4>X</h4>
          </a> -->
        </div>
        <div class="modal-body">
          <div>
            <img id="pop-img" :src="'/storage/' + image" width="40" height="40" alt="Product Image">
          </div>
          <div>
            <label for="pop-name">Name</label>
            <h5 id="pop-name">{{ name }}</h5>
          </div>
          <div>
            <label for="pop-qnt">Quantity</label>
            <h5 id="pop-qnt">{{ quantity }}</h5>
          </div>
        </div>
        <div class="modal-footer">
          <button class="button-login">Go to cart</button>
          <button class="button-save">Fast checkout</button>
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
