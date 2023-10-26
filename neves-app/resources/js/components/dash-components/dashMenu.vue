<template>
  <section id="dash-menu">
    <div class="dash-logo-cont">
      <div class="dash-logo">
        <img src="storage/images/logos/LogoVetorizado.png" alt="Logo">
      </div>
    </div>
    <div class="dash-conteiner">
      <h2>Produtos</h2>
      <h3 @click='toogle(1)'>></h3>
      <div class="dash-content" :class="id == 1 && active ? 'show' : ''">
        <ul>
          <li>Todos</li>
          <li>Adicionar</li>
          <li>Eliminados</li>
        </ul>
      </div>
    </div>
    <div class="dash-conteiner">
      <h2>Conteudo</h2>
      <h3 @click='toogle(2)'>></h3>
      <div class="dash-content" :class="id == 2 && active ? 'show' : ''">
        <ul>
          <li>Conteudo geral</li>
          <li>Politicas</li>
          <li>Informação</li>
        </ul>
      </div>
    </div>
    <div class="dash-conteiner">
      <h2>Estatistica</h2>
      <h3 @click='toogle(3)'>></h3>
      <div class="dash-content" :class="id == 3 && active ? 'show' : ''">
        <ul>
          <li>Avaliações</li>
          <li>Lucros</li>
          <li>Pedidos</li>
          <li>Logs</li>
        </ul>
      </div>
    </div>
    <div class="dash-conteiner">
      <h2>Clientes</h2>
      <h3 @click='toogle(4)'>></h3>
      <div class="dash-content" :class="id == 4 && active ? 'show' : ''">
        <ul>
          <li>Mensagens</li>
          <li>Pedidos</li>
          <li>Avaliações</li>
        </ul>
      </div>
    </div>
    <div class="dash-conteiner">
      <h2>Defenições</h2>
      <h3 @click='toogle(5)'>></h3>
      <div class="dash-content" :class="id == 5 && active ? 'show' : ''">
        <ul>
          <li>Cores</li>
          <li>Tipos de letra</li>
        </ul>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      active: false,
      id: "",

    }
  },
  methods: {
    toogle(c) {

      if (this.id == c) {
        this.active = !this.active;
        this.id = c;
      }
      if (this.id != c) {
        this.active = true;
        this.id = c;
      }
      console.log(this.id);
      console.log(this.active);
    }
  }
}
</script>