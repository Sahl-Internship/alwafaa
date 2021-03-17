<template>
    <div
      class="register-section"
      :class="!$q.screen.lt.xl ? 'register-section-height' : ''"
    >
      <div class="row">
        <div class="col-12 text-center">
          <h4 class="column title">{{$t('carousel.title')}}</h4>
        </div>
      </div>
      <div class="row q-mx-xl">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-h6 newest-course">{{$t('carousel.newestCourses')}} </div>
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
      <div class="slider-container">
        <div class="slider" >
          <slick
            ref="slick"
            :options="slickOptions"
            class="slick q-ml-xl"
          >
<!-- ========================================================================================= -->
            <!-- <base-card  v-for="result in results" :key="result.id"  >
              <template >
                <img :src="result.image" to='/auth/login' />
              </template>
              <template #teacherData>
                <p class="teacher-name" >
                  <img src="/images/home-imgs/person.png" class="img-icon" >
                  د / محمد العريفي
                </p>
              </template>
              <template #sectionData>
                <p class="course-section-name">
                  <span
                    :class="
                    {
                      'img-icon2':result.section==='قران كريم' || 'حديث شريف',
                      'global-icon2':result.section==='اللغة العربية'}"
                  ></span>
                  {{result.section}}
                </p>
              </template>
              <template #courseState>
                <p
                  class="course-state"
                  :class="
                  {
                    'red':result.state==='will start',
                    'green':result.state==='not-ended',
                    'white':result.state==='ended'
                  }"
                >
                  لم تنته
                </p>
              </template>
              <template #text>
                <div class="col text-h6 course-name" @click="clickCard(result.id)">
                  {{result.title}}
                </div>
              </template>
              <template #rating>
                <p class="rating">{{result.rate.rate_average}}</p>
                <star-rating
                  class="star-rating q-mr-md"
                  v-model="result.rate.rate_average"
                  :rtl='true'
                  :increment="0.5"
                  :max-rating="5"
                  :star-size="18"
                  :show-rating='false'
                  :padding='5'
                  inactive-color="#ccc"
                  active-color="orange"
                ></star-rating>
                <p class="rating-no2">{{result.rate.voters}}</p>
              </template>
              <template #viewedSection>
                  <p class="viewed-no">7</p>
                  <img src="/images/home-imgs/viewed.png" alt="" class="viewed-icon">
              </template>
              <template #durationSection>
                  <p class="duration">
                    {{calcDuration(result.duration)}}
                  </p>
                  <img src="/images/home-imgs/duration.png" class="duration-icon">
              </template>
            </base-card> -->
