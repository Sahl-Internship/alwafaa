<template>
  <basic-card>
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
  </basic-card>
</template>

<script>
import BasicCard from "src/UI/BasicCard.vue";

export default {
  name: "CourseCard",
  components: { BasicCard },
};
</script>
