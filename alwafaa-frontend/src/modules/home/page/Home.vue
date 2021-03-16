<template>
  <q-page>
    <home-header></home-header>
    <home-cover></home-cover>
    <iqraa-academy-section class="q-mt-xl"></iqraa-academy-section>
    <!-- <snake-carousel></snake-carousel> -->
    <home-carousel></home-carousel>
    <academy-info-section></academy-info-section>
    <home-signup-section></home-signup-section>
    <choose-course></choose-course>
    <completed-section></completed-section>

  </q-page>
</template>

<script>
import HomeHeader from '../components/HomeHeader.vue'
import HomeCover from 'src/modules/home/components/HomeCover.vue'
import HomeCarousel from 'src/modules/home/components/HomeCarousel.vue'
import IqraaAcademySection from 'src/modules/home/components/IqraaAcademySection.vue'
import HomeSignupSection from 'src/modules/home/components/HomeSignupSection.vue'
import AcademyInfoSection from 'src/modules/home/components/AcademyInfoSection.vue'
import ChooseCourse from 'src/modules/home/components/ChooseCourse.vue'
import CompletedSection from 'src/modules/home/components/CompletedSection.vue'
// import SnakeCarousel from '../components/SnakeCarousel.vue'

export default {
  name: 'Home',
  components: {
    HomeHeader,
    CompletedSection,
    ChooseCourse,
    IqraaAcademySection,
    HomeSignupSection,
    AcademyInfoSection,
    HomeCover,
    HomeCarousel
    // SnakeCarousel
  },
  data () {
    return {
      animatedBlock: false,
      isNext: false,
      slide: 1
    }
  },
  mounted () {
    this.$store.dispatch('home/getCourses')
  },
  methods: {

  }
}
</script>

<style lang="scss" scoped>
</style>
