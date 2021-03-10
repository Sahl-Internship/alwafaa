<template>
  <q-page>
    <home-header></home-header>
    <home-cover></home-cover>
    <iqraa-academy-section class="q-mt-xl"></iqraa-academy-section>
    <home-carousel></home-carousel>
    <academy-info-section></academy-info-section>
    <home-signup-section></home-signup-section>
    <choose-course></choose-course>
    <completed-section></completed-section>

    <the-footer></the-footer>
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
  },
  data () {
    return {
      animatedBlock: false,
      isNext: false,
      slide: 1
    }
  },
  methods: {

  }
}
</script>

<style lang="scss" scoped>
</style>
