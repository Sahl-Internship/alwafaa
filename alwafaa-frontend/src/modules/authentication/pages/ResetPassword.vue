<template>
  <auth-layout>
    <ValidationObserver
      v-slot="{ handleSubmit }"
      class="flex justify-center col-xs-11 col-sm-11 col-md-9 col-lg-9 q-my-md"
    >
      <q-form
        class="row q-gutter-x-xs q-pb-lg justify-center reset-pass-form"
        @submit.prevent="handleSubmit(submitForm)"
      >
        <h4 class="col-12 q-my-lg title">{{ $t('resetPass') }}</h4>

        <ValidationProvider
          name="password"
          class="col-10"
          rules="required|min:7"
          v-slot="{ errors, invalid, validated }"
        >
        <div class="pass-container">
                    <q-input
            v-model="password"
            class="pass"
            outlined
            type="password"
            :label="$t('password')"
            label-color="dark"
            color="blue-1"
            bg-color="white"
            :error="invalid && validated"
            :error-message="errors[0]"
          >
          <template v-slot:prepend>
          <q-icon name="vpn_key" />
        </template>
          </q-input>
        </div>

        </ValidationProvider>
        <div class="btn-container">
          <q-btn
            dense
            no-caps
            :label="$t('change')"
            type="submit"
            color="primary"
            text-color="grey-1"
            class="col-10 form-btn"
          ></q-btn>
        </div>
      </q-form>
    </ValidationObserver>
  </auth-layout>
</template>

<script>
import AuthLayout from '../layout/AuthLayout.vue'

export default {
  components: {
    AuthLayout
  },
  data () {
    return {
      password: ''
    }
  },
  methods: {
    submitForm () {
      const password = {
        password: this.password
      }
      this.$store.dispatch('auth/resetPassword', password)
    }
  }
}
</script>
<style lang="scss" scoped>
.reset-pass-form {
  // border: solid 1px $grey-2;
  // border-radius: 7px;
  // background-color: #fff;
  // box-shadow: 1px 10px 10px 5px $grey-3;

  .title {
    color: $dark;
    text-align: center;
  }
  .pass-container{
    width: 70%;
    margin: 0px 15%;
  }
.key{
    position: absolute;
    color: $dark;
    font-size: 24px;
    top: 18px;
    }
  .btn-container{
    width: 83%;
    .form-btn {
      font-size: 20px;
      width: 70%;
      margin: 0px 15%;
      margin-top: 17px;
    }
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
