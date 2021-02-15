<template>
  <q-page>
    <home-carousel></home-carousel>

    <courses-section class="q-mt-xl"></courses-section>

    <div class="flex justify-center items-center register-section">
      <q-img
        src="~/assets/registerBlockImg.png"
        style="height: 220px; max-width: 200px"
      />
      <div class="q-mx-xl q-px-lg column items-center">
        <div class="text-h5">Gain More Experience</div>
        <div class="text-h3 ready-text">Are you Ready?</div>
      </div>
      <q-btn
        type="button"
        label="Register"
        to="/signup"
        color="secondary"
        class="register-btn"
      />
    </div>

    <academy-info-section></academy-info-section>

    <academy-sections></academy-sections>

    <div class="register-as-instructor">
      <q-img src="../assets/instructor4.jpg" style="height: 100%">
        <div class="absolute-full column justify-center items-center">
          <div
            class="column register-text"
            :class="{
              'text-h3': !$q.screen.gt.xl,
              'text-h4': $q.screen.lt.xl && !$q.screen.lt.sm,
              'text-h5': $q.screen.lt.sm,
            }"
          >
            Register As Instructor
          </div>
          <q-btn
            type="button"
            label="Register"
            to="/signup"
            color="primary"
            class="column register-btn q-mt-lg"
          />
        </div>
      </q-img>
    </div>

    <the-footer></the-footer>
  </q-page>
</template>

<script>
import HomeCarousel from "src/components/HomeCarousel.vue";
import CoursesSection from "src/components/CoursesSection.vue";
import AcademySections from "src/components/AcademySections.vue";
import AcademyInfoSection from "src/components/AcademyInfoSection.vue";
import TheFooter from "src/UI/TheFooter.vue";

export default {
  name: "Home",
  components: {
    TheFooter,
    CoursesSection,
    AcademySections,
    AcademyInfoSection,
    HomeCarousel,
  },
};
</script>

<style lang="scss" scoped>
.register-section {
  background-color: $orange-1;
  height: 350px;
  .ready-text {
    color: $secondary;
  }
}

.register-btn {
  height: 50px;
  width: 130px;
  font-size: 20px;
}

.register-as-instructor {
  height: 350px;
  // background-image: url("../assets/instructor3.jpg");
  // background-size: cover;
  // background-repeat: no-repeat;
  opacity: 0.8;
}
</style>
