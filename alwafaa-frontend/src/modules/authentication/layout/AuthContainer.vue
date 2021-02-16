<template>
  <div class="row justify-center items-center auth-container">
    <div
      class="col-6 column justify-center"
      :class="{
        'right-section': $q.screen.lt.sm,
      }"
    >
      <q-img
        alt="elearning-icon"
        src="~assets/auth-logo.png"
        class="self-center auth-page-img"
      />
    </div>

    <div class="col-xs-9 col-sm-6 col-md-6 col-lg-6">
      <div class="row flex justify-start">
        <slot></slot>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "AuthContainer",
};
</script>

<style lang="scss" scoped>
.auth-container {
  height: calc(100vh - 50px);
}

.auth-page-img {
  width: 40%;
}

.right-section {
  display: none;
}

// .flip-right {
//   transform: scaleX(-1);
//   filter: FlipH;
//   -ms-filter: "FlipH";
//   float: none;
// }

// @media (max-width: 700px) {
//   .right-section {
//     display: none;
//   }
// }
</style>
