<template>
  <div class="container">
    <h3>Titulo</h3>

    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Porro, atque temporibus aperiam, saepe, fugiat mollitia
      adipisci ab in dolorem placeat laborum tenetur suscipit repellendus corporis quia amet nesciunt earum excepturi?</p>

    <div>
      <h1>Outro titulo</h1>

      <p>
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quis dolorum quibusdam facilis debitis corrupti
        doloremque et sit eveniet maiores exercitationem, praesentium consequuntur dignissimos sunt iure ipsa quisquam
        fugiat expedita dolorem?
      </p>
    </div>

    <br>


  </div>
</template>

<script>
export default {
  props: ['login', 'create'],

  methods:{

    details(){
      let urlDetails = this.$store.state.Url + 'api/user_details';

      axios.get(urlDetails, {
        // headers: {
        //   // 'Authorization': 'Bearer ' + this.$store.state.token,
        // }
      })
        .then(response => {
          // this.userDetails.data = response.data
          console.log(response.data)
        })
        .catch(errors => {
          console.log(errors);
        })
    }
  },  

  mounted(){

    this.details()
  }

}
</script>