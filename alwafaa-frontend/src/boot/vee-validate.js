import Vue from "vue";

import { ValidationProvider, ValidationObserver, extend } from "vee-validate";

import { required, email } from "vee-validate/dist/rules";

Vue.component("ValidationObserver", ValidationObserver);
Vue.component("ValidationProvider", ValidationProvider);

extend("required", {
  ...required,
  message: "This field is required",
});

extend("email", {
  ...email,
  message: "This field must be a valid email",
});

extend("confirmPass", {
  params: ["target"],
  validate(value, { target }) {
    return value === target;
  },
  message: "Password confirmation does not match",
});

extend("pass", {
  validate(value) {
    return value.length > 6;
  },
  message: "Password must have minimum 6 characters",
});
