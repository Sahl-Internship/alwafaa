
<template>
  <div class="row col-11" >
    <div class="text-h6 col-8 q-mt-xl q-mb-md">مواعيد الدورة</div>
    <div
      class="col-xs-12 col-sm-12 col-md-8 col-lg-8 row bg-grey-1 q-px-lg q-py-lg"
    >
      <div
        class="col-6 row q-mb-md"
      >
        <div class="text-h6 col-3 text-grey-4 q-ml-sm">اليوم</div>
        <div
          class="text-h6 col-6 text-grey-4"
        >
          <span
            class="material-icons"
            style="font-size:25px;cursor: pointer;"
            @click="$refs.carousel.previous()"
          >
            keyboard_arrow_right
          </span>
          {{fullDate(courseData.classes[0].date)}}
          <span
            class="material-icons"
            style="font-size:25px;cursor: pointer;"
            @click="$refs.carousel.next()"
          >
            keyboard_arrow_left
          </span>
        </div>
      </div>
      <div class="col-6">
        <div
          class="text-body1 text-right text-grey-4 q-mr-md"
          style="cursor: pointer;text-decoration:underline"
        > عرض الكل
        </div>
      </div>
      <q-carousel
        swipeable
        animated
        v-model="slide"
        ref="carousel"
        class="carousel q-mx-auto"
      >
        <q-carousel-slide
          :name="x"
          v-for="x in numberOfWeeks"
          :key="x"
        >
          <div
            class="col-12 bg-white q-py-lg q-px-xl rounded-borders"
          >
            <table>
              <tr>
                <th
                  class="table-head"
                  v-for='day in getDayDates(courseData.start_at , x - 1)'
                  :key='day'
                >
                  {{getDayName(day /1000)}}
                </th>
              </tr>
              <tr>
                <td
                  v-for="day in getDayDates(courseData.start_at, x - 1)"
                  :key="day"
                  class="text-weight-thin inactive table-head"
                  style="font-size:12px"
                >
                  {{getClassDate(day / 1000)}}
                </td>
              </tr>
              <tr>
                <!-- <td class="inactive text-body1"> 5:30 م</td>
                <td class="inactive text-body1"> 5:30 م</td>
                <td class="inactive text-body1"> 5:30 م</td>
                <td class="green-active text-body1"> 5:30 م</td>
                <td class="green-line-active text-body1"> 5:30 م</td>
                <td class="green-line-active text-body1"> 5:30 م</td>
                <td rowspan='2' class="off text-h6">
                  عطلة
                </td> -->
                <!-- <td
                  class="text-body1"
                  v-for="(lecture) in classesTime"
                  :key="lecture"
                >
                  {{(lecture.from)}}
                </td> -->
              </tr>
              <tr>
                <td class="inactive text-body1"> 5:30 م</td>
                <td class="inactive text-body1"> 5:30 م</td>
                <td class="inactive text-body1"> 5:30 م</td>
                <td class="red-active text-body1"> 5:30 م</td>
                <td class="red-line-active text-body1"> 5:30 م</td>
                <td class="red-line-active text-body1"> 5:30 م</td>
              </tr>

            </table>
          </div>
        </q-carousel-slide>
      </q-carousel>

      <div
        class="col-12 row q-mt-sm text-grey-4"
      >
        <div class="col-2 text-body1">
          <div class="green-dot"></div>انجزت: 36 يوم
        </div>
        <div class="col-8 text-body1">
          <div class="red-dot"></div>يتبقى: 18 يوم على انتهاء الدورة
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { dateFormatz, dateDay, dateFormat } from 'src/utils/global.js'
export default {
  data () {
    return {
      slide: 1,
      classesTime: []
    }
  },
  methods: {
    convertDate (timestamp) {
      const date = new Date(timestamp * 1000)
      return date
    },
    fullDate (classDate) {
      const classDay = dateFormat(classDate)
      return classDay
    },
    // For get month date name and day date
    getClassDate (classDate) {
      const classDay = dateFormatz(classDate)
      return classDay
    },
    // For get Day Name
    getDayName (classDate) {
      const day = dateDay(classDate)
      return day
    },
    // To get all days between start and end date
    getDayDates (startDate, weekNumber) {
      const start = new Date(startDate * 1000)
      start.setDate(start.getDate() + weekNumber * 7)

      const endDate = new Date(start)
      endDate.setDate(start.getDate() + 7)

      let dates = []
      // eslint-disable-next-line no-unmodified-loop-condition
      while (start < endDate) {
        this.courseData.classes.forEach(classTime => {
          console.log('class time', classTime.date * 1000)
          console.log('start', start.getTime())
          if (classTime.date * 1000 === start.getTime()) {
            this.classesTime = [...this.classesTime, classTime]
          }
        })
        dates = [...dates, new Date(start)]
        start.setDate(start.getDate() + 1)
      }
      console.log('dates', dates)
      console.log('classes', this.classesTime)
      return dates
    }
    // ,
    // getClassStartTime (from) {
    //   // eslint-disable-next-line no-unmodified-loop-condition
    //   const date = new Date(from * 1000)
    //   let hour = date.getHours()
    //   let min = date.getMinutes()
    //   const ampm = hour >= 12 ? 'م' : 'ص'
    //   hour = hour % 12
    //   hour = hour || 12 // the hour '0' should be '12'
    //   min = min < 10 ? '0' + min : min
    //   const time = hour + ':' + min + ' ' + ampm
    //   return time
    // }
  },
  computed: {
    isAuthed () {
      return this.$store.getters['auth/isAuthenticated']
    },
    courseData () {
      return this.$store.getters['courses/getCoursePage']
    },
    numberOfWeeks () {
      const end = this.convertDate(this.courseData.end_at)
      const start = this.convertDate(this.courseData.start_at)
      const weeks = (1000 * 60 * 60 * 24 * 7)
      const diff = end - start
      const result = Math.ceil(diff / weeks)
      console.log(result)
      return result
    }
  }
}
</script>
<style lang='scss' scoped>
table{
  border-collapse: separate;
  border-spacing: 7px;
  text-align: center;
  box-sizing: border-box;
  .table-head{
    // width: 150px !important;
    padding: 0px 24px;
  }

  .green-active{
    padding: 10px 20px;
    color: $green;
    background: #DCF8EA;
    border-right: 3px solid $green;
    border-radius: 4px
  }
  .green-line-active{
    padding: 10px 20px;
    border: 2px solid #DCF8EA;
    border-radius: 4px
  }
  .inactive{
    padding: 10px 20px;
    color:$grey-3;
  }
  .red-active{
    background: #FDE3E3;
    padding: 10px 20px;
    color: #F15252;
    border-right: 3px solid #F15252;
    border-radius: 4px;
  }
  .red-line-active{
    padding: 10px 20px;
    border: 2px solid #FDE3E3;
    border-radius: 4px;
  }
  .off{
    padding: 0px 20px;
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
