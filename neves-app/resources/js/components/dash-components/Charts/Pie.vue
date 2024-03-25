<template>
  <Pie
    id="my-chart-id"
    :options="chartOptions"
    :data="chartData"
  />
</template>

<script>
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js'
import { Pie } from 'vue-chartjs'

ChartJS.register(ArcElement, Tooltip, Legend)

export default {
  name: 'PieChart',
  components: { Pie },
  props:{
    chartData:{
      type: Object,
      required: true
    }
  },
  data() {
    return {
      chartData: {
        labels: this.chartData.name,
        datasets: [ { 
          backgroundColor: ['#41B883', '#E46651', '#00D8FF', '#DD1B16'],
          data: this.chartData.count
        } ]
      },
      chartOptions: {
        responsive: false
      }
    }
  },
  mounted(){
  }
}
</script>