<q-card class="course-card" v-for="result in results" :key="result.id">
    <img :src="result.image"/>
      <!-- <div
        class="column justify-between no-wrap fit"
        :class="$q.screen.lt.md ? 'cover-text' : ''"
      >

        <div :class="$q.screen.lt.sm ? 'row' : 'row q-gutter-y-xs'">
          <div class="col-12 row items-center">
            <img
              src="/images/home-imgs/person.png"
              :class="{
                'icon-lg': !$q.screen.lt.sm,
                'icon-sm': $q.screen.lt.sm
              }"
            />
            <div
              :class="{
                'text-subtitle2': !$q.screen.lt.sm,
                'text-caption': $q.screen.lt.sm,
                'q-ml-sm': true
              }"
            >د/محمد العريفي</div>
          </div>

          <div class="col-12 row items-center">
            <img
              src="/images/home-imgs/global.png"
              :class="{
                'icon-lg': !$q.screen.lt.sm,
                'icon-sm': $q.screen.lt.sm
              }"
            />
            <div
              :class="{
                'text-subtitle2': !$q.screen.lt.sm,
                'text-caption': $q.screen.lt.sm,
                'q-ml-sm': true
              }"
            >{{result.section}}</div>
          </div>
        </div>

        <div class="row">
          <div
            class="text-grey-5 bg-green q-px-sm rounded-borders"
            :class="{
              'text-subtitle2 q-py-xs': !$q.screen.lt.sm,
              'text-caption': $q.screen.lt.sm,
              'not-started': result.status === 0,
              'not-finished': result.status === 1,
              'finished': result.status === 2,
            }"
          >
            لم تبدء
          </div>
        </div>

      </div> -->
    <!-- </q-img> -->

    <q-card-section :class="$q.screen.lt.md ? 'q-px-xs q-py-md' : 'q-pa-xl'">
      <div
        class="text-grey-5 text-center"
        :class="{
          'text-h6 text-weight-bold': !$q.screen.lt.md,
          'text-subtitle2': $q.screen.lt.md,
        }"
        @click="clickCard(result.id)"
      >
        {{result.title}}
      </div>

      <div class="row justify-center q-mt-md">
        <div
          class="text-grey-4"
          :class="$q.screen.lt.md ? 'text-caption' : 'text-subtitle1'"
        >{{result.rate.rate_average}}</div>

        <star-rating
          read-only
          :increment=0.5
          :rating=4.5
          :star-size="$q.screen.lt.md ? 13 : 20"
          :padding="$q.screen.lt.md ? 3 : 5"
          :active-color="['#e49d1a']"
          :show-rating=false
          :rtl=true
        ></star-rating>

        <div
          class="text-grey-4 q-ml-sm"
          :class="$q.screen.lt.md ? 'text-caption' : 'text-subtitle1'"
        >{{result.rate.voters}}</div>
      </div>
    </q-card-section>

    <q-card-section
      class="row justify-between items-center rounded-borders bottom-section"
      :class="$q.screen.lt.md ? 'bottom-section-sm' : 'q-px-lg'"
    >
      <div class="col-2 row items-center no-wrap">
        <img
          src="/images/home-imgs/viewed.png"
          :class="{
            'icon-lg': !$q.screen.lt.sm,
            'icon-sm': $q.screen.lt.sm
          }"
        />
        <div
          :class="{
            'text-subtitle1 q-ml-sm': !$q.screen.lt.md,
            'text-caption q-ml-xs': $q.screen.lt.md,
            'text-grey-4': true
          }"
        >{{result.sessions}}</div>
      </div>

      <div
        class="col-5 row items-center no-wrap"
        :class="isAuthenticated ? 'justify-center' : 'justify-end'"
      >
        <img
          src="/images/home-imgs/duration.png"
          :class="{
            'icon-lg': !$q.screen.lt.sm,
            'icon-sm': $q.screen.lt.sm
          }"
        />
        <div
          :class="{
            'text-subtitle1 q-ml-sm': !$q.screen.lt.md,
            'text-caption q-ml-xs': $q.screen.lt.md,
            'text-grey-4': true
          }"
        >{{calcDuration(result.duration)}}</div>
      </div>

      <div
        v-if="isAuthenticated"
        class="col-3 row justify-end items-center no-wrap"
      >
        <img
          src="/images/Path 8197.png"
          :class="{
            'icon-lg': !$q.screen.lt.sm,
            'icon-sm': $q.screen.lt.sm
          }"
        />
        <div
          :class="{
            'text-subtitle1 q-ml-sm': !$q.screen.lt.md,
            'text-caption q-ml-xs': $q.screen.lt.md,
            'text-grey-4': true
          }"
        >{{result.student_number}}</div>
      </div>
    </q-card-section>
  </q-card>
