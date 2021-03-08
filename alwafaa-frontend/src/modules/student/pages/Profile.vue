<template>
  <div class="relative">
    <Header @openDialog="handleOpenDialog"></Header>

    <search
      v-if="searchMode"
      class="full-width fixed search-dialog"
      @closeDialog="handleCloseDialog"
      style="top:68px"
    ></search>

    <div
      class="row justify-center bg-grey-2 q-gutter-y-md profile"
      :class="{
        'q-py-lg': !$q.screen.lt.sm,
        'q-py-sm': $q.screen.lt.sm,
        'dimmed': searchMode
      }"
    >

      <q-parallax
        class="col-11" :height="$q.screen.lt.sm ? 300 : 350"
      >
        <template>
          <div class="dimmed fit profile-bg-container">
            <img :src="bgImage" class="fit profile-bg" />
          </div>
        </template>

        <template>
          <div class="absolute row justify-end fit">
            <div class="col-12 self-start text-right q-pt-md q-pr-md">
              <q-btn-dropdown
                dense flat rounded
                dropdown-icon="mdi-pencil"
                color="grey-1"
                no-icon-animation
              >
                <q-list class="q-px-sm" style="minWidth: 190px">
                  <q-item clickable @click="editMode = true">
                    <q-item-section side class="q-pr-sm">
                      <q-icon name="mdi-cog" color="grey-4" size="xs" />
                    </q-item-section>

                    <q-item-section>
                      <q-item-label>{{ $t('student.header.setting') }}</q-item-label>
                    </q-item-section>
                  </q-item>

                  <q-separator color="grey-2" />

                  <q-item clickable>
                      <q-item-section side class="q-pr-sm">
                        <q-icon name="mdi-image" color="grey-4" size="xs" />
                      </q-item-section>

                      <q-item-section class="file-btn">
                        <label>
                          <q-item-label>{{ $t('student.profile.bgChange') }}</q-item-label>
                          <input
                            ref="bgImg"
                            type="file"
                            accept="image/*"
                            @change="handleChangeBg"
                            style="display: none"
                          />
                        </label>
                      </q-item-section>

                  </q-item>

                  <q-item dense clickable class="bg-red-1 q-mb-xs">
                    <q-item-section side class="q-pr-sm">
                      <q-icon name="mdi-delete" color="red" size="xs" />
                    </q-item-section>

                    <q-item-section>
                      <q-item-label class="text-red">{{ $t('student.profile.remove') }}</q-item-label>
                    </q-item-section>
                  </q-item>
                </q-list>
              </q-btn-dropdown>
            </div>

            <div class="col-12 column q-gutter-y-lg">
              <div class="row justify-center items-center q-mr-lg">
                <q-avatar :size="$q.screen.lt.sm ? '100px' : '150px'" class="relative">
                  <q-img :src="profileImage" />
                  <div
                    class="absolute camera-box row justify-center"
                    style="top: 15px; right: 14px; transform: translateY(-50%);"
                  >
                    <label
                      class="file-btn"
                      style="top: 13px; right: 0; transform: translateY(-50%);"
                    >
                      <q-icon
                        name="mdi-camera"
                        size="xs"
                        color="grey-5"
                        style="top: 21px; right: 0; transform: translateY(-50%);"
                        class="cursor-pointer"
                      />
                      <input
                        ref="profileImg"
                        type="file"
                        accept="image/*"
                        @change="handleChangeAvatar"
                      >
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
                      'text-h5': $q.screen.lt.md && !$q.screen.lt.sm ,
                      'text-h6': $q.screen.lt.sm,
                    }"
                  >{{ student.firstname }} {{ student.lastname }}</div>
                  <div
                    class="text-weight-bold"
                    :class="{
                      'text-subtitle1': !$q.screen.lt.sm,
                      'text-caption': $q.screen.lt.sm,
                    }"
                  >كاتب محتوي تسويقي</div>
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
                    'q-px-sm': $q.screen.lt.md
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
        :class="$q.screen.lt.sm ? 'q-gutter-y-md' : '' "
      >
        <div class="col-xs-12 col-sm-7">
          <div class="text-h6 text-grey-5">{{ $t('student.achievements.title1') }}</div>
          <q-card class="q-mt-md">
            <q-card-section class="col-12 q-pa-none">
              <q-carousel
                v-model="slide"
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
                  :name="n"
                  class="column no-wrap flex-center q-pa-none"
                  v-for="n in 5"
                  :key="n"
                >
                  <div class="achieve-icon q-pa-md">
                    <img
                      src="/images/Group 5535.png"
                      :class="$q.screen.lt.md ? 'img-sm' : 'img-lg'"
                    />
                  </div>

                  <div
                    class="text-center text-weight-bold text-grey-5"
                    :class="$q.screen.lt.md ? 'text-h6' : 'text-h5'"
                  >
                    مشروع تحفيظ القرآن الكريم
                  </div>

                  <div
                    class="row q-mt-lg q-mb-xl"
                    :class="$q.screen.lt.md ? 'q-gutter-x-sm' : 'q-gutter-x-md'"
                  >
                    <div
                      class="column items-center justify-center bg-grey-1 rounded-borders q-gutter-y-xs q-my-none info-box"
                      :class="$q.screen.lt.md? 'info-box-sm' : 'info-box-lg'"
                    >
                      <q-img src="/images/Group 553723.png" :width="$q.screen.lt.md ? '20px' : '30px'" />
                      <div
                        class="text-grey-4"
                        :class="$q.screen.lt.md ? 'text-subtitle2' : 'text-subtitle1 '"
                      >
                        القرآن الكريم
                      </div>
                    </div>

                    <div
                      class="column items-center justify-center bg-grey-1 rounded-borders q-gutter-y-xs q-my-none info-box"
                      :class="$q.screen.lt.md? 'info-box-sm' : 'info-box-lg'"
                    >
                      <q-img src="/images/date_range-24px.png" :width="$q.screen.lt.md ? '20px' : '30px'" />
                      <div
                        class="text-grey-4"
                        :class="$q.screen.lt.md ? 'text-subtitle2' : 'text-subtitle1 '"
                      >
                        22 يناير 2021
                      </div>
                    </div>

                    <div
                      class="column items-center justify-center bg-grey-1 rounded-borders q-gutter-y-xs q-my-none info-box"
                      :class="$q.screen.lt.md? 'info-box-sm' : 'info-box-lg'"
                    >
                      <q-img
                        src="https://cdn.quasar.dev/img/boy-avatar.png"
                        :width="$q.screen.lt.md ? '20px' : '30px'"
                        class="rounded-icon"
                      />
                      <div
                        class="text-grey-4"
                        :class="$q.screen.lt.md ? 'text-subtitle2' : 'text-subtitle1 '"
                      >
                        د/محمد العريفي
                      </div>
                    </div>

                  </div>
                </q-carousel-slide>
              </q-carousel>

              <div
                class="bg-grey-2 pin-mark absolute row items-center justify-center"
                style="top: 24px; left: 20px; transform: translateY(-50%);"
              >
                <q-btn flat type="button" icon="mdi-pin" size="13px" to="" />
              </div>
            </q-card-section>
          </q-card>
        </div>

        <div
          class="col-xs-12 col-sm-5"
          :class="$q.screen.lt.sm? '' : 'q-pl-lg'"
        >
          <div class="text-h6 text-grey-5">
            {{ $t('student.achievements.title2') }}
          </div>

          <q-card
            class="q-mt-md row justify-between"
            :style="!$q.screen.lt.md ? 'height: 320px'
              : $q.screen.lt.sm ? 'height: 220px' : 'height: 280px'"
          >
            <q-card-section
              class="col-12 column items-center"
              :class="{
                'q-py-xl q-gutter-y-lg': !$q.screen.lt.md,
                'q-py-xl q-gutter-y-sm': $q.screen.lt.md && !$q.screen.lt.sm,
                'q-py-md q-gutter-y-xs': $q.screen.lt.sm
              }"
            >
              <div
                class="text-weight-bold text-grey-5"
                :class="{
                  'text-h3': !$q.screen.lt.md,
                  'text-h4': $q.screen.lt.md
                }"
              >23</div>
              <div
                class="text-weight-bold text-grey-4"
                :class="{
                  'text-h5': !$q.screen.lt.md,
                  'text-h6': $q.screen.lt.md
                }"
              >
                {{ $t('student.achievements.coursesNumber') }}
              </div>
            </q-card-section>

            <q-card-section class="col-12 column justify-center">
              <div class="row justify-between">
                <div class="col-3 row justify-center text-center">
                  <div
                    class="text-h5 col-12 text-weight-bold text-grey-5 q-mt-sm"
                    style="height: 30px"
                  >20</div>
                  <div
                    class="text-grey-4 col-12 q-mb-xs"
                    :class="{
                      'text-subtitle1': !$q.screen.lt.md,
                      'text-subtitle2': $q.screen.lt.md,
                    }"
                  >
                    {{ $t('student.achievements.finished') }}
                  </div>
                  <q-separator style="width: 12px" color="red" size="3px" />
                </div>

                <q-separator vertical inset style="height: 65%" />

                <div class="col-4 row justify-center text-center">
                  <div
                    class="text-h5 col-12 text-weight-bold text-grey-5 q-mt-sm"
                    style="height: 30px"
                  >3</div>
                  <div
                    class="text-grey-4 col-12 q-mb-xs"
                    :class="{
                      'text-subtitle1': !$q.screen.lt.md,
                      'text-subtitle2': $q.screen.lt.md,
                    }"
                  >
                    {{ $t('student.achievements.uncompleted') }}
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
                    to=""
                  />
                </div>
              </div>
            </q-card-section>
          </q-card>
        </div>
      </div>

      <div
        class="col-11 row justify-between"
        :class="$q.screen.lt.sm ? 'q-gutter-y-md' : '' "
      >
        <div
          class="col-xs-12 col-sm-7"
          :class="{
            'order-last': $q.screen.lt.sm
          }"
        >
          <div class="text-h6 text-grey-5">{{ $t('student.activities.title') }}</div>
          <div class="q-mt-md q-py-lg row justify-center bg-grey-1 q-gutter-y-lg">
            <!--eslint-disable-next-line vue/valid-v-bind-->
            <activity-card
              v-for="(activity, index) in activities"
              :key="index"
              :activity={...activity}
              class="col-11"
            ></activity-card>
          </div>
        </div>

        <div
          class="col-xs-12 col-sm-5"
          :class="$q.screen.lt.sm? '' : 'q-pl-lg'"
        >
          <div class="text-h6 text-grey-5">{{ $t('student.uncompleteCorses.title') }}</div>
          <uncomplete-course-card
            v-for="(course, index) in courses"
            :key="index"
            :course={...course}
            class="q-mt-md">
          </uncomplete-course-card>
        </div>
      </div>

      <q-dialog v-model="editMode" full-width>
        <setting-dialog @closeDialog="handleCloseDialog" ></setting-dialog>
      </q-dialog>

      <!-- <q-dialog v-model="searchMode" full-width position="top" class="search-dialog"> -->
        <!-- <search
          v-if="searchMode"
          class="overlay col-12"
          @closeDialog="handleCloseDialog"
        ></search> -->
      <!-- </q-dialog> -->

    </div>

  </div>
