<template>
  <div class="q-pa-md q-mt-xl">

    <ValidationObserver v-slot="{ handleSubmit }">
      <q-form
        @submit.prevent="handleSubmit(submitForm)"
        class="row justify-center"
      >
        <div
          class="col-12 q-my-sm text-center"
          :class="{
            'text-h4': !$q.screen.lt.md,
            'text-h5': $q.screen.lt.md,
          }"
        >
          {{ $t('resetPass.title') }}
        </div>
        <q-separator
          class="col-7 separator"
          spaced="lg"
          size="3px"
          color="grey-1"
        />
        <div
          class="step1 col-12 row"
        >
          <h4
            class="col-12 q-mt-xl q-mb-none title-2 text-center text-grey-4">
            {{ $t('resetPass.title') }}
          </h4>
          <p
            class="col-12 q-mb-lg second-title text-center text-grey-3">
            {{ $t('resetPass.enterEmail') }}
          </p>
        </div>
        <ValidationProvider
          name="email"
          class="col-7"
          rules="required|email"
          v-slot="{ errors, invalid, validated }"
        >
          <g-input
            class="input-field q-pb-lg"
            v-model="email"
            outlined
            type="email"
            :label="$t('formFields.email')"
            color="blue-1"
            bg-color="white"
            :error="invalid && validated"
            :error-message="errors[0]"
            :appendIconName='!!email && (!invalid || !validated) ? "mdi-check" : null'
            appendIconColor= 'green'
            appendIconSize= 'sm'
            prependIconName='person'
          />

        </ValidationProvider>
        <div class="col-12 row justify-center">
          <!-- <q-btn
            no-caps
            rounded
            :icon-right="checkDirection ? 'mdi-chevron-left' : 'mdi-chevron-right'"
            :label="$t('forgotPass.submit')"
            :class="{
              'col-3': !$q.screen.lt.md,
              'col-4': $q.screen.lt.md && !$q.screen.lt.sm,
              'col-5': $q.screen.lt.sm,
              'q-mt-md': true
            }"
            :size="$q.screen.lt.md? 'md' : 'lg'"
            type="submit"
            color="green"
            text-color="grey-5"
          /> -->
          <g-btn
            :icon-right="checkDirection ? 'mdi-chevron-left' : 'mdi-chevron-right'"
            label="forgotPass.submit"
            :class="{
              'col-3': !$q.screen.lt.md,
              'col-4': $q.screen.lt.md && !$q.screen.lt.sm,
              'col-5': $q.screen.lt.sm,
              'q-mt-md': true
            }"
            :size="$q.screen.lt.md? 'md' : 'lg'"
          />
          <g-btn
            v-if="!$q.screen.lt.sm"
            color='white'
            type="button"
            icon-right="mdi-window-close"
            label="forgotPass.cancel"
            class="col-sm-3 col-md-3 col-lg-2 q-mt-md q-ml-md "
            text-color="grey-5"
            to="/auth/login"
          />
          <!-- <q-btn
            v-if="!$q.screen.lt.sm"
            outline
            type="button"
            icon-right="mdi-window-close"
            :label="$t('forgotPass.cancel')"
            class="col-sm-3 col-md-3 col-lg-2 q-mt-md q-ml-md "
            :size="$q.screen.lt.md? 'md' : 'lg'"
            text-color="grey-5"
            to="/auth/login"
          /> -->
        </div>
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
  computed: {
    checkDirection () {
      return this.$q.lang.rtl
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
.title-2{
  font-size: 17px;
}

.q-btn {
  &::v-deep {
    .q-icon {
      font-size: 25px;
    }
  }
}

</style>
