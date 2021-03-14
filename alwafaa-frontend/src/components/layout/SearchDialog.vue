<template>
  <q-card square flat class="q-pt-lg">
    <q-card-section>
      <div class="text-h4 text-center text-weight-bold text-grey-5">
        {{ $t('student.search.title') }}
      </div>
    </q-card-section>

    <q-card-section class="q-pb-xl">
      <div class="row justify-center">
        <q-btn
          no-caps outlined
          unelevated no-wrap
          icon-right="mdi-chevron-down"
          color="grey-2"
          text-color="grey-5"
          align="between"
          class="search-filter ellipsis relative-position"
          @click="() => this.openFilterMenu = !this.openFilterMenu"
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
              <div class="column folter-menu" style="minWidth: 200px">
                <q-option-group
                  :options="sectionOptions"
                  type="radio"
                  v-model="selectedSection"
                  color="grey-5"
                />

                <q-separator color="grey-2" />

                <q-option-group
                  :options="statusOptions"
                  type="checkbox"
                  v-model="selectedStatus"
                  color="grey-5"
                />
              </div>
            </q-card>
          </q-menu>
        </q-btn>
        <div v-if="openFilterMenu" class="arrow"></div>

        <q-input
          outlined
          square
          bg-color="grey-1"
          class="col-6 search-input"
        >
          <template v-slot:append>
            <q-icon name="mdi-close" color="grey-4" size="xs" class="cursor-pointer" />
            <q-btn
              unelevated
              icon="mdi-magnify"
              color="grey-4"
              text-color="white"
              class="full-height q-ml-md q-px-xs search-btn"
            />
          </template>
        </q-input>

        <q-btn
          flat dense
          label="إلغاء"
          text-color="grey-3"
          size="lg"
          class="q-ml-lg"
          @click="$emit('closeDialog')"
        />
      </div>
      <div class="row justify-center">
        <div class="col-7 row justify-start q-gutter-x-lg q-mr-lg">
          <q-btn
            v-for="(option, index) in suggestionOptions"
            :key="index"
            flat dense
            text-color="grey-5"
            :label="option"
            class="suggestion-link"
            to=""
          />
        </div>
      </div>
    </q-card-section>

    <q-card-section class="q-px-none q-pb-none">
      <search-result></search-result>
    </q-card-section>

  </q-card>
</template>

<script>
import SearchResult from '../SearchResult.vue'

export default {
  name: 'Search',
  components: { SearchResult },
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
        { label: 'لم تبدا', value: 'لم تبدا' },
        { label: 'بدأت', value: 'بدأت' }
      ],
      selectedStatus: ['الكل'],
      openFilterMenu: false,
      suggestionOptions: [
        ' كورس د/محمد العريفي',
        'كورس د/محمد علي',
        'كورس د/حازم شومان'
      ]
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

.arrow {
  content: "";
  position: absolute;
  top: 65px;
  left: 22%;
  // margin-left: -5px;
  border-width: 10px;
  border-style: solid;
  border-color: transparent transparent $grey-1 transparent;
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
