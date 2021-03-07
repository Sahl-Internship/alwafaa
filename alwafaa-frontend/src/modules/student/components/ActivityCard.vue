<template>
  <div>
    <q-card v-if="activity.type === 'comment'">
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
            <img src="https://cdn.quasar.dev/img/boy-avatar.png">
          </q-avatar>
        </q-item-section>

        <q-item-section>
          <q-item-label class="text-subtitle1">محمد سليمان</q-item-label>
          <q-item-label caption>
            {{ $t('student.achievements.date') }}
          </q-item-label>
        </q-item-section>
      </q-item>

      <q-card-section
        class="row justify-center q-px-md q-gutter-y-sm"
        :class="$q.screen.lt.md ? '' : 'q-mt-xs' "
      >
        <div class="col-12 row q-gutter-sm rate">
          <img src="/images/Path 8203.png" />
          <img src="/images/Path 8203.png" />
          <img src="/images/Path 8203.png" />
          <img src="/images/Path 8204.png" />
          <div class="text-subtitle1">0.4</div>
        </div>

        <div
          class="col-12 text-grey-4"
          :class="$q.screen.lt.md ? 'text-caption' : 'text-subtitle1' "
        >
          {{ activity.comment }}
        </div>

        <div
          class="col-12 bg-grey-1 text-center course-info"
          :class="$q.screen.lt.md ? '' : 'q-py-sm' "
        >
          <div class="text-subtitle1 text-grey-3">
            <!-- <q-icon name="mdi-web" /> -->
            <q-img
              :src="activity.section === 'اللغة العربية'
                ? '/images/Path 8205 22.png'
                : '/images/Group 553723.png'"
              width='15px'
              class="q-mr-xs"
            />
            {{ activity.section }}
          </div>
          <div
            class="text-grey-5"
            :class="$q.screen.lt.md ? 'text-h6' : 'text-h5' "
          >
            {{ activity.course }}
          </div>
          <div class="text-subtitle1 text-grey-4">
            <q-avatar size="sm">
              <img src="https://cdn.quasar.dev/img/boy-avatar.png">
            </q-avatar>
            {{ activity.teacher }}
          </div>
        </div>
      </q-card-section>
    </q-card>

    <q-card v-if="activity.type === 'achieve'" class="q-py-sm">
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
          <div class="text-subtitle1">
            {{ $t('student.activities.today') }}: 08:25
          </div>

          <div class="text-subtitle1">
            <img src="/images/Group 4877.png" width="20px" />
            <span class="achievement-course q-ml-xs">{{ $t('student.achievements.quran') }}</span>
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
          class="text-grey-5"
          :class="$q.screen.lt.md ? 'text-subtitle1' : 'text-h6'"
        >تمهيد لتعلم القواعد النحوية</div>
      </q-card-section>
    </q-card>
  </div>
</template>

<script>
export default {
  props: {
    activity: {
      type: Object
    }
  },
  computed: {
    checkDirection () {
      return this.$q.lang.rtl
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
</style>
