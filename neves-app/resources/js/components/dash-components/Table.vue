<template>
  <div class="table-container">
        <div class="table">
          <table>
            <thead >
              <tr>
                <th v-if="heading1">{{ heading1 }}</th>
                <th v-if="heading1" class="feel"></th>
                <th v-if="heading2">{{ heading2 }}</th>
                <th v-if="heading2" class="feel"></th>
                <th v-if="heading3">{{ heading3 }}</th>
                <th v-if="heading3" class="feel"></th>
                <th v-if="heading4">{{ heading4 }}</th>
                <th v-if="heading4" class="feel"></th>
                <th v-if="heading5">{{ heading5 }}</th>
                <th v-if="heading5" class="feel"></th>
              </tr>
            </thead>
            <tbody>
              <slot></slot>
            </tbody>
          </table>
        </div>
      </div>
</template>

<script>
  export default {
    props: ['heading1', 'heading2', 'heading3', 'heading4','heading5'],
    data(){
      return{

      }
    }
  }
</script>