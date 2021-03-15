<template>
  <q-card square flat class="q-pt-lg">
    <q-card-section>
      <div class="text-h4 text-center text-weight-bold text-grey-5">
        {{ $t('student.search.title') }}
      </div>
    </q-card-section>

    <q-card-section
      class="q-pb-xl"
      :class="$q.screen.lt.sm ? 'q-px-none' : '' "
    >
      <div class="row justify-center col-12">
        <q-btn
          no-caps outlined
          unelevated no-wrap
          :dense="$q.screen.lt.sm"
          icon-right="mdi-chevron-down"
          color="grey-2"
          text-color="grey-5"
          align="between"
          class="search-filter ellipsis"
          :class="$q.screen.lt.sm ? 'search-filter-sm' : ''"
        >
          <div
            class="ellipsis"
            :class="{
              'text-subtitle1': !$q.screen.lt.md,
              'text-caption': $q.screen.lt.md
            }"
          >{{ filtervalue }}</div>

          <q-menu :offset="[0, 12]">
            <q-card>
              <div class="column" style="minWidth: 200px">
                <q-option-group
                  :options="sectionOptions"
                  type="radio"
                  v-model="selectedSection"
                  color="grey-5"
                  @input="filterCourses"
                />

                <q-separator color="grey-2" />

                <q-option-group
                  :options="statusOptions"
                  type="checkbox"
                  v-model="selectedStatus"
                  color="grey-5"
                   @input="filterCourses"
                />
              </div>
            </q-card>
          </q-menu>
        </q-btn>

        <q-input
          outlined
          square
          :dense="$q.screen.lt.sm"
          v-model="searchText"
          bg-color="grey-1"
          class="col-6 search-input"
          @input="filterCourses"
        >
          <template v-slot:append>
            <q-icon
              name="mdi-close"
              color="grey-4"
              size="xs"
              class="cursor-pointer"
              @click="clearSearchText"
            />
            <q-btn
              unelevated
              icon="mdi-magnify"
              color="grey-4"
              text-color="white"
              class="full-height q-ml-md search-btn"
              :class="$q.screen.lt.sm ? 'search-btn-sm' : ''"
              @click="filterCourses"
            />
          </template>
        </q-input>

        <q-btn
          flat dense
          label="إلغاء"
          text-color="grey-3"
          :size="$q.screen.lt.sm ? 'md' : 'lg'"
          :class="$q.screen.lt.sm ? 'col-1 q-pl-md' : 'col-1'"
          @click="$emit('closeDialog')"
        />
      </div>

      <div class="row justify-center">
        <div
          class="col-xs-11 col-sm-7 row q-mr-xl"
          :class="{
            'justify-start q-gutter-x-lg': !$q.screen.lt.sm,
            'justify-center q-gutter-x-sm': $q.screen.lt.sm
          }"
        >
          <q-btn
            v-for="(option, index) in suggestionOptions"
            :key="index"
            flat dense
            text-color="grey-4"
            :label="option"
            :size="$q.screen.lt.sm ? 'xs' : 'md'"
            class="suggestion-link"
            to=""
          />
        </div>
      </div>
    </q-card-section>

    <q-card-section
      class="row justify-center bg-grey-1 q-gutter-y-lg q-px-none q-pb-lg"
    >
      <div
        v-if="joinedFilteredCourses.length"
        class="col-xs-12 col-sm-11 row q-px-md"
      >
        <div class="text-h6 text-grey-3 q-mb-sm"> مشترك بها </div>
        <div class="col-12 row q-gutter-y-sm">
          <search-result-card
            class="col-12"
            v-for="course in joinedFilteredCourses"
            :key="course.id"
            @closeSearchDialog="$emit('closeDialog')"
          ></search-result-card>
        </div>
        <!-- <div v-else class="col-12 text-h6 text-grey-5 q-pl-xl"
        >لا يوجد</div> -->
      </div>

      <div
        v-if="allFilteredCourses.length"
        class="col-xs-12 col-sm-11 row q-px-md q-mt-none"
      >
        <div class="text-h6 text-grey-3 q-my-sm"> الكل </div>
        <div class="col-12 row q-gutter-y-sm">
          <search-result-card
            class="col-12"
            v-for="course in allFilteredCourses"
            :key="course.id"
            :course="course"
            @closeSearchDialog="$emit('closeDialog')"
          ></search-result-card>
        </div>
      </div>
    </q-card-section>

  </q-card>
</template>

<script>
import SearchResultCard from '../SearchResultCard'

