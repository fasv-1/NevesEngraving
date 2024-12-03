<template>
    <div class="product-content">

        <!---------------------- Product name as title and botton edit --------------------------->
        <div class="title-cont">
            <h2 class="titulo">{{ product.data.nome }}</h2>
            <div>
                <a href="#updateProductModal"><img class="edit-btn" src="@/images/Icons/edit.png" alt=""></a>
                <a href="#deleteProductModal"><img class="delete-btn" src="@/images/Icons/delete-icon.png"
                        style="width:20px" alt=""></a>
            </div>
        </div>
        <!---------------------------- End of Product name and meta-name ------------------------>

        <!------------------------------ Product input main image -------------------------------->
        <!--If exists an main product image-->
        <div class="input-form-image" v-if="productMainImage != ''">
            <label for="newImagem" class="form-label-img">
                <h3>Imagem principal</h3>
            </label>
            <div class="principal-image-preview">
                <div>
                    <img :src="'/storage/' + productMainImage[0].nome">
                </div>
                <div class="image-btns">
                    <button class="btn-remove" @click="removeImage(productMainImage[0].id)">Remover imagem</button>
                </div>
            </div>
        </div>

        <!--If doesn't exists an main product image-->
        <div class="input-form-image" v-else>
            <label for="newImagem" class="form-label-img">
                <h3>Imagem principal</h3>
            </label>
            <input-container id="newImage" titulo='Imgem principal' help="newImageHelp"
                helpText="Insira uma imagem de capa para o produto (não deve exceder 2mb)">
                <label class="imageButton">
                    <input type="file" name="newImage" class="form-image" aria-describedby="newProductImage"
                        placeholder="Nome do produto" @change="uploadMainImage($event)">
                    <i>Carregar imagem</i>
                </label>
            </input-container>
            <preview-component :data="mainImage"></preview-component>
            <!-- <div class="principal-image-preview">
        <img v-if="url" :src="url">
        <p v-if="mainImage != ''">Tamanho: {{ mbConversion }} MB</p>
      </div> -->
            <div class="image-cont-button">
                <button v-if="mainImage != ''" class="button1" @click="saveImage('mainImage')">Adicionar imagem</button>
            </div>
        </div>
        <!----------------------------------- End of product input main image ------------------------------->

        <!----------------------------------- Product info --------------------------------------------------->
        <div class="product-information">
            <div class="sub-title">
                <h3 class="titulo2">{{ product.data.meta_nome }}</h3>
            </div>
            <div class="info-area">
                <div class="areas">
                    <label for="ocasions">
                        <h6>Ocasiões</h6>
                    </label>
                    <h4 name="ocasions" v-for="o in ocasions.data" :key="o.id">{{ o.id == product.data.ocasioes_id ?
                        o.nome : ''
                        }}
                    </h4>
                </div>
                <div class="areas">
                    <label for="categoria">
                        <h6>Categoria</h6>
                    </label>
                    <h4 name="categoria" v-for="c in categorys.data" :key="c.id">{{ c.id == product.data.categoria_id ?
                        c.nome :
                        ''
                        }}
                    </h4>
                </div>
                <div class="areas">
                    <label for="materia-prima">
                        <h6>Matéria-prima</h6>
                    </label>
                    <h4 name="materia-prima" v-for="m in materials.data" :key="m.id">{{ m.id ==
                        product.data.materia_prima_id ?
                        m.nome
                        :
                        ''
                        }}</h4>
                </div>
                <div class="areas">
                    <label for="desconto">
                        <h6>Desconto</h6>
                    </label>
                    <h4 name="desconto" v-for="d in discounts.data" :key="d.id">{{ d.id == product.data.desconto_id ?
                        d.nome : ''
                        }}
                    </h4>
                </div>
                <div class="areas">
                    <label for="costumizavel">
                        <h6>Costumizável</h6>
                    </label>
                    <h4 v-if="product.data.costumizavel == 0">Sem Costumização</h4>
                    <h4 v-if="product.data.costumizavel == 1">Cor</h4>
                    <h4 v-if="product.data.costumizavel == 2">Texto</h4>
                    <h4 v-if="product.data.costumizavel == 3">Cor e Texto</h4>
                </div>
            </div>
            <div class="input-form-names">
                <div class="details-area" v-if="product.data.costumizavel == 1 || product.data.costumizavel == 3">
                    <div class="space-between marginMinvert">
                        <label for="cores">
                            <h6>Cores disponiveis:</h6>
                        </label>
                        <label for="costumizavel">
                            <a name='costumizavel' href="#addColorsModal">
                                <p class="text-blue"><b>Adicionar cores +</b></p>
                            </a>
                        </label>
                    </div>
                    <ul>
                        <li v-for="detail, index in details.data" :key="index">
                            <div class="space-between marginMinvert" v-if="detail.cor != null">
                                <h4>- {{ detail.cor }}</h4>
                                <a href="" @click.prevent="removeDetail(detail.id)"><img class="delete-btn"
                                        src="@/images/Icons/delete-icon.png" alt="" style="width: 20px;"></a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="details-area">
                    <label for="descrição">
                        <h6>Descrição</h6>
                    </label>
                    <h4>{{ product.data.descricao }}</h4>
                </div>
                <div class="details-area">
                    <div class="space-between mrgvert1">
                        <label for="detalhes">
                            <h6>Detalhes do produto:</h6>
                        </label>
                        <a href="#addDetailsModal">
                            <p class="text-blue"><b>Adicionar detalhes +</b></p>
                        </a>
                    </div>
                    <ul>
                        <li v-for="detail, index in details.data" :key="index">
                            <div class="space-between marginMinvert" v-if="detail.descricao != null">
                                <h4>- {{ detail.descricao }}</h4>
                                <a href="" @click.prevent="removeDetail(detail.id)"><img class="delete-btn"
                                        src="@/images/Icons/delete-icon.png" alt="" style="width: 20px;"></a>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
            <div class="info-area">
                <div>
                    <label for="quantidade">
                        <h6>Quantidade</h6>
                    </label>
                    <h4>{{ product.data.quantidade }} un</h4>
                </div>
                <div>
                    <label for="preço">
                        <h6>Preço</h6>
                    </label>
                    <h4>{{ product.data.valor }}€</h4>
                </div>
            </div>
        </div>
        <!----------------------------------- End of product info ------------------------------->

        <!----------------------------------- Product images inputs ----------------------------->

        <!--If exists images of the product already charged -->
        <div class="product-images" v-if="productImages != ''">
            <label for="Images" class="form-label-img">
                <h3>Imagens do produto</h3>
            </label>
            <div class="images-preview" v-if="productImages != ''">
                <div class="preview-cont" v-for="i, indexValue in productImages" :key="indexValue">
                    <img :src="'/storage/' + i.nome">
                    <button class="btn-remove" @click="removeImage(i.id)">Remover imagem</button>
                </div>
            </div>
        </div>

        <!-- Input to add new images -->
        <div class="input-product-images">
            <label for="newImages" class="form-label-img">
                <h3>Adicionar imagens novas</h3>
            </label>
            <input-container id="newImage" title='' help="newImageHelp"
                helpText="Insira uma ou várias imagens para o produto (o tamanho das imagens não deve exceder os 2MB)">
                <label class="imageButton">
                    <input type="file" name="newImage" class="form-image" aria-describedby="newProductImage"
                        placeholder="Nome do produto" multiple @change="uploadImages($event)">
                    <i>Carregar imagem</i>
                </label>
            </input-container>
            <div class="images-preview brd-grey" v-if="images != ''">
                <div class="preview-cont" v-for="urlImage, index in images" :key="index">
                    <preview-component :data="urlImage"></preview-component>
                    <button class="btn-remove ms-input" @click="deleteImage(index)">Eliminar</button>
                </div>
            </div>
            <div class="image-cont-button">
                <button v-if="images != ''" class="button1" @click="saveImage('images')">Adicionar imagens</button>
            </div>
        </div>
        <!----------------------------------- End of product images inputs ----------------------------->

        <!----------------------------Modal to update the product-------------------------------------->
        <modal-component id="updateProductModal" title="Atualizar produto">
            <template v-slot:content>
                <div class="container-inputs">
                    <div class="input-form-names">
                        <input-container id="productName" title="Nome" help="productNameHelp" helpText="Nome do produto"
                            size="m-input">
                            <input type="text" class="l-input" :placeholder="product.data.nome" name="productName"
                                aria-describedby="productName" v-model="updateProduct.name">
                        </input-container>

                        <input-container id="productMetaName" title="Meta-Nome" help="productMetaNameHelp"
                            helpText="Nome abreviado do produto">
                            <input type="text" name="productMetaName" :placeholder="product.data.meta_nome"
                                aria-describedby="productMetaName" v-model="updateProduct.metaName">
                        </input-container>
                    </div>

                    <div class="responsive-container responsive-between">
                        <div>
                            <input-container id="ocasion" title="Ocasião" help="ocasionHelp"
                                helpText="Escolha uma ocasião">
                                <select name="ocasion" id="ocasion" :value="product.data.ocasioes_id">
                                    <option value="" disabled>Escolhe uma</option>
                                    <option v-for="o in ocasions.data" :key="o.id" :value="o.id">{{ o.nome }}</option>
                                </select>
                            </input-container>
                        </div>
                        <div>
                            <input-container id="category" title="Categoria" help="categoryHelp"
                                helpText="Escolha uma categoria">
                                <select name="category" id="category" :value="product.data.categoria_id">
                                    <option value="" disabled>Escolhe uma</option>
                                    <option v-for="c in categorys.data" :key="c.id" :value="c.id">{{ c.nome }}</option>
                                </select>
                            </input-container>
                        </div>
                        <div>
                            <input-container id="material" title="Materia-prima" help="materialHelp"
                                helpText="Escolha uma matéria-prima">
                                <select name="material" id="material" :value="product.data.materia_prima_id">
                                    <option value="" disabled>Escolhe uma</option>
                                    <option v-for="m in materials.data" :key="m.id" :value="m.id">{{ m.nome }}</option>
                                </select>
                            </input-container>
                        </div>
                    </div>

                    <div class="responsive-container responsive-between">
                        <div>
                            <input-container id="discount" title="Desconto" help="discountHelp"
                                helpText="Escolha um desconto">
                                <select name="discount" id="discount" :value="product.data.desconto_id">
                                    <option value="" disabled>Escolhe uma</option>
                                    <option v-for="d in discounts.data " :key="d.id" :value="d.id">{{ d.nome }}</option>
                                </select>
                            </input-container>
                        </div>
                        <div>
                            <input-container id="customization" title="Costumização" help="customizationtHelp"
                                helpText="Escolha um tipo de costumização">
                                <select name="customization" id="customization" :value="product.data.costumizavel">
                                    <option value="" disabled>Escolhe uma</option>
                                    <option value="0">Sem costumização</option>
                                    <option value="1">Cor</option>
                                    <option value="2">Texto</option>
                                    <option value="3">Cor e Texto</option>
                                    <option value="4">Várias</option>
                                </select>
                            </input-container>
                        </div>
                    </div>

                    <div class="input-form-names">
                        <input-container id="description" title="Descrição do produto" help="descriptionHelp"
                            helpText="Descrição do produto" size="ml-input">
                            <textarea name="description" aria-describedby="description"
                                :placeholder="product.data.descricao" v-model="updateProduct.description">
            </textarea>
                        </input-container>
                    </div>

                    <div class="select-options">
                        <input-container id="quantity" title="Quantidade do produto" help="quantityHelp"
                            helpText="Quantidade do produto">
                            <input type="number" name="quantity" aria-describedby="quantity"
                                :placeholder="product.data.quantidade" v-model="updateProduct.quantity" class="s-input">
                        </input-container>

                        <input-container id="price" title="Preço do produto " help="priceHelp"
                            helpText="Preço do produto (sem taxas, nem descontos)">
                            <input type="number" name="price" aria-describedby="price" class="s-input"
                                :placeholder="product.data.valor" v-model="updateProduct.price">
                        </input-container>
                    </div>
                </div>
            </template>

            <template v-slot:footer>
                <a @click="resetInput()" href="#"><button class="button-save">Cancelar</button></a>
                <div><button class="button-save" @click="update()">Atualizar</button></div>
            </template>

        </modal-component>
        <!-----------------------------------------------End of modal to update new products---------------------------------------------->

        <!----------------------------Modal to delete the product-------------------------------------->
        <modal-component id="deleteProductModal" title="Eliminar produto">
            <template v-slot:alerts>
                <alert-component tipe="danger" :details="$store.state.transaction"
                    v-if="$store.state.transaction.status == 'error-add'"></alert-component>
                <alert-component tipe="success" :details="$store.state.transaction.message"
                    v-if="$store.state.transaction.status == 'added'"></alert-component>
            </template>
            <template v-slot:content>
                <div>
                    <h4>Tem a certeza que pretende eliminar este produto?</h4>
                    <br />
                    <p>Ao eliminar este produto, irá eliminar também todas a imagens associadas a ele.</p>
                </div>
            </template>

            <template v-slot:footer>
                <a @click="resetInput()" href="#"><button class="button-save">Cancelar</button></a>
                <div><button class="btn-remove" @click="remove()">Eliminar</button></div>
            </template>

        </modal-component>
        <!-----------------------------------------------End of modal to delete new products---------------------------------------------->

        <!----------------------------Modal add details to product-------------------------------------->
        <modal-component id="addDetailsModal" title="Adiconar novo detalhe">
            <template v-slot:alerts>
                <alert-component tipe="danger" :details="$store.state.transaction"
                    v-if="$store.state.transaction.status == 'error-add'"></alert-component>
            </template>
            <template v-slot:content>
                <input-container id="descricao" title="Detalhe " help="descricao"
                    helpText="Descrição do detalhe como irá aparecer em publico" size="ml-input">
                    <textarea name="descricao" aria-describedby="descricao" v-model="addDetail" required></textarea>
                </input-container>
            </template>

            <template v-slot:footer>
                <a @click="resetInput()" href="#"><button class="button-save">Cancelar</button></a>
                <div><button class="button-save" @click="detail()">Adicionar</button></div>
            </template>

        </modal-component>
        <!-----------------------------------------------End of modal add details products---------------------------------------------->

        <!----------------------------Modal add colors -------------------------------------->
        <modal-component id="addColorsModal" title="Adiconar uma nova cor">
            <template v-slot:alerts>
                <alert-component tipe="danger" :details="$store.state.transaction"
                    v-if="$store.state.transaction.status == 'error-add'"></alert-component>
            </template>
            <template v-slot:content>
                <div class="flex-container responsive-center space-between">
                    <div class="width100">
                        <input-container id="colorCode" title="Código da cor" help="colorCodeHelp"
                            helpText="Código da cor para o cliente escolher">
                            <input type="text" name="colorCode" class="l-input" aria-describedby="colorCode" v-model="addColor.code"
                                required>
                        </input-container>
                    </div>
                    <div class="width100">
                    <input-container id="colorName" title="Nome da cor" help="colorName"
                        helpText="Nome da cor para o cliente escolher">
                        <input type="text" name="colorName" class="l-input" aria-describedby="colorName" v-model="addColor.name"
                            required>
                    </input-container>
                </div>
                </div>
            </template>

            <template v-slot:footer>
                <a @click="resetInput()" href="#"><button class="button-save">Cancelar</button></a>
                <div><button class="button-save" @click="detail()">Adicionar</button></div>
            </template>

        </modal-component>
        <!-----------------------------------------------End of modal add details products---------------------------------------------->

        <!-- Calls the computed method to separate the images by posicion-->
        {{ separateImages }}
        <!-- End of call computed -->
    </div>
