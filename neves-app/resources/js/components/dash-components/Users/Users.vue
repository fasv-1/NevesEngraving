<template>
  <!-- Users Page  -->
  <div class="title-cont">
    <h1 class="titulo">Usuários</h1>
    <!-- <h4 class="titulo_alt">Descontos</h4> -->
  </div>
  <div class="productInputContent">

    <!------------------------ DISCOUNT AREA --------------------------------->
    <div class="container2">
      <div class="cont-header">
        <h3 class="titulo_1">Todos os usuários</h3>
      </div>
      <!-- Start table to show the discount-->
      <table-component :data="usersData.data" :view="{ visible: false, dataTarget: '#modalUsersView' }"
        :update="{ visible: true, dataTarget: '#modalUserUpdate' }"
        :remove="{ visible: true, dataTarget: '#modalUsersRemove' }" :titles="{
          id: { title: 'ID', type: 'text' },
          name: { title: 'Nome', type: 'text' },
          email: { title: 'Email', type: 'text' },
          roles: { title: 'Estatuto', type: 'data' },
          created_at: { title: 'Data de criação', type: 'date' },
        }">
      </table-component>
      <!-- End table to show the discount-->

      <!-- Start modal to remove discount-->
      <modal-component id="modalUsersRemove" title="Remover Usuário">

        <template v-slot:alerts>
          <alert-component tipe="danger" :details="$store.state.transaction"
            v-if="$store.state.transaction.status == 'error-remove'"></alert-component>
        </template>
        <template v-slot:content>
          <input-container id="removeDiscount" title="Tem a certeza que pretende remover este usuário?" help="removeUser" helpText="Ao eliminar este user, ira também eliminar todos os seus dados">
            <input type="text" name="removeDiscount" aria-describedby="removeDiscount" :value="$store.state.item.email"
              disabled>
          </input-container>
        </template>

        <template v-slot:footer>
          <button class="button-save" @click="remove($store.state.item.id)">Remover</button>
          <!--The seconde parameter defines the endpoint for the url-->
        </template>
      </modal-component>
      <!-- End modal to remove discount-->

      <!-- Start modal to update discount-->
      <modal-component id="modalUserUpdate" title="Atualizar Estatuto">
        <template v-slot:alerts>
          <alert-component tipe="danger" :details="$store.state.transaction.message"
            v-if="$store.state.transaction.status == 'error-update'"></alert-component>
        </template>
        <template v-slot:content>
          <input-container id="updateEstatuto" title="Estatuto" help="updateEstatuto"
            helpText="Escolha um novo estatuto">
            <select name="role" id="role" v-model="newRole">
              <option value="" disabled>Selecione um estatuto</option>
              <option v-for="role in rolestoshow" :value="role">{{role}}</option>
            </select>
          </input-container>
        </template>

        <template v-slot:footer>
          <button class="button-save" @click="update($store.state.item.id, $store.state.item.roles)">Atualizar</button>
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
      usersData: { data: [] },
      rolesData: { data: [] },
      userReviews: { data: [] },
      userFavorites: { data: [] },
      newRole:''
    }
  },
  methods: {
    loadData() {
      let urlUsers = this.$store.state.Url + 'api/user';
      let urlFavorites = this.$store.state.Url + 'api/user_favorites';
      let urlReviews = this.$store.state.Url + 'api/user_reviews';
      let urlRoles = this.$store.state.Url + 'api/roles';

      axios.get(urlUsers)
        .then(response => {
          this.usersData.data = response.data.users
          // console.log(response.data)
        })
        .catch(errors => {
          console.log(errors);
        })

      axios.get(urlFavorites)
        .then(response => {
          this.userFavorites.data = response.data.favorites
          // console.log(response.data)
        })
        .catch(errors => {
          console.log(errors);
        })

      axios.get(urlReviews)
        .then(response => {
          this.userReviews.data = response.data.review
          // console.log(response.data)
        })
        .catch(errors => {
          console.log(errors);
        })

      axios.get(urlRoles)
        .then(response => {
          this.rolesData.data = response.data
          // console.log(response.data)
        })
        .catch(errors => {
          console.log(errors);
        })
    },
    remove(r) { //removes user
      let urlUsers = this.$store.state.Url + 'api/user/' + r;
      let urlFavorites = this.$store.state.Url + 'api/user_favorites';

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
    update(u, r) { //update role
      let formData = new FormData();

      formData.append('_method', 'patch')
      
      formData.append('role', this.newRole)
      formData.append('role_delete', r[0].name)

      // console.log(r[0].name)

      let urlUsers = this.$store.state.Url + 'api/user/' + u

      // console.log(urlUsers)

      let config = {
        headers: {
          'Content-Type': 'x-www-form-urlencoded',
          'Accept': 'application/json'
        }
      }

      axios.post(urlUsers, formData, config)
        .then(response => {
          this.$store.state.transaction.status = 'updated'
          this.$store.state.transaction.message = response.data.msg
          this.loadData()
          history.back()
          alert(response.data.msg)
          this.newRole = ""

        })
        .catch(errors => {
          console.log('erro de atualização', errors.response.data)
          this.$store.state.transaction.status = 'error-update'
          this.$store.state.transaction.message = errors.response.data
          this.newRole = ""
        })
    },
  },
  computed:{
    rolestoshow(){
      let roles = []
      this.rolesData.data.forEach(e=>{
        if(e.name != 'Dev' && e.name != 'Super-Admin'){
          roles.push(e.name)
        }
      })
      return roles
    }
  },
  mounted() {
    this.loadData()
    // this.loadProducts()
  }
}
</script>