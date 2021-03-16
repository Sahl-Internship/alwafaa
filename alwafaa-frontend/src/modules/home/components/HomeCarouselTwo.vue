<template>
    <div>
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
      <div class="slider-container">
        <div class="slider" >
          <slick
            ref="slick"
            :options="slickOptions"
            class="slick"
          >
          <!-- ============================================================================== -->
            <base-card  v-for="result in results" :key="result.id">
              <template>
              <img :src="result.image" />
              </template>
              <template #teacherData>
                <p class="label-1">
                  <img src="/images/home-imgs/person.png" class="img-icon">
                  د / محمد العريفي
                </p>
              </template>
              <template #sectionData>
                <p class="label-2">
                  <span
                    :class="
                    {
                      'img-icon2':result.section==='قران كريم' || 'حديث شريف',
                      'global-icon2':result.section==='اللغة العربية'}"
                  ></span>
                  {{result.section}}
                </p>
              </template>
              <!-- <template #courseState>
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
              </template> -->
              <template #text >
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
            </base-card>
<!-- =================================================================================== -->
          <!-- <base-card>
            <template>
              <img src="/images/home-imgs/arabic.jpeg" />
            </template>
            <template #teacherData>
              <p class="label-1">
                <img src="/images/home-imgs/person.png" class="img-icon">
                د / احمد سلمان
              </p>
            </template>
            <template #sectionData>
              <p class="label-2">
                <img src="/images/home-imgs/quran-icon2.png" class="img-icon2">
                اللغة العربية
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
                :star-size="15"
                inactive-color="#ccc"
                active-color="orange"
              ></star-rating>
            </template>
            <template #viewedSection>
                <p class="viewed-no">7</p>
                <img src="/images/home-imgs/viewed.png" alt="" class="viewed-icon">
            </template>
            <template #durationSection>
                <p class="duration">05:30:00</p>
                <img src="/images/home-imgs/duration.png" class="duration-icon">
            </template>
          </base-card> -->
<!-- =================================================================================== -->

          </slick>
        </div>
      </div>
    </div>
