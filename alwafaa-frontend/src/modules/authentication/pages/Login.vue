<template>
  <auth-container>
    <form
      class="form-container login-show col-12 col-md"
      @submit.prevent="login"
    >
      <h2>LOGIN</h2>
      <validation-provider v-slot="v">
        <q-input
          v-model="email"
          outlined
          type="email"
          :rules="[(val) => !!val || 'Field is required']"
          color="secondary"
          label="Email or Username"
          class="e-mail"
        >
          <span>{{ v.errors[0] }}</span>
        </q-input>
      </validation-provider>
      <validation-provider v-slot="v">
        <q-input
          v-model="password"
          outlined
          color="secondary"
          :rules="[(val) => !!val || 'Field is required']"
          :type="isPwd ? 'password' : 'text'"
          label="Password"
          class="password"
        >
          <template v-slot:append>
            <q-icon
              :name="isPwd ? 'visibility_off' : 'visibility'"
              class="cursor-pointer"
              @click="isPwd = !isPwd"
            />
          </template>
        </q-input>
        <span>{{ v.errors[0] }}</span>
      </validation-provider>
      <q-checkbox
        label="Remember Me"
        v-model="orange"
        color="secondary"
        class="check"
      />
      <p v-if="!formIsValid">
        *Enter valid email and password more than 6 characters
      </p>
      <button type="submit" class="login">Login</button>
      <router-link to="/forgotPass">Forgot password?</router-link>
      <hr />
      <h6>or use social</h6>
      <google-btn class="social-button"></google-btn>
      <facebook-btn class="social-button face"></facebook-btn>
    </form>
  </auth-container>
</template>

<script>
import { ValidationProvider, extend } from "vee-validate";
import AuthContainer from "../layout/AuthContainer.vue";
import GoogleBtn from "../components/GoogleBtn";
import FacebookBtn from "../components/FacebookBtn.vue";

extend("val", (value) => {
  return value === "";
});

export default {
  name: "login",
  components: {
    "validation-provider": ValidationProvider,
    AuthContainer,
    GoogleBtn,
    FacebookBtn,
  },
  data() {
    return {
      email: "",
      password: "",
      isPwd: true,
      formIsValid: true,
      orange: false,
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
      const user = {
        email: this.email,
        password: this.password,
      };
      this.$store.dispatch("auth/login", user);
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
  h2 {
    margin: 0px 10%;
    padding-top: 10px;
    width: 80%;
    font-size: 35px;
    font-weight: normal;
    text-align: center;
    color: $secondary;
  }
  .e-mail,
  .password {
    width: 80%;
    margin: 20px 10%;
    background: #eee;
    padding-bottom: 0;
  }
  .check {
    margin-left: 10%;
    margin-right: 10px;
  }
  p {
    width: 80%;
    margin: 0 10%;
    color: $negative;
  }
  .login {
    width: 80%;
    margin: 10px 10%;
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
  }
  a {
    display: block;
    width: 80%;
    margin: 0 10%;
    text-decoration: none;
    color: $secondary;
  }
  hr {
    width: 80%;
    margin: 0 10%;
  }
  h6 {
    text-align: center;
    font-size: 14px;
    color: #c7bfbf;
    height: 0px;
    margin: 5px 0 15px 0;
  }
  .social-button {
    margin: 30px 10%;
    width: 80%;
  }
  .face {
    margin-top: 0px;
  }
}
</style>
