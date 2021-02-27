<template>
  <base-section
    title="Courses"
    link="See All"
    :class="{
      'q-pt-xs': true,
      'q-pb-xl': !$q.screen.lt.xl,
      'courses-sections': true,
    }"
  >
    <template #sectionBody v-if="!$q.screen.lt.xl">
      <course-card class="col-2"></course-card>
      <course-card class="col-2"></course-card>
      <course-card class="col-2"></course-card>
      <course-card class="col-2"></course-card>
    </template>

    <template #sectionBody v-else-if="$q.screen.lt.xl && !$q.screen.lt.md">
      <q-carousel-slide :name="1" class="column no-wrap">
        <div class="row justify-around items-center no-wrap">
          <course-card
            :class="{
              'col-5': $q.screen.lt.lg,
              'col-4': !$q.screen.lt.lg,
            }"
          ></course-card>
          <course-card
            :class="{
              'col-5': $q.screen.lt.lg,
              'col-4': !$q.screen.lt.lg,
            }"
          ></course-card>
        </div>
      </q-carousel-slide>
      <q-carousel-slide :name="2" class="column no-wrap">
        <div class="row justify-around items-center no-wrap">
          <course-card
            :class="{
              'col-5': $q.screen.lt.lg,
              'col-4': !$q.screen.lt.lg,
            }"
          ></course-card>
          <course-card
            :class="{
              'col-5': $q.screen.lt.lg,
              'col-4': !$q.screen.lt.lg,
            }"
          ></course-card>
        </div>
      </q-carousel-slide>
    </template>

    <template #sectionBody class="mobile-only" v-else>
      <q-carousel-slide :name="1" class="column no-wrap">
        <div class="row justify-around items-center no-wrap">
          <course-card
            :class="{
              'col-12': $q.screen.lt.sm,
              'col-8': !$q.screen.lt.sm,
            }"
          ></course-card>
        </div>
      </q-carousel-slide>
      <q-carousel-slide :name="2" class="column no-wrap">
        <div class="row justify-around items-center no-wrap">
          <course-card
            :class="{
              'col-12': $q.screen.lt.sm,
              'col-8': !$q.screen.lt.sm,
            }"
          ></course-card>
        </div>
      </q-carousel-slide>
      <q-carousel-slide :name="3" class="column no-wrap">
        <div class="row justify-around items-center no-wrap">
          <course-card
            :class="{
              'col-12': $q.screen.lt.sm,
              'col-8': !$q.screen.lt.sm,
            }"
          ></course-card>
        </div>
      </q-carousel-slide>
      <q-carousel-slide :name="4" class="column no-wrap">
        <div class="row justify-around items-center no-wrap">
          <course-card
            :class="{
              'col-12': $q.screen.lt.sm,
              'col-8': !$q.screen.lt.sm,
            }"
          ></course-card>
        </div>
      </q-carousel-slide>
    </template>
  </base-section>
</template>

<script>
import BaseSection from './UI/BaseSection.vue'
import CourseCard from './CourseCard.vue'

export default {
  name: 'CoursesSection',
  components: { BaseSection, CourseCard },
  mounted () {
    this.$q.screen.setSizes({
      sm: 380,
      md: 500,
      lg: 600,
      xl: 980
    })
  }
}
</script>

<style lang="scss" scoped>
.courses-sections {
  background-color: $grey-1;
  margin-top: 80px;
}
</style>
