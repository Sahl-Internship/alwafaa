<template>
  <div class="courses-list">

    <q-separator color="grey-1" />

    <div class="row justify-center">
      <div class="col-xs-12  col-sm-11 row q-py-lg q-px-md">
        <div class="col-12">
          <q-breadcrumbs
            separator=">"
            separator-color="grey-3"
            active-color="grey-3"
          >
            <q-breadcrumbs-el label="الرئيسية" color="grey-3" to="/" />
            <q-breadcrumbs-el label="الدورات" />
          </q-breadcrumbs>
        </div>

        <div class="text-h4 text-weight-bold text-grey-5 text-left q-my-xl">
          الدورات المتاحة
        </div>

        <div class="col-12 row justify-between q-gutter-y-sm">
          <q-input
            dense
            borderless
            v-model="searchText"
            placeholder="عن ماذا تبحث؟"
            bg-color="grey-1"
            class="col-xs-12 col-sm-6 search-input"
          >
            <template v-slot:append>
              <q-btn
                unelevated
                icon="mdi-magnify"
                :color="searchText ? 'green' : 'grey-2'"
                text-color="grey-5"
                class="full-height q-ml-md q-px-xs"
              />
            </template>
          </q-input>

          <q-btn
            no-caps
            unelevated
            no-icon-animation
            icon-right="mdi-chevron-down"
            text-color="grey-5"
            color="grey-1"
            align="between"
            class="filter-select"
          >
            <div v-if="!selectedSection" class="text-subtitle1 text-grey-3">
              فئة الدورة
            </div>

            <div v-else class="row justify-start items-center">
              <q-img :src="selectedSection.src" width="16px" class="q-mr-sm" />
              <div class="text-subtitle1">{{ selectedSection.label }}</div>
            </div>

            <q-menu max-width="175px">
              <q-list style="width: 175px" class="q-pa-sm">
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
                      <q-img :src="option.src" width="16px" class="q-mr-sm" />
                      <q-item-label>{{ option.label }}</q-item-label>
                    </div>
                  </q-item-section>
                </q-item>
              </q-list>
            </q-menu>
          </q-btn>

          <q-btn
            no-caps
            unelevated
            no-icon-animation
            icon-right="mdi-chevron-down"
            text-color="grey-5"
            color="grey-1"
            align="between"
            class="filter-select"
          >
            <div class="row justify-start items-center">
              <q-img :src="selectedLanguage.src" width="16px" height="16px" class="q-mr-sm" />
              <div class="text-subtitle1">{{ selectedLanguage.label }}</div>
            </div>

            <q-menu max-width="175px">
              <q-list style="width: 175px" class="q-pa-sm">
                <q-item
                  clickable v-close-popup
                  v-for="(option, index) in languagesOptions"
                  :key="index"
                  @click="selectLanguage(index)"
                  :class="{
                    'bg-grey-1': index === activeLanguageIndex
                  }"
                >
                  <q-item-section>
                    <div class="row justify-start">
                      <q-img :src="option.src" width="16px" class="q-mr-sm" />
                      <q-item-label>{{ option.label }}</q-item-label>
                    </div>
                  </q-item-section>
                </q-item>
              </q-list>
            </q-menu>
          </q-btn>

          <q-btn
            no-caps
            unelevated
            no-icon-animation
            icon-right="mdi-chevron-down"
            text-color="grey-5"
            color="grey-1"
            align="between"
            class="filter-select"
          >
            <div v-if="!selectedStatus" class="text-subtitle1 text-grey-3">
              حالة الدورة
            </div>

            <div v-else class="row justify-start items-center">
              <q-img :src="selectedStatus.src" width="16px" class="q-mr-sm" />
              <div class="text-subtitle1">{{ selectedStatus.label }}</div>
            </div>

            <q-menu max-width="175px">
              <q-list style="width: 175px" class="q-pa-sm">
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
                      <img :src="option.src" width="16px" class="q-mr-sm" />
                      <q-item-label>{{ option.label }}</q-item-label>
                    </div>
                  </q-item-section>
                </q-item>
              </q-list>
            </q-menu>
          </q-btn>

        </div>
      </div>

      <div class="col-12 row justify-center bg-grey-2">
        <div
          class="col-11 row q-gutter-lg q-px-sm q-pt-lg"
          :class="{
            'justify-start': !$q.screen.lt.sm,
            'justify-center': $q.screen.lt.sm,
          }"
        >
          <course-card
            v-for="x in shownCourses"
            :key="x"
          ></course-card>
        </div>

        <div class="col-12 q-my-xl text-center">
          <q-btn
            flat
            type="button"
            icon-right="mdi-chevron-down"
            label="عرض المزيد"
            text-color="blue"
            size="lg"
            class="show-more"
            @click="getShownCourses"
          />
          <div class="text-subtitle1 text-grey-3 text-center">
            {{ shownCourses.length }} من {{ allCourses.length }}
          </div>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
import CourseCard from '../components/CourseCard'

export default {
  name: 'CoursesList',
  components: {
    CourseCard
  },
  data () {
    return {
      searchText: '',
      sectionValue: null,
      sectionsOptions: [
        {
          label: 'الكل',
          src: '/images/Group 5797.png'
        },
        {
          label: 'اللغة العربية',
          src: '/images/Path 9259.png'
        },
        {
          label: 'القرآن الكريم',
          src: '/images/Group 5796.png'
        }
      ],
      selectedSection: null,
      activeSectionIndex: null,
      languagesOptions: [
        {
          label: 'العربية',
          src: '/images/united-arab-emirates.png'
        },
        {
          label: 'الإنجليزية',
          src: '/images/united-states.png'
        }
      ],
      selectedLanguage: {
        label: 'العربية',
        src: '/images/united-arab-emirates.png'
      },
      activeLanguageIndex: 0,
      statusOptions: [
        {
          label: 'الكل',
          src: '/images/Group 5797.png'
        },
        {
          label: 'انتهت',
          src: '/images/Group 5806.png'
        },
        {
          label: 'لم تبدأ',
          src: '/images/Path 9266.png'
        },
        {
          label: 'بدأت',
          src: '/images/Group 5803.png'
        }
      ],
      selectedStatus: null,
      activeStatusIndex: null,
      allCourses: [0, 1, 2, 3, 4, 5, 6, 7, 8],
      shownCourses: [0, 1, 2]
    }
  },
  methods: {
    selectLanguage (index) {
      this.selectedLanguage = this.languagesOptions[index]
      this.activeLanguageIndex = index
    },
    selectSection (index) {
      this.selectedSection = this.sectionsOptions[index]
      this.activeSectionIndex = index
    },
    selectStatus (index) {
      this.selectedStatus = this.statusOptions[index]
      this.activeStatusIndex = index
    },
    getShownCourses () {
      this.shownCourses = this.allCourses.slice(0, this.shownCourses.length + 3)
    }
  }
}
</script>

<style lang="scss" scoped>
.courses-list {
  overflow-x: hidden;
}
.search-input {
  &.q-input {
    &::v-deep {
      border-radius: 8px;
      border: solid 2px $grey-2;

      .q-field__control {
        padding-right: 0;
        border-radius: 8px;
      }

      .q-placeholder {
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
  width: 14.7%;
  min-width: 150px;

  &.q-btn {
    &::v-deep {
      border-radius: 8px;
      border: solid 2px $grey-2;

      .block {
        color: $grey-3;
        font-size: 17px;
      }
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
