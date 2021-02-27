import Vue from 'vue'

import BaseInput from 'src/components/UI/BaseInput'
import BaseSelect from 'src/components/UI/BaseSelect'

Vue.component('GInput', BaseInput)
Vue.component('GSelect', BaseSelect)

// "async" is optional;
// more info on params: https://quasar.dev/quasar-cli/boot-files
export default async (/* { app, router, Vue ... } */) => {
  // something to do
}
