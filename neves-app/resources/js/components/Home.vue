<script setup>
import { ref } from 'vue'

const x = ref(0)
const y = ref(0)



function onMousemove(e) {
  x.value = e.clientX
  y.value = e.clientY
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
          <video  autoplay loop>
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
          <video  autoplay loop>
            <source src="/storage/videos/heartAcembling-clip.mp4" type="video/mp4">
          </video>
        </div>
      </div>
    </div>
    <div class="home-promo">
      <div class="content"></div>
    </div>
    <contact-component></contact-component>
    <div class="home-social" @mousemove="onMousemove">
      <div class="bg-img" :style="{ translate: '' + (x-110) + 'px ' + (y- dinamicHeight) + 'px' }"></div>
      <div class="bg-logo">
        <div class="follow">
          <h1><b>Follow us on:</b></h1>
        </div>
        <div class="social">
          <a href=""><img src="/storage/images/Icons/facebook-follow.png" width="50px" alt="facebook"></a>
          <a href=""><img src="/storage/images/Icons/instagram-follow.png" width="50px" alt="instagram"></a>
          <a href=""><img src="/storage/images/Icons/whatsapp-follow.png" width="50px" alt="whatsapp"></a>
        </div>
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
  computed:{
    dinamicHeight(){
      let WindowHeight = window.innerHeight

      return (WindowHeight - 370)
    }
  },

  mounted() {
  }

}
</script>