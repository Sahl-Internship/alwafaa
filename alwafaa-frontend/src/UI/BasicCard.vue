<template>
  <q-card class="basic-card">
    <img src="https://cdn.quasar.dev/img/mountains.jpg">

    <q-card-section>
      <div class="text-h6">Course Name</div>
      <div class="text-subtitle2">By Teacher</div>
    </q-card-section>

    <q-card-section class="q-pt-none">
      Deascription
    </q-card-section>

    <q-separator />

    <q-card-actions class="q-pa-none justify-center">
      <q-btn flat color="secondary">
        Register
        <q-btn flat round icon="add" />
      </q-btn>
    </q-card-actions>
  </q-card>
</template>

<script>
export default {
  name: 'BasicCard'
}
</script>

<style lang="scss" scoped>
  // .basic-card {
  //   width: 200px
  // }
</style>
