<template>
  <!-- Users Page  -->
  <div class="title-cont">
    <h1 class="titulo">Utilizadores</h1>
    <!-- <h4 class="titulo_alt">Descontos</h4> -->
  </div>

  <!------------------------ Charts info-users --------------------------------->
  <div class="container2">
    <div v-if='timout == true' class="responsive-container">
      <div class="chart-cont">
        <div class="cont-header">
          <h3 class="title">Utilizadores registados</h3>
        </div>
        <!-- Start chart to show the user By month-->
        <div class="chart">
          <line-component chartLabel="Utilizadores registados" :chartData="usersByMonth"></line-component>
        </div>
      </div>

      <div class="chart-cont">
        <div class="cont-header">
          <h3 class="title">Top produtos desejados por utilizadores</h3>
        </div>
        <!-- Start chart for top product  added to wish-list -->
        <div class="chart">
          <bar-component chartLabel="Top produtos" :chartData="favoritesData"></bar-component>
        </div>
      </div>
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
      favoriteData: {
        name: [],
        count: [],
      },
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
  },
  computed: {
    favoritesData() {
      let products = {}
      this.userFavorites.data.forEach(e => {
        products[e.produto.meta_nome] = (products[e.produto.meta_nome] || 0) + 1
      })

      let productsName = Object.keys(products)
      let productsCount = Object.values(products)

      return { 'name': productsName, 'count': productsCount }
    },
    usersByMonth() {
      let date = []
      let months = []
      let monthNames = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"]
      let userMonth = []
      this.usersData.data.forEach(d => {
        date.push(new Date(d.created_at))
      })

      date.forEach(m => {
        months[(m.getMonth())] = (months[(m.getMonth())] || 0) + 1
      })

      userMonth = Object.keys(months)
      let userCount = Object.values(months)
      let userMontNames = []

      userMonth.forEach(e => {
        userMontNames.push(monthNames[e])
      })

      return { 'months': userMontNames, 'count': userCount }
    }
  },
  mounted() {
    this.loadData()
    this.timeOut()
  }
}
</script>