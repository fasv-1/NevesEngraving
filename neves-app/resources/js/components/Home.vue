<script setup>
import { ref } from 'vue'

const x = ref(0)
const y = ref(0)

const bgImg = ref(null)


function onMousemove(e){
  x.value = e.clientX
  y.value = e.clientY
  bgImg.style.transform = 'translateY('+(y-80)+'px)';
  bgImg.style.transform += 'translateX('+(x-100)+'px)';
}
</script>

<template>
  <div class="container">
    <div class="home-intro">
      <div class="home-anim">
        <div class="title responsive-center">
          <h1>Whats Neves Engraving ?</h1>
        </div>
        <div class="text-centered mrgTextCenter">
          <h6>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cupiditate consequatur aliquid sunt error.
            Aliquid
            nobis quae voluptatem commodi. Incidunt consequuntur totam eveniet, praesentium illum deleniti sit hic fugit
            possimus sint.</h6>
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
          <img src="/storage/images/gerais/EngravingAnim.gif" alt="" height="200px">

        </div>
      </div>
      <div class="home-anim">
        <div class="title responsive-end">
          <h2>Lazer-cut</h2>
        </div>
        <div class="animation">
          <video width="200px" autoplay controls loop>
            <source src="/storage/videos/lazer-cut-clip.mp4" type="video/mp4">
          </video>
        </div>
        <div class="text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis, excepturi minus a aut
          voluptate molestiae quod, laudantium dolorem reiciendis inventore mollitia corrupti fugiat itaque nam sequi
          quam. Earum, iure aspernatur.</div>
      </div>
      <div class="home-anim">
        <div class="title">
          <h2>Assembled Gifts</h2>
        </div>
        <div class="text"> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Earum, aperiam ipsa? Tenetur
          eligendi
          laboriosam labore asperiores inventore placeat deleniti fugiat a unde exercitationem excepturi, quae qui
          assumenda, veniam autem reprehenderit!</div>
        <div class="animation">
          <video height="100px" autoplay controls loop>
            <source src="/storage/videos/heartAcembling-clip.mp4" type="video/mp4">
          </video>
        </div>
      </div>
    </div>
    <div class="home-promo">
      <div class="content"></div>
    </div>
    <div class="home-contacts">
      <div class="form-cont">
        <div class="title">
          <p>Contact</p>
          <h2>How can we help you ?</h2>
        </div>
        <div class="contact-form">
          <form method="POST" action="" @submit.prevent="contact($event)">
            <input type="hidden" name="_token" :value="$store.state.csrf">
            <div>
              <input-container id="first_name" title="First name" help="first-name" helpText="Your first name"
                size="m-input">
                <input type="text" name="first_name" required>
              </input-container>
              <input-container id="last_name" title="Last name" help="last_name" helpText="Your last name"
                size="m-input">
                <input type="text" name="last_name" required>
              </input-container>
            </div>
            <div>
              <input-container id="email" title="Email" help="email" helpText="Your email here" size="l-input">
                <input type="text" name="email" required>
              </input-container>
            </div>
            <div>
              <input-container id="message" title="Message" help="message" helpText="Your message here" size="l-input">
                <textarea name="message"></textarea>
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
    <div class="home-social" @mousemove="onMousemove">
        <div class="bg-img" ref="bgImg"></div>
      <div class="follow">
        <h1>Follow us on:</h1>
      </div>
      <div class="social">
        <h3>x: {{ x }}</h3>
        <h3>y: {{ y }}</h3>
        <a href=""><img src="/storage/images/Icons/facebook.png" width="50px" alt="facebook"></a>
        <a href=""><img src="/storage/images/Icons/instagram.png" width="50px" alt="instagram"></a>
        <a href=""><img src="/storage/images/Icons/whatsapp_icon.png" width="50px" alt="whatsapp"></a>
      </div>
    </div>









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