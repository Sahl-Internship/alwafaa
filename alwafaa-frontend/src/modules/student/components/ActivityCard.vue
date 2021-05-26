<template>
  <div>
    <q-card v-if="activity.review">
      <div class="col-1 text-right q-mr-sm" style="height: 20px">
        <q-btn-dropdown
          dense flat rounded
          dropdown-icon="mdi-dots-horizontal"
          color="grey-4"
          no-icon-animation
        >
          <q-list class="q-px-sm" style="minWidth: 190px">
            <q-item clickable>
              <q-item-section side class="q-pr-sm">
                <q-icon name="mdi-pin" color="grey-4" size="xs" class="pin-icon" />
              </q-item-section>

              <q-item-section>
                <q-item-label>{{ $t('student.activities.pin') }}</q-item-label>
              </q-item-section>
            </q-item>

            <q-item clickable>
              <q-item-section side class="q-pr-sm">
                <q-icon name="mdi-text-box" color="grey-4" size="xs" />
              </q-item-section>

              <q-item-section>
                <q-item-label>{{ $t('student.activities.archived') }}</q-item-label>
              </q-item-section>
            </q-item>

            <q-item dense clickable class="bg-red-1 q-mb-xs ">
              <q-item-section side class="q-pr-sm">
                <q-icon name="mdi-package-down" color="red" size="xs" />
              </q-item-section>

              <q-item-section>
                <q-item-label class="text-red">{{ $t('student.activities.archive') }}</q-item-label>
              </q-item-section>
            </q-item>
          </q-list>
        </q-btn-dropdown>
      </div>

      <q-item class="q-ml-md">
        <q-item-section avatar>
          <q-avatar>
            <img :src="student.image">
          </q-avatar>
        </q-item-section>

        <q-item-section>
          <q-item-label class="text-subtitle1">
            {{ student.firstname }} {{ student.lastname }}
          </q-item-label>
          <q-item-label caption>
            {{ getDate(activity.created_at) }}
          </q-item-label>
        </q-item-section>
      </q-item>

      <q-card-section
        class="row justify-center q-px-md q-gutter-y-sm"
        :class="$q.screen.lt.md ? '' : 'q-mt-xs' "
      >
        <div class="col-12 row q-gutter-sm rate">
          <star-rating
            read-only
            :increment=0.5
            :rating="activity.rate"
            :star-size="$q.screen.lt.md ? 13 : 20"
            :padding="$q.screen.lt.md ? 3 : 5"
            :active-color="['#e49d1a']"
            :show-rating=false
            :rtl=true
          ></star-rating>
          <div class="text-subtitle1">{{ getRate }}</div>
        </div>

        <div
          class="col-12 text-grey-4"
          :class="$q.screen.lt.md ? 'text-caption' : 'text-subtitle1' "
        >
          {{ activity.review }}
        </div>

        <div
          class="col-12 bg-grey-1 text-center course-info"
          :class="$q.screen.lt.md ? '' : 'q-py-sm' "
        >
          <div class="text-subtitle1 text-grey-3">
            <!-- <q-icon name="mdi-web" /> -->
            <q-img
              :src="sectionSrcGrey"
              width='15px'
              class="q-mr-xs"
            />
            {{ activity.course.section }}
          </div>
          <div
            class="text-grey-5 q-px-md ellipsis"
            :class="$q.screen.lt.md ? 'text-h6' : 'text-h5' "
          >
            {{ activity.course.name }}
          </div>
          <div class="text-subtitle1 text-grey-4">
            <q-avatar size="sm">
              <img :src="activity.course.teacher_avatar">
            </q-avatar>
            {{ activity.course.teacher }}
          </div>
        </div>
      </q-card-section>
    </q-card>

    <q-card v-else class="q-py-sm">
      <q-card-section class="text-white q-pt-lg q-mx-sm achieve-header">
        <div
          class="text-weight-bold"
          :class="{
            'text-h5': !$q.screen.lt.md,
            'text-h6': $q.screen.lt.md
          }"
        >
          {{ $t('student.activities.achievement') }}
        </div>

        <div
          class="row q-mt-xs"
          :class="$q.screen.lt.md ? 'q-gutter-x-sm' : 'q-gutter-x-lg'"
        >
          <div v-if="checkDate" class="text-subtitle1">
            {{ $t('student.activities.today') }}: {{ getTime }}
          </div>

          <div v-else class="text-subtitle1">
            {{ getDate(activity.end_at) }}
          </div>

          <div class="text-subtitle1">
            <img :src="sectionSrcWhite" width="20px" />
            <span class="achievement-course q-ml-xs">
              {{ activity.section }}
            </span>
          </div>
        </div>
      </q-card-section>

      <q-card-section :class="$q.screen.lt.md ? '' : 'q-ml-md'">
        <q-img
          src="/images/Group 5535.png"
          class="absolute"
          :width="$q.screen.lt.md ? '65px' : '120px' "
          :style="checkDirection ?
            $q.screen.lt.md ?
              'top: 10px; left: 15px; transform: translateY(-50%);'
              : 'top: 10px; left: 45px; transform: translateY(-50%);'
            : $q.screen.lt.md ?
              'top: 10px; right: 15px; transform: translateY(-50%);'
              : 'top: 10px; right: 45px; transform: translateY(-50%);'"
        />
        <div class="text-subtitle1 text-grey-3">{{ $t('student.activities.finish') }}:</div>
        <div
          class="text-grey-5 ellipsis course-title"
          :class="$q.screen.lt.md ? 'text-subtitle1' : 'text-h6'"
        >{{ activity.title }}</div>
      </q-card-section>
    </q-card>
  </div>
</template>

<script>
import StarRating from 'vue-star-rating'
import { dateFormat } from 'src/utils/global.js'

export default {
  components: { StarRating },
  props: {
    activity: {
      type: Object
    }
  },
  computed: {
    student () {
      return this.$store.getters['auth/getUser'] || {}
    },
    checkDirection () {
      return this.$q.lang.rtl
    },
    checkDate () {
      const date = this.activity.end_at * 1000
      const today = new Date().getTime()

      return date === today
    },
    getTime () {
      const date = new Date(this.activity.end_at * 1000)
      const hours = date.getHours().length > 1
        ? date.getHours()
        : `0${date.getHours()}`

      const minutes = date.getMinutes().length > 1
        ? date.getMinutes()
        : `0${date.getMinutes()}`

      console.log(this.activity.end_at)

      return `${hours}:${minutes}`
    },
    sectionSrcWhite () {
      if (this.activity.section === 'القرآن الكريم') {
        return '/images/home-imgs/quran-icon2.png'
      }

      return '/images/home-imgs/global.png'
    },
    sectionSrcGrey () {
      if (this.activity.course.section === 'القرآن الكريم') {
        return '/images/Group 553723.png'
      }

      return '/images/Path 8205 22.png'
    },
    getRate () {
      const rate = this.activity.rate
      return Number.isInteger(rate) ? `${rate}.0` : rate
    }
  },
  methods: {
    getDate (timestampDate) {
      return dateFormat(timestampDate)
    }
  }
}
</script>

<style lang="scss" scoped>
.rate img {
  height: 20px;
  width: 20px;
}

.course-info {
  border-radius: 4px;
  border: solid 1px $grey-2;
}

.achieve-header {
  background-image: linear-gradient(to left, $primary , $green);

  .achievement-course {
    text-decoration: underline;
  }
}

.pin-icon {
  -ms-transform: rotate(-40deg); /* IE 9 */
  transform: rotate(-40deg);
}

.course-title {
  padding-right: 170px;
}
</style>
