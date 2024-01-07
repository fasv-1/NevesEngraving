<template>
  <!-- Modal -->
  <div :id="id" class="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title " id="ModalLabel">{{ title }}</h1>
          <a class="x-close" href="#" @click="erraserror()"><h2>X</h2></a>
          
        </div>
        <hr>
        <div class="alerts">
          <slot name="alerts"></slot>
        </div>
        <div class="modal-body">
          <slot name="content"></slot>
        </div>
        <hr>
        <div class="modal-footer">
          <slot name="footer"></slot>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['id', 'title'],
  methods:{
    erraserror(){
      this.$store.state.transaction.status = '';
      this.$store.state.transaction.message = '';
    }
  }
}
</script>
