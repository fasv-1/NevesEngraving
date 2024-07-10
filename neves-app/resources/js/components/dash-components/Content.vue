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
                <div class="option" :class="this.optionSelected == 0 ? 'active' : ''" @click="select(0)">
                    <h3>Home</h3>
                </div>
                <div class="option" :class="this.optionSelected == 1 ? 'active' : ''" @click="select(1)">
                    <h3>Amazing Gifts</h3>
                </div>
                <div class="option" :class="this.optionSelected == 2 ? 'active' : ''" @click="select(2)">
                    <h3>Engraving</h3>
                </div>
                <div class="option" :class="this.optionSelected == 3 ? 'active' : ''" @click="select(3)">
                    <h3>Lazer Cut</h3>
                </div>
                <div class="option" :class="this.optionSelected == 4 ? 'active' : ''" @click="select(4)">
                    <h3>Contacts</h3>
                </div>
                <div class="option" :class="this.optionSelected == 5 ? 'active' : ''" @click="select(5)">
                    <h3>Shopping Cart</h3>
                </div>
                <div class="option" :class="this.optionSelected == 6 ? 'active' : ''" @click="select(6)">
                    <h3>Footer</h3>
                </div>
            </div>
            <div class="info">
                <!-----------------------------------------Return info--------------------------------------------->
                <div class="option-selected" v-if="optionSelected == 0">
                    <div class="title">
                        <h4><b>Home</b></h4>
                    </div>
                    <div class="text">
                        <div id="intro-option">
                            <h6><b>Animações e Info</b></h6>
                            <div class="manage-info">
                                <div class="brick">
                                    <div class="home-intro" v-for="content, index in content.data" :key=index>
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
                            <h6><b>Slider e produtos</b></h6>
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
            content: { data: [] },
            editValue: '',
            updateShow: '',
            idUpdating: '',
        }
    },
    methods: {
        editfield(value, id) {
            this.editValue = value
            this.updateShow = value
            this.idUpdating = id
        },
        loadContent() {
            let urlContent = this.$store.state.Url + 'api/conteudo';

            axios.get(urlContent)
                .then(response => {
                    this.content.data = response.data
                    console.log(response.data)
                })
                .catch(errors => {
                    console.log(errors);
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

    },
    mounted() {
        this.start()
        //   this.timeOut()
        this.loadContent()
    }
}
</script>