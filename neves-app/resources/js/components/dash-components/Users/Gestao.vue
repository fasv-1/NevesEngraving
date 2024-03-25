<template>
  <!-- Manage Users Page  -->
  <div class="title-cont">
    <h1 class="titulo">Gestão</h1>
  </div>
  <div class="productInputContent">

    <!------------------------ DISCOUNT AREA --------------------------------->
    <div class="container2">
      <div class="cont-header">
        <h3 class="titulo_1">Gerir utilizadores</h3>
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
      <modal-component id="modalUsersRemove" title="Remover utilizador">

        <template v-slot:alerts>
          <alert-component tipe="danger" :details="$store.state.transaction"
            v-if="$store.state.transaction.status == 'error-remove'"></alert-component>
        </template>
        <template v-slot:content>
          <div>
            <h4>{{ $store.state.item.name }}</h4>
            <br>
            <h4>{{ $store.state.item.email }}</h4>
            <br>
          </div>
          <p class="form-help">Ao remover este utilizador irá remover também toda a informação adicional pertencente a ele.
          </p>
        </template>

        <template v-slot:footer>
          <button class="button-save" @click="remove($store.state.item.id)">Remover</button>
          <!--The seconde parameter defines the endpoint for the url-->
        </template>
      </modal-component>
      <!-- End modal to remove discount-->

      <!-- Start modal to update discount-->
      <modal-component id="modalUserUpdate" title="Atualizar estatuto">
        <template v-slot:alerts>
          <alert-component tipe="danger" :details="$store.state.transaction.message"
            v-if="$store.state.transaction.status == 'error-update'"></alert-component>
        </template>
        <template v-slot:content>
          <input-container id="updateEstatuto" title="Estatuto" help="updateEstatuto"
            helpText="Escolha um novo estatuto">
            <select name="role" id="role" v-model="newRole">
              <option value="" disabled>Selecione um estatuto</option>
              <option v-for="role in rolestoshow" :value="role">{{ role }}</option>
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
      userDetails: { data: [] },
      newRole: '',
      timout: false
    }
  },
  methods: {
    timeOut() {
      setTimeout(() => {
        this.timout = true;
      }, 500);
    },
    loadData() {
      let urlUsers = this.$store.state.Url + 'api/user';
      let urlFavorites = this.$store.state.Url + 'api/user_favorites';
      let urlReviews = this.$store.state.Url + 'api/user_reviews';
      let urlRoles = this.$store.state.Url + 'api/roles';
      let urlDetails = this.$store.state.Url + 'api/user_details';

      axios.get(urlDetails, {
        headers: {
          'Authorization': 'Bearer ' + this.$store.state.token,
        }
      })
        .then(response => {
          this.userDetails.data = response.data.details
          // console.log(response.data)
        })
        .catch(errors => {
          console.log(errors);
        })

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
      let urlUsers = this.$store.state.Url + 'api/user/' + r

      let formData = new FormData();
      formData.append('_method', 'delete')

      let config = {
        headers: {
          'Content-Type': 'x-www-form-urlencoded',
          'Accept': 'application/json',
          'Authorization': 'Bearer ' + this.$store.state.token,
        }
      }

      this.userFavorites.data.forEach(f => {
        if (f.user_id == r) {
          let urlFavorites = this.$store.state.Url + 'api/user_favorites/' + f.id

          axios.post(urlFavorites, formData)
            .then(response => {
              this.$store.state.transaction.status = 'removed'
              this.$store.state.transaction.message = response.data.msg
              // alert(response.data.msg)
            })
            .catch(errors => {
              console.log(errors.response.data)
              this.$store.state.transaction.status = 'error-remove'
              this.$store.state.transaction.message = errors.response.data.message
            })
        }
      })

      this.userReviews.data.forEach(re => {
        if (re.user_id == r) {
          let urlReviews = this.$store.state.Url + 'api/user_favorites/' + re.id

          axios.post(urlReviews, formData)
            .then(response => {
              this.$store.state.transaction.status = 'removed'
              this.$store.state.transaction.message = response.data.msg
              // alert(response.data.msg)
            })
            .catch(errors => {
              console.log(errors.response.data)
              this.$store.state.transaction.status = 'error-remove'
              this.$store.state.transaction.message = errors.response.data.message
            })
        }
      })

      this.userDetails.data.forEach(d => {
        if (d.user_id == r) {
          let urlDetails = this.$store.state.Url + 'api/user_details/' + d.id

          axios.post(urlDetails, formData, config)
            .then(response => {
              this.$store.state.transaction.status = 'removed'
              this.$store.state.transaction.message = response.data.msg
              // alert(response.data.msg)
            })
            .catch(errors => {
              console.log(errors.response.data)
              this.$store.state.transaction.status = 'error-remove'
              this.$store.state.transaction.message = errors.response.data.message
            })
        }
      })

      axios.post(urlUsers, formData)
        .then(response => {
          this.$store.state.transaction.status = 'removed'
          this.$store.state.transaction.message = response.data.msg
          alert(response.data.msg)
          this.loadData()
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
  computed: {
    rolestoshow() {
      let roles = []
      this.rolesData.data.forEach(e => {
        if (e.name != 'Dev' && e.name != 'Super-Admin') {
          roles.push(e.name)
        }
      })
      return roles
    },
  },
  mounted() {
    this.loadData()
    this.timeOut()
  }
}
</script>