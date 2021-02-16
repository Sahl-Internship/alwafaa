import Vue from 'vue'
import {

  ValidationProvider,
  ValidationObserver,
  extend
} from 'vee-validate'
import VueI18n from 'vue-i18n'
import validationMessagesEn from 'vee-validate/dist/locale/en.json';
import validationMessagesAr from 'vee-validate/dist/locale/ar.json'
import {
  required,
  email
} from 'vee-validate/dist/rules'

Vue.component('ValidationObserver', ValidationObserver)
Vue.component('ValidationProvider', ValidationProvider)

const i18n = new VueI18n({
  // locale: 'en',
  messages: {
    en: {
      validation: validationMessagesEn
    },
    ar: {
      validation: validationMessagesAr
    }
  }
});
i18n.locale = 'en'

extend('required', {
  ...required,

  // message: 'This field is required'
  message() {
    return i18n.t('validation.messages.required')
  }

})

extend('email', {
  ...email,
  // message: 'This field must be a valid email'
  message() {
    return i18n.t('validation.messages.email')
  }
})

extend('confirmPass', {
  params: ['target'],
  validate(value, {
    target
  }) {
    return value === target
  },
  // message: 'Password confirmation does not match'
  message() {
    return i18n.t('validation.messages.confirmed')
  }
})

extend('pass', {
  validate(value) {
    return value.length > 6
  },
  // message: 'Password must have minimum 6 characters'
  message() {
    return i18n.t('validation.messages.min')
  }
})
