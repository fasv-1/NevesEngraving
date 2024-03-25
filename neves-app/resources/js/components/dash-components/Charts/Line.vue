<template>
  <Line :data="data" :options="options" />
</template>

<script>
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend
} from 'chart.js'
import { Line } from 'vue-chartjs'

ChartJS.register(
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend
)

export default {
  name: 'App',
  components: {
    Line
  },
  props:{
    chartData:{
      type: Object,
      required: true
    },
    chartLabel:{
      type: String,
      required: true
    }
  },
  data() {
    return {
      data: {
        labels: this.chartData.months,
        datasets: [
          {
            label: this.chartLabel,
            backgroundColor: '#dc4151',
            data: this.chartData.count
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: true
      }
    }
  }
}
</script>
