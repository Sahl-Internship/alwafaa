<template>
  <q-card class="course-card">
    <q-img
      :src="course.image"
      :class="$q.screen.lt.md ? 'img-height-sm' : 'img-height-lg'"
    >
      <div
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
            >{{ course.teacher.name }}</div>
          </div>

          <div class="col-12 row items-center">
            <img
              :src="sectionImgSrc"
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
            >{{ course.section }}</div>
          </div>
        </div>

        <div class="row">
          <div
            :class="{
              'q-px-sm rounded-borders': true,
              'text-subtitle2 q-py-xs': !$q.screen.lt.sm,
              'text-caption': $q.screen.lt.sm,
              'text-grey-5 bg-green': course.status === 0,
              'text-grey-4 bg-grey-2': course.status === 2,
              'text-white bg-red': course.status === 1,
            }"
          >
            {{ $t(`coursesList.${courseStatus}`) }}
          </div>
        </div>

      </div>
    </q-img>

    <q-card-section
      class="row justify-center items-center"
      :class="{
        'section-height-lg q-pa-xl': !$q.screen.lt.md,
        'section-height-sm q-px-none': $q.screen.lt.md,
      }"
    >
      <q-btn
        flat
        :to="'/courses/'+course.id"
        class="col-12 course-title"
      >
        <div
          class="text-grey-5 text-center ellipsis-2-lines"
          :class="{
            'text-h6 text-weight-bold': !$q.screen.lt.md,
            'text-subtitle2': $q.screen.lt.md,
          }"
        >
          {{ course.title }}
        </div>
      </q-btn>

      <div class="col-12 row justify-center q-mt-sm">
        <div
          class="text-grey-4"
          :class="{
            'text-subtitle1': !$q.screen.lt.md,
            'text-caption' : $q.screen.lt.md,
            'text-grey-3': course.rate.rate_average === 0
          }"
        >{{ getRate }}</div>

        <star-rating
          read-only
          :increment=0.5
          :rating="course.rate.rate_average"
          :star-size="$q.screen.lt.md ? 13 : 20"
          :padding="$q.screen.lt.md ? 3 : 5"
          :active-color="['#e49d1a']"
          :show-rating=false
          :rtl=true
        ></star-rating>

        <div
          class="text-grey-4 q-ml-sm"
          :class="$q.screen.lt.md ? 'text-caption' : 'text-subtitle1'"
        >({{course.rate.voters}})</div>
      </div>
    </q-card-section>

    <q-card-section
      class="row justify-between items-center rounded-borders bottom-section"
      :class="$q.screen.lt.md ? 'bottom-section-sm q-py-sm' : 'q-px-lg'"
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
        >{{ course.sessions }}</div>
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
        >{{ courseDuration }}</div>
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
        >{{ course.student_number }}</div>
      </div>
    </q-card-section>
  </q-card>
</template>

<script>
import StarRating from 'vue-star-rating'
import { calcDuration } from 'src/utils/global.js'

export default {
  components: { StarRating },
  props: {
    course: {
      type: Object
    }
  },
  computed: {
    isAuthenticated () {
      return this.$store.getters['auth/isAuthenticated']
    },
    sectionImgSrc () {
      if (this.course.section_id === 5) {
        return '/images/home-imgs/global.png'
      }
      return '/images/home-imgs/quran-icon2.png'
    },
    courseStatus () {
      // const today = new Date().getTime() / 1000
      // const { start_at: startAt, end_at: endAt } = this.course
      const { status } = this.course

      if (status === 0) {
        return 'notStarted'
      } else if (status === 2) {
        return 'finished'
      }
      return 'started'
    },
    courseDuration () {
      return calcDuration(this.course.duration)
    },
    getRate () {
      const rate = this.course.rate.rate_average
      if (rate === 0) {
        return '5/5'
      } else if (!Number.isInteger(rate)) {
        const rateAsString = rate.toString().split('.')
        const floatNum = rateAsString[1].toString()[0]

        return floatNum < 5 ? `${rateAsString[0]}.0` : `${rateAsString[0]}.5`
      }
      return `${rate}.0`
    }
  }
}
</script>

<style lang="scss" scoped>
.course-card {
  width: 31.3%;
  min-width: 155px;

  .img-height-lg {
    height: 218px;
  }

  .img-height-sm {
    height: 170px;
  }

  .section-height-lg {
    height: 190px;
  }

  .section-height-sm {
    height: 120px;
  }

  .icon-lg {
    width: 15px;
    height: 15px;
  }

  .icon-sm {
    width: 10px;
    height: 10px;
  }
}

@media (max-width: 1290px) and (min-width: 1024px) {
  .course-card {
    width: 30.75%;
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
