<template>
  <basic-card>
    <template #cardImg>
      <img src="~assets/course-img.jpg" />
    </template>

    <template #cardHeader>
      <div class="text-h6">Section Name</div>
    </template>

    <template #cardDescription> Deascription </template>

    <template #cardAction>
      <q-btn flat color="primary">Show Courses</q-btn>
    </template>
  </basic-card>
</template>

<script>
import BasicCard from "src/UI/BasicCard.vue";

export default {
  name: "CourseCard",
  components: { BasicCard },
};
</script>
