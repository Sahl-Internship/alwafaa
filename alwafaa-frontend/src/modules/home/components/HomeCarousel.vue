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
            class="slick"
          >
          <base-card>
            <template>
              <img src="~assets/home-imgs/alorefy.jpg" to='/auth/login'/>
            </template>
            <template #teacherData>
              <p class="label-1">
                <img src="~assets/home-imgs/person.png" class="img-icon">
                د / محمد العريفي
              </p>
            </template>
            <template #sectionData>
              <p class="label-2">
                <img src="~assets/home-imgs/quran-icon2.png" class="img-icon2">
                القرآن الكريم
              </p>
            </template>
            <template #text>
              <div class="col text-h6 course-name">
                استخدم الاسماء الخمسة في حالات الإعراب الثلاثة
              </div>
            </template>
            <template #viewedSection>
                <p class="viewed-no">7</p>
                <img src="~assets/home-imgs/viewed.png" alt="" class="viewed-icon">
            </template>
            <template #durationSection>
                <p class="duration">04:30:00</p>
                <img src="~assets/home-imgs/duration.png" class="duration-icon">
            </template>
          </base-card>
<!-- =================================================================================== -->
          <base-card>
            <template>
              <img src="~assets/home-imgs/omar.jpg" />
            </template>
            <template #teacherData>
              <p class="label-1">
                <img src="~assets/home-imgs/person.png" class="img-icon">
                د / عمر عبدالكافي
              </p>
            </template>
            <template #sectionData>
              <p class="label-2">
                <img src="~assets/home-imgs/quran-icon2.png" class="img-icon2">
                القرآن الكريم
              </p>
            </template>
            <template #text>
              <div class="col text-h6 course-name">
                استخدم الاسماء الخمسة في حالات الإعراب الثلاثة
              </div>
            </template>
            <template #viewedSection>
                <p class="viewed-no">7</p>
                <img src="~assets/home-imgs/viewed.png" alt="" class="viewed-icon">
            </template>
            <template #durationSection>
                <p class="duration">04:30:00</p>
                <img src="~assets/home-imgs/duration.png" class="duration-icon">
            </template>
          </base-card>
<!-- ================================================================================================ -->
          <base-card>
            <template>
              <img src="~assets/home-imgs/arabic.jpeg" />
            </template>
            <template #teacherData>
              <p class="label-1">
                <img src="~assets/home-imgs/person.png" class="img-icon">
                د / احمد سلمان
              </p>
            </template>
            <template #sectionData>
              <p class="label-2">
                <img src="~assets/home-imgs/quran-icon2.png" class="img-icon2">
                اللغة العربية
              </p>
            </template>
            <template #text>
              <div class="col text-h6 course-name">
                استخدم الاسماء الخمسة في حالات الإعراب الثلاثة
              </div>
            </template>
            <template #viewedSection>
                <p class="viewed-no">7</p>
                <img src="~assets/home-imgs/viewed.png" alt="" class="viewed-icon">
            </template>
            <template #durationSection>
                <p class="duration">05:30:00</p>
                <img src="~assets/home-imgs/duration.png" class="duration-icon">
            </template>
          </base-card>
<!-- =================================================================================== -->
          <base-card>
            <template>
              <img src="~assets/home-imgs/alorefy.jpg" />
            </template>
            <template #teacherData>
              <p class="label-1">
                <img src="~assets/home-imgs/person.png" class="img-icon">
                د / محمد العريفي
              </p>
            </template>
            <template #sectionData>
              <p class="label-2">
                <img src="~assets/home-imgs/quran-icon2.png" class="img-icon2">
                   القرآن الكريم
              </p>
            </template>
            <template #text>
              <div class="col text-h6 course-name">
                استخدم الاسماء الخمسة في حالات الإعراب الثلاثة
              </div>
            </template>
            <template #viewedSection>
                <p class="viewed-no">7</p>
                <img src="~assets/home-imgs/viewed.png" alt="" class="viewed-icon">
            </template>
            <template #durationSection>
                <p class="duration">08:10:00</p>
                <img src="~assets/home-imgs/duration.png" class="duration-icon">
            </template>
          </base-card>
<!-- ================================================================================= -->
          <base-card>
            <template>
              <img src="~assets/home-imgs/omar.jpg" />
            </template>
            <template #teacherData>
              <p class="label-1">
                <img src="~assets/home-imgs/person.png" class="img-icon">
                د / عمر عبدالكافي
              </p>
            </template>
            <template #sectionData>
              <p class="label-2">
                <img src="~assets/home-imgs/quran-icon2.png" class="img-icon2">
                   القرآن الكريم
              </p>
            </template>
            <template #text>
              <div class="col text-h6 course-name">
                استخدم الاسماء الخمسة في حالات الإعراب الثلاثة
              </div>
            </template>
            <template #viewedSection>
                <p class="viewed-no">7</p>
                <img src="~assets/home-imgs/viewed.png" alt="" class="viewed-icon">
            </template>
            <template #durationSection>
                <p class="duration">08:10:00</p>
                <img src="~assets/home-imgs/duration.png" class="duration-icon">
            </template>
          </base-card>
<!-- ==================================================================================== -->
          </slick>
        </div>
</div>
      <!-- second slider -->
      <home-carousel-two></home-carousel-two>

    </div>
