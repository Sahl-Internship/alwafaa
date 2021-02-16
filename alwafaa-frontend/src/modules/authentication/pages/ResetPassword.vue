<template>
  <auth-container>
    <form
      class="form-container login-show col-12 col-md"
      @submit.prevent="reset"
    >
      <h2>{{ $t("resetPass") }}</h2>
      <validation-provider v-slot="v">
        <q-input
          v-model="password"
          outlined
          type="password"
          :rules="[(val) => !!val || 'Field is required']"
          color="secondary"
          :label="$t('password')"
          class="input-field"
        >
          <span>{{ v.errors[0] }}</span>
        </q-input>
      </validation-provider>
      <button class="reset">{{ $t("change") }}</button>
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
      password: "",
      formIsValid: true,
    };
  },
  methods: {
    reset() {
      this.formIsValid = true;
      if (this.password.length < 6) {
        this.formIsValid = false;
        return;
      }
      const password = {
        password: this.password,
      };
      this.$store.dispatch("auth/resetPass", password);
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
  border: 3px solid $ground;
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
  .input-field {
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
  .reset {
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
