<template>
  <div class="container">
    <div class="card-center">
      <div class="card-header">
        <h1>Registo</h1>
      </div>

      <div class="card-body">
        <form method="POST" action="" @submit.prevent="register($event)">
          <input type="hidden" name="_token" :value="csrf_token">

          <input-container id="nome" title="Nome" help="nome" helpText="O seu nome" size="l-input">
            <input id="nome" type="text" class="form-control" name="nome" required autocomplete="nome" autofocus
              v-model="nome">
          </input-container>

          <input-container id="email" title="Email" help="email" helpText="O seu email" size="l-input">
            <input id="email" type="email" class="form-control" name="email" required autocomplete="email" autofocus
              v-model="email">
          </input-container>


          <div>
            <input-container id="password" title="Password" help="password" helpText="O sua password" size="l-input">
              <input id="password" type="password" class="form-control" name="password" required
                autocomplete="current-password" v-model="password">
            </input-container>
          </div>

          <input-container id="password_confirmation" title="Confirme a Password" help="password_confirmation"
            helpText="Confirmação da password" size="l-input">
            <input id="password_confirmation" type="password" class="form-control " name="password_confirmation"
              required autocomplete="password_confirmation" v-model="password_confirmation">
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
          console.log(response)
          if (response.data.token) {
            document.cookie = 'token=' + response.data.token
          }
          e.target.submit()
          window.location.replace("/verify-email");
        })
        .catch(errors => {
          console.log(errors.response.data.message)
        })
    }
  }

}
</script>