<!-- =================================================================================== -->
          <!-- <base-card>
            <template>
              <img src="/images/home-imgs/omar.jpg" />
            </template>
            <template #teacherData>
              <p class="label-1">
                <img src="/images/home-imgs/person.png" class="img-icon">
                د / عمر عبدالكافي
              </p>
            </template>
            <template #sectionData>
              <p class="label-2">
                <img src="/images/home-imgs/quran-icon2.png" class="img-icon2">
                القرآن الكريم
              </p>
            </template>
            <template #text>
              <div class="col text-h6 course-name">
                استخدم الاسماء الخمسة في حالات الإعراب الثلاثة
              </div>
            </template>
            <template #rating>
              <p class="rating-no2">(455)</p>
              <star-rating
                class="star-rating"
                v-model="rating"
                :increment="0.5"
                :max-rating="5"
                :rtl= true
                :star-size="20"
                inactive-color="#ccc"
                active-color="orange"
              ></star-rating>
            </template>

            <template #viewedSection>
                <p class="viewed-no">7</p>
                <img src="/images/home-imgs/viewed.png" alt="" class="viewed-icon">
            </template>
            <template #durationSection>
                <p class="duration">04:30:00</p>
                <img src="/images/home-imgs/duration.png" class="duration-icon">
            </template>
          </base-card> -->
<!-- =================================================================================== -->
          </slick>
        </div>
      </div>
      <!-- second slider -->
      <home-carousel-two></home-carousel-two>

    </div>
</template>
<script>
import Slick from 'vue-slick'
import StarRating from 'vue-star-rating'
// import BaseCard from 'src/components/UI/BaseCard'
import HomeCarouselTwo from './HomeCarouselTwo.vue'

