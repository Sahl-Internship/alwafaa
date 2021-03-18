<template>
  <div
    class="register-section"
    :class="!$q.screen.lt.xl ? 'register-section-height' : ''"
  >
    <div class="row q-mx-xl">
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-h6 highest-rate">{{$t('carousel.highestRating')}} </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-right arrow">
        <q-btn
          rounded
          unelevated
          :label="$t('carousel.showAll')"
          color='blue-2'
          text-color='primary'
        />
        <q-btn
          unelevated
          outline round
          :dense='dense'
          text-color='dark'
          @click="prevTwo"
          class="q-mx-md"
        >
        <i :class="left"></i>
        </q-btn>
        <q-btn
          unelevated
          outline round
          :dense='dense'
          text-color='dark'
          @click="nextTwo"
        >
          <i :class="right"></i>
        </q-btn>
      </div>
    </div>
    <div
      class="slider-container"
    >
      <div
        class="slider"
      >
        <slick
          ref="slick"
          :options="slickOptions"
          class="slick q-ml-xl"
        >
          <course-card
            v-for="course in courses"
            :key="course.id"
            :course="course"
            class="card"
          >
          </course-card>
        </slick>
      </div>
    </div>
  </div>
</template>
<script>
import Slick from 'vue-slick'
import CourseCard from 'src/modules/courses/components/CourseCard.vue'
// import { axios } from 'src/boot/axios'
export default {
  components: { Slick, CourseCard },
  name: 'HomeCourses',
  data () {
    return {
      dense: true,
      rating: 0,
      slide: 0,
      results: [],
      slickOptions: {
        slidesToShow: 3.1,
        arrows: false,
        mobileFirst: true,
        infinite: false,
        initialSlide: 0,
        rtl: true,
        responsive: [
          {
            breakpoint: 1200,
            settings: {
              slidesToShow: 3.1,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 992,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1,
              centerPadding: '0px'
            }
          },
          {
            breakpoint: 767,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
              centerPadding: '23px'
            }
          },
          {
            breakpoint: 650,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
              centerPadding: '25px'
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              centerPadding: '100px'
            }
          },
          {
            breakpoint: 340,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              centerPadding: '5px'
            }
          },
          {
            breakpoint: 280,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              centerPadding: '10px',
              centerMode: true
            }
          }
        ]
        // autoplay: true,
      }
    }
  },
  methods: {
    calcDuration (duration) {
      const hours = (duration / 60).toString().length > 1 ? duration / 60 : `0${duration / 60}`
      const mins = (duration - (hours * 60)).toString().length > 1 ? duration - (hours * 60) : `0${duration - (hours * 60)}`
      return `${hours}:${mins}:00`
    },
    prevTwo () {
      this.$refs.slick.prev()
    },
    nextTwo () {
      this.$refs.slick.next()
    },
    clickCard (id) {
      this.$router.push('/courses/' + id)
    }
  },
  computed: {
    courses () {
      const allcourses = this.$store.getters['courses/getCourses']
      // const results = allcourses.sort(function (a, b) { return b.rate.rate_average - a.rate.rate_average })
      return allcourses
    },
    checkDirection () {
      return this.$q.lang.rtl
    },
    right () {
      return this.checkDirection ? 'fas fa-angle-left' : 'fas fa-angle-right'
    },
    left () {
      return this.checkDirection ? 'fas fa-angle-right' : 'fas fa-angle-left'
    }
  }
}
</script>
<style lang='scss' scoped>
.register-section {
  background-color: $grey-1;
}
.highest-rate{
  @media(max-width: 480px){
    text-align: center;
    margin-bottom: 15px;
  }
}
.arrow{
  @media(max-width: 480px),(max-width: 340px){
  text-align: center;
  }
}
.slider-container{
  height: 550px;
  overflow: hidden;
  .slider{
    height: 100%;
    padding: 18px 0px;
    // .card{
    //   display: inline-block;
    // }
  }
}

</style>
