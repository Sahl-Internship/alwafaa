<template>
  <auth-container>
    <form
      class="form-container login-show col-12 col-md"
      @submit.prevent="login"
    >
      <h2>Verify Email</h2>
      <validation-provider v-slot="v">
        <q-input
          v-model="email"
          outlined
          type="email"
          :rules="[(val) => !!val || 'Field is required']"
          color="secondary"
          label="Email"
          class="e-mail"
        >
          <span>{{ v.errors[0] }}</span>
        </q-input>
      </validation-provider>
      <p v-if="!formIsValid">*Enter valid email</p>
      <button class="login">Send verification</button>
    </form>
  </auth-container>
</template>

<script>
import { ValidationProvider, extend } from "vee-validate";
import AuthContainer from "../layout/AuthContainer.vue";

extend("val", (value) => {
  return value === "";
});

export default {
  components: {
    "validation-provider": ValidationProvider,
    AuthContainer,
  },
  data() {
    return {
      email: "",
      formIsValid: true,
    };
  },
  methods: {
    login() {
      this.formIsValid = true;
      if (
        this.email === "" ||
        !this.email.includes("@") ||
        this.password.length < 6
      ) {
        this.formIsValid = false;
      }
    },
  },
};
</script>
<style lang="scss" scoped>
.form-container {
  width: 70%;
  margin: 0px 15%;
  margin-top: 30px;
  border-radius: 10px;
  border: 3px solid $primary;
  background: #fff;
  z-index: 3;
  transform: translate(0, 50%);
  h2 {
    margin: 0px 10%;
    padding-top: 10px;
    width: 80%;
    font-size: 35px;
    font-weight: normal;
    text-align: center;
    color: $secondary;
    @media screen and (max-width: 992px) {
      font-size: 25px;
    }
  }
  .e-mail {
    width: 80%;
    margin: 20px 10%;
    background: #eee;
    padding-bottom: 0;
  }
  p {
    width: 80%;
    margin: 0 10%;
    color: $negative;
  }
  .login {
    width: 80%;
    margin: 20px 10%;
    margin-top: 10px;
    padding: 10px;
    background: $secondary;
    font-size: 20px;
    font-weight: normal;
    color: #f9f9f9;
    border: none;
    outline: none;
    text-transform: uppercase;
    border-radius: 2px;
    cursor: pointer;
    @media screen and (max-width: 992px) {
      font-size: 15px;
    }
  }
}
</style>
