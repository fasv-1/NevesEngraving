<template>
  <!--Dynamic label and help for inputs-->
  <div class="inputContainer" :class="size">

    <div class="form-label">
      <label :for="id">{{ title }}</label>
    </div>
    <slot></slot>
    <div class="error-container" v-if="$store.state.transaction.message">
      <p class="error" v-for=" error, index in this.$store.state.transaction.message" :key="index">{{ index
    == id ? error.toString() : '' }}</p>
    </div>
    <div v-if="help" :id="help" class="form-help">{{ helpText }}</div>

  </div>
</template>

<script>
export default {
  props: ['id', 'title', 'help', 'helpText', 'size']
}
</script>