<template>
  <div class="inputContainer">

    <label :for="id" class="form-label">{{ titulo }}</label>
    <slot></slot>

    <div :id="help" class="form-help">{{ helpText }}</div>
  </div>
</template>

<script>
export default {
  props: ['id', 'titulo', 'help', 'helpText']
}
</script>