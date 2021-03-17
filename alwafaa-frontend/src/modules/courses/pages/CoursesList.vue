<template>
  <div class="courses-list">

    <q-separator color="grey-1" />

    <div class="row justify-center">

      <div
        class="col-xs-12 col-sm-11 row q-py-lg q-pr-md"
        :class="$q.screen.lt.md ? 'q-gutter-y-lg q-pl-md' : 'q-gutter-y-xl q-pl-sm'"
      >
        <div class="col-12">
          <q-breadcrumbs
            separator=">"
            separator-color="grey-3"
            active-color="grey-3"
          >
            <q-breadcrumbs-el :label="$t('coursesList.home')" color="grey-3" to="/" />
            <q-breadcrumbs-el :label="$t('coursesList.courses')" />
          </q-breadcrumbs>
        </div>

        <div
          class="text-weight-bold text-grey-5 text-left"
          :class="$q.screen.lt.sm ? 'text-h5' : 'text-h4'"
        >
          {{ $t('coursesList.title') }}
        </div>

        <div class="col-12 row justify-between q-gutter-y-sm">
          <div
            class="col-xs-12 col-sm-8"
            :class="!$q.screen.lt.sm ? 'q-pr-sm' : ''"
          >
            <q-select
              dense borderless
              use-input hide-dropdown-icon
              v-model="selectedTitle"
              :label="$t('coursesList.search')"
              bg-color="grey-1"
              :options="coursesOptions"
              @filter="filterTitles"
              @input-value="(val) => this.typing = val"
              @input="filterCourses"
              class="search-input ellipsis"
            >
              <template v-slot:append>
                <q-btn
                  unelevated
                  icon="mdi-magnify"
                  :color="typing ? 'green' : 'grey-2'"
                  text-color="grey-5"
                  class="full-height q-ml-md q-px-xs"
                  @click="filterCourses"
                />
              </template>
              <template v-slot:no-option>
                <q-item>
                  <q-item-section class="text-grey">
                    لا يوجد
                  </q-item-section>
                </q-item>
              </template>
            </q-select>
          </div>

          <div
            class="col-xs-12 col-sm-4 row justify-between"
            :class="{
              'q-pl-md': !$q.screen.lt.md,
              'q-pl-sm': $q.screen.lt.md && !$q.screen.lt.sm,
            }"
          >
            <q-btn
              no-caps no-wrap
              unelevated
              no-icon-animation
              icon-right="mdi-chevron-down"
              text-color="grey-5"
              color="grey-1"
              align="between"
              class="filter-select"
              :class="$q.screen.lt.md ? 'filter-select-sm' : ''"
            >
              <div
                v-if="!selectedSection"
                class="text-grey-3 ellipsis"
                :class="{
                  'text-subtitle1': !$q.screen.lt.md,
                  'text-caption': $q.screen.lt.md
                }"
              >
                {{ $t('coursesList.section') }}
              </div>

              <div v-else class="row justify-start items-center no-wrap ellipsis">
                <q-img
                  v-if="!$q.screen.lt.md"
                  :src="selectedSection.src"
                  width="16px"
                  class="q-mr-sm"
                />
                <div
                  :class="{
                    'text-subtitle1': !$q.screen.lt.md,
                    'text-caption': $q.screen.lt.md
                  }"
                >{{ $t(`coursesList.${selectedSection.label}`) }}</div>
              </div>

              <q-menu fit>
                <q-list
                  class="q-pa-sm"
                  :class="$q.screen.lt.md ? 'list-sm' : 'list-lg'"
                >
                  <q-item
                    clickable v-close-popup
                    v-for="(option, index) in sectionsOptions"
                    :key="index"
                    @click="selectSection(index)"
                    :class="{
                      'bg-grey-1': index === activeSectionIndex
                    }"
                  >
                    <q-item-section>
                      <div class="row justify-start">
                        <img :src="option.src" class="q-mr-sm filter-icon" />
                        <q-item-label
                          :class="index === activeSectionIndex ? 'text-grey-5' : 'text-grey-4'"
                        >
                          {{ $t(`coursesList.${option.label}`) }}
                        </q-item-label>
                      </div>
                    </q-item-section>
                  </q-item>
                </q-list>
              </q-menu>
            </q-btn>

            <q-btn
              no-caps
              no-wrap
              unelevated
              no-icon-animation
              icon-right="mdi-chevron-down"
              text-color="grey-5"
              color="grey-1"
              align="between"
              class="filter-select"
              :class="$q.screen.lt.md ? 'filter-select-sm' : ''"
            >
              <div
                v-if="!selectedStatus"
                class="text-grey-3 ellipsis"
                :class="{
                  'text-subtitle1': !$q.screen.lt.md,
                  'text-caption': $q.screen.lt.md
                }"
              >{{ $t('coursesList.status') }}</div>

              <div v-else class="row justify-start items-center no-wrap ellipsis">
                <q-img
                  v-if="!$q.screen.lt.md"
                  :src="selectedStatus.src"
                  width="16px"
                  class="q-mr-sm"
                />
                <div
                  :class="{
                    'text-subtitle1': !$q.screen.lt.md,
                    'text-caption': $q.screen.lt.md
                  }"
                >{{ $t(`coursesList.${selectedStatus.label}`) }}</div>
              </div>

              <q-menu fit>
                <q-list
                  class="q-pa-sm"
                  :class="$q.screen.lt.md ? 'list-sm' : 'list-lg'"
                >
                  <q-item
                    clickable v-close-popup
                    v-for="(option, index) in statusOptions"
                    :key="index"
                    @click="selectStatus(index)"
                    :class="{
                      'bg-grey-1': index === activeStatusIndex
                    }"
                  >
                    <q-item-section>
                      <div class="row justify-start">
                        <img :src="option.src" class="q-mr-sm filter-icon" />
                        <q-item-label
                          :class="index === activeSectionIndex ? 'text-grey-5' : 'text-grey-4'"
                        >
                          {{ $t(`coursesList.${option.label}`) }}
                        </q-item-label>
                      </div>
                    </q-item-section>
                  </q-item>
                </q-list>
              </q-menu>
            </q-btn>

          </div>

        </div>
      </div>

      <div class="col-12 row justify-center bg-grey-2">
        <div
          class="col-xs-12 col-sm-11 row q-gutter-y-lg q-pt-lg"
          :class="{
            'q-gutter-x-lg': !$q.screen.lt.md,
            'q-gutter-x-sm': $q.screen.lt.md,
            'justify-center': $q.screen.lt.sm
          }"
        >
          <course-card
            v-for="course in shownCourses"
            :key="course.id"
            :course="course"
          ></course-card>
        </div>

        <div class="col-12 q-my-xl text-center">
          <q-btn
            flat
            no-caps
            type="button"
            icon-right="mdi-chevron-down"
            :label="$t('coursesList.more')"
            text-color="blue"
            size="lg"
            class="show-more"
            @click="getShownCourses"
          />
          <div class="text-subtitle1 text-grey-3 text-center">
            {{ shownCourses.length }} {{ $t('coursesList.from') }} {{ filteredCourses.length }}
          </div>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