export default {
  components: { Slick, HomeCarouselTwo, StarRating },
  name: 'HomeCourses',
  data () {
    return {
      dense: true,
      rating: 0,
      retrievedData: [],
      // slide: 0,
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
    prev () {
      this.$refs.slick.prev()
    },
    next () {
      this.$refs.slick.next()
    },
    clickCard (id) {
      this.$router.push('/courses/' + id)
    }
  },
  created () {
    this.results = this.courses.sort(function (a, b) { return b.created_at - a.created_at })
  },
  computed: {
    courses () {
      console.log('get')
      return this.$store.getters['home/getCourses']
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
    // .slick{
    //   height: 100%;
    //   margin: 0;
    //   padding: 0;
    //   right: 0;
    //   left: 0;
    //   width: 100%;
    //   outline: none !important;
    //   border: none;
    //   &:focus{
    //     outline: none !important;
    //     outline: 0 !important;
    //     border: none;
    //   }
    //   .my-card{
    //     margin-left: -420px;
    //     outline: none;
    //     border: none;
    //     width:400px !important;
    //     height: 450px !important;
    //     &:focus{
    //       outline: none !important;
    //       border: none;
    //     }
    //     @media(max-width: 1170px ){
    //       width:365px !important;
    //       height: 420px !important;
    //     }
    //     @media(max-width: 340px ),(max-width: 480px){
    //       width:300px !important;
    //       height: 420px !important;
    //       margin-left: 30px;
    //     }
    //     .rating-section{
    //       margin-top: 20px;
    //       margin-bottom: 30px;
    //       .rating,.rating-no2{
    //         display: inline;
    //         margin: 4px 0px;
    //       }
    //       .star-icon{
    //         width: 15px;
    //         height: 15px;
    //         display: inline;
    //       }
    //     }
    //     .separator{
    //       position: absolute;
    //       bottom: 55px;
    //       margin-top: 0px;
    //       width: 100%;
    //     }
    //     img{
    //       height: 220px;
    //       width: 100%;
    //       border-radius: 5px 5px 0px 0px;
    //     }
    //     .duration-view{
    //       margin-top: 20px;
    //       .duration{
    //         font-size: 15px;
    //         margin-right: 27px;
    //         position: absolute;
    //         bottom: 2px;
    //         right: 0px;
    //       }
    //       .duration-icon{
    //         width: 15px !important;
    //         height: 15px !important;
    //         display: inline;
    //         position: absolute;
    //         bottom: 21px;
    //         right: 85px;
    //       }
    //       .viewed-icon{
    //           width: 15px;
    //           height: 15px;
    //           display: inline;
    //           position: absolute;
    //           bottom: 21px;
    //           left: 25px;
    //       }
    //       .viewed-no{
    //         font-size: 15px;
    //         margin-left: 50px;
    //         position: absolute;
    //         bottom: 2px;
    //         left: 0px;
    //       }
    //     }
    //     .course-name{
    //       padding: 0px 50px;
    //       cursor: pointer;
    //       @media (max-width: 340px),(max-width: 480px){
    //         padding: 0px 10px
    //       }
    //     }
    //     .container{
    //       border-radius: 5px 5px 0px 0px;
    //       position: relative;
    //       height: 220px;
    //       top: 0;
    //       left: 0;
    //       right: 0;
    //       .teacher-name{
    //         position: absolute;
    //         top: 0;
    //         left: 0;
    //         margin-top: 20px;
    //         margin-left: 25px;
    //         left: 20px;
    //         color: #fff;
    //         font-size: 12px;
    //       }
    //       .course-section-name{
    //         position: absolute;
    //         top: 0;
    //         left: 0;
    //         margin-top: 50px;
    //         margin-left: 25px;
    //         left: 20px;
    //         color: #fff;
    //         font-size: 12px;
    //       }
    //       .course-state{
    //         position:absolute;
    //         text-align: center;
    //         line-height: 1.8;
    //         border-radius: 4px;
    //         width: 60px;
    //         height: 30px;
    //         left: 15px;
    //         bottom: 0px;
    //       }
    //       .red{
    //         background: rgb(240, 71, 71);
    //         color: #fff;
    //       }
    //       .green{
    //         background: $green;
    //         color: #000;
    //       }
    //       .white{
    //         background: #DDD;
    //         color: #000;
    //       }
    //       .img-icon{
    //         width: 17px;
    //         height: 15px;
    //         position: absolute;
    //         padding-right: 0px;
    //         margin-left: -27px;
    //         left: 0;
    //         margin-top: -1px;
    //       }
    //       .img-icon2{
    //         background-image: url('/images/home-imgs/quran-icon2.png') ;
    //         background-size: 20px 17px;
    //         width: 20px;
    //         height: 17px;
    //         position: absolute;
    //         padding-right: 0px;
    //         margin-left: -27px;
    //         left: 0;
    //         top: 0;
    //         // margin-top: -1px;
    //       }
    //       .global-icon2{
    //         background-image: url('/images/home-imgs/global.png') ;
    //         background-size: 17px 15px;
    //         width: 17px;
    //         height: 15px;
    //         position: absolute;
    //         padding-right: 0px;
    //         margin-left: -27px;
    //         left: 0;
    //         top: 0;
    //       }
    //       .global{
    //         width: 17px;
    //         height: 15px;
    //         position: absolute;
    //         padding-right: 3px;
    //         margin-left: -27px;
    //         left: 0;
    //         margin-top: 0px;
    //         font-size: 16px;
    //       }
    //       .overlay {
    //         position: absolute;
    //         bottom: 0;
    //         background: rgb(0, 0, 0);
    //         background: rgba(0, 0, 0, 0.5); /* Black see-through */
    //         color: #f1f1f1;
    //         width: 100%;
    //         transition: .5s ease;
    //         opacity:1;
    //         color: white;
    //         height: 100%;
    //         padding: 20px;
    //         text-align: center;
    //         border-radius: 5px 5px 0px 0px;
    //       }
    //     }
    //   }
    // }
}
}
.course-card {
  width: 95% !important;
  min-width: 155px;

  .icon-lg {
    width: 15px;
    height: 15px;
  }

  .icon-sm {
    width: 10px;
    height: 10px;
  }
}

.q-img__content > div {
  &.cover-text {
    padding-top: 5px;
    padding-bottom: 5px;
  }
}

.bottom-section {
  border-top: solid 1.5px $grey-1;
}

.q-card__section--vert {
  &.bottom-section-sm {
    padding-left: 5px;
    padding-right: 5px;
  }
}

.q-card > div:not(:first-child),
.q-card > img:not(:first-child) {
  border-top-left-radius: 15px;
  border-top-right-radius: 15px;
}
</style>
