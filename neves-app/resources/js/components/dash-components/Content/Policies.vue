<template> <!--Continuar aqui!!!!!!!-->
    <div class="container">
        <div class="">
            <div class="titulo">
                <h1>Conteudo - Policies</h1>
            </div>
        </div>
        <div class="dynamic-box">
            <!-----------------------------------------Box menu--------------------------------------------->
            <div class="box-menu">
                <div class="option" v-for="policies, index in policiesTitle"
                    :class="optionSelected == index ? 'active' : ''" @click="select(index)">
                    <h5>{{ policies }}</h5>
                </div>
            </div>
            <div class="info" v-for="policies, index in policiesTitle">
                <!----------------------------------------- Shopping-cart Info --------------------------------------------->
                <div class="option-selected" v-if="optionSelected == index">
                    <div class="title">
                        <h4 class="text-grey">Adiciona e edita as informações de {{ policies }}</h4>
                    </div>
                    <div class="text">
                        <div class="responsive-container">
                            <div class="flex-container width100 responsive-end margin1">
                                <a href="#addInfoShop"><button>Adicionar infromação</button></a>
                            </div>
                            <div class="" v-for="content, index in orderPolicies " :key=index>
                                <div v-if="content.politica == policies">
                                    <div class="update-title"
                                        v-if="idUpdating != content.id || updateShow != content.titulo">
                                        <h4>{{ content.titulo }}</h4>
                                        <img class="edit-btn mrghor1" src="/storage/images/Icons/edit-square-icon.svg"
                                            alt="" style="width: 30px;" @click="editfield(content.titulo, content.id)">

                                    </div>
                                    <div v-else>
                                        <div class="width70">
                                            <input-container id="titulo" title='Editar titulo ' help="editHelp"
                                                helpText="Titulo atualizado">
                                                <input type="text" name="titulo" v-model="editValue">
                                            </input-container>
                                        </div>
                                        <div class="mrghor2">
                                            <button class="button-small"
                                                @click="update(content.id, 'titulo')">Atualizar</button>
                                        </div>
                                    </div>

                                    <div class="update-descr"
                                        v-if="idUpdating != content.id || updateShow != content.subtitulo">
                                        <p>{{ content.subtitulo }}</p>
                                        <img class="edit-btn mrghor1" src="/storage/images/Icons/edit-square-icon.svg"
                                            alt="" style="width: 30px;"
                                            @click="editfield(content.subtitulo, content.id)">
                                    </div>
                                    <div v-else>
                                        <div class="width70">
                                            <input-container id="descricao" title='Editar descrição' help="editHelp"
                                                helpText="Descrição atualizada">
                                                <textarea name="descricao"
                                                    v-model="editValue">{{ editValue }}</textarea>
                                            </input-container>
                                        </div>
                                        <div class="mrghor2">
                                            <button class="button-small"
                                                @click="update(content.id, 'subtitulo')">Atualizar</button>
                                        </div>
                                    </div>

                                    <div class="update-descr"
                                        v-if="idUpdating != content.id || updateShow != content.texto">
                                        <p>{{ content.texto }}</p>
                                        <img class="edit-btn mrghor1" src="/storage/images/Icons/edit-square-icon.svg"
                                            alt="" style="width: 30px;" @click="editfield(content.texto, content.id)">
                                    </div>
                                    <div v-else>
                                        <div class="width70">
                                            <input-container id="descricao" title='Editar descrição' help="editHelp"
                                                helpText="Descrição atualizada">
                                                <textarea name="descricao"
                                                    v-model="editValue">{{ editValue }}</textarea>
                                            </input-container>
                                        </div>
                                        <div class="mrghor2">
                                            <button class="button-small"
                                                @click="update(content.id, 'texto')">Atualizar</button>
                                        </div>
                                    </div>

                                    <div class="remove-buttons">
                                        <button class="btn-rmv" @click="remove(content.id)">
                                            <h1>x</h1>
                                        </button>
                                    </div>
                                </div>

                            </div>
                            <!---------------------------- Modal to add new info ------------------------------------>
                            <form method="POST" action="" @submit.prevent="addPolicie()">
                                <modal-component id="addInfoShop" title="Adicionar shopping info">
                                    <template v-slot:content>

                                        <div>
                                            <input-container id="titulo" title="Titulo novo" help="Title"
                                                helpText="Adicionar um novo titulo">
                                                <input type="text" name="titulo" aria-describedby="title"
                                                    v-model="addTitle">
                                            </input-container>

                                            <input-container id="oldTitle" title="Adicionar a este titulo" help="titleHelp"
                                                helpText="Escolha um titulo para adicionar a informação pertendida">
                                                <select name="oldTitle" :value="oldTitle">
                                                    <option value="" disabled>Escolhe uma</option>
                                                    <option v-for="t, index in titles " :key="index" :value="t">{{
                                                        t }}</option>
                                                </select>
                                            </input-container>

                                        </div>

                                        <input-container id="subtitulo" title="Subtitulo" help="Subtitle"
                                            helpText="Subtitulo do texto">
                                            <input type="text" name="subtitulo" aria-describedby="subtitle"
                                                v-model="addSubtitle">
                                        </input-container>

                                        <input-container id="texto" title="Texto" help="Text"
                                            helpText="Introdus o texto em questão">
                                            <textarea type="text" name="texto" aria-describedby="description"
                                                v-model="addText"></textarea>
                                        </input-container>
                                    </template>

                                    <template v-slot:footer>
                                        <button type="submit" class="button-save">Adicionar</button>
                                        <!--The seconde parameter defines the endpoint for the url-->
                                    </template>

                                </modal-component>
                                <!---------------------------- End modal ----------------------------------------------->
                            </form>
                        </div>
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
            urlPolicies: this.$store.state.Url + 'api/politicas',
            optionSelected: localStorage.getItem('selectedOption'), // saves the page if the browser reloads
            appPolicies: { data: [] },
            editValue: '',
            updateShow: '',
            idUpdating: '',
            openMenu: false,
            itsOn: 0,
            addTitle: '',
            addSubtitle: '',
            addText: '',
            oldTitle:'',

        }
    },
    methods: {
        addPolicie(position) {
            let formData = new FormData();

            let config = {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Accept': 'application/json'
                }
            }

            if (this.image.size < 2097152) {

                formData.append('titulo', this.addTitle);
                formData.append('descricao', this.addDescr);
                formData.append('media', this.image);
                formData.append('posicao', position);

                axios.post(this.urlPolicies, formData, config)
                    .then(response => {
                        this.$store.state.transaction.status = 'added'
                        this.$store.state.transaction.message = response.data.msg
                        this.image = []
                        this.addTitle = ''
                        this.addDescr = ''
                        console.log(response.data.msg)
                        this.loadContent()
                        history.back()
                    })
                    .catch(errors => {
                        this.$store.state.transaction.status = 'error-add'
                        this.$store.state.transaction.message = errors.response.data.errors
                        this.image = []
                        this.addTitle = ''
                        this.addDescr = ''

                        console.log(errors.response.data)

                    })

            } else {
                alert('A imagem carregada é demasiado grande, o maximo permitido é 2MB')
            }

        },
        editfield(value, id) {
            this.editValue = value
            this.updateShow = value
            this.idUpdating = id
            console.log(this.updateShow)
            console.log(this.idUpdating)
        },
        loadContent() {
            axios.get(this.urlPolicies)
                .then(response => {
                    this.appPolicies.data = response.data.policies
                    // console.log(response.data.policies)
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

            if (i == 'media') {
                formData.append(i, this.image)
            } else {
                formData.append(i, updateValue)
            }

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
                    this.image = []

                })
                .catch(errors => {
                    this.$store.state.transaction.status = 'error-update'
                    this.$store.state.transaction.message = errors.response.data.errors
                    console.log(errors.response.data.errors)
                    this.editValue = ""
                    this.image = []
                    this.updateShow = ""
                })
        },
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
        policiesTitle() {
            let policies = []
            this.appPolicies.data.forEach(e => {
                policies.push(e.politica)
            })

            function delDuplicate(data) {
                return data.filter((value, index) => data.indexOf(value) === index);
            }

            return delDuplicate(policies)
        },

        titles() {
            let titles = []
            this.appPolicies.data.forEach(e => {
                titles.push(e.ref_titulo)
            })

            function delDuplicate(data) {
                return data.filter((value, index) => data.indexOf(value) === index);
            }

            return delDuplicate(titles)
        },

        orderPolicies() {
            let ordered = this.appPolicies.data.sort((a, b) => a.ref_titulo.localeCompare(b.ref_titulo))

            return ordered
        }

    },
    mounted() {
        this.start()
        //   this.timeOut()
        this.loadContent()
    }
}
</script>