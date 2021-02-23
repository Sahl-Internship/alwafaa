<template>
  <q-layout
    view="hHh Lpr fFf"
    :class="{
      row: true,
      reverse: reverseRow,
      'justify-center': $q.screen.lt.sm
    }"
  >
    <div
      v-if="!$q.screen.lt.sm"
      class="col-xs-1 col-sm-3 col-md-5 login-section"
    >
    </div>

    <q-page-container class="col-xs-12 col-sm-9 col-md-7">
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
export default {
  name: 'AuthLayout',
  computed: {
    reverseRow () {
      const { name } = this.$route
      return name === 'login'
    }
  }
}
</script>

<style lang="scss" scoped>
.login-section {
  background-image: linear-gradient($primary, $green);
}
</style>
