<template>
  <q-header
    class="header bg-white z-top"
    :class="{
     ' q-px-xl': !$q.screen.lt.md,
    }"
  >
    <q-toolbar>
      <div class="row items-center">
        <q-avatar v-if="isAuthenticated && !$q.screen.lt.sm">
          <q-img src="https://cdn.quasar.dev/img/boy-avatar.png" />
        </q-avatar>

        <!-- <q-toolbar-title
          v-if="isAuthenticated && !$q.screen.lt.sm"
          class="text-subtitle1 text-grey-5 q-pr-none"
        >
          {{ student.firstname }} {{ student.lastname }}
        </q-toolbar-title> -->
          <q-btn
            v-if="isAuthenticated && !$q.screen.lt.sm"
            flat
            dense
            no-caps
            :label="student.firstname +' '+ student.lastname"
            text-color="grey-5"
            size="20px"
            to="/student/profile"
          />

        <q-btn
          no-caps dense
          flat rounded
          icon="mdi-chevron-down"
          color="grey-5"
          class="q-pr-md relative"
          @click="() => this.openMenu = !this.openMenu "
        >
          <q-card
            v-if="openMenu && isAuthenticated"
            class="q-pa-lg q-ml-md card-menu"
            :class="$q.screen.lt.sm ? 'card-menu-sm' : 'card-menu-bg'"
          >
            <q-card-section class="column items-center">
              <q-avatar>
                <q-img src="https://cdn.quasar.dev/img/boy-avatar.png" />
              </q-avatar>

              <!-- <div class="text-h6 text-center">
                {{ student.firstname }} {{ student.lastname }}
              </div> -->
              <q-btn
                flat
                dense
                no-caps
                :label="student.firstname +' '+ student.lastname"
                text-color="grey-5"
                size="20px"
                style="height: 37px"
                to="/student/profile"
                @click="() => this.openMenu = !this.openMenu"
              />

              <div class="text-subtitle2 text-center text-grey-4">
                {{ student.email }}
              </div>

              <q-btn
                flat
                dense
                :label="$t('student.header.setting')"
                text-color="grey-4"
                class="setting-link"
                @click="toggleSettingDialog"
              />
            </q-card-section>

            <q-card-actions class="column items-center">
              <q-btn
                no-caps
                :label="$t('student.header.logout')"
                color="red-1"
                text-color="red"
                @click="handleLogout"
              />
            </q-card-actions>
          </q-card>

          <q-card
            v-if="openMenu && !isAuthenticated"
            class="card-menu-unAuth q-px-sm"
          >
            <q-list>
              <q-item
                clickable
                v-close-popup
                to="/auth/login"
              >
                <q-item-section>
                  {{ $t('student.header.login') }}
                </q-item-section>
              </q-item>

              <q-separator />

              <q-item
                clickable
                v-close-popup
                to="/auth/signup"
              >
                <q-item-section>
                  {{ $t('student.header.signup') }}
                </q-item-section>
              </q-item>
            </q-list>
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
          @click="$emit('ToggleSearchDialog')"
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

  </q-header>
</template>

<script>
export default {
  data () {
    return {
      openMenu: false,
      searchVal: '',
      searchMode: false
    }
  },
  computed: {
    student () {
      return this.$store.getters['auth/getUser']
        ? this.$store.getters['auth/getUser'] : {}
    },
    isAuthenticated () {
      return this.$store.getters['auth/isAuthenticated']
    }
  },
  methods: {
    handleLogout () {
      this.$store.dispatch('auth/logout')
    },
    toggleSettingDialog () {
      this.$store.commit('student/toggleEditDialog')
    }
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

.card-menu-unAuth {
  position: absolute;
  top: 45px;
  min-width: 140px;
  left: 2px;
}

.card-menu {
  position: absolute;
  top: 45px;
  min-width: 300px;
}

.card-menu-bg {
  left: -170px;
}

.card-menu-sm {
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
