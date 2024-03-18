<template>
  <!-- Modal -->
  <div :id="id" class="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title " id="ModalLabel">{{ title }}</h2>
          <a class="x-close" href="#" @click="erraserror()"><h4>X</h4></a>
        </div>
        <div class="alerts">
          <slot name="alerts"></slot>
        </div>
        <div class="modal-body">
          <slot name="content"></slot>
        </div>
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