</template>
<script>
// import SectionCard from './SectionCard.vue'
import Slick from 'vue-slick'
import BaseCard from 'src/components/UI/BaseCard'
import HomeCarouselTwo from './HomeCarouselTwo.vue'
export default {
  components: { Slick, HomeCarouselTwo, BaseCard },
  name: 'HomeCourses',
  data () {
    return {
      dense: true,
      slide: 0,
      slickOptions: {
        slidesToShow: 3,
        arrows: false,
        mobileFirst: true,
        infinite: false,
        initialSlide: 0,
        // focusOnSelect: true,
        rtl: true,
        // centerPadding: '24px',
        responsive: [
          {
            breakpoint: 1200,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1,
              // centerPadding: '100px'
              centerMode: true
            }
          },
          {
            breakpoint: 992,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1,
              centerPadding: '0px',
              centerMode: true
            }
          },
          {
            breakpoint: 767,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
              centerMode: true,
              centerPadding: '23px'
            }
          },
          {
            breakpoint: 650,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
              centerMode: true,
              centerPadding: '25px'
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              centerMode: true,
              centerPadding: '100px'
            }
          },
          {
            breakpoint: 340,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              centerMode: true,
              centerPadding: '5px'
            }
          },
          {
            breakpoint: 280,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              centerMode: true,
              centerPadding: '10px'
            }
          }
        ]
        // autoplay: true
      }
    }
  },
  methods: {
    prev () {
      if (this.slide > 0) {
        this.$refs.slick.prev()
        this.slide--
      } else {
        return false
      }
    },
    next () {
      if (this.slide < 2) {
        this.$refs.slick.next()
        this.slide++
      } else {
        return false
      }
    }
  },
  computed: {
    checkDirection () {
      return this.$q.lang.rtl
    },
    right () {
      return this.checkDirection ? 'fas fa-angle-left' : 'fas fa-angle-right'
      // : this.checkDirection ? 'fas fa-arrow-circle-right' : 'fas fa-arrow-circle-left'
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
  .ready-text {
    color: $secondary;
  }
  .exp-text {
    color: $grey-4;
  }
}
.slider-container{
  height: 550px;
  overflow: hidden;
  position: relative;
  .slider{
    height: 100%;
    padding: 18px 0px;
    .slick{
      height: 100%;
      margin: 0;
      padding: 0;
      right: 0;
      left: 0;
      width: 100%;
      outline: none !important;
      border: none;
      &:focus{
        outline: none !important;
        outline: 0 !important;
        border: none;
      }
      .my-card{
        margin-left: -420px;
        outline: none;
        border: none;
        width:400px !important;
        height: 420px !important;
        &:focus{
          outline: none !important;
          border: none;
        }
        @media(max-width: 1170px ){
          width:365px !important;
          height: 420px !important;
        }
        @media(max-width: 340px ),(max-width: 480px){
          width:300px !important;
          height: 420px !important;
          margin-left: -330px;

        }
        .rating-section{
          margin-top: 20px;
          margin-bottom: 30px;
          .rating-no,.rating-no2{
            display: inline;
            margin: 0px 8px;
          }
          .star-icon{
            width: 15px;
            height: 15px;
            display: inline;
          }
        }
        .separator{
          margin-top: -23px;
        }
        img{
          height: 220px;
          width: 100%;
          border-radius: 5px 5px 0px 0px;
        }
        .duration-view{
          margin-top: 20px;
          .duration{
            font-size: 15px;
            margin-right: 27px;
            margin-top: -5px;
            // padding-left: 10px;
          }
          .duration-icon{
            width: 15px !important;
            height: 15px !important;
            display: inline;
            position: absolute;
            bottom: 21px;
            right: 85px;
          }
          .viewed-icon{
              width: 15px;
              height: 15px;
              display: inline;
              position: absolute;
              bottom: 21px;
              left: 25px;
          }
          .viewed-no{
              font-size: 15px;
              margin-left: 50px;
              margin-top: -5px;
          }
        }
        .course-name{
          padding: 0px 50px;
          @media (max-width: 340px),(max-width: 480px){
            padding: 0px 10px
          }
        }
        .container{
          border-radius: 5px 5px 0px 0px;
          position: relative;
          height: 220px;
          top: 0;
          left: 0;
          right: 0;
          .label-1{
            position: absolute;
            top: 0;
            left: 0;
            margin-top: 20px;
            margin-left: 25px;
            left: 20px;
            color: #fff;
            font-size: 12px;
          }
          .label-2{
            position: absolute;
            top: 0;
            left: 0;
            margin-top: 50px;
            margin-left: 25px;
            left: 20px;
            color: #fff;
            font-size: 12px;
          }
          .img-icon{
            width: 17px;
            height: 15px;
            position: absolute;
            padding-right: 0px;
            margin-left: -27px;
            left: 0;
            margin-top: -1px;
          }
          .img-icon2{
            width: 20px;
            height: 17px;
            position: absolute;
            padding-right: 0px;
            margin-left: -27px;
            left: 0;
            margin-top: -1px;
          }
          .global-icon{
            width: 20px;
            height: 17px;
            position: absolute;
            padding-right: 3px;
            margin-left: -27px;
            left: 0;
            margin-top: -1px;
            font-size: 16px;
          }
          .overlay {
            position: absolute;
            bottom: 0;
            background: rgb(0, 0, 0);
            background: rgba(0, 0, 0, 0.5); /* Black see-through */
            color: #f1f1f1;
            width: 100%;
            transition: .5s ease;
            opacity:1;
            color: white;
            height: 100%;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0px 0px;
          }
        }
      }
    }
}
}
.flip-img{
  transform: scaleX(-1);
}
</style>
