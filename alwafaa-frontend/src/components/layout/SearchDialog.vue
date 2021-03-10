<template>
  <q-card square flat class="q-py-lg">
    <q-card-section>
      <div class="text-h4 text-center text-weight-bold text-grey-5">
        {{ $t('student.search.title') }}
      </div>
    </q-card-section>

    <q-card-section>
      <div class="row justify-center">
        <q-btn
          no-caps
          outlined
          unelevated
          no-wrap
          :label="filtervalue"
          icon-right="mdi-chevron-down"
          color="grey-2"
          text-color="grey-5"
          class="search-filter ellipsis relative"
          style="width: 28%; maxWidth: 200px;"
          @click="() => this.openFilterMenu = !this.openFilterMenu"
        >
          <q-card
            v-if="openFilterMenu"
            class="absolute"
            style="top: 500px"
          >
            <div class="column folter-menu" style="minWidth: 200px">
              <q-option-group
                :options="sectionOptions"
                type="radio"
                v-model="selectedSection"
              />

              <q-separator color="grey-2" />

              <q-option-group
                :options="statusOptions"
                type="checkbox"
                v-model="selectedStatus"
              />
            </div>
          </q-card>
        </q-btn>

        <q-input
          outlined
          square
          bg-color="grey-1"
          class="col-6 search-input"
        >
          <template v-slot:append>
            <q-icon name="mdi-close" color="grey-4" size="sm" class="cursor-pointer" />
            <q-btn
              unelevated
              icon="mdi-magnify"
              color="grey-4"
              text-color="white"
              class="full-height q-ml-md q-px-xs"
            />
          </template>
        </q-input>

      </div>
    </q-card-section>
  </q-card>
</template>

<script>
export default {
  name: 'Search',
  data () {
    return {
      sectionOptions: [
        { label: 'الكل', value: 'الكل' },
        { label: 'القرآن الكريم', value: 'القرآن الكريم' },
        { label: 'اللغة العربية', value: 'اللغة العربية' }
      ],
      selectedSection: '',
      statusOptions: [
        { label: 'الكل', value: 'الكل' },
        { label: 'انتهت', value: 'انتهت' },
        { label: 'لم تبدا', value: 'لم تبدا' },
        { label: 'بدأت', value: 'بدأت' }
      ],
      selectedStatus: [],
      openFilterMenu: false
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
  &.q-btn {
    &::v-deep {
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

.filter-menu::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: black transparent transparent transparent;
}
</style>
