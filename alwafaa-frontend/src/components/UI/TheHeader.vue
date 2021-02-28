<template>
  <q-header elevated class="header">
    <q-toolbar class="row">
      <q-btn
        flat
        dense
        round
        icon="menu"
        aria-label="Menu"
        @click="leftDrawerOpen = !leftDrawerOpen"
        v-if="false"
      />
      <!-- <q-btn flat round to="/home" class="avatar"> -->
      <div class="logo col-6 row">
        <img src="~/assets/home-imgs/logo.png" class="img q-mt-md col-3" />
        <ul class="nav-list q-mt-lg col-9">
          <li class="nav-item q-mr-md">الرئيسية</li>
          <li class="nav-item">الكورسات المتاحة</li>
        </ul>
      </div>
      <!-- </q-btn> -->

      <q-space />

      <!-- <q-input
        outlined
        dense
        type="search"
        label="Search For a Course"
        label-color="secondary"
        bg-color="gray"
        color="white"
        v-model="text"
        input-class="text-right"
        class="q-ml-md search-input"
      >
        <template v-slot:append>
          <q-separator vertical inset color="white" />
          <q-icon v-if="text === ''" name="search" color="white" />
          <q-icon
            v-else
            name="clear"
            class="cursor-pointer"
            @click="text = ''"
          />
        </template>
      </q-input> -->
    <div class="left-section col-6 text-right">
      <q-btn-dropdown
        flat
        class="transparent"
        rounded
        label="اللغة"
      >
      <q-list>
        <q-item clickable v-close-popup class="lang-item">
          <q-btn flat round dense @click="changeLanguage('en-us', 'ar')">
            <flag iso="us"/>
          </q-btn>
        </q-item>

        <q-item clickable v-close-popup class="lang-item">
          <q-btn flat round dense @click="changeLanguage('ar', 'en-us')">
            <flag iso="eg"/>
          </q-btn>
        </q-item>
      </q-list>
      </q-btn-dropdown>
        <q-btn
          v-if="isAuthed"
          flat
          no-caps
          :label="$t('header.logout')"
          type="button"
          text-color="grey-1"
          size="17px"
          @click="handleLogout"
        />
        <q-btn
          v-if="!isAuthed"
          flat
          no-caps
          :label="$t('header.login')"
          type="button"
          text-color="grey-1"
          size="17px"
          to="auth/login"
        />
        <q-btn
          v-if="!isAuthed"
          flat
          no-caps
          :label="$t('header.signup')"
          type="button"
          text-color="grey-1"
          size="17px"
          to="auth/signup"
        />
      </div>
    </q-toolbar>
  </q-header>
</template>

<script>
import { localize } from 'vee-validate'

export default {
  name: 'TheHeader',
  data () {
    return {
      text: ''
    }
  },
  computed: {
    isAuthed () {
      return this.$store.getters['auth/isAuthenticated']
    }
  },
  methods: {
    async changeLanguage (language, prevLang) {
      this.$i18n.locale = language
      localize(language)
      this.$i18n.fallbackLocale = prevLang
      // set quasar's language too!!
      await import(`quasar/lang/${language}`).then((lang) => {
        this.$q.lang.set(lang.default)
      })
    },
    handleLogout () {
      this.$store.dispatch('auth/logout')
    }
  }
}
</script>
<style lang="scss" scoped>
.header {
  background: transparent;
  height: 0;
  .img{
    height: 50px;
    width: 80px;
    display: inline-block;
  }
  .nav-list{
    list-style: none;
    display: inline-block;
    .nav-item{
      display: inline-block;
    }
  }
  .link {
    color: #fff;
    text-decoration: none;
  }
}
</style>
