<template>
  <div class="inputContainer" :class="size">

    <div class="form-label">
    <label :for="id" >{{ title }}</label>
    </div>
    <slot></slot>

    <div v-if="help" :id="help" class="form-help">{{ helpText }}</div>
  </div>
</template>

<script>
export default {
  props: ['id', 'title', 'help', 'helpText', 'size']
}
</script>