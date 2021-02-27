<template>
  <div class="q-pa-md">

    <ValidationObserver v-slot="{ handleSubmit }">
      <q-form
        @submit.prevent="handleSubmit(submitForm)"
        class="row justify-center"
      >
        <div
          class="col-12 q-my-sm q-mt-xl text-center"
          :class="{
            'text-h4': !$q.screen.lt.md,
            'text-h5': $q.screen.lt.md,
          }"
        >
          {{ $t('resetPass.title') }}
        </div>
        <q-separator
          color="grey-1"
          size="3px"
          spaced="lg"
          class="separator col-7"
          inset
        />
        <div
          class="col-10 q-mb-md q-mt-lg text-center"
          :class="{
            'text-h4': !$q.screen.lt.md,
            'text-h5': $q.screen.lt.md && !$q.screen.lt.sm,
            'text-h6': $q.screen.lt.sm,
          }"
        >
          <i class="far fa-check-circle q-mr-md checked-icon"></i>
          {{ $t('resetPass.verifyFinished') }}
        </div>
        <div
          class="col-12 q-my-sm q-mb-xl title-3 text-center text-grey-4"
          :class="{
            'text-subtitle1': !$q.screen.lt.md,
            'text-subtitle2': $q.screen.lt.md && !$q.screen.lt.sm,
          }"
        >
          {{ $t('resetPass.enterNewPass') }}
        </div>
        <ValidationProvider
          name="password"
          class="col-7 q-mb-xs"
          rules="required|min:7"
          v-slot="{ errors, invalid, validated }"
        >
          <g-input
            class="q-pb-lg"
            v-model="password"
            outlined
            type='password'
            :label="$t('formFields.password')"
            color="primary"
            :error="invalid && validated"
            :error-message="errors[0]"
            appendIconName= 'mdi-eye-off'
            prependIconName= 'mdi-key'
          />
        </ValidationProvider>

        <ValidationProvider
          name="confirm-password"
          class="col-7 q-mb-sm"
          rules="required|confirmed:password"
          v-slot="{ errors, invalid, validated }"
        >
          <g-input
            v-model="confirmPass"
            outlined
            :type="isCPwd ? 'password' : 'text'"
            :label="$t('formFields.confirmPass')"
            color="primary"
            class="q-pb-lg"
            :error="invalid && validated"
            :error-message="errors[0]"
            prependIconName='mdi-key'
            appendIconName='mdi-eye-off'
          />
        </ValidationProvider>
        <div class="col-12 row justify-center">
          <q-btn
            type="submit"
            rounded
            no-caps
            :class="{
              'col-3': !$q.screen.lt.md,
              'col-4': $q.screen.lt.md && !$q.screen.lt.sm,
              'col-5': $q.screen.lt.sm,
              'q-mt-md': true
            }"
            :size="$q.screen.lt.md? 'md' : 'lg'"
            color="green"
            :label="$t('resetPass.change')"
          />
          <q-btn
            v-if="!$q.screen.lt.sm"
            no-caps
            rounded
            outline
            type="button"
            icon-right="mdi-window-close"
            :label="$t('login.cancel')"
            class="col-sm-3 col-md-3 col-lg-2 q-mt-md q-ml-md "
            :size="$q.screen.lt.md? 'md' : 'lg'"
            text-color="grey-5"
            to="/auth/login"
          />
        </div>
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

</style>
