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

    Login : {{ login }}
    <br>
    Create: {{ create }}


  </div>
</template>

<script>
export default {
  props: ['login', 'create'],

  mounted (){
  }

}
</script>