<template>
  <!-- <auth-container> -->
    <ValidationObserver
      v-slot="{ handleSubmit }"
      class="flex justify-center col-xs-11 col-sm-11 col-md-9 col-lg-9 q-my-md"
    >
      <q-form
        class="row q-gutter-x-xs q-pb-lg justify-center login"
        @submit.prevent="handleSubmit(submitForm)"
      >
        <h4 class="col-12 q-my-lg title">{{ $t("loginTitle") }}</h4>

        <ValidationProvider
          name="email"
          class="col-10"
          rules="required|email"
          v-slot="{ errors, invalid, validated }"
        >
          <q-input
            v-model="email"
            outlined
            type="email"
            :label="$t('email')"
            color="blue-1"
            bg-color="grey-1"
            :error="invalid && validated"
            :error-message="errors[0]"
          >
          </q-input>
        </ValidationProvider>

        <ValidationProvider
          name="password"
          class="col-10"
          rules="required|min:7"
          v-slot="{ errors, invalid, validated }"
        >
          <q-input
            v-model="password"
            outlined
            :type="isPwd ? 'password' : 'text'"
            :label="$t('password')"
            color="blue-1"
            bg-color="grey-1"
            :error="invalid && validated"
            :error-message="errors[0]"
          >
            <template v-slot:append>
              <q-icon
                :name="isPwd ? 'visibility_off' : 'visibility'"
                class="cursor-pointer"
                @click="isPwd = !isPwd"
              />
            </template>
          </q-input>
        </ValidationProvider>

        <q-checkbox
          :label="$t('rememberMe')"
          v-model="orange"
          color="secondary"
          class="col-10 check"
        />

        <q-btn
          dense
          no-caps
          :label="$t('login')"
          type="submit"
          color="primary"
          text-color="grey-1"
          class="col-10 form-btn"
        ></q-btn>

        <q-btn
          flat
          unelevated
          no-caps
          :label="$t('forgotPassword')"
          type="button"
          class="col-10"
          text-color="grey"
          to="/forgotPass"
        />

        <!-- <google-btn class="social-button" status="login"></google-btn> -->
        <!-- <facebook-btn class="social-button face" status="login"></facebook-btn> -->
      </q-form>
    </ValidationObserver>
  <!-- </auth-container> -->
</template>

<script>
// import AuthContainer from '../layout/AuthContainer.vue'

export default {
  name: 'Login',
  // components: {
  //   AuthContainer
  // },
  data () {
    return {
      email: '',
      password: '',
      isPwd: true,
      formIsValid: true,
      orange: false
    }
  },
  methods: {
    submitForm () {
      const user = {
        identity: this.email,
        password: this.password
      }
      this.$store.dispatch('auth/login', user)
    }
  }
}
</script>
<style lang="scss" scoped>
.login {
  border: solid 1px $grey-2;
  border-radius: 7px;
  background-color: #fff;
  box-shadow: 1px 10px 10px 5px $grey-3;

  .title {
    color: $grey;
    text-align: center;
  }

  .form-btn {
    font-size: 20px;
  }
}

@media (max-width: 860px) and(min-width: 700px) {
  .title {
    font-size: 25px;
  }
}

@media (max-width: 500px) {
  .title {
    font-size: 30px;
  }
}
</style>
