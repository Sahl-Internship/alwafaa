<template>
  <q-carousel
    v-model="firstSlide"
    swipeable
    animated
    navigation
    arrows
    :height="$q.screen.lt.md ? '280px' : '320px'"
    control-type="flat"
    control-color="grey-5"
    navigation-active-icon="radio_button_unchecked"
    navigation-active-color="grey-5"
    class="text-grey-5 rounded-borders relative"
  >
    <q-carousel-slide
      :name="course.id"
      class="column no-wrap flex-center q-pa-none"
      v-for="course in completedCourses"
      :key="course.id"
    >
      <div class="achieve-icon q-pa-md">
        <img
          src="/images/Group 5535.png"
          :class="$q.screen.lt.md ? 'img-sm' : 'img-lg'"
        />
      </div>

      <div
        class="text-center text-weight-bold text-grey-5 ellipsis text-width"
        :class="$q.screen.lt.md ? 'text-h6' : 'text-h5'"
      >
        {{ course.title }}
      </div>

      <div
        class="row q-mt-lg q-mb-xl"
        :class="$q.screen.lt.md ? 'q-gutter-x-sm' : 'q-gutter-x-md'"
      >
        <div
          class="
            column
            items-center
            justify-center
            bg-grey-1
            rounded-borders
            q-gutter-y-xs
            q-my-none
            info-box
          "
          :class="$q.screen.lt.md? 'info-box-sm' : 'info-box-lg'"
        >
          <q-img
            :src="sectionImgSrc(course.section)"
            :width="$q.screen.lt.md ? '20px' : '30px'"
          />

          <div
            class="text-grey-4"
            :class="$q.screen.lt.md ? 'text-subtitle2' : 'text-subtitle1 '"
          >
            {{ course.section }}
          </div>
        </div>

        <div
          class="
            column
            items-center
            justify-center
            bg-grey-1
            rounded-borders
            q-gutter-y-xs
            q-my-none
            info-box
          "
          :class="$q.screen.lt.md? 'info-box-sm' : 'info-box-lg'"
        >
          <q-img src="/images/date_range-24px.png" :width="$q.screen.lt.md ? '20px' : '30px'" />
          <div
            class="text-grey-4"
            :class="$q.screen.lt.md ? 'text-subtitle2' : 'text-subtitle1 '"
          >
            {{ calcDate(course.start_at) }}
          </div>
        </div>

        <div
          class="
            column
            items-center
            justify-center
            bg-grey-1
            rounded-borders
            q-gutter-y-xs
            q-my-none
            info-box
          "
          :class="$q.screen.lt.md? 'info-box-sm' : 'info-box-lg'"
        >
          <q-img
            src="https://cdn.quasar.dev/img/boy-avatar.png"
            :width="$q.screen.lt.md ? '20px' : '30px'"
            class="rounded-icon"
          />
          <div
            class="text-grey-4 text-center ellipsis text-width"
            :class="$q.screen.lt.md ? 'text-subtitle2' : 'text-subtitle1 '"
          >
            د/محمد العريفي
          </div>
        </div>

      </div>
    </q-carousel-slide>
  </q-carousel>
</template>

<script>
import { dateFormat } from 'src/utils/global.js'

export default {
  computed: {
    completedCourses () {
      const joinedCourses = this.$store.getters['student/joinedCourses']
      const completedCourses = joinedCourses.filter(
        course => course.status === 2
      )

      return completedCourses
    },
    firstSlide () {
      return this.completedCourses.length
        ? this.completedCourses[0].id
        : 0
    }
  },
  methods: {
    sectionImgSrc (section) {
      if (section === 'القرآن الكريم') {
        return '/images/Group 553723.png'
      }
      return '/images/Path 8205 22.png'
    },
    calcDate (timestamp) {
      const date = dateFormat(timestamp)
      return date
    }
  }
}
</script>

<style lang="scss" scoped>
.q-carousel {
  &::v-deep {
    .q-carousel__control .q-carousel__navigation-inner .q-btn{
      margin: 0;
      width: 15px;
      height: 20px;
    }

    .q-carousel__navigation-icon--inactive .q-icon:before {
      color: $grey-2;
      font-size: 9px;
    }

    .q-carousel__navigation-icon .q-icon {
      font-size: 10px;
    }

    .q-carousel__navigation .q-btn .q-btn__wrapper {
      padding: 0;
    }

    .q-carousel__arrow {
      margin-bottom: 15px;
    }
  }

  .text-width {
    width: 90%;
  }

  .achieve-icon {
    background: rgb(238, 192, 7);
    background: rgba(238, 192, 7, 0.05);
    border-radius: 100px;

    .img-lg {
      width: 70px;
      height: 77px;
    }

    .img-sm {
      width: 50px;
      height: 57px;
    }
  }

  .info-box {
    min-width: 100px;
    min-height: 58px;
  }

  .info-box-lg {
    width: 150px;
    height: 82px;
  }

  .info-box-sm {
    width: 100px;
    height: 58px;
  }

  .rounded-icon {
    border-radius: 30px;
  }
}
</style>
