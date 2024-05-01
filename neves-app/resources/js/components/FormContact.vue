<template>
  <div class="form-contacts">
    <div class="form-cont">
      <div class="title">
        <p>Contact</p>
        <h2>How can we help you ?</h2>
      </div>
      <div class="contact-form">
        <form method="POST" action="" @submit.prevent="contact($event)">
          <input type="hidden" name="_token" :value="$store.state.csrf">
          <div>
            <input-container id="nome" title="First name" help="first-name" helpText="Your first name"
              size="m-input">
              <input type="text" name="nome" required v-model="firstName">
            </input-container>
            <input-container id="apelido" title="Last name" help="last_name" helpText="Your last name" size="m-input">
              <input type="text" name="apelido" required v-model="lastName">
            </input-container>
          </div>
          <div>
            <input-container id="email" title="Email" help="email" helpText="Your email here" size="l-input">
              <input type="email" name="email" required v-model="email">
            </input-container>
          </div>
          <div>
            <input-container id="mensagem" title="Message" help="message" helpText="Your message here" size="l-input">
              <textarea name="mensagem" required v-model="message"></textarea>
            </input-container>
          </div>
          <div class="button-form">
            <div class="btn-pass">
              <button type="submit" class="button-save">
                Send
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      firstName: '',
      lastName: '',
      email: '',
      message: '',
    }
  },
  methods: {
    contact(){
      let url = this.$store.state.Url + 'api/mensagem'

      let formData = new FormData()

      formData.append('nome', this.firstName)
      formData.append('apelido', this.lastName)
      formData.append('email', this.email)
      formData.append('mensagem', this.message)

      let config = {
        headers:{
          'Content-Type': 'x-www-form-urlencoded',
          'Accept': 'application/json'
        }
      }

      axios.post(url, formData, config)
        .then(response =>{
          alert(response.data.msg)
          this.firstName = ''
          this.lastName = ''
          this.email = ''
          this.message = ''
        })
        .catch(errors =>{
          console.log(errors)
          this.$store.state.transaction.message = errors.response.data.errors
        })
    }
  },
  mounted() {
  }
}
</script>