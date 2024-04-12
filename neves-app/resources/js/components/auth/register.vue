<template>
  <div class="container">
    <div class="card-center">
      <div class="card-header">
        <h1>Registo</h1>
      </div>

      <div class="card-body">
        <form method="POST" action="" @submit.prevent="register($event)">
          <input type="hidden" name="_token" :value="csrf_token">

          <input-container id="name" title="Nome" help="nome" helpText="O seu nome" size="l-input">
            <input type="text" class="form-control" name="name" autocomplete="nome" autofocus v-model="nome">
          </input-container>

          <input-container id="email" title="Email" help="email" helpText="O seu email" size="l-input">
            <input type="email" class="form-control" name="email" autocomplete="email" autofocus
              v-model="email">
          </input-container>


          <div>
            <input-container id="password" title="Password" help="password" helpText="O sua password" size="l-input">
              <input type="password" class="form-control" name="password" autocomplete="current-password"
                v-model="password">
            </input-container>
          </div>

          <input-container id="password_confirmation" title="Confirme a Password" help="password_confirmation"
            helpText="Confirmação da password" size="l-input">
            <input id="password_confirmation" type="password" class="form-control " name="password_confirmation"
              autocomplete="password_confirmation" v-model="password_confirmation">
          </input-container>
          <div class="button-form">
            <div class="btn-pass">
              <button type="submit" class="button-login">
                Enviar
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
//exportação de um atributo de configuração do vue
export default {
  props: ['csrf_token'],
  data() {
    return {
      nome: '',
      email: '',
      password: '',
      password_confirmation: '',
    }
  },
  methods: {
    //forma de capturar o email e a password para que seja gerado o token JWT
    register(e) {

      let url = 'http://127.0.0.1:8000/register'

      let formData = new FormData()

      formData.append('name', this.nome)
      formData.append('email', this.email)
      formData.append('password', this.password)
      formData.append('password_confirmation', this.password_confirmation)

      let config = {
        headers: {
          'Content-Type': 'x-www-form-urlencoded',
          'Accept': 'application/json'
        }
      }
      axios.post(url, formData, config)
        .then((response) => {
          if (response.data.errors) {
            this.$store.state.transaction.message = response.data.errors
          } else {
            e.target.submit()
            window.location.replace("/verify-email");
          }
        })
        .catch(errors => {
          this.$store.state.transaction.message = errors.response.data.errors
          console.log(errors.response.data.errors)
        })
    }
  }

}
</script>
