<template>
  <!-- Product Defenitons Page  -->
  <div class="title-cont">
    <h1 class="titulo">Produto</h1>
    <h4 class="titulo_alt">Defenições</h4>
  </div>
  <div class="responsive-container">

    <!------------------------ CATEGORY AREA --------------------------------->
    <div class="container2">

      <div class="cont-header">
        <h3 class="titulo_1">Categorias</h3>
        <a class="high-link" href="#modalCategoriaAdd">Adicionar Categoria +</a>
      </div>

      <!--Modal to add new category-->
      <modal-component id="modalCategoriaAdd" title="Adicionar uma categoria">
        <template v-slot:content>
          <input-container id="nome" title="Categoria" help="addCategory" helpText="Nome da Categoria">
            <input type="text" name="nome" aria-describedby="addCategory" v-model="newCategory">
          </input-container>
        </template>

        <template v-slot:footer>
          <button class="button-save" @click="save('categoria')">Adicionar</button>
          <!--The seconde parameter defines the endpoint for the url-->
        </template>

      </modal-component>

      <!-- Start table to show the categorys-->
      <table-component :data="categorys.data" :view="{ visible: false, dataTarget: '#modalCategoriaView' }"
        :update="{ visible: true, dataTarget: '#modalCategoriaUpdate' }"
        :remove="{ visible: true, dataTarget: '#modalCategoriaRemove' }" :titles="{
              id: { title: 'ID', type: 'text' },
              nome: { title: 'Nome', type: 'text' },
              created_at: { title: 'Data de criação', type: 'date' },
            }">
      </table-component>
      <!-- End table to show the categorys-->

      <!-- Start modal to remove categorys-->
      <modal-component id="modalCategoriaRemove" title="Remover categoria">

        <template v-slot:alerts>
          <alert-component tipe="danger" :details="$store.state.transaction"
            v-if="$store.state.transaction.status == 'error-remove'"></alert-component>
        </template>
        <template v-slot:content>
          <input-container id="removeCatergory" title="Tem a certeza que quer remover esta categoria?">
            <input type="text" name="removeCatergory" aria-describedby="removeCategory" :value="$store.state.item.nome"
              disabled>
          </input-container>
        </template>

        <template v-slot:footer>
          <button class="button-save" @click="remove($store.state.item.id, 'categoria')">Remover</button>
          <!--The seconde parameter defines the endpoint for the url-->
        </template>
      </modal-component>
      <!-- End modal to remove categorys-->

      <!-- Start modal to update categorys-->
      <modal-component id="modalCategoriaUpdate" title="Atualizar categoria">
        <template v-slot:content>
          <input-container id="nome" title="Atualizar Categoria" help="UpdateCategory"
            helpText="Novo nome da Categoria">
            <input type="text" name="nome" aria-describedby="updateCategory"
              :placeholder="$store.state.item.nome" v-model="updateCategory">
          </input-container>
        </template>

        <template v-slot:footer>
          <button class="button-save" @click="update($store.state.item.id, 'categoria')">Atualizar</button>
          <!--The seconde parameter defines the endpoint for the url-->
        </template>

      </modal-component>
      <!-- End modal to update categorys-->
    </div>

    <!------------------------ OCASION AREA --------------------------------->
    <div class="container2">

      <div class="cont-header">
        <h3 class="titulo_1">Ocasião</h3>
        <a class="high-link" href="#modalOcasionAdd">Adicionar Ocasião +</a>
      </div>

      <!--Modal to add new ocasion-->
      <modal-component id="modalOcasionAdd" title="Adicionar uma ocasião">
        <template v-slot:content>
          <input-container id="nome" title="Ocasião" help="addOcasion" helpText="Nome da Ocasião">
            <input type="text" name="nome" aria-describedby="addOcasion" v-model="newOcasion">
          </input-container>
          <input-container id="estado" title="Estado" help="addOcasionStatus" helpText="Estado da Ocasião">
            <select name="estado" v-model="newOcasionStatus">
              <option value="" disabled>Escolha um</option>
              <option value="0">Inativo</option>
              <option value="1">Ativo</option>
            </select>
          </input-container>
        </template>

        <template v-slot:footer>
          <button class="button-save" @click="save('ocasiao')">Adicionar</button>
          <!--The seconde parameter defines the endpoint for the url-->
        </template>

      </modal-component>
      <!-- End Modal to add new ocasion-->

      <!-- Start table to show the ocasions-->
      <table-component :data="ocasions.data" :view="{ visible: false, dataTarget: '#modalOcasionView' }"
        :update="{ visible: true, dataTarget: '#modalOcasionUpdate' }"
        :remove="{ visible: true, dataTarget: '#modalOcasionRemove' }" :titles="{
              id: { title: 'ID', type: 'text' },
              nome: { title: 'Nome', type: 'text' },
              estado: { title: 'Estado', type: 'status' },
              created_at: { title: 'Data de criação', type: 'date' },
            }">
      </table-component>
      <!-- End table to show the ocasions-->

      <!-- Start modal to remove ocasions-->
      <modal-component id="modalOcasionRemove" title="Remover ocasião">
        <template v-slot:content>
          <input-container id="removeOcasion" title="Tem a certeza que quer remover esta categoria?">
            <input type="text" name="removeOcasion" aria-describedby="removeOcasion" :value="$store.state.item.nome"
              disabled>
          </input-container>
        </template>

        <template v-slot:footer>
          <button class="button-save" @click="remove($store.state.item.id, 'ocasiao')">Remover</button>
          <!--The seconde parameter defines the endpoint for the url-->
        </template>
      </modal-component>
      <!-- End modal to remove ocasion-->

      <!-- Start modal to update ocasion-->
      <modal-component id="modalOcasionUpdate" title="Atualizar ocasião">
        <template v-slot:content>
          <input-container id="nome" title="Atualizar ocasião" help="UpdateOcasion"
            helpText="Novo nome da ocasião">
            <input type="text" name="nome" aria-describedby="updateOcasion"
              :placeholder="$store.state.item.nome" v-model="updateOcasion">
          </input-container>
          <input-container id="estado" title="Atualizar estado da ocasião" help="UpdateOcasionStatus"
            helpText="Novo estado da ocasião">
            <select name="estado" id="updateOcasionStatus" :value="$store.state.item.estado">
              <option value="0">Inativo</option>
              <option value="1">Ativo</option>
            </select>
          </input-container>
        </template>

        <template v-slot:footer>
          <button class="button-save" @click="update($store.state.item.id, 'ocasiao')">Atualizar</button>
          <!--The seconde parameter defines the endpoint for the url-->
        </template>

      </modal-component>
      <!-- End modal to update categorys-->
    </div>

    <!------------------------ MATERIAL AREA --------------------------------->

    <div class="container2">
      <div class="cont-header">
        <h3 class="titulo_1">Matéria-prima</h3>
        <a class="high-link" href="#modalMaterialAdd">Adicionar matéria-prima +</a>
      </div>

      <!--Modal to add new material-->
      <modal-component id="modalMaterialAdd" title="Adicionar uma matéria-prima">
        <template v-slot:content>
          <input-container id="nome" title="Matéria-prima" help="addMaterial" helpText="Nome da matéria-prima">
            <input type="text" name="nome" aria-describedby="addMaterial" v-model="newMaterial">
          </input-container>
        </template>

        <template v-slot:footer>
          <button class="button-save" @click="save('materia')">Adicionar</button>
          <!--The seconde parameter defines the endpoint for the url-->
        </template>

      </modal-component>
      <!--End modal to add new material-->

      <!-- Start table to show the materials-->
      <table-component :data="materiais.data" :view="{ visible: false, dataTarget: '#modalMaterialView' }"
        :update="{ visible: true, dataTarget: '#modalMaterialUpdate' }"
        :remove="{ visible: true, dataTarget: '#modalMaterialRemove' }" :titles="{
              id: { title: 'ID', type: 'text' },
              nome: { title: 'Nome', type: 'text' },
              created_at: { title: 'Data de criação', type: 'date' },
            }">
      </table-component>
      <!-- End table to show materials-->


      <!-- Start modal to remove material-->
      <modal-component id="modalMaterialRemove" title="Remover matéria-prima">

        <template v-slot:alerts>
          <alert-component tipe="danger" :details="$store.state.transaction"
            v-if="$store.state.transaction.status == 'error-remove'"></alert-component>
        </template>
        <template v-slot:content>
          <input-container id="removeMaterial" title="Tem a certeza que quer remover esta matéria-prima?">
            <input type="text" name="removeMaterial" aria-describedby="removeMaterial" :value="$store.state.item.nome"
              disabled>
          </input-container>
        </template>

        <template v-slot:footer>
          <button class="button-save" @click="remove($store.state.item.id, 'materia')">Remover</button>
          <!--The seconde parameter defines the endpoint for the url-->
        </template>
      </modal-component>
      <!-- End modal to remove material-->

      <!-- Start modal to update material-->
      <modal-component id="modalMaterialUpdate" title="Atualizar matéria-prima">
        <template v-slot:content>
          <input-container id="nome" title="Atualizar matéria-prima" help="updateMaterial"
            helpText="Novo nome da matéria-prima">
            <input type="text" name="nome" aria-describedby="updateMaterial"
              :placeholder="$store.state.item.nome" v-model="updateMaterial">
          </input-container>
        </template>

        <template v-slot:footer>
          <button class="button-save" @click="update($store.state.item.id, 'materia')">Atualizar</button>
          <!--The seconde parameter defines the endpoint for the url-->
        </template>

      </modal-component>
      <!-- End modal to update material-->

    </div>
  </div>
  <div>
    <!------------------------ DELETED PRODUCTS AREA --------------------------------->

    <div class="container">
      <div class="cont-header">
        <h3 class="titulo_1">Produtos Eliminados</h3>
      </div>

      <!-- Table to show deleted products-->
      <table-component :data="deletedProducts.data" :view="{ visible: false, dataTarget: '' }"
        :update="{ visible: true, dataTarget: '#modalDeletedUpdate' }"
        :remove="{ visible: true, dataTarget: '#modalDeletedlRemove' }" :titles="{
              id: { title: 'ID', type: 'text' },
              nome: { title: 'Nome', type: 'text' },
              deleted_at: { title: 'Eleminado em', type: 'date' },
            }">
      </table-component>
      <!-- End table to show deleted products-->

      <!-- Start modal to update deleted products-->
      <modal-component id="modalDeletedUpdate" title="Restaurar Produto Eliminado">
        <template v-slot:alerts>
          <alert-component tipe="danger" :details="$store.state.transaction.message"
            v-if="$store.state.transaction.status == 'error-update'"></alert-component>
        </template>
        <template v-slot:content>
          <h4>Tem a certeza que pertende restaurar este produto?</h4>
        </template>

        <template v-slot:footer>
          <button class="button-save" @click="update($store.state.item.id, 'produto')">Restaurar</button>
          <!--The seconde parameter defines the endpoint for the url-->
        </template>

      </modal-component>
      <!-- End modal to update deleted products-->

      <!-- Start modal to deleted permanently deleted products-->
      <modal-component id="modalDeletedlRemove" title="Eliminar permanentemente o Produto">
        <template v-slot:alerts>
          <alert-component tipe="danger" :details="$store.state.transaction.message"
            v-if="$store.state.transaction.status == 'error-update'"></alert-component>
        </template>
        <template v-slot:content>
          <h4>Tem a certeza que pertende eliminar este produto permanentemente?</h4>
        </template>

        <template v-slot:footer>
          <button class="button-save" @click="remove($store.state.item.id, 'produto')">Remover</button>
          <!--The seconde parameter defines the endpoint for the url-->
        </template>

      </modal-component>
      <!-- End modal to deleted permanently deleted products-->

    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      urlBase: 'http://127.0.0.1:8000/api/',
      categorys: { data: [] },
      ocasions: { data: [] },
      newCategory: '',
      updateCategory: '',
      newOcasion: '',
      newOcasionStatus: '',
      updateOcasion: '',
      updateOcasionStatus: '',
      active: false,
      statusTransition: '',
      detailsTransition: '',
      materiais: { data: [] },
      newMaterial: '',
      updateMaterial: '',
      products: { data: [] },
      deletedProducts: { data: [] }
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
      let urlCategory = this.urlBase + 'categoria';
      let urlMaterial = this.urlBase + 'materia';
      let ulrOcasion = this.urlBase + 'ocasiao';

      if (ulrOcasion) {
        axios.get(ulrOcasion)
          .then(response => {
            this.ocasions.data = response.data
          })
          .catch(errors => {
            console.log(errors);
          })
      }

      if (urlCategory) {
        axios.get(urlCategory)
          .then(response => {
            this.categorys.data = response.data
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

    deleted() {
      let urlProducts = this.urlBase + 'produto?deleted';

      axios.get(urlProducts)
        .then(response => {
          this.deletedProducts.data = response.data.all
          // console.log(response.data)
        })
        .catch(errors => {
          console.log(errors);
        })
    },

    save(c) { //saves the new values (category and material)
      let url = this.urlBase + c;

      let formData = new FormData();

      if (c == 'categoria') {
        formData.append('nome', this.newCategory);
      }

      if (c == 'ocasiao') {
        formData.append('nome', this.newOcasion);
        formData.append('estado', this.newOcasionStatus);
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
          this.$store.state.transaction.status = 'added'
          this.$store.state.transaction.message = response.data.msg
          alert(response.data.msg)
          this.loadTableData()
          history.back()

          this.newMaterial = ""
          this.newCategory = ""
          this.newOcasionStatus = ""
          this.newOcasion = ""
        })
        .catch(errors => {
          console.log(errors.response.data.message)
          this.$store.state.transaction.status = 'error-add'
          this.$store.state.transaction.message = errors.response.data.errors
          console.log(errors.response.data.errors)
          this.newMaterial = ""
          this.newCategory = ""
          this.newOcasionStatus = ""
          this.newOcasion = ""
        })


    },
    remove(r, n) { //removes the data (r = id and n = table to affect)

      if (this.products.data) {
        this.products.data.forEach(element => {
          if (element.categoria_id == r && n == 'categoria') {
            let url = this.urlBase + 'produto/' + element.id

            let formData = new FormData();
            formData.append('_method', 'patch')

            formData.append('categoria_id', 1);

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

          if (element.materia_prima_id == r && n == 'materia') {
            let url = this.urlBase + 'produto/' + element.id

            let formData = new FormData();
            formData.append('_method', 'patch')

            formData.append('materia_prima_id', 1);

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

          if (element.ocasioes_id == r && n == 'ocasiao') {
            let url = this.urlBase + 'produto/' + element.id

            let formData = new FormData();
            formData.append('_method', 'patch')

            formData.append('ocasioes_id', 1);

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
          this.deleted()
        })
        .catch(errors => {
          console.log(errors.response.data)
          this.$store.state.transaction.status = 'error-remove'
          this.$store.state.transaction.message = errors.response.data.message
        })

    },
    update(u, n) { //update either the category or material
      const input = document.getElementById('updateOcasionStatus')
      const inputValue = input.value

      let formData = new FormData();
      formData.append('_method', 'patch')


      if (n == 'ocasiao') {
        if (this.updateOcasion != '') {
          formData.append('nome', this.updateOcasion)
        }

        formData.append('estado', inputValue)
      }

      if (n == 'categoria' && this.updateCategory != '') {
        formData.append('nome', this.updateCategory)
      }

      if (n == 'materia') {
        formData.append('nome', this.updateMaterial)
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
          this.deleted()
          history.back()
          alert(response.data.msg)
          this.updateCategory = ""
          this.updateMaterial = ""
          this.updateOcasion = ""
          this.updateOcasionStatus = ""

        })
        .catch(errors => {
          console.log('erro de atualização', errors.response.data)
          this.$store.state.transaction.status = 'error-update'
          this.$store.state.transaction.message = errors.response.data.errors
          console.log(errors.response.data.errors)
          this.updateCategory = ""
        })
    },
  },
  mounted() {
    this.loadTableData()
    this.loadProducts()
    this.deleted()
  }
}
</script>