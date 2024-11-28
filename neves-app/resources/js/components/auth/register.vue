<template>
  <div class="container">
    <div class="card-center">
      <div class="card-header">
        <h1>Sign up</h1>
      </div>
      <!-----------------------------Register Form---------------------------------->
      <div class="card-body">
        <form method="POST" action="" @submit.prevent="register($event)">
          <input type="hidden" name="_token" :value="csrf_token">

          <input-container id="name" title="Name" help="nome" helpText="Your name">
            <input type="text" class="form-control l-input" name="name" autofocus v-model="nome">
          </input-container>

          <input-container id="email" title="Email" help="email" helpText="Your email">
            <input type="email" class="form-control l-input" name="email" autocomplete="email" autofocus
              v-model="email">
          </input-container>


          <div>
            <input-container id="password" title="Password" help="password" helpText="Your password">
              <input type="password" class="form-control l-input" name="password" autocomplete="current-password"
                v-model="password">
            </input-container>
          </div>

          <input-container id="password_confirmation" title="Repeat password" help="password_confirmation"
            helpText="Password confirmation">
            <input id="password_confirmation" type="password" class="form-control l-input" name="password_confirmation"
              autocomplete="password_confirmation" v-model="password_confirmation">
              <p class="error" v-for=" error, index in this.$store.state.transaction.message" :key="index">{{ index
    == 'password' ? error.toString() : '' }}</p>
          </input-container>
          <div class="button-form">
            <div class="btn-pass">
              <button type="submit" class="button1">
                Send
              </button>
            </div>
            <div class="register-link">
              <a href="/login">
                Oh I forgot, already have an account
              </a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
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
