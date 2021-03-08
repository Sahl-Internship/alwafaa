<template>
  <q-header
    class="header bg-white z-max"
    :class="{
     ' q-px-xl': !$q.screen.lt.md,
    }"
  >
    <q-toolbar>
      <div class="row items-center">
        <q-avatar v-if="!$q.screen.lt.sm">
          <q-img src="https://cdn.quasar.dev/img/boy-avatar.png" />
        </q-avatar>

        <q-toolbar-title
          v-if="!$q.screen.lt.sm"
          class="text-subtitle1 text-grey-5 q-pr-none"
        >
          {{ user.firstname }} {{ user.lastname }}
        </q-toolbar-title>

        <q-btn
          no-caps dense
          flat rounded
          icon="mdi-chevron-down"
          color="grey-5"
          class="q-pr-md relative"
          @click="() => this.openMenu = !this.openMenu "
        >
          <q-card
            v-if="openMenu"
            class="q-pa-lg q-ml-md"
            :class="$q.screen.lt.sm ? 'card-menu-sm' : 'card-menu-bg'"
          >
            <q-card-section class="column items-center">
              <q-avatar>
                <q-img src="https://cdn.quasar.dev/img/boy-avatar.png" />
              </q-avatar>

              <div class="text-h6 text-center">
                {{ user.firstname }} {{ user.lastname }}
              </div>

              <div class="text-subtitle2 text-center text-grey-4">
                {{ user.email }}
              </div>

              <q-btn
                flat
                dense
                :label="$t('student.header.setting')"
                text-color="grey-4"
                class="setting-link"
                @click="$emit('openDialog', 'editMode')"
              />
            </q-card-section>

            <q-card-actions class="column items-center">
              <q-btn
                :label="$t('student.header.logout')"
                color="red-1"
                text-color="red"
                @click="handleLogout"
              />
            </q-card-actions>
          </q-card>
        </q-btn>

        <q-separator vertical />

        <q-btn
          dense round flat
          icon="mdi-bell"
          type="button"
          color="grey-5"
          class="relative"
          :class="$q.screen.lt.md ? 'q-ml-sm' : 'q-ml-lg'"
        >
          <div
            class="absolute alarm-box row justify-center"
            style="top: 9px; left: 14px; transform: translateY(-50%);"
          >
            <q-icon
              name="mdi-circle-medium"
              color="red"
              size="29px"
              style="top: 7px; left: 0.1px; transform: translateY(-50%);"
            />
          </div>
        </q-btn>

        <q-btn
          flat
          dense
          rounded
          icon="mdi-bookmark-outline"
          text-color="grey-4"
          size="17px"
          :class="$q.screen.lt.md ? 'q-mx-xs' : 'q-mx-md'"
          to=""
        />

        <q-btn
          flat
          dense
          rounded
          icon="mdi-magnify"
          text-color="grey-4"
          size="17px"
          @click="$emit('openDialog', 'searchMode')"
        />
      </div>

      <q-space />

      <q-btn flat dense to="/">
        <div v-if="!$q.screen.lt.sm" class="column q-mr-md">
          <div class="text-h5 text-grey-5">أكاديمية إقرأ</div>
          <div class="text-weight-thin text-grey-4 header-caption">
            لتعليم اللغة و القرآن الكريم
          </div>
        </div>

        <q-avatar square size="60px">
          <q-img src="/images/logo.png" />
        </q-avatar>
      </q-btn>
    </q-toolbar>

    <!-- <search
      v-if="searchMode"
      class="full-width"
    ></search> -->

  </q-header>
</template>

<script>
// import Search from './Search'

export default {
  // components: { Search },
  data () {
    return {
      openMenu: false,
      searchVal: '',
      searchMode: false,
      user: {}
    }
  },
  methods: {
    handleLogout () {
      this.$store.dispatch('auth/logout')
    }
  },
  mounted () {
    this.user = this.$store.state.auth.user
  }
}
</script>

<style lang="scss" scoped>
.header-caption {
  font-size: 10px;
}

.alarm-box {
  background-color: white;
  width: 13px;
  height: 13px;
  border-radius: 15px;
}

.card-menu-bg {
  position: absolute;
  top: 45px;
  left: -170px;
  min-width: 325px;
}

.card-menu-sm {
  position: absolute;
  top: 45px;
  left: -20px;
}

.setting-link {
  &.q-btn {
    &::v-deep {
      .block {
        text-decoration: underline;
      }
    }
  }
}
</style>
