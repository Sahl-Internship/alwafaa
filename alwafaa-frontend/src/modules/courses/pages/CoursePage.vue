<template>
  <div class="main-div">
    <!-- Start Blue section -->
    <div class="col-12 row justify-center blue-section">
      <div class="col-11 row q-px-sm">

        <div class="col-xs-12 col-sm-12 col-md-8 col-8 row items-between q-mt-md">
          <q-breadcrumbs
            separator=">"
            separator-color="grey-3"
            active-color="grey-3"
          >
            <q-breadcrumbs-el label="الرئيسية" class="text-grey-2" to="/" />
            <q-breadcrumbs-el label="الدورات" class="text-grey-2" to="/courses" />
            <q-breadcrumbs-el label="اللغة العربية" class='text-white' />
          </q-breadcrumbs>
          <!-- </div> -->
          <div class="col-11 title-section">
            <p class="main-title text-white">{{courseData.title}}</p>
            <p class="sub-title text-white">{{courseData.sub_title}}</p>
          </div>

          <div class="col-11 row justify-between q-mb-lg">
            <div class="row items-center">
              <q-avatar>
                <q-img src="https://cdn.quasar.dev/img/boy-avatar.png" />
              </q-avatar>
              <div class="text-h6 text-white q-ml-sm" >
                {{courseData.teacher.name}}

              </div>
            </div>

            <div class="row items-center">
              <div class="text-h6 text-white">فئة الدورة: </div>
              <div class="row items-center q-pl-sm q-gutter-x-sm">
                <img :src='sectionImgSrc' width="25px" />
                <div class="text-h6 text-white">{{courseData.section}}</div>
              </div>
            </div>

            <div class="row items-center">
              <div class="text-h6 text-white">آخر تحديث: </div>
              <div class="row items-center q-pl-sm q-gutter-x-sm">
                <img src="/images/Box/calender.png" width="18px" />
                <div class="text-h6 text-white">
                  <!-- 12 يناير 2021 -->
                  <!-- {{ calcDate(courseData.created_at) }} -->
                  {{lastUpdate()}}
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row col-xs-12 col-sm-12 col-md-4 col-lg-4 btns-section justify-end self-end q-mb-xl">
          <q-btn
            :label='buttonTitleState'
            size='lg'
            :dense='dense'
            class="col-xs-12 col-sm-12 col-md-11 col-lg-11 text-grey-5 bg-green"
            @click="joinCourse"
          ></q-btn>

          <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11 row justify-between q-mt-lg">
            <q-btn
              flat
              size="20px"
              align="between"
              class="main-section__btn text-white transparent"
              style="width: 49%"
            >
              <img src="images/Box/play-icon2.png" class="btn-icon">
              <div class="text-h6 btn-text">دروس الدورة</div>
            </q-btn>

            <q-btn
              flat
              size="20px"
              align="between"
              class="main-section__btn text-white transparent"
              style="width: 49%"
            >
              <img src="images/Box/share.png" class="btn-icon">
              <div class="text-h6 btn-text">مشاركة الدورة</div>
            </q-btn>
          </div>

        </div>
      </div>
    </div>
    <!-- End Blue Section -->

    <!-- Start Course info Main section -->
    <div class="row col-12 bg-grey-2 q-py-xl justify-center">
        <!-- First section what you will learn and course durations -->
        <div class="row col-11 what-learn">
          <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div class="text-h6 col-8 q-mb-md">ماذا ستتعلم</div>
          <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 course-description__section bg-grey-1 q-pa-xl" >
            <div class="col-11 requirment">
              <div
                class="text-h6 q-ml-xs"
              >متطلبات الدورة
              </div>
              <div
                class="text-grey-4 text-body1 q-mb-lg"
                style="margin-right:-17px;"
                v-html="courseData.requirement"
              >
              </div>
              <div
                class="text-h6">وصف الدورة</div>
              <div
                class="text-body1 text-grey-4"
                v-html="courseData.description"
              >
              </div>
              <div
                class="text-h6">وصف الدورة</div>
              <div
                class="toggle-show1 text-body1 text-grey-4 q-my-none"
                :class="{
                  'toggle-show1-no-gradient': isShowAll
                }"
                 v-html="courseData.targeted_skills"
              >
              </div>
              <div
                class="text-body1 col-12 text-center q-mt-sm show-more_description text-bold"
                @click="showAll"
                style="text-decoration:underline;cursor: pointer;"
              >عرض الكل
                <img
                  src="images/home-imgs/path 1234.png"
                  class="q-ml-sm"
                  style="width:10px;hegight:10px;"
                />
              </div>
            </div>
          </div>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4  course-info__section">
            <div class="text-h6 q-mb-md q-ml-lg course-info_title">معلومات الدورة</div>
            <div
              class="column justify-between no-wrap course-info q-ml-lg self-end justify-end"
            >
              <q-img :src="courseData.image" style="height:245px;width:100%;border-radius:4px 4px 0px 0px">
                <div class="absolute-full flex flex-center dimmed"></div>
                <img src="images/home-imgs/info-player.png" class="absolute-center flex flex-center" style="width:25px;height:25px;">
              </q-img>
                <div class="text-h6 q-mt-lg q-mb-md q-ml-lg">تشمل هذه الدورة:</div>
                <div class="row no-wrap q-ml-lg q-mb-md">
                  <div class="col-6 inline-block">
                    <img
                      src="images/Path 9266.png"
                      :class="{
                        'icon-lg': !$q.screen.lt.sm,
                        'icon-sm': $q.screen.lt.sm
                      }"
                    />
                    <div
                      class="inline-block text-grey-5"
                      :class="{
                        'text-subtitle2': !$q.screen.lt.sm,
                        'text-caption': $q.screen.lt.sm,
                        'q-ml-md': true
                      }"
                    >عدد الايام:</div>
                  </div>
                  <div class="col-6">
                    <div
                      class="text-grey-4"
                      :class="{
                        'text-subtitle2': !$q.screen.lt.sm,
                        'text-caption': $q.screen.lt.sm,
                      }"
                    >{{courseData.days_number}}يوم</div>
                  </div>
                </div>
                <div class="row q-ml-lg q-mb-md">
                  <div class="col-6">
                    <img
                      src="images/Box/duration.png"
                      :class="{
                        'icon-lg': !$q.screen.lt.sm,
                        'icon-sm': $q.screen.lt.sm
                      }"
                    />
                    <div
                      class="inline-block text-grey-5"
                      :class="{
                        'text-subtitle2': !$q.screen.lt.sm,
                        'text-caption': $q.screen.lt.sm,
                        'q-ml-md': true
                      }"
                    >   وقت الدورة:</div>
                  </div>
                  <div class="col-6">
                    <div
                      class="text-grey-4"
                      :class="{
                        'text-subtitle2': !$q.screen.lt.sm,
                        'text-caption': $q.screen.lt.sm,
                        'q-ml-sm': true
                      }"
                    >{{calcTime(courseData.duration)}} ساعة</div>
                  </div>
                </div>
                <div class="row q-ml-lg q-mb-md">
                  <div class="col-6">
                    <img
                      src="images/Box/play-icon.png"
                      :class="{
                        'icon-lg': !$q.screen.lt.sm,
                        'icon-sm': $q.screen.lt.sm
                      }"
                    />
                    <div
                      class="inline-block text-grey-5"
                      :class="{
                        'text-subtitle2': !$q.screen.lt.sm,
                        'text-caption': $q.screen.lt.sm,
                        'q-ml-md': true
                      }"
                    >عدد الدروس:</div>
                  </div>
                  <div class="col-6">
                    <div
                      class="text-grey-4"
                      :class="{
                        'text-subtitle2': !$q.screen.lt.sm,
                        'text-caption': $q.screen.lt.sm,
                        'q-ml-sm': true
                      }"
                    >{{courseData.sessions}} درس</div>
                  </div>
                </div>
                <div class="row q-ml-lg q-mb-lg">
                  <div class="col-6">
                    <img
                      src="images/Box/Path 8197.png"
                      :class="{
                        'icon-lg': !$q.screen.lt.sm,
                        'icon-sm': $q.screen.lt.sm
                      }"
                    />
                    <div
                      class="inline-block text-grey-5"
                      :class="{
                        'text-subtitle2': !$q.screen.lt.sm,
                        'text-caption': $q.screen.lt.sm,
                        'q-ml-md': true
                      }"
                    >عدد الطلاب:</div>
                  </div>
                  <div class="col-6">
                    <div
                      class="text-grey-4"
                      :class="{
                        'text-subtitle2': !$q.screen.lt.sm,
                        'text-caption': $q.screen.lt.sm,
                        'q-ml-sm': true
                      }"
                    > {{courseData.student_number}} طالب</div>
                  </div>
                </div>
                <div class="row q-ml-lg q-mb-md">
                  <div class="col-1">
                    <img
                      src="images/Box/hash.png"
                      :class="{
                        'icon-lg': !$q.screen.lt.sm,
                        'icon-sm': $q.screen.lt.sm
                      }"
                    />
                  </div>
                  <div class="col-11 q-pr-xl">
                    <div class="text-subtitle1 branch">النحو</div>
                    <div class="text-subtitle1 branch">القرآن</div>
                    <div class="text-subtitle1 branch">الفصاحة</div>
                    <div class="text-subtitle1 branch">المعرفة</div>
                    <div class="text-subtitle1 branch">الشعر</div>
                  </div>
                </div>
                <div class="row no-wrap q-mx-auto q-my-xl">
                  <div
                    class="text-grey-4"
                    :class="$q.screen.lt.md ? 'text-caption' : 'text-subtitle1'"
                  >{{getRate}}</div>
                  <star-rating
                    read-only
                    :increment=0.5
                    :rating='courseData.rate.rate_average'
                    :star-size="$q.screen.lt.md ? 13 : 20"
                    :padding="$q.screen.lt.md ? 3 : 5"
                    :active-color="['#e49d1a']"
                    :show-rating=false
                    :rtl=true
                  ></star-rating>
                  <div
                    class="text-grey-4 q-ml-sm"
                    :class="$q.screen.lt.md ? 'text-caption' : 'text-subtitle1'"
                  >({{courseData.rate.voters}})</div>
                </div>
                <q-btn
                  :label='buttonTitleState'
                  size='lg'
                  :dense='dense'
                  class="text-grey-5 bg-green q-mx-auto q-my-lg"
                  @click="joinCourse"
                  style="width:85%"
                ></q-btn>
            </div>
          </div>
        </div>

        <!-- Start Course Classes description -->
        <course-dates></course-dates>
        <!-- Start About Teacher -->
        <about-teacher></about-teacher>
        <!-- Start About Teacher -->
        <the-comments></the-comments>
    </div>
    <!-- End Course info Main Section -->
  </div>
