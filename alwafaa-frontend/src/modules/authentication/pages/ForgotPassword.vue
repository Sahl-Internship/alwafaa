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
        <div
          v-if="step === 1"
          class="step1 row"
        >
          <h4
            class="col-12 q-my-lg form-title text-center">
            {{ $t('resetPass.title') }}
          </h4>
          <p
            class="col-12 q-my-md second-title text-center">
            {{ $t('resetPass.enterEmail') }}
          </p>
        </div>
        <div
          v-if="step === 2"
          class="step2 row"
        >
          <h4
            class="col-12 q-my-lg title text-center">
            {{ $t('resetPass.verifyEmailTitle') }}
          </h4>
          <q-field
            standout="bg-green text-white"
            class="self-center col-7 q-my-lg"
          >
            <template
              v-slot:control
            >
              <div
                class="self-center text-center full-width no-outline">
                {{$t('resetPass.emailVerifyLink')}}
              </div>
            </template>
          </q-field>
        </div>
        <ValidationProvider
          name="email"
          class="col-7"
          rules="required|email"
          v-slot="{ errors, invalid, validated }"
        >
          <q-input
            v-if="step === 1"
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
            <template
              v-slot:append
              v-if="!!email && (!invalid || !validated)"
            >
              <q-icon
                name="fas fa-check"
                color="green"
                size="xs"
              />
            </template>
          </q-input>

        </ValidationProvider>
        <q-btn
          class="form-btn"
          type="submit"
          v-if="step === 1"
          @click="submitForm"
          color="green"
          :label="$t('submit')"
        />
      </q-form>
    </ValidationObserver>
  </div>
</template>

<script>

export default {
  data () {
    return {
      email: '',
      step: 1
    }
  },
  methods: {
    submitForm () {
      this.step = 2
      const email = {
        email: this.email
      }
      this.$store.dispatch('auth/forgotPassword', email)
    }
  }
}
</script>
<style lang="scss" scoped>
.title {
  color: $dark;
  text-align: center;
  margin-top: 100px;
}

.form-title{
  font-weight: normal;
  font-size: 17px;
  height: 0;
  color: $grey-4;
}
.second-title{
  margin-bottom: 30px;
  color: $grey-3;
}
.separator{
  width: 60%;
  margin: 0px 20%;
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
