<template>
  <div class="row justify-center">
    <div class="col-xs-12 col-sm-11 q-px-md row justify-between q-mt-xl q-mb-lg">
      <div class="col-6">
        <div
          class="text-h5 text-weight-bold text-grey-5"
          :class="{
            'text-h5': !$q.screen.lt.md,
            'text-h6': $q.screen.lt.md && !$q.screen.lt.sm,
            'text-subtitle1': $q.screen.lt.sm
          }"
        >{{ title }}</div>
      </div>

      <div
        class="col-6 row justify-end q-gutter-x-xs"
        :class="{
            'q-gutter-x-md': !$q.screen.lt.md,
            'q-gutter-x-sm': $q.screen.lt.md && !$q.screen.lt.sm,
            'q-gutter-x-xs': $q.screen.lt.sm
          }"
        >
        <q-btn
          rounded
          unelevated
          label="عرض الكل"
          color="blue-2"
          text-color="blue"
          :size="!$q.screen.lt.md ? '16px' : 'sm'"
          class="text-weight-bold"
          :class="{
            'q-px-lg': !$q.screen.lt.md,
            'q-px-sm': $q.screen.lt.md && !$q.screen.lt.sm
          }"
        />

        <q-btn
          round
          outline
          icon="mdi-chevron-right"
          text-color="grey-5"
          color="grey-1"
          :size="!$q.screen.lt.md ? '16px' : 'sm'"
          :disable="isFirstIndex"
          @click="showPrev"
        />

        <q-btn
          round
          outline
          icon="mdi-chevron-left"
          text-color="grey-5"
          color="grey-1"
          :size="!$q.screen.lt.md ? '16px' : 'sm'"
          :disable="isLastIndex"
          @click="showNext"
        />
      </div>
    </div>

    <div
      class="col-xs-12 col-sm-11 row"
      :class="{
        'q-gutter-x-lg': !$q.screen.lt.md,
        'q-gutter-x-sm': $q.screen.lt.md,
        'justify-center': $q.screen.lt.sm
      }"
    >
      <course-card
        v-for="course in shownCourses"
        :key="course.id"
        :course="course"
        class="course-card"
        :joined="joined"
      ></course-card>
    </div>

    <!-- <VueSlickCarousel
      v-if="allCourses.length"
      ref="carousel"
      v-bind="settings"
      class="col-xs-12 col-sm-11 q-mr-md"
      @beforeChange="checkCoursesLength"
    >
      <course-card
        v-for="course in allCourses"
        :key="course.id"
        :course="course"
        class="course-card"
        :joined="joined"
      ></course-card>
    </VueSlickCarousel> -->
  </div>
</template>

<script>
// import VueSlickCarousel from 'vue-slick-carousel'
import CourseCard from './CourseCard.vue'

export default {
  components: {
    // VueSlickCarousel,
    CourseCard
  },
  props: {
    // eslint-disable-next-line vue/require-valid-default-prop
    courses: { type: Array, required: true, default: [] },
    title: { type: String, required: true, default: '' },
    joined: { type: Boolean, required: false, default: false }
  },
  data () {
    return {
      settings: {
        arrows: false,
        focusOnSelect: true,
        infinite: false,
        speed: 500,
        slidesToShow: 3,
        slidesToScroll: 3,
        rtl: true,
        rows: 1,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3
            }
          },
          {
            breakpoint: 488,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
              initialSlide: 1
            }
          }
        ]
      },
      shownCourses: [],
      stopIndex: 0,
      isLastIndex: false,
      isFirstIndex: false
    }
  },
  computed: {
    // allCourses () {
    //   return this.courses.length ? this.courses : []
    // }
    // shownCourses () {
    //   return this.courses.slice(this.stopIndex, this.slidesToShow) || []
    // }
    slidesToShow () {
      return this.$q.screen.width <= 488 ? 2 : 3
    }
  },
  methods: {
    getShowCourses () {
      console.log(this.stopIndex)
      console.log(this.slidesToShow)
      console.log(this.$q.screen.width)
      this.shownCourses = this.courses.slice(this.stopIndex, this.stopIndex + this.slidesToShow)
    },
    showNext () {
      if (this.stopIndex + (this.slidesToShow * 2) >= this.courses.length) {
        this.isLastIndex = true
        this.isFirstIndex = false
      } else {
        this.isLastIndex = false
        this.isFirstIndex = false
      }

      this.stopIndex += this.slidesToShow
      this.getShowCourses()
      // this.$refs.carousel.next()
    },
    showPrev () {
      if (this.stopIndex === 0) {
        this.isFirstIndex = true
        this.isLastIndex = false
        return
      }
      if (this.stopIndex - this.slidesToShow === 0) {
        this.isFirstIndex = true
        this.isLastIndex = false
      } else {
        this.isFirstIndex = false
        this.isLastIndex = false
      }

      this.stopIndex -= this.slidesToShow
      this.getShowCourses()
      // this.$refs.carousel.prev()
    }
    // checkCoursesLength (oldSlideIndex, newSlideIndex) {
    //   console.log('old', oldSlideIndex)
    //   console.log('new', newSlideIndex)
    //   if (newSlideIndex === 0) {
    //     this.isLastIndex = true
    //     this.isFirstIndex = false
    //   } else if (newSlideIndex === this.allCourses.length - 1 || newSlideIndex === 2) {
    //     this.isFirstIndex = true
    //     this.isLastIndex = false
    //   } else {
    //     this.isLastIndex = false
    //     this.isFirstIndex = false
    //   }
    // }
  },
  watch: {
    courses (newVal) {
      if (newVal.length) {
        this.getShowCourses()
      }
    }
  }
}
</script>

<style lang="scss" scoped>
// .course-card {
//   max-width: 31.3%;
// }

// .slick-slider {
//   &::v-deep {
//     .slick-slide {
//       max-width: 23.3% !important;
//       // margin-left: 20px;  //1024 1280
//       // margin-left: 24px;  //lg 1300
//       // margin-left: 12px;  //md
//       // margin-left: 10px;  //sm
//       margin-left: 1.5%;
//     }
//   }
// }
</style>
