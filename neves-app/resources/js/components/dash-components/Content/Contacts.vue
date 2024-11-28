<template>
    <div class="container">
        <div class="">
            <div class="title-cont">
                <h1 class="titulo">Conteudo - contactos</h1>
            </div>
        </div>
        <div class="dynamic-box">
            <!-----------------------------------------Box menu--------------------------------------------->
            <div class="">
                <!----------------------------------------- Shopping-cart Info --------------------------------------------->
                <div class="option-selected">
                    <div class="title">
                        <h4 class="text-grey">Adiciona e edita as informações dos contactos da empresa</h4>
                    </div>
                    <div class="text">
                        <div class="responsive-container">
                            <div class="flex-container width100 responsive-end margin1">
                                <a href="#newContact"><button>Adicionar contacto</button></a>
                            </div>
                            <div class="" v-for="contacts, index in appContacts.data" :key=index>
                                <div>
                                    <div>
                                        <div class="update-title"
                                            v-if="idUpdating != contacts.id || updateShow != contacts.nome">
                                            <h6><b>{{ contacts.nome }}</b></h6>
                                            <img class="edit-btn mrghor1"
                                                src="@/images/Icons/edit-square-icon.svg" alt=""
                                                style="width: 30px;" @click="editfield(contacts.nome, contacts.id)">

                                        </div>
                                        <div v-else>
                                            <div class="width70">
                                                <input-container id="nome" title='Editar nome do contacto'
                                                    help="editHelp" helpText="Nome do contacto a atualizar">
                                                    <input type="text" name="nome" v-model="editValue">
                                                </input-container>
                                            </div>
                                            <div class="mrghor2">
                                                <button class="button-small"
                                                    @click="update(contacts.id, 'nome')">Atualizar</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="update-title"
                                            v-if="idUpdating != contacts.id || updateShow != contacts.contacto">
                                            <p>{{ contacts.contacto }}</p>
                                            <img class="edit-btn mrghor1"
                                                src="@/images/Icons/edit-square-icon.svg" alt=""
                                                style="width: 30px;" @click="editfield(contacts.contacto, contacts.id)">

                                        </div>
                                        <div v-else>
                                            <div class="width70">
                                                <input-container id="nome" title='Editar nome do contacto'
                                                    help="editHelp" helpText="Nome do contacto a atualizar">
                                                    <input type="text" name="nome" v-model="editValue">
                                                </input-container>
                                            </div>
                                            <div class="mrghor2">
                                                <button class="button-small"
                                                    @click="update(contacts.id, 'contacto')">Atualizar</button>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="remove-buttons">
                                        <button class="btn-rmv" @click="remove(contacts.id)">
                                            <h1>x</h1>
                                        </button>
                                    </div>
                                </div>

                            </div>
                            <!---------------------------- Modal to add new info ------------------------------------>
                            <form method="POST" action="" @submit.prevent="addContacts()">
                                <modal-component id="newContact" title="Adicionar novo contacto">
                                    <template v-slot:content>

                                        <input-container id="nome" title="Nome do contacto" help="contact name"
                                            helpText="Nome para este contacto (ex: telefone 1, morada, telemovel 2)">
                                            <input type="text" name="nome" aria-describedby="name" v-model="newName">
                                        </input-container>

                                        <input-container id="contacto" title="Contacto" help="contact"
                                            helpText="Insira o respetivo contacto">
                                            <input type="text" name="contacto" aria-describedby="contact" v-model="newContact">
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
            urlContacts: this.$store.state.Url + 'api/contactos',
            optionSelected: localStorage.getItem('selectedOption'), // saves the page if the browser reloads
            appContacts: { data: [] },
            editValue: '',
            updateShow: '',
            idUpdating: '',
            openMenu: false,
            itsOn: 0,
            newName: '',
            newContact: '',

        }
    },
    methods: {
        addContacts() {
            let formData = new FormData();

            let config = {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Accept': 'application/json'
                }
            }

            formData.append('nome', this.newName);
            formData.append('contacto', this.newContact);

            axios.post(this.urlContacts, formData, config)
                .then(response => {
                    this.$store.state.transaction.status = 'added'
                    this.$store.state.transaction.message = response.data.msg
                    this.newName = ''
                    this.newContact = ''
                    console.log(response.data.msg)
                    this.loadContent()
                    history.back()
                })
                .catch(errors => {
                    this.$store.state.transaction.status = 'error-add'
                    this.$store.state.transaction.message = errors.response.data.errors
                    this.newName = ''
                    this.newContact = ''
                    console.log(errors.response.data)
                })

        },
        editfield(value, id) {
            this.editValue = value
            this.updateShow = value
            this.idUpdating = id
            // console.log(this.updateShow)
            // console.log(this.idUpdating)
        },
        loadContent() {
            axios.get(this.urlContacts)
                .then(response => {
                    this.appContacts.data = response.data.contacts
                    console.log(response.data)
                })
                .catch(errors => {
                    console.log(errors);
                })
        },
        remove(i) {
            if (confirm("Tem a certeza que pertende remover este registo?")) {
                let url = this.urlContacts + '/' + i;

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
            }
        },

        update(u, i) { //update fields
            let updateValue = this.editValue

            let url = this.urlContacts + '/' + u

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
                    this.updateShow = ""
                })
        },
    },
    computed: {

    },
    mounted() {
        this.loadContent()
    }
}
</script>
