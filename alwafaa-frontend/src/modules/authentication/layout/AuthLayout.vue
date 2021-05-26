<template>
  <q-layout
    view="hHh Lpr fFf"
    :class="{
      row: true,
      reverse: reverseRow,
      'justify-center': $q.screen.lt.sm
    }"
  >
    <auth-second-section v-if="!$q.screen.lt.sm"></auth-second-section>

    <q-page-container class="col-xs-12 col-sm-9 col-md-7 column justify-start">
      <auth-header class="align-start"></auth-header>

      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import AuthSecondSection from '../components/AuthSecondSection.vue'
import AuthHeader from '../components/AuthHeader.vue'

export default {
  name: 'AuthLayout',
  components: { AuthSecondSection, AuthHeader },
  computed: {
    reverseRow () {
      const { name } = this.$route
      return name !== 'signup'
    }
  }
}
</script>
