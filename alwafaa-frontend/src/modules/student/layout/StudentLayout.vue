<template>
  <q-layout view="hHh Lpr fFf">
    <!-- <Header></Header> -->

    <q-page-container>
      <router-view />
    </q-page-container>

    <Footer></Footer>
  </q-layout>
</template>

<script>
// import Header from 'src/modules/student/components/Header.vue'
import Footer from 'src/modules/student/components/Footer.vue'

export default {
  name: 'StudentLayout',
  components: { Footer }
}
</script>
