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
          <!-- {{fullDate(courseData.classes[0].date)}} -->
          {{fullDate(todayDate)}}
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
            class="col-12 bg-white q-py-lg q-px-lg rounded-borders"
          >
            <table>
              <tr>
                <th
                  roll="gridcell"
                  class="table-head"
                  v-for='day in getDayDates(courseData.start_at , x - 1)'
                  :key='day'
                >
                  {{getDayName(day /1000)}}
                </th>
                <!-- <th
                  class="table-head"
                  v-for='day in daysName'
                  :key='day'
                >
                  {{day}}
                </th> -->
              </tr>
              <tr>
                <td
                  v-for="day in getDayDates(courseData.start_at, x - 1)"
                  :key="day"
                  :class="{'text-grey-3': future || past, 'text-dark': today}"
                  class="text-weight-thin table-head q-mb-lg q-pb-lg"
                  style="font-size:12px;"
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
                <td
                  class="text-body1"
                  v-for="(lecture) in startClassTime(x-1)"
                  :key="lecture"
                  :rowspan="(lecture === 'عطلة') ? 2 : undefined"
                  :class="{
                    'green-active': today,
                    'inactive': past,
                    'green-line-active': (future && lecture !== 'عطلة' ),
                    'off': (lecture === 'عطلة')
                  }"
                >
                  {{lecture}}
                </td>
              </tr>
              <tr>
                <td
                  class="text-body1"
                  v-for="(lecture) in endClassTime(x-1)"
                  :key="lecture"
                  :class="{
                    'hidden': (lecture === 'عطلة'),
                    'red-active': today,
                    'inactive': past,
                    'red-line-active': (future && lecture !== 'عطلة' )
                  }"
                >
                  {{lecture}}
                </td>
                <!-- <td class="inactive text-body1"> 5:30 م</td>
                <td class="inactive text-body1"> 5:30 م</td>
                <td class="inactive text-body1"> 5:30 م</td>
                <td class="red-active text-body1"> 5:30 م</td>
                <td class="red-line-active text-body1"> 5:30 م</td>
                <td class="red-line-active text-body1"> 5:30 م</td> -->
              </tr>

            </table>
          </div>
        </q-carousel-slide>
      </q-carousel>

      <div
        class="col-12 row q-mt-sm text-grey-4"
      >
        <div class="col-2 text-body1">
          <div class="green-dot"></div>انجزت: {{courseData.classes.length + 3}} يوم
        </div>
        <div class="col-8 text-body1">
          <div class="red-dot"></div>يتبقى: 18 يوم على انتهاء الدورة
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { dateFormatz, dateDay, dateFormat, getClassStartTime } from 'src/utils/global.js'
export default {
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
  },
  data () {
    return {
      slide: 1,
      classesTime: [],
      daysName: ['السبت', 'الأحد', 'الأثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة'],
      times: ['عطلة', 'عطلة', 'عطلة', 'عطلة', 'عطلة', 'عطلة', 'عطلة'],
      past: false,
      future: false,
      today: false,
      todayDate: new Date(),
      mappedDate: {
        4: 0,
        5: 1,
        6: 2,
        0: 3,
        1: 4,
        2: 5,
        3: 6
      }
    }
  },
  methods: {
    convertDate (timestamp) {
      const date = new Date(timestamp * 1000)
      return date
    },
    fullDate () {
      // const classDay = dateFormat(classDate)
      const today = new Date()
      return dateFormat(today.getTime() / 1000)
      // return classDay
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
        dates = [...dates, new Date(start)]
        start.setDate(start.getDate() + 1)
      }
      return dates
    },
    startClassTime (weekNumber) {
      const start = new Date(this.courseData.start_at * 1000)
      start.setDate(start.getDate() + weekNumber * 7)

      const endDate = new Date(start)
      endDate.setDate(start.getDate() + 7)

      for (let i = 0; i < this.courseData.classes.length; i++) {
        const classT = this.courseData.classes[i]
        const pastFuture = new Date(classT.date * 1000)
        const today = new Date()
        if (pastFuture < today) {
          this.past = true
        } else if (pastFuture > today) {
          this.future = true
        } else {
          this.today = true
        }
        if (classT.date * 1000 >= start.valueOf() && classT.date * 1000 < endDate.valueOf()) {
          this.times[this.mappedDate[classT.day_id]] = getClassStartTime(classT.from)
        }
      }
      return this.times
    },
    endClassTime (weekNumber) {
      const start = new Date(this.courseData.start_at * 1000)
      start.setDate(start.getDate() + weekNumber * 7)

      const endDate = new Date(start)
      endDate.setDate(start.getDate() + 7)

      for (let i = 0; i < this.courseData.classes.length; i++) {
        const classT = this.courseData.classes[i]
        const pastFuture = new Date(classT.date * 1000)
        const today = new Date()
        if (pastFuture < today) {
          this.past = true
        } else if (pastFuture > today) {
          this.future = true
        } else {
          this.today = true
        }
        if (classT.date * 1000 >= start.valueOf() && classT.date * 1000 < endDate.valueOf()) {
          this.times[this.mappedDate[classT.day_id]] = getClassStartTime(classT.to)
        }
      }
      return this.times
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
  th,td{
    width: 150px !important;
  }

  .green-active{
    padding: 10px 13px;
    color: $green;
    background: #DCF8EA;
    border-right: 3px solid $green;
    border-radius: 4px
  }
  .green-line-active{
    padding: 10px 23px;
    border: 2px solid #DCF8EA;
    border-radius: 4px;
    color: $dark
  }
  .inactive{
    padding: 10px 13px;
    color:$grey-3;
  }
  .red-active{
    background: #FDE3E3;
    padding: 10px 13px;
    color: #F15252;
    border-right: 3px solid #F15252;
    border-radius: 4px;
  }
  .red-line-active{
    padding: 10px 13px;
    border: 2px solid #FDE3E3;
    border-radius: 4px;
    color: $dark
  }
  .off{
    padding: 0px 13px;
    background: $grey-1;
    border-radius: 4px;
    color: $dark
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
