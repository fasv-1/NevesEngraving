<template>
    <div id="profile">
        <!------------------------------------------------------------------------Dashboard Menu------------------------------------------------------------------------------------->
        <section id="profile-menu">
            <div class="sticky">
                <!----------------------------------------Generate the menu home--------------------------------------->
                <div class="dash-nav-link" v-for="(page, index) in pages" :key="index">
                    <div :class="activePage == index ? 'link-cont active' : 'link-cont'">

                        <a href="" class="" title="Página principal" @click.prevent="principal(index)">
                            {{ page.link.text }}
                        </a>
                    </div>
                </div>
            </div>
            {{ page }}
        </section>
        <!--------------------------------------------------------------show-area----------------------------------------------------------------------------------------->
        <section id="dash-screen">
            <div class="profile-container" v-for="(page, index) in pages" :key="index">
                <div class="content" v-if="index == activePage">
                    <div class="title text-red">
                        <h3>{{ page.pageTitle }}</h3>
                    </div>

                    <!----------------------------------Area pessoal------------------------------------------------------->
                    <div class="fields" v-if="index == 0">
                        <div class="update-link">
                            <a href="" @click.prevent="updatePage(4)"><img class="edit-btn"
                                    src="/storage/images/Icons/edit-square-icon.svg" style="width:30px" alt=""></a>
                        </div>
                        <div class="field">
                            <p>Nome</p>
                            <h4>{{ user.name }}</h4>
                        </div>
                        <div class="field">
                            <p>Email</p>
                            <h4>{{ user.email }}</h4>
                        </div>

                    </div>

                    <!----------------------------------Info pessoal------------------------------------------------------->
                    <div class="fields" v-if="index == 1 && userDetails.data != ''">
                        <div class="field" v-if="userDetails.data.details == ''">
                            <a href="" @click.prevent="updatePage(6)"><b>Adicionar morada +</b></a>
                        </div>
                        <div class="dinamyc-fields" v-else>
                            <div class="update-link">
                                <a href="" @click.prevent="updatePage(5)">
                                    <img class="edit-btn" src="/storage/images/Icons/edit-square-icon.svg"
                                        style="width:30px" alt="">
                                </a>
                            </div>
                            <div class="field">
                                <h6>Morada</h6>
                                <h4>{{ addressInfo.morada1 }}</h4>
                            </div>
                            <div class="field">
                                <h6>Morada adicional</h6>
                                <h4>{{ addressInfo.morada2 }}</h4>
                            </div>
                            <div class="field">
                                <h6>Contacto telefónico</h6>
                                <h4>{{ addressInfo.telemovel }}</h4>
                            </div>
                            <div class="field">
                                <h6>Cidade</h6>
                                <h4>{{ addressInfo.cidade }}</h4>
                            </div>
                            <div class="field">
                                <h6>País</h6>
                                <h4>{{ addressInfo.pais }}</h4>
                            </div>
                            <div class="field">
                                <h6>Código postal</h6>
                                <h4>{{ addressInfo.codigo_postal }}</h4>
                            </div>
                        </div>
                    </div>

                    <!----------------------------------Favoritos------------------------------------------------------->
                    <div class="fields" v-if="index == 2">
                        <div class="favorites">
                            <card-component :products=favoriteProducts :headTitle='false' :info="{
                                nome: false, meta_nome: true, categoria: false, materia: false, quantidade: false, valor: false
                            }" :cart="true">
                            </card-component>
                        </div>
                    </div>

                    <!----------------------------------Comentarios------------------------------------------------------->
                    <div class="fields" v-if="index == 3">
                        <div class="coments" v-for="review in userReviews.data">
                            <div class="coments-container" v-if="review.comentario != null">
                                <div class="content">
                                    <h5 class="title">{{ review.produto.meta_nome }}</h5>
                                    <p>"{{ review.comentario }}"</p>
                                </div>
                                <div class="buttons">
                                    <a href="" v-if="review.id" @click.prevent="destroy(review.id, 'comments')"><img
                                            class="delete-btn" src="/storage/images/Icons/delete.svg" style="width:30px"
                                            alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!----------------------------------Update Credencials------------------------------------------------------->
            <div class="content" v-if="activePage == 4">
                <div class="title">
                    <h3>Atualizar dados de registo</h3>
                </div>
                <div class="fields">
                    <form method="patch" action="" @submit.prevent="updateCredencials($event)">
                        <div class="field">
                            <input-container id="updateName" title="Atualizar nome de usuario" help="updateName"
                                helpText="Nome de usuário">
                                <input type="text" name="updateName" aria-describedby="updateName" v-model="updateName">
                            </input-container>
                        </div>
                        <div class="field">
                            <input-container id="updateEmail" title="Atualizar email de usuario" help="updateEmail"
                                helpText="Email de usuário (caso o faça, é necessário validar o novo email)">
                                <input type="text" name="updateEmail" aria-describedby="updateEmail"
                                    v-model="updateEmail">
                            </input-container>
                        </div>
                        <div class="field">
                            <button type="submit" class="button1">Atualizar</button>
                        </div>
                    </form>
                </div>
            </div>
            <!----------------------------------Update Adress and Info------------------------------------------------------->
            <div class="content" v-if="activePage == 5">
                <div class="title">
                    <h3>Atualizar morada e informação do usuário</h3>
                </div>
                <div class="fields">
                    <form method="patch" action="" @submit.prevent="updateAdress($event, addressInfo.id)">
                        <div class="field">
                            <input-container id="morada1" title="Atualizar morada" help="updateMorada1"
                                helpText="Digite a nova morada de usuário" size="ml-input">
                                <input type="text" name="updateMorada1" aria-describedby="updateMorada1"
                                    :placeHolder="addressInfo.morada1" v-model="updateMorada1">
                            </input-container>
                        </div>
                        <div class="field">
                            <input-container id="morada2" title="Atualizar morada adicional" help="updateMorada2"
                                helpText="Digite a nova morada adicional" size="ml-input">
                                <input type="text" name="updateMorada2" aria-describedby="updateMorada2"
                                    :placeHolder="addressInfo.morada2" v-model="updateMorada2">
                            </input-container>
                        </div>
                        <div class="field">
                            <input-container id="telemovel" title="Atualizar contato telefónico" help="updateTelemovel"
                                helpText="Digite o novo contato telefonico">
                                <input type="text" name="updateTelemovel" aria-describedby="updateTelemovel"
                                    :placeHolder="addressInfo.telemovel" v-model="updateTelemovel">
                            </input-container>
                        </div>
                        <div class="side-fields">
                            <div class="side">
                                <input-container id="cidade" title="Atualizar cidade" help="updateCidade"
                                    helpText="Digite a nova cidade">
                                    <input type="text" name="updateCidade" aria-describedby="updateCidade"
                                        :placeHolder="addressInfo.cidade" v-model="updateCidade">
                                </input-container>
                            </div>
                            <div class="side">
                                <input-container id="pais" title="Atualizar país" help="updatePais"
                                    helpText="Digite um novo país">
                                    <input type="text" name="updatePais" aria-describedby="updatePais"
                                        :placeHolder="addressInfo.pais" v-model="updatePais">
                                </input-container>
                            </div>
                            <div class="side">
                                <input-container id="codigo_postal" title="Atualizar código-postal" help="updateCodigo"
                                    helpText="Digite um novo código-postal">
                                    <input type="text" name="updateCodigo" aria-describedby="updateCodigo"
                                        :placeHolder="addressInfo.codigo_postal" v-model="updateCodigo">
                                </input-container>
                            </div>

                        </div>

                        <div class="button">
                            <button type="submit" class="button1">Atualizar</button>
                        </div>
                    </form>
                </div>
            </div>

            <!----------------------------------Add new Adress and info ------------------------------------------------------->
            <div class="content" v-if="activePage == 6">
                <div class="title">
                    <h3>Adicionar morada e informação do usuário</h3>
                </div>
                <div class="fields">
                    <form method="patch" action="" @submit.prevent="saveAdress($event)">
                        <div class="field">
                            <input-container id="morada1" title="Morada" help="Morada1"
                                helpText="Digite a morada de usuário" size="ml-input">
                                <input type="text" name="Morada1" aria-describedby="Morada1" v-model="Morada1" required>
                            </input-container>
                        </div>
                        <div class="field">
                            <input-container id="morada2" title="Morada adicional" help="Morada2"
                                helpText="Digite a morada adicional" size="ml-input">
                                <input type="text" name="Morada2" aria-describedby="Morada2" v-model="Morada2" required>
                            </input-container>
                        </div>
                        <div class="field">
                            <input-container id="telemovel" title="Contato telefónico" help="Telemovel"
                                helpText="Digite o novo contato telefonico">
                                <input type="text" name="Telemovel" aria-describedby="Telemovel" v-model="Telemovel">
                            </input-container>
                        </div>
                        <div class="side-fields">
                            <div class="side">
                                <input-container id="cidade" title="Cidade" help="Cidade" helpText="Digite a cidade">
                                    <input type="text" name="Cidade" aria-describedby="Cidade" required
                                        v-model="Cidade">
                                </input-container>
                            </div>
                            <div class="side">
                                <input-container id="pais" title="País" help="Pais" helpText="Digite um país">
                                    <input type="text" name="Pais" aria-describedby="Pais" required v-model="Pais">
                                </input-container>
                            </div>
                            <div class="side">
                                <input-container id="codigo_postal" title="Código-postal" help="Codigo"
                                    helpText="Digite o seu código-postal">
                                    <input type="text" name="Codigo" aria-describedby="Codigo" required
                                        v-model="Codigo">
                                </input-container>
                            </div>
                        </div>
                        <div class="button">
                            <button type="submit" class="button1">Atualizar</button>
                        </div>
                    </form>
                </div>
            </div>
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
        },
        token: {
            type: String,
            required: true
        },
    },
    data() {
        return {
            activePage: localStorage.getItem('activePage'), //set the value of the principal pages
            // selectedLink: '', //set the index value of the principal pages to link the option selected 
            // activeLink: '', //the name of the option selected
            // active: false, //set the style to highlight the principal menu selected
            // id: "", // for validations
            userDetails: { data: [] },
            userReviews: { data: [] },
            userFavorites: { data: [] },
            productsImages: { data: [] },
            updateName: this.user.name,
            updateEmail: this.user.email,
            updateMorada1: '',
            updateMorada2: '',
            updateTelemovel: '',
            updateCidade: '',
            updatePais: '',
            updateCodigo: '',
            Morada1: '',
            Morada2: '',
            Telemovel: '',
            Cidade: '',
            Pais: '',
            Codigo: '',

            pages: [
                {
                    link: { text: 'Area pessoal' },
                    pageTitle: 'Area pessoal',
                },
                {
                    link: { text: 'Informação pessoal' },
                    pageTitle: "Informação pessoal",
                },
                {
                    link: { text: 'Favoritos' },
                    pageTitle: "Favoritos",
                },
                {
                    link: { text: 'Comentários' },
                    pageTitle: "Comentários",
                },
            ],

        }
    },
    methods: {
        timeOut() {
            setTimeout(() => {
                if (this.$route.query.wish) {
                    localStorage.setItem('activePage', this.$route.query.wish);
                    this.activePage = localStorage.getItem('activePage');
                }
            }, 500);
        },
        updateAdress(e, id) {
            let url = this.$store.state.Url + 'api/user_details/' + id

            let formData = new FormData();
            formData.append('_method', 'PATCH')

            if (this.updateMorada1 != '') {
                formData.append('morada1', this.updateMorada1)
            }
            if (this.updateMorada2 != '') {
                formData.append('morada2', this.updateMorada2)
            }
            if (this.updateTelemovel != '') {
                formData.append('telemovel', this.updateTelemovel)
            }
            if (this.updateCidade != '') {
                formData.append('cidade', this.updateCidade)
            }
            if (this.updatePais != '') {
                formData.append('pais', this.updatePais)
            }
            if (this.updateCodigo != '') {
                formData.append('codigo_postal', this.updateCodigo)
            }

            let config = {
                headers: {
                    'Authorization': 'Bearer ' + this.token,
                    'Content-Type': 'x-www-form-urlencoded',
                    'Accept': 'application/json',

                }
            }

            axios.post(url, formData, config)
                .then(response => {
                    this.userData()
                    localStorage.setItem('activePage', 1)
                    e.target.submit()
                })
                .catch(errors => {
                    this.$store.state.transaction.status = 'error-update'
                    this.$store.state.transaction.message = errors.response.data.errors
                    console.log(errors)
                })
        },
        saveAdress(e) {
            let url = this.$store.state.Url + 'api/user_details/'

            let formData = new FormData();
            // formData.append('_method', 'PATCH')

            formData.append('user_id', this.user.id)

            formData.append('morada1', this.Morada1)

            formData.append('morada2', this.Morada2)

            if (this.Telemovel != '') {
                formData.append('telemovel', this.Telemovel)
            }

            formData.append('cidade', this.Cidade)

            formData.append('pais', this.Pais)

            formData.append('codigo_postal', this.Codigo)


            let config = {
                headers: {
                    'Authorization': 'Bearer ' + this.token,
                    'Content-Type': 'x-www-form-urlencoded',
                    'Accept': 'application/json',

                }
            }

            axios.post(url, formData, config)
                .then(response => {
                    this.userData()
                    localStorage.setItem('activePage', 1)
                    e.target.submit()
                })
                .catch(errors => {
                    this.$store.state.transaction.status = 'error-update'
                    this.$store.state.transaction.message = errors.response.data.errors
                    console.log(errors)
                })
        },
        updateCredencials(e) {
            let url = this.$store.state.Url + 'profile'

            let formData = new FormData();
            formData.append('_method', 'patch')

            formData.append('name', this.updateName)
            formData.append('email', this.updateEmail)

            let config = {
                headers: {
                    'Content-Type': 'x-www-form-urlencoded',
                    'Accept': 'application/json',

                }
            }

            axios.post(url, formData, config)
                .then(response => {
                    this.userData()
                    localStorage.setItem('activePage', 0)
                    e.target.submit()
                })
                .catch(errors => {
                    console.log(errors)
                })
        },
        updatePage(n) {
            localStorage.setItem('activePage', n);
            this.activePage = localStorage.getItem('activePage');
        },
        encrypt(id) {
            let idEncode = btoa(id)
            return idEncode
        },
        getImage() {
            let urlImages = this.$store.state.Url + 'api/imagens_produto'

            //get all the products image
            axios.get(urlImages)
                .then(response => {
                    this.productsImages.data = response.data
                })
                .catch(errors => {
                    console.log(errors);
                })
        },
        principal(e) {
            localStorage.setItem('activePage', e);//Sets the active page value from the index of the link clicked
            this.activePage = localStorage.getItem('activePage');
            // console.log(this.activePage)
        },
        userData() {
            if (localStorage.getItem('activePage') == null) {
                this.activePage = 0
            }
            let urlUserDetails = this.$store.state.Url + 'api/user_details?filtro=user_id:=:' + this.user.id
            let urlUserFavorites = this.$store.state.Url + 'api/user_favorites?filtro=user_id:=:' + this.user.id
            let urlUserReviews = this.$store.state.Url + 'api/user_reviews?filtro=user_id:=:' + this.user.id

            axios.get(urlUserDetails, {
                headers: {
                    'Authorization': 'Bearer ' + this.token,
                }
            })
                .then(response => {
                    this.userDetails.data = response.data
                    // console.log(response.data)
                })
                .catch(errors => {
                    console.log(errors);
                })

            axios.get(urlUserFavorites)
                .then(response => {
                    this.userFavorites.data = response.data.favorites
                })
                .catch(errors => {
                    console.log(errors);
                })

            axios.get(urlUserReviews)
                .then(response => {
                    this.userReviews.data = response.data.review
                    // console.log(response.data)
                })
                .catch(errors => {
                    console.log(errors);
                })
        },
        destroy(id, f) {
            if (f == 'favorites') {
                let url = this.$store.state.Url + 'api/user_favorites/' + id

                if (confirm("Tem a certeza que pretende eliminar este registo?")) {
                    let formData = new FormData();
                    formData.append('_method', 'delete')

                    axios.post(url, formData)
                        .then(response => {
                            alert(response.data.msg)
                            this.userData()
                        })
                        .catch(errors => {
                            console.log(errors.response.data)
                        })

                }
            }
            if (f == 'comments') {
                let url = this.$store.state.Url + 'api/user_reviews/' + id

                if (confirm("Tem a certeza que pretende eliminar este registo?")) {
                    let formData = new FormData();
                    formData.append('_method', 'delete')

                    axios.post(url, formData)
                        .then(response => {
                            // console.log(response.data)
                            alert(response.data.msg)
                            this.userData()
                        })
                        .catch(errors => {
                            console.log(errors.response.data)
                        })

                }
            }
        }

    },
    computed: {
        addressInfo() {
            let info = {}
            Object.values(this.userDetails.data).forEach(value => {
                Object.values(value).forEach(i => {
                    info = i
                })
            })
            return info
        },
        favoriteProducts() {
            let info = []
            Object.values(this.userFavorites.data).forEach(value => {
                info.push(value.produto)
            })
            return info
        }
    },

    mounted() {
        this.userData()
        this.getImage()
        this.timeOut()
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