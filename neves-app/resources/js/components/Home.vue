<template>
  <div class="container">
    <div class="home-intro">
      <div class="home-anim">
        <div class="title">
          <h1>Whats Neves Engraving ?</h1>
        </div>
        <div class="text">
          <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cupiditate consequatur aliquid sunt error.
            Aliquid
            nobis quae voluptatem commodi. Incidunt consequuntur totam eveniet, praesentium illum deleniti sit hic fugit
            possimus sint.</p>
        </div>
        <div class="animation"></div>
      </div>
      <div class="home-anim">
        <div class="title">
          <h2>Engraving</h2>
        </div>
        <div class="text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Exercitationem obcaecati natus
          delectus corrupti dolorum quasi? Natus velit nobis iure, vero doloremque, distinctio beatae voluptas nostrum
          consequatur quas et magni enim.</div>
        <div class="animation">
          <img src="/storage/images/gerais/EngravingAnim.gif" alt="" width="400">

        </div>
      </div>
      <div class="home-anim">
        <div class="title">
          <h2>Lazer-cut</h2>
        </div>
        <div class="text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis, excepturi minus a aut
          voluptate molestiae quod, laudantium dolorem reiciendis inventore mollitia corrupti fugiat itaque nam sequi
          quam. Earum, iure aspernatur.</div>
        <div class="animation">
          <video width="800" autoplay loop>
            <source src="/storage/videos/lazer-cut-clip.mp4" type="video/mp4">
          </video>
        </div>
      </div>
      <div class="home-anim">
        <div class="title"><h2>Assembled Gifts</h2></div>
        <div class="text"> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Earum, aperiam ipsa? Tenetur
          eligendi
          laboriosam labore asperiores inventore placeat deleniti fugiat a unde exercitationem excepturi, quae qui
          assumenda, veniam autem reprehenderit!</div>
        <div class="animation">
          <video width="800" autoplay loop>
            <source src="/storage/videos/heartAcembling.mp4" type="video/mp4">
          </video>
        </div>
      </div>
    </div>
    <div class="home-promo">
      <div class="content"></div>
    </div>
    <div class="home-contacts">
      <div class="title">
        <p></p>
        <h3>How can we help you ?</h3>
      </div>
      <div class="contact-form">
        <form method="POST" action="" @submit.prevent="contact($event)">
          <input type="hidden" name="_token" :value="$store.state.csrf">
          <div>
            <input-container id="first_name" title="First name" help="first-name" helpText="Your first name" size="m-input">
              <input type="text" name="first_name" required>
            </input-container>
            <input-container id="last_name" title="Last name" help="last_name" helpText="Your last name" size="m-input">
              <input type="text" name="last_name" required>
            </input-container>
          </div>
          <div>
            <input-container id="email" title="Email" help="email" helpText="Your email here">
              <input type="text" name="email" required>
            </input-container>
          </div>
          <div>
            <input-container id="message" title="Message" help="message" helpText="Your message here">
            <textarea name="message"></textarea>
          </input-container>
          </div>
          <div class="button-form">
            <div class="btn-pass">
              <button type="submit" class="button-login">
                Send
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="home-social"></div>









  </div>
</template>

<script>
export default {
  data() {
    return {

    }
  },
  props: [],

  methods: {
  },

  mounted() {
  }

}
</script>