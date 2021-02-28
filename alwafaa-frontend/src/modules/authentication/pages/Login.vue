<template>
  <div class="row justify-center q-mt-xl">
    <ValidationObserver
      v-slot="{ handleSubmit }"
      class="flex justify-center col-xs-11 col-sm-11 col-md-10 col-lg-12 q-my-md validator"
    >
      <q-form
        class="row q-gutter-x-xs q-pb-lg justify-center"
        @submit.prevent="handleSubmit(submitForm)"
      >
        <h4 class="col-12 q-my-sm text-center title">{{ $t('login.title') }}</h4>
        <q-separator
          class="col-7"
          spaced="lg"
          size="3px"
          color="grey-1"
        />

        <ValidationProvider
          name="email"
          class="col-7 q-mt-xl"
          rules="required|email"
          v-slot="{ errors, invalid, validated }"
        >
          <g-input
            class="input-field q-pb-lg"
            v-model="email"
            outlined
            type="email"
            :label="$t('formFields.email')"
            label-color="dark"
            color="blue-1"
            bg-color="white"
            :error="invalid && validated"
            :error-message="errors[0]"
            prependIconName='person'
            :appendIconName='!!email && (!invalid || !validated) ? "mdi-check" : null'
            appendIconColor= 'green'
            appendIconSize= 'sm'
          />
        </ValidationProvider>

        <ValidationProvider
          name="password"
          class="col-7"
          rules="required"
          v-slot="{ errors, invalid, validated }"
        >
          <g-input
            class="input-field q-pb-lg"
            v-model="password"
            outlined
            type= 'password'
            :label="$t('formFields.password')"
            label-color="dark"
            color="blue-1"
            bg-color="white"
            :error="invalid && validated"
            :error-message="errors[0]"
            prependIconName='vpn_key'
            appendIconName='mdi-eye-off'
          />
        </ValidationProvider>
        <div class="col-7 row">
          <q-checkbox
            :label="$t('login.rememberMe')"
            v-model="orange"
            color="green"
            class="check col-6 col-md-6"
          />
          <router-link
            to="/auth/forgotPass"
            class="link col-6 col-md-6 q-pt-sm text-right"
          >
            {{$t('login.forgotPassword')}}
          </router-link>
        </div>
          <q-btn
            dense
            no-caps
            rounded
            :label="$t('header.login')"
            type="submit"
            color="green"
            text-color="grey-5"
            class="form-btn col-4 q-mx-xl"
        ></q-btn>
        <!-- <google-btn class="social-button" status="login"></google-btn> -->
        <!-- <facebook-btn class="social-button face" status="login"></facebook-btn> -->
      </q-form>
    </ValidationObserver>
  </div>
</template>

<script>

export default {
  name: 'Login',
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
  },
  mounted () {
    console.log(this.$route)
  }
}
</script>
<style lang="scss" scoped>
.title {
  @media (max-width:480px) , (max-width:340px){
    font-size: 20px;
  }
}
.check {
  @media screen and (max-width: 480px) {
    font-size: 11px;
  }
}
.link{
  text-decoration: none;
  color:$dark;
  @media (max-width: 480px ) {
    font-size: 11px;
    margin-top: 4px;
  }
  @media (max-width: 340px) {
    text-align: left!important;
    padding-top: 0px;
    margin-left:10px;
    font-size: 11px;
  }
}
.form-btn {
  font-size: 20px;
  top: 30px;
}
</style>
