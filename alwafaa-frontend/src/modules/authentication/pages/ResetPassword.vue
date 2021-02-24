<template>
  <div class="q-pa-md">
    <h4
      class="col-12 q-my-lg title text-center">
      {{ $t('resetPass.title') }}
    </h4>
    <q-separator
      color="grey-1"
      size="3px"
      spaced="lg"
      class="separator col-7"
      inset
    />

    <ValidationObserver v-slot="{ handleSubmit }">
      <q-form
        @submit.prevent="handleSubmit(submitForm)"
        class="row justify-center"
      >
        <h4
          class="col-7 q-my-lg title text-center">
          {{ $t('resetPass.verifyFinished') }}
        </h4>
        <p
          class="col-12 q-my-md second-title text-center">
          {{ $t('resetPass.enterNewPass') }}
        </p>
        <ValidationProvider
          name="password"
          class="col-7"
          rules="required|min:7"
          v-slot="{ errors, invalid, validated }"
        >
          <q-input
            v-model="password"
            outlined
            :type="isPwd ? 'password' : 'text'"
            :label="$t('formFields.password')"
            color="primary"
            :error="invalid && validated"
            :error-message="errors[0]"
          >
                  <template v-slot:prepend>
                    <q-icon name="mdi-key" />
                  </template>
                  <template v-slot:append>
                    <q-icon
                      :name="isPwd ? 'mdi-eye-off' : 'mdi-eye'"
                      class="cursor-pointer"
                      @click="isPwd = !isPwd"
                    ></q-icon>
                  </template>
                </q-input>
        </ValidationProvider>

        <ValidationProvider
          name="confirm-password"
          class="col-7"
          rules="required|confirmed:password"
          v-slot="{ errors, invalid, validated }"
        >
          <q-input
            v-model="confirmPass"
            outlined
            :type="isCPwd ? 'password' : 'text'"
            :label="$t('formFields.confirmPass')"
            color="primary"
            :error="invalid && validated"
            :error-message="errors[0]"
          >
            <template v-slot:prepend>
              <q-icon name="mdi-key" />
            </template>
            <template v-slot:append>
              <q-icon
                :name="isCPwd ? 'mdi-eye-off' : 'mdi-eye'"
                class="cursor-pointer"
                @click="isCPwd = !isCPwd"
              ></q-icon>
            </template>
          </q-input>
        </ValidationProvider>
        <q-btn
          @click="submitForm"
          type="submit"
          class="col-7 form-btn"
          color="green"
          :label="$t('resetPass.change')"
        />
        </q-form>
    </ValidationObserver>
  </div>
</template>

<script>

export default {

  data () {
    return {
      password: '',
      confirmPass: '',
      isPwd: true,
      isCPwd: true,
      step: 1
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

  .title {
    color: $dark;
    text-align: center;
    margin-top: 80px;
    width: 60%;
  }
  .separator{
    margin-bottom: 80px !important;
  }
  .q-stepper__header{
    &::v-deep {
      .q-stepper__tab{
        display: none;
      }
    }
  }
  .key{
    position: absolute;
    color: $dark;
    font-size: 24px;
    top: 18px;
  }
  .q-input {
    &::v-deep {
      .q-field__control{
        border-radius: 7px;
      }
    }
  }
  .form-btn{
  width: 20%;
  margin: 0px 40%;
  border-radius: 25px;
  font-size: 18px;
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
