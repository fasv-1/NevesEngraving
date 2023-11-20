<template>
  <div id="dashboard">
    <!------------------------------------------------------------------------Dashboard Menu------------------------------------------------------------------------------------->
    <section id="dash-menu">
      <div class="sticky">
        <!-----------------------Generate the menu home link ---------------------------->
        <div class="dash-nav-link" v-for="(page, index) in pages" :key="index">
          <div class="dash-link-cont" v-if="index == 0">
            <a class="dash-logo" :href="page.link.url" :title="'This link goes to the ' + page.link.text + ' page'"
              @click.prevent="principal(index)">
              <img :src="page.logoPath" :alt="page.logoPath">
            </a>
          </div>
          <!-----------------------Generate the rest of the menu ---------------------------->
          <div class="dash-link-cont" v-else>
            <a aria-current="page" :href="page.link.url" :title="'This link goes to the ' + page.link.text + ' page'"
              @click.prevent="principal(index)">{{ page.link.text }}</a>
            <h3 @click.prevent='toogle(index)'>></h3>
            <div class="dash-nav-option" :class="{ show: id == index && active }">
              <ul>
                <!-----------------------Generate the menu option options ---------------------------->
                <li v-for="(option, chave) in page.options" :key="chave">
                  <a href="" @click.prevent="opcao(option.info, index)">{{ option.info }}</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="blanck-sapce"></div>
      </div>
    </section>
    <!--------------------------------------------------------------Dashboard show-screen----------------------------------------------------------------------------------------->
    <section id="dash-screen">
      {{ activeLink }}
      {{ selectPage }}
      {{ activePage }}
      {{ id }}

      <!---------------- If the active page is home ------------------>
      <div v-if="activePage == 0">
        <h1 class="titulo">{{ pages[activePage].pageTitle }}</h1>
        <p>{{ pages[activePage].content }}</p>
      </div>

      <!---------------- If the selected pages are the principal ones  ------------------>
      <div v-else-if="activePage != 0 && selectPage == ''">
        <h1 class="titulo">{{ pages[activePage].pageTitle }}</h1>
        <p>{{ pages[activePage].content }}</p>
      </div>
      <!---------------- If the selected pages are the opcional ones  ------------------>
      <div v-else>
        <div class="page">
          <content-component :id="selectPage" :title="pages[selectPage].pageTitle"
            :metaTitle="activeLink"></content-component>
        </div>
        <!-- <div class="page" v-if="activeLink == 'Defenições' && selectPage == 1">
          <add-product :id="activeLink" :title="pages[selectPage].pageTitle"
            :metaTitle="pages[selectPage].options[1].info"></add-product>
        </div> -->
      </div>
    </section>
  </div>
</template>

<script>
export default {
  data() {
    return {
      activePage: 0,
      selectPage: '',
      activeLink: '',
      active: false,
      id: "",
      pages: [
        {
          link: { text: 'Home', url: 'dashboard.html' },
          pageTitle: 'Dashboard',
          content: 'Conteúdo de Dashboard',
          logoPath: "storage/images/logos/LogoVetorizado(alt).png",
          alt: "Logo da marca"
        },
        {
          link: { text: 'Produtos', url: 'produtos.html' },
          pageTitle: "Produtos",
          content: 'Conteudo de Produtos',
          options: [
            {
              info: 'Todos',
              content: 'Conteudo de Produtos'
            },
            {
              info: 'Adicionar',
              content: 'Conteudo de Adicionar'
            },
            {
              info: 'Eliminados',
              content: 'Conteudo de Eliminados'
            },
            {
              info: 'Descontos',
              content: 'Conteudo de Descontos'
            },
            {
              info: 'Defenições',
              content: 'Conteudo de Defenições'
            }
            
          ],
        },
        {
          link: { text: 'Conteudo', url: 'conteudo.html' },
          pageTitle: "Conteudo",
          content: 'Conteudo de Conteudo',
          options: [
            {
              info: 'Conteúdo geral',
              content: 'Conteúdo do conteudo geral'
            },
            {
              info: 'Politicas',
              content: 'Conteudo de Politicas'
            },
            {
              info: 'Informação',
              content: 'Conteudo de Informação'
            }
          ],
        },
        {
          link: { text: 'Estatísticas', url: 'estatisticas.html' },
          pageTitle: "Estatísticas",
          content: 'Conteudo de Estatsticas',
          options: [
            {
              info: 'Avaliações',
              content: 'Conteudo de Avaliações'
            },
            {
              info: 'Lucros',
              content: 'Conteudo de Lucros'
            },
            {
              info: 'Pedidos',
              content: 'Conteudo de Pedidos'
            },
            {
              info: 'Logs',
              content: 'Conteudo de Logs'
            }
          ],
        },
        {
          link: { text: 'Clientes', url: 'clientes.html' },
          pageTitle: "Clientes",
          content: 'Conteudo de Clientes',
          options: [
            {
              info: 'Mensagens',
              content: 'Conteudo de Mensagens'
            },
            {
              info: 'Pedidos',
              content: 'Conteudo de Pedidos'
            },
            {
              info: 'Avaliações',
              content: 'Conteudo de Avaliações'
            }
          ],
        },
        {
          link: { text: 'Defenições', url: 'defenições.html' },
          pageTitle: "Defenições",
          content: 'Conteudo de Defenições',
          options: [
            {
              info: 'Cores',
              content: 'Conteudo de Cores'
            },
            {
              info: 'Tipos de Letra',
              content: 'Conteudo de Tipos de Letra'
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
        this.active = !this.active; //toogle the value of the menu options
        this.id = c;// give the index value of the arrow correspondent to the menu option for validation later 
      }
      //if the id have diferent value from the index of menu
      if (this.id != c) {
        this.active = true; //opens the respective options from the menu clicked
        this.id = c;
      }
    },
    principal(e) {
      this.activePage = e;
      this.selectPage = '';// make the diference from menu options and principals
    },
    opcao(x, y) {
      this.activeLink = x; //gives the name of the option selected
      this.activePage = this.id; //gives the same value of the arrow clicked to check if the option selected matches 
      this.selectPage = y;// gives the index value of the option selected 
    }

  },
}
</script>