<template>
  <div class="row col-11 teacher">
    <div class="text-h6 col-8 q-mt-xl q-mb-md"> عن المعلم</div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 about-teacher bg-grey-1">
      <div class="text-h6 q-ml-lg q-mt-lg">{{courseData.name}}</div>
      <div class="text-body1 q-ml-lg q-my-sm text-grey-4">{{courseData.sub_title}}</div>
      <div class="row col-10">
        <div class="col-2 q-ml-md"><img :src="courseData.avatar" class="teacher-img"></div>
        <div class="col-9 row teacher-classes" style="margin-top:-10px;">
            <div class="col-6 q-mt-lg q-ml-md">
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
                  'text-body1': !$q.screen.lt.sm,
                  'text-caption': $q.screen.lt.sm,
                  'q-ml-md': true
                }"
              >   {{calcTime(courseData.duration)}} ساعة</div>
            </div>
            <div class="col-6 q-ml-md">
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
                  'text-body1': !$q.screen.lt.sm,
                  'text-caption': $q.screen.lt.sm,
                  'q-ml-md': true
                }"
              >   {{courseData.classes_number}} درس  </div>
            </div>
            <div class="col-6 q-ml-md">
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
                  'text-body1': !$q.screen.lt.sm,
                  'text-caption': $q.screen.lt.sm,
                  'q-ml-md': true
                }"
              >   {{courseData.students}} طالب</div>
            </div>
        </div>
      </div>
      <div class="text-body1 q-ml-lg q-mt-lg text-grey-5 toggle-show1" :class="{'toggle-show1-no-gradient':isShowTeacherInfo}">
        {{courseData.bio}}
      </div>
      <div
        class="text-body1 col-12 text-center q-my-lg show-more_description text-bold"
        @click="showTeacherInfo" style="text-decoration:underline;">عرض الكل
        <img src="images/home-imgs/path 1234.png" class="q-ml-sm" style="width:10px;hegight:10px;"/>
      </div>
    </div>
  </div>
</template>
<script>
import { dateFormat, calcDuration } from 'src/utils/global.js'
export default {
  data () {
    return {
      isShowTeacherInfo: false
    }
  },
  methods: {
    showTeacherInfo () {
      this.isShowTeacherInfo = !this.isShowTeacherInfo
    },
    calcDate (timestamp) {
      const date = dateFormat(timestamp)
      return date
    },
    calcTime (timestamp) {
      const time = calcDuration(timestamp)
      return time
    }
  },
  computed: {
    courseData () {
      const { teacher } = this.$store.getters['courses/getCoursePage']
      return teacher || {}
    }
  }
}
</script>
<style lang='scss' scoped>
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
.teacher{
  .about-teacher{
    border-radius: 8px;
    box-shadow: 0px 0px 0px 2px rgba(0, 0, 0, 5%);
  }
  .teacher-img{
    width: 120px;
    height: 120px;
    border: 5px solid #fff;
    border-radius: 50%;
    @media (max-width:480px) {
      width: 85px;
      height: 85px;
    }
  }
  .teacher-classes{
    @media (max-width:480px) {
      width: 235px;
      margin-left: 23px;
    }
  }
}
.toggle-show1{
    -webkit-mask-image: -webkit-gradient(linear, left top,
    left bottom, from(rgba(1,1,1,1)), to(rgba(1,1,1,0)));
}
.toggle-show1-no-gradient{
  -webkit-mask-image: -webkit-gradient(linear, left top,
  left bottom, from(rgba(1,1,1,1)), to(rgba(1,1,1,1)));
}
</style>
