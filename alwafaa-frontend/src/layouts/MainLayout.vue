<template>
  <q-layout view="lHh Lpr lFf">
    <the-header  v-if="headerVisibility" color='primary'>
    </the-header>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import TheHeader from 'src/components/UI/TheHeader.vue'

export default {
  name: 'MainLayout',
  components: {
    TheHeader
  },
  data () {
    return {

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
