<template>
  <div class="navbar-container">

    <div class="navbar-logo">
      <router-link to="/home">
        <img src="/storage/images/logos/LogoVetorizadoFundBranco.png" alt="Logo marca">
        <p><b>Neves Engraving</b></p>
      </router-link>
    </div>
    <div class="navbar-top">

      <div class="nav-search">
        <input type="text" placeholder="Search">
        <a href="">
          <svg x="0px" y="0px" viewBox="0 0 1024 1024" style="enable-background:new 0 0 1024 1024;" xml:space="preserve">
            <path id="circulo" class="st0" d="M620,452.7c0,114.5-90.8,205.7-201,205.7c-110.2,0-201-91.3-201-205.7
	C218,338.3,308.8,247,419,247C529.1,247,620,338.3,620,452.7z" />
            <path id="barrinha" class="st1" d="M780.7,738.5c8.6,6,20.6,4,26.7-4.4s4.1-20-4.5-26L780.7,738.5z M574,595.2l206.7,143.4l22.2-30.3
	L596.2,564.9L574,595.2z" />
          </svg>
        </a>
      </div>

      <div class="nav-icons">

        <div class="contacts">
          <svg x="0px" y="0px" viewBox="0 0 1024 1024" style="enable-background:new 0 0 1024 1024;" xml:space="preserve">
            <path id="telefone" class="st0" d="M226.4,424.3C244.7,580,397.5,722.4,562.4,751c101.6,17.6,228-4.4,236.9-46.5
	c8-37.9-77-103.7-121.1-85.9c-24.1,9.7-18.7,37.6-40.1,52.4C563.6,722.6,297.7,523.1,327,433.5c7-21.5,27.1-24.5,31.8-50.8
	c9.5-53.4-58.9-125.2-95.2-114.8C228.5,277.9,219.4,365.4,226.4,424.3z" />
            <g id="ondas">
              <path class="st0 first" d="M418.1,362.3c21.7-1.4,102-3.8,176.5,52.6c60.9,46.1,83.7,105.7,91.2,128.6" />
              <path class="st0 second" d="M404.1,297.3c18.8-3.8,123.1-22.8,223,44.9C726,409.3,747.4,512,751,531.1" />
              <path class="st0 third"
                d="M385.5,240c29.8-10.8,97.5-30.6,179.6-12.4C674.7,252,735,327.4,752.5,349.9c51.5,66.4,65.3,135,69.7,168.8" />
            </g>
          </svg>
          <router-link to="/home/contacts">contacts</router-link>
        </div>

        <div class="logs">
          <svg x="0px" y="0px" viewBox="0 0 1024 1024" style="enable-background:new 0 0 1024 1024;" xml:space="preserve">
            <path id="cabeça" class="st0" d="M660.5,372.5c-14.7,71.1-81.8,119.2-148.5,119.9c-78.8,0.8-156.5-64.8-158.5-151
	C351.4,250.2,435,174.2,523,183.1C612.4,192.1,678.5,285.7,660.5,372.5z" />
            <path id="corpo" class="st0" d="M213.3,801.3c-2.1-43.7-4.4-92.1-6.8-145.3c-2.2-49-3-76,15.6-99c39.8-49.3,115.4-14.3,282.8-14.1
	c171,0.2,247-36.2,288.6,14.1c18.5,22.4,19,48.4,18,100.5c-0.8,39.9-2.3,86.4-5.1,138.8" />
          </svg>
          <a href="">login/signup</a>
        </div>

        <div class="shopping-cart">
          <router-link to="/home/shopping_cart">
            <svg x="0px" y="0px" viewBox="0 0 1024 1024" style="enable-background:new 0 0 1024 1024;"
              xml:space="preserve">
              <g id="carrinho">
                <ellipse class="st0" cx="334.2" cy="724.4" rx="62.1" ry="64.9" />
                <ellipse class="st0" cx="635.1" cy="725.1" rx="62.1" ry="64.9" />
                <polygon class="st0" points="282.1,622.2 678.5,622.2 718,364.2 230.8,364.2 	" />
                <line class="st0" x1="241.8" y1="419.5" x2="709.5" y2="419.5" />
                <line class="st0" x1="256.5" y1="493.2" x2="698.2" y2="493.2" />
                <line class="st0" x1="270.7" y1="578.6" x2="682.4" y2="578.5" />
                <line class="st0" x1="628.2" y1="364.2" x2="595.1" y2="622.2" />
                <line class="st0" x1="305.6" y1="364.2" x2="355.8" y2="613.2" />
                <line class="st0" x1="427.4" y1="364.2" x2="429.5" y2="622.2" />
                <line class="st0" x1="528.9" y1="364.2" x2="528.9" y2="616.5" />
                <polyline class="st0" points="112.8,207.9 131.4,207.9 181.7,207.9 230.8,364.2 	" />
                <ellipse cx="112.8" cy="207.5" rx="13.8" ry="10" />
              </g>
              <g id="prenda">
                <rect x="380.5" y="324.4" class="st1" width="240.2" height="265.7" />
                <path class="st1" d="M494.9,324.4c-15.6,0.3-51.8,0.9-76.9-23.4c-7.6-7.3-18.9-21.5-15-27.9c4.5-7.3,29.2-4.4,48,6.9
		C479.2,296.9,481,324.8,494.9,324.4c13-0.4,13-24.8,37.1-41.4c21.9-15.1,52.3-15.7,56-8c3.7,7.7-18.7,25.2-21,27
		C539.5,323.2,508,324.2,494.9,324.4z" />
                <path class="st1" d="M504.4,311.7c0,6.6-5.4,12.3-11.4,11.9c-6.6-0.4-11.1-7.9-9.9-14.4c0.9-4.8,4.9-9.2,9.9-9.4
		C499,299.4,504.4,305.2,504.4,311.7z" />
              </g>
            </svg>
          </router-link>
        </div>

      </div>
    </div>
    <div class="navbar-links">
      <div class="start-links">
        <router-link to="/home/amazing_gifts" @click="clearStorage()">
          <h5 >AMAZING GIFTS</h5>
        </router-link>
        <router-link to="/home/engraving" @click="clearStorage()">
          <h5>ENGRAVING</h5>
        </router-link>
      </div>
      <div class="end-links">
        <router-link to="/home/lazer_cut" @click="clearStorage()">
          <h5>LAZER CUT</h5>
        </router-link>
        <router-link to="/home/business_cards" @click="clearStorage()">
          <h5>BUSINESS CARDS</h5>
        </router-link>
      </div>
    </div>
  </div>
  <breadcrumb-component></breadcrumb-component>
</template>

<script>
export default {
  methods:{
    clearStorage(){
      localStorage.clear();
      // location.reload();
    }
  },
}
</script>