export default {
  name: 'Search',
  components: { SearchResultCard },
  data () {
    return {
      sectionOptions: [
        { label: 'الكل', value: 'الكل' },
        { label: 'القرآن الكريم', value: 'القرآن الكريم' },
        { label: 'اللغة العربية', value: 'اللغة العربية' }
      ],
      selectedSection: 'الكل',
      statusOptions: [
        { label: 'الكل', value: 'الكل' },
        { label: 'انتهت', value: 'انتهت' },
        { label: 'لم تبدا', value: 'لم تبدأ' },
        { label: 'بدأت', value: 'بدأت' }
      ],
      selectedStatus: ['الكل'],
      suggestionOptions: [
        ' كورس د/محمد العريفي',
        'كورس د/محمد علي',
        'كورس د/حازم شومان'
      ],
      allCourses: [],
      joinedFilteredCourses: [],
      allFilteredCourses: [],
      searchText: ''
    }
  },
  computed: {
    filtervalue () {
      let value = this.selectedSection ? this.selectedSection : 'Filter By'

      if (this.selectedStatus.length) {
        value = `${this.selectedSection}, ` + this.selectedStatus.join()
      }

      return value
    }
  },
  methods: {
    filterCourses () {
      let filtered = this.allCourses
      const { selectedSection, selectedStatus } = this

      if (this.searchText) {
        filtered = filtered.filter(
          course => course.title.toLowerCase().includes(this.searchText.toLowerCase())
        )

        if (selectedSection && selectedSection !== 'الكل') {
          filtered = filtered.filter(
            course => course.section === selectedSection
          )
        }

        if (
          selectedStatus.length &&
          !selectedStatus.includes('الكل') &&
          selectedStatus.length !== 3
        ) {
          filtered = this.filterByStatus(filtered)
        }

        this.allFilteredCourses = filtered
      } else {
        this.joinedFilteredCourses = []
        this.allFilteredCourses = []
      }
    },
    filterByStatus (filterFrom) {
      let finishedCourses = []
      let notStartedCourses = []
      let startedCourses = []

      if (this.selectedStatus.includes('انتهت')) {
        finishedCourses = filterFrom.filter(
          course => new Date(course.end_at).getTime() < new Date().getTime()
        )
      }
      if (this.selectedStatus.includes('لم تبدأ')) {
        notStartedCourses = filterFrom.filter(
          course => new Date(course.start_at).getTime() > new Date().getTime()
        )
      }
      if (this.selectedStatus.includes('بدأت')) {
        startedCourses = filterFrom.filter(
          course => new Date(course.start_at).getTime() < new Date().getTime() &&
            new Date(course.end_at).getTime() > new Date().getTime()
        )
      }

      return [
        ...finishedCourses,
        ...notStartedCourses,
        ...startedCourses
      ]
    },
    clearSearchText () {
      this.searchText = ''
    }
  },
  mounted () {
    this.$store.dispatch('courses/getCourses').then(() => {
      this.filteredCourses = this.allCourses = this.$store.getters['courses/getCourses']
    })
  }
}
</script>

<style lang="scss" scoped>
.search-filter {
  width: 28%;
  max-width: 200px;

  &.q-btn {
    &::v-deep {
      border-radius: 0;
      border-top-left-radius: 8px;
      border-bottom-left-radius: 8px;

      .q-btn__wrapper, .q-btn__wrapper::before {
        border-radius: 0;
        border: solid 1px $grey-3;
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
      }
    }
  }
}

.search-filter-sm {
  &.q-btn {
    &::v-deep {
      .q-btn__wrapper {
        padding-left: 3px;
        padding-right: 3px;
      }
    }
  }
}

.search-input {
  &.q-input {
  &::v-deep {
    border-top-right-radius: 8px;
    border-bottom-right-radius: 8px;

    .q-field__control::before,
    .q-field__append::after {
      border-left: none;
      border-top-right-radius: 8px;
      border-bottom-right-radius: 8px;
    }

    .q-field__control {
      padding-right: 0;
    }
  }
}
}

.search-btn {
  &.q-btn {
    &::v-deep {
      border-radius: 8px;

      .q-btn__wrapper, .q-btn__wrapper::before {
        border-radius: 0;
        border-radius: 8px;
      }
    }
  }
}

.search-btn-sm {
  width: 40px;
}

.suggestion-link {
  &.q-btn {
    &::v-deep {
      .block {
        text-decoration: underline;
      }
    }
  }
}

</style>
