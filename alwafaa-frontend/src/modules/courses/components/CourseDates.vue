<template>
  <div class="row col-11" >
    <div class="text-h6 col-8 q-mt-xl q-mb-md">مواعيد الدورة</div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 row course-classes__timeline bg-grey-1 q-px-lg q-py-lg">
      <div class="col-6 row q-mb-md">
        <div class="text-h6 col-3 text-grey-4">اليوم</div>
        <div class="text-h6 col-6 text-grey-4">
          <span class="material-icons" style="font-size:25px;cursor: pointer;" @click="$refs.carousel.next()">keyboard_arrow_right</span>
          8 يناير 2021
          <span class="material-icons" style="font-size:25px;cursor: pointer;" @click="$refs.carousel.previous()">keyboard_arrow_left</span>
        </div>
      </div>
      <div class="col-6">
        <div class="text-body1 text-right text-grey-4" style="cursor: pointer;text-decoration:underline">عرض الكل</div>
      </div>
    <q-carousel
      swipeable
      animated
      v-model="slide"
      ref="carousel"
      class="carousel"
    >
      <q-carousel-slide :name="x" v-for="x in numberOfWeeks" :key="x">
      <div class="col-12 bg-white q-py-lg q-px-lg">
        <table class="q-mx-auto" >
          <tr>
            <th class="table-head">السبت   <span class="block text-weight-thin" style="font-size:12px">5 يناير</span></th>
            <th class="table-head">الاحد    <span class="block text-weight-thin" style="font-size:12px">6 يناير</span></th>
            <th class="table-head">الاثنين  <span class="block text-weight-thin" style="font-size:12px">7 يناير</span></th>
            <th class="table-head">الثلاثاء <span class="block text-weight-thin" style="font-size:12px">8 يناير</span></th>
            <th class="table-head">الاربعاء <span class="block text-weight-thin" style="font-size:12px">9 يناير</span></th>
            <th class="table-head">الخميس  <span class="block text-weight-thin" style="font-size:12px">10 يناير</span></th>
            <th class="table-head">الجمعة  <span class="block text-weight-thin" style="font-size:12px">11 يناير</span></th>
          </tr>
          <tr>
            <td class="inactive text-body1">05:30 م</td>
            <td class="inactive text-body1">05:30 م</td>
            <td class="inactive text-body1">05:30 م</td>
            <td class="green-active text-body1">05:30 م</td>
            <td class="green-line-active text-body1">05:30 م</td>
            <td class="green-line-active text-body1">05:30 م</td>
            <td rowspan='2' class="off text-h6">
              عطلة
            </td>
          </tr>
          <tr>
            <td class="inactive text-body1">05:30 م</td>
            <td class="inactive text-body1">05:30 م</td>
            <td class="inactive text-body1">05:30 م</td>
            <td class="red-active text-body1">05:30 م</td>
            <td class="red-line-active text-body1">05:30 م</td>
            <td class="red-line-active text-body1">05:30 م</td>
          </tr>

        </table>
      </div>
      </q-carousel-slide>
    </q-carousel>

      <div class="col-12 row q-mt-sm text-grey-4">
        <div class="col-2 text-body1"><div class="green-dot"></div>انجزت: 36 يوم </div>
        <div class="col-8 text-body1"><div class="red-dot"></div>يتبقى: 18 يوم على انتهاء الدورة </div>
      </div>
    </div>
  </div>
</template>
<script>
// import { dateFormat } from 'src/utils/global.js'
export default {
  data () {
    return {
      slide: 1
    }
  },
  methods: {
    getDate (timestamp) {
      const date = new Date(timestamp * 1000)
      console.log(date)
      return date
    }
  },
  computed: {
    isAuthed () {
      return this.$store.getters['auth/isAuthenticated']
    },
    courseData () {
      return this.$store.getters['courses/getCoursePage']
    },
    numberOfWeeks () {
      const end = this.getDate(this.courseData.end_at)
      const start = this.getDate(this.courseData.start_at)
      const weeks = (1000 * 60 * 60 * 24 * 7)
      const diff = end - start
      const result = Math.floor(diff / weeks)
      return result
    }
  }
}
</script>
<style lang='scss' scoped>
table{
  border-collapse: separate;
  border-spacing: 7px;
  .table-head{
    padding: 13px 20px;
  }
  .green-active{
    padding: 13px 20px;
    color: $green;
    background: #DCF8EA;
    border-right: 3px solid $green;
    border-radius: 4px
  }
  .green-line-active{
    padding: 13px 20px;
    border: 2px solid #DCF8EA;
    border-radius: 4px
  }
  .inactive{
    padding: 13px 20px;
    color:$grey-3;
  }
  .red-active{
    background: #FDE3E3;
    padding: 13px 20px;
    color: #F15252;
    border-right: 3px solid #F15252;
    border-radius: 4px;
  }
  .red-line-active{
    padding: 13px 25px;
    border: 2px solid #FDE3E3;
    border-radius: 4px;
  }
  .off{
    padding: 30px 20px;
    background: $grey-1;
    border-radius: 4px
  }
}
.green-dot{
  width:8px;
  height: 8px;
  border-radius: 50%;
  background: $grey-4;
  display: inline-block;
  margin-right: 4px;
}
.red-dot{
  width:8px;
  height: 8px;
  border-radius: 50%;
  background: #FFC003;
  display: inline-block;
  margin-right: 4px;
}
.carousel {
  height: auto;
  &::v-deep{
    .q-carousel__slide{
      padding: 0px;
    }
  }
}
</style>
