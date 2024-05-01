<template>
  <!-- Product Defenitons Page  -->
  <div class="title-cont">
    <h1 class="titulo">Produto</h1>
    <h4 class="titulo_alt">Descontos</h4>
  </div>
  <div class="responsive-container">

    <!------------------------ DISCOUNT AREA --------------------------------->
    <div class="container2">
      <div class="cont-header">
        <h3 class="titulo_1">Descontos</h3>
        <a class="high-link" href="#modalDiscountAdd">Adicionar desconto +</a>
      </div>
      <!--Modal to add new discount-->
      <modal-component id="modalDiscountAdd" title="Adicionar novo desconto">
        <template v-slot:content>
          <input-container id="nome" title="Nome" help="nameDiscount" helpText="Nome do desconto" size="m-input">
            <input type="text" name="nome" aria-describedby="nameDiscount" v-model="newDiscount.name">
          </input-container>

          <input-container id="descricao" title="Descrição" help="descriptionDiscount"
            helpText="Descrição do desconto" size="b-input">
            <textarea name="descricao" aria-describedby="descriptionDiscount" v-model="newDiscount.description">
            </textarea>
          </input-container>

          <input-container id="desconto" title="Valor do desconto" help="valueDiscount"
            helpText="Valor do Desconto (deve ser um valor percentual, com duas casas decimais)">
            <input type="number" name="desconto" aria-describedby="valueDiscount" v-model="newDiscount.value"
              class="s-input">
          </input-container>

          <input-container id="ativo" title="Estado do desconto" help="statusDiscount"
            helpText="Selecionar estado do desconto">
            <select name="ativo" aria-describedby="statusDiscount" v-model="newDiscount.status">
              <option value="" disabled>Escolha uma</option>
              <option value="0">Inativo</option>
              <option value="1">Ativo</option>
            </select>
          </input-container>
        </template>

        <template v-slot:footer>
          <button class="button-save" @click="save('desconto')">Adicionar</button>
          <!--The seconde parameter defines the endpoint for the url-->
        </template>

      </modal-component>

      <!-- Start table to show the discount-->
      <table-component :data="discountData.data" :view="{ visible: false, dataTarget: '#modalDiscountView' }"
        :update="{ visible: true, dataTarget: '#modalDiscountUpdate' }"
        :remove="{ visible: true, dataTarget: '#modalDiscountRemove' }" :titles="{
          id: { title: 'ID', type: 'text' },
          nome: { title: 'Nome', type: 'text' },
          descricao: { title: 'Descrição', type: 'text' },
          desconto: { title: 'Desconto', type: 'text' },
          ativo: { title: 'Estado', type: 'status' },
          created_at: { title: 'Data de criação', type: 'date' },
        }">
      </table-component>
      <!-- End table to show the discount-->

      <!-- Start modal to remove discount-->
      <modal-component id="modalDiscountRemove" title="Remover Desconto">
        <template v-slot:content>
          <input-container id="removeDiscount" title="Tem a certeza que pretende remover este desconto?">
            <input type="text" name="removeDiscount" aria-describedby="removeDiscount" :value="$store.state.item.nome"
              disabled>
          </input-container>
        </template>

        <template v-slot:footer>
          <button class="button-save" @click="remove($store.state.item.id, 'desconto')">Remover</button>
          <!--The seconde parameter defines the endpoint for the url-->
        </template>
      </modal-component>
      <!-- End modal to remove discount-->

      <!-- Start modal to update discount-->
      <modal-component id="modalDiscountUpdate" title="Atualizar desconto">
        <template v-slot:content>
          <input-container id="nome" title="Nome" help="updateNameDiscount"
            helpText="Novo nome do desconto">
            <input type="text" name="nome" aria-describedby="updateNameDiscount"
              :placeholder="$store.state.item.nome" v-model="updateDiscount.name">
          </input-container>

          <input-container id="descricao" title="Descrição" help="updateDescriptionDiscount"
            helpText="Nova descrição do desconto" size="b-input">
            <textarea name="descricao" aria-describedby="updateDescriptionDiscount"
              :placeholder="$store.state.item.descricao" v-model="updateDiscount.description"></textarea>
          </input-container>

          <input-container id="desconto" title="Valor do Desconto" help="updateValueDiscount"
            helpText="Novo valor do Desconto (deve ser um valor percentual, com duas casas decimais)">
            <input type="number" name="desconto" aria-describedby="updateValueDiscount"
              :placeholder="$store.state.item.desconto" v-model="updateDiscount.value">
          </input-container>

          <input-container id="ativo" title="Estado do desconto" help="updateStatusDiscount"
            helpText="Selecionar estado do desconto">
            <select name="ativo" id="updateStatusDiscount" :value="$store.state.item.ativo" >
              <option value="0">Inativo</option>
              <option value="1">Ativo</option>
            </select>
          </input-container>
        </template>

        <template v-slot:footer>
          <button class="button-save" @click="update($store.state.item.id, 'desconto')">Atualizar</button>
          <!--The seconde parameter defines the endpoint for the url-->
        </template>

      </modal-component>
      <!-- End modal to update discount-->
    </div>
  </div>
  <div class="container3">

    <div class="cont-header">
      <h3 class="titulo_2">Atribuir desconto a um produto</h3>
    </div>

    <div class="content3-line">
      <div class="el1">
        <h5>Escolha um produto</h5>
        <div class="table-container">
          <div class="table">
            <table>
              <thead>
                <tr>
                  <th>NOME</th>
                  <th></th>
                  <th>DESCONTO</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="product, index in products.data" :key="index">
                  <td>{{ product.nome }}</td>
                  <td></td>
                  <td>{{ product.desconto.nome }}</td>
                  <td></td>
                  <td><input type="checkbox" id="checkedProducts" :value="product.id" v-model="checkedProducts"></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="el2">
        <h5>Escolha um desconto</h5>
        <select id="discounts" v-model="productDiscount">
          <option value="" disabled>Escolha um desconto</option>
          <option v-for="discount, index in discountData.data" :key="index" :value="discount.id">{{ discount.nome }}
          </option>
        </select>
      </div>

      <div class="el3">
        <button class="button1" @click="updateProduct()">Atribuir desconto</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      checkedProducts: [],
      productDiscount: '',
      urlBase: 'http://127.0.0.1:8000/api/',
      discountData: { data: [] },
      newDiscount: {
        name: '',
        description: '',
        value: '',
        status: ''
      },
      updateDiscount: {
        name: '',
        description: '',
        value: '',
        status: ''
      },
      active: false,
      statusTransition: '',
      detailsTransition: '',
      products: { data: [] }
    }
  },
  methods: {
    loadProducts() {
      let urlProducts = this.urlBase + 'produto';

      axios.get(urlProducts)
        .then(response => {
          this.products.data = response.data.all
          // console.log(response.data)
        })
        .catch(errors => {
          console.log(errors);
        })
    },
    loadTableData() { //loads the category data to the table
      // let urlCategory = this.urlBase + 'categoria';
      // let urlMaterial = this.urlBase + 'materia';
      let urlDiscount = this.urlBase + 'desconto';

      axios.get(urlDiscount)
        .then(response => {
          this.discountData.data = response.data
        })
        .catch(errors => {
          console.log(errors);
        })
    },
    save(c) { //saves the new values (category and material)
      let url = this.urlBase + c;

      let formData = new FormData();

      if (c == 'desconto') {

        formData.append('nome', this.newDiscount.name);
        formData.append('descricao', this.newDiscount.description);
        if (this.newDiscount.value) {
          formData.append('desconto', this.newDiscount.value.toFixed(2));
        } else {
          formData.append('desconto', this.newDiscount.value);
        }
        formData.append('ativo', this.newDiscount.status);
      }

      let config = {
        headers: {
          'Content-Type': 'x-www-form-urlencoded',
          'Accept': 'application/json'
        }
      }
      axios.post(url, formData, config)
        .then((response) => {
          this.$store.state.transaction.status = 'added'
          this.$store.state.transaction.message = response.data.msg
          alert(response.data.msg)
          this.loadTableData()
          history.back()
          this.newDiscount.name = ""
          this.newDiscount.description = ""
          this.newDiscount.value = ""
          this.newDiscount.status = ""

        })
        .catch(errors => {
          this.$store.state.transaction.status = 'error-add'
          this.$store.state.transaction.message = errors.response.data.errors
          this.newDiscount.name = ""
          this.newDiscount.description = ""
          this.newDiscount.value = ""
          this.newDiscount.status = ""
        })


    },
    remove(r, n) { //removes the data (r=id n = table to affect)

      if (this.products.data) {
        this.products.data.forEach(element => {
          if (element.desconto_id == r && n == 'desconto') {
            let url = this.urlBase + 'produto/' + element.id

            let formData = new FormData();
            formData.append('_method', 'patch')

            formData.append('desconto_id', 1);

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
              })
              .catch(errors => {
                this.$store.state.transaction.status = 'error-update'
                this.$store.state.transaction.message = errors.response.data
                alert(errors.response.data)
              })

          }
        });
      }

      let url = this.urlBase + n + '/' + r

      let formData = new FormData();
      formData.append('_method', 'delete')

      axios.post(url, formData)
        .then(response => {
          this.$store.state.transaction.status = 'removed'
          this.$store.state.transaction.message = response.data.msg
          alert(response.data.msg)
          this.loadTableData()
          history.back()
        })
        .catch(errors => {
          console.log(errors.response.data)
          this.$store.state.transaction.status = 'error-remove'
          this.$store.state.transaction.message = errors.response.data.message
        })

    },
    updateProduct() {
      if (this.checkedProducts != '' && this.productDiscount != '') {
        let config = {
          headers: {
            'Content-Type': 'x-www-form-urlencoded',
            'Accept': 'application/json'
          }
        }

        let formData = new FormData();

        formData.append('_method', 'patch')

        this.checkedProducts.forEach(product => {

          let url = this.urlBase + 'produto/' + product

          formData.append('desconto_id', this.productDiscount)

          axios.post(url, formData, config)
            .then(response => {

              this.$store.state.transaction.status = 'updated'
              this.$store.state.transaction.message = response.data.msg
              this.loadProducts()
              alert(response.data.msg)
              this.checkedProducts = [],
                this.productDiscount = ''

            })
            .catch(errors => {
              console.log('erro de atualização', errors.response.data)
              this.$store.state.transaction.status = 'error-update'
              this.$store.state.transaction.message = errors.response.data.errors
              this.checkedProducts = [],
                this.productDiscount = ''
            })
        })
      }else{
        alert('É obrigatório selecionar pelo menos um produto e um desconto')
      }

    },
    update(u, n) { //update either the category or material
      const input = document.getElementById('updateStatusDiscount')
      const inputValue = input.value

      let formData = new FormData();
      formData.append('_method', 'patch')

      if (n == 'desconto') {
        if (this.updateDiscount.name != '') {
          formData.append('nome', this.updateDiscount.name);
        }
        if (this.updateDiscount.description != '') {
          formData.append('descricao', this.updateDiscount.description);
        }
        if (this.updateDiscount.value != '') {
          let value = this.updateDiscount.value.toFixed(2);
          formData.append('desconto', value);
        }
          formData.append('ativo', inputValue);
      }

      let url = this.urlBase + n + '/' + u

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
          this.loadTableData()
          history.back()
          alert(response.data.msg)
          this.updateDiscount.name = ""
          this.updateDiscount.description = ""
          this.updateDiscount.value = ""
          this.updateDiscount.status = ""

        })
        .catch(errors => {
          console.log('erro de atualização', errors.response.data)
          this.$store.state.transaction.status = 'error-update'
          this.$store.state.transaction.message = errors.response.data.errors
          this.updateDiscount.name = ""
          this.updateDiscount.description = ""
          this.updateDiscount.value = ""
          this.updateDiscount.status = ""
        })
    },
  },
  mounted() {
    this.loadTableData()
    this.loadProducts()
  }
}
</script>