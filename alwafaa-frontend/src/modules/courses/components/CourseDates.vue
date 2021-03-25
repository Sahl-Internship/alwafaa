<template>
  <div class="row col-11" >
    <div class="text-h6 col-8 q-mt-xl q-mb-md">مواعيد الدورة</div>
    <div
      class="col-xs-12 col-sm-12 col-md-8 col-lg-8 row bg-grey-1 q-px-lg q-py-lg rounded-border"
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
          @click="dialog = true"
        > عرض الكل
        </div>
        <!-- Start Dialog -->
          <div class="q-pa-md q-gutter-sm">
            <q-dialog
              v-model="dialog"
              persistent
              :maximized="maximizedToggle"
              transition-show="slide-up"
              transition-hide="slide-down"
            >
              <q-card class="bg-grey-1 text-white">
                <q-bar>
                  <q-space />

                  <q-btn dense flat icon="minimize" @click="maximizedToggle = false" :disable="!maximizedToggle">
                    <q-tooltip v-if="maximizedToggle" content-class="bg-white text-primary">Minimize</q-tooltip>
                  </q-btn>
                  <q-btn dense flat icon="crop_square" @click="maximizedToggle = true" :disable="maximizedToggle">
                    <q-tooltip v-if="!maximizedToggle" content-class="bg-white text-primary">Maximize</q-tooltip>
                  </q-btn>
                  <q-btn dense flat icon="close" v-close-popup>
                    <q-tooltip content-class="bg-white text-primary">Close</q-tooltip>
                  </q-btn>
                </q-bar>
                <q-card-section class="q-pt-none">
                <div
                  :name="x"
                  v-for="x in numberOfWeeks"
                  :key="x"
                  class="row "
                >
                  <div
                    class="col-8 bg-white q-py-lg q-px-lg q-mx-auto q-my-sm rounded-border dialog"
                  >
                    <table>
                      <tr>
                        <th
                          roll="gridcell"
                          class="table-head text-dark"
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
                          :class="{'text-grey-3': future || past, 'text-dark': today}"
                          class="text-weight-thin table-head q-mb-lg q-pb-lg"
                          style="font-size:12px;"
                        >
                          {{getClassDate(day / 1000)}}
                        </td>
                      </tr>
                      <!-- Class Start Time -->
                      <tr>
                        <td
                          class="text-body1"
                          v-for="(lecture) in startClassTime(x-1)"
                          :key="lecture"
                          :rowspan="(lecture === 'عطلة') ? 2 : undefined"
                          :class="{
                            'off': (lecture === 'عطلة'),
                            'green-active': today,
                            'inactive': past,
                            'green-line-active': (future && lecture !== 'عطلة' ),

                          }"
                        >
                          {{lecture}}
                        </td>
                      </tr>
                      <!-- Clas End Time -->
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
                      </tr>

                    </table>
                  </div>
                </div>
                </q-card-section>
              </q-card>
            </q-dialog>
          </div>
        <!-- End Dialog -->
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
            class="col-12 bg-white q-py-lg q-px-lg rounded-border"
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
                    'off': (lecture === 'عطلة'),
                    'green-active': (today),
                    'inactive': past && (!today || !future) ,
                    'green-line-active': future &&  lecture !== 'عطلة' && (!today || !past),

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
          <div class="green-dot"></div>انجزت:{{acheivment().acheivedDays}}  يوم
        </div>
        <div class="col-8 text-body1">
          <div class="red-dot"></div>يتبقى: {{acheivment().restDays}} يوم على انتهاء الدورة
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
      return result
    }
  },
  data () {
    return {
      dialog: false,
      maximizedToggle: true,
      slide: 1,
      classesTime: [],
      daysName: ['السبت', 'الأحد', 'الأثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة'],
      times: ['عطلة', 'عطلة', 'عطلة', 'عطلة', 'عطلة', 'عطلة', 'عطلة'],
      past: false,
      future: false,
      todayStatus: false,
      todayDate: new Date()
    }
  },
  methods: {
    mappedDate () {
      const x = {}
      const startDate = parseInt(this.courseData.classes[0].day_id)
      x[startDate] = 0
      for (let i = 1; i <= 6; i++) {
        x[(startDate + i) % 7] = i
      }
      return x
    },
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
    // To get Class Start time
    startClassTime (weekNumber) {
      const start = new Date(this.courseData.start_at * 1000)
      start.setDate(start.getDate() + weekNumber * 7)

      const endDate = new Date(start)
      endDate.setDate(start.getDate() + 7)
      const mapped = this.mappedDate()
      for (let i = 0; i < this.courseData.classes.length; i++) {
        const classT = this.courseData.classes[i]
        const pastFuture = new Date(classT.date * 1000)
        const today = new Date()
        if (pastFuture < today) {
          this.past = true
        } else if (pastFuture > today) {
          this.future = true
        } else if (pastFuture.setHours(0, 0, 0, 0) === today.setHours(0, 0, 0, 0)) {
          this.todayStatus = true
        }
        if (classT.date * 1000 >= start.valueOf() && classT.date * 1000 < endDate.valueOf()) {
          this.times[mapped[classT.day_id]] = getClassStartTime(classT.from)
        }
      }
      return this.times
    },
    // Class End time
    endClassTime (weekNumber) {
      const start = new Date(this.courseData.start_at * 1000)
      start.setDate(start.getDate() + weekNumber * 7)

      const endDate = new Date(start)
      endDate.setDate(start.getDate() + 7)
      const mapped = this.mappedDate()
      for (let i = 0; i < this.courseData.classes.length; i++) {
        const classT = this.courseData.classes[i]
        const pastFuture = new Date(classT.date * 1000)
        const today = new Date()
        if (pastFuture < today) {
          this.past = true
        } else if (pastFuture > today) {
          this.future = true
        } else if (pastFuture.setHours(0, 0, 0, 0) === today.setHours(0, 0, 0, 0)) {
          this.todayStatus = true
        }
        if (classT.date * 1000 >= start.valueOf() && classT.date * 1000 < endDate.valueOf()) {
          this.times[mapped[classT.day_id]] = getClassStartTime(classT.to)
        }
      }
      return this.times
    },
    // Acheived Course days
    acheivment () {
      const startDate = new Date(this.courseData.start_at * 1000)
      const today = new Date()
      const endDate = new Date(this.courseData.end_at * 1000)
      let acheivedDays = Math.floor((today - startDate) / (1000 * 60 * 60 * 24))
      if (acheivedDays < 0) {
        acheivedDays = 0
      }
      const restDays = (endDate - startDate) / (1000 * 60 * 60 * 24) - acheivedDays

      return { acheivedDays, restDays }
    }
  }
}
</script>
<style lang='scss' scoped>
.rounded-border{
  border-radius: 6px;
  box-shadow: 0px 0px 0px 2px rgba(0, 0, 0, 5%);
}
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
    .inactive{
    padding: 10px 13px;
    color:$grey-3;
  }
  .green-line-active{
    padding: 10px 23px;
    border: 2px solid #DCF8EA;
    border-radius: 4px;
    color: $dark
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
  border-radius: 6px;
  box-shadow: 0px 0px 0px 2px rgba(0, 0, 0, 5%);
  height: auto;
  &::v-deep{
    .q-carousel__slide{
      padding: 0px;
    }
  }
}
.dialog {
  display: inline
}
</style>
