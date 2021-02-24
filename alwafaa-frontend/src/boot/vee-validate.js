import Vue from 'vue'
import {
  ValidationProvider,
  ValidationObserver,
  extend,
  localize
} from 'vee-validate'
import { required, email, min, confirmed, numeric } from 'vee-validate/dist/rules'

Vue.component('ValidationObserver', ValidationObserver)
Vue.component('ValidationProvider', ValidationProvider)

const dictionary = {
  en: {
    messages: {
      required: 'This field is required',
      email: 'not valid email',
      min: 'Password must have minimum 6 characters',
      confirmed: 'Password confirmation does not match',
      numeric: 'The field field may only contain numeric characters'
    }
  },
  ar: {
    messages: {
      required: 'هذا الحقل مطلوب',
      email: 'بريد إلكتروني غير صحيح',
      min: 'كلمة المرور لا تقل عن 7 حروف',
      confirmed: 'كلمة المرور غير متطابقة',
      numeric: 'رقم الهاتف يجب ان يكون أرقام فقط'
    }
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
