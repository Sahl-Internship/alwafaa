<template>
  <div
    class="row justify-center bg-grey-2 q-gutter-y-md profile"
    :class="{
      'q-py-lg': !$q.screen.lt.sm,
      'q-py-sm': $q.screen.lt.sm,
    }"
  >
    <q-parallax class="col-11" :height="$q.screen.lt.sm ? 300 : 350">
      <template>
        <div class="dimmed fit profile-bg-container">
          <img :src="student.cover" class="fit profile-bg" />
        </div>
      </template>

      <template>
        <div class="absolute row justify-end fit">
          <div class="col-12 self-start text-right q-pt-md q-pr-md">
            <q-btn-dropdown
              dense
              flat
              rounded
              dropdown-icon="mdi-pencil"
              color="grey-1"
              no-icon-animation
            >
              <q-list class="q-px-sm" style="minwidth: 190px">
                <q-item clickable v-close-popup @click="toggleSettingDialog">
                  <q-item-section side class="q-pr-sm">
                    <q-icon name="mdi-cog" color="grey-4" size="xs" />
                  </q-item-section>

                  <q-item-section>
                    <q-item-label>{{ $t("student.header.setting") }}</q-item-label>
                  </q-item-section>
                </q-item>

                <q-separator color="grey-2" />

                <q-item clickable v-close-popup>
                  <q-item-section side class="q-pr-sm">
                    <q-icon name="mdi-image" color="grey-4" size="xs" />
                  </q-item-section>

                  <q-item-section>
                    <label>
                      <q-item-label>{{ $t("student.profile.bgChange") }}</q-item-label>
                      <input
                        ref="coverImg"
                        type="file"
                        accept="image/*"
                        @change="handleChangeCover"
                        style="display: none"
                      />
                    </label>
                  </q-item-section>
                </q-item>

                <q-item dense clickable v-close-popup class="bg-red-1 q-mb-xs">
                  <q-item-section side class="q-pr-sm">
                    <q-icon name="mdi-delete" color="red" size="xs" />
                  </q-item-section>

                  <q-item-section>
                    <q-item-label class="text-red">{{
                      $t("student.profile.remove")
                    }}</q-item-label>
                  </q-item-section>
                </q-item>
              </q-list>
            </q-btn-dropdown>
          </div>

          <div class="col-12 column q-gutter-y-lg">
            <div class="row justify-center items-center q-mr-lg">
              <q-avatar :size="$q.screen.lt.sm ? '100px' : '150px'" class="relative">
                <q-img :src="student.image" />
                <div
                  class="absolute camera-box row justify-center"
                  style="top: 15px; right: 14px; transform: translateY(-50%)"
                >
                  <label
                    class="file-btn"
                    style="top: 13px; right: 0; transform: translateY(-50%)"
                  >
                    <q-icon
                      name="mdi-camera"
                      size="xs"
                      color="grey-5"
                      style="top: 21px; right: 0; transform: translateY(-50%)"
                      class="cursor-pointer"
                    />
                    <input
                      ref="profileImg"
                      type="file"
                      accept="image/*"
                      @change="handleChangeAvatar"
                    />
                  </label>
                </div>
              </q-avatar>
              <div
                class="text-white q-ml-lg"
                :class="$q.screen.lt.sm ? '' : 'q-gutter-sm'"
              >
                <div
                  class="text-weight-bold"
                  :class="{
                    'text-h4': !$q.screen.lt.md,
                    'text-h5': $q.screen.lt.md && !$q.screen.lt.sm,
                    'text-h6': $q.screen.lt.sm,
                  }"
                >
                  {{ student.firstname }} {{ student.lastname }}
                </div>
                <div
                  class="text-weight-bold"
                  :class="{
                    'text-subtitle1': !$q.screen.lt.sm,
                    'text-caption': $q.screen.lt.sm,
                  }"
                >
                  كاتب محتوي تسويقي
                </div>
                <div
                  :class="{
                    'text-subtitle1': !$q.screen.lt.sm,
                    'text-caption': $q.screen.lt.sm,
                  }"
                >
                  <flag iso="eg" class="rounded-icon q-mr-xs" />
                  {{ student.country }}, {{ student.city }}
                </div>
              </div>
            </div>

            <div
              class="row justify-center"
              :class="$q.screen.lt.sm ? 'q-gutter-sm' : 'q-gutter-md'"
            >
              <div
                class="text-white text-center hobbies"
                :class="{
                  'text-subtitle1': !$q.screen.lt.sm,
                  'text-caption hobby-height': $q.screen.lt.sm,
                  'q-px-md': !$q.screen.lt.md,
                  'q-px-sm': $q.screen.lt.md,
                }"
                v-for="(hobby, index) in student.bio"
                :key="index"
              >
                #{{ hobby }}
              </div>
            </div>
          </div>
        </div>
      </template>
    </q-parallax>

    <div
      class="col-11 row justify-between"
      :class="$q.screen.lt.sm ? 'q-gutter-y-md' : ''"
    >
      <div class="col-xs-12 col-sm-7">
        <div class="text-h6 text-grey-5">{{ $t("student.achievements.title1") }}</div>
        <q-card class="q-mt-md">
          <q-card-section class="col-12 q-pa-none">
            <completed-courses-carousel></completed-courses-carousel>

            <div
              class="bg-grey-2 pin-mark absolute row items-center justify-center"
              style="top: 24px; left: 20px; transform: translateY(-50%)"
            >
              <q-btn flat type="button" icon="mdi-pin" size="13px" to="" />
            </div>
          </q-card-section>
        </q-card>
      </div>

      <div class="col-xs-12 col-sm-5" :class="$q.screen.lt.sm ? '' : 'q-pl-lg'">
        <div class="text-h6 text-grey-5">
          {{ $t("student.achievements.title2") }}
        </div>

        <achievements-card></achievements-card>
      </div>
    </div>

    <div
      class="col-11 row justify-between"
      :class="$q.screen.lt.sm ? 'q-gutter-y-md' : ''"
    >
      <div
        class="col-xs-12 col-sm-7"
        :class="{
          'order-last': $q.screen.lt.sm,
        }"
      >
        <div class="text-h6 text-grey-5">
          {{ $t("student.activities.title") }}
        </div>
        <div
          class="q-mt-md q-py-lg row justify-center bg-grey-1 q-gutter-y-lg"
        >
          <!--eslint-disable-next-line vue/valid-v-bind-->
          <activity-card
            v-for="(activity, index) in activities"
            :key="index"
            :activity="{ ...activity }"
            class="col-11"
          ></activity-card>
        </div>
      </div>

      <div
        class="col-xs-12 col-sm-5"
        :class="$q.screen.lt.sm ? '' : 'q-pl-lg'"
      >
        <div class="text-h6 text-grey-5">
          {{ $t("student.uncompleteCorses.title") }}
        </div>
        <uncomplete-course-card
          v-for="course in uncompletedCourses"
          :key="course.id"
          :course="course"
          class="q-mt-md"
        >
        </uncomplete-course-card>
      </div>
    </div>
  </div>
