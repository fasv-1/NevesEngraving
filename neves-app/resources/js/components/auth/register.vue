<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Registration (Component Vue)</div>

          <div class="card-body">
            <form method="POST" action="" @submit.prevent="register($event)">
              <input type="hidden" name="_token" :value="csrf_token">
              <div class="row mb-3">
                <label for="nome" class="col-md-4 col-form-label text-md-end">Nome</label>

                <div class="col-md-6">
                  <input id="nome" type="text" class="form-control" name="nome" required autocomplete="nome" autofocus
                    v-model="nome">
                </div>
              </div>
              <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                <div class="col-md-6">
                  <input id="email" type="email" class="form-control" name="email" required autocomplete="email" autofocus
                    v-model="email">
                </div>
              </div>

              <div class="row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

                <div class="col-md-6">
                  <input id="password" type="password" class="form-control " name="password" required
                    autocomplete="password" v-model="password">

                </div>
              </div>

              <div class="row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-end">Password Confirmation</label>

                <div class="col-md-6">
                  <input id="password_confirmation" type="password" class="form-control " name="password_confirmation" required
                    autocomplete="password_confirmation" v-model="password_confirmation">

                </div>
              </div>

              <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    Registration
                  </button>
              
                </div>
              </div>
            </form>
          </div>
        </div>
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
