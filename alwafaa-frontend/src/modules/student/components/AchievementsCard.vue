<template>
  <q-card
    class="q-mt-md row justify-between"
    :style="
      !$q.screen.lt.md
        ? 'height: 320px'
        : $q.screen.lt.sm
        ? 'height: 220px'
        : 'height: 280px'
    "
  >
    <q-card-section
      class="col-12 column items-center"
      :class="{
        'q-py-xl q-gutter-y-lg': !$q.screen.lt.md,
        'q-py-xl q-gutter-y-sm': $q.screen.lt.md && !$q.screen.lt.sm,
        'q-py-md q-gutter-y-xs': $q.screen.lt.sm,
      }"
    >
      <div
        class="text-weight-bold text-grey-5"
        :class="{
          'text-h3': !$q.screen.lt.md,
          'text-h4': $q.screen.lt.md,
        }"
      >
        {{ joinedCoursesNum }}
      </div>
      <div
        class="text-weight-bold text-grey-4"
        :class="{
          'text-h5': !$q.screen.lt.md,
          'text-h6': $q.screen.lt.md,
        }"
      >
        {{ $t("student.achievements.coursesNumber") }}
      </div>
    </q-card-section>

    <q-card-section class="col-12 column justify-center">
      <div class="row justify-between">
        <div class="col-3 row justify-center text-center">
          <div
            class="text-h5 col-12 text-weight-bold text-grey-5 q-mt-sm"
            style="height: 30px"
          >
            {{ completedCoursesNum }}
          </div>
          <div
            class="text-grey-4 col-12 q-mb-xs"
            :class="{
              'text-subtitle1': !$q.screen.lt.md,
              'text-subtitle2': $q.screen.lt.md,
            }"
          >
            {{ $t("student.achievements.finished") }}
          </div>
          <q-separator style="width: 12px" color="red" size="3px" />
        </div>

        <q-separator vertical inset style="height: 65%" />

        <div class="col-4 row justify-center text-center">
          <div
            class="text-h5 col-12 text-weight-bold text-grey-5 q-mt-sm"
            style="height: 30px"
          >
            {{ unCompletedCoursesNum }}
          </div>
          <div
            class="text-grey-4 col-12 q-mb-xs"
            :class="{
              'text-subtitle1': !$q.screen.lt.md,
              'text-subtitle2': $q.screen.lt.md,
            }"
          >
            {{ $t("student.achievements.uncompleted") }}
          </div>

          <q-separator style="width: 12px" color="blue" size="3px" />
        </div>

        <q-separator vertical inset style="height: 65%" />

        <div class="col-4 text-center">
          <q-btn
            flat
            text-color="grey-5"
            icon="mdi-plus"
            :size="$q.screen.lt.md ? 'lg' : 'xl'"
            to="/courses/all"
          />
        </div>
      </div>
    </q-card-section>
  </q-card>
</template>

<script>
export default {
  data () {
    return {
      completedCoursesNum: 0,
      unCompletedCoursesNum: 0
    }
  },
  computed: {
    joinedCoursesNum () {
      const joinedCourses = this.$store.getters['student/joinedCourses']
      // eslint-disable-next-line vue/no-side-effects-in-computed-properties
      this.completedCoursesNum = joinedCourses.filter(
        course => course.status === 2
      ).length

      // eslint-disable-next-line vue/no-side-effects-in-computed-properties
      this.unCompletedCoursesNum = joinedCourses.filter(
        course => course.status !== 2
      ).length

      return joinedCourses.length
    }
  }
}
</script>
