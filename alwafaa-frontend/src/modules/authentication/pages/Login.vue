<template>
  <div class="row justify-center">
    <ValidationObserver
      v-slot="{ handleSubmit }"
      class="flex justify-center col-xs-11 col-sm-11 col-md-9 col-lg-12 q-my-md validator"
    >
      <q-form
        class="row q-gutter-x-xs q-pb-lg justify-center login"
        @submit.prevent="handleSubmit(submitForm)"
      >
        <h4 class="col-12 q-my-lg title">{{ $t('login.title') }}</h4>
        <hr>
        <div class="input-container">
        <ValidationProvider
          name="email"
          class="col-10"
          rules="required|email"
          v-slot="{ errors, invalid, validated }"
        >
          <q-input
            class="input-field"
            v-model="email"
            outlined
            type="email"
            :label="$t('formFields.email')"
            label-color="dark"
            color="blue-1"
            bg-color="white"
            :error="invalid && validated"
            :error-message="errors[0]"
          >
          <template v-slot:prepend>
          <q-icon name="person" />
        </template>
          </q-input>
        </ValidationProvider>

        <ValidationProvider
          name="password"
          class="col-10"
          rules="required|min:7"
          v-slot="{ errors, invalid, validated }"
        >
          <q-input
            class="input-field"
            borders-radius-inherit
            v-model="password"
            outlined
            :type="isPwd ? 'password' : 'text'"
            :label="$t('formFields.password')"
            label-color="dark"
            color="blue-1"
            bg-color="white"
            :error="invalid && validated"
            :error-message="errors[0]"
          >
          <template v-slot:prepend>
          <q-icon name="vpn_key" />
        </template>
            <template v-slot:append>
              <q-icon
                :name="isPwd ? 'visibility_off' : 'visibility'"
                class="cursor-pointer"
                @click="isPwd = !isPwd"
              />
            </template>
          </q-input>
        </ValidationProvider>
        </div>
        <div class="after-input row">
          <q-checkbox
            :label="$t('login.rememberMe')"
            v-model="orange"
            color="primary"
            class="check col-6 col-md-6"
          />
          <router-link
            to="/auth/forgotPass"
            class="link col-6 col-md-6"
          >
            {{$t('login.forgotPassword')}}
          </router-link>
        </div>
          <q-btn
          dense
          no-caps
          :label="$t('header.login')"
          type="submit"
          color="green"
          text-color="dark"
          class="form-btn"
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
  }
}
</script>
<style lang="scss" scoped>
  .login {
  width: 100%;
  .title {
    color: $dark;
    text-align: center;
    margin-bottom: 70px;
    font-weight: normal;
    @media (max-width:480px) , (max-width:340px){
      font-size: 20px;
    }
  }
  hr{
    background: $grey-1;
    height: 3px;
    border: none;
    width: 60%;
    margin: -60px 20% 0px 20%;
  }
  .input-container{
    width: 60%;
    margin: 0px 20%;
  }
  .key{
      position: absolute;
      color: $dark;
      font-size: 24px;
      top: 18px;
  }
  .after-input{
    margin: -5px 20%;
    width: 60%;
    .link{
      text-decoration: none;
      color:$dark;
      text-align: right;
      padding-top: 10px;
      @media screen and (max-width: 480px),(max-width: 340px) {
        text-align: left!important;
        padding-top: 0px;
        margin-left:10px;
        font-size: 11px;
        font-weight: bolder;
      }
    }
  }
  .form-btn {
    width:30%;
    height: 45px;
    font-size: 20px;
    border-radius: 30px;
    margin: 0px 35%;
    top: 30px;
  }

}
</style>
