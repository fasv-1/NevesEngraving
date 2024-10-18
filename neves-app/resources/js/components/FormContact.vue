<template>
  <div class="form-contacts">
    <div class="form-intro">
      <h1><b>Contact us</b></h1>
      <p>Email, call or complete the form to adress any question you have.</p>
      <p>info@nevesengraving.com</p>
      <p>+351 945 212 001</p>
      <div class="form-info-contact">
        <div>
          <p class="tt"><b>Customer Support</b></p>
          <p>Our support team will answer as sone as possible to adress any concern or question you may have. </p>
        </div>
        <div>
          <p class="tt"><b>Feedback and Suggestions</b></p>
          <p>We value your feedback and are continuously working to inprove our website. Your opinion is crucial to us.
          </p>
        </div>
      </div>

    </div>
    <div class="form-container">
      <div class="form-cont">
        <div class="title">
          <h3><b>Any Question?</b></h3>
          <h4><b>You can reach us any time.</b></h4>

        </div>
        <div class="contact-form">
          <form method="POST" action="" @submit.prevent="contact($event)">

            <input type="hidden" name="_token" :value="$store.state.csrf">
            <div class="form-name">
              <input type="text" name="nome" placeholder="First Name" required v-model="firstName">
              <input type="text" name="apelido" placeholder="Last Name" required v-model="lastName">
            </div>
            <div>
              <input type="email" name="email" placeholder="Email" class="l-input" required v-model="email">
            </div>
            <div>
              <textarea name="mensagem" placeholder="How can we help you" class="form-m" required v-model="message"></textarea>
            </div>
            <div class="button-form">
              <button type="submit" class="button-small">
                Send
              </button>
            </div>
          </form>
        </div>
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
    contact() {
      let url = this.$store.state.Url + 'api/mensagem'

      let formData = new FormData()

      formData.append('nome', this.firstName)
      formData.append('apelido', this.lastName)
      formData.append('email', this.email)
      formData.append('mensagem', this.message)

      let config = {
        headers: {
          'Content-Type': 'x-www-form-urlencoded',
          'Accept': 'application/json'
        }
      }

      axios.post(url, formData, config)
        .then(response => {
          alert(response.data.msg)
          this.firstName = ''
          this.lastName = ''
          this.email = ''
          this.message = ''
        })
        .catch(errors => {
          console.log(errors)
          this.$store.state.transaction.message = errors.response.data.errors
        })
    }
  },
  mounted() {
  }
}
</script>