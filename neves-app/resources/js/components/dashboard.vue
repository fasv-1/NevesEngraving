<template>
  <div id="dashboard">
    <!------------------------------------------------------------------------Dashboard Menu------------------------------------------------------------------------------------->
    <section id="dash-menu">
      <div class="sticky">
        <!-----------------------Generate the menu home (logo) link ---------------------------->
        <div class="dash-nav-link" v-for="(page, index) in pages" :key="index">
          <div class="dash-cont-logo" v-if="index == 0">

            <a href="/dashboard" class="dash-logo" :title="'This link goes to the ' + page.link.text + ' page'"
              @click="principal(index)">

              <img :src="page.logoPath" :alt="page.logoPath">
              <h6 class="marginMinHor">Neves Engraving</h6>
            </a>
          </div>
          <!-----------------------Generate the rest of the menu ---------------------------->
          <div class="dash-link-cont" v-else>
            <div class="link-cont" :class="this.$route.path == page.link.url ? 'active' : ''">
              <a aria-current="page" href="" :title="'This link goes to the ' + page.link.text + ' page'"
                @click.prevent="principal(index)"><router-link :to="page.link.url">{{ page.link.text }}</router-link></a>
              <h3 class="menuIcon" @click.prevent='toogle(index)'>
                <img
                  :src="active == true && id == index ? '/storage/images/Icons/LessIcon.png' : '/storage/images/Icons/PlusIcon.png'">
              </h3>
            </div>
            <div class="dash-nav-option" :class="{ show: id == index && active }">
              <ul>
                <!-----------------------Generate the menu option options ---------------------------->
                <li v-for="(option, chave) in page.options" :key="chave"
                  :class="this.$route.path == option.url ? 'linkActive' : ''">
                  <a href="" @click.prevent="opcao(option.info, index)"><router-link :to="option.url">{{ option.info
                  }}</router-link></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="blanck-sapce"></div>
      </div>
      <div class="color-footer"></div><!--Gradient on the bottom-->
    </section>
    <!--------------------------------------------------------------Dashboard show-screen----------------------------------------------------------------------------------------->
    <section id="dash-screen">
      <!---------------- If the active page is home ------------------>
      <div v-if="this.$route.path == '/dashboard'">
        <div class="page">
          <div class="content">
            <div class="title-cont">
              <h1 class="titulo">Dashboard</h1>
            </div>
          </div>
        </div>
      </div>
      <!---------------- If the selected pages are in the opcion menu  ------------------>
      <div v-else>
        <div class="page">
          <div class="content">
            <router-view></router-view>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!--Gradient on the bottom-->
</template>

<script>
export default {
  props: {
        token: {
            type: String,
            required: true
        }
    },
  data() {
    return {
      activePage: 0, //set the value of the principal pages
      selectedLink: '', //set the index value of the principal pages to link the option selected 
      activeLink: '', //the name of the option selected
      active: false, //set the style to highlight the principal menu selected
      id: "", // for validations
      pages: [
        {
          link: { text: 'Home', url: '/dashboard' },
          pageTitle: 'Dashboard',
          content: '',
          logoPath: "/storage/images/logos/LogoVetorizadoFundBranco.png",
          alt: "Logo da marca"
        },
        {
          link: { text: 'Produtos', url: '/dashboard/produtos' },
          pageTitle: "Produtos",
          content: '',
          options: [
            {
              info: 'Descontos',
              url: '/dashboard/produtos/descontos'
            },
            {
              info: 'Defenições',
              url: '/dashboard/produtos/defenicoes'
            }

          ],
        },
        {
          link: { text: 'Conteudo', url: '/dashboard/conteudo' },
          pageTitle: "Conteudo",
          content: 'Conteudo de Conteudo',
          options: [
            {
              info: 'Politicas',
              url: '/dashboard/conteudo/politicas'
            },
            {
              info: 'Informação',
              url: '/dashboard/conteudo/informacao'
            }
          ],
        },
        {
          link: { text: 'Estatísticas', url: '/dashboard/estatisticas' },
          pageTitle: "Estatísticas",
          content: 'Conteudo de Estatsticas',
          options: [
            {
              info: 'Avaliações',
              url: '/dashboard/estatisticas/avaliacoes'
            },
            {
              info: 'Lucros',
              url: '/dashboard/estatisticas/lucros'
            },
            {
              info: 'Encomendas',
              url: '/dashboard/estatisticas/encomendas'
            },
            {
              info: 'Logs',
              url: '/dashboard/estatisticas/logs'
            }
          ],
        },
        {
          link: { text: 'Utilizadores', url: '/dashboard/users' },
          pageTitle: "Utilizadores",
          content: 'Conteudo de utilizadores',
          options: [
            {
              info: 'Mensagens',
              url: '/dashboard/users/mensagens'
            },
            {
              info: 'Pedidos',
              url: '/dashboard/users/pedidos'
            },
            {
              info: 'Gerir',
              url: '/dashboard/users/gestao'
            }
          ],
        },
        {
          link: { text: 'Defenições', url: '/dashboard/defenicoes' },
          pageTitle: "Defenições",
          content: 'Conteudo de Defenições',
          options: [
            {
              info: 'Cores',
              url: '/dashboard/defenicoes/cores'
            },
            {
              info: 'Tipos de Letra',
              url: '/dashboard/defenicoes/letra'
            }
          ],
        },
      ]

    }
  },
  methods: {
    toogle(c) {

      //if the id have the same value of the index of menu
      if (this.id == c) {
        this.active = !this.active; //toogle the menu options
        this.id = c;// give the index value of the arrow correspondent to the menu option for validation later 
      }
      //if the id have diferent value from the index of menu
      if (this.id != c) {
        this.active = true; //opens the respective options from the menu clicked
        this.id = c;
      }
    },
    principal(e) {
      this.activePage = e;//Sets the active page value from the index of the link clicked
      this.selectedLink = '';// make the diference from menu options and principals
      this.activeLink = '';// sets the activeLink value to null to remove the style from the option
    },
    opcao(x, y) {
      this.activeLink = x; //gives the name of the option selected
      this.activePage = this.id; //gives the same value of the arrow clicked to check if the option selected matches 
      this.selectedLink = y;// gives the index value of the option selected to compare with the menu open
    },

    key(){
      this.$store.state.token = this.token
    },

  },
  mounted(){
    this.key()
  }
}
</script>