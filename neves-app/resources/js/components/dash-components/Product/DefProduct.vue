<template>
  <!-- Product Defenitons Page  -->
  <div class="productInputContent">

    <!------------------------ ADD CATEGORY AREA --------------------------------->
    <div class="conteiner2">
      <h3 class="titulo_1">Categorias</h3>
      <!--Form to add new category-->
      <div class="inputBox1">
        <input-container titulo='Nova Categoria' help="categoryHelp" helpText="Insira o nome da categoria">
          <alert-component tipe="danger" :details="detailsTransition"
            v-if="statusTransition == 'categoria-erro'"></alert-component>
          <div class="inputSlot">
            <input type="text" name="newCategory" class="form-text" aria-describedby="newCategory"
              placeholder="Nome da Categoria" v-model="newCategory">
          </div>
        </input-container>
        <button class="button-save" @click="save('categoria')">Adicionar</button>
      </div>

      <!-- Start table to show the categorys-->
      <table-component 
      :data="categorias.data" 
      :view = "{visible: true , dataTarget:'#modalCategoriaView'}" 
      :update="false"           
      :remove="true"
      :titles="{
        id: { title: 'ID', type: 'text' },
        nome: { title: 'Nome', type: 'text' },
        created_at: { title: 'Data de criação', type: 'data' },
      }">
      </table-component>
      <!-- End table to show the categorys-->
      <!-- Start modal to update categorys-->
      <modal-component id="modalCategoriaView" title="Atualizar categorias">
        <template v-slot:content>{{ $store.state.item }}</template>
      </modal-component>
      <!-- End modal to update categorys-->
    </div>

    <!------------------------ ADD MATERIAL AREA --------------------------------->
    <div class="conteiner2">
      <h3 class="titulo_1">Materiais</h3>

      <!--Form to add new materials-->
      <div class="inputBox1">
        <input-container titulo='Nova Matéria-prima' help="materialHelp" helpText="Insira o nome da matéria-prima">
          <alert-component tipe="danger" :details="detailsTransition"
            v-if="statusTransition == 'materia-erro'"></alert-component>
          <div class="inputSlot">
            <input type="text" name="newMaterial" class="form-text" aria-describedby="newMaterial"
              placeholder="Nome da Matéria-prima" v-model="newMaterial">
          </div>
        </input-container>
        <button class="button-save" @click="save('materia')">Adicionar</button>
      </div>

      <!--Table to show the materials-->
      <!-- <table-component 
      :data="materiais.data" 
      :view = 'false'
      :update="true" 
      :remove="true"
      :titles="{
        id: { title: 'ID', type: 'text' },
        nome: { title: 'Nome', type: 'text' },
        created_at: { title: 'Data de criação', type: 'data' },
      }">
      </table-component> -->

    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      urlBase: 'http://127.0.0.1:8000/api/',
      categorias: { data:[] },
      newCategory: '',
      updateCategory: '',
      active: false,
      statusTransition: '',
      detailsTransition: '',
      updateId: '',
      materiais: { data:[] },
      newMaterial: '',
      updateMaterial: '',
      modalActive: '',
      updMaterialId: '',
    }
  },
  methods: {
    /*openModal(id, i) { //open the modal to update 
      this.active = !this.active;
      
      if (i) {
        this.modalActive = i;
      }

      if (id) { //sets the id to update
        this.updateId = id;
      }
    },*/
    loadTableData() { //loads the category data to the table
      let urlCategory = this.urlBase + 'categoria';
      let urlMaterial = this.urlBase + 'materia';

      if (urlCategory) {
        axios.get(urlCategory)
          .then(response => {
            this.categorias.data = response.data
          })
          .catch(errors => {
            console.log(errors);
          })
      }

      if (urlMaterial) {
        axios.get(urlMaterial)
          .then(response => {
            this.materiais.data = response.data
          })
          .catch(errors => {
            console.log(errors);
          })
      }
    },
    formatData(d) { //splits the data from the hours
      d = d.split('T')
      d = d[0]
      return d;
    },
    save(c) { //saves the new values (category and material)
      let url = this.urlBase + c;

      let formData = new FormData();

      if (c == 'categoria') {
        formData.append('nome', this.newCategory);
      }
      if (c == 'materia') {
        formData.append('nome', this.newMaterial);
      }

      let config = {
        headers: {
          'Content-Type': 'x-www-form-urlencoded',
          'Accept': 'application/json'
        }
      }
      axios.post(url, formData, config)
        .then((response) => {
          this.statusTransition = response.data.nome + 'adicionado'
          this.detailsTransition = {
            message: 'A ' + c + ' ' + response.data.nome + ' foi adicionada com sucesso'
          }
          alert('A ' + c + ' ' + response.data.nome + ' foi adicionada com sucesso')
          this.loadTableData()
          this.newMaterial = ""
          this.newCategory = ""
        })
        .catch(errors => {
          this.statusTransition = errors.response.config.url.split('/')[4] + '-erro'
          this.detailsTransition = {
            message: errors.response.data.message
          }

          // console.log(errors.response.config.url.split('/'))
        })


    },
    remove(r, n) { //removes the data (category and material)
      let confirmacao = confirm('Tem a certeza que deseja remover este registo?')
      if (!confirmacao) {
        return false
      }
      let url = this.urlBase + n + '/' + r
      console.log(url)

      let formData = new FormData();
      formData.append('_method', 'delete')



      axios.post(url, formData)
        .then(response => {
          alert(response.data);
          this.loadTableData()
        })
        .catch(errors => {
          alert(errors.response.data.message);
        })

    },
    idToUpdate(x) {
      this.updateId = x;
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

      let url = this.urlBase + n + '/' + u

      console.log(url)

      let config = {
        headers: {
          'Content-Type': 'x-www-form-urlencoded',
          'Accept': 'application/json'
        }
      }

      axios.post(url, formData, config)
        .then(response => {
          console.log('atualizado', response)
          this.statusTransition = response.data.nome + 'atualizado'
          this.detailsTransition = {
            message: 'A ' + n + ' ' + response.data.nome + ' foi atualizada com sucesso'
          }
          this.loadTableData()
          alert('A ' + n + ' ' + response.data.nome + ' foi atualizada com sucesso')
          this.updateCategory = ""
          history.back()
        })
        .catch(errors => {
          console.log('erro de atualização', errors.response)
          this.statusTransition = errors.response.config.url.split('/')[4] + '-erroAtualizacao'
          this.detailsTransition = {
            message: errors.response.data.message
          }
        })
    },
  },
  mounted() {
    this.loadTableData()
  }
}
</script>