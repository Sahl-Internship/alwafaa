<template>
  <q-layout view="lHh Lpr lFf">
    <the-header v-if="headerVisibility"></the-header>

    <q-drawer
      v-model="leftDrawerOpen"
      show-if-above
      bordered
      content-class="bg-grey-1"
      v-if="false"
    >
      <q-list>
        <q-item-label header class="text-grey-8">
          Essential Links
        </q-item-label>
      </q-list>
    </q-drawer>

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
