<template>
  <basic-section
    title="Sections"
    link="See All"
    class="q-pt-xs q-pb-xl academy-sections"
    :class="{
      'q-pt-xs': true,
      'q-pb-xl': !$q.screen.lt.xl,
      'academy-sections': true,
    }"
  >
    <template #sectionBody v-if="!$q.screen.lt.xl">
      <section-card class="col-2"></section-card>
      <section-card class="col-2"></section-card>
      <section-card class="col-2"></section-card>
      <section-card class="col-2"></section-card>
    </template>

    <template #sectionBody v-else-if="$q.screen.lt.xl && !$q.screen.lt.md">
      <q-carousel-slide :name="1" class="column no-wrap">
        <div class="row justify-around items-center no-wrap">
          <section-card
            :class="{
              'col-5': $q.screen.lt.lg,
              'col-4': !$q.screen.lt.lg,
            }"
          ></section-card>
          <section-card
            :class="{
              'col-5': $q.screen.lt.lg,
              'col-4': !$q.screen.lt.lg,
            }"
          ></section-card>
        </div>
      </q-carousel-slide>
      <q-carousel-slide :name="2" class="column no-wrap">
        <div class="row justify-around items-center no-wrap">
          <section-card
            :class="{
              'col-5': $q.screen.lt.lg,
              'col-4': !$q.screen.lt.lg,
            }"
          ></section-card>
          <section-card
            :class="{
              'col-5': $q.screen.lt.lg,
              'col-4': !$q.screen.lt.lg,
            }"
          ></section-card>
        </div>
      </q-carousel-slide>
    </template>

    <template #sectionBody class="mobile-only" v-else>
      <q-carousel-slide :name="1" class="column no-wrap">
        <div class="row justify-around items-center no-wrap">
          <section-card
            :class="{
              'col-12': $q.screen.lt.sm,
              'col-8': !$q.screen.lt.sm,
            }"
          ></section-card>
        </div>
      </q-carousel-slide>
      <q-carousel-slide :name="2" class="column no-wrap">
        <div class="row justify-around items-center no-wrap">
          <section-card
            :class="{
              'col-12': $q.screen.lt.sm,
              'col-8': !$q.screen.lt.sm,
            }"
          ></section-card>
        </div>
      </q-carousel-slide>
      <q-carousel-slide :name="3" class="column no-wrap">
        <div class="row justify-around items-center no-wrap">
          <section-card
            :class="{
              'col-12': $q.screen.lt.sm,
              'col-8': !$q.screen.lt.sm,
            }"
          ></section-card>
        </div>
      </q-carousel-slide>
      <q-carousel-slide :name="4" class="column no-wrap">
        <div class="row justify-around items-center no-wrap">
          <section-card
            :class="{
              'col-12': $q.screen.lt.sm,
              'col-8': !$q.screen.lt.sm,
            }"
          ></section-card>
        </div>
      </q-carousel-slide>
    </template>
  </basic-section>
</template>

<script>
import BasicSection from "src/UI/BasicSection.vue";
import SectionCard from "./SectionCard.vue";

export default {
  name: "CoursesSection",
  components: { BasicSection, SectionCard },
  mounted() {
    this.$q.screen.setSizes({
      sm: 380,
      md: 500,
      lg: 600,
      xl: 980,
    });
  },
};
</script>

<style lang="scss" scoped>
.academy-sections {
  background-color: $ground;
}
</style>
