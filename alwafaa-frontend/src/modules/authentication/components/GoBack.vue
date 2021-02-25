<template>
<div class="row">
    <div class="col icon-btn">
        <router-link to='/'>
            <i
                @click="goBack"
                class="fas fa-arrow-circle-right"
            ></i>
        </router-link>
    </div>
    <div class="col lang">
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
.lang-btn{
    float: right;
}
.lang-btn:nth-child(1){
    margin-right: 10px;
}
</style>