</template>

<script>
import { calcDuration, dateFormat } from 'src/utils/global.js'
import StarRating from 'vue-star-rating'
import CourseDates from '../components/CourseDates.vue'
import AboutTeacher from '../components/AboutTeacher.vue'
import TheComments from '../components/TheComments.vue'
export default {
  components: { StarRating, CourseDates, AboutTeacher, TheComments },
  data () {
    return {
      date: '2019/02/01',
      dense: false,
      step: 1,
      isShowAll: false
    }
  },
  methods: {
    joinCourse () {
      const courseId = this.$route.params.id
      this.$store.dispatch('student/joinCourse', courseId)
    },
    showAll () {
      this.isShowAll = !this.isShowAll
    },
    calcDate (timestamp) {
      const date = dateFormat(timestamp)
      return date
    },
    calcTime (timestamp) {
      const time = calcDuration(timestamp)
      return time
    },
    lastUpdate () {
      let last = []
      for (let i = 0; i < this.courseData.classes.length; i++) {
        const classes = this.courseData.classes[i].date
        const today = new Date()
        if (classes * 1000 <= today.valueOf()) {
          last = [...last, classes * 1000]
        }
      }
      const lastDate = Math.max(...last)
      return this.calcDate(lastDate / 1000)
    }
  },
  mounted () {
    const courseId = this.$route.params.id
    this.$store.dispatch('courses/coursePage', courseId)
  },
  computed: {
    courseData () {
      console.log(this.$store.getters['courses/getCoursePage'])
      return this.$store.getters['courses/getCoursePage']
    },
    isAuthed () {
      return this.$store.getters['auth/isAuthenticated']
    },
    buttonTitleState () {
      return this.isAuthed ? 'الاشتراك في الدورة' : 'الاشتراك في الدورة'
    },
    sectionImgSrc () {
      if (this.courseData.section_id === 5) {
        return '/images/home-imgs/global.png'
      }
      return '/images/home-imgs/quran-icon2.png'
    },
    getRate () {
      const rate = this.courseData.rate.rate_average
      if (rate === 0) {
        return '5/5'
      }
      return rate.toFixed(1)
    }
  }
}
</script>

