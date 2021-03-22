<template>
  <q-card
    flat
    :class="{
      'search-card': !$q.screen.lt.sm,
      'search-card search-card-sm': $q.screen.lt.sm
    }"
  >
    <q-card-section horizontal class="row justify-start">
      <img
        :class="$q.screen.lt.sm ? 'card-img-sm' : 'card-img-lg'"
        :src="course.image"
      />

      <q-card-section
        class="col-xs-9 col-sm-10 row self-center q-pa-none"
        :class="!$q.screen.lt.sm ? 'q-ml-lg': 'q-ml-xs'"
      >
        <div class="col-xs-7 col-sm-8 row q-gutter-y-xs">
          <div
            class="col-xs-12 col-sm-6 row"
            :class="$q.screen.lt.sm ? 'q-gutter-y-xs' : 'q-gutter-y-md'"
          >
            <div
              class="col-12 text-grey-3 ellipsis"
              :class="{
                'text-h6 text-weight-bold': !$q.screen.lt.sm,
                'text-caption': $q.screen.lt.sm
              }"
            >
              {{ course.title }}
            </div>

            <div class="col-xs-12 col-sm-9 row justify-between q-gutter-y-xs">
              <div class="col-xs-12 col-sm-6 row items-center q-gutter-x-sm">
                <img
                  :src="sectionImgSrc"
                  :class="$q.screen.lt.sm ? 'section-img-sm' : 'section-img-lg'"
                />
                <div
                  class="text-grey-4"
                  :class="$q.screen.lt.sm ? 'text-sm' : 'text-subtitle1'"
                >{{ course.section }}</div>
              </div>

              <div class="col-xs-12 col-sm-6  row items-center q-gutter-x-sm">
                <img
                  src="/images/Path 9266.png"
                  :class="$q.screen.lt.sm ? 'date-img-sm' : 'date-img-lg'"
                />
                <div
                  class="text-grey-4"
                  :class="$q.screen.lt.sm ? 'text-sm' : 'text-subtitle1'"
                >{{ calcDate(course.created_at) }}</div>
              </div>
            </div>
          </div>

          <div
            class="col-xs-12 col-sm-6 row items-center"
            :class="$q.screen.lt.sm ? '' : 'justify-center'"
          >
            <q-avatar
              v-if="!$q.screen.lt.sm"
              :size="$q.screen.lt.sm ? 'xs' : 'md'"
            >
              <q-img :src="course.teacher.avatar" />
            </q-avatar>
            <div
              class="text-grey-4 q-ml-sm"
              :class="$q.screen.lt.sm ? 'text-sm' : 'text-subtitle1'"
            >{{ course.teacher.name }}</div>
          </div>
        </div>

        <div
          class="col-4 row items-center"
          :class="$q.screen.lt.sm ? 'justify-center' : 'justify-end'"
        >
          <div
            v-if="calcDate(course.start_at)"
            class="
              text-center
              q-py-xs
              rounded-borders
            "
            :class="{
              'text-subtitle1 q-px-md status-box-lg': !$q.screen.lt.sm,
              'text-sm status-box-sm': $q.screen.lt.sm,
              'text-red course-finished': courseStatus === 'finished',
              'text-blue course-start-not': courseStatus === 'notStarted'
                || courseStatus === 'started'
            }"
          >
            {{ courseStatus === 'finished'
              ? $t(`coursesList.${courseStatus}`)
              : calcDate(course.start_at)
            }}
          </div>

          <q-btn
            flat
            icon="mdi-chevron-left"
            type="button"
            :size="$q.screen.lt.sm ? 'sm' : 'md'"
            :class="$q.screen.lt.sm ? 'chevron-icon-sm' : ''"
            @click="routeToCourse"
          />
        </div>
      </q-card-section>
    </q-card-section>
  </q-card>
</template>

<script>
import { dateFormat } from 'src/utils/global.js'

export default {
  props: ['course'],
  computed: {
    sectionImgSrc () {
      if (this.course.section === 'اللغة العربية') {
        return '/images/Path 9259.png'
      } else if (this.course.section === 'القرآن الكريم') {
        return '/images/Group 5796.png'
      }
      return null
    },
    courseStatus () {
      const today = new Date().getTime() / 1000
      const { start_at: startAt, end_at: endAt } = this.course

      if (startAt > today) {
        return 'notStarted'
      } else if (today > endAt) {
        return 'finished'
      }
      return 'started'
    }
  },
  methods: {
    routeToCourse () {
      this.$emit('closeSearchDialog')
      const goToUrl = `/courses/${this.course.id}`
      this.$route.path !== goToUrl && this.$router.push(goToUrl)
    },
    calcDate (timestamp) {
      return dateFormat(timestamp)
    }
  }
}
</script>

<style lang="scss" scoped>
.search-card {
  height: 140px;

  &.search-card-sm {
    height: 100px;
  }

  .card-img-lg {
    width: 130px;
    height: 140px;
  }

  .card-img-sm {
    width: 80px;
    height: 100px;
  }

  .course-start-not {
    background: rgb(80, 148, 236);
    background: rgba(80, 148, 236, 0.1);
  }

  .course-finished {
    background: rgb(240, 64, 64);
    background: rgba(240, 64, 64, 0.1);
  }

  .status-box-lg {
    min-width: 135px;
  }

  .status-box-sm {
    min-width: 40px;
  }

  .text-sm {
    font-size: 9px;
  }

  .section-img-lg {
    width: 20px;
  }

  .section-img-sm {
    width: 10px;
  }

  .date-img-lg {
    width: 15px;
  }

  .date-img-sm {
    width: 8px;
  }

  .chevron-icon-sm {
    width: 20px;
  }
}
</style>
