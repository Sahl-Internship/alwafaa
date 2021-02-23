<template>
  <q-layout view="lHh Lpr lFf">
    <the-header></the-header>

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
import TheHeader from 'src/UI/TheHeader.vue'

export default {
  name: 'MainLayout',
  components: {
    TheHeader
  },
  data () {
    return {
      leftDrawerOpen: false
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
