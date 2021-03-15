<template>
  <q-card
    flat
    :class="{
      'search-card': !$q.screen.lt.sm,
      'search-card search-card-sm': $q.screen.lt.sm
    }"
  >
    <q-card-section horizontal class="justify-between">
      <img
        :class="$q.screen.lt.sm ? 'card-img-sm' : 'card-img-lg'"
        :src="course.image"
      />

      <q-card-section
        class="col-sx-11 col-sm-10 row self-center q-pa-none"
        :class="!$q.screen.lt.sm ? 'q-mr-xl': ''"
      >

        <div class="col-6 row q-gutter-y-md">
          <div
            class="col-12 text-grey-3 ellipsis"
            :class="{
              'text-h6 text-weight-bold': !$q.screen.lt.sm,
              'text-caption': $q.screen.lt.sm
            }"
          >
            {{ course.title }}
          </div>

          <div class="col-xs-12 col-sm-9 row justify-between">
            <div class="row items-center q-gutter-sm">
              <img
                :src="sectionImgSrc"
                :class="$q.screen.lt.sm ? 'section-img-sm' : 'section-img-lg'"
              />
              <div
                class="text-grey-4"
                :class="$q.screen.lt.sm ? 'text-sm' : 'text-subtitle1'"
              >{{ course.section }}</div>
            </div>

            <div class="row items-center q-gutter-x-sm">
              <img
                src="/images/Path 9266.png"
                :class="$q.screen.lt.sm ? 'date-img-sm' : 'date-img-lg'"
              />
              <div
                class="text-grey-4"
                :class="$q.screen.lt.sm ? 'text-sm' : 'text-subtitle1'"
              >12 يناير 2021</div>
            </div>
          </div>
        </div>

        <div class="col-4 row items-center justify-center">
          <q-avatar :size="$q.screen.lt.sm ? 'xs' : 'md'">
            <q-img src="https://cdn.quasar.dev/img/boy-avatar.png" />
          </q-avatar>
          <div
            class="text-grey-4 q-ml-sm"
            :class="$q.screen.lt.sm ? 'text-sm' : 'text-subtitle1'"
          >د/محمد العريفي</div>
        </div>

        <div class="col-xs-2 col-sm-4 row items-center justify-end">
          <div
            class="
              text-red
              text-center
              q-py-xs
              rounded-borders
              course-finished
            "
            :class="{
              'text-subtitle2 q-px-md status-box-lg': !$q.screen.lt.sm,
              'text-sm status-box-sm': $q.screen.lt.sm
            }"
          >
            {{ $t(`coursesList.${courseStatus}`) }}
          </div>

          <q-btn
            flat
            icon="mdi-chevron-left"
            type="button"
            size="sm"
            style="width: 20px"
            @click="routeToCourse"
          />
        </div>

      </q-card-section>
    </q-card-section>
  </q-card>
</template>

<script>
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
      const today = new Date().getTime()
      const startAt = new Date(this.course.start_at).getTime()
      const endAt = new Date(this.course.end_at).getTime()
      // console.log(this.course.title)
      // console.log(new Date())
      // console.log(this.course.start_at)
      // console.log(this.course.end_at)

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
    }
  }
}
</script>

<style lang="scss" scoped>
.search-card {
  height: 140px;

  &.search-card-sm {
    height: 90px;
  }

  .card-img-lg {
    width: 130px;
    height: 140px;
  }

  .card-img-sm {
    width: 80px;
    height: 90px;
  }

  .course-start {
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
}
</style>
