<template>
  <q-page>
    <home-carousel></home-carousel>

    <courses-section class="q-mt-xl"></courses-section>

    <!-- <div class="flex justify-center items-center register-section"> -->
    <div
      class="row justify-center items-center q-py-xl q-px-xl wrap register-section"
      :class="!$q.screen.lt.xl ? 'register-section-height' : ''"
    >
      <div class="col-3 column">
        <q-img
          src="~/assets/registerBlockImg.png"
          class="register-section-img self-end"
        />
      </div>
      <div
        :class="{
          'col-9': !$q.screen.lt.xl,
          'col-12': $q.screen.lt.xl,
        }"
      >
        <div
          class="row items-center wrap"
          :class="$q.screen.lt.md ? 'justify-center' : 'justify-start'"
        >
          <div
            class="column items-center"
            :class="$q.screen.lt.md ? 'col-12' : 'col-7'"
          >
            <div
              :class="{
                'text-h5': !$q.screen.lt.sm,
                'text-h6': $q.screen.lt.sm,
                'exp-text': true,
              }"
            >
              Gain More Experience
            </div>
            <div
              :class="{
                'text-h3': !$q.screen.lt.xl,
                'text-h4': $q.screen.lt.xl && !$q.screen.lt.sm,
                'text-h5': $q.screen.lt.sm,
                'ready-text': true,
              }"
            >
              Are you Ready?
            </div>
          </div>
          <q-btn
            type="button"
            label="Register"
            to="/signup"
            color="primary"
            class="col-2 self-center register-btn"
          />
        </div>
      </div>
    </div>

    <academy-info-section></academy-info-section>

    <academy-sections></academy-sections>

    <div class="register-as-instructor">
      <q-img src="../assets/instructor4.jpg" style="height: 100%">
        <div class="absolute-full column justify-center items-center">
          <div
            class="column register-text"
            :class="{
              'text-h3': !$q.screen.lt.xl,
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
import HomeCarousel from 'src/components/HomeCarousel.vue'
import CoursesSection from 'src/components/CoursesSection.vue'
import AcademySections from 'src/components/AcademySections.vue'
import AcademyInfoSection from 'src/components/AcademyInfoSection.vue'
import TheFooter from 'src/components/UI/TheFooter.vue'

export default {
  name: 'Home',
  components: {
    TheFooter,
    CoursesSection,
    AcademySections,
    AcademyInfoSection,
    HomeCarousel
  }
}
</script>

<style lang="scss" scoped>
.register-section {
  background-color: $green;
  &.register-section-height {
    height: 350px;
  }
  .register-section-img {
    min-height: 116px;
    min-width: 100px;
    max-width: 250px;
    max-height: 270px;
  }
  .ready-text {
    color: $secondary;
  }

  .exp-text {
    color: $grey-4;
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
