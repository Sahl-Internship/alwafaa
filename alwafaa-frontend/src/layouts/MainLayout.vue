<template>
  <q-layout view="lHh Lpr lFf">
    <the-header
      v-if="!checkHomeRoute"
      @ToggleSearchDialog="handleToggleSearch"
    ></the-header>

    <search-dialog
      v-if="searchMode"
      class="full-width absolute search-dialog"
      @closeDialog="handleToggleSearch"
    ></search-dialog>

    <q-page-container :class="searchMode ? 'dimmed' : ''">
      <router-view />
    </q-page-container>

    <q-dialog v-model="editMode" full-width>
      <setting-dialog></setting-dialog>
    </q-dialog>

    <the-footer></the-footer>
  </q-layout>
</template>

<script>
import TheHeader from '../components/layout/TheHeader'
import TheFooter from '../components/layout/TheFooter'
import SettingDialog from '../components/layout/SettingDialog'
import SearchDialog from '../components/layout/SearchDialog'

export default {
  name: 'MainLayout',
  components: {
    TheHeader,
    TheFooter,
    SettingDialog,
    SearchDialog
  },
  data () {
    return {
      searchMode: false
    }
  },
  computed: {
    checkHomeRoute () {
      return this.$route.path === '/' || this.$route.path === '/home'
    },
    editMode () {
      return this.$store.getters['student/checkEditMode']
    }
  },
  methods: {
    handleToggleSearch () {
      this.searchMode = !this.searchMode
    }
  }
}
</script>

<style lang="scss" scoped>
.search-dialog {
  z-index: 500;
  top:68px;
}
</style>
