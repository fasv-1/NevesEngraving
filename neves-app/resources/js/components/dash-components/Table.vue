<template>
  <!--Dynamic table-->
  <div class="table-container">
    <div class="table">
      <table>
        <thead>
          <tr>
            <th scope="col" v-for='t, index in titles' :key="index">{{ t.title }}</th>
            <th v-if=" view.visible || update.visible || remove.visible "></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="obj, index in FiltredData" :key="index">

            <!--Return the value of the table correspondent to the title and separates the data type to treatmant -->
            <td v-for="value, indexValue in obj" :key="indexValue"> 
              <span v-if="titles[indexValue].type == 'text'">{{ value }}</span>
              <span v-if="titles[indexValue].type == 'date'"> {{ $filters.formatDateTime(value) }}</span>
              <span v-if="titles[indexValue].type == 'image'">
              <img :src="'/storage/'+value" alt="imagem">
              </span>
            </td>
            <td v-if=" view.visible || update || remove ">
              <a :href="view.dataTarget"><button class="" v-if="view.visible" @click="setState(obj)">Visualizar</button></a>
              <a :href="update.dataTarget"><button class="" v-if="update.visible" @click="setState(obj)">Atualizar</button></a>
              <a :href="remove.dataTarget"><button class="" v-if="remove.visible" @click="setState(obj)">Remover</button></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  props: ['data', 'titles', 'view', 'update', 'remove'],
  methods:{
    setState(obj){ //store the object cliked in a vuex global variable
      this.$store.state.item = obj;
      this.$store.state.transaction = {};
    }
  },
  computed: {
    FiltredData() { //filter the data recived to match with the titles information (dynamic table)

      let fields = Object.keys(this.titles) // return an object of title keys
      let FiltredData = []

      this.data.map((item, chave) => { //return the data items separated from the array and respective keys

        let filtredItem = {}

        fields.forEach(field => { // loops the array of title key 
          filtredItem[field] = item[field] // create a new object with eatch key title corresponding with the matching field in the item 
        })

        FiltredData.push(filtredItem) // push the objects in a array
      })

      return FiltredData
    }
  },
  data() {
    return {

    }
  }
}
</script>