</template>

<script>
import Header from '../components/Header.vue'
import ActivityCard from '../components/ActivityCard'
import UncompleteCourseCard from '../components/UncompleteCourseCard.vue'
import SettingDialog from '../components/SettingDialog.vue'
import Search from '../components/Search'

export default {
  components: { Header, ActivityCard, UncompleteCourseCard, SettingDialog, Search },
  data () {
    return {
      hobbies: ['#النحو', '#أحكام القرآن', '#الشعر', '#معرفة', '#الفصاحة'],
      slide: 1,
      editMode: false,
      searchMode: false,
      profileImage: 'https://cdn.quasar.dev/img/boy-avatar.png',
      bgImage: '/images/profile-bg.png',
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
      courses: [
        {
          section: 'اللغة العربية',
          course: 'اساسيات نحو اللغة العربية',
          teacher: 'د/خالد محمد',
          hours: '03:30:00',
          completed: '01:45:23',
          remaining: '02:02:23'
        },
        {
          section: 'القرآن الكريم',
          course: 'دورة أحكام القرآن الكريم',
          teacher: 'د/محمد اسماعيل',
          hours: '03:30:00',
          completed: '01:45:23',
          remaining: '02:02:23'
        }
      ]
    }
  },
  computed: {
    student () {
      return this.$store.getters['auth/getUser']
    }
  },
  methods: {
    handleOpenDialog (mode) {
      this[mode] = !this[mode]
    },
    handleCloseDialog (mode) {
      this[mode] = false
    },
    handleChangeAvatar () {
      this.profileImage = URL.createObjectURL(this.$refs.profileImg.files[0])
    },
    handleChangeBg () {
      this.bgImage = URL.createObjectURL(this.$refs.bgImg.files[0])
    }
  }
}
</script>

<style lang="scss" scoped>
.search-dialog {
  z-index: 1000;
}
.profile {
  overflow-x: hidden;

  .profile-bg {
    border: solid 3px #80bfff;
    opacity: 0.7;
    background-color: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) );
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

  // :class="{
  //   'q-px-lg q-py-sm': !$q.screen.lt.md,
  //   'q-px-sm q-py-xs': $q.screen.lt.md,
  // }"
}
</style>
