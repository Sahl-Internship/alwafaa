<template>
  <base-card>
    <template #cardImg>
      <img src="/images/course-img.jpg" />
    </template>

    <template #cardHeader>
      <div class="text-h6">Section Name</div>
    </template>

    <template #cardDescription> Deascription </template>

    <template #cardAction>
      <q-btn flat color="primary">Show Courses</q-btn>
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
