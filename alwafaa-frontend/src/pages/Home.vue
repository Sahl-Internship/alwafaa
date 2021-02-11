<template>
  <q-page>
    <search-bar></search-bar>

    <home-section></home-section>
    <home-section></home-section>
  </q-page>
</template>

<script>
import SearchBar from 'src/UI/SearchBar.vue'
import HomeSection from 'src/UI/HomeSection.vue'

export default {
  name: 'Home',
  components: { SearchBar, HomeSection }
}
</script>

<style lang="scss" scoped>
</style>
