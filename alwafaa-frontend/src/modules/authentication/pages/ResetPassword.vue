<template>
  <ValidationObserver
    v-slot="{ handleSubmit }"
    class="flex justify-center col-xs-11 col-sm-11 col-md-9 col-lg-9 q-my-md"
  >
    <q-form
      class="row q-gutter-x-xs q-pb-lg justify-center reset-pass-form"
      @submit.prevent="handleSubmit(submitForm)"
    >
      <h4
        class="col-12 q-my-lg title">
        {{ $t('resetPass.title') }}
      </h4>
      <q-separator
        color="grey-1"
        size="3px"
        spaced="lg"
        class="separator col-7"
        inset
      />
      <h6
        class="col-6 q-my-sm text-center ">
        {{$t('resetPass.verifyEmail')}}
      </h6>
      <q-field standout="bg-green text-white" :dense="dense" class="col-6 q-my-lg">
      <template v-slot:control>
        <div
          class="self-center text-center full-width no-outline">
          {{$t('resetPass.resetCodeSent')}}
        </div>
      </template>
      </q-field>
        <ValidationProvider
          name="email"
          class="col-6"
          rules="required|email"
          v-slot="{ errors, invalid, validated }"
        >
          <q-input
            v-model="email"
            outlined
            type="email"
            :label="$t('formFields.email')"
            color="primary"
            :error="invalid && validated"
            :error-message="errors[0]"
          >
            <template v-slot:prepend>
              <q-icon name="mdi-account" />
            </template>
            <template v-slot:append v-if="!!email && (!invalid || !validated)">
              <q-icon name="fas fa-check" color="green" size="xs" />
            </template>
          </q-input>
        </ValidationProvider>
      <ValidationProvider
        name="password"
        class="col-6"
        rules="required|min:7"
        v-slot="{ errors, invalid, validated }"
      >
      <q-input
        v-model="password"
        class="pass"
        outlined
        type="password"
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
      </q-input>
      </ValidationProvider>
        <q-btn
          dense
          no-caps
          :label="$t('change')"
          type="submit"
          color="green"
          text-color="grey-1"
          class="col-6 form-btn"
        ></q-btn>
        <q-btn
          dense
          no-caps
          :label="$t('signup.continue')"
          type="submit"
          color="green"
          text-color="grey-1"
          class="col-6 form-btn"
        ></q-btn>
      </q-form>
  </ValidationObserver>

</template>

<script>

export default {

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
  .title {
    color: $dark;
    text-align: center;
    margin-top: 80px;
    width: 60%;
  }
  .separator{
    margin-bottom: 80px !important;
  }
  .key{
    position: absolute;
    color: $dark;
    font-size: 24px;
    top: 18px;
  }

  .form-btn {
    font-size: 20px;
    margin-top: 17px;
  }
  .q-input {
    &::v-deep {
      .q-field__control{
        border-radius: 7px;
      }
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
