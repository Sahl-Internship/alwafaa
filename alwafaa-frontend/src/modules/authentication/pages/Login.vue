<template>
  <auth-container>
    <form
      class="form-container login-show col-12 col-md"
      @submit.prevent="login()"
    >
      <h2>{{ $t("loginTitle") }}</h2>
      <validation-provider v-slot="v">
        <q-input
          v-model="email"
          outlined
          type="text"
          :rules="[(val) => !!val || 'Field is required']"
          color="secondary"
          :label="$t('email_username')"
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
          :label="$t('password')"
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
        :label="$t('rememberMe')"
        v-model="orange"
        color="secondary"
        class="check"
      />
      <p v-if="!formIsValid">
        *Enter valid email and password more than 6 characters
      </p>
      <button type="submit" class="login">
        {{ $t("loginTitle") }}
      </button>
      <router-link to="/forgotPass">{{ $t("forgotPassword") }}</router-link>
      <hr />
      <h6>{{ $t("useSocial") }}</h6>
      <google-btn class="social-button" status="login"></google-btn>
      <facebook-btn class="social-button face" status="login"></facebook-btn>
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
      if (this.email === "" || this.password.length < 6) {
        this.formIsValid = false;
        return;
      }
      const user = {
        email: this.email,
        password: this.password,
      };
      this.$store.dispatch("auth/login", user).then(() => {
        this.$router.replace("/");
      });
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
  background-color: #fff;
  z-index: 100;
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
  // .social{
  //   text-align: center;
  //   button.facebook__container{
  //     background: #1976D2;
  //     width: 80%;
  //     margin: 20px 10%;
  //     height: 50px;
  //     h6{
  //       color: #fff;
  //     }

  //     i.fa-facebook{
  //       color: #FFF;
  //       font-size: 25px;
  //       float: left;
  //       left: 100px;
  //       padding-top:10px;
  //       margin-left: 100px;

  //       @media screen and (min-width:992px) {
  //         margin-top: -14px;
  //         margin-left: 80px;
  //       }
  //       @media screen and (max-width:992px) {
  //         font-size: 25px;
  //         margin-left: 140px;
  //         margin-top: -12px;
  //       }
  //       @media screen and (max-width:767px) {
  //           font-size: 25px;
  //           padding-top: 10px;
  //           margin-left: 80px;
  //       }
  //       @media screen and (max-width:480px) {
  //         font-size: 20px;
  //         padding-top: 12px;
  //         margin-left: 10px;
  //       }
  //       @media screen and (max-width:340px) {
  //           font-size: 18px;
  //           padding-top: 12px;
  //           margin-left: 5px;
  //       }
  //     }
  //   }
  //   button.facebook__container h6,
  //   button.google__container h6{
  //     padding: 0px 123px;
  //     margin-top: -5px;
  //     @media screen and (min-width:992px) {
  //       padding: 0px 30px;
  //       margin-top: -5px;
  //     }
  //     @media screen and (max-width:992px) {
  //       margin-top: -5px;
  //       font-size: 14px;
  //     }
  //     @media screen and (max-width:767px) {
  //       margin-top: -5px;
  //       font-size: 12px;
  //       padding-left: 0;
  //     }
  //     @media screen and (max-width:480px) {
  //       margin-top: -5px;
  //       font-size: 12px;
  //       padding: 0;
  //     }
  //     @media screen and (max-width:340px) {
  //         margin-top: -5px;
  //         font-size: 10px;
  //     }
  //   }
  //   button.google__container{
  //     background: #fff;
  //     width: 80%;
  //     height: 50px;
  //     margin: 0 10%;
  //     box-shadow: 0px 0px 7px -1px rgba(0, 0, 0, 0.5);
  //     h6{
  //       color: #000;
  //     }
  //     i.fa-google{
  //       color:$negative;
  //       font-size: 25px;
  //       float: left;
  //       left: 100px;
  //       padding-top:10px;
  //       margin-left: 100px;
  //       @media screen and (min-width:992px) {
  //           margin-top: -14px;
  //           margin-left: 80px;
  //       }
  //       @media screen and (max-width:992px) {
  //           font-size: 25px;
  //           margin-left: 140px;
  //           margin-top: -12px;
  //       }
  //       @media screen and (max-width:767px) {
  //           font-size: 25px;
  //           padding-top: 10px;
  //           margin-left: 80px;
  //       }
  //       @media screen and (max-width:480px) {
  //         font-size: 20px;
  //         padding-top: 12px;
  //         margin-left: 10px;
  //       }
  //       @media screen and (max-width:340px) {
  //           font-size: 18px;
  //           padding-top: 12px;
  //           margin-left: 5px;
  //       }
  //     }
  //   }
  // }
}
</style>
