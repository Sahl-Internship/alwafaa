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
            >د/محمد العريفي</div>
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
              'text-grey-5 bg-green': courseStatus === 'notStarted',
              'text-grey-4 bg-grey-2': courseStatus === 'finished',
              'text-white bg-red': courseStatus === 'started',
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
          :class="$q.screen.lt.md ? 'text-caption' : 'text-subtitle1'"
        >{{ course.rate.rate_average }}</div>

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
        >{{ calcDuration }}</div>
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
      if (this.course.section === 'اللغة العربية') {
        return '/images/home-imgs/global.png'
      } else if (this.course.section === 'القرآن الكريم') {
        return '/images/home-imgs/quran-icon2.png'
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
    },
    calcDuration () {
      const { duration } = this.course
      const hours = (duration / 60).toString().length > 1 ? duration / 60 : `0${duration / 60}`
      const mins = (duration - (hours * 60)).toString().length > 1 ? duration - (hours * 60) : `0${duration - (hours * 60)}`
      return `${hours}:${mins}:00`
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

// .course-title {
//   &.q-btn {
//     &::v-deep {
//       .
//     }
//   }
// }

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
