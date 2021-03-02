<template>
  <q-header elevated class="header">
    <q-toolbar>
      <q-btn
        flat
        dense
        round
        icon="menu"
        aria-label="Menu"
        @click="leftDrawerOpen = !leftDrawerOpen"
        v-if="false"
      />

      <q-btn flat round to="/home" class="avatar">
        <q-avatar>
          <img src="/images/logo.png" />
        </q-avatar>
      </q-btn>

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

      <q-btn flat round dense @click="changeLanguage('en-us', 'ar')">
        <flag iso="us" />
      </q-btn>
      <q-btn flat round dense @click="changeLanguage('ar', 'en-us')">
        <flag iso="eg" />
      </q-btn>

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
  // background-color: $grey-2;
  .avatar {
    background-color: $grey-1;
    opacity: 0.7;
  }
  .link {
    color: #fff;
    text-decoration: none;
  }
}
</style>
