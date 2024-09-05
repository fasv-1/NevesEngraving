<script setup>
import { ref } from 'vue'

const checkedIntro = ref([])
</script>
<template>
    <div class="container">
        <div class="">
            <div class="titulo">
                <h1>Conteudo</h1>
            </div>
        </div>
        <div class="dynamic-box">
            <!-----------------------------------------Box menu--------------------------------------------->
            <div class="box-menu">
                <div class="option" :class="optionSelected == 0 ? 'active' : ''" @click="select(0)">
                    <h5>Home</h5>
                </div>
                <div class="option" :class="optionSelected == 1 ? 'active' : ''" @click="select(1)">
                    <h5>Amazing Gifts</h5>
                </div>
                <div class="option" :class="optionSelected == 2 ? 'active' : ''" @click="select(2)">
                    <h5>Engraving</h5>
                </div>
                <div class="option" :class="optionSelected == 3 ? 'active' : ''" @click="select(3)">
                    <h5>Lazer Cut</h5>
                </div>
                <div class="option" :class="optionSelected == 4 ? 'active' : ''" @click="select(4)">
                    <h5>Contacts</h5>
                </div>
                <div class="option" :class="optionSelected == 5 ? 'active' : ''" @click="select(5)">
                    <h5>Shopping Cart</h5>
                </div>
                <div class="option" :class="optionSelected == 6 ? 'active' : ''" @click="select(6)">
                    <h5>Footer</h5>
                </div>
            </div>
            <div class="info">
                <!-----------------------------------------Home Intro --------------------------------------------->
                <div class="option-selected" v-if="optionSelected == 0">
                    <div class="text">
                        <div class="title">
                            <h4 class="text-grey">Seleciona uma introdução para a página principal</h4>
                        </div>
                        <div id="intro-option">
                            <div class="responsive-container responsive-between mrgvert1">
                                <div class="responsive-container">
                                    <h6><b>Animações e Info</b></h6>
                                    <button class="toogle-bg mrghor1" @click="openHome(1)"><img
                                            :class="home == 1 && openMenu == true ? 'rotate' : ''"
                                            src="/storage/images/Icons/arrow-black.png" alt=""></button>
                                </div>
                                <div class="responsive-container">
                                    <input type="radio" id="animInfo" value="animInfo" v-model="checkedIntro" />
                                </div>
                            </div>
                            <div class="manage-info">
                                <div class="brick" v-if="openMenu == true && home == 1">
                                    <div class="home-intro" v-for="content, index in appContent.data" :key=index>
                                        <!------------------------------- Brick 1 update------------------------------------->

                                        <!------------------------------- titulo update------------------------------------->
                                        <div class="home-anim" v-if="content.posicao == 'home_brick_1'">
                                            <div class="title responsive-center" v-if="updateShow != content.titulo">
                                                <h1>{{ content.titulo }}</h1>
                                                <img class="edit-btn mrghor1"
                                                    src="/storage/images/Icons/edit-square-icon.svg" alt=""
                                                    style="width: 30px;" @click="editfield(content.titulo)">
                                            </div>
                                            <div class="flex-container width100 responsive-center"
                                                v-if="updateShow == content.titulo">
                                                <div class="width70">
                                                    <input-container id="titulo" title='Editar titulo' help="editHelp"
                                                        helpText="Titulo atualizado">
                                                        <input type="text" name="titulo" v-model="editValue">
                                                    </input-container>
                                                </div>
                                                <div class="mrghor2">
                                                    <button class="button-small"
                                                        @click="update(content.id, 'titulo')">Atualizar</button>
                                                </div>
                                            </div>
                                            <!------------------------------- descricao update------------------------------------->
                                            <div class="text-centered mrgTextCenter"
                                                v-if="updateShow != content.descricao">
                                                <h6>{{ content.descricao }}</h6>
                                                <img class="edit-btn mrghor1"
                                                    src="/storage/images/Icons/edit-square-icon.svg" alt=""
                                                    style="width: 30px;" @click="editfield(content.descricao)">
                                            </div>
                                            <div class="flex-container width100 responsive-center"
                                                v-if="updateShow == content.descricao">
                                                <div class="width70">
                                                    <input-container id="descricao" title='Editar descrição'
                                                        help="editHelp" helpText="Descrição atualizada">
                                                        <textarea name="descricao"
                                                            v-model="editValue">{{ editValue }}</textarea>
                                                    </input-container>
                                                </div>
                                                <div class="mrghor2">
                                                    <button class="button-small"
                                                        @click="update(content.id, 'descricao')">Atualizar</button>
                                                </div>
                                            </div>

                                        </div>

                                        <!------------------------------- Brick 2 update------------------------------------->

                                        <!------------------------------- Titulo update------------------------------------->
                                        <div class="home-anim" v-if="content.posicao == 'home_brick_2'">
                                            <div class="title" v-if="updateShow != content.titulo">
                                                <h2>{{ content.titulo }}</h2>
                                                <img class="edit-btn mrghor1"
                                                    src="/storage/images/Icons/edit-square-icon.svg" alt=""
                                                    style="width: 30px;" @click="editfield(content.titulo)">
                                            </div>
                                            <div class="flex-container width100 responsive-center"
                                                v-if="updateShow == content.titulo">
                                                <div class="width70">
                                                    <input-container id="titulo" title='Editar titulo' help="editHelp"
                                                        helpText="Titulo atualizado">
                                                        <input type="text" name="titulo" v-model="editValue">
                                                    </input-container>
                                                </div>
                                                <div class="mrghor2">
                                                    <button class="button-small"
                                                        @click="update(content.id, 'titulo')">Atualizar</button>
                                                </div>
                                            </div>
                                            <div class="responsive-container row-reverse">
                                                <!------------------------------- animation update------------------------------------->
                                                <div class="animation">
                                                    <img src="/storage/images/gerais/EngravingAnim.gif" alt=""
                                                        height="200">
                                                </div>

                                                <!------------------------------- descricao update------------------------------------->
                                                <div class="text" v-if="updateShow != content.descricao">
                                                    {{ content.descricao }}
                                                    <img class="edit-btn mrghor1"
                                                        src="/storage/images/Icons/edit-square-icon.svg" alt=""
                                                        style="width: 30px;" @click="editfield(content.descricao)">
                                                </div>
                                                <div class="flex-container width100 responsive-center"
                                                    v-if="updateShow == content.descricao">
                                                    <div class="width70">
                                                        <input-container id="descricao" title='Editar descrição'
                                                            help="editHelp" helpText="Descrição atualizada">
                                                            <textarea name="descricao"
                                                                v-model="editValue">{{ editValue }}</textarea>
                                                        </input-container>
                                                    </div>
                                                    <div class="mrghor2">
                                                        <button class="button-small"
                                                            @click="update(content.id, 'descricao')">Atualizar</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <!------------------------------- Brick 3 update------------------------------------->

                                        <div class="home-anim" v-if="content.posicao == 'home_brick_3'">
                                            <!------------------------------- title update------------------------------------->
                                            <div class="title responsive-end" v-if="updateShow != content.titulo">
                                                <h2>{{ content.titulo }}</h2>
                                                <img class="edit-btn mrghor1"
                                                    src="/storage/images/Icons/edit-square-icon.svg" alt=""
                                                    style="width: 30px;" @click="editfield(content.titulo)">
                                            </div>
                                            <div class="flex-container width100 responsive-center"
                                                v-if="updateShow == content.titulo">
                                                <div class="width70">
                                                    <input-container id="titulo" title='Editar titulo' help="editHelp"
                                                        helpText="Titulo atualizado">
                                                        <input type="text" name="titulo" v-model="editValue">
                                                    </input-container>
                                                </div>
                                                <div class="mrghor2">
                                                    <button class="button-small"
                                                        @click="update(content.id, 'titulo')">Atualizar</button>
                                                </div>
                                            </div>
                                            <!------------------------------- animation update------------------------------------->
                                            <div class="animation">
                                                <video autoplay loop>
                                                    <source src="/storage/videos/lazer-cut-clip.mp4" type="video/mp4">
                                                </video>
                                            </div>
                                            <!------------------------------- descricao update------------------------------------->
                                            <div class="text" v-if="updateShow != content.descricao">
                                                {{ content.descricao }}
                                                <img class="edit-btn mrghor1"
                                                    src="/storage/images/Icons/edit-square-icon.svg" alt=""
                                                    style="width: 30px;" @click="editfield(content.descricao)">
                                            </div>
                                            <div class="flex-container width100 responsive-center"
                                                v-if="updateShow == content.descricao">
                                                <div class="width70">
                                                    <input-container id="descricao" title='Editar descrição'
                                                        help="editHelp" helpText="Descrição atualizada">
                                                        <textarea name="descricao"
                                                            v-model="editValue">{{ editValue }}</textarea>
                                                    </input-container>
                                                </div>
                                                <div class="mrghor2">
                                                    <button class="button-small"
                                                        @click="update(content.id, 'descricao')">Atualizar</button>
                                                </div>
                                            </div>
                                        </div>

                                        <!------------------------------- Brick 4 update------------------------------------->

                                        <div class="home-anim" v-if="content.posicao == 'home_brick_4'">
                                            <!------------------------------- title update------------------------------------->
                                            <div class="title" v-if="updateShow != content.titulo">
                                                <h2>{{ content.titulo }}</h2>
                                                <img class="edit-btn mrghor1"
                                                    src="/storage/images/Icons/edit-square-icon.svg" alt=""
                                                    style="width: 30px;" @click="editfield(content.titulo)">
                                            </div>
                                            <div class="flex-container width100 responsive-center"
                                                v-if="updateShow == content.titulo">
                                                <div class="width70">
                                                    <input-container id="titulo" title='Editar titulo' help="editHelp"
                                                        helpText="Titulo atualizado">
                                                        <input type="text" name="titulo" v-model="editValue">
                                                    </input-container>
                                                </div>
                                                <div class="mrghor2">
                                                    <button class="button-small"
                                                        @click="update(content.id, 'titulo')">Atualizar</button>
                                                </div>
                                            </div>
                                            <div class="responsive-container row-reverse">
                                                <!------------------------------- animation update------------------------------------->
                                                <div class="animation">
                                                    <video autoplay loop>
                                                        <source src="/storage/videos/heartAcembling-clip.mp4"
                                                            type="video/mp4">
                                                    </video>
                                                </div>
                                                <!------------------------------- descricao update------------------------------------->
                                                <div class="text" v-if="updateShow != content.descricao">
                                                    {{ content.descricao }}
                                                    <img class="edit-btn mrghor1"
                                                        src="/storage/images/Icons/edit-square-icon.svg" alt=""
                                                        style="width: 30px;" @click="editfield(content.descricao)">
                                                </div>
                                                <div class="flex-container width100 responsive-center"
                                                    v-if="updateShow == content.descricao">
                                                    <div class="width70">
                                                        <input-container id="descricao" title='Editar descrição'
                                                            help="editHelp" helpText="Descrição atualizada">
                                                            <textarea name="descricao"
                                                                v-model="editValue">{{ editValue }}</textarea>
                                                        </input-container>
                                                    </div>
                                                    <div class="mrghor2">
                                                        <button class="button-small"
                                                            @click="update(content.id, 'descricao')">Atualizar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="intro-option">
                            <div class="responsive-container responsive-between mrgvert1">
                                <div class="responsive-container">
                                    <h6><b>Slider e melhores produtos</b></h6>
                                    <button class="toogle-bg mrghor1" @click="openHome(2)"><img
                                            :class="home == 2 && openMenu == true ? 'rotate' : ''"
                                            src="/storage/images/Icons/arrow-black.png" alt=""></button>
                                </div>
                                <div class="responsive-container">
                                    <input type="radio" id="slider" value="slider" v-model="checkedIntro" />
                                </div>
                            </div>
                            <div class="manage-info">
                                <!---------------------------- Slider ----------------------------------------------->
                                <div class="responsive-container" v-if="openMenu == true && home == 2">
                                    <div class="flex-container width100 responsive-end margin1">
                                        <a href="#addSlide"><button>Adicionar slide</button></a>
                                    </div>
                                    <div class="general-card" v-for="slide, index in sliderInfo">
                                        <div class="card-title">
                                            <h6>Slide nº {{ index + 1 }}</h6>
                                        </div>
                                        <div class="card-body">
                                            <img :id="index" :src="'/storage/' + slide.media" alt="imgSlide">
                                            <div class="card-info">
                                                <h5>{{ slide.titulo }}</h5>
                                                <p>{{ slide.descricao }}</p>
                                            </div>
                                        </div>
                                        <div class="card-buttons">
                                            <button class="btn-rmv" @click="remove(slide.id)">
                                                <h1>x</h1>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!--Modal to add new slide || !!!!!!!!!!!!!!!!!!!!!!!!!!!!! Continuar !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->
                                <form method="POST" action="" @submit.prevent="addSlide($event)">
                                    <modal-component id="addSlide" title="Adicionar uma categoria" dataClean="image">
                                        <template v-slot:content>
                                            <input-container id="media" title='Adicionar imagem' help="newImageHelp"
                                                helpText="Insira uma imagen para o slide (o tamanho da imagem não deve exceder os 2MB)">
                                                <label class="imageButton">
                                                    <input type="file" name="media" class="form-image"
                                                        aria-describedby="newProductImage" placeholder="Nome do produto"
                                                        @change="uploadImage($event)">
                                                    <i>Carregar imagem</i>
                                                </label>
                                            </input-container>
                                            <preview-component :url="urlImage" :data="image"></preview-component>

                                            <input-container id="titulo" title="Titulo" help="Slide title"
                                                helpText="Titulo do slide">
                                                <input type="text" name="titulo" aria-describedby="title"
                                                    v-model="slideTitle">
                                            </input-container>

                                            <input-container id="descricao" title="Descrição"
                                                help="Slide description" helpText="Texto de destaque">
                                                <input type="text" name="descricao"
                                                    aria-describedby="description" v-model="slideDescr">
                                            </input-container>
                                        </template>

                                        <template v-slot:footer>
                                            <button type="submit" class="button-save">Adicionar</button>
                                            <!--The seconde parameter defines the endpoint for the url-->
                                        </template>

                                    </modal-component>
                                </form>
                                <!---------------------------- End Slider ----------------------------------------------->
                            </div>
                        </div>
                    </div>
                </div>

                <!-----------------------------------------Privacy info--------------------------------------------->
                <div class="option-selected" v-if="optionSelected == 1">
                    <div class="title">
                        <h4><b>Privacy Policies</b></h4>
                    </div>
                    <div class="text">
                        <h5>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum, labore odit est, quidem
                            rerum,
                            accusamus corporis dignissimos quibusdam mollitia vel eaque iusto recusandae esse
                            praesentium in
                            vero quaerat quos velit!</h5>
                        <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste distinctio quisquam architecto
                            maiores, doloremque illum sint expedita modi dignissimos facilis unde ipsam exercitationem.
                            Consequatur magni ex neque dolores dolor! Explicabo!</h5>
                        <h5>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vel quae optio aperiam
                            reprehenderit
                            laboriosam nam. Similique vel quam corrupti velit atque sint est distinctio asperiores?
                            Nihil
                            corrupti iure atque similique?</h5>
                    </div>
                </div>
                <!-----------------------------------------Shipping info--------------------------------------------->
                <div class="option-selected" v-if="optionSelected == 2">
                    <div class="title">
                        <h4><b>Shipping Policies</b></h4>
                    </div>
                    <div class="text">
                        <h5>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum, labore odit est, quidem
                            rerum,
                            accusamus corporis dignissimos quibusdam mollitia vel eaque iusto recusandae esse
                            praesentium in
                            vero quaerat quos velit!</h5>
                        <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste distinctio quisquam architecto
                            maiores, doloremque illum sint expedita modi dignissimos facilis unde ipsam exercitationem.
                            Consequatur magni ex neque dolores dolor! Explicabo!</h5>
                        <h5>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vel quae optio aperiam
                            reprehenderit
                            laboriosam nam. Similique vel quam corrupti velit atque sint est distinctio asperiores?
                            Nihil
                            corrupti iure atque similique?</h5>
                    </div>
                </div>

                <!-----------------------------------------Terms info--------------------------------------------->
                <div class="option-selected" v-if="optionSelected == 3">
                    <div class="title">
                        <h4><b>Terms</b></h4>
                    </div>
                    <div class="text">
                        <h5>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum, labore odit est, quidem
                            rerum,
                            accusamus corporis dignissimos quibusdam mollitia vel eaque iusto recusandae esse
                            praesentium in
                            vero quaerat quos velit!</h5>
                        <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste distinctio quisquam architecto
                            maiores, doloremque illum sint expedita modi dignissimos facilis unde ipsam exercitationem.
                            Consequatur magni ex neque dolores dolor! Explicabo!</h5>
                        <h5>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vel quae optio aperiam
                            reprehenderit
                            laboriosam nam. Similique vel quam corrupti velit atque sint est distinctio asperiores?
                            Nihil
                            corrupti iure atque similique?</h5>
                    </div>
                </div>

                <!-----------------------------------------Bulk orders info--------------------------------------------->
                <div class="option-selected" v-if="optionSelected == 4">
                    <div class="title">
                        <h4><b>Bulk Orders</b></h4>
                    </div>
                    <div class="text">
                        <h5>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum, labore odit est, quidem
                            rerum,
                            accusamus corporis dignissimos quibusdam mollitia vel eaque iusto recusandae esse
                            praesentium in
                            vero quaerat quos velit!</h5>
                        <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste distinctio quisquam architecto
                            maiores, doloremque illum sint expedita modi dignissimos facilis unde ipsam exercitationem.
                            Consequatur magni ex neque dolores dolor! Explicabo!</h5>
                        <h5>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vel quae optio aperiam
                            reprehenderit
                            laboriosam nam. Similique vel quam corrupti velit atque sint est distinctio asperiores?
                            Nihil
                            corrupti iure atque similique?</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            optionSelected: localStorage.getItem('selectedOption'), // saves the page if the browser reloads
            appContent: { data: [] },
            editValue: '',
            updateShow: '',
            idUpdating: '',
            openMenu: false,
            home: 1,
            itsOn: 0,
            image: [],
            urlImage: '',
            slideTitle: '',
            slideDescr: '',
        }
    },
    methods: {
        uploadImage(x) { //variable with product images object
            let file = x.target.files;
            this.image = file[0];
            this.urlImage = URL.createObjectURL(file[0]);
            console.log(this.image);
            console.log(this.urlImage);
        },
        addSlide() {
            let urlImages = this.$store.state.Url + 'api/conteudo';

            let formData = new FormData();

            let config = {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Accept': 'application/json'
                }
            }

            

                if (this.image.size < 2097152) {

                    formData.append('titulo', this.slideTitle);
                    formData.append('descricao', this.slideDescr);
                    formData.append('media', this.image);
                    formData.append('posicao', 'slider');

                    axios.post(urlImages, formData, config)
                        .then(response => {
                            this.$store.state.transaction.status = 'added'
                            this.$store.state.transaction.message = response.data.msg
                            this.image = []
                            this.urlImage = ''
                            this.slideTitle = ''
                            this.slideDescr = ''
                            console.log(response.data.msg)
                            this.loadContent()
                            history.back()
                        })
                        .catch(errors => {
                            this.$store.state.transaction.status = 'error-add'
                            this.$store.state.transaction.message = errors.response.data.errors
                            this.image = []
                            this.urlImage = ''
                            this.slideTitle = ''
                            this.slideDescr = ''

                            console.log(errors.response.data)

                        })
                } else {
                    alert('A imagem carregada é demasiado grande, o maximo permitido é 2MB')
                }
            
        },
        openHome(n) {
            this.openMenu = !this.openMenu
            this.home = n
        },
        editfield(value, id) {
            this.editValue = value
            this.updateShow = value
            this.idUpdating = id
        },
        loadContent() {
            let urlContent = this.$store.state.Url + 'api/conteudo';

            axios.get(urlContent)
                .then(response => {
                    this.appContent.data = response.data
                    // console.log(response.data)
                })
                .catch(errors => {
                    console.log(errors);
                })
        },
        remove(i) {
            let url = this.$store.state.Url + 'api/conteudo/' + i;

            let formData = new FormData();
            formData.append('_method', 'delete')

            console.log(url)

            axios.post(url, formData)
                .then(response => {
                    this.$store.state.transaction.status = 'removed'
                    this.$store.state.transaction.message = response.data.msg
                    this.loadContent()

                })
                .catch(errors => {
                    this.$store.state.transaction.status = 'error-update'
                    this.$store.state.transaction.message = errors.response.data.errors
                    console.log(errors.response.data.errors)
                })
        },

        update(u, i) { //update fields
            let updateValue = this.editValue
            let url = this.$store.state.Url + 'api/conteudo/' + u;

            let formData = new FormData();
            formData.append('_method', 'patch')

            formData.append(i, updateValue)


            let config = {
                headers: {
                    'Content-Type': 'x-www-form-urlencoded',
                    'Accept': 'application/json'
                }
            }

            axios.post(url, formData, config)
                .then(response => {
                    this.$store.state.transaction.status = 'updated'
                    this.$store.state.transaction.message = response.data.msg
                    this.editValue = ""
                    this.updateShow = ""
                    this.loadContent()

                })
                .catch(errors => {
                    this.$store.state.transaction.status = 'error-update'
                    this.$store.state.transaction.message = errors.response.data.errors
                    console.log(errors.response.data.errors)
                    this.editValue = ""
                })
        },
        //   timeOut() {
        //       setTimeout(() => { // selects a page after a timeout
        //           if (this.$route.query.policie) {
        //               localStorage.setItem('selectedOption', this.$route.query.policie);
        //               this.optionSelected = localStorage.getItem('selectedOption');
        //           }
        //       }, 200);
        //   },
        select(n) { //selects the info from the button clicked
            localStorage.setItem('selectedOption', n);
            this.optionSelected = localStorage.getItem('selectedOption');
        },
        start() { // sets the first info to appears
            let selected = localStorage.getItem('selectedOption');

            if (selected == undefined) {
                localStorage.setItem('selectedOption', 0);
                this.optionSelected = localStorage.getItem('selectedOption');
            }
        }
    },
    computed: {
        sliderInfo() {
            let slidesInfo = []
            this.appContent.data.forEach(data => {
                if (data.posicao == 'slider') {
                    slidesInfo.push(data)
                }
            })
            return slidesInfo
        }

    },
    mounted() {
        this.start()
        //   this.timeOut()
        this.loadContent()
    }
}
</script>