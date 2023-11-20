<template>
  <!-- Modal -->
  <div class="modal" :class="{active: openModal}" :id="id" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title " id="ModalLabel">{{ title }}</h1>
          <slot name="header"></slot>
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
  props: ['id', 'title', 'openModal']
}
</script>
