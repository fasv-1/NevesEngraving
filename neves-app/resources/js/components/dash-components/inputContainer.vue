<template>
  <div class="inputContainer">

    <div class="form-label">
    <label :for="id" >{{ titulo }}</label>
    </div>
    <slot></slot>

    <div :id="help" class="form-help"></div>
  </div>
</template>

<script>
export default {
  props: ['id', 'titulo', 'help', 'helpText']
}
</script>