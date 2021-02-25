<template>
  <div
    class="row q-mt-none"
    :class="{reverse: checkFlip}"
  >
    <div
      class="col-6 row"
      :class="{
        'justify-end': checkFlip,
        'justify-start': !checkFlip
      }"
    >
      <q-btn
        v-if="!checkFlip"
        flat
        rounded
        dense
        :icon="checkDirection? 'fas fa-arrow-circle-right' : 'fas fa-arrow-circle-left'"
        color="green"
        class="q-ml-md"
        to="/"
      />
      <q-btn
        v-else
        flat
        rounded
        dense
        :icon="checkDirection? 'fas fa-arrow-circle-left' : 'fas fa-arrow-circle-right'"
        color="green"
        class="q-mr-md"
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
        <q-btn
            class="lang-btn"
            flat round dense
            @click="changeLanguage('en-us', 'ar')"
        >
          <flag iso="us" />
        </q-btn>

        <q-btn
            class="lang-btn"
            flat round dense
            @click="changeLanguage('ar', 'en-us')"
        >
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
i{
    font-size: 30px;
    margin-left: 20px;
    color: $green;
}
// .lang-btn{
//     float: right;
// }
// .lang-btn:nth-child(1){
//     margin-right: 10px;
// }
</style>
