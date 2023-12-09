<template>
  <!-- Modal -->
  <div :id="id" class="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title " id="ModalLabel">{{ title }}</h1>
          <slot name="header">
            <a href="#">X</a>
          </slot>
        </div>
        <div class="modal-body">
          <slot name="alerts"></slot>
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
  props: ['id', 'title']
}
</script>