import CourseCard from '../components/CourseCard'
import { i18n } from 'src/boot/i18n'

export default {
  name: 'CoursesList',
  components: {
    CourseCard
  },
  data () {
    return {
      allCourses: [],
      filteredCourses: [],
      shownCourses: [],
      sectionsOptions: [
        {
          label: 'all',
          src: '/images/Group 5797.png'
        },
        {
          label: 'arabicSec',
          src: '/images/Path 9259.png'
        },
        {
          label: 'quran',
          src: '/images/Group 5796.png'
        }
      ],
      selectedSection: null,
      activeSectionIndex: null,
      statusOptions: [
        {
          label: 'all',
          src: '/images/Group 5797.png'
        },
        {
          label: 'finished',
          src: '/images/Group 5806.png'
        },
        {
          label: 'notStarted',
          src: '/images/Path 9266.png'
        },
        {
          label: 'started',
          src: '/images/Group 5803.png'
        }
      ],
      selectedStatus: null,
      activeStatusIndex: null,
      coursesTitles: [],
      coursesOptions: [],
      selectedTitle: '',
      typing: ''
    }
  },
  methods: {
    getShownCourses () {
      this.shownCourses = this.filteredCourses.slice(0, this.shownCourses.length + 3)
    },
    selectSection (index) {
      this.selectedSection = this.sectionsOptions[index]
      this.activeSectionIndex = index

      this.filterCourses()
    },
    selectStatus (index) {
      this.selectedStatus = this.statusOptions[index]
      this.activeStatusIndex = index

      this.filterCourses()
    },
    filterTitles (val, update, abort) {
      if (val.length < 1) {
        abort()
        return
      }

      update(() => {
        const title = val.toLowerCase()
        this.coursesOptions = this.coursesTitles.filter(
          courseTitle => courseTitle.toLowerCase().indexOf(title) > -1
        )
      })
    },
    filterCourses () {
      let filtered = this.allCourses
      const { selectedTitle, selectedSection, selectedStatus } = this

      if (selectedTitle) {
        filtered = filtered.filter(course => course.title === selectedTitle)
      }

      if (
        selectedSection &&
        (selectedSection.label !== '' && selectedSection.label !== 'all')
      ) {
        filtered = filtered.filter(
          course => course.section === i18n.t(`coursesList.${selectedSection.label}`)
        )
      }

      if (selectedStatus &&
        (selectedStatus.label !== '' && selectedStatus.label !== 'all')
      ) {
        filtered = this.filterByStatus(filtered, selectedStatus.label)
      }
      this.filteredCourses = filtered
      this.shownCourses = []
      this.getShownCourses()
    },
    filterByStatus (filterFrom, status) {
      const today = new Date().getTime() / 1000

      if (status === 'finished') {
        return filterFrom.filter(
          course => new Date(course.end_at).getTime() < today
        )
      } else if (status === 'notStarted') {
        return filterFrom.filter(
          course => new Date(course.start_at).getTime() > today
        )
      } else {
        return filterFrom.filter(
          course => new Date(course.start_at).getTime() < today &&
            new Date(course.end_at).getTime() > today
        )
      }
    }
  },
  mounted () {
    this.$store.dispatch('courses/getCourses').then(() => {
      const courses = this.$store.getters['courses/getCourses']
      this.filteredCourses = this.allCourses = courses
      this.getShownCourses()
      this.coursesOptions = this.coursesTitles = courses.map(course => course.title)
    })
  }
}
</script>

