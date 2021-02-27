import Vue from 'vue'
import {
  ValidationProvider,
  ValidationObserver,
  extend,
  localize
} from 'vee-validate'
import { required, email, min, confirmed, numeric } from 'vee-validate/dist/rules'
import arMessages from 'src/modules/authentication/i18n/ar'
import enMessages from 'src/modules/authentication/i18n/en'

Vue.component('ValidationObserver', ValidationObserver)
Vue.component('ValidationProvider', ValidationProvider)

const dictionary = {
  en: {
    messages: enMessages.formValidation
  },
  ar: {
    messages: arMessages.formValidation
  }
}

extend('required', required)

extend('email', email)

extend('min', min)

extend('confirmed', confirmed)

extend('numeric', numeric)

// extend("confirmPass", {
//   params: ["target"],
//   validate(value, { target }) {
//     return value === target;
//   },
// });

// extend("pass", {
//   validate(value) {
//     return value.length > 6;
//   },
//   // message: i18n.t("formValidation.passLengthErr"),
// });

localize('ar')
localize(dictionary)