</template>

<script>
export default {
    props: {
        id: {
            required: true,
            type: String,
        }
    },
    data() {
        return {
            urlBase: 'http://127.0.0.1:8000/api/',
            product: { data: [] },
            productAllImages: [],
            productMainImage: [],
            productImages: [],
            categorys: { data: [] },
            details: { data: [] },
            ocasions: { data: [] },
            materials: { data: [] },
            discounts: { data: [] },
            taxes: { data: [] },
            mainImage: [],
            images: [],
            addDetail: '',
            url: '',
            urlImages: [],
            productImages: '',
            updateProduct: {
                name: '',
                metaName: '',
                ocasion: '',
                category: '',
                material: '',
                discount: '',
                customization: '',
                description: '',
                quantity: '',
                price: '',
            },
            addColor: {
                code: '',
                name: ''
            }

        }
    },
    methods: {
        uploadMainImage(e) { //variable with main image object
            this.mainImage = e.target.files[0];
            // console.log(this.mainImage);
        },

        uploadImages(x) { //variable with product images object
            let productImages = x.target.files;
            // console.log(productImages);
            Object.values(productImages).forEach(i => {

                // console.log(i)
                this.images.push(i);
            })
        },

        deleteImage(del) { // delete the pre-set images from the array of product images
            this.images.splice(del, 1);
        },

        getProduct() { //gets the product clicked
            let urlProducts = this.urlBase + 'produto/' + this.id;

            console.log(urlProducts)

            axios.get(urlProducts)
                .then(response => {
                    this.product.data = response.data
                })
                .catch(errors => {
                    console.log(errors);
                })
        },

        getProductImages() { //gets the respective main image if exists

            let urlProductImages = this.urlBase + 'imagens_produto?filtro=produto_id:=:' + this.id;

            axios.get(urlProductImages)
                .then(response => {
                    this.productAllImages = response.data;
                    this.getProductImages()
                })
                .catch(errors => {
                    console.log(errors);
                })
        },

        loadDetails() {
            let urlDetails = this.urlBase + 'produto_detalhe?filtro=produto_id:=:' + this.id;

            axios.get(urlDetails)
                .then(response => {
                    this.details.data = response.data
                    console.log(response)
                })
                .catch(errors => {
                    console.log(errors);
                })
        },

        detail() {
            let urlDetails = this.urlBase + 'produto_detalhe'

            let formData = new FormData()

            if (this.addColor.code = ! '' && this.addColor.name != '' && this.addDetail != '') {
                if (this.addColor.code = ! '' && this.addColor.name != '') {
                    formData.append('cor', this.addColor.code + '_' + this.addColor.name)
                }

                if (this.addDetail != '') {
                    formData.append('descricao', this.addDetail)
                }

                formData.append('produto_id', this.id)

                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Accept': 'application/json'
                    }
                }

                axios.post(urlDetails, formData, config)
                    .then(response => {
                        this.$store.state.transaction.status = 'added'
                        this.$store.state.transaction.message = response.data.msg
                        this.addDetail = ''
                        this.addColor.code = ''
                        this.addColor.name = ''
                        this.loadDetails()
                        history.back()
                    })
                    .catch(errors => {
                        this.$store.state.transaction.status = 'error-add'
                        this.$store.state.transaction.message = errors.response.data.message
                        console.log(errors.response.data)
                        this.addDetail = ''
                        this.addColor.code = ''
                        this.addColor.name = ''
                    })
            } else {
                this.$store.state.transaction.status = 'error-add'
                this.$store.state.transaction.message = 'O(s) campo(s) não pode(m) estar vazio(s)'
            }

        },

        removeDetail(id) {
            let url = this.urlBase + 'produto_detalhe/' + id;

            let formData = new FormData();
            formData.append('_method', 'delete')

            axios.post(url, formData)
                .then(response => {
                    this.$store.state.transaction.status = 'removed'
                    this.$store.state.transaction.message = response.data.msg
                    this.loadDetails()
                })
                .catch(errors => {
                    this.$store.state.transaction.status = 'error-remove'
                    this.$store.state.transaction.message = errors.response.data.message
                })
        },

        loadCategory() { //load all the categories
            let urlCategory = this.urlBase + 'categoria';

            axios.get(urlCategory)
                .then(response => {
                    this.categorys.data = response.data
                    // console.log(this.categorys)
                })
                .catch(errors => {
                    console.log(errors);
                })
        },

        loadOcasions() { //load all the categories
            let urlOcasion = this.urlBase + 'ocasiao';

            axios.get(urlOcasion)
                .then(response => {
                    this.ocasions.data = response.data
                    // console.log(this.categorys)
                })
                .catch(errors => {
                    console.log(errors);
                })
        },

        loadMaterials() { //load all the materials
            let urlMaterials = this.urlBase + 'materia';

            axios.get(urlMaterials)
                .then(response => {
                    this.materials.data = response.data

                    // console.log(this.materials)
                })
                .catch(errors => {
                    console.log(errors);
                })
        },

        loadTaxes() {
            let urlTaxes = this.urlBase + 'taxas';

            axios.get(urlTaxes)
                .then(response => {
                    this.taxes.data = response.data
                })
                .catch(errors => {
                    console.log(errors)
                })
        },

        loadDiscounts() { //load all the disconts
            let urlDiscounts = this.urlBase + 'desconto';

            axios.get(urlDiscounts)
                .then(response => {
                    this.discounts.data = response.data

                    // console.log(this.discount)
                })
                .catch(errors => {
                    console.log(errors);
                })
        },

        saveImage(i) { //validating the right area, saves all the product images (area set by the parameter passed)
            let urlImages = this.urlBase + 'imagens_produto';

            let formData = new FormData();

            let config = {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Accept': 'application/json'
                }
            }

            if (this.mainImage && i == 'mainImage') {

                if (this.mainImage.size < 2097152) {

                    formData.append('nome', this.mainImage);
                    formData.append('posicao', 1);
                    formData.append('produto_id', this.id);

                    axios.post(urlImages, formData, config)
                        .then(response => {
                            this.$store.state.transaction.status = 'added'
                            this.$store.state.transaction.message = response.data.msg
                            this.url = ''
                            alert(response.data.msg)
                            this.getProductImages()
                        })
                        .catch(errors => {
                            this.$store.state.transaction.status = 'error-add'
                            this.$store.state.transaction.message = errors.response.data.message
                            this.mainImage = []
                            this.url = ''
                            console.log(errors.response.data)

                        })
                } else {
                    alert('A imagem carregada é demasiado grande, o maximo permitido é 2MB')
                }
            }

            if (this.images && i == 'images') {
                this.images.forEach(element => {

                    if (element.size < 2097152) {
                        formData.append('nome', element);
                        formData.append('posicao', 2);
                        formData.append('produto_id', this.id);

                        axios.post(urlImages, formData, config)
                            .then(response => {
                                this.$store.state.transaction.status = 'added'
                                this.$store.state.transaction.message = response.data.msg
                                this.urlImages = []
                                this.images = []
                                alert(response.data.msg)
                                this.getProductImages()
                            })
                            .catch(errors => {
                                this.$store.state.transaction.status = 'error-add'
                                this.$store.state.transaction.message = errors.response.data.message
                                this.urlImages = []
                                this.images = []
                                alert(errors.response.data.message)
                            })
                    } else {
                        alert('a imagem ' + element.name + ' é demasiado grande')
                    }
                });

            }
        },
        removeImage(id) {
            let url = this.urlBase + 'imagens_produto/' + id;
            // console.log(url)
            let confirmation = confirm('Tem a certeza que pertende eliminar esta imagem?')
            if (confirmation) {
                let formData = new FormData();
                formData.append('_method', 'delete')

                axios.post(url, formData)
                    .then(response => {
                        this.$store.state.transaction.status = 'removed'
                        this.$store.state.transaction.message = response.data.msg
                        this.mainImage = []
                        this.getProductImages()
                    })
                    .catch(errors => {
                        console.log(errors.response.data)
                        this.$store.state.transaction.status = 'error-remove'
                        this.$store.state.transaction.message = errors.response.data.message
                    })
            }
        },
        update() {
            let ocasion = document.getElementById('ocasion')
            let ocasionValue = ocasion.value

            let category = document.getElementById('category')
            let categoryValue = category.value

            let material = document.getElementById('material')
            let materialValue = material.value

            let discount = document.getElementById('discount')
            let discountValue = discount.value

            let customization = document.getElementById('customization')
            let customizationValue = customization.value

            let url = this.urlBase + 'produto/' + this.id


            let formData = new FormData();
            formData.append('_method', 'patch')

            if (this.updateProduct.name != '') {
                formData.append('nome', this.updateProduct.name);
            }
            if (this.updateProduct.metaName != '') {
                formData.append('meta_nome', this.updateProduct.metaName);
            }
            if (this.updateProduct.quantity != '') {
                formData.append('quantidade', this.updateProduct.quantity);
            }
            if (this.updateProduct.description != '') {
                formData.append('descricao', this.updateProduct.description);
            }
            if (this.updateProduct.price != '') {
                let finalPrice = ''
                this.taxes.data.forEach(element => {
                    if (element.nome == 'Iva') {
                        finalPrice = this.updateProduct.price + (element.valor * this.updateProduct.price)
                        finalPrice = finalPrice.toFixed(2)
                    }
                });
                formData.append('valor', finalPrice)
            }
            formData.append('costumizavel', customizationValue);

            formData.append('ocasioes_id', ocasionValue);

            formData.append('categoria_id', categoryValue);

            formData.append('materia_prima_id', materialValue);

            formData.append('desconto_id', discountValue);


            // console.log(url)

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
                    alert(response.data.msg)
                    this.updateProduct.name = ''
                    this.updateProduct.metaName = ''
                    this.updateProduct.quantity = ''
                    this.updateProduct.description = ''
                    this.updateProduct.price = ''
                    this.updateProduct.customization = ''
                    this.updateProduct.ocasion = ''
                    this.updateProduct.category = ''
                    this.updateProduct.material = ''
                    this.updateProduct.discount = ''
                    this.getProduct();
                    history.back()

                })
                .catch(errors => {
                    console.log('erro de atualização', errors.response.data)
                    this.$store.state.transaction.status = 'error-update'
                    this.$store.state.transaction.message = errors.response.data
                    this.updateProduct.name = ''
                    this.updateProduct.metaName = ''
                    this.updateProduct.quantity = ''
                    this.updateProduct.description = ''
                    this.updateProduct.price = ''
                    this.updateProduct.customization = ''
                    this.updateProduct.ocasion = ''
                    this.updateProduct.category = ''
                    this.updateProduct.material = ''
                    this.updateProduct.discount = ''
                })
        },
        remove() {
            let url = this.urlBase + 'produto/' + this.id

            if (this.productAllImages) {
                this.productAllImages.forEach(element => {
                    this.removeImage(element.id)
                });
            }

            if (this.details.data != '') {
                this.details.data.forEach(element => {
                    this.removeDetail(element.id)
                });
            }

            let formData = new FormData();
            formData.append('_method', 'delete')

            axios.post(url, formData)
                .then(response => {
                    this.$store.state.transaction.status = 'removed'
                    this.$store.state.transaction.message = response.data.msg
                    alert(response.data.msg)
                    window.location.href = 'http://127.0.0.1:8000/dashboard/produtos';
                })
                .catch(errors => {
                    console.log(errors.response.data)
                    this.$store.state.transaction.status = 'error-remove'
                    this.$store.state.transaction.message = errors.response.data.message
                })

        },


    },
    computed: {
        separateImages() {
            let mainImage = []
            let images = []
            this.productAllImages.forEach(e => {

                if (e.posicao == 1) {
                    mainImage.push(e)
                } else {
                    images.push(e)
                }
            })

            this.productMainImage = mainImage
            this.productImages = images
        },
    },
    mounted() {
        this.getProduct();
        this.loadCategory();
        this.loadDiscounts();
        this.loadMaterials();
        this.getProductImages();
        this.loadOcasions();
        this.loadTaxes();
        this.loadDetails();
    }
}
</script>
