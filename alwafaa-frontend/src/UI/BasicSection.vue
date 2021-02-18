<template>
  <div class="section-container">
    <div class="row q-px-xl q-my-lg" v-if="title">
      <div
        class="col q-my-none section-title"
        :class="!$q.screen.lt.md ? 'text-h4' : 'text-h5'"
      >
        {{ title }}
      </div>
      <div class="column items-end">
        <q-btn dense flat color="primary" :label="link" />
      </div>
    </div>

    <div class="row justify-around items-center" v-if="!$q.screen.lt.xl">
      <slot name="sectionBody"></slot>
    </div>

    <div class="row justify-around items-center" v-else>
      <q-carousel
        v-model="slide"
        transition-prev="slide-right"
        transition-next="slide-left"
        swipeable
        animated
        control-color="green"
        navigation
        padding
        arrows
        class="bg-grey-2 shadow-2 rounded-borders"
      >
        <slot name="sectionBody"></slot>
      </q-carousel>
    </div>
  </div>
</template>

<script>
export default {
  name: "HomeSection",
  props: ["title", "link", "info"],
  data() {
    return {
      slide: 1,
    };
  },
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
.section-container {
  .section-title {
    color: $secondary;
  }
}
</style>
