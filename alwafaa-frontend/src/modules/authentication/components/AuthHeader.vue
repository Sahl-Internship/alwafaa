<template>
  <div
    class="row q-mt-none auth-header"
    :class="{reverse: checkFlip}"
  >
    <div
      class="col-6 row"
      :class="{
        'justify-end': checkFlip,
        'justify-start': !checkFlip
      }"
    >
      <g-btn
        flat
        dense
        type="button"
        :icon="iconName"
        textColor="green"
        :margin="['q-ml-md']"
        size="md"
        to="/"
      />
    </div>

    <div
      class="col-6 row items-center lang"
      :class="{
        'justify-end': !checkFlip,
        'justify-start': checkFlip
      }"
    >
      <q-btn flat round dense @click="changeLanguage('en-us', 'ar')">
        <flag iso="us" />
      </q-btn>
      <q-btn flat round dense @click="changeLanguage('ar', 'en-us')">
        <flag iso="eg" />
      </q-btn>
    </div>
  </div>
</template>
<script>
import { localize } from 'vee-validate'
export default {
  computed: {
    checkFlip () {
      return this.$route.name === 'signup'
    },
    checkDirection () {
      return this.$q.lang.rtl
    },
    iconName () {
      return this.checkFlip
        ? this.checkDirection ? 'fas fa-arrow-circle-left' : 'fas fa-arrow-circle-right'
        : this.checkDirection ? 'fas fa-arrow-circle-right' : 'fas fa-arrow-circle-left'
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
    }
  }
}
</script>
<style lang='scss' scoped>
.auth-header {
  height: 50px;
}
</style>
