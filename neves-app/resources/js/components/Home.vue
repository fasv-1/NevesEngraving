<script setup>
import { ref } from 'vue'

const x = ref(0)
const y = ref(0)


//-------- stores the axys value from mouse pointer on the x and y variable--------
// function onMousemove(e) {


//     y.value = e.clientY
//     x.value = e.clientX
  
//     if(e.clientY > 680){
//       y.value = e.clientY - 750
//     }

//     if(e.clientY > 300 && e.clientY< 720){
//       y.value = e.clientY - 480
//     }

//     console.log(e.clientY)
// }

// function dinamicHight() { // calculate the window height variation for the div attached to the pointer stays in the center
//       let WindowHeight = window.innerHeight
//       console.log(WindowHeight)
//       return (WindowHeight - 370)
//     }
</script>

<template>
  <div class="container" >

    <!----------------------------------------------Inital intro with animations--------------------------->
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
        <div class="responsive-container row-reverse">
          <div class="animation">
            <img src="/storage/images/gerais/EngravingAnim.gif" alt="" height="200px">
          </div>
          <div class="text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Exercitationem obcaecati natus
            delectus corrupti dolorum quasi? Natus velit nobis iure, vero doloremque, distinctio beatae voluptas nostrum
            consequatur quas et magni enim.</div>
        </div>
      </div>
      <div class="home-anim">
        <div class="title responsive-end">
          <h2>Lazer-cut</h2>
        </div>
        <div class="animation">
          <video autoplay loop>
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
        <div class="responsive-container row-reverse">
          <div class="animation">
            <video autoplay loop>
              <source src="/storage/videos/heartAcembling-clip.mp4" type="video/mp4">
            </video>
          </div>
          <div class="text"> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Earum, aperiam ipsa? Tenetur
            eligendi
            laboriosam labore asperiores inventore placeat deleniti fugiat a unde exercitationem excepturi, quae qui
            assumenda, veniam autem reprehenderit!</div>
        </div>
      </div>
    </div>

    <!----------------------------------------------Promo Image or Caroussel-------------------------------->
    <div class="home-promo">
      <div class="content"></div>
    </div>

    <!----------------------------------------------Contact form--------------------------------------------->
    <contact-component></contact-component>

    <!--------------------------------------------- Follow as card--------------------------->
    <div class="home-social">
      <div class="bg-img"></div>
      <div class="bg-logo">
        <div class="follow">
          <h1><b>FOLLOW US ON:</b></h1>
        </div>
        <div class="social">
          <a href=""><svg id="facebook" x="0px" y="0px" viewBox="0 0 550.98 520.76">
            <path class="cls-1" d="M525.6,80V401.6a16.51,16.51,0,0,0-.74,2.22c-2.75,15.59-10.93,27.58-24.73,35.15-5.68,3.12-12.32,4.47-18.53,6.63H380c-6.82-3.26-8.95-8.69-8.91-16.14.22-46.66.11-93.32.11-140,0-10.2,4.4-14.68,14.54-14.72,12.13,0,24.27,0,36.4,0,1.41,0,2.83-.13,4.6-.21,0-10.62,0-20.86,0-31.1a28.18,28.18,0,0,0-.38-3.12H421.9c-12.4,0-24.79.07-37.19,0-8.87-.06-13.48-4.82-13.5-13.69q0-22.8,0-45.6c0-9.85,5.49-15.31,15.38-15.34,11.87,0,23.73,0,35.6,0h4.34V131.23h-4.11c-12,0-24,0-36,0-28.84.1-49.57,20.89-49.63,49.76,0,15.2,0,30.4,0,45.6,0,8.91-4.62,13.6-13.5,13.66-12.4.08-24.8,0-37.2,0h-4.5v34.47h4.66c11.86,0,23.73,0,35.59,0,10.68,0,15,4.35,15,15.11,0,46.53-.11,93.05.11,139.58,0,7.43-2.06,12.9-8.9,16.15H160a9.93,9.93,0,0,0-1.83-.69c-24.83-4.22-42.12-24.38-42.14-49.75q-.11-154.34.09-308.67a54.41,54.41,0,0,1,2.78-16.83c7-20.87,25.77-33.65,48.77-33.65q134.55,0,269.1,0c13.19,0,26.39-.14,39.58,0A49.72,49.72,0,0,1,523,70C524.05,73.28,524.73,76.67,525.6,80ZM312.39,421.47V299h-4.62c-12.13,0-24.26,0-36.39,0-9.78,0-14.4-4.7-14.42-14.56q0-26.81,0-53.6c0-10.11,4.6-14.74,14.61-14.75q18.19,0,36.4,0h4.7c0-1.89,0-3.32,0-4.75,0-11.46-.19-22.94.13-34.39a71.71,71.71,0,0,1,70.07-69.71c18.13-.4,36.27-.14,54.4-.12,9,0,13.73,4.73,13.76,13.89q.08,27.39,0,54.79c0,9.36-4.67,13.94-14.07,14-12.4,0-24.79,0-37.19,0-1.41,0-2.81.13-4.12.2v26.1c13.77,0,27.23,0,40.68,0,10.08,0,14.7,4.6,14.71,14.66q0,26.79,0,53.59c0,10.06-4.62,14.64-14.72,14.66-12.14,0-24.27,0-36.4,0-1.42,0-2.83.12-4.21.19v122a13,13,0,0,0,1.55.21c25.86,0,51.73.19,77.59,0,16.1-.15,26.59-11.28,26.6-27.73q0-152.78,0-305.57c0-17.17-10.82-27.95-28-27.95q-152.6,0-305.17,0c-17.41,0-28.11,10.78-28.12,28.27q0,152.39,0,304.77a36.09,36.09,0,0,0,1,9.1c3.18,12.09,13.25,19.16,27.08,19.17q70,0,140,0Z"/></svg></a>
          <a href=""><svg id="instagram" data-name="Camada 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 509.98 510.76"><defs><linearGradient id="Espectro_" x1="665.21" y1="-100.85" x2="-30.79" y2="590.15" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#36a0d7"/><stop offset="0.2" stop-color="#1c2380"/><stop offset="0.4" stop-color="#bb127e"/><stop offset="0.6" stop-color="#c13125"/><stop offset="0.8" stop-color="#faec40"/><stop offset="1" stop-color="#38924f"/></linearGradient><linearGradient id="Espectro_2" x1="665.19" y1="-100.88" x2="-30.81" y2="590.12" xlink:href="#Espectro_"/><linearGradient id="Espectro_3" x1="664.7" y1="-101.37" x2="-31.3" y2="589.63" xlink:href="#Espectro_"/></defs><title>Instagram</title><path class="cls-1" d="M244.54-15H397.25l8.88.82c19.18,1.73,38.7,1.75,57.46,5.53,49.7,10,84.31,38.84,101.78,87,8.45,23.31,10.41,47.67,10.48,72.18.18,58.55.45,117.11-.17,175.65-.19,18.54-1.47,37.35-5,55.5-9.55,48.92-37.53,83.53-84.45,101.81-22.64,8.81-46.5,11.16-70.51,11.4-53.89.54-107.78,1.05-161.66.76-26.55-.15-53.24-.25-79.36-6.59-42.29-10.26-73.71-34.24-92.39-73.84-11.5-24.37-15-50.58-15.29-77.19-.58-55.21-1.2-110.44-.76-165.65a505.31,505.31,0,0,1,5-69.55C76.5,67.11,93.73,37.43,123,15.49,148-3.32,177.05-10.79,207.75-13,220-13.83,232.27-14.33,244.54-15Zm77,465.81,0-.79c13.48,0,27,.4,40.42-.08,28.89-1,58-.77,86.6-4.27,37.75-4.61,63.6-26,75-63.1,5.24-17,6.13-34.69,6.33-52.31.53-45.24,1.17-90.48.77-135.72-.24-26.9-.91-53.95-4-80.63C522,72.87,495.94,45,455.5,37c-17.64-3.51-36-4.56-54-4.86-44.57-.75-89.15-.61-133.73-.46-25.59.09-51.25-.24-76.61,4.21-38.75,6.81-65.34,31.38-73.25,69.94-3.41,16.65-4.54,34-4.91,51-.87,41.07-1.19,82.17-.74,123.25.32,28.73,1.15,57.56,3.83,86.14,2.49,26.55,14.64,48.88,37.2,64.4,17.42,12,37.34,16.57,58,17.35C248,449.35,284.75,449.9,321.49,450.81Z" transform="translate(-66.09 15)"/><path class="cls-2" d="M190,240.63c-.25-72.27,58.8-131.34,131.29-131.35A131.12,131.12,0,0,1,452.56,240.11c.49,72.23-58.39,131.42-131,131.68C249.29,372,190.28,313.21,190,240.63Zm131,84.91a85.05,85.05,0,1,0-84.78-85.2A84.8,84.8,0,0,0,321.07,325.54Z" transform="translate(-66.09 15)"/><path class="cls-3" d="M458.49,73.52a30.57,30.57,0,0,1-1.38,61.12,30.57,30.57,0,1,1,1.38-61.12Z" transform="translate(-66.09 15)"/></svg></a>
          <a href=""><svg id="whatsapp" data-name="Camada 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 637.88 639.2"><title>Whatsapp</title><path class="cls-1" d="M3.68,560.65l34.16-125c3.1-11.33,6.42-22.6,9.15-34a14.16,14.16,0,0,0-1-9.29C16.07,338.07,2.4,279.85,7.05,218.22c7.85-103.89,55.68-185.66,141.83-244,57.44-38.94,121.87-56.9,191-51.89,125.25,9.06,218,70.59,270.44,184.3,51.13,110.92,38.83,219.67-32.47,319.18C526.66,497.25,455.47,539,368.3,552c-67.45,10.06-131.54-1.52-192.22-32.58a15.32,15.32,0,0,0-9.94-.89q-77.56,20-155,40.42C9,559.47,6.93,559.9,3.68,560.65Zm76.05-75.29c2-.37,2.82-.48,3.65-.69,29.14-7.66,58.32-15.2,87.4-23.1a19,19,0,0,1,16.13,2.26c58.51,34.87,121.55,46.37,188.18,32.72C516,467.69,606.45,334.47,582.34,192.82,561.87,72.56,458-19.52,336.44-24.64,269.23-27.48,208.8-8.22,156.81,34.62,97.42,83.55,65,147.09,60.25,223.92,56.75,280.5,71,333,101.57,380.77c3.54,5.53,4.25,10.26,2.44,16.58C95.71,426.28,88,455.37,79.73,485.36Z" transform="translate(-3.68 78.54)"/><path class="cls-1" d="M218,88a26.56,26.56,0,0,1,14.58,4.92c6.38,4.25,10.18,9.37,13.21,17.27,7.07,18.4,14.87,36.52,22.64,54.64,2.61,6.1,2.53,11.59-1.42,16.9-6.35,8.54-12.54,17.21-19.25,25.46-4.22,5.19-4.88,9.87-1.43,15.71,25.86,43.72,62.09,75.29,109.37,94.09,6.14,2.45,11.21,1.51,15.42-3.72,8.06-10,16.44-19.8,24.16-30.09,4.47-6,9.7-7.79,16.15-4.77,22.46,10.51,44.9,21.09,67.05,32.25,2.68,1.36,5,6.42,5,9.72-.57,33.6-10.45,49.82-46.56,64.95-20.43,8.56-41.59,6.45-62.62.59-76.1-21.21-132.2-69.07-177.14-132.08C183,234,170.23,213.6,164.87,189.52c-7.65-34.31.82-64.05,26.1-88.79A37.55,37.55,0,0,1,199,95C205.33,91.25,210.86,87.94,218,88Z" transform="translate(-3.68 78.54)"/></svg></a>
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
  computed: {
    // dinamicHight() { // calculate the window height variation for the div attached to the pointer stays in the center
    //   let WindowHeight = window.innerHeight
    //   console.log(WindowHeight)
    //   return (WindowHeight - 370)
    // }
  },

  mounted() {
  }

}
</script>