<template>
  <q-layout view="lHh Lpr lFf">
     <the-header v-if="!checkHomeRoute"></the-header>

    <q-page-container>
      <router-view />
    </q-page-container>

    <the-footer></the-footer>
  </q-layout>
</template>

<script>
import TheHeader from '../components/UI/TheHeader'
import TheFooter from '../components/UI/TheFooter'

export default {
  name: 'MainLayout',
  components: {
    TheHeader,
    TheFooter
  },
  data () {
    return {
      leftDrawerOpen: false
    }
  },
  computed: {
    headerVisibility () {
      const { name } = this.$route
      return !(name === 'signup' || name === 'login')
    },
    checkHomeRoute () {
      return this.$route.path === '/' || this.$route.path === '/home'
    }
  }
}
</script>

<style lang="scss" scoped>
.main-layout {
  height: 100% !important;
  padding: 0;
  margin: 0;
}

</style>
