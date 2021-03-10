<template>
  <q-header  elevated class="header q-mx-xl">
    <q-toolbar class="row">
      <div class="lt-md">
        <q-btn
          flat
          icon="menu"
          aria-label="Menu"
          @click="leftDrawerOpen = !leftDrawerOpen"
          class="lt-lg"
        />
      </div>
      <q-drawer
        v-model="leftDrawerOpen"
        content-class="bg-grey-5"
      >
        <div class="logo text-center"><img src="/images/home-imgs/logo.png" class="drawer-logo q-ma-md" /></div>
        <q-list class="drawer-lists q-mt-xl">
          <q-item-label header class="text-grey-8">
            <router-link to='/' class="link">{{$t('homeCover.main')}}</router-link>
          </q-item-label>
        </q-list>
        <q-list class="drawer-lists">
          <q-item-label header class="text-grey-8">
            <router-link to="/courses/all" class="link">{{$t('homeCover.availableCourse')}}</router-link>
          </q-item-label>
        </q-list>
        <q-list class="drawer-lists">
          <q-item-label header class="text-grey-8">
            <router-link to="/student/profile" class="link">{{$t('homeCover.studentProfile')}}</router-link>
          </q-item-label>
        </q-list>
        <q-list class="drawer-lists">
          <q-item-label header class="text-grey-8">
            <router-link to="/auth/login" class="link">{{$t('header.login')}}</router-link>
            <span class="q-mx-sm">/</span>
            <router-link to="/auth/signup" class="link">{{$t('header.signup')}}</router-link>
          </q-item-label>
        </q-list>
        <q-list class="drawer-lists">
          <q-item-label header class="text-grey-8">
            <p class="text-white q-ma-none"> {{$t('homeCover.lang')}} :
                          <q-btn flat round dense @click="changeLanguage('en-us', 'ar')" class="q-mx-xm">
              <flag iso="us"/>
            </q-btn>
            <q-btn flat round dense @click="changeLanguage('ar', 'en-us')" class="q-mx-xs">
              <flag iso="eg"/>
            </q-btn>
            </p>

          </q-item-label>
        </q-list>
      </q-drawer>
      <div class="logo col-6 row">
        <img src="/images/home-imgs/logo.png" class="header-img q-mt-md col-3" />
        <ul class="nav-list q-mt-lg col-9 gt-sm">
          <li class="nav-item q-mr-md "><router-link class="link" to="/">{{$t('homeCover.main')}}</router-link></li>
          <li class="nav-item q-mr-md"><router-link class="link" to="/courses/all">  {{$t('homeCover.availableCourse')}}</router-link> </li>
          <li class="nav-item"><router-link class="link" to="/student/profile">  {{$t('homeCover.studentProfile')}}</router-link> </li>
        </ul>
      </div>

      <q-space />

    <div class="left-section col-6 text-right gt-sm">
      <q-btn-dropdown
        flat
        class="transparent q-mr-sm"
        rounded
        :label="$t('homeCover.lang')"
      >
      <q-list class="lang-list">
        <q-item clickable v-close-popup @click="changeLanguage('en-us', 'ar')" class="lang-item">
          <q-btn flat round dense>
            <flag iso="us"/>
          </q-btn>
          <span style="margin-top:6px">En</span>
        </q-item>

        <q-item clickable v-close-popup @click="changeLanguage('ar', 'en-us')" class="lang-item">
          <q-btn flat round dense>
            <flag iso="eg"/>
          </q-btn>
          <span style="margin-top:6px">Ar</span>
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
          class="q-px-lg q-mr-md"
          rounded
          no-caps
          :label="$t('homeCover.signupFree')"
          type="button"
          color="green"
          text-color="dark"
          size="17px"
          to="auth/signup"
        />
        <q-btn
          v-if="!isAuthed"
          outline
          rounded
          no-caps
          :label="$t('header.login')"
          type="button"
          text-color="grey-1"
          size="17px"
          to="auth/login"
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
      text: '',
      leftDrawerOpen: false
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
header.header {
  background: transparent;
  position:relative;
  height: 0;
  @media (max-width: 340px),(max-width: 480px),(max-width: 767px),(max-width: 992px) {
    margin-right: 0px !important;
    margin-left: 0px !important;
  }
  .drawer-logo{
    height: 50px;
    width: 80px;
  }
  .header-img{
    height: 50px;
    width: 80px;
    display: inline-block;
    @media (max-width: 992px){
      height: 40px;
      width: 70px;
      margin-top: 10px;
    }
    @media (max-width: 340px),(max-width: 480px),(max-width: 767px){
      // height: 25px;
      // width: 40px;
      // margin-top: 6px;
      display: none;
    }
  }
  .nav-list{
    list-style: none;
    display: inline-block;
    .nav-item{
      display: inline-block;
    }
  }
  .drawer-lists {
    border-bottom: 1px solid #484848;
  }
  .link {
    color: #fff;
    text-decoration: none;
  }
  span{
    color: #fff;
  }
  .lang-item{
    background: $green;
  }
  .lang-list{
    padding: 0 !important;
    background: $green;
  }
  .lang-btn{
    background: $grey-5;
    height: 50px;
    width: 50px;
    border-radius: 50%;
  }
}
</style>
