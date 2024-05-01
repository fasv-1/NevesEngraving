<template>
  <div class="container">
    <div class="card-center">
      <div class="card-header">
        <h1>Login</h1>
      </div>
      <!-----------------------------Login Form---------------------------------->
      <div class="card-body">
        <form method="POST" action="" @submit.prevent="login($event)">
          <input type="hidden" name="_token" :value="csrf_token">

          <input-container id="Email" title="Email" help="email" helpText="O seu email" size="l-input">
            <input type="email" class="form-control" name="Email" required autocomplete="email" autofocus
              v-model="email">
          </input-container>


          <input-container id="password" title="Password" help="password" helpText="O sua password" size="l-input">
            <input type="password" class="form-control " name="password" required autocomplete="current-password"
              v-model="password">
          </input-container>

          <div class="error-container" v-if="$store.state.transaction.message">
            <p class="error" v-for=" error, index in this.$store.state.transaction.message" :key="index">{{ index
          == 'email' ? error.toString() : '' }}</p>
          </div>

          <div class="button-form">
            <div class="btn-pass">
              <button type="submit" class="button1">
                Login
              </button>
              <a class="password-link" href="/forgot-password">
                Esqueci-me da password
              </a>
            </div>
            <div class="register-link">
              <a href="/register">
                Ainda não estou registado
              </a>
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
      email: '',
      password: '',
    }
  },
  methods: {
    //forma de capturar o email e a password para que seja gerado o token JWT
    login(e) {

      let url = 'http://127.0.0.1:8000/login'

      let formData = new FormData()

      formData.append('email', this.email)
      formData.append('password', this.password)

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
            window.location.replace("/");
          }
        })
        .catch(errors => {
          console.log(errors.response.data)
          this.$store.state.transaction.message = errors.response.data.errors
        })
    }
  }

}
</script>
