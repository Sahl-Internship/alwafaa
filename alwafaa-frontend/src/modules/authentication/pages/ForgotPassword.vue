<template>
  <div class="q-pa-md">
    <div
      class="col-12 q-my-lg title text-center"
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

    <ValidationObserver v-slot="{ handleSubmit }">
      <q-form
        @submit.prevent="handleSubmit(submitForm)"
        class="row justify-center"
      >
        <div
          class="step1 col-12 row"
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
        <ValidationProvider
          name="email"
          class="col-7"
          rules="required|email"
          v-slot="{ errors, invalid, validated }"
        >
          <q-input
            v-model="email"
            outlined
            type="email"
            :label="$t('formFields.email')"
            color="primary"
            bg-color="grey-1"
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
        <div class="col-12 row justify-center">
          <q-btn
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
          />

          <q-btn
            v-if="!$q.screen.lt.sm"
            no-caps
            rounded
            outline
            type="button"
            icon-right="mdi-window-close"
            :label="$t('forgotPass.cancel')"
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
.title {
  color: $dark;
  text-align: center;
  margin-top: 60px;
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
// .form-btn{
//   width: 20%;
//   margin: 0px 40%;
//   border-radius: 25px;
//   font-size: 18px;
// }

.q-btn {
  &::v-deep {
    .q-icon {
      font-size: 25px;
    }
  }
}
// @media (max-width: 860px) and(min-width: 700px) {
//   .title {
//     font-size: 25px;
//   }
// }

// @media (max-width: 500px) {
//   .title {
//     font-size: 30px;
//   }
// }
</style>
