<template>
  <q-layout view="lHh Lpr lFf">

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
// import TheHeader from 'src/modules/home/components/TheHeader.vue'

export default {
  name: 'MainLayout',
  components: {
    // TheHeader
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
