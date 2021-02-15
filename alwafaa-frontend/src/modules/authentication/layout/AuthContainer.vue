<template>
  <div class="q-pa-md">
    <!-- <div class="row justify-around"> -->
    <div class="row justify-between">
      <div class="col right-section">
        <!-- <div class="row justify-center"> -->
        <div class="row justify-center">
          <q-img
            alt="elearning-icon"
            src="~assets/About-Arabic-Quran-Tutor.jpg"
            class="fixed-bottom auth-page-img"
            :class="checkDirection ? 'flip-right' : ''"
          />
        </div>
      </div>
      <div class="col">
        <div class="row flex justify-start">
          <slot></slot>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  computed: {
    checkDirection() {
      return this.$q.lang.rtl;
    },
  },
};
</script>

<style lang="scss" scoped>
.auth-page-img {
  width: 45%;
  // margin-bottom: 50px;
}

// .flip-right {
//   transform: scaleX(-1);
//   filter: FlipH;
//   -ms-filter: "FlipH";
//   float: none;
// }

@media (max-width: 700px) {
  .right-section {
    display: none;
  }
}
</style>
