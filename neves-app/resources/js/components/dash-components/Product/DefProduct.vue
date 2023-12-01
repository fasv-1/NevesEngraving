<template>
  <!-- Product Defenitons Page  -->
  <div class="productInputContent">

    <!------------------------ ADD CATEGORY AREA --------------------------------->
    <div class="conteiner2">
      <h3 class="titulo_1">Categorias</h3>

      <!--Form to add new category-->
      <div class="content_1">
        <input-container id="newCategory" titulo='Nova Categoria' help="categoryHelp"
          helpText="Insira o nome da categoria">
          <alert-component tipe="success" :details="detailsTransition"
            v-if="statusTransition == 'adicionado'"></alert-component>
          <alert-component tipe="danger" :details="detailsTransition" v-if="statusTransition == 'erro'"></alert-component>
          <div class="inputSlot">
            <input type="text" id="newCategory" name="newCategory" class="form-text" aria-describedby="newCategory"
              placeholder="Nome da Categoria" v-model="newCategory">
          </div>
        </input-container>
        <button class="button-save" @click="save('categoria')">Adicionar</button>
      </div>

      <!--Table to show the categorys-->
      <table-component heading1='nome' heading2='data_criação'>
        <tr v-for="c in categorias" :key="c.id">
          <td>{{ c.nome }}</td>
          <td class="feel"></td>
          <td>{{ formatData(c.created_at) }}</td>
          <td class="feel"></td>
          <td><a href="" @click.prevent="openModal(c.id, 'categoria')">Atualizar</a></td>
          <modal-component v-if="modalActive == 'categoria'" id="newCategory" title="Atualizar Categoria" :openModal="active">
            <template v-slot:header>
              <button type="button" class="btn-modal-close" aria-label="Close" @click="openModal()">X</button>
            </template>
            <template v-slot:alerts>
              <alert-component tipe="success" :details="detailsTransition"
                v-if="statusTransition == 'atualizado'"></alert-component>
              <alert-component tipe="danger" :details="detailsTransition"
                v-if="statusTransition == 'erro'"></alert-component>
            </template>
            <template v-slot:content>
              <input type="text" id="newCategory" name="newCategory" class="form-text" aria-describedby="newCategory"
                placeholder="Nome da categoria" v-model="updateCategory">
            </template>
            <template v-slot:footer>
              <button type="button" class="button-save" @click="update(updateId, 'categoria')">Salvar</button>
            </template>
          </modal-component>
          <td><a href="" @click.prevent="remove(c.id, 'categoria')">Eliminar</a></td>
        </tr>
      </table-component>

    </div>

    <!------------------------ ADD MATERIAL AREA --------------------------------->
    <div class="conteiner2">
      <h3 class="titulo_1">Materiais</h3>

      <!--Form to add new materials-->
      <div class="content_1">
        <input-container id="newMaterial" titulo='Nova Matéria-prima' help="materialHelp"
          helpText="Insira o nome da matéria-prima">
          <alert-component tipe="success" :details="detailsTransition"
            v-if="statusTransition == 'adicionado'"></alert-component>
          <alert-component tipe="danger" :details="detailsTransition" v-if="statusTransition == 'erro'"></alert-component>
          <div class="inputSlot">
            <input type="text" id="newMaterial" name="newMaterial" class="form-text" aria-describedby="newMaterial"
              placeholder="Nome da Matéria-prima" v-model="newMaterial">
          </div>
        </input-container>
        <button class="button-save" @click="save('materia')">Adicionar</button>
      </div>

      <!--Table to show the materials-->
      <table-component heading1='nome' heading2='data_criação'>
        <tr v-for="c in materiais" :key="c.id">
          <td>{{ c.nome }}</td>
          <td class="feel"></td>
          <td>{{ formatData(c.created_at) }}</td>
          <td class="feel"></td>
          <td><a href="" @click.prevent="openModal(c.id, 'materia')">Atualizar</a></td>
          <modal-component v-if="modalActive == 'materia'" id="newMaterial" title="Atualizar Matéria-prima" :openModal="active">
            <template v-slot:header>
              <button type="button" class="btn-modal-close" aria-label="Close" @click="openModal()">X</button>
            </template>
            <template v-slot:alerts> <!--REFAZER ALERTAS PARA NÃO APARECEREM EM TODAS AS SLOTS-->
              <alert-component tipe="success" :details="detailsTransition"
                v-if="statusTransition == 'atualizado'"></alert-component>
              <alert-component tipe="danger" :details="detailsTransition"
                v-if="statusTransition == 'erro'"></alert-component>
            </template>
            <template v-slot:content>
              <input type="text" id="newMaterial" name="newMaterial" class="form-text" aria-describedby="newMaterial"
                placeholder="Nome da Matéria-prima" v-model="updateMaterial">
            </template>
            <template v-slot:footer>
              <button type="button" class="button-save" @click="update(updateId, 'materia')">Salvar</button>
            </template>
          </modal-component>
          <td><a href="" @click.prevent="remove(c.id, 'materia')">Eliminar</a></td>
        </tr>
      </table-component>

    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      urlBase: 'http://127.0.0.1:8000/api/',
      categorias: [],
      newCategory: '',
      updateCategory: '',
      active: false,
      statusTransition: '',
      detailsTransition: '',
      updateId: '',
      materiais: [],
      newMaterial: '',
      updateMaterial: '',
      modalActive: '',
    }
  },
  methods: {
    openModal(id, i) { //open the modal to update 
      this.active = !this.active;
      
      if (i) {
        this.modalActive = i;
      }

      if (id) { //sets the id to update
        this.updateId = id;
      }
    },
    loadTableData() { //loads the category data to the table
      let urlCategory = this.urlBase + 'categoria';
      let urlMaterial = this.urlBase + 'materia';

      if (urlCategory) {
        axios.get(urlCategory)
          .then(response => {
            this.categorias = response.data
          })
          .catch(errors => {
            console.log(errors);
          })
      }

      if (urlMaterial) {
        axios.get(urlMaterial)
          .then(response => {
            this.materiais = response.data
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
          this.statusTransition = 'adicionado'
          this.detailsTransition = {
            message: 'A ' + c + ' ' + response.data.nome + ' foi adicionada com sucesso'
          }
          this.loadTableData()
          this.newMaterial = ""
          this.newCategory = ""
        })
        .catch(errors => {
          this.statusTransition = 'erro'
          this.detailsTransition = {
            message: errors.response.data.message
          }
          // console.log(errors.response.data.message)
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
          this.statusTransition = 'atualizado'
          this.detailsTransition = {
            message: 'A '+ n + ' ' + response.data.nome + ' foi atualizada com sucesso'
          }
          this.loadTableData()
          this.openModal()
          alert('A '+ n + ' ' + response.data.nome + ' foi atualizada com sucesso')
          this.updateCategory = "";
        })
        .catch(errors => {
          console.log('erro de atualização', errors.response)
          this.statusTransition = 'erro'
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