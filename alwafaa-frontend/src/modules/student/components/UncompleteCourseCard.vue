<template>
  <q-card>
    <q-item>
      <q-item-section>
        <div class="text-subtitle1 text-grey-4 q-mt-md">
          <!-- <q-icon name="mdi-web" /> -->
          <q-img
            :src="sectionImgSrc"
            width='17px'
            class="q-mr-xs"
          />
          {{ course.section }}
        </div>

        <div class="q-ma-lg course-box">
          <div
            class="text-grey-5 course-title ellipsis"
            :class="$q.screen.lt.md ? 'text-h6' : 'text-h5'"
          >
            {{ course.title }}
          </div>
          <div class="text-subtitle1 text-grey-4 course-teacher q-mt-xs">
            <q-avatar size="sm">
              <img src="https://cdn.quasar.dev/img/boy-avatar.png">
            </q-avatar>
            {{ course.teacher_id }}
          </div>
        </div>
      </q-item-section>
    </q-item>

    <q-card-section
      class="row justify-center"
      :class="$q.screen.lt.md ? 'q-gutter-y-md q-pt-none' : 'q-gutter-y-xl'"
    >
      <q-circular-progress
        show-value
        :value="progress"
        :thickness="0.14"
        color="blue"
        track-color="grey-2"
        :angle="angle"
        class="col-4 progress"
      >
        <div class="column">
          <div
            class="text-grey-5 text-center"
            :class="$q.screen.lt.md ? 'text-h6' : 'text-h5'"
          >{{ getCourseHours }}</div>
          <div class="text-caption text-grey-5 text-center">
            {{ $t('student.uncompleteCorses.hours') }}
          </div>
        </div>
      </q-circular-progress>

      <div class="col-12 row justify-center q-gutter-sm q-mt-md">
        <div class="
          col-xs-4
          col-sm-4
          col-md-3
          text-blue
          text-center
          rounded-borders
          hours-completed
          q-px-md q-py-xs
          hours-box
        ">
          <div
            class="text-weight-bold"
            :class="$q.screen.lt.md ? 'text-subtitle2' : 'text-subtitle1'"
          >{{ getCourseCompletedHours }}</div>

          <div class="text-caption">
            {{ $t('student.uncompleteCorses.completed') }}
          </div>
        </div>

        <div class="
          col-xs-4
          col-sm-4
          col-md-3
          text-red
          text-center
          rounded-borders
          hours-remaining
          q-px-md q-py-xs
          hours-box
        ">
          <div
            class="text-weight-bold"
            :class="$q.screen.lt.md ? 'text-subtitle2' : 'text-subtitle1'"
          >{{ getCourseRemainingHours }}</div>
          <div class="text-caption">
            {{ $t('student.uncompleteCorses.remaining') }}
          </div>
        </div>
      </div>

      <q-btn
        no-caps
        type="button"
        :label="$t('student.uncompleteCorses.completeCousre')"
        :icon-right="checkDirection ? 'mdi-chevron-left' : 'mdi-chevron-right'"
        color="grey-2"
        text-color="grey-5"
        class="col-11 complete-btn"
        size="18px"
        :to="'/courses/'+course.id"
      />
    </q-card-section>

  </q-card>
</template>

<script>
import { calcDuration } from 'src/utils/global.js'

export default {
  props: {
    course: {
      type: Object
    }
  },
  data () {
    return {
      progress: 65,
      angle: -50
    }
  },
  computed: {
    checkDirection () {
      return this.$q.lang.rtl
    },
    sectionImgSrc () {
      if (this.course.section === 'القرآن الكريم') {
        return '/images/Group 553723.png'
      }
      return '/images/Path 8205 22.png'
    },
    getCourseHours () {
      return calcDuration(this.course.duration)
    },
    getCourseCompletedHours () {
      return calcDuration(this.course.finished_duration)
    },
    getCourseRemainingHours () {
      return calcDuration(this.course.not_finished_duration)
    }
  }
}
</script>

<style lang="scss" scoped>
.course-title {
  width: 90%;
}

.hours-completed {
  background: rgb(80, 148, 236);
  background: rgba(80, 148, 236, 0.1);
}

.hours-remaining {
  background: rgb(240, 64, 64);
  background: rgba(240, 64, 64, 0.1);
}

.q-btn {
  &::v-deep {
    .block {
      text-decoration: underline;
    }
  }
}

.q-circular-progress {
  &::v-deep {
    .q-circular-progress__svg {
      stroke-linecap: round;
    }
  }
}

.progress {
  min-width: 110px;
}

.hours-box {
  min-width: 78px;
}

@media (max-width: 850px) and (min-width: 700px) {
  .course-box {
    margin-left: 0;
  }
  .course-title {
    font-size: 17px;
  }
}

@media (max-width: 700px) and (min-width: 600px) {
  .course-box {
    margin-left: 0;
  }
  .course-title {
    font-size: 13px;
  }

  .course-teacher {
    font-size: 13px;
  }

  .q-btn {
    &::v-deep {
      .block {
        font-size: 15px;
      }
      .q-icon {
        font-size: 17px;
      }
    }
  }

  .hours-box {
    min-width: 70px;
  }
}
</style>