</template>
<script>
import Slick from 'vue-slick'
import StarRating from 'vue-star-rating'
import BaseCard from 'src/components/UI/BaseCard'
// import { axios } from 'src/boot/axios'
export default {
  components: { Slick, BaseCard, StarRating },
  name: 'HomeCourses',
  data () {
    return {
      dense: true,
      rating: 0,
      slide: 0,
      results: [],
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
              // centerPadding: '100px',
              centerMode: true
            }
          },
          {
            breakpoint: 992,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1,
              centerPadding: '0px'
              // centerMode: true
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
              // centerMode: true,
              centerPadding: '90px'
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
  created () {
    this.results = this.courses.sort(function (a, b) { return b.rate.rate_average - a.rate.rate_average })
  },
  computed: {
    courses () {
      return this.$store.getters['home/getCourses']
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
.highest-rate{
  @media(max-width: 480px){
    text-align: center;
    margin-bottom: 15px;
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
  // position: relative;
  .slider{
    height: 100%;
    padding: 18px 0px;
    .slick{
      height: 100%;
      margin: 0;
      padding: 0;
      right: 0;
      left: 0;
      // width: 100%;
      outline: none !important;
      border: none;
      &:focus{
        outline: none !important;
        outline: 0 !important;
        border: none;
      }
      .my-card{
        margin-left: -420px;
        // display: inline-block;
        outline: none;
        border: none;
        width:400px !important;
        height: 450px !important;
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
          display: inline-block !important;
          margin-left: 30px;

        }
        .rating-section{
          margin-top: 20px;
          margin-bottom: 30px;
          .rating,.rating-no2{
            display: inline;
            margin: 4px 0px;
          }
          .star-icon{
            width: 15px;
            height: 15px;
            display: inline;
          }
        }
        .separator{
          position: absolute;
          bottom: 55px;
          margin-top: 0px;
          width: 100%;
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
            position: absolute;
            bottom: 2px;
            right: 0px;
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
            position: absolute;
            bottom: 2px;
            left: 0px;
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
          .course-state{
            position:absolute;
            text-align: center;
            line-height: 1.8;
            border-radius: 4px;
            width: 60px;
            height: 30px;
            left: 15px;
            bottom: 0px;
          }
          .red{
            background: rgb(240, 71, 71);
            color: #fff;
          }
          .green{
            background: $green;
            color: #000;
          }
          .white{
            background: #DDD;
            color: #000;
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
          // .img-icon2{
          //   width: 20px;
          //   height: 17px;
          //   position: absolute;
          //   padding-right: 0px;
          //   margin-left: -27px;
          //   left: 0;
          //   margin-top: -1px;
          // }
          .img-icon2{
            background-image: url('/images/home-imgs/quran-icon2.png') ;
            background-size: 20px 17px;
            width: 20px;
            height: 17px;
            position: absolute;
            padding-right: 0px;
            margin-left: -27px;
            left: 0;
            top: 0;
            // margin-top: -1px;
          }
          .global-icon2{
            background-image: url('/images/home-imgs/global.png') ;
            background-size: 17px 15px;
            width: 17px;
            height: 15px;
            position: absolute;
            padding-right: 0px;
            margin-left: -27px;
            left: 0;
            top: 0;
          }
          .global{
            width: 17px;
            height: 15px;
            position: absolute;
            padding-right: 3px;
            margin-left: -27px;
            left: 0;
            margin-top: 0px;
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
li{
  display: block;
}
</style>

//
// title{
//   @media (max-width: 480px){
//     font-size: 22px;
//   }
// }
// .highest-rate{
//   @media(max-width: 480px){
//     text-align: center;
//     margin-bottom: 15px;
//   }
// }
// .register-section {
//   background-color: $grey-1;
//   .ready-text {
//     color: $secondary;
//   }

//   .exp-text {
//     color: $grey-4;
//   }
// }
// .arrow{
//     @media(max-width: 480px),(max-width: 340px){
//         text-align: center;
//     }
// }
// .slider-container{
//   height: 550px;
//   overflow: hidden;
//   position: relative;
//     .slider{
//         height: 100%;
//         padding: 18px 0px;
//         .slick{
//           height: 100%;
//           margin: 0;
//           padding: 0;
//           right: 0;
//           left: 0;
//           width: 100%;
//         }
//         .slick-slide{
//           outline: none;
//         }
//         .my-card{
//             // margin-left: -420px;
//             width:400px !important;
//             height: 420px !important;
//              @media(max-width: 1170px ){
//               width:365px !important;
//               height: 420px !important;
//             }
//             @media(max-width: 340px ),(max-width: 480px){
//               width:300px !important;
//               height: 420px !important;
//               margin-left: -330px;
//             }
//             .rating-section{
//               margin-top: 20px;
//               margin-bottom: 30px;
//               .rating-no,.rating-no2{
//               display: inline;
//               margin: 0px 8px;
//               }
//               .star-icon{
//                 width: 15px;
//                 height: 15px;
//                 display: inline;
//               }
//             }
//             .separator{
//               position: absolute;
//               bottom: 55px;
//               width: 100%;
//             }
//         .duration-view{
//           margin-top: 20px;
//           .duration{
//             font-size: 15px;
//             margin-right: 27px;
//             margin-top: 3px;
//           }
//           .duration-icon{
//             width: 15px !important;
//             height: 15px !important;
//             display: inline;
//             position: absolute;
//             bottom: 21px;
//             right: 85px;
//           }
//           .viewed-icon{
//               width: 15px;
//               height: 15px;
//               display: inline;
//               position: absolute;
//               bottom: 21px;
//               left: 25px;
//           }
//           .viewed-no{
//               font-size: 15px;
//               margin-left: 50px;
//               margin-top: 3px;
//           }
//           // Flip in English
//           .duration-flip{
//             margin-left: 27px;
//           }
//           .duration-icon-flip{
//             left: 85px;
//           }
//           .viewed-icon-flip{
//               right: 25px;
//           }
//           .viewed-no-flip{
//               margin-right: 50px;
//           }
//         }
//     img{
//     border-radius: 5px 5px 0px 0px;
//     height: 220px;
//     width: 100%;
//     }
//     .course-name{
//       padding: 0px 50px;
//       @media (max-width: 340px),(max-width: 480px){
//         padding: 0px 10px
//       }
//     }
//     .container{
//         border-radius: 5px 5px 0px 0px;
//         position: relative;
//         height: 220px;
//         top: 0;
//         left: 0;
//         right: 0;
//         .label-1{
//             position: absolute;
//             top: 0;
//             left: 0;
//             margin-top: 20px;
//             margin-left: 25px;
//             left: 20px;
//             color: #fff;
//             font-size: 12px;
//         }
//         .label-2{
//             position: absolute;
//             top: 0;
//             left: 0;
//             margin-top: 50px;
//             margin-left: 25px;
//             left: 20px;
//             color: #fff;
//             font-size: 12px;
//         }
//         .img-icon{
//             width: 17px;
//             height: 15px;
//             position: absolute;
//             padding-right: 0px;
//             margin-left: -27px;
//             left: 0;
//             margin-top: -1px;
//         }
//         .img-icon2{
//             width: 20px;
//             height: 17px;
//             position: absolute;
//             padding-right: 0px;
//             margin-left: -27px;
//             left: 0;
//             margin-top: -1px;
//         }
//         .overlay {
//             border-radius: 5px 5px 0px 0px;
//             position: absolute;
//             bottom: 0;
//             background: rgb(0, 0, 0);
//             background: rgba(0, 0, 0, 0.5); /* Black see-through */
//             color: #f1f1f1;
//             width: 100%;
//             transition: .5s ease;
//             opacity:1;
//             color: white;
//             height: 100%;
//             padding: 20px;
//             text-align: center;
//         }
//     }
//     }
//   }
// }
// .flip-img{
//   transform: scaleX(-1);
// }