<style lang="scss" scoped>
.courses-list {
  overflow-x: hidden;
}

.search-input {
  height: 44px;

  &.q-select {
    &::v-deep {
      border-radius: 8px;
      border: solid 2px $grey-2;

      .q-field__control {
        padding-right: 0;
        border-radius: 8px;
      }

      .q-field__label {
        color: $grey-3;
        font-size: 17px;
        padding-left: 15px;
      }
    }

    .q-btn {
      &::v-deep {
        border-radius: 4px;
      }
    }
  }
}

.filter-select {
  width: 46%;

  &.q-btn {
    &::v-deep {
      border-radius: 8px;
      border: solid 2px $grey-2;
    }
  }
}

.filter-select-sm {
  &.q-btn {
    &::v-deep {
      .q-btn__wrapper {
        padding-left: 3px;
        padding-right: 3px;
      }

      .q-icon {
        font-size: 20px;
      }
    }
  }
}

.list-lg {
  &.q-list {
    &::v-deep {
      .q-item__label {
        font-size: 15px;
      }
    }

    img {
      width: 16px;
      height: 16px;
    }
  }
}

.list-sm {
  &.q-list {
    &::v-deep {
      .q-item__label {
        font-size: 11px;
      }
    }

    img {
      width: 11px;
      height: 11px;
    }
  }
}

.show-more {
  &.q-btn {
    &::v-deep {
      .q-icon {
        font-size: 25px;
        margin-left: 5px;
      }
    }
  }
}
</style>
