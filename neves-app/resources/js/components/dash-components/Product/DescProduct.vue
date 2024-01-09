<template>
  <!-- Product Defenitons Page  -->
  <div class="title-cont">
    <h1 class="titulo">Produto</h1>
    <h4 class="titulo_alt">Descontos</h4>
  </div>
  <div class="productInputContent">

    <!------------------------ DISCOUNT AREA --------------------------------->
    <div class="conteiner2">
      <h3 class="titulo_1">Descontos</h3>

      <a class="high-link" href="#modalDiscountAdd">Adicionar desconto +</a>
      <!--Modal to add new discount-->
      <modal-component id="modalDiscountAdd" title="Adicionar novo desconto">
        <template v-slot:alerts>
          <alert-component tipe="danger" :details="$store.state.transaction"
            v-if="$store.state.transaction.status == 'error-add'"></alert-component>
          <alert-component tipe="success" :details="$store.state.transaction.message"
            v-if="$store.state.transaction.status == 'added'"></alert-component>
        </template>
        <template v-slot:content>
          <input-container id="nameDiscount" title="Nome" help="nameDiscount" helpText="Nome do desconto" size="m-input">
            <input type="text" name="nameDiscount" aria-describedby="nameDiscount" v-model="newDiscount.name">
          </input-container>

          <input-container id="descriptionDiscount" title="Descrição" help="descriptionDiscount"
            helpText="Descrição do desconto" size="b-input">
            <textarea name="descriptionDiscount" aria-describedby="descriptionDiscount" v-model="newDiscount.description">
            </textarea>
          </input-container>

          <input-container id="valueDiscount" title="Valor do desconto" help="valueDiscount"
            helpText="Valor do Desconto (deve ser um valor percentual, com duas casas decimais)">
            <input type="number" name="valueDiscount" aria-describedby="valueDiscount" v-model="newDiscount.value" class="s-input">
          </input-container>

          <input-container id="statusDiscount" title="Estado do desconto" help="statusDiscount"
            helpText="Selecionar estado do desconto">
            <select name="statusDiscount" aria-describedby="statusDiscount" v-model="newDiscount.status">
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

        <template v-slot:alerts>
          <alert-component tipe="danger" :details="$store.state.transaction"
            v-if="$store.state.transaction.status == 'error-remove'"></alert-component>
        </template>
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
        <template v-slot:alerts>
          <alert-component tipe="danger" :details="$store.state.transaction.message"
            v-if="$store.state.transaction.status == 'error-update'"></alert-component>
        </template>
        <template v-slot:content>
          <input-container id="updateNameDiscount" title="Nome" help="updateNameDiscount"
            helpText="Novo nome do desconto">
            <input type="text" name="updateNameDiscount" aria-describedby="updateNameDiscount"
              :placeholder="$store.state.item.nome" v-model="updateDiscount.name">
          </input-container>

          <input-container id="updateDescriptionDiscount" title="Descrição" help="updateDescriptionDiscount"
            helpText="Nova descrição do desconto">
            <textarea name="updateDescriptionDiscount" aria-describedby="updateDescriptionDiscount"
              :placeholder="$store.state.item.descricao" v-model="updateDiscount.description"></textarea>
          </input-container>

          <input-container id="updateValueDiscount" title="Valor do Desconto" help="updateValueDiscount"
            helpText="Novo valor do Desconto (deve ser um valor percentual, com duas casas decimais)">
            <input type="number" name="updateValueDiscount" aria-describedby="updateValueDiscount"
              :placeholder="$store.state.item.desconto" v-model="updateDiscount.value">
          </input-container>

          <input-container id="updateStatusDiscount" title="Estado do desconto" help="updateStatusDiscount"
            helpText="Selecionar estado do desconto">
            <select name="updateStatusDiscount" aria-describedby="updateStatusDiscount" v-model="updateDiscount.status">
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
</template>

<script>
export default {
  data() {
    return {
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
    }
  },
  methods: {
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
          this.$store.state.transaction.message = errors.response.data.message
          this.newDiscount.name = ""
          this.newDiscount.description = ""
          this.newDiscount.value = ""
          this.newDiscount.status = ""
        })


    },
    remove(r, n) { //removes the data (category and material)

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
    update(u, n) { //update either the category or material
      let formData = new FormData();
      formData.append('_method', 'patch')

      if (n == 'categoria') {
        formData.append('nome', this.updateCategory)
      }

      if (n == 'materia') {
        formData.append('nome', this.updateMaterial)
      }

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
        if (this.updateDiscount.status != '') {
          formData.append('ativo', this.updateDiscount.status);
        }
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
          this.$store.state.transaction.message = errors.response.data
          this.updateDiscount.name = ""
          this.updateDiscount.description = ""
          this.updateDiscount.value = ""
          this.updateDiscount.status = ""
        })
    },
  },
  mounted() {
    this.loadTableData()
  }
}
</script>