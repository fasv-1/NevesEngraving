<template>
    <div id="dashboard">
        <!------------------------------------------------------------------------Dashboard Menu------------------------------------------------------------------------------------->
        <section id="dash-menu">
            <div class="sticky">
                <!-----------------------Generate the menu home (logo) link ---------------------------->
                <div class="dash-nav-link" v-for="(page, index) in pages" :key="index">
                    <div class="dash-cont-logo">

                        <a href="/profile" class="dash-logo" title="Página principal" @click.prevent="principal(index)">
                            {{ page.link.text }}
                        </a>
                    </div>
                    <!-----------------------Generate the rest of the menu ---------------------------->
                </div>
            </div>
            <!-- <div class="color-footer"></div>Gradient on the bottom -->
        </section>
        <!--------------------------------------------------------------Dashboard show-screen----------------------------------------------------------------------------------------->
        <section id="dash-screen">
            <div class="container" v-for="(page, index) in pages" :key="index">
                <div class="content" v-if="index == activePage">
                    <h4>{{ page.pageTitle }}</h4>
                    <p>{{ page.content }}</p>
                </div>
            </div>
            <h4></h4>
        </section>
    </div>
    <!--Gradient on the bottom-->
</template>

<script>
export default {
    props: {
        user: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            activePage: 0, //set the value of the principal pages
            // selectedLink: '', //set the index value of the principal pages to link the option selected 
            // activeLink: '', //the name of the option selected
            // active: false, //set the style to highlight the principal menu selected
            id: "", // for validations
            pages: [
                {
                    link: { text: 'Area pessoal' },
                    pageTitle: 'Area pessoal',
                    content: this.user,
                },
                {
                    link: { text: 'Produtos' },
                    pageTitle: "Produtos",
                    content: 'Alterar tudo',
                },
                {
                    link: { text: 'Conteudo' },
                    pageTitle: "Conteudo",
                    content: 'Conteudo de Conteudo',
                },
                {
                    link: { text: 'Estatísticas' },
                    pageTitle: "Estatísticas",
                    content: 'Conteudo de Estatsticas',
                },
            ]

        }
    },
    methods: {
        toogle(c) {

            //if the id have the same value of the index of menu
            if (this.id == c) {

                //   this.active = !this.active; //toogle the menu options

                this.id = c;// give the index value of the arrow correspondent to the menu option for validation later 
                console.log(this.id)
            }
            //if the id have diferent value from the index of menu
            if (this.id != c) {
                this.active = true; //opens the respective options from the menu clicked
                this.id = c;
            }
        },
        principal(e) {
            this.activePage = e;//Sets the active page value from the index of the link clicked
            console.log(this.activePage)
            // this.selectedLink = '';// make the diference from menu options and principals
            // this.activeLink = '';// sets the activeLink value to null to remove the style from the option
        },
        opcao(x, y) {
            this.activeLink = x; //gives the name of the option selected
            this.activePage = this.id; //gives the same value of the arrow clicked to check if the option selected matches 
            this.selectedLink = y;// gives the index value of the option selected to compare with the menu open
        }

    },
}
</script>

<!-- <script>
import { RouterLink } from 'vue-router';

export default {
    props:{
        user:{
            type: Object,
            required: true
        }
  },
    data() {
        return {
            // user : { data:[] }
        }
    },
    methods: {

        // getUser() {
        //     const cookieValue = document.cookie.split("; ").find((row) => row.startsWith("token="))?.split("=")[1];
        //     let url = "http://localhost:8000/api/user"


        //     axios.get(url, {
        //         headers: {
        //             'Authorization': 'Bearer ' + cookieValue,
        //             // 'X-XSRF-TOKEN' : this.csrf_token
        //         }
        //     })
        //         .then(response => {
        //             if(response.data.email_verified_at == null){
        //                 window.location.replace("/verify-email");
        //             }
        //             this.user.data = response.data
        //             console.log(response)
        //         })
        //         .catch(errors => {
        //             console.log(errors);
        //         })
        // },


    },
    mounted() {
        // console.log(this.id)
        // this.getUser()
    }
}
</script> -->