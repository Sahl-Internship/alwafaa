<template>
  <div
    class="register-section"
    :class="!$q.screen.lt.xl ? 'register-section-height' : ''"
  >
    <div
      class="row"
    >
      <div
        class="col-12 text-center"
      >
        <h4
          class="column title"
        > {{$t('carousel.title')}}
        </h4>
      </div>
    </div>
    <div
      class="row q-mx-xl"
    >
      <div
        class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-h6 newest-course"
      >{{$t('carousel.newestCourses')}}
      </div>
      <div
        class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-right arrow"
      >
        <q-btn
          rounded
          unelevated
          :label="$t('carousel.showAll')"
          color='blue-2'
          text-color='primary'
          to='/courses/all'
        />
        <q-btn
          unelevated
          outline round
          :dense='dense'
          text-color='dark'
          @click="prev"
          class="q-mx-md"
        >
          <i  :class="left"></i>
        </q-btn>
        <q-btn
          unelevated
          outline round
          :dense='dense'
          text-color='dark'
          @click="next"
        >
          <i  :class="right"></i>
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

export default {
  components: { Slick, CourseCard },
  name: 'HomeCourses',
  data () {
    return {
      dense: true,
      // rating: 0,
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
      const timeInHour = Math.floor(duration / 60)
      const hours = timeInHour.toString().length > 1
        ? timeInHour
        : `0${timeInHour}`
      const mins = (duration - (timeInHour * 60)).toString().length > 1
        ? duration - (timeInHour * 60)
        : `0${duration - (timeInHour * 60)}`
      console.log(timeInHour)
      return `${hours}:${mins}:00`
    },
    prev () {
      this.$refs.slick.prev()
    },
    next () {
      this.$refs.slick.next()
    }
  },
  computed: {
    courses () {
      const allCourses = [...this.$store.getters['courses/getCourses']]
      const results = allCourses.sort((a, b) => b.created_at - a.created_at)
      return results
    },
    isAuthenticated () {
      return this.$store.getters['auth/isAuthenticated']
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
.title{
  position:relative;
  margin-top: 100px;
  @media (max-width: 480px){
    font-size: 22px;
    margin-bottom: 100px;
  }
  &:after{
    content:'';
    width: 16%;
    height: 3px;
    bottom: 0;
    background: $green;
    top: 60px;
    left: 43%;
    position: absolute;
    @media (max-width: 480px){
    width: 25%;
    left:35%
    }
  }
}
.newest-course{
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
.register-section {
  background-color: $grey-1;
}
.slider-container{
  height: 550px;
  overflow: hidden;
  position: relative;
  .slider{
    height: 100%;
    padding: 18px 0px;
    .slick{
      @media (max-width: 480px) {
        margin-left: 22px;
      }
    }
}
}
.card{
  margin-right: 100px;
}
</style>
