<template>
  <base-card>
    <template #cardImg>
      <img src="~assets/course-img.jpg" />
    </template>

    <template #cardHeader>
      <div class="text-h6">Course Name</div>
      <div class="text-subtitle2">By Teacher</div>
    </template>

    <template #cardDescription> Deascription </template>

    <!-- <q-separator /> -->

    <template #cardAction>
      <q-btn flat color="primary">
        Register
        <q-btn flat round icon="add" />
      </q-btn>
    </template>
  </base-card>
</template>

<script>
import BaseCard from './UI/BaseCard.vue'

export default {
  name: 'CourseCard',
  components: { BaseCard }
}
</script>
