<template>
  <nav class="breadcrumb">
    <ul>
      <li v-for="(crumb, index) in breadcrumbs" :key="index">
        <p v-if="index === breadcrumbs.length -1 && index != 0 "> / </p>
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

      matchedRoutes.map(e =>{
        x = e.path.split('/')
      })

      let y = '/' + x[1] 

      let previous = []
      
      rots.forEach(route =>{
        if(route.path == y){
          previous.push( {
            label: route.name || route.meta.breadcrumb, 
            to: route.path
          })
        }
      })

      let matched = matchedRoutes.map((routeItem) => ({
        label: routeItem.meta.breadcrumb || routeItem.name,
        to: this.getRoutePath(route, routeItem),
      }));

      let breadcrumb = previous.concat(matched)

      breadcrumb = breadcrumb.filter((value, index, self) =>
        index === self.findIndex((t) => (
          t.label === value.label && t.to === value.to
        ))
      )

      return breadcrumb
    },
  },
  methods: {
    getRoutePath(route, routeItem) {
      const matchedSegments = route.matched.slice(0, route.matched.indexOf(routeItem) + 1);
      return matchedSegments.map((segment) => segment.path).join('/');
    },
  },
};
</script>