<template>
  <Bar :options="chartOptions" :data="chartData" />
</template>

<script>
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

export default {
  name: 'BarChart',
  components: { Bar },
  props: {
    chartData: {
      type: Object,
      required: true,
    },
    chartLabel: {
      type: String,
      required: true,
    }
  },
  data() {
    return {
      chartData: {
        labels: this.chartData.name,
        datasets: [{
          label: this.chartLabel,
          backgroundColor: '#dc4151',
          data: this.chartData.count
        }]
      },
      chartOptions: {
        responsive: true
      }
    }
  }
}
</script>