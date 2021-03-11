import Vue from 'vue'

import BaseInput from 'src/components/UI/BaseInput'
import BaseSelect from 'src/components/UI/BaseSelect'
import BaseButton from 'src/components/UI/BaseButton'
import VueCarousel from 'vue-carousel'
import VueYouTubeEmbed from 'vue-youtube-embed'
import SlitherSlider from 'slither-slider'
Vue.use(SlitherSlider)

Vue.use(VueYouTubeEmbed)
Vue.use(VueCarousel)

Vue.component('GInput', BaseInput)
Vue.component('GSelect', BaseSelect)
Vue.component('GBtn', BaseButton)

// "async" is optional;
// more info on params: https://quasar.dev/quasar-cli/boot-files
export default async (/* { app, router, Vue ... } */) => {
  // something to do
}
