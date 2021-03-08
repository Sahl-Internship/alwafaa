<template>
  <div class="row justify-center">
    <div
      class="col-12 text-weight-bold text-center q-mt-none text-grey-5"
      :class="{
        'text-h4': !$q.screen.lt.sm,
        'text-h5': $q.screen.lt.sm
      }"
    >
      {{ $t("signup.title") }}
    </div>

    <q-separator class="col-2" spaced="md" size="2px" color="grey-1" />

    <div class="col-12 q-mt-lg">
      <div class="row justify-center">
        <div class="col-xs-6 col-sm-6 text-subtitle1 text-bold text-center text-grey-4">
          {{ $t("signup.firstFormTitle") }}
        </div>
        <div class="col-xs-6 col-sm-6 text-subtitle1 text-bold text-center text-grey-4">
          {{ $t("signup.secondFormTitle") }}
        </div>
        <!-- <div class="col-xs-4 col-sm-3 text-subtitle1 text-bold text-center text-grey-4">
          {{ $t("signup.thirdFormTitle") }}
        </div> -->
      </div>
    </div>

    <div class="col-xs-8 col-sm-7">
      <q-stepper
        v-model="step"
        ref="stepper"
        contracted
        color="primary"
        done-color="green"
        inactive-color="grey-2"
        animated
        flat
      >
        <q-step
          :name="1"
          :title="$t('signup.firstFormTitle')"
          :done="step > 1"
        >
          <ValidationObserver v-slot="{ handleSubmit }">
            <q-form
              @submit.prevent="handleSubmit(validateFirstForm)"
              class="row justify-center"
            >
              <ValidationProvider
                name="firstname"
                class="col-xs-12 col-sm-6 col-md-6 q-pr-xs q-pb-xs"
                rules="required"
                v-slot="{ errors, invalid, validated }"
              >
                <g-input
                  outlined
                  v-model="firstname"
                  :label="$t('formFields.firstname')"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                  prependIconName="mdi-account"
                />
              </ValidationProvider>

              <ValidationProvider
                name="lastname"
                class="col-xs-12 col-sm-6 col-md-6 q-pb-xs"
                rules="required"
                v-slot="{ errors, invalid, validated }"
              >
                <g-input
                  outlined
                  v-model="lastname"
                  :label="$t('formFields.lastname')"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                  prependIconName="mdi-account"
                />
              </ValidationProvider>

              <ValidationProvider
                name="gender"
                class="col-12 q-pb-xs"
                rules="required"
                v-slot="{ errors, invalid, validated }"
              >
                <g-select
                  outlined
                  v-model="gender"
                  :options="genderOptions"
                  :label="$t('formFields.gender')"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                  prependIconName="mdi-human-male-female"
                />
              </ValidationProvider>

              <ValidationProvider
                name="country"
                class="col-12 q-pb-xs"
                rules="required"
                v-slot="{ errors, invalid, validated }"
              >
                <g-select
                  outlined
                  v-model="country"
                  :options="countriesNamesOptions"
                  :label="$t('formFields.country')"
                  prependIconName="mdi-flag-variant"
                  :flag="isoCode"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                />
              </ValidationProvider>

              <ValidationProvider
                name="city"
                class="col-12 q-pb-xs"
                rules="required"
                v-slot="{ errors, invalid, validated }"
              >
                <g-input
                  outlined
                  v-model="city"
                  :label="$t('formFields.city')"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                  prependIconName="mdi-city"
                />
              </ValidationProvider>

              <g-btn
                label="signup.continue"
                :icon-right="checkDirection ? 'mdi-chevron-left' : 'mdi-chevron-right'"
                :width="!$q.screen.lt.md ? 'col-5' : 'col-6'"
                :margin="['q-mt-sm']"
              />
            </q-form>
          </ValidationObserver>
        </q-step>

        <q-step
          :name="2"
          :title="$t('signup.secondFormTitle')"
          :done="step > 2"
        >
          <ValidationObserver v-slot="{ handleSubmit }">
            <q-form
              @submit.prevent="handleSubmit(submitData)"
              class="row justify-center"
            >
              <ValidationProvider
                name="email"
                class="col-12 q-pb-xs"
                rules="required|email"
                v-slot="{ errors, invalid, validated }"
              >
                <g-input
                  outlined
                  type="email"
                  v-model="email"
                  :label="$t('formFields.email')"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                  prependIconName="mdi-account"
                  :appendIconName="!!email && (!invalid || !validated) ? 'mdi-check' : null"
                  appendIconColor="green"
                  appendIconSize="sm"
                />
              </ValidationProvider>

              <div class="col-12 row phone"
              >
                <ValidationProvider
                  name="phone"
                  class="col-xs-9 col-sm-9 col-md-10 col-lg-10 q-pb-xs phone-input"
                  rules="required|numeric"
                  v-slot="{ errors, invalid, validated }"
                >
                  <g-input
                    borderless
                    v-model="phoneNumber"
                    :label="$t('formFields.phone')"
                    :error="invalid && validated"
                    :error-message="errors[0]"
                    prependIconName="mdi-phone"
                  />
                </ValidationProvider>

                <ValidationProvider
                  name="phone-key"
                  class="col-xs-3 col-sm-3 col-md-2 col-lg-2 q-pb-xs phone-select"
                  rules="required"
                  v-slot="{ errors, invalid, validated }"
                >
                  <g-select
                    borderless
                    v-model="phoneKey"
                    :options="dialCodesOPtions"
                    :error="invalid && validated"
                    :error-message="errors[0]"
                  />
                </ValidationProvider>
              </div>

              <ValidationProvider
                name="password"
                class="col-12 q-pb-xs"
                rules="required|min:7"
                v-slot="{ errors, invalid, validated }"
              >
                <g-input
                  v-model="password"
                  outlined
                  type="password"
                  :label="$t('formFields.password')"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                  prependIconName="mdi-key"
                  appendIconName="mdi-eye-off"
                />
              </ValidationProvider>

              <ValidationProvider
                name="confirm-password"
                class="col-12 q-pb-xs"
                rules="required|confirmed:password"
                v-slot="{ errors, invalid, validated }"
              >
                <g-input
                  outlined
                  v-model="confirmPass"
                  type="password"
                  :label="$t('formFields.confirmPass')"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                  prependIconName="mdi-key"
                  appendIconName="mdi-eye-off"
                />
              </ValidationProvider>

              <g-btn
                label="signup.finish"
                :width="!$q.screen.lt.md ? 'col-5' : 'col-6'"
                :margin="['q-mt-sm']"
              />
            </q-form>
          </ValidationObserver>
        </q-step>

        <!-- <q-step
          :name="3"
          :title="$t('signup.thirdFormTitle')"
        >
          <div
            class="text-weight-bold text-center text-grey-4"
            :class="{
              'text-h5': !$q.screen.lt.sm,
              'text-h6': $q.screen.lt.sm
            }"
          >
            {{ $t('signup.checkEmail') }}
          </div>

          <div class="text-subtitle1 text-center q-mt-md email-sent text-grey-4">
            {{ $t('signup.emailSent') }}
          </div>

          <div class="row justify-center q-mt-sm">
            <q-btn flat type="button" :label="$t('signup.resend')" class="text-line text-font" />

            <q-btn
              flat
              type="button"
              :label="$t('signup.edit')"
              :class="{
                'q-mx-xs': !$q.screen.lt.md,
                'q-mx-none': $q.screen.lt.md,
                'text-line': true,
                'text-font': true
              }"
              @click="$refs.stepper.previous()"
            />

            <div class="text-subtitle1 text-font">{{ email }}</div>
          </div>

          <ValidationObserver v-slot="{ handleSubmit }">
            <q-form
              @submit.prevent="handleSubmit(submitVerfication)"
              class="row justify-center q-mt-xl"
            >
              <ValidationProvider
                name="verfication-code"
                class="col-12"
                rules="required"
                v-slot="{ errors, invalid, validated }"
              >
                <q-input
                  v-model="verficationCode"
                  outlined
                  type="text"
                  :label="$t('formFields.verficationCode')"
                  color="primary"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                >
                  <template v-slot:prepend>
                    <q-icon name="mdi-shield-check" />
                  </template>
                  <template v-slot:append v-if="!!verficationCode && (!invalid || !validated)">
                    <q-icon name="fas fa-check" color="green" size="xs" />
                  </template>
                </q-input>
              </ValidationProvider>

              <q-checkbox
                :label="$t('signup.read')"
                v-model="agree"
                color="primary"
                class="col-12"
              >
                <span class="text-line"> {{ $t('signup.rules') }}</span>
              </q-checkbox>

              <q-btn
                no-caps
                rounded
                type="submit"
                :disable="!agree"
                :label="step === 2 ? $t('signup.finish') : $t('signup.continue')"
                class="col-6 q-mt-md"
                color="green"
                text-color="grey-5"
                size="lg"
              />
            </q-form>
          </ValidationObserver>
        </q-step> -->
      </q-stepper>
    </div>

  </div>
