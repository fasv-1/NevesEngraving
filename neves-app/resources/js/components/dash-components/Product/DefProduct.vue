<template>
  <!--Contains all the components for the diferent menus -->
  <div class="productInputContent">

    <h3 class="titulo_1">Categorias</h3>
    <br>
    <div class="table">
      <table>
        <thead>
          <tr>
            <th>Categoria</th>
            <th class="feel"></th>
            <th>Data de criação</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="c in categorias" :key="c.id">
            <td>{{ c.nome }}</td>
            <td class="feel"></td>
            <td>{{ formatData(c.created_at) }}</td>
            <td class="feel"></td>
            <td><a href="" @click.prevent="openModal(c.id)">Atualizar</a></td>
            <modal-component id="newCategory" title="Atualizar Categoria" :openModal="active">
              <template v-slot:header>
                <button type="button" class="btn-modal-close" aria-label="Close" @click="openModal()">X</button>
              </template>
              <template v-slot:alerts>
                <alert-component tipe="success" :details="detailsTransition"
                  v-if="statusTransition == 'adicionado'"></alert-component>
                <alert-component tipe="danger" :details="detailsTransition"
                  v-if="statusTransition == 'erro'"></alert-component>
              </template>
              <template v-slot:content>
                <input type="text" id="newCategory" name="newCategory" class="form-text" aria-describedby="newCategory"
                  placeholder="Nome da categoria" v-model="updateCategory">
              </template>
              <template v-slot:footer>
                <button type="button" class="button-save" @click="update(updateId)">Salvar</button>
              </template>
            </modal-component>
            <td><a href="" @click.prevent="remove(c.id)">Eliminar</a></td>

          </tr>
        </tbody>
      </table>
    </div>
    <div class="content_1">
      <input-container id="newCategory" titulo='Nova Categoria' help="categoryHelp" helpText="Insira o nome da categoria">
        <alert-component tipe="success" :details="detailsTransition"
          v-if="statusTransition == 'adicionado'"></alert-component>
        <alert-component tipe="danger" :details="detailsTransition" v-if="statusTransition == 'erro'"></alert-component>
        <input type="text" id="newCategory" name="newCategory" class="form-text" aria-describedby="newCategory"
          placeholder="Nome da Categoria" v-model="newCategory">
      </input-container>
      <button class="button-save" @click="saveCategory()">Adicionar</button>
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
    }
  },
  methods: {
    openModal(id) {
      this.active = !this.active;

      if (id) {
        this.updateId = id;
      }
    },
    loadCategory() {
      let urlCategory = this.urlBase + 'categoria';

      axios.get(urlCategory)
        .then(response => {
          this.categorias = response.data
        })
        .catch(errors => {
          console.log(errors);
        })
    },
    formatData(d) {
      d = d.split('T')
      d = d[0]
      return d;
    },
    saveCategory() {
      let urlCategory = this.urlBase + 'categoria';

      let formData = new FormData();
      formData.append('nome', this.newCategory);

      let config = {
        headers: {
          'Content-Type': 'x-www-form-urlencoded',
          'Accept': 'application/json'
        }
      }
      axios.post(urlCategory, formData, config)
        .then((response) => {
          this.statusTransition = 'adicionado'
          this.detailsTransition = {
            message: 'A categoria ' + response.data.nome + ' foi adicionada com sucesso'
          }

          this.loadCategory()
        })
        .catch(errors => {
          this.statusTransition = 'erro'
          this.detailsTransition = {
            message: errors.response.data.message
          }
          // console.log(errors.response.data.message)
        })


    },
    remove(r) {
      let confirmacao = confirm('Tem a certeza que deseja remover este registo?')
      if (!confirmacao) {
        return false
      }
      let url = this.urlBase + 'categoria/' + r
      console.log(url)

      let formData = new FormData();
      formData.append('_method', 'delete')



      axios.post(url, formData)
        .then(response => {
          console.log('Registo removido com sucesso', response)
          this.statusTransition = 'adicionado'
          this.detailsTransition = {
            message: 'A categoria ' + response.data.nome + ' foi removido com sucesso'
          }
          this.loadCategory()
        })
        .catch(errors => {
          console.log('Houve um erro na tentativa de remoção do registo', errors.response)
          this.statusTransition = 'erro'
          this.detailsTransition = {
            message: errors.response.data.message
          }
        })

    },
    update(u) {
      let formData = new FormData();
      formData.append('_method', 'patch')
      formData.append('nome', this.updateCategory)

      let url = this.urlBase + 'categoria/' + u

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
          this.loadCategory()
          this.openModal()
          this.updateCategory = "";
        })
        .catch(errors => {
          console.log('erro de atualização', errors.response)
        })
    }
  },
  mounted() {
    this.loadCategory()
  }
}
</script>