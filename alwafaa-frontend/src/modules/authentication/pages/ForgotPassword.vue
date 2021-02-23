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
        <h4 class="col-12 q-my-lg title">{{ $t("verifyEmailTitle") }}</h4>

        <ValidationProvider
          name="email"
          class="col-10"
          rules="required|email"
          v-slot="{ errors, invalid, validated }"
        >
        <div class="email">
          <q-input
            v-model="email"
            outlined
            type="email"
            :label="$t('email')"
            color="blue-1"
            bg-color="white"
            label-color="dark"
            :error="invalid && validated"
            :error-message="errors[0]"
          >
          <template v-slot:prepend>
          <q-icon name="person" />
        </template>
          </q-input>
        </div>

        </ValidationProvider>

        <div class="btn-container">
          <q-btn
            dense
            no-caps
            :label="$t('submit')"
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
      email: ''
    }
  },
  methods: {
    submitForm () {
      const email = {
        email: this.email
      }
      this.$store.dispatch('auth/forgotPassword', email)
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
  .email-icon{
    position: absolute;
    color: $dark;
    font-size: 24px;
    top: 18px;
  }
  .email{
    width: 70%;
    margin: 0px 15%;
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