</template>

<script>
import { dialCodes, countriesNames, getSelectedCountry } from 'src/utils/countries.js'
import { i18n } from 'src/boot/i18n'

export default {
  name: 'Signup',
  data () {
    return {
      step: 1,
      firstname: '',
      lastname: '',
      gender: '',
      country: '',
      city: '',
      email: '',
      phoneNumber: '',
      phoneKey: '',
      password: '',
      confirmPass: '',
      genderOptions: [i18n.t('signup.female'), i18n.t('signup.male')],
      // countriesNamesOptions: countriesNames(this.checkLanguage),
      dialCodesOPtions: dialCodes,
      isoCode: ''
    }
  },
  computed: {
    checkDirection () {
      return this.$q.lang.rtl
    },
    checkLanguage () {
      return this.$q.lang.rtl ? 'ar' : 'en'
    },
    countriesNamesOptions () {
      return countriesNames(this.checkLanguage)
    }
  },
  methods: {
    validateFirstForm () {
      this.$refs.stepper.next()
    },
    submitData () {
      const user = {
        firstname: this.firstname,
        lastname: this.lastname,
        gender: this.gender === i18n.t('signup.male') ? '1' : '2',
        country: this.country,
        city: this.city,
        email: this.email,
        phone: `${this.phoneKey}${this.phoneNumber}`,
        password: this.password
      }
      this.$store.dispatch('auth/signup', user)
    }
  },
  watch: {
    country (newVal) {
      const selectedCountry = getSelectedCountry(newVal, this.checkLanguage)
      this.isoCode = selectedCountry.code
      this.phoneKey = selectedCountry.dial_code
    }
  }
}
</script>

