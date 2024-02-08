<template>
  <!-- Modal -->

  <div class="card-box">
    <div class="card-prd-dash" v-for="value, indexValue in products" :key="indexValue">
      <router-link :to="'/' + usedArea + '/produtos/' + value.id" class="b-input">
        <div class="label-area" v-if="headTitle">
          <h4>{{ value.meta_nome }}</h4>
          <h6>ID{{ value.id }}</h6>
        </div>
        <div class="img-area" v-if="image">
          <div v-for="i, indexValue in image" :key="indexValue">
            <div class="img-cont" v-if="i.produto_id == value.id && i.posicao == 1">
              <img class="img-prd-dash" :src="'/storage/' + i.nome" alt="">
            </div>
          </div>
        </div>
        <div class="info-area">
          <div class="info">
          <h4 v-if="info.nome">{{ value.nome }}</h4>
          <h4 v-if="info.meta_nome">{{ value.meta_nome }}</h4>
          <h5 v-if="info.categoria">{{ value.ocasioes_categoria_id }}</h5>
          <h5 v-if="info.materia">{{ value.materia_prima.nome }}</h5>
          <h5 v-if="info.quantidade">Quant.: {{ value.quantidade }} </h5>
          <h6 v-if="info.valor"> {{ value.valor }} €</h6>
        </div>
        
        </div>
      </router-link>
      <div class="cart-btn" v-if="cart">
          <button class="button1" @click="teste()">Add to cart</button>
        </div>
    </div>
    
  </div>
</template>

<script>
export default {
  props: ['products', 'usedArea', 'headTitle', 'image', 'info', 'cart'],
  methods: {
    teste(){
      console.log('cheguei aqui')
    },
    erraserror() {
      this.$store.state.transaction.status = '';
      this.$store.state.transaction.message = '';
    }
  }
}
</script>