</template>

<script>
import ActivityCard from '../components/ActivityCard.vue'
import UncompleteCourseCard from '../components/UncompleteCourseCard.vue'
import CompletedCoursesCarousel from '../components/CompletedCoursesCarousel.vue'
import AchievementsCard from '../components/AchievementsCard.vue'

export default {
  components: {
    ActivityCard,
    UncompleteCourseCard,
    CompletedCoursesCarousel,
    AchievementsCard
  },
  data () {
    return {
      slide: 1,
      activities: [
        {
          type: 'comment',
          comment: 'كورس اكثر من رائع. استفدت منه كثيرا. شكرا علي هذا المجهود',
          section: 'اللغة العربية',
          course: 'اساسيات نحو اللغة العربية',
          teacher: 'د/صلاح عبدالله',
          rate: 4
        },
        {
          type: 'comment',
          comment: 'شكرا علي هذا المجهود',
          section: 'القرآن الكريم',
          course: 'دورة النطق الصحيح للآيات',
          teacher: 'د/محمد العريفي',
          rate: 4.5
        },
        {
          type: 'achieve',
          comment: 'شكرا علي هذا المجهود',
          section: 'القرآن الكريم',
          course: 'تمهيد لتعلم القواعد النحوية',
          teacher: 'د/محمد العريفي'
        },
        {
          type: 'comment',
          comment: 'كورس اكثر من رائع. استفدت منه كثيرا.',
          section: 'اللغة العربية',
          course: 'اساسيات نحو اللغة العربية',
          teacher: 'د/محمد العريفي',
          rate: 3
        }
      ],
      completedCourses: [],
      uncompletedCourses: []
    }
  },
  computed: {
    student () {
      return this.$store.getters['auth/getUser']
        ? this.$store.getters['auth/getUser']
        : {}
    }
  },
  methods: {
    handleChangeAvatar () {
      const file = this.$refs.profileImg.files[0]
      this.createBase64Img(file, 'avatar')
    },
    handleChangeCover (e) {
      // console.log(this.$refs)
      // console.log(e.target.files)
      const file = e.target.files[0]
      this.createBase64Img(file, 'cover')
    },
    createBase64Img (file, key) {
      const reader = new FileReader()
      reader.onload = e => {
        const base64Val = e.target.result
        this.$store.dispatch('student/editProfileAndCoverImg', { [key]: base64Val })
      }
      reader.readAsDataURL(file)
    },
    toggleSettingDialog () {
      this.$store.commit('student/toggleEditDialog')
    },
    filterCourses (courses) {
      this.completedCourses = courses.filter(course => course.status === 2)

      this.uncompletedCourses = courses.filter(course => course.status !== 2)
    }
  },
  mounted () {
    let joinedCourses = this.$store.getters['student/joinedCourses']
    this.filterCourses(joinedCourses)
    if (joinedCourses.length) {
      this.joinedCourses = joinedCourses
    } else {
      this.$store.dispatch('student/getJoinedCourses').then(() => {
        joinedCourses = this.$store.getters['student/joinedCourses']
        this.filterCourses(joinedCourses)
      })
    }
  }
}
</script>

<style lang="scss" scoped>
.profile {
  overflow-x: hidden;

  .profile-bg {
    border: solid 3px #80bfff;
    opacity: 0.7;
    background-color: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5));
  }

  .pin-mark {
    height: 50px;
    width: 33px;
    border-bottom-left-radius: 7px;
    border-bottom-right-radius: 7px;

    .q-btn {
      -ms-transform: rotate(-40deg); /* IE 9 */
      transform: rotate(-40deg);
    }
  }

  .rounded-icon {
    border-radius: 30px;
  }

  .file-btn {
    font-size: 1px;
  }

  .file-btn > input[type="file"] {
    display: none;
  }
}

.hobbies {
  border-radius: 30px;
  height: 30px;
  background: rgb(242, 242, 242);
  background: rgba(242, 242, 242, 0.3);
}

.hobby-height {
  height: 25px;
}

.camera-box {
  background-color: white;
  width: 27px;
  height: 27px;
  border-radius: 20px;
}
</style>