<style lang='scss' scoped>
.main-div{
  overflow-y: hidden;
    .icon-lg {
    width: 15px;
    height: 15px;
  }
  .icon-sm {
    width: 10px;
    height: 10px;
  }
  .hide{
    display: none;
  }
  .show{
    display: block;
  }
}
.blue-section{
  background: #2B5078;
  background-image: radial-gradient(#FAFAFA 0.7%, transparent 1%), radial-gradient(#FAFAFA 0.8%, transparent 1%);
  background-position: 0 0, 180px 50px;
  background-size: 120px 100px;
  height: 430px;
  @media (max-width:480px) {
    height: 572px;
  }
}
.btns-section{
  height: 150px;
}
.main-title{
  font-size: calc(1.5rem + 1vw);
  font-weight: bold;
  @media (max-width:480px) {
    font-size: calc(1.1rem + 1vw);
  }
}
.sub-title{
  font-size: calc(0.4rem + 1vw);
  @media (max-width:480px) {
    font-size: calc(0.7rem + 1vw);
  }
  font-weight: bold;
}
.main-section__btn{
  border: 1px solid #fff;
  border-radius: 4px;
  .btn-text{
  @media (max-width: 480px){
      font-size: 15px !important;
    }
  }
  .btn-icon{
    width: 20px;
    height: 20px;
  }
}
.course-description__section{
  border-radius: 4px;
  box-shadow: 0px 0px 0px 2px rgba(0, 0, 0, 5%);
  @media (max-width:480px) {
    padding-left: 25px;
    padding-right: 25px;
  }
  .toggle-show{
    display: none;
  }
  .show-hidden-item{
    display: block;
  }
}
.course-info__section{
  .course-info{
    @media (max-width:480px) {
      margin: 0px;
    }
    border-radius: 4px;
    box-shadow: 0px 0px 0px 2px rgba(0, 0, 0, 5%);
    background: #fff;
  }
  .course-info_title{
    @media (max-width:480px) {
      margin-left: 0px;
      margin-top: 25px;
    }
  }
  .branch{
    background: #EEE;
    color: $grey-5;
    width: 65px;
    height: 30px;
    border-radius: 4px;
    margin: 0px 5px 5px 5px;
    display: inline-block;
    text-align: center;
  }
}
.vue-star-rating{
  &::v-deep{
    .sr-only[data-v-fde73a0c] {
      position: absolute;
      left: 0px;
      top: auto;
      width: 1px;
      height: 1px;
      overflow: hidden;
    }
  }
}
.toggle-show1{
    mask-image: -webkit-gradient(linear, left top,
    left bottom, from(rgba(1,1,1,1)), to(rgba(1,1,1,0)));
}
.toggle-show1-no-gradient{
  mask-image: -webkit-gradient(linear, left top,
  left bottom, from(rgba(1,1,1,1)), to(rgba(1,1,1,1)));
}
</style>
