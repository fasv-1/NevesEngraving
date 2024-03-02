<template>
  <nav class="breadcrumb">
    <ul>
      <li v-for="(crumb, index) in breadcrumbs" :key="index">
        <p v-if="index != 0 "> / </p>
        <router-link :to="crumb.to">{{ crumb.label }}</router-link>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  computed: {
    breadcrumbs() {
      const route = this.$route;
      const matchedRoutes = route.matched;

      const rt = this.$router
      const rots = rt.options.routes

      let x = []

      matchedRoutes.map(e => {
        x = e.path.split('/')
      })


      let previous = []

      x.forEach(e => {
        rots.forEach(rot => {
          if (rot.meta) {
            if (e == rot.meta.breadcrumb) {
              previous.push({
                label: rot.name,
                to: rot.path
              })
            }
          }
        })
      })

      return previous
    },
  },
};
</script>