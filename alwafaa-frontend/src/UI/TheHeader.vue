<template>
  <q-header elevated>
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

        <q-toolbar-title>
          Alwafaa
        </q-toolbar-title>

         <q-btn flat round dense label="En" @click="changeToEnglish" />
         <q-btn flat round dense label="Ar" @click="changeToArabic" />
      </q-toolbar>
    </q-header>
</template>

<script>
export default {
  name: 'TheHeader',
  methods: {
    async changeToEnglish () {
      this.$i18n.locale = 'en-us'
      this.$i18n.fallbackLocale = 'ar'
      // set quasar's language too!!
      await import('quasar/lang/en-us').then(lang => {
        this.$q.lang.set(lang.default)
      })
    },
    async changeToArabic () {
      this.$i18n.locale = 'ar'
      this.$i18n.fallbackLocale = 'en-us'
      await import('quasar/lang/ar').then(lang => {
        this.$q.lang.set(lang.default)
      })
    }
  }
}
</script>