<style lang="scss" scoped>
.q-stepper {
  &::v-deep {
    .q-stepper__header {
      height: 50px;
      min-height: 40px;
    }
    .q-stepper__tab {
      padding: 0;
      height: 25px;
      min-height: 20px;
    }
    .q-stepper__dot {
      width: 12px;
      height: 12px;
      min-width: 8px;
    }
    .q-stepper__tab--active .q-stepper__dot {
      width: 19px;
      height: 19px;
    }
    .q-stepper__tab--done .q-stepper__dot {
      width: 23px;
      height: 23px;
    }
    .q-stepper__tab .q-stepper__dot::before,
    .q-stepper__tab .q-stepper__dot::after {
      margin: 0;
    }
    .q-stepper__tab--active .q-stepper__dot::before,
    .q-stepper__tab--done .q-stepper__dot::before,
    .q-stepper__tab--done .q-stepper__dot::after {
      background-color: $primary;
      height: 2px;
    }
    .fa-pencil-alt {
      font-size: 9px;
    }
    .q-stepper__step-inner {
      padding: 30px 0;
    }
  }

  .q-btn {
    &::v-deep {
      .q-icon {
        font-size: 25px;
      }
    }
  }

  .phone-input .q-input {
    &::v-deep {
      .q-field__inner {
        border: solid 1px $grey-3;
        border-right: none;
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
      }
      .q-field__inner:hover {
        border-color: $grey-5;
      }
      .q-field__prepend {
        padding-left: 12px;
      }
    }
  }

  .phone-select .q-select {
    &::v-deep {
      .q-field__inner {
        border: solid 1px $grey-3;
        border-left-color: $grey-3;
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
      }
      .q-field__control-container {
        padding-top: 10px;
      }
      .q-field__native {
        direction: rtl;
      }
      .q-field__append {
        padding-left: 5px;
      }
    }
  }

  .phone:hover {
    &::v-deep {
      .q-select .q-field__inner {
        border-color: $grey-5;
        border-left-color: $grey-2;
      }
    }
  }
}

</style>
